@extends('layouts.app')
@section('content')

  <head>

    <link rel="stylesheet" href="{{ URL::asset('style/css/custom/carousel.css')}}" />
    <link rel="stylesheet" href="{{ URL::asset('style/css/hotspotArea.css')}}" />
    <!-- hotspot page css -->
    <script  src="https://code.jquery.com/jquery-2.2.4.min.js"  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="  crossorigin="anonymous"></script>
  </head>

  <div class="headerBanner"></div>
  <ul class="breadcrumbNav">
    <a class="breadcrumb1" href="{{ url('/') }}">{{ trans('spotshow.home')}}</a>
    <a class="breadcrumb2" href="{{ url('/exp') }}">{{ trans('spotcreate.myexp')}}</a>
    <a class="breadcrumb3" href="{{route('exp.photo.index',[$exp->id])}}">{{ trans('spotcreate.photo')}}</a>
    <a class="breadcrumb4" href="">{{ trans('spotcreate.create')}}</a>
  </ul>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <!-- ======================== image où on clic ================================ -->

        <div class="wrapButton mrg5prct">
          <h3 class="center blueTitle">{{ trans('spotcreate.title')}}</h3>
        </div>

        <div id="Hospot" class="photo hotspotArea mrg5prct">
          <div class="hotspotTarget">
            <!-- =========== div image  cliquable ============= -->
          </div>
          <img src="{{ URL::asset('/img/exp/'.$exp->option_2.'/'.$photo.'.PNG') }}" alt="immovr" class="photo js-anchor-link" style="width: 100%">
        </div>
        <!-- ===================miniature selectionnable en ===================== -->
        <div class="row selectLink "  id="section-1">
          <div class="wrapButton">
            <h1 class="center blueTitle">{{ trans('spotcreate.title1')}}</h1>
          </div>
          <div class='controls mrg3prct center'>
            <button class='toggle btn btn-blue' data-toggle='prev'>{{ trans('spotcreate.prev') }}</button>
            <button class='toggle btn btn-blue' data-toggle='next'>{{ trans('spotcreate.next') }}</button>
          </div>

          <form action="{{ route('exp.photo.hotspot.store', [$exp->id, $id])}}" method="post">
            <div class="col-md-12" data-toggle="buttons" >

              <ul class='carousel is-set'>
                @foreach ($joinexpimages as $i => $joinsimagesI)
                  @if ($joinsimagesI->image_id != $id AND $joinsimagesI->is_delete != 1)
                    @if (0 == $i)
                      <li class='carousel-seat is-ref'>
                    @else
                      <li class='carousel-seat'>
                        @endif
                        <label>
                          <input type="radio" name="image_link" value={{$joinsimagesI->image_id}} autocomplete="off" style="visibility:hidden;">
                          <input type="radio" name="imageArrive" id={{$joinsimagesI->image_id}} value={{$joinsimagesI->image_id}} style="visibility:hidden;"><br>
                          <a class="pop miniature">
                            <img  class="js-anchor-link hotspotIndexPhoto" id="link_id" value={{$joinsimagesI->image_id}}
                                    src="{{ URL::asset('/img/exp/'.$exp->option_2.'/'.$joinsimagesI->image_id.'.PNG') }}">
                          </a>
                      </li>
                      @endif
                      @endforeach
                      </label>
              </ul>

              <!-- =================/carousel copyright Dany=============== -->

            </div>
        </div>
        <!-- =========== preview image d'arrivée imagepreview ============-->
        <div class="col-md-12" id="section-2">
          <h3 id="eye" class="center mrg5prct blueTitle">{{ trans('spotcreate.title2')}}</h3>
          <div class="hotspotTarget2 animated">
          </div>
          <span>
              <img  src="" alt="immovr" id="photoLink">
            </span>
        </div>
        <!-- ========== bouton test save =============-->
        <div class="hotspotSave animated">
          <div class="hotspotSave">
            <div class="row hotspotSave">
              <div class="col-md-12 hotspotSave">
                <div class="hotspotSave">
                  <div class="hotspotSave hotspotValider formCreateHotspot center">

                    <!-- formula hidden for user  -->
                    <div class="mb10">
                      <select name="position_z" id="single" class="formContact selectHotspot" hidden>
                        <option>small spot</option>
                        <option>medium spot</option>
                        <option>large spot</option>
                      </select>
                    </div>

                    <div class="mb10">
                      <input id="media_id" class="inputHotspot"  name="media_id" type="text"  maxlength="20" value="" placeholder="Name" hidden>
                    </div>

                    <div>
                      <input id="description_spot"  class="inputHotspot" name="description_spot" type="text"  maxlength="20" value="" placeholder="Description" hidden>
                    </div>
                  </div>
                  <input id="shift_x" type="text" name="shift_x" value="" hidden>
                  <input id="shift_y" type="text" name="shift_y" value="" hidden>
                  <input id="shift_z" type="text" name="shift_z" value="" hidden>
                  <input id="position_x" type="text" name="position_x" value="" hidden>
                  <input id="position_y" type="text" name="position_y" value="" hidden>
                  <input id="depth" type="text" name="depth" value="" hidden>
                  <input id="latitude" type="text" name="latitude" value="" hidden>
                  <input id="longitude" type="text" name="longitude" value="" hidden>
                  <input id="exp_id" type="text" name="exp_id" value={{$exp->id}} hidden>
                  <input id="image_id" type="text" name="image_id" value={{$id}} hidden>
                  <input id="image_idX" type="text" name="image_idX" value="" hidden>
                  <input id="image_idY" type="text" name="image_idY" value="" hidden>
                  <input id="image_linkX" type="text" name="image_linkX" value="" hidden>
                  <input id="image_linkY" type="text" name="image_linkY" value="" hidden>
                  <input id="image_link" type="text" name="image_link" value="" hidden>
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="center">
                    <button type="submit" name="submit" value="OK" class="btn btn-blue mrg5prct">{{ trans('spotcreate.ok')}}</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ==========position $_GET du hotspot button précédent======== -->
  <input id="x" value="{{$request->x}}" hidden>
  <input id="y" value="{{$request->y}}" hidden>
  <!-- $('.hotspotTarget').addClass('circleLarge').offset({ top: posX, left: posY}); -->


  <script language="JavaScript" type="text/javascript" src="{{ URL::asset('scripts/js/functions.js') }}"></script>

  <script type="text/javascript">


      //==========afficher le hotspot(x,y) dès le clique sur l'image précédente===============
      $(document).ready(function() {
          $('body').animate({scrollTop: H}, 999);
          var hSpotX;
          var hSpotY;
          var H;
          var W;
          var longitude;
          var latitude;
          var image_idX;
          var image_idY;
          var x;
          var y;

// on recupère la taille de l'image
          H = $(".hotspotArea").height();
          W = $(".hotspotArea").width();
          posX = $('.hotspotArea').offset().left;
          posY = $('.hotspotArea').offset().top;
          console.log(posX +'/'+posY);

          //on récupère la postion du hostpot button précédent passé en get
          y = posY + $('#y').val() * H;
          x = posX + $('#x').val() * W;

          var hSpotX = ($(".hotspotArea").offset().left + $('#x').val() * W);
          var hSpotY = ($(".hotspotArea").offset().top + $('#y').val() * H);

//on affiche le hotspot précédent(affichage seulement si a créer un hotpost par le button sur l'image)
          if ($('#y').val() != 0 && $('#y').val() != 0) {
              $('.hotspotTarget').addClass('circleLarge').offset({top: y, left: x});
//on affiche les miniature
              $('.selectLink').css("display", 'block');
          }
//taile de la fenetre de l'image ciblée
          H = $(".hotspotArea").height();
          W = $(".hotspotArea").width();
//calcul postion shift etc
          hSpotX = $('#x').val() * W;
          hSpotY = $('#y').val() * H;
          longitude = hSpotX / W * 360 - 180;
          latitude = 90 - 180 * hSpotY / H;
          image_idX = hSpotX / W;
          image_idY = hSpotY / H;
          //on remplis le formulaire pour envoyer au controller de creation de hotspot
          $('#longitude').val(longitude);
          $('#latitude').val(latitude);
          $('#position_x').val(image_idX);
          $('#position_y').val(image_idY);
          $('#image_idX').val(image_idX);
          $('#image_idY').val(image_idY);
          $('#imageLink src').val("{{ URL::asset('/img/'.$exp->id.'/'.$joinexpimages[$i]->image_id.'.PNG') }}");
      });


      //==================caroussel=============================
      var $carousel = $('.carousel');
      var $seats = $('.carousel-seat');

      $('.toggle').on('click', function(e) {
          var $newSeat;
          var $el = $('.is-ref');
          var $currSliderControl = $(e.currentTarget);

          $el.removeClass('is-ref');
          if ($currSliderControl.data('toggle') === 'next') {
              $newSeat = next($el);
              $carousel.removeClass('is-reversing');
          } else {
              $newSeat = prev($el);
              $carousel.addClass('is-reversing');
          }

          $newSeat.addClass('is-ref').css('order', 1);
          for (var i = 2; i <= $seats.length; i++) {
              $newSeat = next($newSeat).css('order', i);
          }

          $carousel.removeClass('is-set');
          return setTimeout(function() {
              return $carousel.addClass('is-set');
          }, 50);

          function next($el) {
              if ($el.next().length) {
                  return $el.next();
              } else {
                  return $seats.first();
              }
          }

          function prev($el) {
              if ($el.prev().length) {
                  return $el.prev();
              } else {
                  return $seats.last();
              }
          }
      });

  </script>

@endsection
