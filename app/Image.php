<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

	public $fillable = ['name', 'description' ,'cover_image','option_1','option_2','option_3'];

    public function posts() {
    	return $this->belongsTo('App\Exp');
    }
}
