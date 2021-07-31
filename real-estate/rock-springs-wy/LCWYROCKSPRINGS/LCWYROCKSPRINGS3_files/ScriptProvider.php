




/*
     FILE ARCHIVED ON 19:06:47 Mar 13, 2015 AND RETRIEVED FROM THE
     INTERNET ARCHIVE ON 16:20:53 Aug 11, 2016.
     JAVASCRIPT APPENDED BY WAYBACK MACHINE, COPYRIGHT INTERNET ARCHIVE.

     ALL OTHER CONTENT MAY ALSO BE PROTECTED BY COPYRIGHT (17 U.S.C.
     SECTION 108(a)(3)).
*/
var ChatLoader_Interval = setInterval(function() {
	if(document && document.body) {
		clearInterval(ChatLoader_Interval);
		var scriptElement = document.createElement("script");
		scriptElement.setAttribute("type", "text/javascript");
		scriptElement.setAttribute("src", "/web/20150313190647/http://chat.xtdirect.com/Chat/MasterServer/Public/ScriptProviderOriginal.php");
		document.body.appendChild(scriptElement);
	}
}, 100);