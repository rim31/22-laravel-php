<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\Controller;
use App\UploadedFile;
use App\Exp;
use App\Image;
use App\JoinExpImage;
use App\JoinUserExp;
use App\Http\Requests;

use \Storage;
use File;
use DB;

class ExtraController extends Controller
{
    /***
    *
    *
    <!-- {!! Form::open(array('route'=>['cover', $exp->id, $image->id], 'method'=>'POST'))!!}
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="text" name="exp" value="{{$exp->id}}" hidden>
    <input type="text" name="photo" value="{{image->id}}" hidden>
    {!! Form::button('Choix', ['class'=>'btn btn-default', 'type'=>'submit']) !!}
    {!! Form::close() !!} -->
    *
    *
    ***/
    public function cover(Request $request, Exp $exp, Image $image)
    {
        // var_dump ($exp);
        // var_dump ($image);
        var_dump ($request->exp);
        var_dump ($request->photo);
        echo "\n Coucou : controller Cover dans PhototController";
        //mettre la photo de couverture dans la base de données adéquat
        // $posts = DB::table('exps')->get();
        $covers = DB::select('select * from images where cover_image = ?', [1]);
        var_dump ($covers);
        // die();

        // $covers->cover_image = '0';

        $users = JoinUserExp::all();
        $images = Image::all();
        $joins = JoinExpImage::all();
        // die();

        return redirect()->route('exp.photo.index', [$request->exp])->with('message', 'Photo de couverture à jour !');


    }

}
