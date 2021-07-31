




/*
     FILE ARCHIVED ON 4:12:37 Jan 27, 2016 AND RETRIEVED FROM THE
     INTERNET ARCHIVE ON 21:29:50 Aug 11, 2016.
     JAVASCRIPT APPENDED BY WAYBACK MACHINE, COPYRIGHT INTERNET ARCHIVE.

     ALL OTHER CONTENT MAY ALSO BE PROTECTED BY COPYRIGHT (17 U.S.C.
     SECTION 108(a)(3)).
*/
window.c21Helpers=(function(){return{GS:",",GS2:"|",NULL:unescape("%18"),queryToJSON:function(b){var a={},c=b.split("&");$.each(c,function(d,e){var f=e.split("=");if(f.length==2){a[f[0]]=unescape(f[1]).replace(/\+/g," ")}});return a},nullSafeStrEquals:function(a,b){if(a==null||a.length==0){a=null}if(b==null||b.length==0){b=null}return b==a},stopEvent:function(a){if(!a){var a=window.event}if(a){a.cancelBubble=true}if(a&&a.stopPropagation){a.stopPropagation()}return false}}}());