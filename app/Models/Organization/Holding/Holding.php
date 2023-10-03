<?php

namespace App\Models\Organization\Holding;

use App\Models\Organization\Organization\Organization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Holding extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "holdings";
    protected $guarded = [];

    public function organizations()
    {
       return $this->hasMany(Organization::class, "holding_id");
    }
}
