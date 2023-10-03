<?php

namespace App\Models\Exchange\Exchange\Exchange;

use App\Models\Category\Category\Category;
use App\Models\Category\PreProduct\PreProduct;
use App\Models\Exchange\Exchange\AttrDefaultValExchange\AttrDefaultValExchange;
use App\Models\Exchange\Exchange\AttrValue\ExchangeAttrValue;
use App\Models\Exchange\Exchange\Status\ExchangeStatus;
use App\Models\Financial\Exchange\DetailFin\ExchangeDetailFin;
use App\Models\PeriodicService\PeriodicService\PeriodicService;
use App\Models\Product\Product\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exchange extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "exchanges";
    protected $guarded = [];

    public function product1()
    {
        return $this->belongsTo(Product::class, "product1_id");
    }

    public function product2()
    {
        return $this->belongsTo(Product::class, "product2_id");
    }

    public function attr_values()
    {
        return $this->hasMany(ExchangeAttrValue::class, "exchange_id");
    }

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id");
    }

    public function pre_product()
    {
        return $this->belongsTo(PreProduct::class, "pre_product_id");
    }

    public function status()
    {
        return $this->belongsTo(ExchangeStatus::class, "status_id");
    }

    public function attr_default_val_exchanges()
    {
        return $this->hasMany(AttrDefaultValExchange::class, "default_value_id");
    }

    public function periodic_service()
    {
        return $this->belongsTo(PeriodicService::class, "periodic_service_id");
    }

    public function user1()
    {
        return $this->belongsTo(User::class, "register_user1_id");
    }

    public function user2()
    {
        return $this->belongsTo(User::class, "register_user2_id");
    }

    public function exchange_detail_fins()
    {
        return $this->hasMany(ExchangeDetailFin::class, "exchange_id");
    }
}
