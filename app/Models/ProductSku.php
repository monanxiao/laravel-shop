<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\InternalException;

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

    // 下单 减少 库存
    public function decreaseStock($amount)
    {
        if ($amount < 0) {
            throw new InternalException('减库存不可小于0');
        }

        return $this->where('id', $this->id)->where('stock', '>=', $amount)->decrement('stock', $amount);
    }

    // 关闭订单 增加 库存
    public function addStock($amount)
    {
        if ($amount < 0) {
            throw new InternalException('加库存不可小于0');
        }
        $this->increment('stock', $amount);
    }
}
