<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="favicon" type="image/png" href="<?php echo e(URL::asset('/img/favicon/favicon.png')); ?>"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    @import  url('https://fonts.googleapis.com/css?family=Roboto');
    </style>
    <title>immoVR</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <?php /* <link href="<?php echo e(elixir('css/app.css')); ?>" rel="stylesheet"> */ ?>
    <link rel="stylesheet" href="<?php echo e(URL::asset('/css/bootstrapCSS/bootstrap.min.css')); ?>">
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top" style="margin: 0;">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">

                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                   <link rel="stylesheet" href="<?php echo e(URL::asset('/css/homePage.css')); ?>">

                   <li><a id="logo" href="<?php echo e(url('/')); ?>"><img src="<?php echo e(URL::asset('/img/immovr.png')); ?>" alt="immovr" ></a></li>
                   <li><a href="<?php echo e(url('/exp')); ?>">Experience</a></li>
                   <li><a href="<?php echo e(url('/demo')); ?>">Carousel</a></li>
                    <li class="form-group searchBar">
                        <input type="text" class="form-control" placeholder="Search">
                    </li>
               </ul>

               <!-- Right Side Of Navbar -->
               <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                <?php if(Auth::guest()): ?>
                <li><a href="<?php echo e(url('/login')); ?>">Login</a></li>
                <li><a href="<?php echo e(url('/register')); ?>">Register</a></li>
                <?php else: ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Menu<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo e(url('/exp')); ?>">Experience</a></li>
                        <li><a href="<?php echo e(url('/hotspot')); ?>">Ajouter Hostspot</a></li>

                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo e(url('/logout')); ?>"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                    </ul>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<?php echo $__env->yieldContent('content'); ?>

<!-- JavaScripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>


<!-- script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script> -->

<?php /* <script src="<?php echo e(elixir('js/app.js')); ?>"></script> */ ?>
<!--         <script src="//cdnjs.cloudflare.com/ajax/libs/interact.js/1.2.6/interact.min.js"></script>//JS de l'interaction -->
<script src="<?php echo e(URL::asset('/js/bootstrapJS/bootstrap.min.js')); ?>"></script>
</body>
</html>
