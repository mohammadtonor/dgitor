<?php

namespace App\Models\PeriodicService\PeriodicService;

use App\Models\Category\Category\Category;
use App\Models\Category\PreProduct\PreProduct;
use App\Models\Exchange\Exchange\Exchange\Exchange;
use App\Models\Financial\PeriodicService\DetailFin\PeriodicServiceDetailFin;
use App\Models\PeriodicService\Archive\PeriodicServiceArchive;
use App\Models\PeriodicService\Desc\PeriodicServiceDesc;
use App\Models\PeriodicService\Pic\PeriodicServicePic;
use App\Models\PeriodicService\Time\PeriodiceServiceTime;
use App\Models\Product\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PeriodicService extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "periodic_services";
    protected $guarded = [];

    public function product1()
    {
        return $this->belongsTo(Product::class, "product_id");
    }

    public function product2()
    {
        return $this->belongsTo(Product::class, "product_id");
    }

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id");
    }

    public function pre_product()
    {
        return $this->belongsTo(PreProduct::class, "pre_product_id");
    }

    public function descriptions()
    {
        return $this->hasMany(PeriodicServiceDesc::class, "periodic_service_id");
    }

    public function pics()
    {
        return $this->hasMany(PeriodicServicePic::class, "periodic_service_id");
    }

    public function times()
    {
        return $this->hasMany(PeriodiceServiceTime::class, "periodic_service_id");
    }

    public function exchanges()
    {
        return $this->hasMany(Exchange::class, "periodic_service_id");
    }

    public function periodic_service_archives()
    {
        return $this->hasMany(PeriodicServiceArchive::class, "periodic_service_id");
    }

    public function periodic_service_detail_fins()
    {
        return $this->hasMany(PeriodicServiceDetailFin::class, "periodic_service_id");
    }
}
