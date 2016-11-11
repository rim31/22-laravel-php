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
use App\Http\Requests\ExpRequest;


use \Storage;
use File;
use DB;

class ExtraController extends Controller
{


      public function cover(Request $request, Exp $exp)
    {
      $exps = Exp::all();
      //remise a zero du la photo de couverture et on injecte le numero de l'id phot dans l'exp->photo
      DB::table('exps')
                ->where('id', $request->exp)
                ->update(['photo' => $request->id]);
      $exp->id = $request->exp;
      return redirect()->route('exp.photo.index', [$exp])->with('message', 'Image favorite ajoutée !');
    //   return view('exps.photos.index', compact('exps', 'users', 'joins', 'exp'));
    }


}
