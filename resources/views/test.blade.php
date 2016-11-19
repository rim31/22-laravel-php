<!DOCTYPE html>
<html lang="fr">
<head>
	<link rel="favicon" type="image/png" href="{{ URL::asset('/img/favicon/favicon.png') }}"/>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>immoVR</title>

	<!-- main css file -->
	<link rel="stylesheet" href="css/custom/style.css">
	<!-- responsive css file -->
	<link rel="stylesheet" href="css/responsive/responsive.css">
	<!-- favicon -->
	<link rel="icon" type="image/png" href="img/favicon.png">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
  </head>
  <body class="hosting">

  	<div class="preloader">
  		<div class="sk-cube-grid">
  			<div class="sk-cube sk-cube1"></div>
  			<div class="sk-cube sk-cube2"></div>
  			<div class="sk-cube sk-cube3"></div>
  			<div class="sk-cube sk-cube4"></div>
  			<div class="sk-cube sk-cube5"></div>
  			<div class="sk-cube sk-cube6"></div>
  			<div class="sk-cube sk-cube7"></div>
  			<div class="sk-cube sk-cube8"></div>
  			<div class="sk-cube sk-cube9"></div>
  		</div>
  	</div>

  	<!-- ======= 1.01 Header Area ====== -->
  	<header>
  		<div class="headerTopArea">
  			<div class="container">
  				<div class="row">
  					<div class="col-md-5 col-sm-2 col-xs-5">
  						<div class="langOpt">
  							<span class="langIcon"><span class="langCode">en</span><i class="icofont icofont-caret-down"></i> </span>
  							<ul class="lang">
  								<li data-code="en">english</li>
  								<li data-code="bn">bengali</li>
  								<li data-code="ar">aribic</li>
  								<li data-code="da">dansk</li>
  							</ul>
  						</div>
  					</div>
  					<div class="col-md-7 col-sm-10 col-xs-7">
  						<ul class="topInfo">
  							<li class="call"><a href="tel:+214-5212-829"><i class="icofont icofont-ui-call"></i>+214-5212-829</a></li>
  							<li class="email"><a href="mailto:support@spark.com"><i class="icofont icofont-ui-v-card"></i>support@spark.com</a></li>
  							<!-- Endroit ou on mettra la connexion client -->
  							<!-- Authentication Links -->
  							@if (Auth::guest())
  							<li><a href="{{ url('/login') }}">Login</a></li>
  							<li><a href="{{ url('/register') }}">Register</a></li>
  							@else
  							<li class="dropdown">
  								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
  									{{ Auth::user()->name }} <span class="caret"></span>
  								</a>
  								<ul class="dropdown-menu" role="menu">
  									<li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
  								</ul>
  							</li>
  							@endif
  							<!-- <li class="clientAreaLi"><span><i class="icofont icofont-user-alt-3"></i>Client area</span></li> -->
  						</ul>
  						<div class="clientLogin">
  							<form action="login.php" method="post">
  								<div class="closeBtn"><i class="icofont icofont-close"></i></div>
  								<div class="h5">sign in</div>
  								<div class="userName"><input name="userName" placeholder="Username" type="text"></div>
  								<div class="password"><input name="password" placeholder="Password" type="password"></div>
  								<input type="submit" value="sign in">
  								<div class="h5">Forgot Passsword? <a href="#">Click here</a></div>
  								<div class="logBtm">
  									<div class="h5">Don’t have an account yet?</div>
  									<a href="#" class="signUp">Click here to sign up.</a>
  								</div>
  							</form>
  						</div>
  					</div>
  				</div>
  			</div>
  		</div>
  		<div class="headerBottomArea">
  			<div class="container">
  				<div class="row">
  					<div class="col-md-3 col-sm-3 col-xs-9">
  						<a href="index-1.html" class="logo"><img src="img/logo.png" alt=""></a>
  					</div>
  					<div class="col-md-8 menuCol col-sm-9 col-xs-9">
  						<div class="navbar-header">
  							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
  								<span class="sr-only"></span>
  								<i class="fa fa-navicon"></i>
  							</button>
  						</div>
  						<nav id="navbar" class="collapse navbar-collapse">
  							<ul id="nav">
  								<li><a href="#">Home</a>
  									<ul class="sub-menu">
  										<li><a href="index-1.html">Home Version 01</a></li>
  										<li><a href="index-2.html">Home Version 02</a></li>
  										@foreach($users as $user)
  										@if($user->id_user == Auth::user()->id)
  										@foreach($exps as $exp)
  										@if($user->id_exp == $exp->id AND $exp->delete != 1)
  										<li>{{ link_to_route('exp.show', $exp->name, [$exp->id]) }}</li>
  										@endif
  										@endforeach
  										@endif
  										@endforeach
  									</ul>
  								</li>
  								@if (!Auth::guest())
  								<li><a href="{{ url('/exp') }}">Mes expériences</a></li> 
  								@endif
  								<li><a href="contact.html">Contact</a></li>
  							</ul>
  						</nav>
  					</div>
  					<div class="col-md-1 cartCol">
  						<a href="cart.html" class="cart">
  							<span class="count">3</span>
  							<i class="icofont icofont-cart-alt"></i>
  						</a>
  					</div>
  				</div>
  			</div>
  		</div>
  	</header>
  	<!-- ======= /1.01 Header Area ====== -->


  	@yield('content')



  	<!-- ======= 1.09 footer Area ====== -->
  	<footer class="secPdngT animated">
  		<div class="container">
  			<div class="row">
  				<div class="col-sm-3">
  					<div class="footerInfo">
  						<a href="index-1.html" class="footerLogo">
  							<img src="img/footerLogo.png" alt="">
  						</a>
  						<div class="footerTxt">
  							<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh eui smod tincidunt ut laoreet dolore magna.</p>
  						</div>
  						<ul class="footerLinkIcon">
  							<li><a href="#"><i class="icofont icofont-social-facebook"></i></a></li>
  							<li><a href="#"><i class="icofont icofont-social-twitter"></i></a></li>
  							<li><a href="#"><i class="icofont icofont-social-google-plus"></i></a></li>
  							<li><a href="#"><i class="icofont icofont-social-tumblr"></i></a></li>
  							<li><a href="#"><i class="icofont icofont-social-yelp"></i></a></li>
  						</ul>
  					</div>
  				</div>
  				<div class="col-sm-3">
  					<div class="widget">
  						<div class="h4">Important Links</div>
  						<ul class="footerLink">
  							<li><a href="#">Support</a></li>
  							<li><a href="#">Privacy & Policy</a></li>
  							<li><a href="#">Terms & Conditions</a></li>
  							<li><a href="#">VPN Service</a></li>
  							<li><a href="#">Dedicated Server</a></li>
  						</ul>
  					</div>
  				</div>
  				<div class="col-sm-3">
  					<div class="widget">
  						<div class="h4">out pertners</div>
  						<ul class="footerLink">
  							<li><a href="#">ThemeForest</a></li>
  							<li><a href="#">GraphicRiver</a></li>
  							<li><a href="#">AudioJungle</a></li>
  							<li><a href="#">3DOcean</a></li>
  							<li><a href="#">CodeCanayon</a></li>
  						</ul>
  					</div>
  				</div>
  				<div class="col-sm-3">
  					<div class="contactInfo">
  						<div class="h4">contact with us</div>
  						<span class="call"><a href="tel:+214-5212-829"><i class="icofont icofont-ui-call"></i>+214-5212-829</a></span>
  						<span class="email"><a href="mailto:support@spark.com"><i class="icofont icofont-ui-v-card"></i>support@spark.com</a></span>
  						<a href="" class="contactBtn Btn">Send us a message</a>

  					</div>
  				</div>
  			</div>
  			<div class="row">
  				<div class="col-md-12">
  					<div class="copyrightTxt">
  						<p>&copy; Copyright 2016 Spark, </p>
  						<p>All Rights Reserved</p>
  					</div>
  				</div>
  			</div>
  		</div>
  	</footer>
  	<!-- ======= /1.09 footer Area ====== -->

  	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  	<script src="js/jquery.1.11.3.min.js"></script> <!-- jQuery -->
  	<script src="js/bootstrap.min.js"></script> <!-- Bootstrap -->
  	<script src="js/owl.carousel.min.js"></script> <!-- owlCarousel -->
  	<script src="js/waypoints.min.js"></script> <!-- waypoint -->
  	<script src="js/chatScript.js" type="text/javascript"></script> <!--End of Tawk.to Script-->
  	<script src="js/active.js"></script> <!-- active js -->



  </body>
  </html>