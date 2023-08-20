<?php

namespace App\Http\Requests\menu;

use Illuminate\Foundation\Http\FormRequest;

class CreatemenuRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ten_mon'      =>'required|min:5|max:30',
            'slug_mon'     =>'required|min:5|unique:menus,slug_mon',
            'gia_ban'      =>'required|numeric|min:0',
            'tinh_trang'   =>'required|boolean',
            'id_danh_muc'  =>'required|exists:danhmucs,id',
            // 'hinh_anh'      =>'required|mimes:png,jpg',
            'hinh_anh'      =>'required',
        ];
    }

    public function messages()
    {
        return [
            'ten_mon.required'  => 'vui lòng nhập tên món',
            'ten_mon.min'       => 'tên món ít nhất 5 ký tự',
            'ten_mon.max'       => 'tên món tối đa 30 ký tự',
            'slug_mon.*'        => 'Slug đã tồn tại !',
            'gia_ban.*'         => 'giá bán ít nhất 0 đồng',
            'tinh_trang.*'      => 'vui lòng chọn tình trạng theo yêu cầu !',
            'id_danh_muc.*'     => 'Vui lòng chọn danh mục !',
            'hinh_anh.*'        => 'Vui lòng chọn hình ảnh !',
        ];
    }
}
