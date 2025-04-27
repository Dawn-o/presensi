<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'current_password' => ['required'],
            'password' => ['required', 'min:8', 'confirmed'],
        ];
    }

    public function attributes()
    {
        return [
            'current_password' => 'Password saat ini',
            'password' => 'Password baru',
        ];
    }
}