@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ URL::asset('css/hotspot.css')}}" />
<link rel="stylesheet" href="{{ URL::asset('css/hotspotArea.css')}}" />
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading"><h5>{{$exp->name}}</h5></div>

        <!--================= boutons generaux ================-->
          <div class="col-md-8"><h4>Placer votre hotspot sur l'image</h4>
          </div>
          <div class="col-md-4">
          <table>

          <!-- <th>
              {!! Form::open(array('route'=>['exp.photo.show', $exp->id, $image->id], 'method'=>'POST')) !!}
              <input type="text" name="image" value="{{$image->id}}" hidden>
              {!! Form::button('ajouter hotspot', ['class'=>'btn btn-primary', 'type'=>'submit']) !!}
            </th> 
            {!! Form::close() !!} -->
            <th>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">
              Supprimer les hotspots
            </button>
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Suppression les hotspots</h4>
                  </div>
                  <div class="modal-body">
                    Voulez-vous vraiment supprimer tous les hotspots?
                  </div>
                  <div class="modal-footer" style="display: flex; flex-direction: row;" >
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    {!! Form::open(array('route'=>['exp.photo.destroy', $exp->id, $image->id], 'method'=>'POST')) !!}
                    <input type="text" name="image" value="{{$image->id}}" hidden>
                    {!! Form::button('Supprimer', ['class'=>'btn btn-danger', 'type'=>'submit']) !!}
                    {!! Form::close() !!}
                  </div>
                </div>
              </div>
            </div>
            </th>
            <th>
              {!! Form::open(array('route'=>['exp.photo.show', $exp->id, $image->id], 'method'=>'POST')) !!}
              <input type="text" name="image" value="{{$image->id}}" hidden>
              {!! Form::button('Retour gallerie', ['class'=>'btn btn-secondary', 'type'=>'submit']) !!}
              {!! Form::close() !!}
            </th>
          </table>
          </div>

        <div class="panel-body">
          <div>
          </div>
          <!-- ======================== test clic ================================ -->
          <div id="Hospot" class="photo hotspotArea">
            <div class="hotspotTarget"></div>
             <img src="{{ URL::asset('/img/'.$exp->id.'/'.$photo.'.PNG') }}" alt="immovr" class="photo">
          </div>
          <!-- ===================miniature selectionnable en ===================== -->
          <div class="row selectLink "><h3>Selectionner la destination</h3>
            <form action="{{ route('exp.photo.hotspot.store', [$exp->id, $id])}}" method="post">
              <div class="btn-group col-md-12" data-toggle="buttons" >
                <!--on parcours notre table de jointure et on affiche les image_id sauf celle en grand :-P -->
                @for ($i = 0; $i < sizeOf($joinexpimages); $i++)
                @if ($joinexpimages[$i]->image_id != $id AND $joinexpimages[$i]->delete != 1)<!--  && $images[$joinexpimages[$i]->image_id]->delete != 1 -->
                <label class="btn btn-primary col-md-3">
                  <input type="radio" name="image_link" value={{$joinexpimages[$i]->image_id}} autocomplete="off">
                  <div>
                    <input type="radio" name="imageArrive" id={{$joinexpimages[$i]->image_id}} value={{$joinexpimages[$i]->image_id}}><br>
                    <a href="#" class="pop miniature">
<!--                       {{$joinexpimages[$i]->image_id}} -->
                      <img class="toto" id="link_id" value={{$joinexpimages[$i]->image_id}}
                      src="{{ URL::asset('/img/'.$exp->id.'/'.$joinexpimages[$i]->image_id.'.PNG') }}" style=" width:100%">
                    </a>
                  </div>
                </label>
                @endif
                @endfor
              </div>
              <!-- pagination -->
              {{ $joinexpimages->links() }}
            </div>

            <!-- preview image d'arrivée imagepreview -->
            <div id="hospotLink" class="photo">
              <div class="hotspotTarget2">
              </div>
              <p>
                <h4>Placer votre point d'arrivée</h4>
              </p>
              <img src="" alt="immovr" id="photoLink">
            </div>

            <!-- ========== bouton test save =============-->

            <div class="panel-body hotspotSave">

              <select name="position_z" id="single">
                <option>petit</option>
                <option>moyen</option>
                <option>grand</option>
              </select>
              <input id="media_id" name="media_id" type="text" value="" placeholder="Nom">
              <p></p>
              <input id="shift_x" type="text" name="shift_x" value="" hidden>
              <input id="shift_y" type="text" name="shift_y" value="" hidden>
              <input id="shift_z" type="text" name="shift_z" value="" hidden>
              <input id="position_x" type="text" name="position_x" value="" hidden>
              <input id="position_y" type="text" name="position_y" value="" hidden>
              <input id="position_z" type="text" name="position_z" value="" hidden>          
              <input id="depth" type="text" name="depth" value="" hidden>
              <input id="latitude" type="text" name="latitude" value="" hidden>
              <input id="longitude" type="text" name="longitude" value="" hidden>
              <input id="exp_id" type="text" name="exp_id" value={{$exp->id}} hidden>
              <input id="image_id" type="text" name="image_id" value={{$id}} hidden>
              <input id="description" type="text" name="description" value="" hidden>
              <input id="image_idX" type="text" name="image_idX" value="" hidden>
              <input id="image_idY" type="text" name="image_idY" value="" hidden>
              <input id="image_linkX" type="text" name="image_linkX" value="" hidden>
              <input id="image_linkY" type="text" name="image_linkY" value="" hidden>
              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <input type="submit" name="submit" value="OK" class="btn btn-success">

            </form>
          </div>
        </div>
      </div>
    </div>

  </div>


  <!-- script -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  <script src="//cdnjs.cloudflare.com/ajax/libs/interact.js/1.2.6/interact.min.js"></script>

  <script language="JavaScript" type="text/javascript" src="{{ URL::asset('js/dragndrop.js') }}"></script>

  <script language="JavaScript" type="text/javascript" src="{{ URL::asset('js/functions.js') }}"></script>

  @endsection
