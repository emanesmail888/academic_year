<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Exam extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['exam_name', 'exam_date','subject_id'];

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class);
    }
    public static function questionsWithExams()
    {
        return self::with('exams');
    }

    public function subject():BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

}
