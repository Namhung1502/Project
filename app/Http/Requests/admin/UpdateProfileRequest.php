<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:191',
            'password' => 'nullable|min:8',
            // 'email' => 'required|email|unique:users',
            'phone' => 'required|numeric|digits:10',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048'

        ];
    }
    public function messages()
    {
        return [
            'required'=>':attribute :Không được để trống',
            'max'=>':attribute :Không được quá :max ký tự',
            'min' => ':attribute :Không được nhỏ hơn :min kí tự',
            'phone.numeric' => ':attribute :Phải có giá trị là số',
            'digits' => ':attribute :Phải là số nguyên có độ dài :digits',
            // 'email.email'=>':attribute :email sai định dạng',
            // 'email.unique'=>':attribute :email đã tồn tại',
            'avatar' => ':attribute :Hình ảnh upload lên phải là hình ảnh',
            'mimes' => ':attribute :Hình ảnh upload lên phải có định dạng như sau: jpeg,png,jpg,gif',
            'avatar.max' => ':attribute :Hình ảnh upload lên vượt quá kích thước cho phép :max'
        ];
    }
}
