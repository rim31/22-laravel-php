@extends('layouts.app')

@section('content')
<!-- <link rel="stylesheet" href="{{ URL::asset('css/style.css')}}" />-->
<link rel="stylesheet" href="{{ URL::asset('css/hotspotArea.css')}}" />

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <!-- <div class="panel-heading"><h5>{{$exp->name}}</h5></div>
                <div class="panel-body"> -->
                    <!-- <div>
                        <h4>vos hotspots</h4>
                    </div> -->
                    <!-- ======================== afficher l'image ================================ -->
                    <DIV  id="Hospot" class="hotspotArea">
                        <div class="hotspotTarget">
                            <img src="{{ URL::asset('/img/'.$exp->id.'/'.$id.'.JPG') }}" alt="immovr" class="photo">
                        </div>
                    </DIV>
                    <DIV class="col-sm-10">
                        <button id="displayHotspot" type="button" class="btn btn-success">Afficher les hotspots</button>
                    </DIV>
                    <DIV class="col-sm-2">
                        {{ link_to_route('exp.photo.index', 'Retour', [$exp->id], ['class' => 'btn btn-info']) }}
                    </DIV>
                    {!! Form::close() !!}
                </DIV>

            <!-- JavaScripts -->

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <!-- <script language="JavaScript" type="text/javascript" src="{{ URL::asset('js/carousel.js') }}"></script> -->
            <script   src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>

            <script>
            $('#displayHotspot').click(function(e) {
                var H = $('.hotspotArea').height();
                var W = $('.hotspotArea').width();
                // récupération des positions
                @for ($spot = 0; $spot < sizeOf($hotspots); $spot++)
                var x = '{{$hotspots[$spot]->position_x}}';
                var y = '{{$hotspots[$spot]->position_y}}';
                //CALCUL CONVERSION longitude lattitude POUR OLIVIA
                //=================================================
                                // var x = 0;
                                // var y = 0;
                // x = '{{$hotspots[$spot]->longitude}}';
                // y = '{{$hotspots[$spot]->latitude}}';
                // var xx = Number(x);
                // var spotX = (xx + 180) * H / 360;
                // var yy = Number(y);
                // var spotY = (90 - yy) * (W / 180);
                // console.log('{{$hotspots[$spot]->longitude}}' ,' => ', spotX, '{{$hotspots[$spot]->latitude}}' ,' => ', spotY);//'{{$hotspots[$spot]}}'
                // // $('.hotspotTarget').append('<div id="'+x+'" class="circleLarge" style="position:absolute top:"'+spotX+'" left:"'+spotY+'" width:20px;"></div>');
                // //attention inversion X Y ou  Longitude et latitude mais bonne position
                // $('.hotspotTarget').append('<div id="'+{{$hotspots[$spot]->id}}+'" class="circleLarge" style="background-color:hotpink;position:abolute;width:20px;top:'+spotX+';left:'+spotY+';"></div>');
                // // $('.hotspotTarget').append('<div id="'+x+'" style="background-color:"red" position:"abolute" witdh:"20px"  top:"'+spotY+'"left:"'+spotY+'";"></div>');

                var posx = Number(W) * Number(x);
                var posy = Number(H) * Number(y);
                $('.hotspotTarget').append('<div id="'+{{$hotspots[$spot]->id}}+'" class="circleSmall" style="background-color:red;position:abolute;width:20px;top:'+posy+';left:'+posx+';"></div>');
                @endfor
            });
            </script>
        </DIV>
    </DIV>
</DIV>
</nav>

@yield('content')

</main>

</body>

@endsection
