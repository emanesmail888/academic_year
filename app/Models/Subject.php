<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = ['subject_name','school_class_id'];


    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

   



}
