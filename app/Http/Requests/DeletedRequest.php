<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class IndexRequest
 * @package App\Http\Requests
 *
 * @property $filter
 */
class DeletedRequest extends FormRequest
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
            'filter' => ['numeric'],
        ];
    }
}
