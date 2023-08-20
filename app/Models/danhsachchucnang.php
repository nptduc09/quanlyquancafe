<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class danhsachchucnang extends Model
{
    use HasFactory;
    protected $table = 'danhsachchucnangs';
    protected $fillable = [
        'danh_sach_chuc_nang',

    ];
}
