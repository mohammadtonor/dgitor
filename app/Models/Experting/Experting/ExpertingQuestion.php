<?php

namespace App\Models\Experting\Experting;

use App\Models\Experting\PrivateExperting\PrivateExpertingQuestion;
use App\Models\Experting\PublicExperting\PublicExpertingQuestion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpertingQuestion extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "experting_questions";
    protected $guarded = [];

    public function private_question()
    {
        return $this->belongsTo(PrivateExpertingQuestion::class, "private_question_id");
    }

    public function public_question()
    {
        return $this->belongsTo(PublicExpertingQuestion::class, "public_question_id");
    }

    public function experting()
    {
        return $this->belongsTo(Experting::class, "experting_id");
    }

    public function experting_answers()
    {
        return $this->hasMany(ExpertingAnswer::class, "experting_question_id");
    }
}
