<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>       <html class="no-js"> <![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>EEDY</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Police -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
  <!-- reset.css -->
  <link rel="stylesheet" href="{{ URL::asset('style/css/reset.css') }}">
  <!-- Animate.css -->
  <link rel="stylesheet" href="{{ URL::asset('style/css/animate.css') }}">
  <!-- Icomoon Icon Fonts-->
  <link rel="stylesheet" href="{{ URL::asset('style/css/icomoon.css') }}">
  <!-- Bootstrap  -->
  <link rel="stylesheet" href="{{ URL::asset('style/css/bootstrap.css') }}">
  <!-- Flexslider  -->
  <link rel="stylesheet" href="{{ URL::asset('style/css/flexslider.css') }}">
  <!-- Main style  -->
  <link rel="stylesheet" href="{{ URL::asset('style/css/style.css') }}">
  <!-- pricing style  -->
  <link rel="stylesheet" href="{{ URL::asset('style/css/pricing.css') }}">
  <!-- contact and email  -->
  <link rel="stylesheet" href="{{ URL::asset('style/css/custom/contactMail.css') }}">

  <!-- FOR IE9 below -->
<!--[if lt IE 9]>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>
<body>
  <!-- @if (Auth::check())
  <p>connecté</p>
  @endif -->

  <div id="fh5co-page">
    <header id="fh5co-header" role="banner">
      <div class="container">
        <div class="row">
          <div class="header-inner">
            <h1 class="mainLogo">
              <a href="{{ url('/home') }}">{{ trans('layout.immovr') }}</a>
            </h1>
            <nav role="navigation" class="navigation">
              <ul>
                <li>
                </li>
                @if (Auth::guest())
                <li>
                  <a href="{{ url('/login') }}">{{ trans('layout.login') }}</a>
                </li>
                <li>
                  <a href="{{ url('/register') }}">{{ trans('layout.register') }}</a>
                </li>
                <li>
                  <a href="{{ url('/contact') }}">{{ trans('layout.contact') }}</a>
                </li>
                @else
                <li>
                  <a href="{{ url('/contact') }}">{{ trans('layout.contact') }}</a>
                </li>
                <li>
                  <a href="{{ url('/exp') }}">{{ trans('layout.exp') }}</a>
                </li>
                <li>
                  <a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>{{ trans('layout.logout') }}</a>
                </li>
                <li class="cta">{{ link_to_route('account.edit', Auth::user()->name, Auth::user()->id, ['class' => '']) }}</li>
                @endif
                <li>
                  <div class="language">  
                    <form  role="form" method="POST" action="{{ url('/language') }}">
                      {{ csrf_field() }}
                      <select id="languageSelect" name="locale" onchange="this.form.submit()">
                        <option value="en" selected>{{ trans('layout.language') }}</option>
                        <option value="en">{{ trans('layout.en') }}</option>
                        <option value="fr">{{ trans('layout.fr') }}</option>
                        <option value="cn">{{ trans('layout.cn') }}</option>
                      </select>
                    </form>
                  </div>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </header>
    <!-- ===================content========================== -->
    <div id="content">

      <!-- ===========message success / alert =============== -->
      <div class="headerPlus" ></div>
      @if(Session::has('message'))
      <div class="alert alert-success">{{ Session::get('message') }}<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>
      @endif
      @if(isset($errors))
      <ul class="aler alert-danger">
        @foreach($errors->all() as $error)
        <li>{{ $error}}<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></li>
        @endforeach
      </ul>
      @endif
      <!-- ===========/message success / alert =============== -->
      @yield('content')
    </div>
  </div>

</body>
</html>


<!-- JE MET LE JS EN BAS POUR LA PAGE exp/photo/hotspot/show.blade.php -->

<!-- jQuery -->
<script src="{{ URL::asset('scripts/js/jquery.min.js') }}"></script>
<!-- jQuery Easing -->
<script src="{{ URL::asset('scripts/js/jquery.easing.1.3.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ URL::asset('scripts/js/bootstrap.min.js') }}"></script>
<!-- Waypoints -->
<script src="{{ URL::asset('scripts/js/jquery.waypoints.min.js') }}"></script>
<!-- Flexslider -->
<script src="{{ URL::asset('scripts/js/jquery.flexslider-min.js') }}"></script>
<!-- MAIN JS -->
<script src="{{ URL::asset('scripts/js/main.js') }}"></script>
<!-- Remodal js -->
<script src="{{ URL::asset('remodal/remodal.js') }}"></script>
