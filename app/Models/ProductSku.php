<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSku extends Model
{
    use HasFactory;
    // 批量赋值 字段白名单
    protected $fillable = ['title', 'description', 'price', 'stock'];

    // 反向关联，多个 sku 属于1个商品
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
