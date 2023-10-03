<?php

namespace App\Models\User\BankAccount;

use App\Models\Location\City;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserBankAccount extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "user_bank_accounts";
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function city()
    {
        return $this->belongsTo(City::class, "city_id");
    }

}
