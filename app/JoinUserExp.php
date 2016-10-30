<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JoinUserExp extends Model
{
    protected $fillable = ['id_user','id_exp', 'delete', 'time_del', 'actif'];
}
