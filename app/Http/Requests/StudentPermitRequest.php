<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentPermitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'student_id' => 'required|exists:students,id',
            'teacher_id' => 'required|exists:teachers,id',
            'from' => 'required',
            'to' => 'required',
            'reason' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'attachment' => 'nullable|string|max:255',
            'note' => 'nullable|string|max:255',
        ];
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['name'] = 'sometimes|string|max:255';
            $rules['nisn'] = 'sometimes|unique:students,nisn,' . ($this->student?->id ?? 'NULL');
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'student_id.required' => 'Santri harus dipilih.',
            'student_id.exists' => 'Santri tidak valid.',
            'teacher_id.required' => 'Guru harus dipilih.',
            'teacher_id.exists' => 'Guru tidak valid.',
            'from.required' => 'Dari waktu harus diisi.',
            'to.required' => 'Sampai waktu harus diisi.',
            'reason.required' => 'Sebab harus diisi.',
            'note.max' => 'Catatan maksimal 255 karakter.',
        ];
    }
}
