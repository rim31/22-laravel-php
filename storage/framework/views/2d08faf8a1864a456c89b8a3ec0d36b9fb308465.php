<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(URL::asset('css/style.css')); ?>" />
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


                            <div class="container">
                                <div id="main_area">
                                    <!-- Slider -->
                                    <div class="row">
                                        <div class="col-sm-12" id="slider">
                                            <!-- Top part of the slider -->
                                            <div class="row">
                                                <div class="col-sm-8" id="carousel-bounding-box">
                                                    <div class="carousel slide" id="myCarousel">
                                                        <!-- Carousel items -->
                                                        <div class="carousel-inner">
                                                            <div class="active item" data-slide-number="0">
                                                                <img src="/img/1/1.jpg">
                                                            </div>
                                                            <div class="item" data-slide-number="1">
                                                                <img src="/img/1/2.jpg">
                                                            </div>
                                                            <div class="item" data-slide-number="2">
                                                                <img src="/img/1/10.JPG">
                                                            </div>
                                                            <div class="item" data-slide-number="3">
                                                                <img src="/img/1/11.JPG">
                                                            </div>
                                                            <div class="item" data-slide-number="4">
                                                                <img src="/img/1/14.JPG">
                                                            </div>
                                                            <div class="item" data-slide-number="5">
                                                                <img src="http://placehold.it/770x300&text=six">
                                                            </div>
                                                        </div>
                                                        <!-- Carousel nav -->
                                                        <a class="carousel-control left" data-slide="prev" href="#myCarousel">‹</a>
                                                        <a class="carousel-control right" data-slide="next" href="#myCarousel">›</a>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4" id="carousel-text"></div>

                                                <div id="slide-content" style="display: none;">
                                                    <div id="slide-content-0">
                                                        <h2>Slider One</h2>
                                                        <p>Lorem Ipsum Dolor</p>
                                                        <p class="sub-text">October 24 2012 - <a href="#">Read more</a></p>
                                                    </div>

                                                    <div id="slide-content-1">
                                                        <h2>Slider Two</h2>
                                                        <p>Lorem Ipsum Dolor</p>
                                                        <p class="sub-text">October 24 2012 - <a href="#">Read more</a></p>
                                                    </div>

                                                    <div id="slide-content-2">
                                                        <h2>Slider Three</h2>
                                                        <p>Lorem Ipsum Dolor</p>
                                                        <p class="sub-text">October 24 2012 - <a href="#">Read more</a></p>
                                                    </div>

                                                    <div id="slide-content-3">
                                                        <h2>Slider Four</h2>
                                                        <p>Lorem Ipsum Dolor</p>
                                                        <p class="sub-text">October 24 2012 - <a href="#">Read more</a></p>
                                                    </div>

                                                    <div id="slide-content-4">
                                                        <h2>Slider Five</h2>
                                                        <p>Lorem Ipsum Dolor</p>
                                                        <p class="sub-text">October 24 2012 - <a href="#">Read more</a></p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div><!--/Slider-->

                                    <div class="row hidden-phone" id="slider-thumbs">
                                        <div class="col-sm-12">
                                            <!-- Bottom switcher of slider -->

                                            <ul class="thumbnails col-sm-11">
                                                <li></li>
                                                <a class="thumbnail, col-sm-2" id="carousel-selector-0"><img src="/img/1/1.jpg"></a>
                                                <a class="thumbnail, col-sm-2" id="carousel-selector-1"><img src="/img/1/2.jpg"></a>
                                                <a class="thumbnail, col-sm-2" id="carousel-selector-2"><img src="/img/1/6.JPG"></a>
                                                <a class="thumbnail, col-sm-2" id="carousel-selector-3"><img src="/img/1/16.JPG"></a>
                                                <a class="thumbnail, col-sm-2" id="carousel-selector-4"><img src="/img/1/13.JPG"></a>
                                                <a class="thumbnail, col-sm-2" id="carousel-selector-5"><img src="/img/1/15.JPG"></a>
                                            </ul>
                                        </div>
                                    </div>
                                </div>






                                <!-- JavaScripts -->

                                <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/interact.js/1.2.6/interact.min.js"></script> -->

                                <script language="JavaScript" type="text/javascript" src="<?php echo e(URL::asset('js/dragndrop.js')); ?>"></script>

                            </div>
                        </div>
                    </nav>

                    <?php echo $__env->yieldContent('content'); ?>

                </main>
            </div>

        </body>

        <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>