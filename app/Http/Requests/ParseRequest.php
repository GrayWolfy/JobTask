<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ParseRequest
 * @package App\Http\Requests
 *
 * @property string $uri
 */
class ParseRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'uri' => ['string'],
        ];
    }
}
