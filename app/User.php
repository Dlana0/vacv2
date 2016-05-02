<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    //
    protected $table = 'users';
    protected $fillable = ['name','username','email','password','type'];
    
}
