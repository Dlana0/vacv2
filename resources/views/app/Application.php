<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = ['user_id','vacancy_id','status','education','comments','archievments','type'];
}
