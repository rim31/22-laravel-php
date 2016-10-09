<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exp extends Model
{
    protected $fillable = ['name','id_exp','name_owner','adress','surface','price','rooms','parking',
    'lift','level','availability','electricity','class_nrj','class_gaz','photo','video','option', 'online'];

    // public funtion scopePublished($query){
    //     return $query->where('availability', 1);
    // }

    // $categories = Category::with(['posts' => function ($q) {
    //   $q->published();
    // }])->get();

    // public function postsPublished()
    // {
    //    return $this->hasMany('Post')->published();
    //    // or this way:
    //    // return $this->posts()->published();
    // }
}
