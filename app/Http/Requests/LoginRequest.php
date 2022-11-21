<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LoginRequest
 * @property string $email
 * @property string $password
 * @package App\Http\Requests
 */
class LoginRequest extends  FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }
}
