<?php

namespace App\Models\Experting\PrivateExperting;

use App\Models\Experting\Experting\ExpertingAnswer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrivateExpertingAnswer extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "private_experting_answers";
    protected $guarded = [];

    public function private_experting()
    {
        return $this->belongsTo(PrivateExpertingQuestion::class, "private_experting_id");
    }

    public function experting_answers()
    {
        return $this->hasMany(ExpertingAnswer::class, "private_experting_answer_id");
    }
}
