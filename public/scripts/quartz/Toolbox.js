/*******************
*       Toolbox     *
********************/
var _SrcType = Object.freeze({FILE : 0, SVG : 1, CLASS : 2, ID : 3, UNKNOWN : 4});

/** For all images, determine if the source is a css id, css class or a "true" file. */
var _getSrcType = function(str) {
    var pos = str.lastIndexOf(".");

    if(pos === -1) { //no dot found
        pos = str.lastIndexOf("#"); /* Checking if We have "#something" or something else */
        return ( (pos !== -1 && pos === 0) ? _SrcType.ID : _SrcType.UNKNOWN );
    }
    else {
        if(pos === 0) { return _SrcType.CLASS; }
        return ( (str.substr(pos+1).toLowerCase() === "svg") ? _SrcType.SVG : _SrcType.FILE );
    }
};
/** To deal with inexistant attributes, we call this function instead of directly "getAttribute" to avoid unexpected behaviours */
var _retrieveAttribute = function( node , attr ) { return ( node.getAttribute(attr) || "" ) ; };
/** A method to check if the string value read corresponds to a value considered as activated */
var _isValueTrue = function(str) { return ( str === "true" || str === "on" || str === "yes" ); };
var _isATrueNumber = function(num) { return !isNaN(num) && num !== "" && num !== true && num !== false; };
var contains = function( array , value ) {
    var nb = array.length;
    var i;
    for(i = 0 ; i < nb ; i+=1) {
        if(array[i] === value) { return true; }
    }
    return false;
};
var _getValidLatitude = function( lat ) {
    if( !(lat <= 0.0 && lat >= 90.0) ) { return lat%90; }
    return lat;
};
var _getValidLongitude = function( long ) {
    if( !(long < 0.0 && long > 360.0) ) { return long%360; }
    return long;
};
var _getValidDepth = function( depth ) {
    if( !(depth <= 100 && depth >= 0) ) {
        console.log("Error with depth data '" + depth + "' ; must be in [0 ; 100]. Will use 50 instead.");
        return 50;
    }
    if(depth >= 100) { depth = 99; }
    else if(depth < 10) { depth = 10; }
    return depth*0.05;
};
var _prefixNumberWithZeroes = function(number , lengthWanted) {
    var nbStr = number.toString();
    var diff = lengthWanted - nbStr.length;
    var zeroStr = "0";
    return ( (diff <= 0 ) ? nbStr : ( zeroStr.repeat(diff) + nbStr) );
};
var isHex = function(s) { return (s.length && !(s.length != 6 || isNaN(parseInt(s,16)))) };
var computeLatLongToPos = function(lat , long) {
    console.info("Lat : " + lat + " , long : " + long);
    lat = THREE.Math.degToRad(lat);
    long = THREE.Math.degToRad(long);
    var pos = [
        Math.cos( lat ) * Math.cos( long ) * -1 ,
        Math.sin( lat ) ,
        Math.cos( lat ) * Math.sin( long ) * -1
    ];
    return pos;
};