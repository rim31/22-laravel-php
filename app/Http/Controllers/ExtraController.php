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

use App\Http\Controllers\DOMDocument;
use Illuminate\Http\RedirectResponse;


use \Storage;
use File;
use DB;
use Auth;

class ExtraController extends Controller
{


      public function cover(Request $request, Exp $exp)
    {
      $exps = Exp::all();
      //remise a zero du la photo de couverture et on injecte le numero de l'id phot dans l'exp->photo
      DB::table('exps')
                ->where('id', $request->exp)
                ->update(['photo' => $request->id]);
      $exp->id = $request->exp;
      return redirect()->route('exp.photo.index', [$exp])->with('message', 'Image favorite ajoutée !');
    //   return view('exps.photos.index', compact('exps', 'users', 'joins', 'exp'));
    }


      public function quartz(Request $request, Exp $exp)
    {
      // $exps = Exp::all();
      $exp->id = $request->exp;

      //je selectionne seulement les Id des images correspondant a l'exp
      $joinexpimages = JoinExpImage::
          where('exp_id', $exp->id)
          ->Where('delete', '!=', '1')
          ->get();
      $images = DB::table('images')
          ->join('join_exp_images', 'images.id', '=', 'join_exp_images.image_id')
          ->get();
      var_dump($images);
/*      $images = DB::table('images')//recuperer les bonnes id % table de jointures
          ->where('images.id', '=', 'joinexpimages.image_id')
          ->get();
      var_dump($images);*/

      $joins = DB::table('join_image_hotspots')
          ->join('images', 'join_image_hotspots.image_id', '=', 'images.id')
          ->get();
      // var_dump($joins);

      $spots = DB::table('hotspots')
          ->where('hotspots.exp_id', '=', $exp->id)//il faudrait utiliser la table de jointure
          ->join('images', 'hotspots.image_id', '=', 'images.id')
          ->get();
      // $spots = DB::table('hotspots')
      //     ->where('hotspots.exp_id', '=', '$exp->id')
      //     ->get();
      var_dump($spots);
      // die();//debug

      //================création du xml =========================
      // possibilité de le créer à la fin de la création du hotspot
   $xml = new \DOMDocument('1.0', 'utf-8');
   $xml->formatOutput = true;//pour avoir un beau format de sortie

echo "=========> photo :".$request->id;//$request->id est la phtot de couverture de l'exp

//creation d'élement du fichier XML avec createElement puis ajouter avec appendChild
   $experience = $xml->createElement("experience");//creation de l'element paren
   $experience->setAttribute('startMediaId', $request->id.'.PNG');
   $xml->appendChild($experience);//creation de l'element parent

   $config = $xml->createElement('config');//ajout de sous champ élémént
   $experience->appendChild($config);//creation du sous element
//création des sous-sous element param
       $param = $xml->createElement('param');//ajout de sous-sous champ élémént
     $param->setAttribute('key', 'hotspotSrc');
     $param->setAttribute('value', 'logo.png');
     $config->appendChild($param);//creation du sous sous element
       $param = $xml->createElement('param');//ajout de sous-sous champ élémént
     $param->setAttribute('key', 'hotspotColor');
     $param->setAttribute('value', '0xffffff');
     $config->appendChild($param);//creation du sous sous element
       $param = $xml->createElement('param');//ajout de sous-sous champ élémént
     $param->setAttribute('key', 'hotspotTriggers');
     $param->setAttribute('value', 'dblclick,tap,gaze');
     $config->appendChild($param);//creation du sous sous element
       $param = $xml->createElement('param');//ajout de sous-sous champ élémént
     $param->setAttribute('key', 'loadingDuration');
     $param->setAttribute('value', '1500');
     $config->appendChild($param);//creation du sous sous element
      $param = $xml->createElement('param');//ajout de sous-sous champ élémént
     $param->setAttribute('key', 'loadingEffect');
     $param->setAttribute('value', 'spritesheet(4)');
     $config->appendChild($param);//creation du sous sous element

array_multisort($spots);//on trie le tableau de spot
// var_dump($spots);die();//debug
      //variable sotckage id de 'limage'
      $idEnCours = 0;

    foreach ($spots as $key => $spot) 
    {
      if ($spot->id != $idEnCours)
      {
        $idEnCours = $spot->id;
      $media = $xml->createElement('media');//ajout de sous champ élémént
      $media->setAttribute('id', $spot->id.'.PNG');
      $media->setAttribute('poster', 'img/'.$exp->id.'/'.$spot->id.'.PNG');//lien avec chemin
      $experience->appendChild($media);//creation du sous element
      }
//on crée une boucle avec tous les meme id
      if ($spot->id == $idEnCours)
      {
        $hotspot = $xml->createElement('hotspot');//ajout de sous champ élémént
        $hotspot->setAttribute('mediaId', $spot->id.'.PNG');
        $hotspot->setAttribute('shift', $spot->shift_x.','.$spot->shift_y.','.$spot->shift_z);
        $media->appendChild($hotspot);//creation du sous element

          $position = $xml->createElement('position');//ajout de sous champ élémént
          $position->setAttribute('depth', $spot->depth.'0');//pas de depth pour le moment, on fait 0
          $position->setAttribute('latitude', $spot->latitude);
          $position->setAttribute('longitude', $spot->longitude);
          $hotspot->appendChild($position);//creation du sous element
          $description = $xml->createElement('description', $spot->image_link.'.PNG');//ajout de sous champ élémént
          $hotspot->appendChild($description);//creation du sous element 
      }
    }




echo "<xmp>".$xml->saveXML()."</xmp>";
        // Header('Content-type: text/xml');
        // print($xml->asXML());
        file_put_contents('quartz.xml', $xml->saveXML());

 //        die();

// ===>ok//      return view('quartz', compact('spots', 'users', 'joins', 'exp', 'xml'));
/*      return redirect()->action('quartz', compact('spots', 'users', 'joins', 'exp', 'xml'));*/
            return view('bnppre_wip/index', compact('spots', 'users', 'joins', 'exp', 'xml'));

    // return redirect()->route('quartz', [$exp]);
    //   return view('exps.photos.index', compact('exps', 'users', 'joins', 'exp'));

    }


        public function xml(Request $request, Exp $exp)
    {
      return ("coucou");
    }
}
