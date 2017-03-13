/*****************
*     Target3D    *
******************/
var Target3D = function() {
    if(!(this instanceof Target3D)) { return new Target3D(); }
    this.FIXED = QuartzVR.cardboardAvailable();
    var geometry = new THREE.PlaneBufferGeometry( 0.1 , 0.1 );
    var material = new THREE.MeshBasicMaterial( { color : 0xf7f7f7 , transparent : true , opacity : 0.001 } );
    this._targetObject = new THREE.Mesh( geometry , material );
    this._coord2D = [ 0 , 0 ];
};
/*Target3D.prototype.setPosition = function ( x , y ) {
    this._targetObject.position.set( x , y , -1 );
};
Target3D.prototype.set2DCoord = function( x , y ) {
    this._coord2D[0] = x;
    this._coord2D[1] = y;
};*/
Target3D.prototype.get2DCoord = function() { return this._coord2D; };
Target3D.prototype.applyTexture = function( targetNode ) {
    if( _isValueTrue( _retrieveAttribute( targetNode , "enabled" ) ) && this.FIXED ) {
        var texture = QuartzVR.loadTexture( _retrieveAttribute( targetNode , "src") );
        this._targetObject.material = new THREE.MeshBasicMaterial( { map : texture , transparent : true } );
    }
};