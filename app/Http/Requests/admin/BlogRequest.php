<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'title' => 'required',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required',
            'content' => 'required',
        ];
    }

    public function messages():array
    {
        return [
            'required'=>':attribute :Không được để trống',
            'max'=>':attribute :Không được quá :max ký tự',
            'avatar' => ':attribute :Hình ảnh upload lên phải là hình ảnh',
            'mimes' => ':attribute :Hình ảnh upload lên phải có định dạng như sau: jpeg,png,jpg,gif',
            'avatar.max' => ':attribute :Hình ảnh upload lên vượt quá kích thước cho phép :max'
        ];
    }
}
