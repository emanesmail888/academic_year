<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;



class SchoolClass extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['class_name', 'school_year_id'];

    public function schoolYear():BelongsTo
    {
        return $this->belongsTo(SchoolYear::class);
    }

    public function subjects():HasMany
    {
        return $this->hasMany(Subject::class);
    }


}
