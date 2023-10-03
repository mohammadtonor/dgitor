<?php

namespace App\Models\Experting\PublicExperting;

use App\Models\Experting\Experting\Experting;
use App\Models\Experting\Experting\ExpertingQuestion;
use App\Models\Experting\PrivateExperting\PrivateExpertingAnswer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PublicExpertingQuestion extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "public_experting_questions";
    protected $guarded = [];

    public function experting_questions()
    {
        return $this->hasMany(ExpertingQuestion::class, "public_question_id");
    }

    public function public_experting_answers()
    {
        return $this->hasMany(PublicExpertingAnswer::class, "public_experting_id");
    }
}
