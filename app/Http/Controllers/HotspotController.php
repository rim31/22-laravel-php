<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePagination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\Controller;
use App\UploadedFile;
use App\Exp;
use App\Image;
use App\Hotspot;
use App\JoinExpImage;
use App\JoinUserExp;
use App\JoinImageHotspot;
use App\Http\Requests;

use \Storage;
use File;
use DB;
use Auth;

class HotspotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(Exp $exp, Image $image)
    public function index(Exp $exp, Request $request, $id)
    {
        $users = JoinUserExp::where('id_user', $exp->id)->get();
        $exps = DB::table('exps')
            ->join('join_user_exps', 'exps.id', '=', 'join_user_exps.id_exp')
            ->get();
        //je selectionne seulement les Id des images correspondant a l'exp
        $joinexpimages = JoinExpImage::
            where('exp_id', $exp->id)
            ->Where('delete', '!=', '1')
            ->get();
        $images = DB::table('images')
                    ->join('join_exp_images', 'images.id', '=', 'join_exp_images.image_id')
                    ->get();
        $hotspots = Hotspot::where('image_id', $exp->photo)->get();
        return view('exps.photos.hotspots.index', compact('exps', 'users',
            'images', 'joinexpimages', 'exp', 'hotspots', 'id'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Exp $exp, Image $image, Request $request, $id)
    {
        $photo = $request->photo;//pour envoyer l'id de l'image
        $exps = Exp::all();
        $users = JoinUserExp::all();
        //je selectionne seulement les Id des images correspondant a l'exp
        $joinexpimages = JoinExpImage::
            where('exp_id', $exp->id)
            ->Where('delete', '!=', '1')
            ->simplePaginate(4);
        $images = Image::all();
        $hotspots = Hotspot::where('image_id', $id)->get();
        return view('exps.photos.hotspots.create', compact('exps', 'users',
            'images', 'joinexpimages', 'exp', 'image', 'photo', 'id', 'hotspots'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Exp $exp, Image $image, Request $request, $id)
    {
        echo "<BR>Formulaire : ";
        $hotspot = Hotspot::create([
        'media_id' => $request->media_id,
        'shift_x' => $request->shift_x,
        'shift_y' => $request->shift_y,
        'shift_z' => $request->shift_z,
        'position_x' => $request->position_x,
        'position_y' => $request->position_y,
        'position_z' => $request->position_z,
        'depth' => $request->depth,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'exp_id' => $request->exp_id,
        'image_id' => $id,
        'image_idX' => $request->image_idX,
        'image_idY' => $request->image_idY,
        'image_link' => $request->image_link,
        'image_linkX' => $request->image_linkX,
        'image_linkY' => $request->image_linkY,
        ]);
    // il faut aussi associer la jointure avec l'id, OK !!
    /*        $joins = JoinImageHotspot::create([
        'image_id' => $id,
        'spot_id' => $hosptots->id
        ]);*/
    $joins = DB::table('join_image_hotspots')->insert([
        'image_id' => $id,
        'spot_id' => $hotspot->id
        ]);

        $users = JoinUserExp::where('id_user', $exp->id)->get();
        $exps = DB::table('exps')
            ->join('join_user_exps', 'exps.id', '=', 'join_user_exps.id_exp')
            ->get();
        $joinexpimages = JoinExpImage::where('exp_id', $exp->id)->get();
        $images = DB::table('images')
            ->join('join_exp_images', 'images.id', '=', 'join_exp_images.image_id')
            ->get();
        // $hotspots = DB::table('hotspots')
        //     ->join('join_image_hotspots', 'hotspots.id', '=', 'join_image_hotspots.image_id')
        //     ->get();
        //pour envoyer l'id de l'image
        // $exps = Exp::all();
        // $users = JoinUserExp::all();
        // //je selectionne seulement les Id des images correspondant a l'exp
        // $joinexpimages = JoinExpImage::where('exp_id', $id)->get();
        // $images = Image::all();
        // $hotspots = Hotspot::where('image_id', $id)->get();
        // $photo = $request->id;//pour envoyer l'id de l'image
        $hotspots = Hotspot::where('image_id', $id)->get();

        return view('exps.photos.hotspots.show', compact('exp', 'hotspots', 'id'))
        ->with('message', 'Hotspot placé !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Exp $exp, Hotspot $hotspots, Request $request, $id)
    {
        var_dump("coucou show");
        var_dump($id);
        var_dump($request->spot);
        var_dump($request->combien);
        if ($request->combien == "unique")
        {
            $id = $request->spot;
        }
        var_dump($request->id);
        echo "CTLM";
        $users = JoinUserExp::where('id_user', $exp->id)->get();
        $exps = DB::table('exps')
            ->join('join_user_exps', 'exps.id', '=', 'join_user_exps.id_exp')
            ->get();
        $joinexpimages = JoinExpImage::where('exp_id', $exp->id)->get();
        $images = DB::table('images')
            ->join('join_exp_images', 'images.id', '=', 'join_exp_images.image_id')
            ->get();
        // $hotspots = DB::table('hotspots')
        //     ->join('join_image_hotspots', 'hotspots.id', '=', 'join_image_hotspots.image_id')
        //     ->get();
        $hotspots = Hotspot::where('image_id', $id)->get();

        return view('exps.photos.hotspots.show', compact('exp', 'hotspots', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exp $exp, Image $image, Request $request, $id)
    {
        var_dump("coucou destroy");
        var_dump(" id : ",$id);
        var_dump(" spot : ",$request->spot);
        var_dump($request->combien);
        if ($request->combien == "tous")//on supprime tous les hotspots de l'image
        {
            // $joins = JoinImageHotspot::where('image_id', $id)->delete();
            $joins = DB::table('join_image_hotspots')->where('image_id', $id)->delete();
            $spots = Hotspot::where('image_id', $id)->delete();
            $joinimagehotspots = JoinImageHotspot::where('image_id', $id)->get();
        }
        else
        {//on supprime seulement le hotpsot selectionné
            $joins = JoinImageHotspot::where('spot_id', $request->spot)->delete();
            $spots = Hotspot::where('id', $request->spot)->delete();
            $joinimagehotspots = JoinImageHotspot::where('image_id', $request->spot)->get();
        }
        //on reaffiche les hotspots restants
        $users = JoinUserExp::where('id_user', $exp->id)->get();
        $exps = DB::table('exps')
            ->join('join_user_exps', 'exps.id', '=', 'join_user_exps.id_exp')
            ->get();
        $joinexpimages = JoinExpImage::where('exp_id', $exp->id)->get();
        $images = DB::table('images')
            ->join('join_exp_images', 'images.id', '=', 'join_exp_images.image_id')
            ->get();
        // $hotspots = DB::table('hotspots')
        //     ->join('join_image_hotspots', 'hotspots.id', '=', 'join_image_hotspots.image_id')
        //     ->get();
        $hotspots = Hotspot::where('image_id', $id)->get();

        return view('exps.photos.hotspots.show', compact('exp', 'hotspots', 'id'))->with('message', 'Hotspot deleted !');
        // return redirect()->route('exp.photo.index', compact('exp'))->with('message', 'Hotspot deleted !');
    }
}
