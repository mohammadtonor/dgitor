<?php

namespace App\Models\Location;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "countries";
    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class, "country_id", "id");
    }

    public function ostans()
    {
        return $this->hasMany(Ostan::class, "country_id", "id");
    }
}
