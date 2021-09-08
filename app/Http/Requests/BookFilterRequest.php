<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookFilterRequest extends FormRequest
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
            'title' => 'string|nullable',
            'publisher' => 'string|nullable',
            'author' => 'string|nullable',
            'category' => 'string|nullable',
            'rating[0]' => 'integer|between:1,5|lte:rating[1]|nullable',
            'rating[1]' => 'integer|between:1,5|gte:rating[0]|nullable',
        ];
    }
}
