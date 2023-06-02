<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'main_image' => 'required|file',
            'preview_image' => 'required|file',
            'name' => 'required|string',
            'amount' => 'required|decimal:2',
            'content' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'size' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Это поле необходимо заполнить',
            'name.string' => 'Данные должны соответствовать строчному типу',
            'content.required' => 'Это поле необходимо заполнить',
            'content.string' => 'Данные должны соответствовать строчному типу',
            'preview_image.required' => 'Это поле необходимо заполнить',
            'preview_image.file' => 'Необходимо выбрать файл',
            'main_image.required' => 'Это поле необходимо заполнить',
            'main_image.file' => 'Необходимо выбрать файл',
            'category_id.required' => 'Это поле необходимо заполнить',
            'category_id.integer' => 'Id категории должен быть числом',
            'category_id.exists' => 'Id категории должен быть в базе данных',
        ];
    }
}
