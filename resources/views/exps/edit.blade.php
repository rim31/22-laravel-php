@extends('layouts.app')

@section('content')
<!-- ======= jQuery for add/remove new fiel input exp ====== -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>  -->
<head>
  <script
  src="https://code.jquery.com/jquery-3.1.1.slim.min.js"
  integrity="sha256-/SIrNqv8h6QGKDuNoLGA4iret+kyesCkHGzVUUV0shc="
  crossorigin="anonymous"></script>
</head>

<div class="headerBanner"></div>
<ul class="breadcrumbNav">
  <a class="breadcrumb1" href="{{ url('/') }}">{{ trans('expedit.home')}}</a>
  <a class="breadcrumb2" href="{{ url('/exp') }}">{{ trans('expedit.myexp')}}</a>
  <a class="breadcrumb3">{{ trans('expedit.edittitle') }}</a>
</ul>
<div class="container mrg5prct">
  <div class="row">
    <div class="col-md-12">
      <h1 class="blueTitle center">Edit your experience</h1>
      <div class="wrapButton mrg5prct col-md-12">
        {{ link_to_route('exp.photo.index', trans('expedit.editps'), [$exp->id], ['class' => 'btn btn-blue']) }}
        {{ link_to_route('exp.index', trans('expedit.back'), [$exp->id], ['class' => 'btn btn-grey']) }}
      </div>
      <h1 class="blueTitle center">{{ trans('expedit.change') }}</h1>
      {!! Form::model($exp, array('route' => ['exp.update', $exp->id], 'method'=>'PUT')) !!}
      <div class="error"></div>
      <div class="form-group col-sm-12">
        <p>{{ trans('expedit.title') }}</p>
        {!! Form::text('name', null, ['class' =>'form-control contactInput ','maxlength' => '20']) !!}
      </div>
      <div class="form-group col-sm-12">
        <p>{{ trans('expedit.info') }}</p>
        {!! Form::text('about', null, ['class' =>'form-control contactInput','maxlength' => '50']) !!}
      </div>
    </div>
  </div>
  <div class="col-md-12 center">
    <button class="btn btn-blue">{{ trans('expedit.send') }}</button>
    {!! Form::close() !!}
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
    $(wrapper).append('<div><input type="text" name="mytext[]" class="form-control contactInput blocAjoutChampExp" value="'+unescape(mot[pas])+'"/><a href="#" class="remove_field">Delete</a></div>');
    //add input box
  }

  x = 1; //initlal text box count
  $(add_button).click(function(e){ //on add input button click
    e.preventDefault();
    if(x < max_fields){ //max input box allowed
      x++; //text box increment
      $(wrapper).append('<div><input type="text" name="mytext[]" maxlength="50" class="form-control contactInput blocAjoutChampExp"/><a href="#" class="remove_field">Delete</a></div>'); //add input box
    }
  });

  $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
    e.preventDefault(); $(this).parent('div').remove(); x--;
  })
});

</script>

@endsection
