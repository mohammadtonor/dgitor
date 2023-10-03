<?php

namespace App\Models\User\Madarek;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Madarek extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "user_madareks";
    protected $guarded = [];

    public function owner_user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function uploader_user()
    {
        return $this->belongsTo(User::class, "uploader_user_id");
    }
}
