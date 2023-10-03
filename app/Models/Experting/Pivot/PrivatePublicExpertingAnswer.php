<?php

namespace App\Models\Experting\Pivot;

use App\Models\Experting\Experting\Experting;
use App\Models\Experting\Experting\ExpertingAnswer;
use App\Models\Experting\PrivateExperting\PrivateExpertingQuestion;
use App\Models\Experting\PublicExperting\PublicExpertingQuestion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrivatePublicExpertingAnswer extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "private_public_experting_answer";
    protected $guarded = [];

    public function experting()
    {
        return $this->belongsTo(Experting::class, "experting_id");
    }

    public function experting_answer()
    {
        return $this->belongsTo(ExpertingAnswer::class, "experting_answer_id");
    }

    public function public_experting_question()
    {
        return $this->belongsTo(PublicExpertingQuestion::class, "public_question_id");
    }

    public function private_experting_question()
    {
        return $this->belongsTo(PrivateExpertingQuestion::class, "private_question_id");
    }

}

