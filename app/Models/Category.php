<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'status',
    ];
    //Bắt mqh với bảng nào thì dùng tên bảng đó làm function
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
