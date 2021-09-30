<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['amount'];
    public $timestamps = false;

    // 购物车属于1个用户
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 属于多个sku
    public function productSku()
    {
        return $this->belongsTo(ProductSku::class);
    }
}
