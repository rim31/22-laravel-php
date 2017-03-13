/**
* Create a 3D scene using WebGL
* @class
*/
var that;
var Player3D = function( playerParent ) {
    if(!(this instanceof Player3D)) { return new Player3D(playerParent); }
    console.log(playerParent.displayId() + "::Player3D");

    that = this;
    /**
    * @member {QuartzPlayer}
    */
    this._parent = playerParent;
    /** 
    * @member {THREE.Scene}
    */
    this._scene = new THREE.Scene();

    this._renderer = new THREE.WebGLRenderer( { antialias : true , alpha : true } );
    this._renderer.setClearColor( 0x1e1c1c );
        
    var renderSize = this._renderer.getSize();

    this._camera = new THREE.PerspectiveCamera( 70 , renderSize.innerWidth / renderSize.innerHeight , 0.1 , 150 );
    this._camera.up = new THREE.Vector3( 0 , 0 , 1 );
    this._camera.rotation.reorder( "YXZ" );
    this._scene.add(this._camera);

    this._rootObject = new THREE.Object3D();
    this._scene.add( this._rootObject );

    /* Create an invisible target and attach it, which follow the mouse or the finger, or stay
    in the middle of screen if cardboard available */
    this._target = new Target3D();
    QuartzVR.cardboardAvailable() ? this._camera.add(this._target._targetObject) : this._rootObject.add(this._target._targetObject);
    /**
    * Defines if the cardboard mode is currently active
    * @member {bool}
    */
    this._stereoActive = false;
    /**
    * Mesh of a basic sphere for 360 environments
    * @member {THREE.Mesh}
    */
    this._sphericScreen = undefined;
    /**
    * Mesh of a basic plane for flat environments
    * @member {THREE.Mesh}
    */
    this._flatScreen = undefined;
    /**
    * Current used mesh for displaying media
    * @member {THREE.Mesh}
    */
    this._screen = undefined;
    /**
    * Do we actually display media on a sphere or on a flat screen
    * @member {bool} 
    */
    this._isVR = undefined;
        
    /** Creating the ambient light to play on emissive properties of hotspots */
    var light = new THREE.AmbientLight( 0xffffff , 2 );
    this._rootObject.add( light );

    /** 
    * Creating an empty 3D object to group all hotspots from a single media 
    * @member {THREE.Object3D}
    */
    this._hotspotGroup = new THREE.Object3D();
    this._rootObject.add( this._hotspotGroup );

    /**
    * Current target of "gaze"
    * @member {object}
    */
    this._pointer = [ 0 , 0 ];
    this._raycaster = new THREE.Raycaster();
    this._raycaster.near = 0.1;
    this._raycaster.far = 100;
    this._parent._container.appendChild( this._renderer.domElement );

    /**
    * The current hotspot that is gazed on
    * @member {Hotspot}
    */
    this._lastActiveHotspot = null;
    /**
    * Current media that's been "played" (video or picture)
    * @member {Media}
    */
    this._currentMedia = null;
    /**
    * Mesh of a mere plane to display a poster for videos
    * @member {THREE.Mesh}
    */
    this._posterPlane = null;
        
    /**
    * An array that contains all the controls that do have an effect on the rotation of the scene
    * 0 is ALWAYS the initial shift of the scene
    * 1 is ALWAYS (if available) the gyroscope
    * @member {Array<PlayerControls>}
    */
    this._controls = [];
    this._controls.push( new ShiftControls(this) );
    if(QuartzVR.cardboardAvailable()) { this._controls.push( new GyroControls(this) ); }
    this._controls.push( new KeyboardControls(this) );

    this._mouseController = new MouseControls(this);
    this._controls.push(this._mouseController);
    this._controls.push( new TouchControls(this) );
    this._nbControls = this._controls.length;

    this._SPHERIC_BASIC_BACK = this._parent._rootImgDir + "/grid.png";
    this._FLAT_BASIC_BACK = this._parent._rootImgDir + "/plane.png";
};
Player3D.prototype._SPHERE_RADIUS = 5;
/**
* Set the correct screen active in the scene according to the environment (360 or flat)
* If it's the first time the screen will be used, it is also created to avoid keeping a useless mesh in memory for too long
* @function displayScreen
* @param {bool} vr
*/
Player3D.prototype.displayScreen = function(vr) {
	var geometry = {};
	var texture = {};
	var material = {};
    if(vr && !this._sphericScreen) {
        geometry = new THREE.SphereBufferGeometry( this._SPHERE_RADIUS , 32 , 32 );
        texture = QuartzVR.loadTexture( this._SPHERIC_BASIC_BACK );
        material = new THREE.MeshBasicMaterial( { overdraw : 0.5 , map : texture , side : THREE.FrontSide } );
        this._sphericScreen = new THREE.Mesh( geometry, material );
        this._sphericScreen.scale.x = -1;
        this._rootObject.add( this._sphericScreen );
        this._rootObject.rotation.y = THREE.Math.degToRad(-90);
        this._screen = this._sphericScreen;
        this.enableMoveControls();
        if(this._isVR === undefined) { this._isVR = true; }
    }
    else if(!vr && !this._flatScreen) {
        geometry = new THREE.PlaneBufferGeometry(1 , 1);
        texture = QuartzVR.loadTexture( this._FLAT_BASIC_BACK );
        material = new THREE.MeshBasicMaterial( { overdraw : 0.5 , map : texture , side : THREE.FrontSide } );
        this._flatScreen = new THREE.Mesh( geometry, material );
        var dist = 1;
        var vFOV = this._camera.fov * Math.PI/180;
        var height = 2 * Math.tan( vFOV / 2 ) * dist;
        var width = height * this._camera.aspect;
        this._flatScreen.position.z = -dist;
        this._flatScreen.scale.x = width;
        this._flatScreen.scale.y = height;

        this._camera.add( this._flatScreen );
        this._screen = this._flatScreen;
        this.disableMoveControls();
        if(this._isVR === undefined) { this._isVR = false; }
    }

    //Si VR comme le dernier média, pas la peine de changer quoi que ce soit
    if( (this._isVR && vr) || (!this._isVR && !vr) ) { return; }

    if(vr) {
        this._camera.remove( this._flatScreen );
        this._rootObject.add( this._sphericScreen );
        this.enableMoveControls();
        QuartzVR.cardboardAvailable() ?
        this._camera.add( this._target._targetObject ) :
        this._rootObject.add( this._target._targetObject );
    }
    else {
        this._rootObject.remove( this._sphericScreen );
        this._camera.add( this._flatScreen );
        this.disableMoveControls();
        QuartzVR.cardboardAvailable() ?
        this._camera.remove( this._target._targetObject ) : 
        this._rootObject.remove( this._target._targetObject );
        //display the target if cardboard available and the button
    }

    /* On actualise le current screen qui va être actualisé */
    this._screen = (vr? this._sphericScreen : this._flatScreen);
    this._isVR = vr;
};
Player3D.prototype.enableMoveControls = function() { this._controls.forEach( function(controller) { controller.enable(); } ); };
Player3D.prototype.disableMoveControls = function() { this._controls.forEach( function(controller) { controller.disable(); } ); };
/**
* Sets a picture as a poster for a video as a plane always in front of camera (be careful of the depth of hotspots!) 
* @function displayPoster
* @param {Media} media
*/
Player3D.prototype.displayPoster = function(media) {
    console.log("Player3D::displayPoster");
    if(!this._posterPlane) {
        var dist = 1;
        var vFOV = this._camera.fov * Math.PI/180;
        var height = 2 * Math.tan( vFOV / 2 ) * dist;
        var width = height * this._camera.aspect;
        var plane = new THREE.PlaneBufferGeometry( 1 , 1 );
        var mat = new THREE.MeshBasicMaterial( { color : 0xFF0000 } );
        this._posterPlane = new THREE.Mesh( plane , mat );
        this._posterPlane.position.z = -dist;
        this._posterPlane.scale.x = width;
        this._posterPlane.scale.y = height;
    }
    var texture = QuartzVR.loadTexture( media._properties.poster );
    this._posterPlane.material = new THREE.MeshBasicMaterial({map : texture});
    this._camera.add( this._posterPlane );
    this._posterPlane.displayed = true;

    this.disableMoveControls();
};
Player3D.prototype.removePoster = function() {
    if( this._posterPlane && this._posterPlane.displayed ) {
        this._camera.remove( this._posterPlane );
        this._posterPlane.displayed = false;
    }
    if(this._isVR) { this.enableMoveControls(); }
};
Player3D.prototype.displayTarget = function( targetNode ) { this._target.applyTexture( targetNode ); };
/**
* Adapt the viewport of the scene regarding new size of containing div
* @function setSize
* @param {int} w
* @param {int} h
*/
Player3D.prototype.setSize = function( w , h ) {
    this._renderer.setSize( w , h );
    this._camera.aspect = w/h;
    this._camera.updateProjectionMatrix();
        
    if( this._isVR !== undefined && !this._isVR ) {
        this.resizePlane( this._screen );
    }

    if(this._posterPlane && this._posterPlane.displayed) {
       this.resizePlane( this._posterPlane );
    }

    if(this._stereoEffect) {
        this._stereoEffect.setSize( w, h );
    }

    this.render();
};
Player3D.prototype.resizePlane = function( plane ) {
    var vFOV = this._camera.fov * Math.PI/180;
    var height = 2 * Math.tan( vFOV / 2 );
    plane.scale.x = height * this._camera.aspect;
    plane.scale.y = height;
};
Player3D.prototype.render = function() {
    if(this._screen && this._isVR)
    {
        if( QuartzVR.cardboardAvailable() ) {
            this._controls[1].updateRotation();
        }
        var euler = new THREE.Euler( 0 , 0 , 0 , "YXZ" );
        var i;
        var c;
        for(i = 0 ; i < this._nbControls ; i+=1) {
            c = this._controls[i]._euler;
            euler.x += c.x;
            euler.y += c.y;
            euler.z += c.z;
        }
        this._camera.quaternion.setFromEuler(euler);
        this.testGaze();
        this.renderFov(euler);
    }

    if( this._stereoActive ) { 
        this._stereoEffect.render( this._scene, this._camera );
    }
    else {
        this._renderer.render( this._scene, this._camera );
    }
    requestAnimationFrame( Player3D.prototype.render.bind(this) );
};
/**
* Called each time the player is rendered to test what the user "stares" at
* @function testGaze
*/
Player3D.prototype.testGaze = function () {

    var hotspot = this.testIntersection( "GAZE" , (QuartzVR.cardboardAvailable() ? [0 , 0] : this._pointer) );

    if(!hotspot) //we lost focus on a hotspot
    {
        QuartzVR.stopClock();
        if( this._lastActiveHotspot ) {
            this._lastActiveHotspot._onHover(); //"desactivation" of hover-graphism
        }
        this._lastActiveHotspot = null;
    }
    else if( hotspot.data === this._lastActiveHotspot ) { //we still have focus on the same hotspot
        var sec = QuartzVR.getDeltaTime();
        this._totalTimeGazed += sec;
        var totalDuration = parseInt(this._lastActiveHotspot._currentTrigger.properties.time);
        if( this._totalTimeGazed > totalDuration ) {
            this._totalTimeGazed = 0;
            this._lastActiveHotspot._handler();
        }
    }
    else { //we have focus but on a different hotspot
        this._totalTimeGazed = 0;
        if( this._lastActiveHotspot ) {
            this._lastActiveHotspot._onHover(); //deactivate last hover-graphism
        }
        QuartzVR.stopClock();
        QuartzVR.startClock();
        this._lastActiveHotspot = hotspot.data;
        this._lastActiveHotspot._onHover();
    }
};

Player3D.prototype.renderFov = function (euler) {
    var vector = this._camera.getWorldDirection();
    var degree = -Math.atan2(vector.x, vector.z) * 180 / Math.PI;

    document.getElementById('fov-hand').style.transform = "rotate(" + degree + "deg)";
};
/** 
* Check if target (whether it's mouse/finger/gaze) intersects with any hotspots
* and if so, does this hotspot has a behaviour for the current trigger. Else, return null
* @function testIntersection
* @param {string} trigger
* @param {object} coords
*/
Player3D.prototype.testIntersection = function( trigger , coords ) {
    if( this._hotspotGroup.children.length === 0 ) {
        return null;
    }
        
    var target = new THREE.Vector2( coords[0] , coords[1] );

    this._raycaster.setFromCamera( target , this._camera );

    var hotspotsIntersected = this._raycaster.intersectObjects( this._hotspotGroup.children, false );
    var nbObjects = hotspotsIntersected.length;
    var rightIntersect = null;
    var idx;

    for(idx = 0 ; idx < nbObjects ; idx+=1) {
        if( this._lastActiveHotspot !== hotspotsIntersected[idx].object
        && hotspotsIntersected[idx].object.data.hasTrigger( trigger ) ) {
            rightIntersect = hotspotsIntersected[idx].object;
            break;
        }
    }
        
    return rightIntersect;
};
/**
* Clear the whole scene from precedent hotspots, instanciate initial rotation of the scene whether it's from the scene or from the hotspot,
* load texture to be displayed on the screen and place new hotspots 
* @function loadMedia
* @param {Media} currentMedia
* @param {object} shift
*/
Player3D.prototype.loadMedia = function( currentMedia , shift ) {
    console.groupCollapsed("Player3D::loadMedia[" + currentMedia._id + "] from " + (this._currentMedia ? this._currentMedia._id : "NONE"));

    this.displayScreen( currentMedia._isVR );

    var hs;
    var nbHotspots = 0;
    nbHotspots = this._hotspotGroup.children.length;
    var i;
    
    for(i = nbHotspots-1 ; i >= 0 ; i-=1) {
        hs = this._hotspotGroup.children[i];
        this._hotspotGroup.remove( hs );
        hs.data.unloadHotspot();
    }

    var s = undefined;
    var sStr = "";

    this._controls[0].resetOrientation();

    if(shift) { //If hotspot gave a shift to the new media
        sStr = "hotspot";
        s = shift;
    }
    else if(currentMedia._defaultShift) { //If media has a default shift
        sStr = "XML";
        s = currentMedia._defaultShift;
    }

    if( s !== undefined ) {
        this._controls[0].setInitialOrientation( s );
    }
    else {
        sStr = "default";
        s = [ 0 , 0 , 0 ];
    }

    console.info("Original shift given by " + sStr + " : [" + s[0] + ";" + s[1] + ";" + s[2] + "]");
        
    if(this._currentMedia && this._currentMedia._isVid) {
        this._parent._videoControls.stopVideoLoading();
    }

    this._screen.material.map = this.getTexture( currentMedia );

    nbHotspots = currentMedia._hotspots.length;

    for(i = 0 ; i < nbHotspots ; i+=1) {
        currentMedia._hotspots[i].loadHotspot();
        this._hotspotGroup.add( currentMedia._hotspots[i]._object );
    }

    this._currentMedia = currentMedia;
    console.groupEnd();

    this.render();

    this._parent._videoControls._currentVideo.video.addEventListener( "ended" , function () {

        if (currentMedia._playlist.length <= 1) {
            return;
        }

        currentMedia._playlist.shift();
        that.loadMedia(currentMedia);
    });
};
/**
* Get the right type of texture depending on media type (an mere picture or a movie?)
* @function getTexture
* @param {Media} media
*/
Player3D.prototype.getTexture = function( media ) {
    var texture = {};
    if(media._isVid) {
        var i = 0;
        var length = media._playlist.length;


        var video = this._parent._videoControls.changeVideo(media._playlist[i] , media._properties);
        if( media._properties.poster !== "" && !media._properties.autoplay) {
            this.displayPoster(media);
        }
        texture = new THREE.VideoTexture( this._parent._videoControls._currentVideo.video );
        texture.minFilter = THREE.LinearFilter;
        texture.magFilter = THREE.LinearFilter;
    }
    else {
        texture = QuartzVR.loadTexture( media._poster );
        if(this._parent._conf.isInteractive) { this._parent.transitionEnd(); }
    }
    texture.format = THREE.RGBFormat;
    return texture;
};
/**
* Switch from a single scene rendered by a single camera to two different cameras with a inter-pupillary distance.
* @function switchCardboardMode
* @todo Replace THREE.StereoEffect with THREE.OculusRiftEffect (to properly deal with lenses distortion)
*/
Player3D.prototype.switchCardboardMode = function() {
    if( !this._stereoEffect ) {
        var domElem = this._renderer.domElement;
        this._stereoEffect = new THREE.StereoEffect( this._renderer );
        this._stereoEffect.setSize( domElem.width , domElem.height );
    }

    this._stereoActive = !this._stereoActive;
    this._parent.adjustPlayer3DSize();
};