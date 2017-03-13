@extends('layouts.app')


<head>
  <title>QuartzVR by XXII</title>

  <meta name="viewport" content="width=device-width initial-scale=1.01 minimal-ui user-scalable=no" />
  <meta name="quartz-license" content="./serial_number.sn" />
  <link rel="manifest" href="img/quartz-package/favicon/manifest.json">

  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
  <meta property="og:type" content="website" />

  <link type="text/css" rel="stylesheet" href="{{ URL::asset('style/nouislider.css') }}"/>
  <link type="text/css" rel="stylesheet" href="{{ URL::asset('style/style.css') }}" />
  <link type="text/css" rel="stylesheet" href="{{ URL::asset('style/quartz.css') }}" />
  <link type="text/css" rel="stylesheet" href="{{ URL::asset('style/quartz-video.css') }}" />

  <!-- Favicon part -->
  <link rel="apple-touch-icon" sizes="57x57" href="{{ URL::asset('img/quartz-package/favicon/apple-icon-57x57.png') }}" >
  <link rel="apple-touch-icon" sizes="60x60" href="{{ URL::asset('img/quartz-package/favicon/apple-icon-60x60.png') }}" >
  <link rel="apple-touch-icon" sizes="72x72" href="{{ URL::asset('img/quartz-package/favicon/apple-icon-72x72.png') }}" >
  <link rel="apple-touch-icon" sizes="76x76" href="{{ URL::asset('img/quartz-package/favicon/apple-icon-76x76.png') }}" >
  <link rel="apple-touch-icon" sizes="114x114" href="{{ URL::asset('img/quartz-package/favicon/apple-icon-114x114.png') }}" >
  <link rel="apple-touch-icon" sizes="120x120" href="{{ URL::asset('img/quartz-package/favicon/apple-icon-120x120.png') }}" >
  <link rel="apple-touch-icon" sizes="144x144" href="{{ URL::asset('img/quartz-package/favicon/apple-icon-144x144.png') }}" >
  <link rel="apple-touch-icon" sizes="152x152" href="{{ URL::asset('img/quartz-package/favicon/apple-icon-152x152.png') }}" >
  <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('img/quartz-package/favicon/apple-icon-180x180.png') }}" >
  <link rel="icon" type="image/png" sizes="192x192" href="{{ URL::asset('img/quartz-package/favicon/android-icon-192x192.png') }}" >
  <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('img/quartz-package/favicon/favicon-32x32.png') }}" >
  <link rel="icon" type="image/png" sizes="96x96" href="{{ URL::asset('img/quartz-package/favicon/favicon-96x96.png') }}" >
  <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('img/quartz-package/favicon/favicon-16x16.png') }}" >
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="img/quartz-package/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <!-- End of favicon -->


  <!-- Custom style  -->
  <link rel="stylesheet" href="{{ URL::asset('style/css/quartz.css') }}">


  <!-- Inserting dependencies for QuartzVR -->
  <script type="text/javascript" src="{{ URL::asset('scripts/quartz.js') }}" ></script>

  <!-- End -->
</head>

@section('content')

<div class="headerBanner"></div>
<ul class="breadcrumbNav">
  <a class="breadcrumb1" href="{{ url('/') }}">{{ trans('quartz.home')}}</a>
  <a class="breadcrumb2" href="{{ url('/exp') }}">{{ trans('quartz.myexp')}}</a>
  <a class="breadcrumb3" href="{{route('exp.photo.index',[$exp->id])}}">{{ trans('quartz.photo')}}</a>
  <a class="breadcrumb4">{{ trans('quartz.vr')}}</a>
</ul>

<div class="container headerExp">
  <div class="row">
    <div class="col-md-12 text-center" data-animate-effect="fadeIn">
      <h1 class="blueTitle mrg3prct">{{ trans('quartz.title') }}</h1>
    </div>
    <div class="col-sm-12 wrapButton mrg3prct center">
      <div>
        <a href="{{route('exp.photo.index',[$exp->id])}}"<button class="btn btn-grey">{{ trans('quartz.back')}}</button></a>
      </div>
      <div>
        <div onclick="myFunction()" class="btn btn-blue">{{ trans('quartz.more')}}</div>
      </div>
    </div>
    <div id="embedHidden" style="display: none"><!-- mieux verouiller les liens pour pas se les faire piquer-->
      <p class="wordBreak center">{{ trans('quartz.title1') }}</p>
    </div>
  </div>
</div>
</div>

<?php flush(); ?>
  <div class="col-md-12 mrgBottom3prct">
    <div class="embedPlayer">
      <script>
        QuartzVR.createPlayer("Player",
        {
          dataSrc : "img/exp/{{$exps[0]->option_2}}/tour.xml",
          isInteractive : true
        });
      </script>
  </div>
</div>

<script>

  function myFunction() {
    var x = document.getElementById('embedHidden');
    if (x.style.display === 'none') {
      x.style.display = 'block';
    } else {
      x.style.display = 'none';
    }
  }
</script>
@endsection
