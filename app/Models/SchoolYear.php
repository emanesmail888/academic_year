<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    use HasFactory;
    protected $fillable = ['year'];

    public function schoolClasses()
    {
        return $this->hasMany(SchoolClass::class);
    }
    public function subjects()
    {
        return $this->hasManyThrough(Subject::class, SchoolClass::class,'school_year_id','school_class_id');
    }

    public static function yearWithSubjects()
    {
        return self::with('subjects');
    }


    public function exams()
    {
        return $this->hasManyThrough(ExamQuestion::class, Subject::class,'school_class_id','subject_id');
    }

    public static function getYearsWithExams()
    {
        return self::with('exams');
    }
    public static function yearWithExams()
    {
        return self::with('exams');
    }

    public function getNumberOfClasses()
    {
        return $this->schoolClasses()->count();
    }
}
