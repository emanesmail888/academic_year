<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory;
    protected $fillable = ['class_name', 'school_year_id'];

    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
