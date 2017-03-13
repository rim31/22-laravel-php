@extends('layouts.app')
@section('content')

<main>
  <div class="headerPlus" ></div>
  @if(Session::has('message'))
  <div class="alert alert-success">{{ Session::get('message') }}</div>
  @endif
  @if(isset($errors))
  <ul class="aler alert-danger">
    @foreach($errors->all() as $error)
    <li>{{ $error}}</li>
    @endforeach
  </ul>
  @endif
  <div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))

    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
    @endif
    @endforeach
  </div>

  <div>
    <div class="homeHeaderBanner"></div>
    <div class="homeHeaderBannerTxt">{{ trans('home.title')}}</div>
  </div>

  <div class="backgroundBlueEstate">
    <div class="videoSectionHomePage">
      <video autoplay loop muted controls id="video" class="homePageVideo" src="videos/homePage/ImmoVR_1500Kb.mp4" poster="../img/homePage/thumbnailVideo.png">
      </video>
    </div>
  </div>
  <div class="row">
    <div class="sectionIsoUseCase row greyBloc">
      <div class="isometricAside col-md-6">
        <img class="isometricImg" src="../img/homePage/isometric.png" alt="">
      </div>
      <div class="useCaseAside col-md-4">
        <div class="detailsBloc">
          <div class="flexRowSb ">
            <h1 class="detailsBlocTitle">{{ trans('home.eddy') }}</h1>
            <div class="btnDetails">
              <img class="eyePicto" src="../img/homePage/eye.png" alt="">
            </div>
          </div>
          <p class="detailsBlocTxt">{{ trans('home.eddytxt') }}</p>
            <a href="#titlePanelTab"><button class="btn btn-blue" type="button" name="button">{{ trans('home.vmore') }}</button></a>
          </div>
        </div>

        <div class="hoverDetails col-md-2">
          <div class="pictoSection flexColSa">
            <h1 class="infosDetailsTitle">{{ trans('home.ucase') }}</h1>
            <img src="../img/homePage/houseFlat.png" alt="House / Flat / Building">
            <p class="infosDetailsTxt" >{{ trans('home.restate') }}</p>
            <img src="../img/homePage/rentalHotel.png" alt="Rental / Hotel">
            <p class="infosDetailsTxt" >{{ trans('home.tourist') }}</p>
            <img src="../img/homePage/officeFactory.png" alt="House / Flat / Building">
            <p class="infosDetailsTxt" >{{ trans('home.corpo') }}</p>
            <img src="../img/homePage/adminMusuem.png" alt="House / Flat / Building">
            <p class="infosDetailsTxt" >{{ trans('home.museum') }}</p>
            <img src="../img/homePage/airportPlane.png" alt="Airport / Plane / Boat...">
            <p class="infosDetailsTxt" >{{ trans('home.indus') }}</p>
          </div>
        </div>

      </div>
    </div>

    <!-- tab pannel -->
    <h1 id="titlePanelTab" class="titlePanelTab">{{ trans('home.how') }}</h1>

    <div id="exTab1" class="tabPannel">

      <ul  class="nav nav-pills wrapButton">
        <li class="active">
          <a  href="#1a" data-toggle="tab">{{ trans('home.s1') }}</a>
        </li>
        <li><a href="#2a" data-toggle="tab">{{ trans('home.s2') }}</a>
        </li>
        <li><a href="#3a" data-toggle="tab">{{ trans('home.s3') }}</a>
        </li>
        <li><a href="#4a" data-toggle="tab">{{ trans('home.s4') }}</a>
        </li>
        <li><a href="#5a" data-toggle="tab">{{ trans('home.s5') }}</a>
        </li>
      </ul>
      <div class="tab-content clearfix">
        <div class="tab-pane active stepBackground-1" id="1a">
          <h3 class="titleStep">{{ trans('home.st1') }}</h3>
          <p class="tabSectionTxt">{{ trans('home.t1') }}</p>
          </div>
          <div class="tab-pane stepBackground-2" id="2a">
            <h3 class="titleStep">{{ trans('home.st2') }}</h3>
            <p class="tabSectionTxt">{{ trans('home.t2') }}</p>
            </div>
            <div class="tab-pane stepBackground-3" id="3a">
              <h3 class="titleStep">{{ trans('home.st3') }}</h3>
              <p class="tabSectionTxt">{{ trans('home.t3') }}</p>
              </div>
              <div class="tab-pane stepBackground-4" id="4a">
                <h3 class="titleStep">{{ trans('home.st4') }}</h3>
                <p class="tabSectionTxt">{{ trans('home.t4') }}</p>
                </div>
                <div class="tab-pane stepBackground-5" id="5a">
                  <h3 class="titleStep">{{ trans('home.st5') }}</h3>
                  <p class="tabSectionTxt">{{ trans('home.t5') }}</p>
                  </div>
                </div>
              </div>


              <div class="priceSection">
                <h1 class="pricingTitle"><span>{{ trans('home.price') }}</span></h1>
                <div class="flexCards">

                  <!-- Price card 1   -->
                  <div class="priceCard">
                    <div class="priceCardTitle">{{ trans('home.pbasic') }}</div>
                    <p class="priceCardMonthPrice">{{ trans('home.pbasic1') }}</p>
                    <p class="priceCardYearPrice">{{ trans('home.pbasic2') }}</p>
                    <p>{{ trans('home.pbasic3') }}</p>
                    <p class="hostingTxt">{{ trans('home.pbasic4') }}</p>
                    <a href="{{ url('/contact') }}"><button class="priceCardContactBtn btn btn-blue">{{ trans('home.contact') }}</button></a>
                  </div>

                  <!-- Price card 2   -->
                  <div class="priceCard">
                    <div class="priceCardTitle">{{ trans('home.pprenium') }}</div>
                    <p class="priceCardMonthPrice">{{ trans('home.pprenium1') }}</p>
                    <p class="priceCardYearPrice">{{ trans('home.pprenium2') }}</p>
                    <p>{{ trans('home.pprenium3') }}</p>
                    <p class="hostingTxt">{{ trans('home.pprenium4') }}</p>
                    <a href="{{ url('/contact') }}"><button class="priceCardContactBtn btn btn-blue">{{ trans('home.contact') }}</button></a>
                  </div>

                  <!-- Price card 3   -->
                  <div class="priceCard">
                   <div class="priceCardTitle">{{ trans('home.pexcellium') }}</div>
                    <p class="priceCardMonthPrice">{{ trans('home.pexcellium1') }}</p>
                    <p class="priceCardYearPrice">{{ trans('home.pexcellium2') }}</p>
                    <p>{{ trans('home.pexcellium3') }}</p>
                    <p class="hostingTxt">{{ trans('home.pexcellium4') }}</p>
                    <a href="{{ url('/contact') }}"><button class="priceCardContactBtn btn btn-blue">{{ trans('home.contact') }}</button></a>
                  </div>

                  <!-- Price card 4  -->
                  <div class="priceCard">
                    <div class="priceCardTitle">{{ trans('home.pultimium') }}</div>
                    <p class="priceCardMonthPrice">{{ trans('home.pultimium1') }}</p>
                    <p class="priceCardYearPrice">{{ trans('home.pultimium2') }}</p>
                    <p>{{ trans('home.pultimium3') }}</p>
                    <p class="hostingTxt">{{ trans('home.pultimium4') }}</p>
                    <a href="{{ url('/contact') }}"><button class="priceCardContactBtn btn btn-blue">{{ trans('home.contact') }}</button></a>
                  </div>

                </div>

                <div class="professionalPrice">
                  <div class="priceCardTitle">{{ trans('home.pro') }}</div>
                  <p class="priceCardProPrice">{{ trans('home.proprice') }}</p>
                  <p class="hostingProTxt">{{ trans('home.prodetails') }}</p>
                  <button class="priceCardContactBtn btn btn-blue">{{ trans('home.mored') }}</button>
                </div>
              </div>
              
              <div class="subscribeBloc">
                <img src="../img/homePage/subscribeImg.png" alt="">
                <div class="wrapButton btnStartRegister">
                  <a href="{{ url('/exp') }}" class="btn btn-white">{{ trans('home.start') }}</a>
                  <a href="{{ url('/register') }}" class="btn btn-white">{{ trans('home.register') }}</a>
                </div>
              </div>

              <div class="row">
                <div class="quartzSection">
                  <div class="fluid-container">
                    <div class="row">
                      <div class="col-md-3 col-md-offset-1">
                        <img class="quartzLogo" src="../img/homePage/quartzLogo.png" alt="quartzLogo">
                      </div>
                      <div class="col-md-6">
                        <div class="quartzTxt">
                          <p>{{ trans('home.powered') }}</p>
                          <p>{{ trans('home.powered1') }}</p>
                          <p>{{ trans('home.powered2') }}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="footerXXII">
                <img class="xxiiLogo" src="../img/homePage/LOGO XXII _ BLANC _ BIG.png" alt="">
              </div>
            </main>


            <script>

              function myFunction() {
                var x = document.getElementById('infoSuppl');
                if (x.style.display === 'block') {
                  x.style.display = 'none';
                } else {
                  x.style.display = 'block';
                }
              }


            </script>

            @endsection
