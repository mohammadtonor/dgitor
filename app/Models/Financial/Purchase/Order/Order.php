<?php

namespace App\Models\Financial\Purchase\Order;

use App\Models\Financial\Purchase\DetailFin\PurchaseDetailFin;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{

    public const ORDER_SABT=1;
    public const ORDER_OPEN=2;
    public const ORDER_EGHDAM=3; //dar hal tamin kala
    public const ORDER_ERSAL=4;
    public const ORDER_CLOSE=5;
    public const ORDER_CANCEL=6;
    public const ORDER_TAHVIL=7;

    use HasFactory,SoftDeletes;
    protected $table = "orders";
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function orderdetails()
    {
        return $this->hasMany(OrderDetail::class, "order_id");
    }

    public function purchase_detail_fins()
    {
        return $this->hasMany(PurchaseDetailFin::class, "order_id");
    }
}
