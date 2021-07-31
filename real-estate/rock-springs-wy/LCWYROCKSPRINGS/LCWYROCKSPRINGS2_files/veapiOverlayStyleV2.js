




/*
     FILE ARCHIVED ON 0:34:22 Jan 9, 2013 AND RETRIEVED FROM THE
     INTERNET ARCHIVE ON 16:26:18 Aug 11, 2016.
     JAVASCRIPT APPENDED BY WAYBACK MACHINE, COPYRIGHT INTERNET ARCHIVE.

     ALL OTHER CONTENT MAY ALSO BE PROTECTED BY COPYRIGHT (17 U.S.C.
     SECTION 108(a)(3)).
*/
window.Microsoft=window.Microsoft||{},window.Microsoft.Maps=window.Microsoft.Maps||{},window.Microsoft.Maps.initOverlayStyleV2=function(){function r(n,t){var i=new RegExp("(^| )"+t+"( |$)");return n+(n.search(i)===-1?" "+t:"")}var i=window.Microsoft.Maps,f=i.Map,n=i.Events,t=i.InternalNamespaceForDelay,u=t.PRF;n.addHandler(f,"mapcreationstart",function(t){if(t.options&&t.options.customizeOverlays===!0)var i=t.map,u=n.addHandler(i,"overlayscreationstart",function(){n.removeHandler(u),i.overlays.setOptions({className:r(i.overlays.getClassName(),"stylev2")})})}),delete window.Microsoft.Maps.initOverlayStyleV2,t.Dynamic&&t.Dynamic.done("Microsoft.Maps.Overlays.Style"),u.add("OverlayStyleV2 initialized")},Microsoft.Maps.Map&&Microsoft.Maps.initOverlayStyleV2&&window.Microsoft.Maps.initOverlayStyleV2()