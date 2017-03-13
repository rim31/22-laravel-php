/**
* Define the current state of interaction
* @readonly
* @enum {number}
*/
var _INTERACTION_STATE = Object.freeze( { NONE : 0 , ONCE : 1 , TWICE : 2 , HOLD : 3 } );
var _HOLD_TIMER = 0.5;
/**
* Parent class for all controls
* @class
*/
var PlayerControls = function(player) {
    this._euler = new THREE.Euler( 0 , 0 , 0 , "YXZ" );
    this._player = player;
    this._targetDiv = player._parent._container;
    this.longTouchClock = new THREE.Clock(false);
    this.defaultOrientation = new THREE.Euler( 0 , 0 , 0 , "YXZ" );
};

/**
* Keep the initial shift of a scene in memory
* @class
*/
var ShiftControls = function(player) { 
    if(!(this instanceof ShiftControls)) { return new ShiftControls(player); }
    PlayerControls.call(this, player);
    this.orientation = null;
};
ShiftControls.prototype = Object.create(PlayerControls.prototype);
ShiftControls.prototype.constructor = ShiftControls;
ShiftControls.prototype.resetOrientation = function() {
    console.info("Resetting initial shift orientation");

    this._euler.set(
        THREE.Math.degToRad(0),
        THREE.Math.degToRad(0),
        THREE.Math.degToRad(0),
        "YXZ");

};
ShiftControls.prototype.setInitialOrientation = function( shift ) {

    console.info("Setting initial shift orientation");
    this._euler.set(
        THREE.Math.degToRad(shift[0]) ,
        THREE.Math.degToRad(shift[1]) ,
        THREE.Math.degToRad(shift[2]) ,
        "YXZ");
    this.defaultOrientation = shift;
};

ShiftControls.prototype.enable = function() { /*console.info("ShiftControls is always enabled.");*/ };
ShiftControls.prototype.disable = function() { /*console.info("ShiftControls cannot be disabled.");*/ };

/**
* Use the gyroscope to retrieve rotation of the device in real space and rotate the scene according to it
* @class
*/
var GyroControls = function(player) {
    if(!(this instanceof GyroControls)) { return new GyroControls(player); }
    PlayerControls.call(this , player);
    this._gyro_data = {};
    this._worldQ = new THREE.Quaternion( -Math.sqrt(0.5) , 0 , 0 , Math.sqrt(0.5) );
};
GyroControls.prototype = Object.create(PlayerControls.prototype);
GyroControls.prototype.constructor = GyroControls;
GyroControls.prototype.enable = function() {
    if(this._normalizedGyro === undefined) {
        /**
        * @todo Get rid of FULLTILT (legal issue because of licensing)
        */
        this._normalizedGyro = new FULLTILT.getDeviceOrientation( { "type" : "world" } );
        this._normalizedGyro.then( GyroControls.prototype.registerOrientation.bind(this) ).catch( function(error) { console.error(error); } );
    }
    this._enabled = true;
};
GyroControls.prototype.disable = function() { this._enabled = false; };
GyroControls.prototype.registerOrientation = function ( deviceOrientationController ) { this._gyro_data = deviceOrientationController; };
GyroControls.prototype.updateRotation = function() {
    if(this._enabled) {
        var gE = this._gyro_data.getScreenAdjustedEuler();
        var alpha = THREE.Math.degToRad(gE.alpha);
        var beta = THREE.Math.degToRad(gE.beta);
        var gamma = THREE.Math.degToRad(gE.gamma);
        var euler = new THREE.Euler(beta, alpha, -gamma , "YXZ");
        var quaternion = new THREE.Quaternion().setFromEuler( euler );
        quaternion.multiply( this._worldQ );
        this._euler.setFromQuaternion( quaternion, "YXZ" );
    }
};

/**
* Defines all mouse interactions from click/double click to drag&drop to interact with hotspots and rotate the scene 
* @class
*/
var MouseControls = function(player) {
    if(!(this instanceof MouseControls)) { return new MouseControls(player); }
    PlayerControls.call(this, player);
    this._coords = [0 , 0];
    this._clickDelay = 0;
    this._screenClicked = false;
    this._screenDragged = false;

    this.mouseDownHandler = this.onMouseDown.bind(this); 
    this.mouseMoveHandler = this.onMouseMove.bind(this);
    this.mouseUpHandler = this.onMouseUp.bind(this);
    this.doubleClickHandler = this.onDoubleClick.bind(this);
    this.clickHandler = this.onClick.bind(this);
    this._targetDiv.addEventListener( "dragstart" , function(event) { event.preventDefault(); } , { capture : true } );
};
MouseControls.prototype = Object.create(PlayerControls.prototype);
MouseControls.prototype.constructor = MouseControls;
MouseControls.prototype.updateCoordinates = function( event ) {
    var rect = this._player._renderer.domElement;
    var pos = [ ( (event.clientX - rect.offsetLeft) / (rect.width) ) * 2 - 1,
                - ( (event.clientY - rect.offsetTop) / (rect.height) ) * 2 + 1 ];
    return pos;
};
MouseControls.prototype.saveCoordinates = function( c ) {
    this._player._pointer[0] = c[0];
    this._coords[0] = c[0];
    this._player._pointer[1] = c[1];
    this._coords[1] = c[1];
};

/**
 * Event mouse down
 * Save coordinates for long touch
 * @param event
 */
MouseControls.prototype.onMouseDown = function( event ) {
    this._screenClicked = true;
    this.saveCoordinates( this.updateCoordinates( event ) );
    this.longTouchClock.start();
    this.longTouchClock.getDelta();
};

/**
 * Event mouse move
 * @param event
 */
MouseControls.prototype.onMouseMove = function( event ) {
    var coords = this.updateCoordinates( event );
    if( this._screenClicked = QuartzVR.primaryBtnPressed() ) {
        if(!this._screenDragged) { this._screenDragged = true; }
            
        this._euler.y += (coords[0] - this._coords[0]);
        this._euler.x += -(coords[1] - this._coords[1]);
    }

    this.saveCoordinates( coords );
};

/**
 * Mouse up event
 * Check for long touch event
 * @param event
 */
MouseControls.prototype.onMouseUp = function( event ) {
    var coords = this.updateCoordinates( event );

    // long touch trigger
    var touchTime = this.longTouchClock.getElapsedTime();
    if (touchTime >= _HOLD_TIMER) {
        var hotspot = this._player.testIntersection( "HOLD" , coords );
        if( hotspot ) { hotspot.data._handler(); }
    }

    QuartzVR.resetClicks();
    this._screenClicked = false;
    this._screenDragged = false;
};

/**
 * Click event
 * @param event
 */
MouseControls.prototype.onClick = function (event) {
    var coords = this.updateCoordinates( event );
    this.saveCoordinates(coords);

    var hotspot = this._player.testIntersection( "CLICK" , coords );
    if( hotspot ) { hotspot.data._handler(); }
};

/**
 * Double Click event
 * @param event
 */
MouseControls.prototype.onDoubleClick = function(event) {
    var coords = this.updateCoordinates( event );
    this.saveCoordinates(coords);
    var hotspot = this._player.testIntersection( "DBLCLICK" , coords );

    if (hotspot) {
        hotspot.data._handler();
    } else {
        this.fovClick();
    }
};

/**
 * Fov click to reset view to default orientation
 * @param event
 */
MouseControls.prototype.fovClick = function (event) {
    this._euler.x = this._player._controls[0].defaultOrientation._x;
    this._euler.y = this._player._controls[0].defaultOrientation._y;
    this._euler.z = this._player._controls[0].defaultOrientation._z;
};

MouseControls.prototype.enable = function() {
    this._targetDiv.addEventListener( "mousedown" , this.mouseDownHandler , { capture : true } );
    this._targetDiv.addEventListener( "mousemove" , this.mouseMoveHandler , { capture : true } );
    this._targetDiv.addEventListener( "mouseup" , this.mouseUpHandler , { capture : true } );
    this._targetDiv.addEventListener( "click" , this.clickHandler , { capture : true } );
    this._targetDiv.addEventListener( "dblclick" , this.doubleClickHandler , { capture : true } );
};
MouseControls.prototype.disable = function() {
    this._targetDiv.removeEventListener( "mousedown" , this.mouseDownHandler , { capture : true } );
    this._targetDiv.removeEventListener( "mousemove" , this.mouseMoveHandler , { capture : true } );
    this._targetDiv.removeEventListener( "mouseup" , this.mouseUpHandler , { capture : true } );   
    this._targetDiv.removeEventListener( "click" , this.clickHandler , { capture : true } );
    this._targetDiv.removeEventListener( "dblclick" , this.doubleClickHandler, { capture : true } ); 
};

/**
* Defines all touch interactions from tap/double tap to touchmove to interact with hotspots and rotate the scene
* @class
*/
var TouchControls = function( player ) {
    if(!(this instanceof TouchControls)) { return new TouchControls(player); }
    PlayerControls.call(this, player);
    this._coords = [ 0 , 0 ];
    this._screenClicked = false;
    this._screenDragged = false;

    this.touchStartHandler = this.onTouchStart.bind(this);
    this.touchMoveHandler = this.onTouchMove.bind(this);
    this.touchEndHandler = this.onTouchEnd.bind(this);
};
TouchControls.prototype = Object.create(PlayerControls.prototype);
TouchControls.prototype.constructor = TouchControls;
TouchControls.prototype.updateCoordinates = function( event ) {
    var rect = this._player._renderer.domElement;
    var touch = event.touches[0];
    var pos = [ ( (touch.clientX - rect.offsetLeft) / (rect.width) ) * 2 - 1,
                - ( (touch.clientY - rect.offsetTop) / (rect.height) ) * 2 + 1 ];
    return pos;
};
TouchControls.prototype.saveCoordinates = function(c) { this._coords[0] = c[0]; this._coords[1] = c[1]; };
TouchControls.prototype.onTouchStart = function(event) {
    this._screenClicked = true;
    this.saveCoordinates( this.updateCoordinates(event) );
};
TouchControls.prototype.onTouchMove = function(event) {
    var coords = this.updateCoordinates(event);
    if( this._screenClicked ) {
        if(!this._screenDragged) { this._screenDragged = true; }
        this._euler.y += (coords[0] - this._coords[0]);
        this._euler.x += -(coords[1] - this._coords[1]);
    }
    this.saveCoordinates(coords);
};
TouchControls.prototype.onTouchEnd = function(event) {
    if(!this._screenDragged && this._screenClicked) {
        var hotspot = this._player.testIntersection( "TAP" , this._coords );
        if( hotspot ) { hotspot.data._handler(); }
    }

    QuartzVR.resetClicks();
    this._screenClicked = false;
    this._screenDragged = false;
};
TouchControls.prototype.enable = function() {
    this._targetDiv.addEventListener( "touchstart" , this.touchStartHandler , { capture : true , passive : true } );
    this._targetDiv.addEventListener( "touchmove" , this.touchMoveHandler , { capture : true , passive : true } );
    this._targetDiv.addEventListener( "touchend" , this.touchEndHandler , { capture : true , passive : true } );
};
TouchControls.prototype.disable = function() {
    this._targetDiv.removeEventListener( "touchstart" , this.touchStartHandler , { capture : true , passive : true } );
    this._targetDiv.removeEventListener( "touchmove" , this.touchMoveHandler , { capture : true , passive : true } );
    this._targetDiv.removeEventListener( "touchend" , this.touchEndHandler , { capture : true , passive : true } );
};

/**
* Use the four arrows to  rotate the scene
* @class
*/
var KeyboardControls = function(player) { 
    if(!(this instanceof KeyboardControls)) { return new KeyboardControls(player); }
    PlayerControls.call(this, player); 
    this.keyDownHandler = this.onKeyDown.bind(this);
};
KeyboardControls.prototype = Object.create(PlayerControls.prototype);
KeyboardControls.prototype.constructor = KeyboardControls;
KeyboardControls.prototype.onKeyDown = function(event)
{
    //Get the correct keycode
    switch(event.keyCode) {
        case 37 :
            this._euler.y += 0.05;
            break;
        case 38 :
            this._euler.x += 0.05;
            break;
        case 39 :
            this._euler.y -= 0.05;
            break;
        case 40 :
            this._euler.x -= 0.05;
            break;
    }
};
KeyboardControls.prototype.enable = function() { this._targetDiv.addEventListener( "keydown" , this.keyDownHandler , false ); };
KeyboardControls.prototype.disable = function() { this._targetDiv.removeEventListener( "keydown" , this.keyDownHandler , false ); };