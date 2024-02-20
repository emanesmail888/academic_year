<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Exam extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['exam_name', 'exam_date'];

    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }
    public static function questionsWithExams()
    {
        return self::with('exams');
    }

}
