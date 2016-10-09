<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use App\Http\Requests;

use App\Exp;

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
        return view('exps.index', compact('exps'));
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
        Exp::create($request->all());
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
