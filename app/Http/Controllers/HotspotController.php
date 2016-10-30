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
    public function index(Exp $exp, Request $request)
    {
        var_dump($exp->id);
        // var_dump($image->id);
        // var_dump($image->id);

        $users = JoinUserExp::where('id_user', $exp->id)->get();
        // $users = JoinUserExp::all();
        // $exps = Exp::all();
        $exps = DB::table('exps')
                    ->leftJoin('join_user_exps', 'exps.id', '=', 'join_user_exps.id_exp')
                    ->get();

        //je selectionne seulement les Id des images correspondant a l'exp
        $joinexpimages = JoinExpImage::where('exp_id', $exp->id)->get();

        // $images = Image::all();
        $images = DB::table('images')
                    ->leftJoin('join_exp_images', 'images.id', '=', 'join_exp_images.image_id')
                    ->get();



        $hotspots = Hotspot::all();
        // $joinimagehospots = JoinImageHotspot::all();
        // return view('exps.photos.hotspot.index', compact('exps', 'users',
        //     'images', 'hotspots', 'joinexpimages', 'joinimagehospots'));
        return view('exps.photos.hotspots.index', compact('exps', 'users',
            'images', 'joinexpimages', 'exp', 'hotspots'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Exp $exp, Image $image, Request $request, $id)
    {
        // var_dump ($request->photo);
        // var_dump($exp->id);
        // var_dump($id);
        // var_dump($image->id);
        // var_dump($image->delete);
        $photo = $request->photo;//pour envoyer l'id de l'image
        $exps = Exp::all();
        $users = JoinUserExp::all();
        //je selectionne seulement les Id des images correspondant a l'exp
        // $joinexpimages = JoinExpImage::where('exp_id', $exp->id)->get();
        $joinexpimages = JoinExpImage::where('exp_id', $exp->id)->simplePaginate(4);
        $images = Image::all();
        $hotspots = Hotspot::where('image_id', $id)->get();
        // var_dump($hotspots);
        // $hotspots = Hotspot::all();
        // $users = User::where('votes', '>', 100)->simplePaginate(15);
        // $exps = DB::table('exps')->paginate(5);//pagination des experiences

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
        // var_dump($request->all());

        // var_dump($media_id);
        // var_dump($shift_x);
        // var_dump($shift_y);
        // var_dump($shift_z);
        // var_dump($position_x);
        // var_dump($position_y);
        // var_dump($position_z);
        // var_dump($depth);
        // var_dump($latitude);
        // var_dump($longitude);
        // var_dump($exp_id);
        // var_dump($image_id);
        // var_dump($image_idX);
        // var_dump($image_idY);
        // var_dump($image_link);
        // var_dump($image_linkX);
        // var_dump($image_linkY);

    $hosptot = Hotspot::create([
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
    $joins = DB::table('join_image_spots')->insert([
        'image_id' => $id,
        'spot_id' => $hosptot->id
        ]);

        //pour envoyer l'id de l'image
        $exps = Exp::all();
        $users = JoinUserExp::all();
        //je selectionne seulement les Id des images correspondant a l'exp
        // $joinexpimages = JoinExpImage::where('exp_id', $exp->id)->get();
        $joinexpimages = JoinExpImage::where('exp_id', $id)->get();
        $images = Image::all();
        $hotspots = Hotspot::where('image_id', $id)->get();
        $photo = $request->id;//pour envoyer l'id de l'image

        $hotspots = Hotspot::where('image_id', $id)->get();
        // $hotspots = Hotspot::all();

        // return view('exps.photos.hotspots.create', compact('exps', 'users',
        //     'images', 'joinexpimages', 'exp', 'image', 'photo', 'id', 'hotspots'));
        return view('exps.photos.hotspots.show', compact('exps', 'users',
            'images', 'joinexpimages', 'exp', 'id', 'hotspots'))->with('message', 'Hotspot placé !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Exp $exp, Image $image, Hotspot $hotspot, Request $request, $id)
    {
        var_dump($request->id);
        echo "CTLM";
        return view('exps.photos.hotspots.index', compact('exp', 'image', 'hotspot', 'id'));
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
    public function destroy($id)
    {
        var_dump($exp->id);//id de la photo dans l'experience*/

        $joins = JoinUserExp::find($exp->id);
        $joins->update([
            'delete' => 1,
            'time_del' => Carbon::now()
        ]);
        $id = Exp::find($exp->id);
        $id->update([
            'delete' => 1,
            'time_del' => Carbon::now()
        ]);
        // $exp->delete();
        return redirect()->route('exp.index')->with('message', 'Experience deleted !');
    }
}
