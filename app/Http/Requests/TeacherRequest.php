<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
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
            'name' => 'required',
            'full_name' => 'required',

            'ktp' => 'required|integer|unique:teachers',
            'phone' => 'nullable',
            'birth_date' => 'required',
            'birth_place' => 'required',
            'address' => 'nullable',
            'room_id' => 'nullable',
            'classes_id' => 'nullable',
            'gender' => 'required|in:male,female',
            'type' => 'required|in:teacher,companion,headmaster',
            'secondary_type' => 'nullable|in:teacher,companion,headmaster',
        ];
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['ktp'] = 'sometimes|string|max:255';
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama ustadz wajib diisi',
            'full_name.required' => 'Nama lengkap ustadz wajib diisi',
            'ktp.required' => 'KTP wajib diisi',
            'ktp.unique' => 'KTP sudah terdaftar',
            'gender.required' => 'Jenis kelamin ustadz wajib diisi',
            'gender.in' => 'Jenis kelamin tidak valid',
            'phone.nullable' => 'Nomor telepon ustadz boleh kosong',
            'address.nullable' => 'Alamat ustadz boleh kosong',
            'room_id.nullable' => 'Kamar ustadz boleh kosong',
            'classes_id.nullable' => 'Kelas ustadz boleh kosong',
            'birth_date.required' => 'Tanggal lahir ustadz wajib diisi',
            'birth_place.required' => 'Tempat lahir ustadz wajib diisi',
            'type.required' => 'Tipe ustadz wajib diisi',
            'type.in' => 'Tipe ustadz tidak valid',
            'secondary_type.in' => 'Tipe ustadz tidak valid',
        ];
    }
}
