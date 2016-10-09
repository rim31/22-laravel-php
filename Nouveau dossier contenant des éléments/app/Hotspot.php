<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotspot extends Model
{
    protected $fillable= ['id',
'name',
'id_exp',
'name_owner',
'adress',
'surface',
'price',
'rooms',
'parking',
'lift',
'level',
'availability',
'electricity',
'class_nrj',
'class_gaz',
'photo',
'video',
'option_1',
'option_2',
'option_3', 'online']

}
