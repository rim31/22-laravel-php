<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JoinExpImage extends Model
{
    protected $fillable = ['exp_id','image_id', 'delete','time_del', 'cover', 'actif'];
}
