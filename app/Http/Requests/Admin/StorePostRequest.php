<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => ["required", "max:550", "string"],
            'body' => ["required"],
            'image' => ['mimes:jpeg,jpg,png,gif', 'max:2000'],
            'user_id' => ["required"],
            'category_id' => ["required"]
        ];
    }
}
