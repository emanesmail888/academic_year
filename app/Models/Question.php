<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;





class Question extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['question_name', 'subject_id'];

    public function subject():BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }


    public function exams()
    {
        return $this->belongsToMany(Exam::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
    public function correctAnswer():HasOne
    {
        return $this->hasOne(Answer::class)->where('correct_answer', true);
    }






}
