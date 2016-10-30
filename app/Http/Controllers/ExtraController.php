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

    
  public function cover(Request $request, Exp $exp)
{
  echo "Coucou : controller Cover dans PhototController";
  var_dump($request->photo);
  die();
  var_dump($exp->id);
  $exps = Exp::all();
  $users = JoinUserExp::all();
  $images = Image::all();
  $joins = JoinExpImage::all();
  // $up = Exp::where('id', $exp->id)->get();

  //remise a zero du la photo de couverture
  DB::table('users')
            ->where('id', $exp->id)
            ->update(['photo' => $request->photo]);

  // $joins = JoinExpImage::where('exp_id', $exp->id)->get();

   return view('/', compact('exps', 'users', 'images', 'joins', 'exp'));
}




  public function demo2(Request $request, Exp $exp, Image $image)
{
  echo "Coucou : controller Cover dans PhototController";
  var_dump($request->name);die();
  return view('demo.demo');
}
}
