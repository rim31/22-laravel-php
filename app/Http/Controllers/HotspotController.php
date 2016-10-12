<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Exp;

use App\Http\Requests\ExpRequest;

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
}
