@extends('layouts.app')

@section('content')
<!-- ======= jQuery for add/remove new fiel input exp ====== -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- ======= 2.01 Page Title Area ====== -->
<div class="headerBanner"></div>
<ul class="breadcrumbNav">
  <a class="breadcrumb1" href="{{ url('/') }}">{{ trans('expcreate.home')}}</a>
  <a class="breadcrumb2" href="{{ url('/exp') }}">{{ trans('expcreate.myexp')}}</a>
  <a class="breadcrumb3">{{ trans('expcreate.create') }}</a>
</ul>
<div class="container">
  <div class="row createExpDiv">
    <div class="col-md-12">
      <h1 class="blueTitle mTop15 center">{{ trans('expcreate.fill') }}</h1>
      {!! Form::open(array('route' => 'exp.store','method'=>'POST', 'class' => ' col-md-12')) !!}
      <div class="error"></div>

      <div class="form-group col-md-12 mTop15">
        <p>{{ trans('expcreate.title') }}</p>
        {!! Form::text('name', null, ['class' =>'form-control contactInput ','maxlength' => '20']) !!}
      </div>
      <div class="form-group col-md-12">
        <p>{{ trans('expcreate.info') }}</p>
        {!! Form::text('about', null, ['class' =>'form-control contactInput','maxlength' => '50']) !!}
      </div>
    </div>

    <div class="col-md-12 center">
      <button class="btn btn-blue mBot15">{{ trans('expcreate.btncreate') }}</button>
      {!! Form::close() !!}
      <div class="center">
        {{ link_to_route('exp.index', trans('expcreate.cancel'), null, ['class' => 'btn btn-grey']) }}
      </div>
    </div>
  </div>
</div>

<script>

$(document).ready(function() {
  var max_fields      = 10; //maximum input boxes allowed
  var wrapper         = $(".input_fields_wrap"); //Fields wrapper
  var add_button      = $(".add_field_button"); //Add button ID

  var x = 1; //initlal text box count
  $('.blocAjoutChampExp').on('keypress', function (e) {
    var ingnore_key_codes = [34, 39];
    if ($.inArray(e.which, ingnore_key_codes) >= 0) {
      e.preventDefault();
      $(".error").html("Caractère invalide !").show();
    } else {
      $(".error").hide();
    }
  });
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

  $(add_button).click(function(e){ //on add input button click
    e.preventDefault();
    if(x < max_fields){ //max input box allowed
      x++; //text box increment
      $(wrapper).append('<div id="valeurInterdite" ><input type="text" name="mytext[]" maxlength="50" class="form-control contactInput blocAjoutChampExp"/><a href="#" class="remove_field">Delete</a></div>'); //add input box
    }
  });



  $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
    e.preventDefault(); $(this).parent('div').remove(); x--;
  })

});


</script>

@endsection
