<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    //
    protected $table="lesson";
    protected $fillable=['lesson_number','name','writing_explanation','video_link'];

    public function course()
    {
        return $this->belongsTo("App\Course");
    }
}
