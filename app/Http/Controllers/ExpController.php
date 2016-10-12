<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use App\Http\Requests;

use Illuminate\Support\Facades\Input;
use App\Exp;
use App\Image;
use App\JoinUserExp;
use Auth;
use DB;

use App\Http\Requests\ExpRequest;

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
        $users = JoinUserExp::all();
        return view('exps.index', compact('exps', 'users'));
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
        $nouvel = Exp::create($request->all());
//jointure de entre la table user et exp
        $join = JoinUserExp::create([
            'id_user' => Auth::user()->id,
            'id_exp' => $nouvel->id
        ]);
//création et insertion dossier photo
        if (Input::hasFile($nouvel->photo)) {
            $image = Input::file($nouvel->photo);
            $image->move('img/uploads', $image->photo);
            // echo '<img src="img/uploads' . $files->getclientOriginalName() . '"/>';
            die();
        }
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
     */
    public function update(ExpRequest $request, Exp $exp)
    {
        $exp->update($request->all());
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
