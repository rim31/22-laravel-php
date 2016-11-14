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
//onselection le lieu de l'image et on affiche la photo miniature
    $('.selectLink').css("display", 'block');
    // $('#imageLink src').val("{{ URL::asset('/img/'.$exp->id.'/'.$joinexpimages[$i]->image_id.'.JPG') }}");
    $('#imageLink src').val("{{ URL::asset('/img/'.$exp->id.'/'.$joinexpimages[$i]->image_id.'.PNG') }}");
//affichage des valeur de la postion de la souris
//$('.displayOffset').html('Position X :'+hSpotX+' Position Y :'+hSpotY+' taille fenetre'+W + '/' +H);
//affichage du spot sur la 1ere image
    $('.hotspotTarget').addClass('circleLarge').offset({ top: e.pageY, left: e.pageX});
    $('body').animate({scrollTop: H}, 0);
    // console.log(hSpotX, hSpotY, image_idX, image_idY);//debug : affichage postio réelle et en fct de quartz
});


$(function() {//onfait descendre la page vers les miniatures
  $('.pop').on('click', function() {
    $('.imagepreview').attr('src', $(this).find('img').attr('src'));
      $('#photoLink').attr('src', $(this).find('img').attr('src'));
      $('#photoLink').css("display", 'block');
      $('body').animate({scrollTop: 1000}, 0);//on descends de 1000 pixel, ca suffit ?
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
//on injecte les valeys suivante dans le formulaire pour les mettre en bdd
    $('#shift_x').val(longitude);
    $('#shift_y').val(latitude);
    $('#shift_z').val("0.5");
//position dans l'image d'arrivée
    // $('#image_LinkX').val(image_LinkX);
    // $('#image_LinkY').val(image_LinkY);

//afficher le bloc suivant
    $('.hotspotSave').css("display", 'block');
    // $('#imageLink src').val("{{ URL::asset('/img/'.$exp->id.'/'.$joinexpimages[$i]->image_id.'.JPG') }}");
    $('#imageLink src').val("{{ URL::asset('/img/'.$exp->id.'/'.$joinexpimages[$i]->image_id.'.PNG') }}");
//affichage du spot de destination final
//  $('.displayOffset').html('Position X :'+hSpotX+' Position Y :'+hSpotY+' taille fenetre'+W + '/' +H);
    $('.hotspotTarget2').addClass('circleSmall').offset({ top: e.pageY, left: e.pageX});
    $('body').animate({scrollTop: 3 * H}, 0);
});
