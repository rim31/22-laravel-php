/**
* A whole Quartz player, created for a single experience/video 
* @class
* @param {Object} conf
* @param {!HTMLElementDiv} container
*/
var QuartzPlayer = function(conf, container) {
    if(!(this instanceof QuartzPlayer)) { return new QuartzPlayer(conf, container); }
    console.log("QuartzPlayer[" + container.id + "]::QuartzPlayer");

    /**
    * The configuration given by arguments from call to javascript method
    * @member {Object}
    */
    this._conf = conf;
    /**
    * The div created to handle the player
    * @member {HTMLElementDiv}
    */
    this._container = container;
    /**
    * List of scenes in the experience
    * @member {Array<Media>}
    */
    this._media = [];
    /**
    * If player is interactive (created from a XML file), specify which media will start the experience, else is the only media created
    * @member {Media}
    */
    this._startMedia = null;
    /**
    * Absolute or relative path to the image folder for this player - will be added to each path called for loading pictures/videos
    * Allows you to create multiple players and give it different data folders
    * @member {string}
    */
    this._rootImgDir = conf.imgFolder;
    /**
    * List all the existing hotspot behaviour in these experience as defined in the XML
    * @member {Array<HotspotClass>}
    */
    this._hotspotClasses = [];
    /**
    * Interface for displaying and interacting with video and view controls
    * @member {VideoControls}
    */
    this._videoControls = undefined;
    /**
    * Handles rendering and interaction "inside" the player
    * @member {Player3D}
    */
    this._player3D = undefined;

    this._errorDiv = document.createElement("div");
    this._errorDiv.className = "error unclickable hide";
    this._container.appendChild( this._errorDiv );
};
QuartzPlayer.prototype.getHotspotClass = function(name) { return this._hotspotClasses[name]; };
QuartzPlayer.prototype.displayId = function() { return "QuartzPlayer[" + this._container.id + "]"; };
QuartzPlayer.prototype.displayError = function(msgs) {
    var nbMsgs = msgs.length;
    var i;
    for(i = 0 ; i < nbMsgs ; i+=1) { this._errorDiv.appendChild( document.createTextNode( msgs[i] ) ); }
    this._errorDiv.className = "error unclickable autoshow";
};
QuartzPlayer.prototype.initializePlayer = function() {
    console.log(this.displayId() + "::.initializePlayer from [" + (this._conf.isInteractive? "XML" : "video") + "]");

    this._conf.isInteractive ? this.loadXML() : this.loadSingleData();
    this._container.addEventListener( "touchmove" , function(evt) { evt.preventDefault(); } , { capture : true } );
};
/**
* Create a player for a single video (player defined as not interactive)
* @function loadSingleData
*/
QuartzPlayer.prototype.loadSingleData = function() {
    console.groupCollapsed(this.displayId() + "::loadSingleData");
    this._player3D = new Player3D( this );
    
    this.createVideoControls();

    this._startMedia = new Media();
    this._startMedia.initializeFromVideo( this._conf.dataSrc , this._conf.properties );
    if(this._startMedia._isVid) { this.createVideoControls(true); }

    this.loadMedia( this._startMedia, null );
    console.groupEnd();
};
/**
* Instanciate the interface to act on the current view of the player (video and global view as cardboard mode and fullscreen)
* @function createVideoControls
* @param {boolean} atLeastOneVideo
*/
QuartzPlayer.prototype.createVideoControls = function( atLeastOneVideo ) {
    //console.log(this.displayId() + "::createVideoControls");
    this._videoControls = new VideoControls(this);
    this._container.appendChild( this._videoControls.init( atLeastOneVideo ) );
    this._container.addEventListener( "mousedown", this.showControls.bind(this), { capture : true, passive : true } );
};

/**
 * Create video start button control
 *
 * @param event
 */
QuartzPlayer.prototype.createVideoStartControls = function (event) { this._videoControls.initStartControls(); };

/**
* Display the controls each time the player is clicked/touched
* @callback 
*/
QuartzPlayer.prototype.showControls = function( event ) { this._videoControls.showControls(); };
/**
* @function loadXML
*/
QuartzPlayer.prototype.loadXML = function() {
    //console.log(this.displayId() + "::loadXML");
    var xhr = new XMLHttpRequest();
    xhr.addEventListener("load", this.readXML.bind(this));
    xhr.open("GET", this._conf.dataSrc, true);
    xhr.send();
};
/**
* Parse the answer retrieved from the XML request and initialize the player (or adjust the message in the error div)
* @function readXML
* @param {Event} event
*/
QuartzPlayer.prototype.readXML = function( event ) {
    console.groupCollapsed(this.displayId()+"::readXML");
    var xmlDoc = event.currentTarget.responseXML;
    if(xmlDoc === null) {
        this.displayError( ["Couldn't parse XML to create interactive experience."] );
        console.error("Couldn't read XML at url \"" + this._conf.dataSrc + "\"");
        return;
    }

    var experienceNode = xmlDoc.getElementsByTagName("experience");
    if(experienceNode.length > 1 || experienceNode.length === 0) { console.log(this.displayId() + "::readXML :: There should be only one experiment for a single player. Only the first one will be used."); }

    this.initConfig( experienceNode[0].getElementsByTagName("config")[0] );
    this.initMedia( _retrieveAttribute( experienceNode[0] , "startMediaId" ) , experienceNode[0].getElementsByTagName("media"));
    this._player3D.setSize( this._container.offsetWidth , this._container.offsetHeight );

    //load the first scene
    console.log( this.displayId() + (this._startMedia !== null
    	? ":: The experience will start with media \"" + this._startMedia._id + "\""
    	: ":: As no starting media id has been defined, will start with the first media created.") );
    this.loadMedia( this._startMedia , null );
    console.groupEnd();
};
/**
* Prepare the player with the configuration properties given, such as hotspot behaviour and appereance for each class
* enable the target display and its look, etc.
* @function initConfig
* @param {XMLElement} configNode
*/
QuartzPlayer.prototype.initConfig = function(configNode) {
    console.groupCollapsed(this.displayId() + "::initConfig");

    var nbChildren = configNode.childNodes.length;

    var idx;
    var node;
    var j;
    var nbHC = 0;

    this._player3D = new Player3D(this);
    this._transition = document.createElement("div");
    this._transition.className = "transition unclickable hide";
    this._container.appendChild( this._transition );

    for( idx = 0 ; idx < nbChildren ; idx+=1 ) {
        node = configNode.childNodes[idx];

        if(node.nodeType !== Node.ELEMENT_NODE) { continue; }

        //console.log("Dealing with node num. " + idx + " : " + node.nodeName + " node.......");

        switch(node.nodeName) {
            case "fullscreen" :
                //Deal with source
                /**
                * @todo Parse arguments to detect if we want auto-fullscreen, see if we deal with icon only in css or in code?
                */
                break;
            case "cardboard" :
                //console.log("Dealing with cardboard mode")
                /**
                * @todo Parse arguments to detect if we allow cardboard mode, see if we deal with icon only in css or in code?
                */
                break;
            case "transition" :
                //console.log("Creating transition");
                /**
                * @todo Parse arguments in transition node to adapt the transition div
                */
                break;
            case "target" :
                //console.log("Displaying target");
                if( _isValueTrue( _retrieveAttribute(node , "enabled") ) ) { this._player3D.displayTarget( node ); }
                break;
            case "hotspot_classes":
                //console.log("Creating hotspot classes");
                var nbHotspotClass = node.childNodes.length;
                this.createHotspotClass(null); /* Create at least one default hotspot */
                nbHC+=1;
                for(j = 0 ; j < nbHotspotClass ; j+=1) {
                    if( node.childNodes[j].nodeType !== Node.ELEMENT_NODE || node.childNodes[j].nodeName !== "hotspot_class" ) { continue; }
                    this.createHotspotClass( node.childNodes[j] );
                    nbHC+=1;
                }
                break;
            case "custom_files":
                var nbFilesNodes = node.childNodes.length;
                for(j = 0 ; j < nbFilesNodes ; j+=1) {
                    if(node.childNodes[j].nodeType !== Node.ELEMENT_NODE) { continue; }

                    switch(node.childNodes[j].nodeName) {
                        case "css" : 
                            this.callCssFile(node.childNodes[j].textContent); break;
                        default :
                            console.log(this.displayId() + "::initConfig :: Node \"" + node.childNodes[j].nodeName + "\" not recognized."); break;
                    }
                }
                break;
            default :
                console.log(this.displayId() + "::initConfig :: \"" + node.nodeName + "\" node unknown."); break;
        }
    }
    console.log("Have " + nbHC + " (which 1 is default) class(es) of Hotspots.");
    console.groupEnd();
};
/**
* Prepend a new CSS file to be used by the HTML where the player has been created
* @function callCssFile
* @param {string} file
*/
QuartzPlayer.prototype.callCssFile = function(file) {
    var baliseCSS = document.createElement("link");
    baliseCSS.rel = "stylesheet";
    baliseCSS.type = "text/css";
    baliseCSS.href = file;
    document.getElementsByTagName("head")[0].appendChild( baliseCSS );
};
/**
* Create hotspot class for a XML Node (or null for at least one "default" to handle errors in defining hotspot class)
* @function createHotspotClass
* @param {XMLElement} hotspotNode
*/
QuartzPlayer.prototype.createHotspotClass = function(hotspotNode) {
    console.log(this.displayId() + "::createHotspotClass");

    if(hotspotNode === null) {
        if( "quartzDefault" in this._hotspotClasses ) {
            console.warn("There's already a class for default hotspot.");
            return;
        }
        this._hotspotClasses["quartzDefault"] = new HotspotClass( null , this );
    }
    else { this._hotspotClasses[ _retrieveAttribute(hotspotNode , "name")] = new HotspotClass( hotspotNode , this ); }
};
/**
*
* @function initMedia
* @param {string} idStart
* @param {Array<XMLElement>} mediaArray
*/
QuartzPlayer.prototype.initMedia = function( idStart , mediaArray ) {
    console.groupCollapsed(this.displayId() +"::initMedia");
    var nbMedia = mediaArray.length;
    var atLeastOneVideo = false;
    var i;
    var lastMedia = {};
    var medias = [];
    for(i = 0 ; i < nbMedia ; i+=1) {
        lastMedia = new Media(this);
        medias.push(lastMedia);
        lastMedia.initializeFromXML( this, mediaArray[i] );
        this._media[lastMedia._id] = lastMedia;
        if( i === 0 || lastMedia._id === idStart ) { this._startMedia = lastMedia; }
        //If at least one media is a video, we need to create and bind events controls
        if( lastMedia._isVid === true && !this._videoControls) { atLeastOneVideo = true; }
    }
    this.createVideoControls(atLeastOneVideo);

    if (medias[0]._isVid && !medias[0]._properties.autoplay) {
        this.createVideoStartControls();
    }
};
QuartzPlayer.prototype.getMedia = function(id) { return this._media[id]; };
/**
* Signals the user that a new scene is loading by changing the transition div, then loading the proper data into the 
* player and  fixing the video controls to adapt to the type of media
* @function loadMedia
* @param {Media} media
* @param {Object} shift
*/
QuartzPlayer.prototype.loadMedia = function( media , shift ) {
    //console.log(this.displayId() + "::loadMedia[" + media._id + "]");
    if( this._conf.isInteractive ) { this.transitionStart(); }
    this._player3D.loadMedia( media , shift );
    this._videoControls.fixControls( media._isVid );
};
/**
* Callback for when window/containing div is resized
* @function adjustPlayer3DSize
*/
QuartzPlayer.prototype.adjustPlayer3DSize = function() {
    if(this._player3D) { this._player3D.setSize( this._container.offsetWidth, this._container.offsetHeight ); }
};
/**
* Default function to deal with transition between media (start then end, or unique method with bool?)
* @todo let it be customizable for the user (like hotspot handlers, etc.?)
* @function transitionStart
*/
QuartzPlayer.prototype.transitionStart = function() {
    this._transition.className = "transition unclickable autoshow";
};
/**
* @function transitionEnd
*/
QuartzPlayer.prototype.transitionEnd = function() {
    this._transition.className = "transition unclickable autohide";
};