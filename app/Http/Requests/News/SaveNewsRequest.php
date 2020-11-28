<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;

class SaveNewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'content' => 'required|min:10',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '標題為必填！',
            'content.required' => '內容為必填！',
            'content.min' => '內容最少需10個字以上！',
        ];
    }
}
