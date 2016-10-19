<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use App\Http\Requests;

use Illuminate\Support\Facades\Input;
use App\Exp;
use App\Image;
use App\JoinUserExp;
use App\Http\Controllers\Controller;
use App\UploadedFile;
use App\Http\Requests;
use App\Http\Requests\ExpRequest;

use \Storage;
use File;
use Auth;
use DB;

class ExpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exps = Exp::all();
        $images = Image::find(Auth::user()->id);//on en
        $users = JoinUserExp::all();
        return view('exps.index', compact('exps', 'users', 'images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('exps.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpRequest $request)
    {
        // $nouvel = Exp::create($request->all());
        $nouvel = Exp::create([
            'name' => $request->name,
            'about' =>$request->about,
            'adress' => $request->adress,
            ]);

        //jointure de entre la table user et exp
        $join = JoinUserExp::create([
            'id_user' => Auth::user()->id,
            'id_exp' => $nouvel->id
        ]);

        //-----------------------------------------//
        //création et insertion dossier photo
        if (!file_exists(public_path('img/'))) {
        File::makeDirectory(public_path('img/'));
        }
        //on créé le dossier de l'exp s'il n'existe pas
        if (!file_exists(public_path('img/'.$nouvel->id))) {
        File::makeDirectory(public_path('img/'.$nouvel->id));
        }
        //on injecte l'image dans ce dossier
        if ($file = $request->photo) {
            $photo = $file->getClientOriginalName();//on recupère le nom de la phot avec l'extension
            $nouvel->update(['photo' => $nouvel->id.'.'.$file->getClientOriginalExtension()]);//on sauvegarde le fichier avatar avec le nom de l'id de l'exp
            $file->move('img/'.$nouvel->id, $nouvel->photo);//on deplace le ficiher
        }



        //-----------------------------------------//

        return redirect()->route('exp.index')->with('message', 'new experience added !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Exp $exp)
    {
        return view('exps.show', compact('exp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     // $exp = EXP::findOrFail($id);
    // }
    public function edit(Exp $exp)
    {
        return view('exps.edit', compact('exp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     *
     *possible erreur : http://stackoverflow.com/questions/34961942/upload-image-in-update-laravel
     *
     */
    public function update(ExpRequest $request, Exp $exp)
    {
        $exp->update($request->all());//probleme avec la mise a jour de la photo, il ne recupere pas le photo et la renommer
        return redirect()->route('exp.index')->with('message', 'Experience modified !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exp $exp)
    {
        $exp->delete();
        return redirect()->route('exp.index')->with('message', 'Experience deleted !');
    }
}
