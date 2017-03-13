<head>
  <title>ImmoVR QuartzVR by XXII</title>

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
  <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('img/quartz-package/goto_active.png') }}" >
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



<?php flush(); ?>
<div class="row">
  <div class="container">


    <div class="">
      <div class="">
        <script>
          QuartzVR.createPlayer("Player",
          {
            dataSrc : "{{ URL::asset('img/exp/'.$id.'/tour.xml') }}",
            isInteractive : true
          });
        </script>
      </div>
    </div>

  </div>
</div>
