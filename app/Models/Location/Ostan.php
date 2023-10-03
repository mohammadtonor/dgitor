<?php

namespace App\Models\Location;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ostan extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "ostans";
    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class, "ostan_id", "id");
    }

    public function cities()
    {
        return $this->hasMany(City::class, "ostan_id", "id");
    }

    public function country()
    {
        return $this->belongsTo(Country::class, "country_id", "id");
    }
}
