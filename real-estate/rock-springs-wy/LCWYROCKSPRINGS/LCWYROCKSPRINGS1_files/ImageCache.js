




/*
     FILE ARCHIVED ON 4:12:37 Jan 27, 2016 AND RETRIEVED FROM THE
     INTERNET ARCHIVE ON 21:29:42 Aug 11, 2016.
     JAVASCRIPT APPENDED BY WAYBACK MACHINE, COPYRIGHT INTERNET ARCHIVE.

     ALL OTHER CONTENT MAY ALSO BE PROTECTED BY COPYRIGHT (17 U.S.C.
     SECTION 108(a)(3)).
*/
var ImageCache=function(){var g=0,a=0,e={},c=false,d,b=[];function f(){a++;if(a==g){c=true;$.each(b,function(j,h){h()});if(d){d()}}}this.add=function(l,k,i){var h,j={loaded:false,img:null};if(e[l]){h=e[l];j.loaded=true;j.img=h}else{g++;h=new Image();h.onSuccessCallbacks=[];h.onload=function(){$.each(h.onSuccessCallbacks,function(m,n){n()});j.loaded=true;j.img=h;h.loaded=true;f()};h.onErrorCallbacks=[];h.onerror=function(){$.each(h.onErrorCallbacks,function(m,n){n()});h.loaded=false;f()};e[l]=h}if(k){h.onSuccessCallbacks.push(k)}if(i){h.onErrorCallbacks.push(i)}return j};this.loadedSuccessfully=function(i){var h=e[i];return h.loaded};this.load=function(h){d=h;$.each(e,function(j,i){i.src=j})};this.onLoad=function(h){if(c){h()}else{b.push(h)}}};