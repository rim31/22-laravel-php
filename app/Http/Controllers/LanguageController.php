<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Redirect;
use App\Http\Requests;

class LanguageController extends Controller
{
    public function index() {
        $url = url('/');

        if (!\Session::has('locale')) {
    		\Session::put('locale', Input::get('locale'));
    	} else {
    		Session::put('locale', Input::get('locale'));
    	}
        return Redirect::to($url);
        return Redirect::back();// il y a un bug sur la page QUARTZ qui n'accepte pas le changement de langue (en methode POST): donc au lieu de traduire et renvoyer sur la page en cours, on renvoi vers la homepage
    }
}
