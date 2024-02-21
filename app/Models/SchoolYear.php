<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\SoftDeletes;



class SchoolYear extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['year'];
    protected $dates = ['deleted_at'];


    public function schoolClasses(): HasMany
    {
        return $this->hasMany(SchoolClass::class);
    }

    public function subjects(): HasManyThrough
    {
        return $this->hasManyThrough(Subject::class, SchoolClass::class,'school_year_id','school_class_id');
    }

    public static function yearWithSubjects()
    {
        return self::with('subjects');
    }


    public function exams(): HasManyThrough
    {
        return $this->hasManyThrough(ExamQuestion::class, Question::class,'subject_id','exam_id');
    }

    public static function getYearsWithExams()
    {
        return self::with('exams');
    }


    public function getNumberOfClasses()
    {
        return $this->schoolClasses()->count();
    }
}
