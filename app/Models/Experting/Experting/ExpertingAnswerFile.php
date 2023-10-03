<?php

namespace App\Models\Experting\Experting;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpertingAnswerFile extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "experting_answer_files";
    protected $guarded = [];

    public function experting_answer()
    {
        return $this->belongsTo(ExpertingAnswer::class, "experting_answer_id");
    }

    public function register_user()
    {
        return $this->belongsTo(User::class, "register_user_id");
    }
}
