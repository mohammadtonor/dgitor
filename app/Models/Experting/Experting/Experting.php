<?php

namespace App\Models\Experting\Experting;

use App\Models\Experting\Type\ExpertingType;
use App\Models\Financial\Experting\DetailFin\ExpertingDetailFin;
use App\Models\Product\Product\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Experting extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "expertings";
    protected $guarded = [];

    public function register_user()
    {
        return $this->belongsTo(User::class, "register_user_id");
    }

    public function karshenas_user()
    {
        return $this->belongsTo(User::class, "karshenas_user_id");
    }

    public function product()
    {
        return $this->belongsTo(Product::class, "product_id");
    }

    public function answers()
    {
        return $this->hasMany(ExpertingAnswer::class, "experting_id");
    }

    public function experting_detailfin()
    {
        return $this->hasMany(ExpertingDetailFin::class, "experting_id");
    }

    public function experting_type()
    {
        return $this->belongsTo(ExpertingType::class, "type_id");
    }
}
