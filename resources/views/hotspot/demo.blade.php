@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ URL::asset('css/style.css')}}" />
<div class="parent">
    <div id="spot" class="draggable">
        <p>placer</BR>hotspot
        </p>
    </div>
    <body id="app-layout">
        <div class="3dPhoto">

            <main>
                <nav class="navbar navbar-default navbar-static-top">
                    <div class="container">
                        <div class="navbar-header">

                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#myCarousel" data-slide-to="1"></li>
                                    <li data-target="#myCarousel" data-slide-to="2"></li>
                                    <li data-target="#myCarousel" data-slide-to="3"></li>
                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">
                                    <div class="item active">
                                        <img src="img/1/7.JPG" alt="Chania">
                                        <div class="carousel-caption">
                                            <h3>Chania</h3>
                                            <p>The atmosphere in Chania has a touch of Florence and Venice.</p>
                                        </div>
                                    </div>

                                    <div class="item">
                                        <img src="img/1/1.JPG" alt="Chania">
                                        <div class="carousel-caption">
                                            <h3>Chania</h3>
                                            <p>The atmosphere in Chania has a touch of Florence and Venice.</p>
                                        </div>
                                    </div>

                                    <div class="item">
                                        <img src="img/1/2.JPG" alt="Flower">
                                        <div class="carousel-caption">
                                            <h3>Flowers</h3>
                                            <p>Beatiful flowers in Kolymbari, Crete.</p>
                                        </div>
                                    </div>

                                    <div class="item">
                                        <img src="img/1/6.JPG" alt="Flower">
                                        <div class="carousel-caption">
                                            <h3>Flowers</h3>
                                            <p>Beatiful flowers in Kolymbari, Crete.</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Left and right controls -->
                                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>

                            <!-- JavaScripts -->

                            <script src="//cdnjs.cloudflare.com/ajax/libs/interact.js/1.2.6/interact.min.js"></script>

                            <script language="JavaScript" type="text/javascript" src="{{ URL::asset('js/dragndrop.js') }}"></script>

                        </div>
                    </div>
                </nav>

                @yield('content')

            </main>
        </div>

    </body>

    @endsection
