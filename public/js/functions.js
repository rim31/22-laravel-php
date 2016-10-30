src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"


//posotion de du hotspot de départ
$('.hotspotArea').click(function(e) {
// récupération des positions
    var posX = $(this).offset().left, posY = $(this).offset().top;
    var hSpotX = (e.pageX - posX);
    var hSpotY = (e.pageY - posY);
    $('#image_idX').val(hSpotX);
    $('#image_idY').val(hSpotY);
//taile de la fenetre de l'image ciblée
    var H = $(".hotspotArea").height();
    var W = $(".hotspotArea").width();
//calcul postion shift etc
    var longitude = hSpotX / W * 360 - 180;
    var latitude = 90 - 180 * hSpotY / H;
    var image_idX = hSpotX / W;
    var image_idY = hSpotY / H;

//position de l'image
    $('#longitude').val(longitude);
    $('#latitude').val(latitude);
    $('#position_x').val(image_idX);
    $('#position_y').val(image_idY);

    $('#image_idX').val(image_idY);
    $('#image_idY').val(image_idY);

    $('.selectLink').css("display", 'block');
    $('#imageLink src').val("{{ URL::asset('/img/'.$exp->id.'/'.$joinexpimages[$i]->image_id.'.JPG') }}");
//affichage des valeur de la postio de la souris
//$('.displayOffset').html('Position X :'+hSpotX+' Position Y :'+hSpotY+' taille fenetre'+W + '/' +H);
    $('.hotspotTarget').addClass('circleLarge').offset({ top: e.pageY, left: e.pageX});
    $('body').animate({scrollTop: H}, 0);
    console.log(hSpotX);

});


$(function() {
  $('.pop').on('click', function() {
    $('.imagepreview').attr('src', $(this).find('img').attr('src'));
      $('#photoLink').attr('src', $(this).find('img').attr('src'));
      $('#photoLink').css("display", 'block');
      $('body').animate({scrollTop: 1000}, 0);
    });
});


//choix de la postion du shift
$('#photoLink').click(function(e) {
// récupération des positions
    var posX = $(this).offset().left, posY = $(this).offset().top;
    var hSpotX = (e.pageX - posX);
    var hSpotY = (e.pageY - posY);
    var H = $("#photoLink").height();
    var W = $("#photoLink").width();
//calcul postion shift etc
    var longitude = hSpotX / W * 360 - 180;
    var latitude = 90 - 180 * hSpotY / H;
    var image_LinkX = hSpotX / W;
    var image_LinkY = hSpotY / H;

    $('#shift_x').val(longitude);
    $('#shift_y').val(latitude);
    $('#shift_z').val("0.5");

//position dans l'image d'arrivée
    // $('#image_LinkX').val(image_LinkX);
    // $('#image_LinkY').val(image_LinkY);

//afficher le bloc suivant
    $('.hotspotSave').css("display", 'block');
    $('#imageLink src').val("{{ URL::asset('/img/'.$exp->id.'/'.$joinexpimages[$i]->image_id.'.JPG') }}");

//  $('.displayOffset').html('Position X :'+hSpotX+' Position Y :'+hSpotY+' taille fenetre'+W + '/' +H);
    $('.hotspotTarget2').addClass('circleSmall').offset({ top: e.pageY, left: e.pageX});
    $('body').animate({scrollTop: 2 * H}, 0);

});






//dessiner les hotspot
// var div;
// for(var k=0; k<80; k++)
// {
//     div= document.createElement("div");
//     div.setAttribute("id","g"+k);
//     div.setAttribute("class","carre");
//     table.appendChild(div);
// }










// $( "#nameHotspot" ).keyup(function()
//   {
//     var value = $( this ).val();
//     $( this ).innerHtml( value );
//     console.log(value);
//   }).keyup();

// $(function () {
//   $('#nameHotspot').val("Olivier");
// });


// modal
// $('a').click(function (e) {
//     $('#myModal img').attr('src', $(this).attr('data-img-url'));
// });


/*<!-- modal -->

<div id="gridSystemModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid bd-example-row">
          <div class="row">
            <div class="col-md-12">
              </div>
              <img src="{{ URL::asset('/img/1/1.JPG') }}" alt="immovr" class="miniature">
          </div>
          <div class="row">
          </div>
        </div>
      </div>
      <div class="modal-footer">
          <table>
             <th>
              <div class="form-group">
                <label for="posz">taille spot :</label>
                <select class="form-control" id="posz">
                  <option>petit</option>
                  <option>moyen</option>
                  <option>grand</option>
                </select>
              </div>
             </th>
             <th>
                {!! Form::text('name', null, ['class' =>'form-control', 'id' => 'name' ,  'placeholder' => "Entrer une info" ]) !!}
             </th>
             <th>
                {!! Form::open(array('route'=>['exp.photo.show', $exp->id, $image->id], 'method'=>'POST')) !!}
                <input type="text" name="image" value="{{$image->id}}" hidden>
                <input id="positionX" type="text" name="positionX" value="" hidden>
                <input id="positionY" type="text" name="positionY" value="" hidden>
                <input id="positionZ" type="text" name="positionZ" value="" hidden>
                <input type="text" name="positionY" value="" hidden>
                <input type="text" name="positionZ" value="" hidden>
                <input type="text" name="longitude" value="" hidden>
                <input type="text" name="lattitude" value="" hidden>
                <input type="text" name="spin" value="" hidden>
                {!! Form::button('Valider', ['class'=>'btn btn-success', 'type'=>'submit']) !!}
                {!! Form::close() !!}
             </th>
             <th>
                {!! Form::open(array('route'=>['exp.photo.show', $exp->id, $image->id], 'method'=>'DELETE')) !!}
                <input type="text" name="image" value="{{$image->id}}" hidden>
                {!! Form::button('Annuler', ['class'=>'btn btn-danger', 'type'=>'submit']) !!}
                {!! Form::close() !!}
             </th>
            </table>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<div class="bd-example bd-example-padded-bottom">
  <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#gridSystemModal">
    Launch demo modal
  </button>
</div>*/
