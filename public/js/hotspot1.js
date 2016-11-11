src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"


$(document).ready(function(e) 
{
var H = $('.hotspotArea').height();
var W = $('.hotspotArea').width();
    // récupération des positions
    for ($spot = 0; $spot < sizeOf($hotspots); $spot++)
    var x = '{{$hotspots[$spot]->position_x}}';
    var y = '{{$hotspots[$spot]->position_y}}';
    //CALCUL CONVERSION longitude lattitude POUR OLIVIA
    //=================================================
    var posx = Number(W) * Number(x);
    var posy = Number(H) * Number(y);
    $('.hotspotTarget').append('<div id="'+{{$hotspots[$spot]->id}}+'" data-link="'+{{$hotspots[$spot]->image_link}}+'"  class="circleSmall" style="background-color:red;position:absolute;width:20px;top:'+posy+';left:'+posx+';"></div>');
    console.log(posx, posy, x, y);
    endfor
});