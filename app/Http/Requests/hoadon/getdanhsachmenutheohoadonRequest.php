<?php

namespace App\Http\Requests\hoadon;

use Illuminate\Foundation\Http\FormRequest;

class getdanhsachmenutheohoadonRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'id_hoa_don_ban_hang' => 'required|exists:hoadonbanhangs,id',
        ];
    }
    public function messages()
    {
        return[
            'id_hoa_don_ban_hang.*'               => 'Hóa đơn bán hàng không tồn tại !',
        ];
    }
}
