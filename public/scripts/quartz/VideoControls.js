/***********************
*    VideoControls.js   *
************************/
var _hideSeconds = 2000;
var _cardboardTimer = 3;
/**
* @class
* @classdesc Handling general view for the player, whether it's a video or not.
* Also deals with the video element that will be displayed in the player if it's a video and not a mere picture.
*/
var VideoControls = function(player) {
    if(!(this instanceof VideoControls)) { return new VideoControls(player); }
    this._player = player;
    this._currentVideo = new VideoElement();
};
/** @constant {string} */
VideoControls.prototype._btnClass = "quartz-btn";
/** @default */
VideoControls.prototype._previousLooped = false;
VideoControls.prototype._previousVolume = 1;
VideoControls.prototype._fullscreenActive = false;
VideoControls.prototype._cardboardActive = false;
VideoControls.prototype._displayAll = false;
VideoControls.prototype._visible = true;
VideoControls.prototype._mainDiv = document.createElement("div");
VideoControls.prototype._fullscreenBtn = document.createElement("div");
VideoControls.prototype._cardboardBtn = document.createElement("div");
VideoControls.prototype._cardboardTimer = document.createElement("div");
VideoControls.prototype._playPoster = document.createElement("div");
/** @function init
* Create and attribute classes to html elements to create a controller interface.
* @param {bool} atLeastOneVideo
* @returns {DocumentFragment}
*/
VideoControls.prototype.init = function( atLeastOneVideo ) {

    console.log("VideoControls::init");
    var doc = document.createDocumentFragment();

    this._mainDiv.className = "quartz-main-controls unclickable";

    var viewDiv = document.createElement("div");
    viewDiv.className = "quartz-view-controls unclickable";

    var shadowDiv = document.createElement("div");
    shadowDiv.className = "shadow-menu";
    this._mainDiv.appendChild(shadowDiv);

    this._fullscreenBtn.className = this._btnClass + " full notFull";
    this._fullscreenBtn.addEventListener( "mouseup" , this.switchFullscreen.bind(this) );
    viewDiv.appendChild( this._fullscreenBtn );

    // add cardboard button and cardboard timer
    if(QuartzVR.cardboardAvailable()) {
        this._cardboardBtn.className = this._btnClass + " cardboard mono";
        this._cardboardBtn.addEventListener( "mouseup" , this.askStereo.bind(this) );
        viewDiv.appendChild( this._cardboardBtn );
        this._cardboardTimer.className = "cardboard-timer";
        this._cardboardTimer.id = "cardboard-timer";
        this._cardboardTimer.style.display = "none";
        document.getElementById('Player').appendChild(this._cardboardTimer);
    }

    this._mainDiv.appendChild( viewDiv );

    if(atLeastOneVideo) {
        //console.log("VideoControls::At least one video");
        this._videoDiv = document.createElement("div");
        this._videoDiv.className = "quartz-video-controls unclickable";

        // var topGradient = document.createElement("div");
        // topGradient.className = "topGradient";
        // this._videoDiv.appendChild(topGradient);

        // var bottomGradient = document.createElement("div");
        // bottomGradient.className = "bottomGradient";
        // this._videoDiv.appendChild(bottomGradient);

        var bottomDiv = document.createElement("div");
        bottomDiv.className = "bottom unclickable";

        this._smallPlayBtn = document.createElement("div");
        this._smallPlayBtn.className = this._btnClass + " play small";
        this._smallPlayBtn.addEventListener( "mouseup" , this.playVideo.bind(this) );
        bottomDiv.appendChild( this._smallPlayBtn );

        this._currentTimeTxt = document.createElement("div");
        this._currentTimeTxt.className = "quartz-time-text";
        this._currentTimeTxt.appendChild( document.createTextNode("00:00") );
        this._currentVideo.video.addEventListener( "timeupdate" , this.displayCurrentTime.bind(this) , true );
        bottomDiv.appendChild( this._currentTimeTxt );

        this._timeSlider = document.createElement("div");
        this._timeSlider.className = "quartz-slider-time";
        noUiSlider.create(this._timeSlider, {
            start: 0,
            connect: [true, false],
            range: {
                "min" : 0,
                "max" : 1
            },
            direction: "ltr",
            orientation: "horizontal",
            behaviour: "tap",
            step: 0.1
        });
        this._timeSlider.noUiSlider.on( "slide" , this.seekVideo.bind(this) );
        bottomDiv.appendChild( this._timeSlider );

        this._totalTimeTxt = document.createElement("div");
        this._totalTimeTxt.className = "quartz-time-text";
        this._totalTimeTxt.appendChild( document.createTextNode("00:00") );
        this._currentVideo.video.addEventListener( "durationchange" , this.displayDuration.bind(this) , true );
        bottomDiv.appendChild( this._totalTimeTxt );

        this._muteBtn = document.createElement("div");
        this._muteBtn.className = this._btnClass + " mute";
        this._muteBtn.addEventListener( "mouseup" , this.muteVideo.bind(this) , true );
        bottomDiv.appendChild( this._muteBtn );

        this._volumeSlider = document.createElement("div");
        this._volumeSlider.className = "quartz-slider-volume";
        noUiSlider.create(this._volumeSlider, {
            start : 1,
            connect : [true, false],
            range: {
                "min" : 0,
                "max" : 1
            },
            direction : "ltr",
            orientation : "horizontal",
            behaviour : "tap",
            step : 0.1
        });
        this._volumeSlider.noUiSlider.on( "slide" , this.updateVolume.bind(this) );
        bottomDiv.appendChild( this._volumeSlider );
        this._videoDiv.appendChild( bottomDiv );
        this._mainDiv.appendChild( this._videoDiv );

        // create the <div> for the subTitles button
        // var subTitlesDiv = document.createElement("div");
        // subTitlesDiv.className = "subTitles";
        // bottomDiv.appendChild(subTitlesDiv);

    }

    // init fov button
    var fov = document.createElement('div');
    fov.className = "fov-face";
    fov.id = "fov";

    var fovHand = document.createElement('div');
    fovHand.className = "fov-hand";
    fovHand.id = "fov-hand";
    fovHand.addEventListener('click', this.resetFov.bind(this));
    fov.appendChild(fovHand);

    var fovDiv = document.createElement('div');
    fovDiv.className = "fov-sidebar";
    fovDiv.appendChild(fov);
    doc.appendChild(fovDiv);

    doc.appendChild( this._mainDiv );
    return doc;
};

/**
 * Reset fov to original orientation
 * @param event
 */
VideoControls.prototype.resetFov = function (event) {
    this._player._player3D._mouseController.fovClick(event);
};

/**
 * Initialise play button on video
 */
VideoControls.prototype.initStartControls = function () {
    this._playPoster.className = "play-poster";
    this._playPoster.id = "play-poster";
    this._cardboardTimer.style.display = "flex";
    var playBtn = document.createElement('div');
    playBtn.className = "play";

    this._playPoster.appendChild(playBtn);
    document.getElementById('Player').appendChild(this._playPoster);
    this._playPoster.addEventListener( "mouseup" , this.startVideo.bind(this) );
};

/**
* Update the controller interface layout regarding current media scene state
* @function fixControls
* @param {bool} mediaIsVideo
*/
VideoControls.prototype.fixControls = function( mediaIsVideo ) {
    if(!this._videoDiv) { return; }

    this._videoDiv.className = "quartz-video-controls unclickable " + (mediaIsVideo ? "show" : "hide");

    if(QuartzVR.cardboardAvailable()) { //on flat screen, no cardboard!
        console.info("Is player in VR? " + this._player._isVR);
        this._cardboardBtn.className = this._btnClass + " cardboard mono " + ( (this._player._isVR === undefined || this._player._isVR) ? "show" : "hide");
    }
};
VideoControls.prototype.stopVideoLoading = function() {
    this._currentVideo.stop();
};
/**
* Set a new source for the video element with all the right properties
* @function changeVideo
* @param {string} newSrc
* @param {object} properties
*/
VideoControls.prototype.changeVideo = function( newSrc , properties ) {
    console.groupCollapsed("VideoControls::changeVideo[" + newSrc + "]");

    this._currentVideo.setSource(newSrc);

    this._currentTimeTxt.textContent = "00:00";
    this._totalTimeTxt.textContent = "00:00";

    this._currentVideo.video.addEventListener("durationchange" , this.displayDuration.bind(this), false);
    this._currentVideo.video.addEventListener("timeupdate" , this.displayCurrentTime.bind(this), false);
    this._currentVideo.video.addEventListener("loadeddata" , this.hasLoadedData.bind(this), false);

    if( properties.poster !== "" ) {
        this._currentVideo.video.poster = properties.poster;
    }

    if( this._previousLooped ) {
        this._currentVideo.video.removeEventListener( "ended" , this.resetLoop.bind(this) );
    }

    this._previousLooped = false;
    if( properties.loop ) {
        this._currentVideo.video.addEventListener( "ended" , this.resetLoop.bind(this) , false );
        this._previousLooped = true;
    }

    if( properties.autoplay ) {
        this._currentVideo.video.play();
        /* WARNING : graphic section... */
        /*set images not the animation*/
        this._smallPlayBtn.className = this._btnClass + " play small videoPlaying";
    }
    else {
        this._smallPlayBtn.className = this._btnClass + " play small videoPaused";
    }

    this._timeSlider.noUiSlider.reset();

    this._currentVideo.video.muted = properties.muted;
    if( this._currentVideo.video.muted ) {
        this._previousVolume = this._currentVideo.video.volume;
        this._currentVideo.video.volume = 0;
        this._muteBtn.className = this._btnClass + " mute volumeOff";
        this._volumeSlider.noUiSlider.set(0);
    }
    else {
        this._currentVideo.video.volume = 1;
        this._muteBtn.className = this._btnClass + " mute volumeOn";
    }

    //this.hideControlsAfter = window.setTimeout( this.hideControls.bind(this) , _hideSeconds );

    console.groupEnd();
};
/**
* Called when the video has enough data downloaded to call the transition off.
* @function hasLoadedData
*/
VideoControls.prototype.hasLoadedData = function() {
    if( this._currentVideo.video.readyState > 2 ) { //has enough data buffered to be played
        if(this._player._conf.isInteractive) { this._player.transitionEnd(); }
        this._currentVideo.video.removeEventListener( "loadeddata" , this.hasLoadedData.bind(this) );
    }
};
/**
* Update the label for the duration of the video once enough metadata has been downloaded
* @function displayDuration
*/
VideoControls.prototype.displayDuration = function() {
    var duration = this._currentVideo.video.duration;

    this._timeSlider.noUiSlider.updateOptions( {
        range : {
            "min" : 0,
            "max" : duration
        }
    });

    var minutes = Math.floor(duration/60);
    /*if( minutes >= 60 ) {} //compute hours*/
    var tmpSeconds = duration%60;
    var seconds = Math.ceil( tmpSeconds.toFixed(0) );

    if( seconds === 60 ) {
        minutes += 1;
        secondes = 0;
    }

    this._totalTimeTxt.childNodes[0].textContent = _prefixNumberWithZeroes( minutes , 2 ) + ":" + _prefixNumberWithZeroes( seconds , 2 );

    this._currentVideo.video.removeEventListener( "durationchange" , this.displayDuration.bind(this) );
};
VideoControls.prototype.displayCurrentTime = function() {
    //console.log("VideoControls::displayCurrentTime");
    var actual = this._currentVideo.video.currentTime;
    this._timeSlider.noUiSlider.set(actual);

    var minutes = Math.floor(actual/60);
    /* if( minutes >= 60 ) {} //compute hours */
    var tmpSeconds = actual%60;
    var seconds = Math.ceil( tmpSeconds.toFixed(0) );

    if( seconds === 60 ) {
        minutes += 1;
        secondes = 0;
    }

    this._currentTimeTxt.childNodes[0].textContent = _prefixNumberWithZeroes( minutes , 2 ) + ":" + _prefixNumberWithZeroes( seconds , 2 );
};
VideoControls.prototype.playVideo = function( event ) {

    console.log("VideoControls::playVideo");
    QuartzVR.resetClicks();
    var isPaused = this._currentVideo.video.paused;
    this._smallPlayBtn.className = this._btnClass + " play small " + ( isPaused ? "launchVideo" : "pauseVideo" );
    if(isPaused) {
        this._player._player3D.removePoster();
        this._currentVideo.video.play();
    }
    else {
        this._currentVideo.video.pause();
    }

    this.hideControlsAfter = window.setTimeout( this.hideControls.bind(this) , _hideSeconds );
    this._playPoster.style.display = "none";
};

VideoControls.prototype.startVideo = function (event) {
    this.playVideo(event);
    this._playPoster.style.display = "none";
};

VideoControls.prototype.resetTimerHideControls = function() {
    window.clearTimeout( this.hideControlsAfter );
    this.hideControlsAfter = window.setTimeout( this.hideControls.bind(this) , _hideSeconds );
};
VideoControls.prototype.hideControls = function() {
    this._mainDiv.className = "quartz-main-controls unclickable autohide";
    this._visible = false;
};
VideoControls.prototype.showControls = function()
{
    if(this._visible) {
        this.resetTimerHideControls();
    }
    else {
        this._mainDiv.className = "quartz-main-controls unclickable autoshow";
        this._visible = true;
        this.hideControlsAfter = window.setTimeout( this.hideControls.bind(this) , _hideSeconds );
    }
};
VideoControls.prototype.muteVideo = function( event ) {
    QuartzVR.resetClicks();
    this._muteBtn.className = this._btnClass + " mute " + ( this._currentVideo.video.muted ? "setVolumeOn" : "setVolumeOff" );

    if(this._currentVideo.video.muted) {
        this._currentVideo.video.volume = this._previousVolume;
    }
    else {
        this._previousVolume = this._currentVideo.video.volume;
        this._currentVideo.video.volume = 0; /*for iphone*/
    }
    this._currentVideo.video.muted = !this._currentVideo.video.muted;
};
VideoControls.prototype.seekVideo = function( values , handle ) {
    //console.log("VideoControls::seekVideo");
    QuartzVR.resetClicks();
    this._currentVideo.video.currentTime = values[handle];
};
VideoControls.prototype.updateVolume = function( values , handle ) {
    QuartzVR.resetClicks();
    this._currentVideo.video.volume = values[handle];
    this._currentVideo.video.muted = ( (this._currentVideo.video.volume !== 0) ? false : true );
    this._muteBtn.className = this._btnClass + " mute " + ( (this._currentVideo.video.volume !== 0) ? "volumeOn" : "volumeOff" );
};
VideoControls.prototype.resetLoop = function( event ) {
    //console.log("VideoControls::resetLoop");
    this._timeSlider.noUiSlider.reset();
    this._currentVideo.video.play();
};
VideoControls.prototype.switchFullscreen = function( event ) {
    QuartzVR.resetClicks();
    this._fullscreenBtn.className = this._btnClass + " full " + ( (this._fullscreenActive) ? "exitFull" : "askFull" );
    this._fullscreenActive = !this._fullscreenActive;

    var div = this._player._container;

    if(this._fullscreenActive) { //asking for reducing
        if (document.exitFullscreen) { document.exitFullscreen(); }
        else if (document.msExitFullscreen) { document.msExitFullscreen(); }
        else if (document.mozCancelFullScreen) { document.mozCancelFullScreen(); }
        else if (document.webkitExitFullscreen) { document.webkitExitFullscreen(); }
    }
    else { //asking for fullscreen
        if (div.requestFullscreen) { div.requestFullscreen(); }
        else if (div.msRequestFullscreen) { div.msRequestFullscreen(); }
        else if (div.mozRequestFullScreen) { div.mozRequestFullScreen(); }
        else if (div.webkitRequestFullscreen) { div.webkitRequestFullscreen(); }
    }
};
/**
* Callback for click on cardboard icon, to switch on/off cardbard mode
* @function askStereo
* @param {event} event
*/
VideoControls.prototype.askStereo = function( event ) {

    QuartzVR.resetClicks();
    this._cardboardBtn.className = this._btnClass + " cardboard " + ( (this._cardboardActive) ? "s2m" : "m2s" );
    this._cardboardActive = !this._cardboardActive;

    document.getElementById('cardboard-timer').innerHTML = '';
    document.getElementById('cardboard-timer').style.display = "flex";

    if (this._cardboardActive) {
        this.displayCardboardTimer();
    }

    this._player._player3D.switchCardboardMode();
};

/**
 * Display cardboard loader for 3 seconds
 */
VideoControls.prototype.displayCardboardTimer = function ()
{
    var currentController = this;
    this._currentVideo.video.pause();
    var timer = _cardboardTimer;

    var interval = setInterval(function () {
        if (timer == 0) {
            document.getElementById('cardboard-timer').style.display = 'none';
            currentController.playVideo();
            clearInterval(interval);
        } else {

            var timerText = document.createElement('p');
            timerText.appendChild(document.createTextNode(timer));
            document.getElementById('cardboard-timer').innerHTML = '';
            document.getElementById('cardboard-timer').style.display = "flex";
            document.getElementById('cardboard-timer').appendChild(timerText);
            document.getElementById('cardboard-timer').appendChild(timerText.cloneNode(true));
            timer--;
        }

    },1000);
};