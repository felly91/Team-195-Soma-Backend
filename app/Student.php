<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $fillable=['user_id','lesson_id'];
    protected $table="student";
}
