<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class EntriesByReadRequest
 * @package App\Http\Requests
 *
 * @property string $read
 */
class EntriesByReadRequest extends FormRequest
{
    protected $read;

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
            'read' => 'required|integer|in:0, 1',
        ];
    }
}
