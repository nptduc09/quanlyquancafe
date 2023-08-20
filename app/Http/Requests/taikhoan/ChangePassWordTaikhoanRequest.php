<?php

namespace App\Http\Requests\taikhoan;

use Illuminate\Foundation\Http\FormRequest;

class ChangePassWordTaikhoanRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id'               =>        'exists:taikhoans,id',
            'mat_khau_moi'     =>        'required|min:6',
            'kt_mat_khau'      =>        'same:mat_khau_moi',
        ];
    }
    public function messages()
    {
        return [
            'id.*'                    =>  'Tài khoản không tồn tại!',
            'mat_khau_moi.required'   =>  'Mật khẩu không được để trống!',
            'mat_khau_moi.min'        =>  'Mật khẩu phải từ 6 ký tự!',
            'kt_mat_khau.same'        =>  'Mật khẩu không trùng khớp!',

        ];
    }
}
