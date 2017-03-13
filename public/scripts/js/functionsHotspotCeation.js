src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"


//position de du hotspot de départ
$('.hotspotArea1').click(function(e) {
    var posX;
    var hSpotX;
    var hSpotY;
    var H;
    var W;
    var longitude;
    var latitude;
    var image_idX;
    var image_idY;

// récupération des positions
    posX = $(this).offset().left, posY = $(this).offset().top;
    hSpotX = (e.pageX - posX);
    hSpotY = (e.pageY - posY);
    $('#image_idX').val(hSpotX);
    $('#image_idY').val(hSpotY);
//taile de la fenetre de l'image ciblée
    H = $(".hotspotArea1").height();
    W = $(".hotspotArea1").width();
//calcul postion shift etc
    longitude = hSpotX / W * 360 - 180;
    latitude = 90 - 180 * hSpotY / H;
    image_idX = hSpotX / W;
    image_idY = hSpotY / H;

//position de l'image
    $('#longitude').val(longitude);
    $('#latitude').val(latitude);
    $('#position_x').val(image_idX);
    $('#position_y').val(image_idY);

    $('#image_idX').val(image_idY);
    $('#image_idY').val(image_idY);
//onselection le lieu de l'image et on affiche la photo miniature
    $('.selectLink1').css("display", 'block');
    // $('#imageLink src').val("{{ URL::asset('/img/'.$exp->id.'/'.$joinexpimages[$i]->image_id.'.JPG') }}");
    $('#imageLink1 src').val("{{ URL::asset('/img/'.$exp->id.'/'.$joinexpimages[$i]->image_id.'.PNG') }}");
//affichage des valeur de la postion de la souris
//$('.displayOffset').html('Position X :'+hSpotX+' Position Y :'+hSpotY+' taille fenetre'+W + '/' +H);
//affichage du spot sur la 1ere image
    $('.hotspotTarget1').addClass('circleLarge').offset({ top: e.pageY, left: e.pageX});
    // console.log(hSpotX, hSpotY, image_idX, image_idY);//debug : affichage postio réelle et en fct de quartz
});


$(function() {//onfait descendre la page vers les miniatures
  $('.pop').on('click', function() {
    $('.imagepreview1').attr('src', $(this).find('img').attr('src'));
      $('#photoLink1').attr('src', $(this).find('img').attr('src'));
      $('#photoLink1').css("display", 'block');
      $('#descriptionFinalVue').css("display", 'block');
      $('#eye1').css("display", 'block');//on met l'oeil
     });
});


//choix de la postion du shift
$('#photoLink1').click(function(e) {
    var posX;
    var hSpotX;
    var hSpotY;
    var H;
    var W;
    var longitude;
    var latitude;
    var image_idX;
    var image_idY;
// récupération des positions
    posX = $(this).offset().left, posY = $(this).offset().top;
    hSpotX = (e.pageX - posX);
    hSpotY = (e.pageY - posY);
    H = $("#photoLink1").height();
    W = $("#photoLink1").width();
//calcul postion shift etc
    longitude = hSpotX / W * 360 - 180;
    latitude = 90 - 180 * hSpotY / H;
    latitude = 0;//on impose un lattitude NULLE, pour bloquer verticalement
    image_LinkX = hSpotX / W;
    image_LinkY = hSpotY / H;
//on injecte les valeys suivante dans le formulaire pour les mettre en bdd
    $('#shift_x').val(longitude);
    $('#shift_y').val(latitude);
    $('#shift_z').val("0.5");
//position dans l'image d'arrivée
    // $('#image_LinkX').val(image_LinkX);
    // $('#image_LinkY').val(image_LinkY);

//afficher le bloc suivant
    $('.hotspotSave1').css("display", 'block');
    // $('#imageLink src').val("{{ URL::asset('/img/'.$exp->id.'/'.$joinexpimages[$i]->image_id.'.JPG') }}");
    $('#imageLink1 src').val("{{ URL::asset('/img/'.$exp->id.'/'.$joinexpimages[$i]->image_id.'.PNG') }}");
//affichage du spot de destination final
//  $('.displayOffset').html('Position X :'+hSpotX+' Position Y :'+hSpotY+' taille fenetre'+W + '/' +H);
    $('.hotspotTarget2').addClass('sq').offset({ top: e.pageY, left: e.pageX});


});
