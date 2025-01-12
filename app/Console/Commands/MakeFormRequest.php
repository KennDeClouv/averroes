<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MakeFormRequest extends Command
{
    protected $signature = 'make:form-req {table} {name}';
    protected $description = 'Generate a FormRequest with validation rules and messages based on a table';

    public function handle()
    {
        $table = $this->argument('table');
        $name = $this->argument('name');

        $rules = $this->generateValidationRules($table);
        $messages = $this->generateValidationMessages($rules);
        $rulesString = $this->formatValidationRules($rules);
        $messagesString = $this->formatValidationMessages($messages);

        $className = Str::studly($name);
        $filePath = app_path("Http/Requests/{$className}.php");

        // cek jika file sudah ada
        if (file_exists($filePath)) {
            $this->error("FormRequest $className already exists.");
            return Command::FAILURE;
        }

        // buat isi FormRequest
        $template = <<<EOT
        <?php

        /**
         * File ini dibuat secara otomatis oleh perintah MakeFormRequest / make:form-req.
         * Kamu dapat memodifikasi file ini.
         */
        namespace App\Http\Requests;

        use Illuminate\Foundation\Http\FormRequest;

        class {$className} extends FormRequest
        {
            public function authorize()
            {
                return true;
            }

            public function rules()
            {
                return {$rulesString};
            }

            public function messages()
            {
                return {$messagesString};
            }
        }
        EOT;

        // tulis file FormRequest
        file_put_contents($filePath, $template);

        $this->info("FormRequest $className created successfully at $filePath.");
        return Command::SUCCESS;
    }

    protected function generateValidationRules($table)
{
    $columns = Schema::getColumnListing($table);
    $rules = [];

    foreach ($columns as $column) {
        if (in_array($column, ['id', 'created_at', 'updated_at'])) {
            continue;
        }
        $details = collect(DB::select("DESCRIBE `{$table}`"))->firstWhere('Field', $column);
        $columnRules = [];

        // Handle varchar, text columns
        if (strpos($details->Type, 'varchar') !== false || strpos($details->Type, 'text') !== false) {
            $columnRules[] = 'string';
            if (preg_match('/\((\d+)\)/', $details->Type, $matches)) {
                $columnRules[] = 'max:' . $matches[1];
            }
        }
        // Handle int columns
        elseif (strpos($details->Type, 'int') !== false) {
            $columnRules[] = 'integer';
        }
        // Handle boolean columns
        elseif (strpos($details->Type, 'boolean') !== false) {
            $columnRules[] = 'boolean';
        }
        // Handle json columns
        elseif (strpos($details->Type, 'json') !== false) {
            $columnRules[] = 'array';
        }
        // Handle enum columns
        elseif (strpos($details->Type, 'enum') !== false) {
            preg_match("/enum\((.*)\)/", $details->Type, $matches);
            $enumValues = str_getcsv($matches[1], ',', "'");
            $columnRules[] = 'in:' . implode(',', $enumValues);
        }

        // Check if column is required (not null)
        if ($details->Null === 'NO' && $details->Default === null) {
            $columnRules[] = 'required';
        }

        // Check if column is unique
        if (strpos($details->Key, 'UNI') !== false) {
            $columnRules[] = "unique:$table,$column";
        }

        // Check if column has foreign key
        if (strpos($details->Key, 'MUL') !== false) {
            $foreignKey = DB::table('information_schema.KEY_COLUMN_USAGE')
                ->where('TABLE_NAME', $table)
                ->where('COLUMN_NAME', $column)
                ->first();

            if ($foreignKey) {
                $referencedTable = $foreignKey->REFERENCED_TABLE_NAME;
                $referencedColumn = $foreignKey->REFERENCED_COLUMN_NAME;
                $columnRules[] = "exists:$referencedTable,$referencedColumn";
            }
        }

        // Store the rules for each column
        $rules[$column] = implode('|', $columnRules);
    }

    return $rules;
}


    protected function generateValidationMessages($rules)
    {
        $messages = [];
        foreach ($rules as $column => $ruleSet) {
            $rulesArray = explode('|', $ruleSet);
            foreach ($rulesArray as $rule) {
                if (strpos($rule, ':') !== false) {
                    [$ruleName, $ruleValue] = explode(':', $rule);
                } else {
                    $ruleName = $rule;
                }

                switch ($ruleName) {
                    case 'required':
                        $messages["$column.required"] = "$column harus diisi.";
                        break;
                    case 'string':
                        $messages["$column.string"] = "$column harus berupa string.";
                        break;
                    case 'max':
                        $messages["$column.max"] = "$column tidak boleh lebih dari $ruleValue karakter.";
                        break;
                    case 'integer':
                        $messages["$column.integer"] = "$column harus berupa integer.";
                        break;
                    case 'boolean':
                        $messages["$column.boolean"] = "$column harus bernilai true atau false.";
                        break;
                    case 'array':
                        $messages["$column.array"] = "$column harus berupa array.";
                        break;
                    case 'in':
                        $messages["$column.in"] = "Pilihan $column tidak valid.";
                        break;
                    case 'unique':
                        $messages["$column.unique"] = "$column telah digunakan.";
                        break;
                    case 'exists':
                        $messages["$column.exists"] = "Pilihan $column tidak valid.";
                        break;
                    default:
                        break;
                }
            }
        }

        return $messages;
    }

    protected function formatValidationRules($rules)
    {
        $formatted = "[\n";
        foreach ($rules as $key => $value) {
            $formatted .= "            '$key' => '$value',\n";
        }
        $formatted .= "        ]";

        return $formatted;
    }

    protected function formatValidationMessages($messages)
    {
        $formatted = "[\n";
        foreach ($messages as $key => $value) {
            $formatted .= "            '$key' => '$value',\n";
        }
        $formatted .= "        ]";

        return $formatted;
    }
}
