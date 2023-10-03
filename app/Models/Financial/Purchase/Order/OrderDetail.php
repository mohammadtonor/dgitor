<?php

namespace App\Models\Financial\Purchase\Order;

use App\Models\Product\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{

    public const ORDER_SABT=1;
    public const ORDER_OPEN=2;
    public const ORDER_EGHDAM=3; //dar hal tamin kala
    public const ORDER_WAIT_TAMIN=7;
    public const ORDER_NOT_TAMIN=9;
    public const ORDER_TAMIN=8;
    public const ORDER_ERSAL=4;
    public const ORDER_CLOSE=5;
    public const ORDER_CANCEL=6;

    use HasFactory,SoftDeletes;
    protected $table = "orderdetails";
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class, "order_id");
    }

    public function product()
    {
        return $this->belongsTo(Product::class, "product_id");
    }
}
