<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Subject extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['subject_name','school_class_id'];
    protected $dates = ['deleted_at'];



    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }





}
