<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use File;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use \Storage;
use App\UploadedFile;
use App\Exp;
use App\Image;
use App\JoinExpImage;
use App\JoinUserExp;

use DB;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $exps = Exp::all();
        $users = JoinUserExp::all();
        $images = Image::all();
        $joins = JoinExpImage::all();
        return view('exps.photos.index', compact('exps', 'users', 'images', 'joins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // var_dump($request->id);die();
        return view('exps.photos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //on créé le dossier image s'il n'existe pas
        if (!file_exists(public_path('img/'))) {
        File::makeDirectory(public_path('img/'));
        }
        //on créé le dossier de l'exp s'il n'existe pas
        if (!file_exists(public_path('img/'.$request->id))) {
        File::makeDirectory(public_path('img/'.$request->id));
        }
        //on injecte l'image dans ce dossier
        if (Input::hasFile('file')) {
            $file = Input::file('file');
            $file->move('img/'.$request->id, $file->getClientOriginalName());
            //on affiche l'image
            echo '<img src="img/'.$request->id.'/' . $file->getClientOriginalName() .'"/>';
            echo "controller upload <BR/>";

            //il faut insérer le nom de la photo dans la table Photo
            $nouvel = Image::create($request->all());
            // il faut aussi associer la jointure avec l'id
            $join = JoinExpImage::create([
                'exp_id' => $request->id,
                'image_id' => $nouvel->id
            ]);
            var_dump($request->id); die();

//insert photo comme un avatar
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = $nouvel->id . '.' .$file->getClientOriginalExtension();
                Image::make($file)->resize(300, 300)->save(public_path('img/'. $request->id . $filename));
            }
        }

        return redirect()->route('exp.images.index')->with('message', 'new experience added !');

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
    public function edit(Image $image)
    {
        return view('exps.images.edit', compact('image'));
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
    public function destroy(Image $image)
    {
        $image->delete();
        return redirect()->route('exp.image.index')->with('message', 'Image deleted !');

    }

//======================================================================


    // public function handleUpload(Request $request){

    //     // if($request->hasFile('file')){
    //         $file = $request->file('file');
    //         $allowedFileTypes = config('app.allowedFileTypes');
    //         $maxFileSize = config('app.maxFileSize');
    //         $rules = [
    //             'file' => 'required|mimes:'.$allowedFileTypes.'|max:'.$maxFileSize
    //         ];
    //         $this->validate($request, $rules);
    //         $fileName = $file->getClientOriginalName();
    //         $destinationPath = config('app.fileDestinationPath').'/'.$fileName;
    //         $uploaded = Storage::put($destinationPath, file_get_contents($file->getRealPath()));

    //         if($uploaded){
    //             UploadedFile::create([
    //                 'filename' => $fileName
    //             ]);
    //         }
    //     // }

    //     return redirect()->to('/upload');
    // }

    // public function upload1(){
    //     $directory = config('app.fileDestinationPath');
    //     // $files = Storage::files($directory);
    //     $files = UploadedFile::all();
    //     return view('files.upload')->with(array('files' => $files));
    // }

    // public function deleteFile($id){
    //     $file = UploadedFile::find($id);
    //     Storage::delete(config('app.fileDestinationPath').'/'.$file->filename);
    //     $file->delete();
    //     return redirect()->to('/upload');
    // }

/**==================================================**/

    public function upload(Request $request)
    {
        //on créé le dossier image s'il n'existe pas
        if (!file_exists(public_path('img/'))) {
        File::makeDirectory(public_path('img/'));
        }
        //on créé le dossier de l'exp s'il n'existe pas
        if (!file_exists(public_path('img/'.$request->id))) {
        File::makeDirectory(public_path('img/'.$request->id));
        }
        //on injecte l'image dans ce dossier
        if (Input::hasFile('file')) {
            $file = Input::file('file');
            $file->move('img/'.$request->id, $file->getClientOriginalName());
            echo '<img src="img/'.$request->id.'/' . $file->getClientOriginalName() .'"/>';
            echo "controller upload <BR/>";
        }
        var_dump($request->id); die();
                //il faut insérer le nom de la photo dans la table Photo
        $join = Image::create([
            'id_user' => Auth::user()->id,
            'id_exp' => $nouvel->id
        ]);
                // il faut aussi associer la jointure avec l'id
    }

    public function demo()
    {
        echo "Coucou : controller Démo dans PhototController";
        $exp = Image::find($id);

        $exp->load('images');

        return view('exps.show', compact('exp')); // whatever your view is called
    }

}
