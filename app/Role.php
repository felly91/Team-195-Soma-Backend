<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $fillable=['name'];
    protected $table="role";

    public function users()
    {
        return $this->hasMany("App\User");
    }
}
