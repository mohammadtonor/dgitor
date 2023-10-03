<?php

namespace App\Models\Experting\PublicExperting;

use App\Models\Experting\Experting\ExpertingAnswer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PublicExpertingAnswer extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "public_experting_answers";
    protected $guarded = [];

    public function public_experting()
    {
        return $this->belongsTo(PublicExpertingQuestion::class, "public_experting_id");
    }

    public function experting_answers()
    {
        return $this->hasMany(ExpertingAnswer::class, "public_experting_answer_id");
    }
}
