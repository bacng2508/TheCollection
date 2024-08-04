<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'tel' => 'nullable|regex:/(09)[0-9]{8}/',
            'address' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Không được bỏ trống tên',
            'name.max' => 'Tên vượt quá độ dài tối đa',
            'tel.regex' => 'Số điện thoại không hợp lệ',
        ];
    }
}
