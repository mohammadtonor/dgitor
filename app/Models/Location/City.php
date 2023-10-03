<?php

namespace App\Models\Location;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "cities";
    protected $guarded = [];

    public function ostan()
    {
        return $this->belongsTo(Ostan::class, "ostan_id", "id");
    }

    public function users()
    {
        return $this->hasMany(User::class, "city_id", "id");
    }
}
