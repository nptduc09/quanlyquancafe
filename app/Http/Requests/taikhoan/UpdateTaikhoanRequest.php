<?php

namespace App\Http\Requests\taikhoan;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaikhoanRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

            'id'                =>  'required|exists:taikhoans,id',

            'ho_va_ten'         =>  'required|min:5',
            'so_dien_thoai'     =>  'required|digits:10',
            'ngay_sinh'         =>  'required|date',
            'id_quyen'          =>  'required',
        ];
    }

    public function messages()
    {
        return [
            'id.*'                =>  'Nhà cung cấp không tồn tại!',
            'ho_va_ten.*'         =>  'Họ và tên không được để trống!',
            'so_dien_thoai.*'     =>  'Số điện thoại phải là 10 số!',
            'ngay_sinh.*'         =>  'Ngày sinh không được để trống!',
            'id_quyen.*'          =>  'Không được để trống quyền!',
        ];
    }
}
