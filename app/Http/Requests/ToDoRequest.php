<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ToDoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'max_img' => 'required|image',
            'tag' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле название необходимо заполнить',
            'tag.required' => 'Поле теги необходимо заполнить',
            'max_img.required' => 'Необходимо загрузить картинку',
            'max_img.image' => 'Выберите файл с расширением jpg, jpeg, png, bmp, gif, svg или webp',
        ];
    }
}
