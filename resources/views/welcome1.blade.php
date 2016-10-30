@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">BIENVENUE</div>
				<div class="panel-body">
                     <table class="table">
                        <tr>
                            <th>Photo</th>
                            <th>Action</th>
                            <th>Editer</th>
                            <th>Numéro</th>
                        </tr>
                        <tr>
					<BR>
                    @foreach($exps as $exp)
					@foreach($joins as $join)
					@if($exp->id == $join->exp_id)
					@foreach($images as $image)
						@if($image->id == $join->image_id)
 						<td><img src="/img/{{$exp->id}}/{{$image->name}}" alt="{{$image->name}}" style="width:200px;height:100px;"/> </td>
						<td><a class="btn btn-info" href="{{ url('hotspot') }}"> Editer hotspot</a> </td>
						<td>{!! Form::open(array('route'=>['exp.photo.destroy', $exp->id, $image->id], 'method'=>'DELETE')) !!}
					    <input type="text" name="image" value="{{$image->id}}" hidden>
						{!! Form::button('Delete photo', ['class'=>'btn btn-danger', 'type'=>'submit']) !!} </td>
						{!! Form::close() !!}
						</td>
						<td>
							{{$image->id}}
						</td>
						</tr>
						@endif
					@endforeach
					@endif
					@endforeach
                    @endforeach
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

//index.blade.php de photo
<!-- <table class="table">
<tr>
<th>Photo</th>
<th>Action</th>
<th>Editer</th>
<th>Photo de couverture</th>
</tr>
<tr>
<BR>
@foreach($joins as $join)
@if($exp->id == $join->exp_id)
@foreach($images as $image)
@if($image->id == $join->image_id)
<td>
<img src="{{ URL::asset('/img/'.$exp->id.'/'.$image->id.'.JPG') }}" alt="immovr" class="photo" style="width:200px;height:100px;">
</td>
//commentaire : <td><a class="btn btn-info" href="{{ url('hotspot') }}"> Editer hotspot</a> </td>
<td>{{ link_to_route('exp.photo.hotspot.create', 'Editer spot', [$exp->id, $image->id], ['class' => 'btn btn-info']) }}
</td>
<td>{!! Form::open(array('route'=>['exp.photo.destroy', $exp->id, $image->id], 'method'=>'DELETE')) !!}
<input type="text" name="image" value="{{$image->id}}" hidden>
{!! Form::button('Effacer la photo', ['class'=>'btn btn-danger', 'type'=>'submit']) !!}
</td>
{!! Form::close() !!}
<td>
{!! Form::open(array('route'=>['cover', $exp->id, $image->id])) !!}
{!! Form::button('Choix', ['class'=>'btn btn-default', 'type'=>'submit']) !!}
{!! Form::close() !!}
{{ link_to_route('exp.photo.hotspot.index', 'gallerie', [$exp->id, $image->id], ['class' => 'btn btn-info']) }}
</td>
</tr>
@endif
@endforeach
@endif
@endforeach
</table> -->


<!-- index.blade.php  exp                     <table class="table">
                        <tr>
                            <th>Nom</th>
                            <th>Action</th>
                            <th>Hotspot</th>
                            <th>Photo</th>
                        </tr>
                        @foreach($users as $user)
                            @if($user->id_user == Auth::user()->id)
                                @foreach($exps as $exp)
                                <tr>
                                  @if($user->id_exp == $exp->id AND $exp->delete != 1)
                                    <td>{{ link_to_route('exp.show', $exp->name, [$exp->id]) }}</td>
                                    <td>
                                        {!! Form::open(array('route'=>['exp.destroy', $exp->id], 'method'=>'DELETE')) !!}
                                        {{ link_to_route('exp.edit', 'Edit', [$exp->id], ['class' => 'btn btn-primary']) }}
                                        |
                                        {!! Form::button('Delete', ['class'=>'btn btn-danger', 'type'=>'submit']) !!}
                                        {!! Form::close() !!}

                                        modal pour supprimer
                                         {{ link_to_route('exp.edit', 'Edit', [$exp->id], ['class' => 'btn btn-primary']) }}

                                        <div class="bd-example">
                                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Supprimer</button>
                                           <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                  <h4 class="modal-title" id="exampleModalLabel">Supprimer</h4>
                                                </div>
                                                <div class="modal-body">
                                                  <form>
                                                    <div>
                                                        vraiment ?
                                                    </div>
                                                  </form>
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                  {!! Form::open(array('route'=>['exp.destroy', $exp->id], 'method'=>'DELETE')) !!}
                                                  {!! Form::button('Delete', ['class'=>'btn btn-danger', 'type'=>'submit']) !!}
                                                  {!! Form::close() !!}
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                            fin du modal
                                    </td>
                                    <td>
                                        @if($exp->photo)
                                            <a class="btn btn-info" href="{{ url('hotspot') }}"> Hotspot</a></td>
                                        @else
                                            aucune photo
                                        @endif
                                    <td>
                                        @if($exp->photo)
                                            <a href="{{route('exp.photo.index',[$exp->id])}}"> <img src="{{ URL::asset('/img/'.$exp->id.'/'.$exp->photo) }}"
                                            alt="{{$exp->photo}}" style="width:200px;height:100px;" /></a>

                                        @else
                                            {{ link_to_route('exp.photo.index', 'Gallerie', [$exp->id], ['class' => 'btn btn-info']) }}
                                        @endif
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            @endif
                        @endforeach
                    </table>
				-->


<!-- index exp -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Experiences</div>
                @if(Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message') }}</div>
                @endif
                <div class="panel-body">
                    {{ link_to_route('exp.create', 'Add new experience', null, ['class' => 'btn btn-success']) }}
                    <br>
                    <table class="table">
                        <tr>
                            <th>Nom</th>
                            <th>Action</th>
                            <th>Hotspot</th>
                            <th>Photo</th>

                            @for ($i = 0; $i < sizeOf($users); $i++)
                            @if($users[$i]->delete != 1)
                            <td>
                                {{$users[$i]->id}}
                                <img src="{{ URL::asset('/img/'.$users[$i]->id.'/'.$users[$i]->photo) }}"
                                alt="immovr" class="photo" style="width:200px;height:100px;">
                            </td>
                            <td>
                                {!! Form::open(array('route'=>['exp.destroy', $users[$i]->id], 'method'=>'DELETE')) !!}
                                {{ link_to_route('exp.edit', 'Edit', [$users[$i]->id], ['class' => 'btn btn-primary']) }}
                                <!-- {{ link_to_route('exp.photo.create', 'Editer spot', [$users[$i]->id], ['class' => 'btn btn-info']) }} -->
                                |
                                <input type="text" name="id" value="{{$users[$i]->id}}" hidden>
                                {!! Form::button('Effacer', ['class'=>'btn btn-danger', 'type'=>'submit']) !!}
                                {!! Form::close() !!}
                            </td>
                            <td>

                            </td>
                            <td>
                                {{ link_to_route('exp.photo.index', 'gallerie', [$users[$i]->id], ['class' => 'btn btn-info']) }}
                            </td>
                            @endif
                        </tr>
                        @endfor

                        </tr>
                        @foreach($users as $user)
                            @if($user->id_user == Auth::user()->id)
                                @foreach($exps as $exp)
                                <tr>
                                  @if($user->id_exp == $exp->id AND $exp->delete != 1)
                                    <td>{{ link_to_route('exp.show', $exp->name, [$exp->id]) }}</td>
                                    <td>
                                        {!! Form::open(array('route'=>['exp.destroy', $exp->id], 'method'=>'DELETE')) !!}
                                        {{ link_to_route('exp.edit', 'Edit', [$exp->id], ['class' => 'btn btn-primary']) }}
                                        |
                                        {!! Form::button('Delete', ['class'=>'btn btn-danger', 'type'=>'submit']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                        @if($exp->photo)
                                            <a class="btn btn-info" href="{{ url('hotspot') }}"> Hotspot</a></td>
                                        @else
                                            aucune photo
                                        @endif
                                    <td>
                                        @if($exp->photo)
                                            <a href="{{route('exp.photo.index',[$exp->id])}}"> <img src="{{ URL::asset('/img/'.$exp->id.'/'.$exp->photo) }}"
                                            alt="{{$exp->photo}}" style="width:200px;height:100px;" /></a>

                                        @else
                                            {{ link_to_route('exp.photo.index', 'Gallerie', [$exp->id], ['class' => 'btn btn-info']) }}
                                        @endif
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            @endif
                        @endforeach
                    </table>

                    <!-- pagination-->
                    {{ $exps->links() }}

                </div>
            </div>
        </div>
    </div>
</div>


<!--   modal -->

@endsection

<!-- exp controller -->
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use App\Http\Requests;
use Illuminate\Pagination\LengthAwarePagination;
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
use Carbon\Carbon;

class ExpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $exps = DB::table('exps')->paginate(5);//pagination des experiences
        // $images = Image::find(Auth::user()->id);//pour la cover
        // $users = JoinUserExp::all();
        // var_dump($users);
        // return view('exps.index', compact('exps', 'users', 'images'));

        $exps = DB::table('exps')->paginate(5);//pagination des experiences
        $images = Image::find(Auth::user()->id);//pour la cover
        $users = JoinUserExp::all();
        // var_dump(Auth::user()->id);die();
        // $users = JoinUserExp::where('id', Auth::user()->id);//pour la cover
        // var_dump($users);

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
    public function destroy(Request $req)
    {
        var_dump($req->id);//id de la photo dans l'experience*/

        $joins = JoinUserExp::find($req->id);
        $joins->update([
            'delete' => 1,
            'time_del' => Carbon::now()
        ]);
        $id = Exp::find($req->id);
        $id->update([
            'delete' => 1,
            'time_del' => Carbon::now()
        ]);
        // $req->delete();
        return redirect()->route('exp.index')->with('message', 'Experience deleted !');
    }
    // public function destroy(Exp $exp)
    // {
    //     var_dump($exp->id);//id de la photo dans l'experience*/
    //
    //     $joins = JoinUserExp::find($exp->id);
    //     $joins->update([
    //         'delete' => 1,
    //         'time_del' => Carbon::now()
    //     ]);
    //     $id = Exp::find($exp->id);
    //     $id->update([
    //         'delete' => 1,
    //         'time_del' => Carbon::now()
    //     ]);
    //     // $exp->delete();
    //     return redirect()->route('exp.index')->with('message', 'Experience deleted !');
    // }
}


// fomulaire hsp
// <div class="form-group">
//   <label for="posz">taille spot :</label>
//   <select class="form-control" id="posz">
// 	<option>petit</option>
// 	<option>moyen</option>
// 	<option>grand</option>
// 	<input type="hidden" name="_token" value="{{ csrf_token() }}">
//   </select>
// </div>
