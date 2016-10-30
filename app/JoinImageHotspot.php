<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JoinImageHotspot extends Model
{
 protected $fillable = ['image_id','spot_id', 'cover', 'delete', 'time_del', 'actif'];
}