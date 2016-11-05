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
<!--             <div class="col-sm-7">
                <button id="displayHotspot" type="button" class="btn btn-success">Afficher les hotspots</button>
            </div> -->
            <div class="col-sm-3">
              {!! Form::open(array('route'=>['exp.photo.hotspot.destroy', $exp->id, $id, 0], 'method'=>'DELETE')) !!}
              <input type="text" name="image" value="{{$id}}" hidden>
              {!! Form::button('supprimer les hotspots', ['class'=>'btn btn-danger', 'type'=>'submit']) !!}
              {!! Form::close() !!}
          </div>
          <div class="col-sm-2">
              {{ link_to_route('exp.photo.index', 'Retour', [$exp->id], ['class' => 'btn btn-info']) }}
          </div>
              {!! Form::close() !!}
           <!-- ======================== afficher l'image ================================ -->
           <div  id="Hospot" class="hotspotArea col-md-12">
            <div class="hotspotTarget">
             <img src="{{ URL::asset('/img/'.$exp->id.'/'.$id.'.PNG') }}" alt="immovr" class="photo">
            </div>
           </div>
          </div>
        </div>

<!-- JavaScripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script   src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>

        <script>
        $(document).ready(function(e) {//afficher sans clic des hotspots
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
                $('.hotspotTarget').append('<div id="'+{{$hotspots[$spot]->id}}+'" class="circleSmall" style="background-color:red;position:abolute;width:20px;top:'+posy+';left:'+posx+';"></div>');
                console.log(posx, posy, x, y);

                @endfor
            });
        </script>
    </div>
    @yield('content')
</div>



@endsection
