<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotspot extends Model
{
	 protected $fillable = ['media_id', 'shift_x', 'shift_y', 'shift_z', 'position_x', 'position_y',
	'position_z', 'depth', 'latitude', 'longitude','exp_id', 'image_id', 'image_link',
	'description', 'delete','time_del', 'option_1', 'option_2', 'option_3', 'option_photo', 'option_video'];   
}
