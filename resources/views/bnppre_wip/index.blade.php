<!DOCTYPE html>
<html>
<head>
    <title>Coucou</title>

    <link type="text/css" rel="stylesheet" href="{{ URL::asset('styleQuartz/style.css') }}"/>
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('styleQuartz/quartz.css') }}"/>


    <meta name="viewport" content="width=device-width, user-scalable=no, minimal-ui"/>
    <meta property="og:type" content="website" />

    <script type="text/javascript" src="{{ URL::asset('scriptsQuartz/platform.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('scriptsQuartz/three.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('scriptsQuartz/quartz.min.js') }}"></script>

</head>
<body>
    <div id="player" class="quartz-player" data-xml="quartz.xml"></div>
    <div id="logo"></div>
    <div id="target"></div>
    <div id="cover"></div>
</body>
</html>
