@extends('layouts.app')

@section('content')
<head>
  <script
  src="https://code.jquery.com/jquery-3.1.1.slim.min.js"
  integrity="sha256-/SIrNqv8h6QGKDuNoLGA4iret+kyesCkHGzVUUV0shc="
  crossorigin="anonymous"></script>
</head>

<div class="headerBanner"></div>
<ul class="breadcrumbNav">
  <a class="breadcrumb1" href="{{ url('/') }}">{{ trans('expshow.home')}}</a>
  <a class="breadcrumb2" href="{{ url('/exp') }}">{{ trans('expshow.myexp')}}</a>
  <a class="breadcrumb3">{{ trans('expshow.resume')}}</a>
</ul>
<div class="container">
  <div class="row">
    <div class="mrg3prct center">
      <h3> {{ trans('expshow.titleresum')}} {{ link_to_route('exp.show', $exp->name, [$exp->id]) }}</h3>
    </div>
    @if($exp->photo)
    <img class="resumeExpImg" src="{{ URL::asset('/img/exp/'.$exps[0]->option_2.'/'.$exp->photo.'.PNG') }}"></img>
    @else
    <div class="wrapButton">
      {{ link_to_route('exp.photo.index', 'Add photos', [$exp->id], ['class' => 'btn btn-green']) }}
    </div>
    @endif
    <div class="flexColSb center">
      <div>{{ trans('expshow.title')}}<a href="{{route('exp.photo.index',[$exp->id])}}" class="tag"> {{$exp->name}}</a></div>
      <div>{{ trans('expshow.info')}}<a href="{{route('exp.photo.index',[$exp->id])}}" class="tag"> {{$exp->about}}</a></div>
    </div>

    <div class="wrapButton center">
      <div><a href="{{route('exp.photo.index',[$exp->id])}}" class="btn btn-green">{{ trans('expshow.editphoto')}}</a></div>
      {!! Form::model($exp, array('route' => ['exp.update', $exp->id], 'method'=>'PUT')) !!}

      {!! Form::close() !!}

      <p><a href="{{route('exp.edit',[$exp->id])}}" class="btn btn-blue">{{ trans('expshow.editinfo')}}</a></p>
    </div>
  </div>
</div>


<script>

$( document ).ready(function() {
  var max_fields      = 10; //maximum input boxes allowed
  var wrapper         = $(".input_fields_wrap"); //Fields wrapper
  var add_button      = $(".add_field_button"); //Add button ID
  var results;
  var x;
  var mot;

  //on decode le tableau de valeur de champ option_1
  mot = JSON.parse('{{$exp->option_1}}'.replace(/&quot;/g,'"'));
  //on bloque le caractère " et ' dans les formulaires
  $('.form-control').on('keypress', function (e) {
    var ingnore_key_codes = [34, 39];
    if ($.inArray(e.which, ingnore_key_codes) >= 0) {
      e.preventDefault();
      $(".error").html("Caractère invalide !").show();
    } else {
      $(".error").hide();
    }
  });
  //on bloque le caractère " et ' dans les formulaires dynamiques
  $('.input_fields_wrap').on('keypress', function (e) {
    var ingnore_key_codes = [34, 39];
    if ($.inArray(e.which, ingnore_key_codes) >= 0) {
      e.preventDefault();
      $(".error").html("Caractère invalide !").show();
    } else {
      $(".error").hide();
    }
  });
  for (var pas in mot)
  {
    $(wrapper).append('<div><p name="mytext[]" class="contactInput blocAjoutChampExp wordBreak" >'+unescape(mot[pas])+'<p/></div>');
    //add input box
  }

  x = 1; //initlal text box count
  $(add_button).click(function(e){ //on add input button click
    e.preventDefault();
    if(x < max_fields){ //max input box allowed
      x++; //text box increment
      $(wrapper).append('<div><input type="text" name="mytext[]" class="form-control contactInput blocAjoutChampExp"/><a href="#" class="remove_field">Supprimer</a></div>'); //add input box
    }
  });

  $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
    e.preventDefault(); $(this).parent('div').remove(); x--;
  })
});

function myFunction() {
  var x = document.getElementById('infoSuppl');
  if (x.style.display === 'block') {
    x.style.display = 'none';
  } else {
    x.style.display = 'block';
  }
}
</script>

@endsection
