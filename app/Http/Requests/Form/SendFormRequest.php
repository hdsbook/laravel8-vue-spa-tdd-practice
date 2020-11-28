<?php

namespace App\Http\Requests\Form;

use Illuminate\Foundation\Http\FormRequest;

class SendFormRequest extends FormRequest
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
            'form_name' => 'required',
            'form_template_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'form_name.required' => '表單名稱為必填！',
            'form_template_id.required' => '請選擇表單模版！',
            'form_template_id.integer' => '表單模版不存在！',
        ];
    }
}
