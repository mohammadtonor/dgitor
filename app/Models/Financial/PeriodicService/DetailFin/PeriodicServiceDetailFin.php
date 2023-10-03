<?php

namespace App\Models\Financial\PeriodicService\DetailFin;

use App\Models\Financial\PeriodicService\DetailFinTrans\PeriodicServiceDetailFinTrans;
use App\Models\PeriodicService\PeriodicService\PeriodicService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PeriodicServiceDetailFin extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "periodic_service_detailfins";
    protected $guarded = [];

    public function periodic_service()
    {
        return $this->belongsTo(PeriodicService::class, "periodic_service_id");
    }

    public function periodic_service_detail_fin_trans()
    {
        return $this->hasMany(PeriodicServiceDetailFinTrans::class, "detailfin_id");
    }
}
