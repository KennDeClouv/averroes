<?php

/**
 * File ini dibuat secara otomatis oleh perintah MakeFormRequest.
 * Kamu dapat memodifikasi file ini.
 */
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'integer|required|exists:users,id',
            'recipient_id' => 'integer|required|exists:users,id',
            'read' => 'integer',
            'message' => 'string|required',
        ];
    }

    public function messages()
    {
        return [
            'user_id.integer' => 'user_id harus berupa integer.',
            'user_id.required' => 'user_id harus diisi.',
            'user_id.exists' => 'Pilihan user_id tidak valid.',
            'recipient_id.integer' => 'recipient_id harus berupa integer.',
            'recipient_id.required' => 'recipient_id harus diisi.',
            'recipient_id.exists' => 'Pilihan recipient_id tidak valid.',
            'read.integer' => 'read harus berupa integer.',
            'message.string' => 'message harus berupa string.',
            'message.required' => 'message harus diisi.',
        ];
    }
}
