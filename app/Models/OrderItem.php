<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'price', 'rating', 'review', 'reviewed_at'];
    protected $dates = ['reviewed_at'];
    public $timestamps = false;

    // 每个订单 对应 1个商品
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // 每个订单对应1个 skus
    public function productSku()
    {
        return $this->belongsTo(ProductSku::class);
    }

    // 每个订单对应1个订单
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
