<?php

namespace App\Http\Requests\Api;

class AuthorizationsRequest extends Request
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
            'email' => [
                'required',
                'exists:users',
            ],
            'password' => 'required|string|min:6|max:20',
        ];
    }
}
