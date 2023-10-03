<?php

namespace App\Models\PeriodicService\Desc;

use App\Models\PeriodicService\PeriodicService\PeriodicService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PeriodicServiceDesc extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "periodic_service_descs";
    protected $guarded = [];

    public function periodic_service()
    {
        return $this->belongsTo(PeriodicService::class, "periodic_service_id");
    }
}
