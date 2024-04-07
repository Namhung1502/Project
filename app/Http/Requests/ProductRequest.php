<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required',
            'price' => 'required|numeric',
            'id_category' => 'required|exists:categorys,id',
            'id_brand' => 'required|exists:brands,id',
            'status' => 'nullable|numeric',
            'company' => 'nullable|max:2048',
            'image[]' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
            'detail' => 'nullable|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'required'=>':attribute :Không được để trống',
            'price.numeric'=>':attribute :phải là số',
            'status.numeric'=>':attribute :phải là số',
            'id_category.exists'=>':attribute :phải chọn',
            'id_brand.exists'=>':attribute :phải chọn',
            'max'=>':attribute :Không được quá :max ký tự',
            'image' => ':attribute :Hình ảnh upload lên phải là hình ảnh',
            'mimes' => ':attribute :Hình ảnh upload lên phải có định dạng như sau: jpeg,png,jpg,gif',
            'image.max' => ':attribute :Hình ảnh upload lên vượt quá kích thước cho phép :max'
        ];
    }
}
