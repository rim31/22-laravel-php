/**
* An interactive object on the screen, which behaviour is defined by extending the Hotspot.prototype
* @class
* @param {QuartzPlayer} parentPlayer
* @param {Media} pm - the media the hotspot belongs to
* @param {number} id - order of creation of the hotspot, as read in the XML
*/
var Hotspot = function( parentPlayer, pm , id ) {
	if(!(this instanceof Hotspot)) { return new Hotspot(parentPlayer , pm , id); }
	this._parentMedia = pm; /* For debug purposes */
	this._player = parentPlayer;
	this._idx = id;
};
/**
*
* @function initHotspot
* @param {XMLElement} hsNode
*/
Hotspot.prototype.initHotspot = function( hsNode ) {
	console.groupCollapsed("Hotspot["+this._idx+"] from media ["+this._parentMedia+"]");
	this._hsClass = this._player.getHotspotClass( _retrieveAttribute(hsNode , "class") );

	if( !this._hsClass ) {
		console.log("Hotspot class \"" + this._hsClass + "\" not defined, use of unknown HotspotClass");
		this._hsClass = this._player.getHotspotClass("quartzDefault");
	}

	if(this._hsClass._handler) { eval("this._handler = Hotspot.prototype." + this._hsClass._handler); }

	if(this._hsClass._onHover) { eval("this._onHover = Hotspot.prototype." + this._hsClass._onHover); }

	if(this._hsClass._parser) {
		eval("this._parser = Hotspot.prototype." + this._hsClass._parser);
		this._parser( _retrieveAttribute(hsNode , "arguments") );
	}

	this._object = {};

	var lat = _getValidLatitude( parseInt(_retrieveAttribute(hsNode, "latitude")) );
	var long = _getValidLongitude( parseInt(_retrieveAttribute(hsNode, "longitude")) );
	this._depth = _getValidDepth( parseInt(_retrieveAttribute(hsNode, "depth")) );

	console.log("Lat : " + lat + " , long : " + long + " , depth : " + this._depth);

	if(!_isATrueNumber(lat) || !_isATrueNumber(long) || !_isATrueNumber(this._depth)) {
		console.log("There's an issue with this hotspot's coordinates."); //how to deal when error of placement?
	}

	this.pos = computeLatLongToPos( lat , long );

	console.debug(this.pos);

	console.groupEnd();
};
/**
*
* @function loadHotspot
*/
Hotspot.prototype.loadHotspot = function() {
	this._object = this._hsClass.createMeshClone();
	this._object.data = this;
	this._object.material = this._hsClass.createMaterialClone(); //need this to make Hotspot material reactive for a single instance

	this._object.translateOnAxis( new THREE.Vector3( this.pos[0] , this.pos[1] , this.pos[2] ), this._depth );
	this._object.lookAt( new THREE.Vector3(0,0,0) );
};
/**
*
* @function unloadHotspot
*/
Hotspot.prototype.unloadHotspot = function() { this._object.material.dispose(); }; //Do not dispose geometry neither texture as they can be used by other hotspots!
/**
*
* @function getTrigger
* @param {string} str
*/
Hotspot.prototype.getTrigger = function(str) {
	var nbTriggers = this._hsClass._triggers.length;
	this._currentTrigger = null;
	var i;
	for(i = 0 ; i < nbTriggers ; i+=1) {
		if(this._hsClass._triggers[i].key === str) {
			this._currentTrigger = this._hsClass._triggers[i].value;
			break;
		}
	}
	return this._currentTrigger;
};
/**
*
* @function hasTrigger
* @param {string} str
*/
Hotspot.prototype.hasTrigger = function(str) { return this.getTrigger( str ) !== null; };

/********************************************/
/*              Hotspot UNKNOWN             */
/********************************************/
Hotspot.prototype._parserUnknown = function (args) { console.warn("Hotspot class unknown so no arguments to parse."); };
Hotspot.prototype._hoverUnknown = function () {
	//console.log("Hotspot type unknown!");

	if( this._isActive ) { //hotspot was active, so deactivate it
		this._object.material.emissive.setHex(this._savedState.color);
		this._object.material.emissiveIntensity = this._savedState.intensity;
	}
	else { //save current state
		this._savedState =
		{
			color : this._object.material.emissive.getHex(),
			intensity : this._object.material.emissiveIntensity
		};
		this._object.material.emissive.setHex(0xffa500);
		this._object.material.emissiveIntensity = 1;
	}

	this._isActive = !this._isActive;
};
Hotspot.prototype._handlerUnknown = function () { console.warn("Hotspot class unknown so no handler to be called."); };

/********************************************/
/*                Hotspot SHOW              */
/********************************************/
Hotspot.prototype._parserShow = function (args) {
	console.group("_parserShow");

	var argList = args.split(" ");
	var nbArgs = argList.length;

	var idx = 0;
	var arg = "";
	var pair = [];
	var pos = [];
	var argValue = "";

	var inTxtData = false;
	var txtData = "";

	this._info = new Infobject();

	while(idx < nbArgs)
	{
		arg = argList[idx].trim();

		if( inTxtData ) {
			txtData += " " + arg;
			if( arg.endsWith("}") ) {
				inTxtData = false;
				this._info.data = txtData;
				txtData = "";
			}
			idx+=1;
			continue;
		}

		pair = arg.split(":");


		if( pair.length !== 2 ) {
			console.warn("Argument \"" + arg + "\" is ill-formed.");
		}
		else {
			switch(pair[0].trim().toLowerCase()) {
				case "type" :
				switch(pair[1].trim().toLowerCase()) {
					case "img" :
					this._info.type = Infobject.prototype.TYPE.IMG;
					break;
					case "mov" :
					this._info.type = Infobject.prototype.TYPE.MOV;
					break;
					case "txt" :
					this._info.type = Infobject.prototype.TYPE.TXT;
					break;
					default:
					console.error("Type \"" + pair[1] + "\" not recognized. Cannot create the object.");
					delete this._info;
					return;
				}
				break;
				case "size" :
				argValue = pair[1].trim().toLowerCase();
				switch(argValue) {
					case "s" :
					this._info.size = Infobject.prototype.SIZE.S;
					break;
					case "m" :
					this._info.size = Infobject.prototype.SIZE.M;
					break;
					case "l" :
					this._info.size = Infobject.prototype.SIZE.L;
					break;
					default:
					console.warn("Size \"" + pair[1] + "\" not recognized. Will use M as default.");
					break;
				}
				break;
				case "pos" :
				argValue = pair[1].trim().toLowerCase();
				pos = argValue.split(",");

				if( pos.length != 3 ) {
					console.warn("Error during parsing relative position of SHOW argument : [" + argValue + "]. Will place it ");
					break;
				}

				var lat = _getValidLatitude( parseInt(pos[0]) );
				var long = _getValidLongitude( parseInt(pos[1]) );
				this._info.depth = _getValidDepth( parseInt(pos[2]) );
				this._info._pos = computeLatLongToPos( lat , long );

				console.debug(this._info._pos);
				console.info("Pos = (" + pos[0] + ") - (" + pos[1] + ") - (" + this._info.depth + ")" );

				break;

				case "stay" :
				argValue = pair[1].trim().toLowerCase();
				if(argValue !== "true" && argValue !== "false") {
					console.warn("Can't understand value \"" + argValue + "\" of parameter [STAY]." );
					break;
				}
				this._info.stay = (argValue === "true");
				break;

				case "active" :
				argValue = pair[1].trim().toLowerCase();
				switch(argValue) {
					case "hover" :
					this._info.active = Infobject.prototype.ACTIVE.HOVER;
					break;
					case "action" :
					this._info.active = Infobject.prototype.ACTIVE.ACTION;
					break;
					default :
					console.warn("Value \"" + argValue + "\" for argument [ACTIVE] is not recognized.");
					break;
				}
				break;

				case "data" :
				console.info("Reading data!");
				argValue = pair[1].trim();
				if( argValue.startsWith("{") ) {
					inTxtData = true;
					txtData += argValue;
				}
				break;

				/* Cases used for images and movies */
				case "ratio" :
				if( this._info.type === Infobject.prototype.TYPE.TXT ) {
					console.log("Ratio parameter is useless for mere text.");
					break;
				}

				ratioValues = pair[1].trim().toLowerCase().split(",");
				if(ratioValues.length !== 2) {
					console.warn("Ratio must have only two valus : width and height weights.");
				}

				var rW = parseInt(ratioValues[0]);
				var rH = parseInt(ratioValues[1]);

				this._info.ratio = { w : rW , h : rH };

				break;

				case "alpha" :
				if( this._info.type === Infobject.prototype.TYPE.TXT ) {
					console.log("Alpha parameter is useless for mere text.");
					break;
				}
				argValue = pair[1].trim().toLowerCase();
				if(argValue !== "true" && argValue !== "false") {
					console.warn("Can't understand value \"" + argValue + "\" of parameter[ALPHA].");
					break;
				}
				this._info.alpha = (argValue === "true");
				break;

				/* Cases used for movies only */
				case "continue" :
				argValue = pair[1].trim().toLowerCase();
				if(argValue !== "true" && argValue !== "false") {
					console.warn("Can't understand value \"" + argValue + "\" of parameter[ALPHA].");
					break;
				}
				this._info.stopOther = (argValue === "true");
				break;

				case "chromakey" :
				this._info.chromakey = pair[1].trim().toLowerCase();
				break;
			}
		}

		idx+=1;
	}

	if( inTxtData ) { this._info.data = txtData; }

	console.debug(this._info);
	console.groupEnd();
};
Hotspot.prototype._hoverShow = function () {
	if( !Hotspot.prototype._hoverShowMat ) { //Create the new mat only if it is called at least once
		var hoverTex = QuartzVR.loadTexture(this._player._rootImgDir + "/quartz-package/show_hover.png");
		Hotspot.prototype._hoverShowMat = new THREE.MeshStandardMaterial( { color : 0xF7F7F7 , map : hoverTex , emissive : 0xf5f5f5 , emissiveIntensity : 0.5 , transparent : true } );
	}

	if( this._isActive ) { //hotspot was active, so deactivate it
		if( this._info.active === Infobject.prototype.ACTIVE.HOVER ) {
			this._handlerShow();
		}
		this._object.material.dispose();
		this._object.material = this._savedState;
	}
	else { //save current state
		if( this._info.active === Infobject.prototype.ACTIVE.HOVER ) {
			this.triggered = true;
			this._handlerShow();
			this.triggered = false;
		}
		this._savedState = this._object.material;
		this._object.material = Hotspot.prototype._hoverShowMat.clone();
	}
	this._isActive = !this._isActive;
};
Hotspot.prototype._handlerShow = function() {
	if(!this._info.corrupted)
	{
		if( this._info.active === Infobject.prototype.ACTIVE.HOVER && !this.triggered ) {
			this._info.removeObject(this._player._player3D._scene);
			return;
		} //has been activated from

		this._info.placeObject(this._player._player3D._scene);
	}
};

/********************************************/
/*                Hotspot LINK              */
/********************************************/
Hotspot.prototype._parserLink = function( args ) {
	console.groupCollapsed("Hotspot::_parserLink");

	var argList = args.split(" ");
	var nbArgs = argList.length;
	this._url = "";
	this._autoOpen = false;
	var i;
	var arg = "";
	var pair = [];
	var nbPairs = 0;
	var str = "";
	var j = 0;
	var open = "";

	for(i = 0 ; i < nbArgs ; i+=1) {
		arg = argList[i];
		pair = arg.split(":");

		nbPairs = pair.length;

		if(nbPairs !== 2 || pair[0] === "" || pair[1] === "") {
			if(pair[0].toLowerCase() === "url") { //Special case FUCK U URL
				str = "";
				for(j = 1 ; j < nbPairs ; j+=1) {
					str += pair[j];
					if( j !== nbPairs-1 ) {
						str += ":";
					}
				}
				pair[1] = str;
			}
			else {
				console.error("Argument \"" + arg + "\" ill-formed.");
				continue;
			}
		}

		switch(pair[0].toLowerCase()) {
			case "url" :
			this._url = pair[1];
			console.log("LINK : " + this._url);
			break;
			case "auto-open" :
			open = pair[1].toLowerCase();
			if( open !== "true" && open !== "false" ) {
				console.warn("Cannot understand value \"" + open + "\" for argument auto-open. Will be false.");
			}
			else { this._autoOpen = (open === "true"); }
			break;
			default :
			console.warn("Argument of type \"" + pair[0] + "\" not recognized. Value not considered.");
			break;
		}
	}

	console.groupEnd();
};
Hotspot.prototype._hoverLink = function () {
	if(!Hotspot.prototype._hoverLinkMat) { //Create the new mat only if it is called at least once
		var hoverTex = QuartzVR.loadTexture(this._player._rootImgDir + "/quartz-package/link_hover.png");
		Hotspot.prototype._hoverLinkMat = new THREE.MeshStandardMaterial( { color : 0xF7F7F7 , map : hoverTex , emissive : 0xf5f5f5 , emissiveIntensity : 0.5 , transparent : true } );
	}

	if( this._isActive ) { //hotspot was active, so deactivate it
		this._object.material.dispose();
		this._object.material = this._savedState;
	}
	else { //save current state
		this._savedState = this._object.material;
		this._object.material = Hotspot.prototype._hoverLinkMat.clone();
	}

	this._isActive = !this._isActive;
};
Hotspot.prototype._handlerLink = function() {
	//console.log("handlerLink");
	var win = window.open(this._url);
	if(!this._autoOpen) { window.focus(); }
};

/********************************************/
/*                Hotspot GOTO              */
/********************************************/
Hotspot.prototype._parserGoto = function( args ) {
	console.groupCollapsed("Hotspot._parserGoto");

	var argList = args.split(" ");
	var nbArgs = argList.length;

	this._mediaTarget = "";
	this._shift = [ 0 , 0 , 0 ];
	var i;
	var arg = "";
	var pair = [];

	for(i = 0 ; i < nbArgs ; i+=1) {
		arg = argList[i];
		pair = arg.split(":");

		if(pair.length !== 2 || pair[0] === "" || pair[1] === "") {
			console.error("Argument \"" + arg + "\" ill-formed.");
			continue;
		}

		switch(pair[0].toLowerCase()) {
			case "mediatarget" :
			this._mediaTarget = pair[1];
			console.log("GOTO : " + this._mediaTarget);
			break;
			case "shift" :
			var shifts = pair[1].split(",");
			var nbShifts = shifts.length;
			if(     nbShifts === 0 || nbShifts !== 3
				|| !(_isATrueNumber(shifts[0]) && _isATrueNumber(shifts[1]) && _isATrueNumber(shifts[2])) ) {
					console.warn("There's an issue with the attribute shift given to the hotspot");
				} else {
					this._shift = [ parseFloat(shifts[0]), parseFloat(shifts[1]), parseFloat(shifts[2]) ];
				}
				console.info("GOTO : next media entrance with a shift of [" + this._shift[0] + ";" + this._shift[1] + ";" + this._shift[2] + "]");
				break;
				default :
				console.warn("Argument of type \"" + pair[0] + "\" not recognized. Value not considered.");
				break;
			}
		}
		console.groupEnd();
	};
	Hotspot.prototype._hoverGoto = function () {
		if(!Hotspot.prototype._hoverGotoMat) { //Create the new mat only if it is called at least once
			var hoverTex = QuartzVR.loadTexture(this._player._rootImgDir + "/quartz-package/goto_hover.png");
			Hotspot.prototype._hoverGotoMat = new THREE.MeshStandardMaterial( { color : 0xF7F7F7 , map : hoverTex , emissive : 0xf5f5f5 , emissiveIntensity : 0.15 , transparent : true } );
		}

		if( this._isActive ) { //hotspot was active, so deactivate it
			this._object.material.dispose();
			this._object.material = this._savedState;
		} else { //save current state
			this._savedState = this._object.material;
			this._object.material = Hotspot.prototype._hoverGotoMat.clone();
		}
		this._isActive = !this._isActive;
	};
	Hotspot.prototype._handlerGoto = function() {
		var media = this._player.getMedia(this._mediaTarget);
		if(!media) {
			console.error("Media \"" + this._mediaTarget + "\" unknown.");
		}
		else {
			console.log("Going to \"" + media._id + "\"");
			this._player.loadMedia( media , this._shift );
		}
	};

	/********************************************/
	/*                Hotspot EVENT             */
	/********************************************/

	Hotspot.prototype._parserEvent = function( args ) {
		console.groupCollapsed("Hotspot._parserEvent");
		var argList = args.split(" ");
		var nbArgs = argList.length;
		this._objects = [];
		var i;
		var arg = "";
		var pair = [];

		for(i = 0 ; i < nbArgs ; i+=1) {
			arg = argList[i];
			pair = arg.split(":");
			if(pair.length !== 2 || pair[0] === "" || pair[1] === "") {
				console.error("Argument \"" + arg + "\" ill-formed.");
				continue;
			}

			switch(pair[0].toLowerCase()) {
				case "object" :
				var values = pair[1].split(",");
				if( values.length > 2 ) {
					console.warn("Object sent must be constituted of a single key with a single value.");
					continue;
				}
				this._objects.push({
					key : values[0],
					value : values[1]
				});
				break;
				default :
				console.warn("Argument of type \"" + pair[0] + "\" not recognized. Value not considered.");
				break;
			}
		}
		console.groupEnd();
	};
	Hotspot.prototype._hoverEvent = function () {
		if(!Hotspot.prototype._hoverEventMat) { //Create the new mat only if it is called at least once
			var hoverTex = QuartzVR.loadTexture(this._player._rootImgDir + "/quartz-package/event_hover.png");
			Hotspot.prototype._hoverEventMat = new THREE.MeshStandardMaterial( { color : 0xF7F7F7 , map : hoverTex , emissive : 0xf5f5f5 , emissiveIntensity : 0.15 , transparent : true } );
		}

		if( this._isActive ) { //hotspot was active, so deactivate it
			this._object.material.dispose();
			this._object.material = this._savedState;
		} else { //save current state
			this._savedState = this._object.material;
			this._object.material = Hotspot.prototype._hoverEventMat.clone();
		}
		
		this._isActive = !this._isActive;
	};
	Hotspot.prototype._handlerEvent = function() {
		var nbObjects = this._objects.length;
		var detail = {};
		var i;
		var obj = {};

		for(i = 0 ; i < nbObjects ; i+=1) {
			obj = this._objects[i];
			Object.defineProperty( detail , obj.key , { value : obj.value } );
		}
		var evt = new CustomEvent( "hotspottriggered" , { "bubbles" : true , "cancelable" : true , "detail" : detail } );
		window.dispatchEvent(evt);
	};
