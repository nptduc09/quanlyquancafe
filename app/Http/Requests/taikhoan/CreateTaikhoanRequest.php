<?php

namespace App\Http\Requests\taikhoan;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaikhoanRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ho_va_ten'         =>  'required|min:5',
            'email'             =>  'required|email|unique:taikhoans,email',
            'so_dien_thoai'     =>  'required|digits:10',
            'ngay_sinh'         =>  'required|date',
            'password'          =>  'required',
            'kt_mat_khau'       =>  'required|same:password',
            'id_quyen'          =>  'required|exists:quyens,id',

        ];
    }

    public function messages()
    {
        return [
            'ho_va_ten.*'         =>  'Họ và tên ít nhất 5 ký tự!',
            'email.required'      =>  'Email không được để trống!',
            'email.email'         =>  'Email không đúng định dạng!',
            'so_dien_thoai.*'     =>  'Số điện thoại phải là 10 số!',
            'ngay_sinh.*'         =>  'Ngày sinh không được để trống!',
            'password.*'          =>  'Mật khẩu không được để trống!',
            'kt_mat_khau.*'       =>  'Mật khẩu không trùng khớp!',
            'id_quyen.*'          =>  'Không được để trống quyền!',
        ];
    }
}
