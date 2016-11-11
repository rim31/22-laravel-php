@extends('layouts.app')

@section('content')
<div class="pageTitleArea animated">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="h3">Hotspot</div>
        <ul class="pageIndicate">
          <li><a href="">expérience</a></li>
          <li><a href="">photo</a></li>
          <li><a href="">hotspot show</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>


<div class="singleBlogArea secPdng">
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1 sBlogCol">
        <article class="singleBlog">
         <h2>{{$exp->name}}</h2>
        <h4>vos hotspots</h4>
      </div>
      <div class="panel-body">
        <!-- ======================== afficher l'image ================================ -->
        <div  id="Hospot" class="hotspotArea col-md-12">
          <div class="hotspotTarget">
           <img src="{{ URL::asset('/img/'.$exp->id.'/'.$id.'.PNG') }}" alt="immovr" class="photo">
         </div>
       </div>
  </div>
               <!-- ======================== bouton suppr et retour ================================ -->
      <div class="flexModalHotspotContainer">
       <div class="">
        {!! Form::open(array('route'=>['exp.photo.hotspot.destroy', $exp->id, $id, 0], 'method'=>'DELETE')) !!}
        <input type="text" name="image" value="{{$id}}" hidden>
        <input type="text" name="combien" value="tous" hidden>
        {!! Form::button('supprimer les hotspots', ['class'=>'btnCart Btn added', 'type'=>'submit']) !!}
        {!! Form::close() !!}
      </div>
      <div class="">
        {{ link_to_route('exp.photo.index', 'Retour', [$exp->id], ['class' => 'btnCart Btn']) }}
        {!! Form::close() !!}
      </div>
     </div> 


  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
              fermer <i class="fa fa-times-circle-o" aria-hidden="true"></i>
            </span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Pièce suivante</h4>
        </div>
        <div class="modal-body">
          <img id="image_link" src="{{ URL::asset('/img/'.$exp->id.'/'.$exp->photo.'.PNG') }}" alt="immovr" class="photo" href="">
        </div>
        <div class="modal-footer">
          <div class="flexModalHotspotContainer">
            <div id="bouttonLink"></div>
            {!! Form::open(array('route'=>['exp.photo.hotspot.show', $exp->id, $id, $id], 'method'=>'GET')) !!}
            <input id="idLinkIndex" type="text" name="spot" value="" hidden>
            <input type="text" name="combien" value="unique" hidden>
            {!! Form::button('GO !', ['class'=>'cartBtn Btn add', 'type'=>'submit']) !!}
            {!! Form::close() !!}

<!--             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->

            {!! Form::open(array('route'=>['exp.photo.hotspot.destroy', $exp->id, $id, $id], 'method'=>'DELETE')) !!}
            <input id="idLinkDel" type="text" name="spot" value="" hidden>
            <input type="text" name="combien" value="unique" hidden>
            {!! Form::button('supprimer le hotspot', ['class'=>'btnCart Btn added', 'type'=>'submit']) !!}
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>



  <!-- JavaScripts -->
  <script   src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>

  <script>
  //garder le script ici car il fait appel au tableau de valeur des positions des spots de cette page laors que l'autre script ne peut pas dans le fichier seul
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
    $('.hotspotTarget').append('<div id="'+'{{$hotspots[$spot]->id}}'+'" data-link="'+{{$hotspots[$spot]->image_link}}+'" class="circleSmall" style="background-color:dodgerblue;position:absolute;width:20px;top:'+posy+';left:'+posx+';" onclick="myFunction(this.id)" data-toggle="modal" data-target="#myModal"></div>');
    // console.log(posx, posy, x, y);
    @endfor
  });

  function myFunction(id) {
      // alert(id);
      console.log($('#'+id).data("link"), id);
      document.getElementById("image_link").setAttribute("src",'/img/'+{{$exp->id}}+'/'+$('#'+id).data("link")+'.PNG');
      document.getElementById("idLinkDel").setAttribute("value", id);
      document.getElementById("idLinkIndex").setAttribute("value", $('#'+id).data("link"));
      $( "#idLinkDel" ).$("input").val( id);
    }
  </script>
</div>

@yield('content')
</div>



@endsection
