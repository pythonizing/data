




/*
     FILE ARCHIVED ON 2:47:58 Jan 29, 2016 AND RETRIEVED FROM THE
     INTERNET ARCHIVE ON 21:30:06 Aug 11, 2016.
     JAVASCRIPT APPENDED BY WAYBACK MACHINE, COPYRIGHT INTERNET ARCHIVE.

     ALL OTHER CONTENT MAY ALSO BE PROTECTED BY COPYRIGHT (17 U.S.C.
     SECTION 108(a)(3)).
*/
window.$MapsNamespace=window.$MapsNamespace||"Microsoft",window[$MapsNamespace]=window[$MapsNamespace]||{},window[$MapsNamespace].Maps=window[$MapsNamespace].Maps||{},window[$MapsNamespace].Maps.initOverlayStyleV2=function(){function f(n,t){var i=new RegExp("(^| )"+t+"( |$)");return n+(n.search(i)===-1?" "+t:"")}var n=window[$MapsNamespace].Maps,r=n.Map,t=n.Events,i=n.InternalNamespaceForDelay,u=i.PRF;t.addHandler(r,"mapcreationstart",function(n){if(n.options&&n.options.customizeOverlays===!0)var i=n.map,r=t.addHandler(i,"overlayscreationstart",function(){t.removeHandler(r),i.overlays.setOptions({className:f(i.overlays.getClassName(),"stylev2")})})}),delete window[$MapsNamespace].Maps.initOverlayStyleV2,i.Dynamic&&i.Dynamic.done("Microsoft.Maps.Overlays.Style"),u.add("OverlayStyleV2 initialized")},window[$MapsNamespace].Maps.Map&&window[$MapsNamespace].Maps.initOverlayStyleV2&&window[$MapsNamespace].Maps.initOverlayStyleV2()
