src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"


//position de du hotspot de départ
$('.hotspotArea').click(function(e) {
    var posX1;
    var posY1;
    var hSpotX1;
    var hSpotY1;
    var H1;
    var W1;


// récupération des positions
    posX1 = $(this).offset().left;
    posY1 = $(this).offset().top;
    hSpotX1 = (e.pageX - posX1);
    hSpotY1 = (e.pageY - posY1);
//taile de la fenetre de l'image ciblée
    H1 = $(".hotspotArea").height();
    W1 = $(".hotspotArea").width();

    var x = document.getElementById('createButton');
    x.style.display = 'block';
    $('#createButton').offset({ top: e.pageY, left: e.pageX});

//on injecte la position de ce hotspot dans la page suivante pour enlever un étape
    console.log(hSpotX1+' / '+hSpotY1);
    console.log(hSpotX1 / W1 +' / '+hSpotY1 / H1);

//on transmet en get les positions du hotspot mais attention à ce que l'image soit à la meme taille sur la page d'après
    $("#y").attr("value", hSpotY1 / H1);
    $("#x").attr("value", hSpotX1 / W1);
    // <!> j'avais inversé la postion x, y après dans al page Create hotspot

});
