<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetCredentialRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'middle_name' => 'max:50',
            'password' => 'required|min:6|max:50',
            'password_confirmation' => 'required|same:password|max:50',
        ];
    }
}
