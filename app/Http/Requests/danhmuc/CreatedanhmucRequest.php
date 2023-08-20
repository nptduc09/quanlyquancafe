<?php

namespace App\Http\Requests\danhmuc;

use Illuminate\Foundation\Http\FormRequest;

class CreatedanhmucRequest extends FormRequest
{
    public function authorize()
    {
        return True;
    }

    public function rules()
    {
        return [
            'ten_danh_muc'           => 'required|min:4|max:30',
            'slug_danh_muc'          => 'required|min:4|unique:danhmucs,slug_danh_muc',
            'tinh_trang'             => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'ten_danh_muc.required'      => 'Vui lòng nhập tên danh mục',
            'ten_danh_muc.min'           => 'Tên danh_muc ít nhất 5 ký tự',
            'ten_danh_muc.max'           => 'Tên danh_muc tối đa 30 ký tự',
            'slug_danh_muc.required'     => 'Slug danh_muc đã tồn tại ',
            'tinh_trang.required'        => 'Vui lòng nhập đúng tình trạng',
        ];
    }
}
