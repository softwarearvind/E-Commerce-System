<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
       protected $fillable = [

        'vendor_id',
        'course_category_id',
        'title',
        'slug',
        'thumbnail',
        'description',
        'price',
        'level',
        'type',
        'status',

    ];


    public function category()
    {
        return $this->belongsTo(
            CourseCategory::class,
            'course_category_id'
        );
    }


    public function vendor()
    {
        return $this->belongsTo(
            User::class,
            'vendor_id'
        );
    }

    public function sections()
{
    return $this->hasMany(
        CourseSection::class
    )->orderBy('sort_order');
}

}
