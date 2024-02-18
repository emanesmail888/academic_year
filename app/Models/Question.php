<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['question_name', 'subject_id'];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }


    public function exams()
    {
        return $this->belongsToMany(Exam::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    public function correctAnswer()
    {
        return $this->hasOne(Answer::class)->where('correct_answer', true);
    }






}
