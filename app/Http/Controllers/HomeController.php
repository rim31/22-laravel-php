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

class HomeController extends Controller
{
    public function welcome(){
        $exps = Exp::all();
        $users = JoinUserExp::all();
        $images = Image::all();
        $joins = JoinExpImage::all();

        return view('welcome', compact('exps', 'users', 'images', 'joins'));
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

}
