<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

	public $fillable = ['name', 'description' ,'cover_image','option_1','option_2','option_3', 'delete', 'time_del', 'actif'];

    public function posts() {
    	return $this->belongsTo('App\Exp');
    }
}
