@extends('layouts.app')

@section('content')

  <head>
    <link rel="stylesheet" href="{{ URL::asset('style/css/hotspotArea.css')}}" />
    <!-- hotspot page css -->
    <link rel="stylesheet" href="{{ URL::asset('remodal/remodal.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('remodal/remodal-default-theme.css') }}">
    <script  src="https://code.jquery.com/jquery-2.2.4.min.js"  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="  crossorigin="anonymous"></script>
  </head>

  <div class="headerBanner"></div>
  <ul class="breadcrumbNav">
    <a class="breadcrumb1" href="{{ url('/') }}">{{ trans('spotshow.home')}}</a>
    <a class="breadcrumb2" href="{{ url('/exp') }}">{{ trans('spotshow.myexp')}}</a>
    <a class="breadcrumb3" href="{{route('exp.photo.index',[$exp->id])}}">{{ trans('spotshow.photo')}}</a>
    <a class="breadcrumb4" href="">{{ trans('spotshow.show')}}</a>
  </ul>
  <div class="container">
    <div class="row">
      <div class="col-md-12 showHotspotSection">
        <div class="wrapButton">
          <h3 class="blueTitle mrg5prct">{{ trans('spotshow.title')}}</h3>
        </div>
        <div class="wrapButton center">
          <!-- =========== bouton suppr et retour ============= -->
          <div> {{ link_to_route('exp.photo.hotspot.create', trans('spotshow.addspt'), [$exp->id, $id], ['class' => 'btn btn-green']) }}</div>
          <!-- ///////remodal//////// -->
          <a data-remodal-target="modal"><button class="btn btn-red" data-toggle="tooltip" data-placement="top" title="delete every hotspots">{{ trans('spotshow.del')}}</button></a>
        </div>

        <!-- //////////////////RE-MODAL////////////////    -->
        <div class="remodal" data-remodal-id="modal"
             data-remodal-options="hashTracking: false, closeOnOutsideClick: false">

          <button data-remodal-action="close" class="remodal-close"></button>
          <p>
            {{ trans('spotshow.delall')}}
          </p>
          <br>
          <div class="wrapButton">
            <div>
              {!! Form::open(array('route'=>['exp.photo.hotspot.destroy', $exp->id, $id, 0], 'method'=>'DELETE')) !!}
              <input type="text" name="image" value="{{$id}}" hidden>
              <input type="text" name="combien" value="tous" hidden>
              {!! Form::button(trans('spotshow.del'), ['class'=>'btn btn-red', 'type'=>'submit']) !!}
              {!! Form::close() !!}
            </div>
            <div>
              <button data-remodal-action="cancel" class="btn btn-grey">{{ trans('spotshow.cancel')}}
              </button>
            </div>
          </div>
        </div>

      </div>
      <!-- ///////////////////////////////////////////// -->

      <div class="col-md-12">
        <div class="flexslider">
          <ul class="slides">
            <!-- ========================================= -->
            <!-- ========== afficher l'image ==============-->
            <div id="Hospot" class="hotspotArea">
              <div id="photoClick" class="hotspotTarget">
                <div class="hotspotTargetCreate">
                  <img src="{{ URL::asset('/img/exp/'.$exp->option_2.'/'.$id.'.PNG') }}" alt="immovr" class="photo">
                </div>
              </div>
            </div>
          </ul>
          <div class="wrapButton col-md-12">
            <h1 class="blueTitle mrg5prct">{{ trans('spotshow.title1') }}</h1>
          </div>
        </div>
      </div>

      <!-- //////////////////RE-MODAL SPOT////////////////    -->
      <div class="row">
        <div class="col-md-10">
          <div class="remodal" data-remodal-id="#myModal"
               data-remodal-options="hashTracking: false, closeOnOutsideClick: false">

            <button data-remodal-action="close" class="remodal-close"></button>
            <h1 class="left mrg3prct">{{ trans('spotshow.next') }}</h1>
            <p class="left">
              <img class="image_link previewImg" src="{{ URL::asset('/img/exp/'.$exp->option_2.'/'.$exp->photo.'.PNG') }}"/>
            </p>
            <br>
            <div id="bouttonLink"></div>
            {!! Form::open(array('route'=>['exp.photo.hotspot.show', $exp->id, $id, $id], 'method'=>'GET')) !!}
            <input id="idLinkIndex" type="text" name="spot" value="" hidden>
            <input type="text" name="combien" value="unique" hidden>
            <div class="left">{!! Form::button(trans('spotshow.go'), ['class'=>'btn btn-blue', 'type'=>'submit']) !!}</div>
            {!! Form::close() !!}

            {!! Form::open(array('route'=>['exp.photo.hotspot.destroy', $exp->id, $id, $id], 'method'=>'DELETE')) !!}
            <input id="idLinkDel" type="text" name="spot" value="" hidden>
            <input type="text" name="combien" value="unique" hidden>
            <div class="left">{!! Form::button( trans('spotshow.delspot') , ['class'=>'btn btn-red', 'type'=>'submit']) !!}</div>
            {!! Form::close() !!}.

          </div>
        </div>
      </div>
    </div>
    <!-- ///////////////////////////////////////////// -->
    <div class="wrapButton">
      <!-- =========== bouton suppr et retour ============= -->
      <div class="center">{{ link_to_route('exp.photo.index', trans('spotshow.back'), [$exp->id], ['class' => 'btn btn-grey']) }}
      </div>
    </div>


    <div id="urlAsset" hidden="true">{{ URL::asset('/') }}</div>
    <div class="addSpot" id="createButton" hidden>
      {!! Form::open(array('route'=>['exp.photo.hotspot.create', $exp->id, $id, 0], 'method'=>'GET')) !!}
      <input id="x" type="text" name="x" value="" hidden>
      <input id="y" type="text" name="y" value="" hidden>
    {!! Form::button(trans('spotshow.addspt'), ['class'=>'btn btn-hotspot', 'type'=>'submit']) !!}
    {!! Form::close() !!}
    <!-- {{ link_to_route('exp.photo.hotspot.create', trans('spotshow.addspt'), [$exp->id, $id], ['class' => 'btn btn-hotspot']) }} -->
    </div>
  </div>
  </div>
  <script language="JavaScript" type="text/javascript" src="{{ URL::asset('scripts/js/addButtonCreateHotspot.js') }}"></script>

  <!-- JavaScripts -->
  <script>
      $(window).resize(function(){location.reload();});


      //garder le script ici car il fait appel au tableau de valeur des positions des spots de cette page alors que l'autre script ne peut pas dans le fichier seul
      $(document).ready(function(e) {
          // $('#displayHotspot').click(function(e) {
          var H;
          var W;
          var x;
          var y;
          var posx;
          var posy;
          var spot;
          var hotspots;

          // var H = $('.hotspotArea').height();
          // var W = $('.hotspotArea').width();
          H = $('.hotspotArea').height();
          W = $('.hotspotArea').width();
          // récupération des positions
        @for ($spot = 0; $spot < sizeOf($hotspots); $spot++)
          // var x = '{{$hotspots[$spot]->position_x}}';
          // var y = '{{$hotspots[$spot]->position_y}}';
          x = '{{$hotspots[$spot]->position_x}}';
          y = '{{$hotspots[$spot]->position_y}}';
          //CALCUL CONVERSION longitude lattitude POUR OLIVIA
          //=================================================
          // var posx = Number(W) * Number(x);
          // var posy = Number(H) * Number(y);
          posx = Number(W) * Number(x);
          posy = Number(H) * Number(y);
          //on refresh la page au cas ou le hotspot se trouve pas à la bonne position
          // if ($hotspots[$spot]->position_y != 0 && y == 0) {
          //   location.reload();
          // }


          $('.hotspotTarget').append('<div id="{{$hotspots[$spot]->id}}" data-link="{{$hotspots[$spot]->image_link}}" class="circleSmall" style="background-color:dodgerblue;width:20px;position:absolute;top:'+posy+'px;left:'+posx+'px;" onclick="hotspotClickable(this.id)" data-toggle="remodal" data-remodal-target="#myModal"></div>');
          // console.log(posx, posy, x, y);
        @endfor
      });

      function hotspotClickable(id) {
          //on rend le hotspot cliquable et effacable
          var url = $('#urlAsset').html();

          var idImageFolder = "{{$exp->option_2}}";

          $(".image_link").attr("src",url+'img/exp/'+idImageFolder+'/'+$('#'+id).data("link")+'.PNG');
          $("#idLinkDel").attr("value", id);
          $("#idLinkIndex").attr("value", $('#'+id).data("link"));
          $( "#idLinkDel" ).$("input").val( id);
      }


  </script>
@endsection
