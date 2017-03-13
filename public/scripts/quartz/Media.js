/*****************
*       Media    *
******************/

var Media = function() {
    if(!(this instanceof Media)) { return new Media(); }
    this._id = "";
    this._isVid = false;
    this._isVR = true;
    this._poster = {};
    this._hotspots = [];

    /** If texture is a video */
    this._playlist = [];
    this._properties = {
        autoplay : true,
        muted : false,
        loop : false,
        poster : ""
    };

    this._defaultShift = undefined; //To look at middle of screen
};
Media.prototype._hasHotspots = false;
Media.prototype._curIdxVideo = 0;
Media.prototype.initializeFromVideo = function( video, properties ) {
    console.groupCollapsed("Media::initializeFromVideo");
    this._id = "video";

    this._playlist.push( video );
    this._isVid = true;
    this._isVR = properties.isVR;

    this._poster = properties.poster; 
    this._properties = {
        autoplay : properties.autoplay,
        loop : properties.loop,
        muted : properties.muted,
        poster : properties.poster
    };
    
    var shifts = properties.shift.split("," , 3);
    if( shifts.length !== 3 ) {
        console.warn("There's - an issue with/no info given for - the default shift for this media.\nUser will see the 'center' of video at start.");
    }
    else {
        this._defaultShift = [ parseFloat(shifts[0]) , parseFloat(shifts[1]) , parseFloat(shifts[2]) ];
        console.log("Default shift : [" + this._defaultShift[0] + ";" + this._defaultShift[1] + ";" + this._defaultShift[2] + "]");
    }    

    //console.log(this);
    console.groupEnd();
};
Media.prototype.initializeFromXML = function( parentPlayer, node ) {
    this._id = _retrieveAttribute(node , "id");
    var env = _retrieveAttribute(node, "env");
    this._isVR = ( env === "" || env !== "flat" );
    //console.log("env : "${env}" so isVR is ${this._isVR}");

    console.groupCollapsed("Media[" + this._id + "]::initializeFromXML");

    var poster = node.getElementsByTagName("poster")[0];
    var idx;
    
    this._poster = ( ( poster !== undefined ) ? _retrieveAttribute( poster , "src" ) : "" );
    
    var videoNodes = node.getElementsByTagName("video");
    var nbVideoNodes = videoNodes.length;
    if( nbVideoNodes > 0 ) {
        this._isVid = true;
        
        var playlistProperties = node.getElementsByTagName("sources")[0];

        this._properties.autoplay = _isValueTrue( _retrieveAttribute( playlistProperties, "autoplay" ).toLowerCase());
        this._properties.loop = _isValueTrue( _retrieveAttribute( playlistProperties , "loop" ).toLowerCase());
        this._properties.muted = _isValueTrue( _retrieveAttribute( playlistProperties , "muted" ).toLowerCase());

        /* Then create the playlist */
        for(idx = 0 ; idx < nbVideoNodes ; idx+=1) { this._playlist.push( videoNodes[idx].textContent ); }

        this._properties.src = this._playlist[0];
        this._properties.poster = this._poster;
    }

    var hotspotsNode = node.getElementsByTagName("hotspot");
    var nbHotspots = hotspotsNode.length;
    if(nbHotspots !== 0) { this._hasHotspots = true; }
    
    for(idx = 0 ; idx < nbHotspots ; idx+=1)
    {
        this._hotspots.push( new Hotspot( parentPlayer, this._id , idx ) );
        this._hotspots[idx].initHotspot( hotspotsNode[idx] );
    }

    var shiftStr = _retrieveAttribute( node , "default_shift" );
    var shifts = shiftStr.split(",");
    if(shiftStr !== "")
    {
        console.log(shifts);
        if( shifts.length !== 3 ) {
            console.warn("There's an issue with the default shift for this media.\nUser will see the 'center' of video at start.");
        }
        else {
            this._defaultShift = [ parseFloat(shifts[0]) , parseFloat(shifts[1]) , parseFloat(shifts[2]) ];
            console.log("Default shift : [" + this._defaultShift[0] + ";" + this._defaultShift[1] + ";" + this._defaultShift[2] + "]");
        }    
    }
    console.groupEnd();
};