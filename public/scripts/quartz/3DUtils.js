/**********************************************************
						SHADERS
***********************************************************/
var vShader =
"varying vec2 vUv;\
void main()\
{\
	vUv = uv;\
	vec4 mvPosition = modelViewMatrix * vec4( position, 1.0 );\
	gl_Position = projectionMatrix * mvPosition;\
}";

var fShader =
"uniform sampler2D texture;\
uniform vec3 color;\
varying vec2 vUv;\
void main()\
{\
	vec3 tColor = texture2D(texture, vUv).rgb;\
	float a = (length(tColor - color) - 0.5) * 7.0;\
	gl_FragColor = vec4(tColor, a);\
}";

/******************************************************
					VIDEO TEXTURES
*******************************************************/

ChromaKeyMaterial = function( videoElement ) {
	THREE.ShaderMaterial.call(this);
	var keyColorObject = new THREE.Color( videoElement.chromaKey );
	this.setValues({
		uniforms : {
			texture : {
				type : "t",
				value : this._videoTexture
			},
			color : {
				type : "c",
				value : keyColorObject
			}
		},
		vertexShader : vShader,
		fragmentShader : fShader,
		transparent : true
	});
	this._videoTexture = new THREE.VideoTexture( videoElement.video );
	this._videoTexture.minFilter = THREE.LinearFilter;
	this._videoTexture.magFilter = THREE.LinearFilter;
};
ChromaKeyMaterial.prototype = Object.create(THREE.ShaderMaterial.prototype);

var VideoElement = function() {
	if(!(this instanceof VideoElement)) { return new VideoElement(); }
	this.video = document.createElement("video");
	this.video.setAttribute( "crossorigin" , "anonymous" );
	this.video.setAttribute( "webkit-playsinline" , "webkit-playsinline" );
    this.video.setAttribute( "playsinline" , "playsinline" );
    this.video.style += "display : none";
};
VideoElement.prototype.setSource = function(src) {
	this.video.src = "";
	this.video.load();
	this.video.src = src;
	this.video.load();
};
VideoElement.prototype.stop = function() {
	this.video.pause();
    this.video.removeAttribute("src");
    this.video.removeAttribute("autoplay");
    this.video.removeAttribute("muted");
    this.video.removeAttribute("poster");
    this.video.load();
};

var Infobject = function() {
	if(!(this instanceof Infobject)) { return new Infobject(); }
	this.corrupted = false;

	Object.defineProperty(this, "type", {
		writable : true,
		value : Infobject.prototype.TYPE.UNKNOWN
	});
	Object.defineProperty(this, "size", {
		writable : true,
		value : Infobject.prototype.SIZE.M
	});
	Object.defineProperty(this, "active", {
		writable : true,
		value : Infobject.prototype.ACTIVE.HOVER
	});

	this._pos = [ 0 , 0 , 0 ];
	Object.defineProperty(this, "pos" , {
		get : function() { return this._pos; },
		set : function(obj) {
			this._pos = computeLatLongToPos( obj.lat , obj.long );
			console.debug( this._pos );
		}
	});
	this._depth = 50;
	Object.defineProperty(this, "depth" , {
		get : function() { return this._depth; },
		set : function(d) { this._depth = d; }
	});
	
	/* Video or image case */
	this._data = "";
	Object.defineProperty(this, "data", {
		get : function() { return this._data; },
		set : function(str) { this._data = str.substr( 1 , str.length-2 ); }
	});
	
	this._ratio = 1;
	Object.defineProperty( this , "ratio" , {
		get : function() { return this._ratio; },
		set : function(r) { this._ratio = r.w/r.h; } 
	});
	
	/* Video case */
	this.stopOther = false;
	this.alpha = false;
	this._chromaKey = 0x00FF00;
	Object.defineProperty( this , "chromakey" , {
		get : function() { return this._chromaKey; },
		set : function(hexa) {
			//Check hexa with regex
			var hexaSize = hexa.length;
			var hexaNumber = "";
			if( hexa.startsWith("#") && ( hexaSize === 7 || hexaSize === 4 ) ) {
				hexaNumber = hexa.substr(1);
			}
			else if( hexa.startsWith("0x") && ( hexaSize === 8 || hexaSize === 5 ) ) {
				hexaNumber = hexa.substr(2);
			}
			if( isNaN( parseInt(hexaNumber , 16) ) ) {
				console.warn("Chromakey value \"" + hexa + "\" given as argument is not an hexadecimal value");
				return;
			}
			this.useChromaKey = true;
			this._chromaKey = hexa;
		}
	});
	this.useChromaKey = false;

	this.stay = false;
	this.isVisible = false;
};
Infobject.prototype.placeObject = function( scene ) {
	if(this.obj === undefined && !this.corrupted) { 
		this.createObject();
		if(!this.corrupted)
		{ 
			this.obj.translateOnAxis( new THREE.Vector3( this._pos[0] , this._pos[1] , this._pos[2] ) , this.depth );
			this.obj.lookAt( new THREE.Vector3(0,0,0) );
			scene.add(this.obj);
		}
	}

	if(!this.isVisible && !this.corrupted){
		console.log("Infobject::placeObject");
		this.obj.visible = true;
		this.isVisible = true;
	}
};
Infobject.prototype.removeObject = function( scene ) {
	if(this.isVisible && !this.corrupted) {
		console.log("Infobject::removeObject");
		this.obj.visible = false;
		this.isVisible = false;
	}
}
Infobject.prototype.createObject = function() {
	console.group("Infobject::createObject");

	if(this.data === "")
	{
		this.corrupted = true;
		console.warn("Data for this infobject is empty.");
		return;
	}

	var width = 1; var computedH;

	switch(this.size) {
		case Infobject.prototype.SIZE.S :
			width = 0.5;
		case Infobject.prototype.SIZE.M :
			computedH = width*this._ratio;
			break;
		case Infobject.prototype.SIZE.L :
			width = 2;
			computedH = width*(1/this._ratio);
			break;
	}	

	var geometry = new THREE.PlaneBufferGeometry(width, computedH);
	var texture = {};
	var material = undefined;
	if(this.type === Infobject.prototype.TYPE.IMG) {
		texture = QuartzVR.loadTexture(this.data);
	}
	else if(this.type === Infobject.prototype.TYPE.MOV) {
		this.videoElem = new VideoElement();
		this.videoElem.setSource(this.data);
		
		if(this.useChromaKey) { material = new ChromaKeyMaterial(this); }
		else { texture = new THREE.VideoTexture(this.videoElem); }
	}

	if(material === undefined) { 
		console.log("Create material");
		material = new THREE.MeshBasicMaterial({ color : 0xffffff, map : texture }); 
	}

	this.obj = new THREE.Mesh( geometry , material );

	console.groupEnd();
};
Infobject.prototype.ACTIVE = Object.freeze({ HOVER : 0 , ACTION : 1 });
Infobject.prototype.TYPE = Object.freeze({ UNKNOWN : -1 , IMG : 0 , MOV : 1 , TXT : 2 });
Infobject.prototype.SIZE = Object.freeze({ S:0 , M:1 , L:2 });