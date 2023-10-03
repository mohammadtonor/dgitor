<?php

namespace App\Models\Experting\PrivateExperting;

use App\Models\Category\Category\Category;
use App\Models\Experting\Experting\Experting;
use App\Models\Experting\Experting\ExpertingQuestion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrivateExpertingQuestion extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "private_experting_questions";
    protected $guarded = [];

    public function experting_questions()
    {
        return $this->hasMany(ExpertingQuestion::class, "private_question_id");
    }

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id");
    }

    public function private_experting_answers()
    {
        return $this->hasMany(PrivateExpertingAnswer::class, "private_experting_id");
    }

}
