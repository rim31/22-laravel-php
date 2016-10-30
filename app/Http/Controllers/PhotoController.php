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
use App\JoinExpImage;
use App\JoinUserExp;
use App\Http\Requests;

use \Storage;
use File;
use DB;
use Carbon\Carbon;


class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Exp $exp)
    {
        var_dump($exp->id);
        $exps = Exp::all();
        // $users = JoinUserExp::all();
        $users = JoinUserExp::where('id_user', $exp->id)->get();
        //je selectionne seulement les Id des images correspondant a l'exp
        $joins = JoinExpImage::where('exp_id', $exp->id)->get();
        // $joins = JoinExpImage::all();

        //on recupere seulement les images de l'exp
        // $images = Image::all();


    // @foreach($joins as $join)
    // @if($exp->id == $join->exp_id)
    // @foreach($images as $image)
    // @if($image->id == $join->image_id)

        // $images = DB::table('images')
        //             ->where($joins), 'id', '=', $exp->id)
        //             ->get();


        // $users = DB::table('users')
        //         ->join('contacts', 'users.id', '=', 'contacts.user_id')
        //         ->join('orders', 'users.id', '=', 'orders.user_id')
        //         ->select('users.*', 'contacts.phone', 'orders.price')
        //         ->get();


        // return view('exps.photos.index', compact(
        //     'exps', 'users', 'images', 'joins', 'exp'));
        return view('exps.photos.index', compact(
            'exps', 'users', 'joins', 'exp'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Exp $exp)
    {
        var_dump($exp->id);
        return view('exps.photos.create', compact('exp'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Exp $exp, Request $request)
    {
        var_dump($exp->id);
        //on créé le dossier image s'il n'existe pas
        if (!file_exists(public_path('img/'))) {
        File::makeDirectory(public_path('img/'));
        echo "Creation ";
        }
        echo "dossier img | ";
        //on créé le dossier de l'exp s'il n'existe pas
        if (!file_exists(public_path('img/'.$exp->id))) {
        File::makeDirectory(public_path('img/'.$exp->id));
        echo "Creation ";
        }
        echo "sous dossier img " . $exp->id;
        //on injecte l'image dans ce dossier
        if (Input::hasFile('file')) {
            $file = Input::file('file');
            //insérer le nom de la photo dans la table image
            $name = $file->getClientOriginalName();
            //il faut insérer le nom de la photo dans la table Photo,
            //Aussi, il faut transformer les images en $id.JPG
            $nouvel = Image::create([
                'description' => $file->getClientOriginalName(),
                'option_1' => '1',
                ]);
            // il faut aussi associer la jointure avec l'id, OK !!
            $join = JoinExpImage::create([
                'exp_id' => $exp->id,
                'image_id' => $nouvel->id
            ]);

            $nouvel->update(['name' => $nouvel->id.'.'.$file->getClientOriginalExtension()]);
            var_dump(" | ". $nouvel->name . " | ");

            //$file->move('img/'.$exp->id, $nouvel->id.'.'.$file->getClientOriginalExtension());//prend le dernier l'extension du fichier image
            // echo '<img src="img/'.$exp->id.'/'. $nouvel->id.'.'.$file->getClientOriginalExtension().'"/>';
            $file->move('img/'.$exp->id, $nouvel->name);//prend le dernier l'extension du fichier image

            echo '<img src="/img/'.$exp->id.'/'. $nouvel->name.'"/>';

            echo "<BRr>il y a un fichier";

        }
        return redirect()->route('exp.photo.index', [$exp])->with('message', 'new experience added !');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        return view('exps.photos.show', compact('image'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Exp $exp, Image $image)
    {
        return view('exps.images.edit', compact('exp', 'image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Image $image)//possibilité de rajouter une Request pour obliger à remplir un champ
    {
        $image->update($request->all());
        return redirect()->route('exp.images.index')->with('message', 'Image modified !');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Exp $exp)
    {

        // var_dump($image->id);
        // $image = Image::findOrFail($request->id);
        // $exp = Image::findOrFail($request->exp);

/*        var_dump($request->exp);//id de  l'experience
        var_dump($request->image);//id de la photo dans l'experience*/

        $joins = JoinExpImage::find($request->image);
        $joins->update([
            'delete' => 1,
            'time_del' => Carbon::now()
        ]);
        $image = Image::find($request->image);
        $image->update([
            'delete' => 1,
            'time_del' => Carbon::now()
        ]);
        // var_dump($joins->time_del);die();//id de la photo dans l'experience*/


        // $image = Image::find($request->image);--
        // $image = Image::findOrFail($request->id);
        // $exp = Exp::findOrFail($request->exp);
/*        var_dump($image);
*/
// $image->delete();-- File::delete('/path/to/image/file');
        return redirect()->route('exp.photo.index', [$exp])->with('message', 'Image deleted !');
    }

}
