<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'title' => 'required|max:255',
            'text' => 'required|max:2000',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Поле Заголовок обязательное',
            'text.required' => 'Поле Описание обязательное',
        ];
    }
}
