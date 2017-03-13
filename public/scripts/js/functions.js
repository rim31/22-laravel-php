src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"


//position de du hotspot de départ
$('.hotspotArea').click(function(e) {
    var posX;
    var posY;
    var hSpotX;
    var hSpotY;
    var H;
    var W;
    var longitude;
    var latitude;
    var image_idX;
    var image_idY;

// récupération des positions
    posX = $(this).offset().left;
    posY = $(this).offset().top;
    hSpotX = (e.pageX - posX);
    hSpotY = (e.pageY - posY);
    $('#image_idX').val(hSpotX);
    $('#image_idY').val(hSpotY);

//taile de la fenetre de l'image ciblée
    H = $(".hotspotArea").height();
    W = $(".hotspotArea").width();
//calcul postion shift etc
    longitude = hSpotX / W * 360 - 180;
    latitude = 90 - 180 * hSpotY / H;
    image_idX = hSpotX / W;
    image_idY = hSpotY / H;
//on remplace les valeurs x et y précédente
    $("#x").attr("value", hSpotY / H);
    $("#y").attr("value", hSpotX / W);

//position de l'image
    $('#longitude').val(longitude);
    $('#latitude').val(latitude);
    $('#position_x').val(image_idX);
    $('#position_y').val(image_idY);

    $('#image_idX').val(image_idX);
    $('#image_idY').val(image_idY);
//on selectionne le lieu de l'image et on affiche la photo miniature
    $('.selectLink').css("display", 'block');
    // $('#imageLink src').val("{{ URL::asset('/img/'.$exp->id.'/'.$joinexpimages[$i]->image_id.'.JPG') }}");
    $('#imageLink src').val("{{ URL::asset('/img/'.$exp->id.'/'.$joinexpimages[$i]->image_id.'.PNG') }}");
//affichage des valeur de la postion de la souris
//$('.displayOffset').html('Position X :'+hSpotX+' Position Y :'+hSpotY+' taille fenetre'+W + '/' +H);
//affichage du spot sur la 1ere image
    $('.hotspotTarget').addClass('circleLarge').offset({ top: e.pageY, left: e.pageX});
    console.log(hSpotX, hSpotY, image_idX, image_idY);//debug : affichage postio réelle et en fct de quartz
    // ==========SCROLL=========
    $('body').animate({scrollTop: H}, 999);


//==============on change la postion x, y obtenue en get précédement====================
    $("#x").attr("value", hSpotX);
    $("#y").attr("value", hSpotY);

});


$(function() {//onfait descendre la page vers les miniatures
    $('.pop').on('click', function() {
        var H = $("#best-deal").height();

        $('.imagepreview').attr('src', $(this).find('img').attr('src'));
        $('#photoLink').attr('src', $(this).find('img').attr('src'));
        $('#photoLink').css("display", 'block');
        $('#image_link').val($(this).find('img').attr('value'));
        $('#descriptionFinalVue').css("display", 'block');
        $('#eye').css("display", 'block');//on met l'oeil
        // ==========SCROLL=========
        $('body').animate({scrollTop: 999}, 999);//on descends de 1000 pixel, ca suffit ?
    });
});


//choix de la postion du shift
$('#photoLink').click(function(e) {

    var posX;
    var posY;
    var hSpotX;
    var hSpotY;
    var H;
    var W;
    var longitude;
    var latitude;
    var image_idX;
    var image_idY;
    var image_LinkX;
    var image_LinkY;

// récupération des positions
    posX = $(this).offset().left;
    posY = $(this).offset().top;
    hSpotX = (e.pageX - posX);
    hSpotY = (e.pageY - posY);
    H = $("#photoLink").height();
    W = $("#photoLink").width();
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

    $('#image_LinkX').val(image_LinkX);
    $('#image_LinkY').val(image_LinkY);

//afficher le bloc suivant
    $('.hotspotSave').css("display", 'block');

//affichage du spot de destination final
    $('.hotspotTarget2').addClass('sq').offset({ top: e.pageY, left: e.pageX});

    // ==========SCROLL=========
    // $('body').animate({scrollTop: 5*H}, 100);



});
