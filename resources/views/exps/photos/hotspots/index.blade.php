@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ URL::asset('css/hotspotArea.css')}}" />

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
           <div class="panel-heading">
             <h5>{{$exp->name}}</h5>
           </div>
           <div class="panel-body">
            <h4>vos hotspots</h4>
           <!-- ======================== afficher l'image ================================ -->
           <div  id="Hospot" class="hotspotArea col-md-12">
            <div class="hotspotTarget">
             <img src="{{ URL::asset('/img/'.$exp->id.'/'.$id.'.PNG') }}" alt="immovr" class="photo">
            </div>
           </div>
            <div class="col-sm-3">
              {!! Form::open(array('route'=>['exp.photo.hotspot.destroy', $exp->id, $id, 0], 'method'=>'DELETE')) !!}
              <input type="text" name="image" value="{{$id}}" hidden>
              <input type="text" name="combien" value="tous" hidden>
              {!! Form::button('supprimer les hotspots', ['class'=>'btn btn-danger', 'type'=>'submit']) !!}
              {!! Form::close() !!}
          </div>
          <div class="col-sm-2">
              {{ link_to_route('exp.photo.index', 'Retour', [$exp->id], ['class' => 'btn btn-info']) }}
              {!! Form::close() !!}
          </div>
          </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Pièce suivante</h4>
              </div>
              <div class="modal-body">
                <img id="image_link" src="{{ URL::asset('/img/'.$exp->id.'/'.$exp->photo.'.PNG') }}" alt="immovr" class="photo" href="">
              </div>
              <div class="modal-footer">
                <a id="bouttonLink"></a>
                {!! Form::open(array('route'=>['exp.photo.hotspot.show', $exp->id, $id, $id], 'method'=>'GET')) !!}
                <input id="idLink" type="text" name="spot" value="" hidden>
                <input type="text" name="combien" value="unique" hidden>
                {!! Form::button('test link', ['class'=>'btn btn-info', 'type'=>'submit']) !!}
                {!! Form::close() !!}
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                {!! Form::open(array('route'=>['exp.photo.hotspot.destroy', $exp->id, $id, $id], 'method'=>'DELETE')) !!}
                <input id="idLink" type="text" name="spot" value="" hidden>
                <input type="text" name="combien" value="unique" hidden>
                {!! Form::button('supprimer le hotspot', ['class'=>'btn btn-danger', 'type'=>'submit']) !!}
                {!! Form::close() !!}
              </div>
            </div>
          </div>
        </div>
      <!-- JavaScripts -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script   src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>

      <script>
      $(document).ready(function(e) {
            // $('#displayHotspot').click(function(e) {
            var H = $('.hotspotArea').height();
            var W = $('.hotspotArea').width();
            // récupération des positions
            @for ($spot = 0; $spot < sizeOf($hotspots); $spot++)
            var x = '{{$hotspots[$spot]->position_x}}';
            var y = '{{$hotspots[$spot]->position_y}}';
            //CALCUL CONVERSION longitude lattitude POUR OLIVIA
            //=================================================
            var posx = Number(W) * Number(x);
            var posy = Number(H) * Number(y);
           $('.hotspotTarget').append('<div id="'+'{{$hotspots[$spot]->id}}'+'" data-id="'+{{$hotspots[$spot]->id}}+'" data-link="'+{{$hotspots[$spot]->image_link}}+'" class="circleSmall" style="background-color:red;position:absolute;width:20px;top:'+posy+';left:'+posx+';" onclick="myFunction(this.id)" data-toggle="modal" data-target="#myModal"></div>');
            console.log(posx, posy, x, y);
            @endfor
      });

      function myFunction(id) {      // console.log($('#'+id).data("link"), id);
          document.getElementById("image_link").setAttribute("src",'/img/'+{{$exp->id}}+'/'+$('#'+id).data("link")+'.PNG');
          document.getElementById("idLink").setAttribute("value", $('#'+id).data("link"));
          $('#bouttonLink').html('<a href="/exp/'+{{$exp->id}}+'/photo/'+$('#'+id).data("link")+'/hotspot" class="btn btn-success">Go !index </a>');
      }
      </script>
    </div>
    @yield('content')
</div>

@endsection
