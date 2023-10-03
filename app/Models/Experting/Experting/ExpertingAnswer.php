<?php

namespace App\Models\Experting\Experting;

use App\Models\Experting\PrivateExperting\PrivateExpertingAnswer;
use App\Models\Experting\PublicExperting\PublicExpertingAnswer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpertingAnswer extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "experting_answers";
    protected $guarded = [];

    public function experting()
    {
        return $this->belongsTo(Experting::class, "experting_id");
    }

    public function files()
    {
        return $this->hasMany(ExpertingAnswerFile::class, "experting_answer_id");
    }

    public function private_answer()
    {
        return $this->belongsTo(PrivateExpertingAnswer::class, "private_experting_answer_id");
    }

    public function public_answer()
    {
        return $this->belongsTo(PublicExpertingAnswer::class, "public_experting_answer_id");
    }

    public function experting_question()
    {
        return $this->belongsTo(ExpertingQuestion::class, "experting_question_id");
    }
}
