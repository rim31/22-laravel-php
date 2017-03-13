/********************
*     HotspotClass  *
*********************/

var _TRIGGERS = [ "CLICK" , "TAP" , "GAZE" , "DBLCLICK" , "TOUCH", "HOLD"];
var _HOTSPOT_SIZE = 1;

var HotspotClass = function( classNode , player ) {
    if(!(this instanceof HotspotClass)) { return new HotspotClass(); }
    this._handler = {};
    this._mesh = {};
    this._triggers = [];
    this._onHover = {};
    this._iconSrc = [];
    this._isActive = false;

    var geometry = {};
    var texture = {};
    var material = {};

    if(classNode === null) {
        //console.log("Create default hotspot")
        this._handler = HotspotClass.prototype.quartzDefaultHandler;
        geometry = new THREE.CircleBufferGeometry(_HOTSPOT_SIZE/2, 32);
        texture = QuartzVR.loadTexture(player._rootImgDir + "/quartz-package/unknown.png");
        material = new THREE.MeshStandardMaterial( { color : 0xF7F7F7 , emissive : 0xf5f5f5 , emissiveIntensity : 0.5 , map : texture , transparent : true } );
        this._mesh = new THREE.Mesh( geometry , material );

        this._onHover = "_hoverUnknown";
        this._handler = "_handlerUnknown";
        this._parser = "_parserUnknown";

        this._triggers.push({
            key : "CLICK",
            value : { properties : {} } 
        });

        this._triggers.push({
            key : "TAP",
            value : { properties : {} } 
        });

        return;
    }
    
    this._handler = _retrieveAttribute(classNode , "handler");
    this._parser = _retrieveAttribute(classNode, "parser");
    
    var geoStr = _retrieveAttribute(classNode , "geometry");
    geometry = ( geoStr === "square" ) ? new THREE.PlaneBufferGeometry(_HOTSPOT_SIZE, _HOTSPOT_SIZE) : new THREE.CircleBufferGeometry(_HOTSPOT_SIZE/2, 32);

    var hsIconsNodes = classNode.getElementsByTagName("icon");
    var nbIcons = hsIconsNodes.length;
    var i;

    for(i = 0 ; i < nbIcons ; i+=1) {
        this._iconSrc.push( _retrieveAttribute(hsIconsNodes[i],"src") );
    }

    /* Create texture */
    switch(_getSrcType(this._iconSrc[0])) {
        case _SrcType.FILE :
            //console.log("file");
            texture = QuartzVR.loadTexture( this._iconSrc[0] );
            break;
        case _SrcType.MOV :
            //console.log("mov");
            var videoElem = new VideoElement( this._iconSrc[0] );
            texture = new VideoTexture( videoElem );
            texture.minFilter = THREE.LinearFilter;
            texture.magFilter = THREE.LinearFilter;
            break;
    }
    
    this._onHover = _retrieveAttribute(hsIconsNodes[0], "onhover");
    if( this._onHover === "" ) {
        this._onHover = "_hoverUnknown";
    }
    
    material = new THREE.MeshStandardMaterial( { color : 0xF7F7F7 , emissive : 0xf5f5f5 , map : texture , transparent : true } );
    this._mesh = new THREE.Mesh( geometry , material );

    var triggerNodes = classNode.getElementsByTagName("trigger");
    var nbTriggers = triggerNodes.length;

    var triggerNode = {};
    var triggerStr = "";
    var j;
    for(j = 0 ; j < nbTriggers ; j+=1) {
        triggerNode = triggerNodes[j];
        triggerStr = triggerNode.textContent.toUpperCase();
        if( !contains(_TRIGGERS, triggerStr) ) { console.log("Trigger \"" + triggerStr + "\" is undefined."); }
        this._triggers.push({
            key : triggerStr,
            value : {
                properties : this.getTriggerProperties( triggerNode )
            } 
        });
    }
};
HotspotClass.prototype.getTriggerProperties = function( triggerNode ) {
    var prop = Object.create(null);
    var attrib = {};
    var nbAttrib = triggerNode.attributes.length;
    var i;
    for(i = 0 ; i < nbAttrib ; i+=1) {
        attrib = triggerNode.attributes[i];
        Object.defineProperty( prop , attrib.name , {
            value : attrib.value
        });
    }
    return prop;
};
HotspotClass.prototype.createMeshClone = function() { return this._mesh.clone(); };
HotspotClass.prototype.createMaterialClone = function() { return this._mesh.material.clone(); };
HotspotClass.prototype.quartzDefaultHandler = function() { console.info("Nothing planned for this hotspot."); };