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


    public function getNumberOfClasses():int
    {
        return $this->schoolClasses()->count();
    }
}
