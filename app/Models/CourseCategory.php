<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'status',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
