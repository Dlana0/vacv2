<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    //
    protected $table = 'vacancies';
    protected $fillable = ['title','description','requirements','knowledge','obligations','duration','user_id'];
}
