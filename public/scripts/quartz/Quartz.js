/** @namespace QuartzVR */
var QuartzVR = (function () {

    var _players = [];    //All players in the same page;

    var _texLoader = undefined;

    var _STATE = Object.freeze( { UNKNOWN : 0 , TRUE : 1 , FALSE : 2 } ); //Which version of the app do we launch?

    var _license = _STATE.UNKNOWN; //Does this domain has the right to use the QuartzPlayer?

    var _cardboardAvailable = _STATE.UNKNOWN;

    var _nbDeviceMotionEvents = 0; //Just for setting the mode, then useless

    var _OS_TYPE = Object.freeze({ IOS : 0 , ANDROID : 1 });
    var _currentOS = {};

    var _quartzClock = new THREE.Clock( false );

    /* Callbacks set for checking application mode and loading players */
    var _loadCallback = {};
    var _timeoutCallback = {};
    var _primaryPressed = false;
    var _secondaryPressed = false;

    /**
     * Once licence has been checked (and is ok) and the gyroscope status is known, instantiate data for the player
     * @function _loadPlayers
     */
    var _loadPlayers = function() {
        if( _cardboardAvailable === _STATE.UNKNOWN || _license === _STATE.UNKNOWN ) { return; } //if we don't know the type of device yet, don't load
        window.clearInterval( _loadCallback );

        if( _license === _STATE.TRUE ) {
            _players.forEach( function(player) { player.value.initializePlayer(); });
            _adjustPlayer3DSize();
        }
        else {
            _players.forEach( function(player){
                player.value.displayError( ["\"" + window.location.hostname + "\" do not have the permission to use QuartzVR."] );
            });
        }
    };

    /**
     * Callback for the window.resize event
     * @function _adjustPlayer3DSize
     * @param {event} event
     */
    var _adjustPlayer3DSize = function( event ) {
        _players.forEach( function(player) { player.value.adjustPlayer3DSize(); });
    };

    /**
     * Get the current serial number on the server for Quartz and asks to QuartzVR database if serial number is approved for this host
     * @function _checkLicense
     */
    var _checkLicense = function() {
        //Get the current serial number
        console.groupCollapsed("------- Checking for license... -------");
        var serialNumberFile = new XMLHttpRequest();
        var serial = document.querySelector("meta[name=\"quartz-license\"]");
        var serialPath = serial && serial.getAttribute("content");
        serialNumberFile.open("GET", serialPath, true);
        serialNumberFile.onreadystatechange = function () {
            //Authorize offline quartz playing
            if(!window.navigator.onLine) { _license = _STATE.TRUE; return; }

            if(serialNumberFile.readyState === 4 && ( serialNumberFile.status === 200 || serialNumberFile.status === 0 ) )
            {
                var serialNumber = (serialNumberFile.responseText).trim();
                console.log("Serial number[\"" + serialNumber + "\"]");

                console.log(document.location.search);
                if (document.location.search.indexOf('debug-local') > 0) {
                    _license = _STATE.TRUE;
                    return true;
                }

                if (window.location.protocol !== "file:") {

                    var xhr = new XMLHttpRequest();
                    var location = window.location.href;
                    console.log("Location is " + location);
                    xhr.addEventListener("load", function(event) {
                        var answer = (xhr.responseText).trim();
                        //console.info("Answer retrieved : "${answer}"")
                        _license = _STATE.FALSE;

                        if( xhr.status > 399 ) {
                            var errMsg = (( xhr.status > 399 && xhr.status < 500 )? "Client" : "Server" ) + " error response : ";
                            _players.forEach( function(player){ player.value.displayError( [errMsg + xhr.status] ); });
                        }
                        else { _license = (answer === "1"? _STATE.TRUE : _STATE.FALSE); }

                        console.groupEnd();
                        _loadPlayers();
                    });
                    xhr.open("GET" , "https://quartzvr.com/?url=" + location + "&token=" + serialNumber, true);
                    xhr.send();
                }
                else { _license = _STATE.TRUE; } //file
            }
        };
        serialNumberFile.send();
    };

    /**
     * Callback for deviceorientation event, which checks if there will be more events to be fired (with interval) and
     * how many on a short period of time to detect whether there's a gyroscope or not to be used.
     * @function _onDeviceMotion
     * @param {event} event
     */
    var _onDeviceMotion = function( event ) {
        if( _cardboardAvailable === _STATE.FALSE ) { return; }
        if( event.interval === 0 ) {
            _cardboardAvailable = _STATE.FALSE;
            console.warn("This device does not have a gyroscope, you can only move the screen with touch/mouse.");
            _clearGyroscopicRecon();
        }
        _nbDeviceMotionEvents+=1;
    };
    /**
     * Set the state of the gyroscope regarding the number of devicemotion fired and reset all events
     * @function _afterTimeout
     */
    var _afterTimeout = function() {
        if(_cardboardAvailable === _STATE.UNKNOWN) { _cardboardAvailable = ( _nbDeviceMotionEvents < 5 ) ? _STATE.FALSE : _STATE.TRUE ; }
        _clearGyroscopicRecon();
    };

    /* For debug purposes only */
    var _displayMode = function() {
        switch(_cardboardAvailable) {
            case _STATE.UNKNOWN : console.warn("Can not know if gyroscope is present or not"); break;
            case _STATE.FALSE : console.warn("No gyroscopic data."); break;
            case _STATE.TRUE : console.info("Gyroscopic data"); break;
        }
    };

    var _clearGyroscopicRecon = function() {
        window.removeEventListener( "devicemotion" , _onDeviceMotion , true );
        window.clearTimeout( _timeoutCallback );
        delete _nbDeviceMotionEvents;
        delete _timeoutCallback;
        _displayMode();
    };

    /**
     * Create a QuartzPlayer and place it into the HTML page. It may be initialized later or used to display an error message.
     * @function _addPlayer
     * @param {string} id
     * @param {object} conf
     */
    var _addPlayer = function(id , conf) {
        console.groupCollapsed("_addPlayer[" + id + "]");

        var div = document.getElementById(id);

        var scriptTag = document.scripts[document.scripts.length - 1];
        var parentTag = scriptTag.parentNode;

        if(div && div instanceof HTMLElement)
        {
            div.className += " quartz";
        }
        else
        {
            var div = document.createElement("div");
            div.className = "quartz";
            div.id = id;
            parentTag.appendChild(div);
        }

        parentTag.removeChild(scriptTag);

        // à faire : récupérer l'index du tag script qui est appelé pour insérer la div juste après (et ne pas niquer leur layout!)

        _players.push( {
            key : id,
            value : new QuartzPlayer(conf, div)
        } );

        div.tabIndex = 0;
        console.groupEnd();
        return _players[_players.length-1].value;
    };

    var _getOS = function() { return ( ( String(platform.os.family).toLowerCase().includes("ios") || String(platform.os.family).toLowerCase().includes("iphone") ) ? _OS_TYPE.IOS : _OS_TYPE.ANDROID ); };
    var _addClick = function(event) { if( event.button < 1 ) { _primaryPressed = true; } else { _secondaryPressed = true; } };
    var _subClick = function(event) { if( event.button < 1 ) { _primaryPressed = false; } else { _secondaryPressed = false; } };

    return {
        /**
         * Parse arguments given by the developper to create the player and display in console possible errors.
         * @function createPlayer
         * @param {string} id
         * @param {object} playerObject
         */
        createPlayer : function(id, playerObject) {
            if(!Detector.webgl) {
                var containerDiv = document.createElement("div");
                containerDiv.className = "quartz";
                containerDiv.id = id;
                var scriptTag = document.scripts[document.scripts.length - 1];
                var parentTag = scriptTag.parentNode;
                parentTag.appendChild( Detector.getWebGLErrorMessage() );
                return;
            }

            console.groupCollapsed("createPlayer[" + id + "]::parseArguments");
            /*parsing arguments*/
            if( id === "" ) { console.warn( "Your QuartzVR player does not have an id." ); }

            var conf = {
                dataSrc : playerObject.dataSrc,
                imgFolder : "./img",
                isInteractive : false,
                isVR : true,
                isLive : false,
                properties : {
                    autolay : false,
                    loop : false,
                    muted : false,
                    poster : "",
                    shift : "0,0,0"
                }
            };

            if( playerObject.hasOwnProperty("imgFolder") && typeof playerObject.imgFolder === "string" ) { conf.imgFolder = playerObject.imgFolder; }

            if( playerObject.hasOwnProperty("isVR") && typeof playerObject.isVR === "boolean" ) { conf.properties.isVR = playerObject.isVR; }

            if( playerObject.hasOwnProperty("isInteractive") && typeof playerObject.isInteractive === "boolean" ) { conf.isInteractive = playerObject.isInteractive; }

            if( playerObject.hasOwnProperty("isLive") && typeof playerObject.isLive === "boolean" ) { conf.isLive = playerObject.isLive; }

            if( playerObject.hasOwnProperty("properties") && typeof playerObject.properties === "object" )
            {
                var prop = playerObject.properties;
                if( prop.hasOwnProperty("autoplay") && typeof prop.autoplay === "boolean") { conf.properties.autoplay = prop.autoplay; }

                if( prop.hasOwnProperty("loop") && typeof prop.loop === "boolean" ) { conf.properties.loop = prop.loop; }

                if( prop.hasOwnProperty("muted") && typeof prop.muted === "boolean" ) { conf.properties.muted = prop.muted; }

                if( prop.hasOwnProperty("poster") && typeof prop.poster === "string" ) { conf.properties.poster = prop.poster; }

                if( prop.hasOwnProperty("shift") && typeof prop.shift === "string" ) { conf.properties.shift = prop.shift; }
            }

            var p = _addPlayer(id, conf);

            if( playerObject.dataSrc === "" ) {
                p.displayError( [ "Your player does not have a source to be displayed." ] );
                return;
            }

            console.groupEnd();
        },

        /**
         * First function to be called when loading QuartzVR library
         * @function main
         */
        main : function() {
            console.log("----- QuartzVR by XXII -----");
            _checkLicense();
            _currentOS = _getOS();

            window.addEventListener( "resize" , _adjustPlayer3DSize , true );

            /* We'll use these methods to test if the device has a gyroscope or not */
            if(window.DeviceOrientationEvent) {
                window.addEventListener( "devicemotion" , _onDeviceMotion , true );
                _timeoutCallback = window.setTimeout( _afterTimeout , 1000 );
            }
            else { _cardboardAvailable = _STATE.FALSE; }

            window.addEventListener( "mouseup" , _subClick , true );
            window.addEventListener( "mousedown" , _addClick , true );

            _loadCallback = window.setInterval( _loadPlayers , 100 );
        },
        /**
         * @function getPlayerById
         */
        getPlayerById : function(id) {
            var nbPlayers = _players.length;
            var i;
            for( i = 0; i < nbPlayers ; i+=1 )
            { if( _players[i].key === id ) { return _players[i].value; } }
            return undefined;
        },
        /**
         * Create a new THREE.TextureLoader if not already instanciated and then load a texture from
         * an image, and defines UV parameters to correctly map the texture to the mesh
         * @function loadTexture
         * @param {string} src
         */
        loadTexture : function(src) {
            if( !_texLoader ) {
                _texLoader = new THREE.TextureLoader();
            }
            var texture = _texLoader.load(src);
            texture.minFilter = THREE.LinearFilter;
            texture.magFilter = THREE.LinearFilter;
            return texture;
        },
        startClock : function() {
            _quartzClock.start();
            return _quartzClock.getDelta();
        },
        stopClock : function() { _quartzClock.stop(); },
        getDeltaTime : function() { return _quartzClock.getDelta(); },
        cardboardAvailable : function() { return _cardboardAvailable === _STATE.TRUE; },
        getOS : function() { return _currentOS; },
        primaryBtnPressed : function() { return _primaryPressed; },
        resetClicks : function() { _primaryPressed = false ; }
    };
})();
QuartzVR.main();