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

class HotspotController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Exp $exp)
    {
        return view('hotspot.create');
    }

    public function demo(Exp $exp)
    {
        return view('hotspot.demo');
    }

    public function carousel(Exp $exp)
    {
        return view('hotspot.test');
    }


        public function cover(Request $request, Exp $exp)
    {
        echo "Coucou : controller Cover dans PhototController";
        var_dump($request);
        die();
        var_dump($exp->id);
        $exps = Exp::all();
        $users = JoinUserExp::all();
        $images = Image::all();
        $joins = JoinExpImage::all();

        return view('/', compact('exps', 'users', 'images', 'joins', 'exp'));
    }

        public function demo2(Request $request, Exp $exp, Image $image)
    {
        echo "Coucou : controller Cover dans PhototController";
        var_dump($request->name);die();
        return view('hotspot.demo');
    }
}
