




/*
     FILE ARCHIVED ON 19:06:51 Mar 13, 2015 AND RETRIEVED FROM THE
     INTERNET ARCHIVE ON 16:21:23 Aug 11, 2016.
     JAVASCRIPT APPENDED BY WAYBACK MACHINE, COPYRIGHT INTERNET ARCHIVE.

     ALL OTHER CONTENT MAY ALSO BE PROTECTED BY COPYRIGHT (17 U.S.C.
     SECTION 108(a)(3)).
*/
var PCJSF_Encoding_CharMap =
	new Array(	'0','1','2','3','4','5','6','7','8','9',
				'a','b','c','d','e','f','g','h','i','j',
				'k','l','m','n','o','p','q','r','s','t',
				'u','v','x','y','z','A','B','C','D','E',
				'F','G','H','I','J','K','L','M','N','O',
				'P','Q','R','S','T','U','V','W','X','Y',
				'Z','@','^','~');

var PCJSF_Encoding_ReverseCharMap = new Array();
var PCJSF_Encoding_codea = "a".charCodeAt(0);
var PCJSF_Encoding_codez = "z".charCodeAt(0);
var PCJSF_Encoding_codeA = "A".charCodeAt(0);
var PCJSF_Encoding_codeZ = "Z".charCodeAt(0);
var PCJSF_Encoding_code0 = "0".charCodeAt(0);
var PCJSF_Encoding_code9 = "9".charCodeAt(0);
var PCJSF_Encoding_codeSpace = " ".charCodeAt(0);

function PCJSF_Encoding_BuildReverseCharMap(code)
{
	var i;
	for(i = 0; i < 128; i++)PCJSF_Encoding_ReverseCharMap.push(0);
	for(i = 0; i < PCJSF_Encoding_CharMap.length; i++)PCJSF_Encoding_ReverseCharMap[PCJSF_Encoding_CharMap[i].charCodeAt(0)] = i;
}

PCJSF_Encoding_BuildReverseCharMap();

function PCJSF_Encoding_IsNormal(code)
{
	return 	((code >= PCJSF_Encoding_codea) && (code <= PCJSF_Encoding_codez)) ||
			((code >= PCJSF_Encoding_codeA) && (code <= PCJSF_Encoding_codeZ)) ||
			((code >= PCJSF_Encoding_code0) && (code <= PCJSF_Encoding_code9)) ||
			(code == PCJSF_Encoding_codeSpace);
}

function PCJSF_Encoding_Encode(message)
{
    var encoded = "";
	var state = 0;
	for(var i = 0; i < message.length; i++)
	{
		var emit = state;
	    var code = message.charCodeAt(i) % 131072;
		var nSym = PCJSF_Encoding_IsNormal(code);
		if(state == 0)
		{
			if(!nSym)
			{
				emit = 1;
				if((i + 1 < message.length) && (!PCJSF_Encoding_IsNormal(message.charCodeAt(i + 1))))
				{
					encoded += "*";
					state = 1;
				}
				else
				{
					encoded += "%";
				}
			}
		}
		else
		{
			if(nSym && (i + 1 < message.length) && (PCJSF_Encoding_IsNormal(message.charCodeAt(i + 1))))
			{
				encoded += "!";
				emit = state = 0;
			}
		}
		if(emit)
		{
			if(code < 2048)
			{
				encoded += PCJSF_Encoding_CharMap[code % 64];
				encoded += PCJSF_Encoding_CharMap[PCJSF_SafeParseInt(code / 64)];
			}
			else
			{
				encoded += PCJSF_Encoding_CharMap[code % 64];
				encoded += PCJSF_Encoding_CharMap[32 + (PCJSF_SafeParseInt(code / 64) % 32)];
				encoded += PCJSF_Encoding_CharMap[PCJSF_SafeParseInt(code / 2048)];
			}
		}
		else
		{
			encoded += (code == PCJSF_Encoding_codeSpace) ? "_" : message.charAt(i);
		}
	}
	return encoded;
}

function PCJSF_Encoding_Decode(message)
{
	var decoded = "";
	var state = 0;
	var i = 0;
	while(i < message.length)
	{		
		var read  = state;
		var chr = message.charAt(i);
		if(state == 0)
		{
			if(chr == "*")
			{
				read = state = 1;
				i++;
				continue;
			}
			else if(chr == "%")
			{
				read = 1;
				i++;
			}
		}
		else
		{
			if(chr == "!")
			{
				read = state = 0;
				i++;
				continue;
			}
		}
		if(read)
		{
			if(i + 1 < message.length)
			{
				var d0 = PCJSF_Encoding_ReverseCharMap[message.charCodeAt(i)];
				var d1 = PCJSF_Encoding_ReverseCharMap[message.charCodeAt(i + 1)];
				i += 2;
				if(d1 < 32)
				{
					decoded += String.fromCharCode(d0 + d1 * 64);
				}
				else if(i < message.length)
				{
					var d2 = PCJSF_Encoding_ReverseCharMap[message.charCodeAt(i)];
					i++;
					decoded += String.fromCharCode(d0 + (d1 - 32) * 64 + d2 * 2048);
				}
				else break;
			}
			else break;
		}
		else
		{
			decoded += (chr == "_") ? " " : chr;
			i++;
		}
	}
	return decoded;
}
//URL to the master server
var PCJSF_Processor_IdentifyServerURL = "/web/20150313190651/http://chat.xtdirect.com/Chat/MasterServer/";
var PCJSF_Processor_ServiceURL = "/web/20150313190651/http://xtdirect.com";

//Timeout when connecting to the master server
var PCJSF_Processor_IdentifyServerTimeout = 15000;

//Timeout when connecting to the chat server
var PCJSF_Processor_ServerTimeout = 15000;

//Timeout to reconnect after failed communication
var PCJSF_Processor_ReconnectTimeout = 15000;

//Lifetime in hours of the ServerURL cookie
var PCJSF_Processor_ServerURLCookieLifetime = 2;

//Number fo consequent communication errors that triger reconnect
var PCJSF_Processor_ConsequentErrorsToReconnect = 5;

//Period to automaticly connect to the server
var PCJSF_Tracker_UpdateTimeout = 8000;

//Monitoring cycle period
var PCJSF_Tracker_CyclePeriod = 100;

//Timeout to force window update if changed
var PCJSF_Tracker_WindowsSizeUpdateTime = 500;

//Window change to force update
var PCJSF_Tracker_WindowsSizeUpdateDistance = 200;

//Timeout to force scroll update if changed
var PCJSF_Tracker_ScrollUpdateTime = 500;

//Scroll change to force update
var PCJSF_Tracker_ScrollUpdateDistance = 100;

//Timeout to force mouse position update if changed
var PCJSF_Tracker_MousePositionUpdateTime = 500;

//Mosue position change to force update
var PCJSF_Tracker_MousePositionUpdateDistance = 100;

//Time after which it is considered that a page is abandoned
var PCJSF_Tracker_CookieActionTerminatedTimeout = 5000;

var PCJSF_Processor_ShowPoweredBy = true;

//Monitoring cycle period
PCJSF_Support_CyclePeriod = 100;
PCJSF_Support_CycleIEPeriod = 30;
PCJSF_Support_WFVUpdateTimeout = 8000;
PCJSF_Support_WFOUpdateTimeout = 8000;
PCJSF_Support_SESUpdateTimeout = 2000;
PCJSF_Support_LAMUpdateTimeout = 8000;
PCJSF_Support_OfferAnimPeriod = 30;
PCJSF_Support_OfferAutoMovePeriod = 5000;

PCJSF_Chat_MTStyle = "font-family:Tahoma;font-size:11px;font-weight:bold;color:#000000;";
PCJSF_Chat_MCStyle = "font-family:Tahoma;font-size:12px;font-weight:bool;color:#000000;";
PCJSF_Chat_OTStyle = "font-family:Tahoma;font-size:11px;font-weight:bold;color:#1f5d67;";
PCJSF_Chat_OCStyle = "font-family:Tahoma;font-size:12px;font-weight:bool;color:#000000;";

var PCJSF__Doc = document;
var PCJSF__Win = window;

var PCJSF_Platform_IsIOS = false;
var PCJSF_Platform_IsIOSBrowser = false;
var PCJSF_Platform_IsIOSStadnAloneBrowser = false;
var PCJSF_Platform_IsIOSUIWebView = false;

function PCJSF_DetectPlatform_IOS() {
	var standalone = window.navigator.standalone,
		userAgent = window.navigator.userAgent.toLowerCase(),
		safari = /safari/.test( userAgent ),
		ios = /iphone|ipod|ipad/.test( userAgent );
	if(ios) {
		PCJSF_Platform_IsIOS = true;
		if (!standalone && safari)PCJSF_Platform_IsIOSBrowser = true;
		else if (standalone && !safari)PCJSF_Platform_IsIOSStadnAloneBrowser = true;
		else if (!standalone && !safari)PCJSF_Platform_IsIOSUIWebView = true;
	}
}

PCJSF_DetectPlatform_IOS();

function PCJSF_SafeParseInt(value)
{
	var result = parseInt(value);
	return isNaN(result) ? 0 : result;
}

function PCJSF_Trim(str)
{
	while(str.length > 0)
	{
		var c = str.charAt(0);
		if((c == "\r") || (c == "\n") || (c == " "))str = str.substr(1);else break;
	}
	while(str.length > 0)
	{
		var c = str.charAt(str.length - 1);
		if((c == "\r") || (c == "\n") || (c == " "))str = str.substr(0, str.length - 1);else break;
	}
	return str;
}

function PCJSF_PadNumber(str, len)
{
	str = String(str);
	while(str.length < len)str = "0" + str;
	return str;
}

function PCJSF_GetWindowSize()
{
	var result = {};
	result.width = 0;
	result.height = 0;
	if(PCJSF_IsMobileDeviceValue && typeof(PCJSF__Win.innerWidth) == 'number')
	{ 
		result.width = PCJSF__Win.innerWidth;
		result.height = PCJSF__Win.innerHeight;
	} 
	else if(PCJSF__Doc.documentElement && (PCJSF__Doc.documentElement.clientWidth || PCJSF__Doc.documentElement.clientHeight))
	{
		result.width = PCJSF__Doc.documentElement.clientWidth;
		result.height = PCJSF__Doc.documentElement.clientHeight;
	} 
	else if(PCJSF__Doc.body && (PCJSF__Doc.body.clientWidth || PCJSF__Doc.body.clientHeight)) {
		result.width = PCJSF__Doc.body.clientWidth;
		result.height = PCJSF__Doc.body.clientHeight;
	}
	else if(typeof(PCJSF__Win.innerWidth) == 'number')
	{ 
		result.width = PCJSF__Win.innerWidth;
		result.height = PCJSF__Win.innerHeight;
	} 
	return result;
}

function PCJSF_GetScroll()
{
	var result = {};
	result.x = 0;
	result.y = 0;
	if(self.pageYOffset)
	{
		result.x = self.pageXOffset;
		result.y = self.pageYOffset;
	}
	else if(PCJSF__Doc.documentElement && PCJSF__Doc.documentElement.scrollTop)
	{
		result.x = PCJSF__Doc.documentElement.scrollLeft;
		result.y = PCJSF__Doc.documentElement.scrollTop;
	}
	else if(PCJSF__Doc.body)
	{
		result.x = PCJSF__Doc.body.scrollLeft;
    	result.y = PCJSF__Doc.body.scrollTop;
	}
	return result;
}

function PCJSF_ExtractMouseCoordinates(event)
{
	if(event.pageX || event.pageY)return {x:event.pageX, y:event.pageY};
	return {x:event.clientX + PCJSF__Doc.body.scrollLeft - PCJSF__Doc.body.clientLeft, y:event.clientY + PCJSF__Doc.body.scrollTop  - PCJSF__Doc.body.clientTop};
}

function PCJSF_EscapeParam(param)
{
	var escaped = "";
	for(var i = 0; i < param.length; i++)
	{
		var chr = param.charAt(i);
		if((chr == "\\") || (chr == ",") || (chr == ")") || (chr == ";"))
		{
			if(chr == "\\")escaped += "\\\\";
			else if(chr == ",")escaped += "\\c";
			else if(chr == ";")escaped += "\\d";
			else if(chr == ")")escaped += "\\b";
		}
		else escaped += chr;
	}
	return escaped;
}

function PCJSF_DecodeParam(str)
{
	var result = "";
	var index = 0;
	while(index < str.length)
	{
		var slashIndex = str.indexOf("\\", index);
		if(slashIndex < 0)break;
		result += str.substr(index, slashIndex - index);
		index = slashIndex + 1;
		if(index < str.length)
		{
			var afterSlash = str.charAt(index);
			index++;
			if(afterSlash == "\\")result += "\\";
			else if(afterSlash == "c")result += ",";
			else if(afterSlash == "d")result += ";";
			else if(afterSlash == "b")result += ")";
			else
			{
				result += "\\";
				index--;
			}
		}
		else result += "\\";
	}
	if(index < str.length)result += str.substr(index);
	return result;
}

function PCJSF_EncodeActions(actionList)
{
	if(actionList.length == 0)return "";
	var baseTime = PCJSF_SafeParseInt(actionList[0]);
	var actions = PCJSF_Tracker_PageKey + "," + baseTime + ":";
	for(var i = 0; i < actionList.length; i += 4)
	{
		var time = actionList[i];
		var type = actionList[i + 1];
		var param1 = actionList[i + 2];
		var param2 = actionList[i + 3];
		actions +=	type + (time - baseTime) +
					"(" + ((param1 !== null) ? PCJSF_EscapeParam(String(param1)) : "") +
					((param2 !== null) ? ("," + PCJSF_EscapeParam(String(param2))) : "") + ")";
	}
	return actions;
}

function PCJSF_DisableSelectionById(target, cursor)
{
	PCJSF_DisableSelection(PCJSF__Doc.getElementById(target), cursor);
}

function PCJSF_DisableSelection(target, cursor)
{
	if(!target)return;
	if (typeof target.onselectstart != "undefined")
	{
		target.onselectstart = function(){return false;}
	}
	else if (typeof target.style.MozUserSelect != "undefined")
	{
		target.style.MozUserSelect="none";
	}
	else
	{
		target.onmousedown=function(){return false;}
	}
	target.style.cursor = cursor;
}

function PCJSF_StopBubbling(event)
{
	if(event && event.stopPropagation)
	{
		event.stopPropagation();
	}
	else
	{
		event.cancelBubble=true;
	}
}

function PCJSF_FixStyle(style)
{
	var tbl = new Array();
	var cond = 0;
	var n = "";
	var v = "";
	var i = 0;
	while(i < style.length)
	{
		var ch = style.charAt(i);
		var code = style.charCodeAt(i);
		i++;
		switch(cond)
		{
			case 0:
				if(ch == ";")
				{
					if(n.length > 0)tbl[n] = "";
					n = "";
				}
				else if(ch == ":")cond = 1;
				else if(code > 32)n += ch;
				break;
			case 1:
				if(ch == ";")
				{
					if(n.length > 0)tbl[n] = v;
					n = "";
					v = "";
					cond = 0;
				}
				else v += ch;
				break;
		}
	}
	if(n.length > 0)tbl[n] = v;
	var res = "";
	if((tbl["margin"] == undefined) && (tbl["margin-left"] == undefined))res += "margin:0px;";
	if((tbl["padding"] == undefined) && (tbl["padding-left"] == undefined))res += "padding:0px;";
	if((tbl["border"] == undefined) && (tbl["border-left"] == undefined))res += "border:0px solid;";
	if(tbl["line-height"] == undefined)res += "line-height:100%;";
	if(tbl["text-align"] == undefined)res += "text-align:left;";
	if(tbl["vertical-align"] == undefined)res += "vertical-align:middle;";
	if(tbl["text-shadow"] == undefined)res += "text-shadow:none;";
	if((tbl["background"] == undefined) && (tbl["background-image"] == undefined))res += "background:transparent;";
	return res;
}

function PCJSF_BuildText(tag, id, font, size, color, weight, style, text, htmlStyle)
{
	return "<" + tag + (id ? (" id=\"" + id + "\" "): "") +" style=\"font-family:'" + font + "';font-size:" + size + ";color:" + color + ";font-weight:" + weight + ";font-style:" + style + ";text-decoration: none;" + htmlStyle + "\">" + text + "</" + tag + ">";
}

var PCJSF_ButtonIndex = 0;
var PCJSF_ButtonToDefinition = new Array();
var PCJSF_AllowButtonState = true;

function PCJSF_BuildButton(width, height, style, img, imgHOver, text, func)
{
	PCJSF_ButtonIndex++;
	var def = {};
	def.width = width;
	def.height = height;
	def.style = style;
	def.img = img;
	def.imgHOver = imgHOver;
	def.text = text;
	def.func = func;
	PCJSF_ButtonToDefinition[PCJSF_ButtonIndex] = def;
	var html = "";
	html += "<div id=\"PCJSF_ButtonDiv" + PCJSF_ButtonIndex + "\"";
	if(PCJSF_AllowButtonState)
	{
		html += " onmouseover=\"PCJSF_IntWin.PCJSF_BuildOver(" + PCJSF_ButtonIndex + ");\"";
		html += " onmouseout=\"PCJSF_IntWin.PCJSF_BuildOut(" + PCJSF_ButtonIndex + ");\"";
	}
	html += " onmousedown=\"PCJSF_IntWin.PCJSF_StopBubbling(event); PCJSF_IntWin.PCJSF_ButtonOnClick(" + PCJSF_ButtonIndex + "); return false;\" style=\"float:left;\">";
	html += "<table id=\"PCJSF_ButtonTable" + PCJSF_ButtonIndex + "\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"" + PCJSF_BuildButtonTBLStyle(img, width, height, style) + "\">";
	html += "<tr><td id=\"PCJSF_ButtonText" + PCJSF_ButtonIndex + "\" align=\"center\" style=\"padding:" + PCJSF_Support_ButtonPadding + "px;padding-top:" + (PCJSF_Support_ButtonPadding - 4) + "px;;vertical-align:middle;\">";
	if(text != null)html += text;else html += "";
	html += "</td></tr></table></div>";
	return html;
}

function PCJSF_BuildButtonTBLStyle(img, width, height, customStyle)
{
	var style = "";
	style += ((width != null) ? ("width:" + width + "px;") : "") + "height:" + height + "px;cursor:hand;cursor:pointer;margin:0px;";
	if(img)
	{
		style += "background-image:url(" + img + ");background-repeat:no-repeat;";
	}
	style += customStyle;
	if((style != "") && (style[style.length - 1] != ";"))style += ";";
	style += PCJSF_FixStyle(style);
	return style;
}

function PCJSF_BuildTextButton(text, func)
{
	return PCJSF_BuildButton(null, 17, "border:" + PCJSF_Support_ButtonBorder + ";background:" + PCJSF_Support_ButtonBackground + ";", null, null,
		PCJSF_BuildText(
			"span", null,
			PCJSF_Support_Font, PCJSF_Support_ButtonTextSize, PCJSF_Support_ButtonColor, "bold", "normal", text),
		func);
}

function PCJSF_BuildOver(index)
{
	var info = PCJSF_ButtonToDefinition[index];
	var img = info.imgHOver;
	if(img == null)img = info.img;
	var table = PCJSF__Doc.getElementById("PCJSF_ButtonTable" + index);
	table.setAttribute("style", PCJSF_BuildButtonTBLStyle(img, info.width, info.height, info.style));
}

function PCJSF_BuildOut(index)
{
	var info = PCJSF_ButtonToDefinition[index];
	var img = info.img;
	var table = PCJSF__Doc.getElementById("PCJSF_ButtonTable" + index);
	table.setAttribute("style", PCJSF_BuildButtonTBLStyle(img, info.width, info.height, info.style));
}

function PCJSF_UpdateButton(index, width, height, img, imgHOver, text, textHOver, func)
{
	var info = PCJSF_ButtonToDefinition[index];
	var def = {};
	def.width = width;
	def.height = height;
	def.style = info.style;
	def.img = img;
	def.imgHOver = imgHOver;
	def.text = text;
	def.textHOver = textHOver;
	def.func = func;
	PCJSF_ButtonToDefinition[index] = def;
	var table = PCJSF__Doc.getElementById("PCJSF_ButtonTable" + index);
	table.setAttribute("style", PCJSF_BuildButtonTBLStyle(img, info.width, info.height, info.style));
	var div = PCJSF__Doc.getElementById("PCJSF_ButtonText" + index);
	if(text != null)div.innerHTML = PCJSF_FixS(text);else div.innerHTML = "";
}

function PCJSF_ButtonOnClick(index)
{
	var func = PCJSF_ButtonToDefinition[index].func;
	if(func)func();
}

function PCJSF_GetOpacityStyle(alpha)
{
	var style = "";
	if(alpha < 95)
	{
		if(PCJSF_Support_IsIE)
		{
			style += "filter: alpha(opacity=" + PCJSF_SafeParseInt(alpha) + ");";
			style += "filter:progid:DXImageTransform.Microsoft.Alpha(opacity=" + PCJSF_SafeParseInt(alpha) + ");";
		}
		else
		{
			style += "opacity: " + (alpha / 100.0) + ";";
		}
	}
	return style;
}

function PCJSF_SplitParameters(parameters)
{
	var parameterList = parameters.split(",");
	for(var i = 0; i < parameterList.length; i++)
	{
		parameterList[i] = PCJSF_DecodeParam(parameterList[i]);
	}
	return parameterList;
}

function PCJSF_FixS(html)
{	
	var res = "";
	var cond = 0;
	var	i = 0;
	var tag = "";
	var attr = "";
	var vl = "";
	var styleFixed = false;
	while(i < html.length)
	{
		var fix = false;
		var ch = html.charAt(i);
		var code = html.charCodeAt(i);
		i++;
		switch(cond)
		{
			case 0:
				if(ch == "<")cond = 10;
				break;
			case 10:
				if(code <= 32)cond = 11;
				else if(ch == ">"){ fix = true; cond = 0; }
				else tag += ch;
				break;
			case 11:			
				if(ch == ">"){ fix = true; cond = 0; }
				else if((code <= 32) || (ch == "="))
				{
					if(attr.length > 0)cond = (ch == "=") ? 13 : 12;
				}
				else attr += ch;
				break;
			case 12:
				if(ch == "=")cond=13;
				break;
			case 13:
				if(ch == "\"")cond=14;
				break;
			case 14:
				if(ch == "\"")
				{
					if(attr == "style")
					{
						if(res[res.length - 1] != ";")res += ";";
						res += PCJSF_FixStyle(vl);
						styleFixed = true;
					}
					cond = 11;
					attr = "";
					vl = "";
				}
				else
				{
					vl += ch;
					if(ch == "\\")cond = 15;
				}
				break;
			case 15:
				vl += ch;
				cond = 14;
				break;
		}
		if(fix)
		{
			if((!styleFixed) && (tag.indexOf("/") != 0))res += " style=\"" + PCJSF_FixStyle("") + "\" ";
			cond = 0;
			tag = "";
			styleFixed = false;
		}
		res += ch;
	}
	return res;
}

function PCJSF_IsScalar(mixed_var)
{
    return (/boolean|number|string/).test(typeof mixed_var);
}

function PCJSF_IsArray(input)
{
	return typeof(input)=='object'&&(input instanceof Array);
}

function PCJSF_MeasureElement(element) {
	var hasParent = element.parentNode && ((element.parentNode == PCJSF__Doc) || !((typeof(HTMLDocument) !== 'undefined') && (element.parentNode instanceof HTMLDocument)));
	var width = (element.style.width.indexOf("%") >= 0) ? 0 : parseInt(element.style.width);
	var height = (element.style.height.indexOf("%") >= 0) ? 0 : parseInt(element.style.height);
	if((width > 0) && (height > 0))return [width, height];
	if(hasParent && (element.offsetWidth > 0) && (element.offsetHeight > 0))return [element.offsetWidth, element.offsetHeight];
	else {
		if(hasParent)return [element.offsetWidth, element.offsetHeight];
		var oldVisibility = element.style.visibility;
		var oldPosition = element.style.position;
		element.style.visibility = "hidden";
		element.style.position = "absolute";
		PCJSF__Doc.body.appendChild(element);
		var size = [element.offsetWidth, element.offsetHeight];
		PCJSF__Doc.body.removeChild(element);
		element.style.visibility = oldVisibility;
		element.style.position = oldPosition;
		return size;
	}
}

function PCJSF_PositionFixedElement(element, alignementX, alignmentY, offsetX, offsetY, width, height) {
	var elementSize = (width > 0) ? [width, height] : null;
	var windowSize = null;
	if(!elementSize)elementSize = PCJSF_MeasureElement(element);
	if(!windowSize)windowSize = PCJSF_GetWindowSize();
	if(alignementX == 0) {
		if(windowSize.width - elementSize[0] - offsetX < 0)offsetX = windowSize.width - elementSize[0];
		if(offsetX < 0)offsetX = offsetX;
		element.style.left = offsetX + "px";
		element.style.right = "";
	}
	else if(alignementX == 1) {
		var offset = (Math.floor((windowSize.width - elementSize[0]) / 2) + offsetX);
		if(offset + elementSize[0] > windowSize.width)offset = windowSize.width - elementSize[0];
		if(offset < 0)offset = 0;
		element.style.left = (Math.floor((windowSize.width - elementSize[0]) / 2) + offsetX) + "px";
		element.style.right = "";		
	}
	else {
		if(windowSize.width - elementSize[0] - offsetX < 0)offsetX = windowSize.width - elementSize[0];
		if(offsetX < 0)offsetX = 0;
		element.style.left = "";
		element.style.right = offsetX + "px";
	}
	if(alignmentY == 0) {
		if(windowSize.height - elementSize[1] - offsetY < 0)offsetY = windowSize.height - elementSize[1];
		if(offsetY < 0)offsetY = offsetY;
		element.style.top = offsetY + "px";
		element.style.bottom = "";
	}
	else if(alignmentY == 1) {
		var offset = (Math.floor((windowSize.height - elementSize[1]) / 2) + offsetY);
		if(offset + elementSize[1] > windowSize.height)offset = windowSize.height - elementSize[1];
		if(offset < 0)offset = 0;
		element.style.top = (Math.floor((windowSize.height - elementSize[1]) / 2) + offsetY) + "px";
		element.style.bottom = "";		
	}
	else {
		if(windowSize.height - elementSize[1] - offsetY < 0)offsetY = windowSize.height - elementSize[1];
		if(offsetY < 0)offsetY = 0;
		element.style.top = "";
		element.style.bottom = offsetY + "px";
	}
}

function PCJSF_IsValidEMail(email)
{
	var re = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;
	return re.test(email);
}

function PCJSF_IsValidUrl(url)
{
	if(url.indexOf("http://") == 0)return true;
	if(url.indexOf("https://") == 0)return true;
	return false;
}

function PCJSF_SetStyle(element, style, value)
{
	if(element.style[style] != value)element.style[style] = value;
}

function PCJSF_SetAttribute(element, attribute, value)
{
	if(element.getAttribute(attribute) != value)element.setAttribute(attribute, value);
}

function PCJSF_IsMobileDevice() {
	var check = false;
	(function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))check = true})(navigator.userAgent||navigator.vendor||window.opera);
	return check;
}

var PCJSF_IsMobileDeviceValue = PCJSF_IsMobileDevice();

function PCJSF_EscapeHtml(text)
{
	text = text.replace(/&/g, "&amp;");
	text = text.replace(/</g, "&lt;");
	text = text.replace(/>/g, "&gt;");
	text = text.replace(/"/g, "&quot;");
	text = text.replace(/'/g, "&#39;");
	text = text.replace(/\//g, "&#x2F;");
	text = text.replace(/\r/g, "");
	text = text.replace(/\n/g, "<br />");
	return text;
}

function PCJSF_UnescapeHtml(text)
{
	text = text.replace(/&lt;/g, "<");
	text = text.replace(/&gt;/g, ">");
	text = text.replace(/&quot;/g, "\"");
	text = text.replace(/&#39;/g, "'");
	text = text.replace(/&#x2F;/g, "/");
	text = text.replace(/<br \/>/g, "\r\n");
	text = text.replace(/&amp;/g, "&");
	return text;
}

function PCJSF_ClearChildren(element) {
	while (element.firstChild)element.removeChild(element.firstChild);
}

var PCJSF_AddGlobalStyle_Sheet = (PCJSF__Doc.styleSheets.length > 0) ? PCJSF__Doc.styleSheets[0] : null;

if(PCJSF_AddGlobalStyle_Sheet == null)
{
	(function() {
		try
		{
			var style = PCJSF__Doc.createElement("style");
			style.appendChild(PCJSF__Doc.createTextNode(""));
			PCJSF__Doc.head.appendChild(style);
			PCJSF_AddGlobalStyle_Sheet = style.sheet;
		}
		catch(e)
		{
		}
	}) ();
}
	
function PCJSF_AddGlobalStyle(selector, style) {
	try
	{
		if(PCJSF_AddGlobalStyle_Sheet.insertRule)
			PCJSF_AddGlobalStyle_Sheet.insertRule(selector + '{' + style + '}', PCJSF_AddGlobalStyle_Sheet.cssRules.length);
		else
			PCJSF_AddGlobalStyle_Sheet.addRule(selector, style, -1);
	}
	catch(e)
	{
	}
}

var PCJSF_CustomFont_LastId = 0;

/*CustomFont*/function PCJSF_CustomFont(/*string*/name, /*string*/folder) {
	var mSelf = this;
	PCJSF_CustomFont_LastId++;
	var mId = PCJSF_CustomFont_LastId;
	var mName = name;
	this.GetName = function() { return mName; }
	PCJSF_AddGlobalStyle("@font-face", 
		"font-family: '" + name + "';" +
		"src: url('" + folder + "/" + name + "/" + name + ".ttf');" + 
		"src: url('" + folder + "/" + name + "/" + name + ".woff') format('woff'),  url('" + folder + "/" + name + "/" + name + ".ttf') format('truetype'),  url('" + folder + "/" + name + "/" + name + ".svg') format('svg');" +
		"font-weight: normal;" +
		"font-style: normal;");
}

var PCJSF_GetCustomFont_Map = {};

/*CustomFont*/function PCJSF_GetCustomFont(/*string*/name, /*string*/folder) {
	var font = PCJSF_GetCustomFont_Map[name];
	if(font)return font;
	font = new PCJSF_CustomFont(name, folder);
	PCJSF_GetCustomFont_Map[name] = font;
	return font;
}

function PCJSF_ClearChildren(element)
{
	while(element.firstChild)element.removeChild(element.firstChild);
}

var PCJSF_ForbidLocalStorage = false;

function PCJSF_LSSet(key, value)
{
	if(!PCJSF_ForbidLocalStorage)
	{
		try
		{
			localStorage.setItem(key, value);
			return;
		}
		catch(e)
		{
		}
	}
	var date = new Date();
	date.setTime(date.getTime()+(8760*60*60*1000));
	var expires = "; expires="+date.toGMTString();
	document.cookie = key+"="+value+expires+"; path=/";
}

function PCJSF_LSGet(key)
{
	if(!PCJSF_ForbidLocalStorage)
	{
		try
		{
			var result = localStorage.getItem(key);
			if(result)return result;
		}
		catch(e)
		{
		}
	}
	var keyEQ = key + "=";
	var ca = document.cookie.split(';');
	for(var i = 0; i < ca.length; i++)
	{
		var c = PCJSF_Trim(ca[i]);
		if (c.indexOf(keyEQ) == 0)
		{
			return PCJSF_Trim(c.substr(keyEQ.length));
		}
	}
	return null;
}

function PCJSF_LSRemove(key)
{
	if(!PCJSF_ForbidLocalStorage)
	{
		try
		{
			localStorage.removeItem(key);
		}
		catch(e)
		{
		}
	}
	var date = new Date();
	date.setTime(date.getTime() - (60*60*1000));
	var expires = "; expires="+date.toGMTString();
	document.cookie = key+"="+expires+"; path=/";
}

function PCJSF_LSGetAllWithPrefix(keyPrefix)
{
	var keys = [];
	if(!PCJSF_ForbidLocalStorage)
	{
		try
		{
			var len = localStorage.length;
			for (var i = 0; i < len; i++) {
				var key = localStorage.key(i);
				if(key.indexOf(keyPrefix) == 0)keys.push(key);
			}
		}
		catch(e)
		{
		}
	}
	var ca = document.cookie.split(';');
	for(var i = 0; i < ca.length; i++)
	{
		var c = PCJSF_Trim(ca[i]);
		if (c.indexOf(keyPrefix) == 0)
		{
			var equalIndex = c.indexOf("=");
			if(equalIndex >= 0)keys.push(c.substr(0, equalIndex));else keys.push(c);
		}
	}
	return keys;
}

function PCJSF_DeserializePacket(data)
{
	var result = new Array();
	if(data.length == 0)return result;
	var list = data.split(",");
	if((list.length % 2) != 0)return null;
	var pairsCount = PCJSF_SafeParseInt(list.length / 2);	
	for(var i = 0; i < pairsCount; i++)
	{
		result[PCJSF_Encoding_Decode(list[i * 2])] = PCJSF_Encoding_Decode(list[i * 2 + 1]);
	}
	return result;
}

function PCJSF_DeserializeData(data)
{
	var result = new Array();
	var offset = 0;
	var dotPos = data.indexOf(":", exPos);
	if(dotPos < 0)return result;
	var id = PCJSF_Encoding_Decode(data.substr(offset, dotPos - offset));
	result["_id"] = id;
	offset = dotPos + 1;
	while(true)
	{
		var exPos = data.indexOf(":", offset);
		if(exPos < 0)break;
		var key = PCJSF_Encoding_Decode(data.substr(offset, exPos - offset));
		var dotPos = data.indexOf(".", exPos);
		if(dotPos < 0)break;
		value = PCJSF_DeserializePacket(data.substr(exPos + 1, dotPos - exPos - 1));
		if(value === null)break;
		result[key] = value;
		offset = dotPos + 1;
	}
	return result;
}

function PCJSF_SerializePacket(data)
{
	var result = "";
	for(var key in data)
	{
		if(!PCJSF_IsScalar(data[key]))continue;
		if(result !== "")result += ",";
		result += PCJSF_Encoding_Encode(String(key)) + "," + PCJSF_Encoding_Encode(String(data[key]));
	}
	return result;
}

function PCJSF_SerializeData(data)
{
	var result = data["_id"] + ":";
	for(var key in data)
	{
		if(!PCJSF_IsArray(data[key]))continue;
		if(key != "_id")
		{
			result += PCJSF_Encoding_Encode(String(key)) + ":" + PCJSF_SerializePacket(data[key]) + ".";
		}
	}
	return result;
}

var PCJSF_SendRequest_CurrentPacketId = -1;
var PCJSF_SendRequest_CurrentCallback = null;
var PCJSF_SendRequest_LastPacketId = 0;
var PCJSF_SendRequest_Timeout = null;

function PCJSF_SendRequest(url, data, callback, timeout)
{
	if(PCJSF_SendRequest_Timeout)clearTimout(PCJSF_SendRequest_Timeout);
	PCJSF_SendRequest_Timeout = setTimeout("PCJSF_SendRequestTimeout()", timeout);
	PCJSF_SendRequest_CurrentPacketId = PCJSF_SendRequest_LastPacketId;
	PCJSF_SendRequest_CurrentCallback = callback;
	PCJSF_SendRequest_LastPacketId++;
	data["_id"] = String(PCJSF_SendRequest_CurrentPacketId);
	var serialized = PCJSF_SerializeData(data);
	var scriptContainer = document.getElementById("PCJSF_ScriptContainer");
    var scriptChildElement = document.createElement("script");
    scriptChildElement.setAttribute("src", url + "?packets=" + serialized);
    scriptChildElement.setAttribute("type", 'text/javascript');
	scriptChildElement.setAttribute("id", "PCJSF_CommScriptId");
	var oldScriptChildElement = document.getElementById("PCJSF_CommScriptId"); 
	if(oldScriptChildElement)scriptContainer.removeChild(oldScriptChildElement); 
	scriptContainer.appendChild(scriptChildElement); 
}

function PCJSF_SendRequestFinished(data)
{
	if(PCJSF_SendRequest_Timeout)clearTimeout(PCJSF_SendRequest_Timeout);
	PCJSF_SendRequest_Timeout = null;
	PCJSF_SendRequest_CurrentPacketId = -1;
	var callback = PCJSF_SendRequest_CurrentCallback;
	PCJSF_SendRequest_CurrentCallback = null;
	if(callback)callback(data);
}

function PCJSF_SendRequestTimeout()
{
	PCJSF_SendRequestFinished(null);
}

function PCJSF_CommRes(serialized)
{
	data = PCJSF_DeserializeData(String(serialized));
	if(data["_id"] !== String(PCJSF_SendRequest_CurrentPacketId))return;
	PCJSF_SendRequestFinished(data);
}
var PCJSF_Tracker_VisitorKey = "";
var PCJSF_Tracker_PageKey = "";
var PCJSF_Tracker_LastMouseTime = 0;
var PCJSF_Tracker_LastKeyboardTime = 0;
var PCJSF_Tracker_LastWindowTime = 0;
var PCJSF_Tracker_RealLastWindowSize = null;
var PCJSF_Tracker_RealLastScroll = null;
var PCJSF_Tracker_Mode = -1;

function PCJSF_Tracker_CollectRequestData(connecting, data)
{
	var currentTime = (new Date).getTime();
	var d = data["tracker"] = new Array();
	if(connecting)
	{
		if(PCJSF_Tracker_PageKey == "")d["get_page_key"] = "1";
		d["location"] = String(window.XtDirect_LocationOverride ? window.XtDirect_LocationOverride : PCJSF__Doc.location);
		var token = PCJSF_LSGet("PCJSF_Tracker_Token");
		if(token)d["token"] = token;
		d["referer"] = String(PCJSF__Doc.referrer);
		d["getmode"] = "1";
		var keylist = PCJSF_LSGet("PCJSF_Tracker_Key");
		if(keylist)d["keylist"] = keylist;
	}
	else
	{
		d["key"] = PCJSF_Tracker_VisitorKey;
	}
	d["act"] =
		PCJSF_SafeParseInt(PCJSF_Tracker_LastMouseTime / 1000) + "," +
		PCJSF_SafeParseInt(PCJSF_Tracker_LastKeyboardTime / 1000) + "," +
		PCJSF_SafeParseInt(PCJSF_Tracker_LastWindowTime / 1000);
	d["time"] = String(currentTime);
}

function PCJSF_Tracker_OnValidResponse()
{
	if(PCJSF_Tracker_Mode != 0)
	{
		PCJSF_Processor_RegisterRequest(PCJSF_Tracker_UpdateTimeout);
	}
}

function PCJSF_Tracker_HandleResponseData(connecting, data)
{
	if(connecting)
	{
		if(data["tracker"] !== undefined)
		{
			var trackerInfo = data["tracker"];
			if(trackerInfo["mode"] !== undefined)PCJSF_Tracker_Mode = PCJSF_SafeParseInt(trackerInfo["mode"]);
			if(trackerInfo["result"] !== undefined)
			{
				if(trackerInfo["page_key"] !== undefined)PCJSF_Tracker_PageKey = trackerInfo["page_key"];
				var result = trackerInfo["result"];
				var newKey = trackerInfo["key"];
				if(newKey != null)PCJSF_Tracker_VisitorKey = newKey;
				var newKeylist = trackerInfo["keylist"];
				if(newKeylist != null)PCJSF_LSSet("PCJSF_Tracker_Key", newKeylist);
				if(result == "found")
				{
					PCJSF_Tracker_OnValidResponse();
					return 1;
				}
				if(result == "created")
				{
					if(trackerInfo["token"] !== undefined)PCJSF_LSSet("PCJSF_Tracker_Token", trackerInfo["token"]);
					PCJSF_Tracker_OnValidResponse();
					return 1;
				}
			}
		}
		return 0;
	}
	else
	{
		if(data["tracker"] !== undefined)
		{
			var trackerInfo = data["tracker"];
			if(trackerInfo["mode"] !== undefined)PCJSF_Tracker_Mode = PCJSF_SafeParseInt(trackerInfo["mode"]);
			if(trackerInfo["result"] !== undefined)
			{
				var result = trackerInfo["result"];
				if(result == "found")
				{
					PCJSF_Tracker_OnValidResponse();
					return 1;
				}
			}
		}
		return 0;
	}
}

function PCJSF_Tracker_Cycle()
{
	var currentTime = (new Date).getTime();
	
	var windowSize = PCJSF_GetWindowSize();
	if((windowSize.width != PCJSF_Tracker_RealLastWindowSize.width) || (windowSize.height != PCJSF_Tracker_RealLastWindowSize.height) ||
		(scroll.x != PCJSF_Tracker_RealLastScroll.x) || (scroll.y != PCJSF_Tracker_RealLastScroll.y))
	{
		PCJSF_Tracker_LastWindowTime = currentTime;
		PCJSF_Tracker_RealLastWindowSize = windowSize;
		PCJSF_Tracker_RealLastScroll = scroll;
	}
}

function PCJSF_Tracker_OnMouseMove(ev)
{
	PCJSF_Tracker_LastMouseTime = (new Date).getTime();
}

function PCJSF_Tracker_OnClick(ev)
{
	PCJSF_Tracker_LastMouseTime = (new Date).getTime();
}

function PCJSF_Tracker_OnDblClick(ev)
{
	PCJSF_Tracker_LastMouseTime = (new Date).getTime();
}

function PCJSF_Tracker_OnKey(ev)
{
	PCJSF_Tracker_LastKeyboardTime = (new Date).getTime();
}

var PCJSF_Tracker_CurrentTime = (new Date).getTime();

function PCJSF__InitTracker() {
	PCJSF_Tracker_RealLastWindowSize = PCJSF_GetWindowSize();
	PCJSF_Tracker_RealLastScroll = PCJSF_GetScroll();
	setInterval("PCJSF_Tracker_Cycle()", PCJSF_Tracker_CyclePeriod);

	if (PCJSF__Doc.addEventListener)
	{
		PCJSF__Doc.addEventListener('mousemove', PCJSF_Tracker_OnMouseMove, false); 
		PCJSF__Doc.addEventListener('click', PCJSF_Tracker_OnClick, false); 
		PCJSF__Doc.addEventListener('dblclick', PCJSF_Tracker_OnDblClick, false); 
		PCJSF__Doc.addEventListener('keydown', PCJSF_Tracker_OnKey, false); 
		PCJSF__Doc.addEventListener('keyup', PCJSF_Tracker_OnKey, false); 
	}
	else if (PCJSF__Doc.attachEvent)
	{
		PCJSF__Doc.attachEvent('onmousemove', PCJSF_Tracker_OnMouseMove);
		PCJSF__Doc.attachEvent('onclick', PCJSF_Tracker_OnClick);
		PCJSF__Doc.attachEvent('ondblclick', PCJSF_Tracker_OnDblClick);
		PCJSF__Doc.attachEvent('onkeydown', PCJSF_Tracker_OnKey);
		PCJSF__Doc.attachEvent('onkeyup', PCJSF_Tracker_OnKey);
	}
}

var PCJSF_Chat_Cache = [];
var PCJSF_Chat_LastMessage = [];
var PCJSF_Chat_Areas = [];
var PCJSF_Chat_ShiftDown = 0;
var PCJSF_Chat_LastMessageId = 0;
var PCJSF_Chat_LastAvailableMessage = 0;
var PCJSF_Chat_LastSeenMessage = 0;

function PCJSF_Chat_InitChatArea(chatDiv, containerDiv, messageInput, index)
{
	var area = {};
	area.div = chatDiv;
	area.containerDiv = containerDiv;
	area.input = messageInput;
	area.index = index;	
	area.cache = (PCJSF_Chat_Cache[index] !== undefined) ? (PCJSF_Chat_Cache[index]) : [];
	for(var i = 0; i < area.cache.length; i++)
	{
		var messageNode = area.cache[i];
		if(messageNode.parentNode)messageNode.parentNode.removeChild(messageNode);
		area.div.appendChild(messageNode);
	}
	area.lastMessageId = (PCJSF_Chat_LastMessage[index] !== undefined) ? (parseInt(PCJSF_Chat_LastMessage[index])) : 0;
	area.messages = [];
	area.unreadMessages = 0;
	area.typeStarted = false;
	area.inputHandlerPress = function(ev){ return PCJSF_Chat_MessageKeyPress(ev, index); };
	area.inputHandlerDown = function(ev){ return PCJSF_Chat_MessageKeyDown(ev, index); };
	area.focusHandler = function(ev){ return PCJSF_Chat_OnFocus(ev, index); };
	area.messagesInitialized = false;
	messageInput.onkeypress = area.inputHandlerPress;
	if (messageInput.addEventListener)
	{
		messageInput.addEventListener('keydown', area.inputHandlerDown, false); 
		messageInput.addEventListener('focus', area.focusHandler, false); 
	}
	else if (messageInput.attachEvent)
	{
		messageInput.attachEvent('onkeydown', area.inputHandlerDown);
		messageInput.attachEvent('onfocus', area.focusHandler);
	}
	area.containerDiv.scrollTop = 100000;
	PCJSF_Chat_Areas.push(area);
	PCJSF_Processor_RegisterRequest(0);
	try
	{
		messageInput.focus();
	}
	catch(e)
	{
	}
}

var PCJSF_TempPreventTime = 0;

function PCJSF_TempPrevent()
{
	PCJSF_TempPreventTime = (new Date()).getTime();
}

function PCJSF_PreventDefault(event)
{
	if(!event)event = PCJSF__Win.event;
	if(event.preventDefault)event.preventDefault(); else event.returnValue = false;
	if(event.stopPropagation)event.stopPropagation();
	return false;
}

function PCJSF_StopEvent(event)
{
	if(Math.abs((new Date()).getTime() - PCJSF_TempPreventTime) < 1000)PCJSF_PreventDefault(event);
}

function PCJSF_Chat_DestroyChatArea(index)
{
	for(var i = 0; i < PCJSF_Chat_Areas.length; i++)
	{
		var area = PCJSF_Chat_Areas[i];
		if(area.index == index)
		{
			PCJSF_Chat_Cache[index] = area.cache;
			PCJSF_Chat_LastMessage[index] = area.lastMessageId;
			if (area.input.removeEventListener)
			{
				area.input.removeEventListener('keypress', area.inputHandlerPress, false); 
				area.input.removeEventListener('keydown', area.inputHandlerDown, false); 
				area.input.removeEventListener('focus', area.focusHandler, false); 
			}
			else if (area.input.detachEvent)
			{
				area.input.detachEvent('onkeypress', area.inputHandlerPress);
				area.input.detachEvent('onkeydown', area.inputHandlerDown);
				area.input.detachEvent('onfocus', area.focusHandler);
			}
			PCJSF_Chat_Areas.splice(i, 1);
			break;
		}
	}
}

function PCJSF_Chat_GetArea(index)
{
	for(var i = 0; i < PCJSF_Chat_Areas.length; i++)
	{
		if((PCJSF_Chat_Areas[i].index == index) || (index == -1))return PCJSF_Chat_Areas[i];
	}
	return null;
}

function PCJSF_Chat_CollectRequestData(connecting, data)
{
	for(var i = 0; i < PCJSF_Chat_Areas.length; i++)
	{
		var area = PCJSF_Chat_Areas[i];
		var g = "chat" + area.index;
		var d = data[g] = new Array();
		if(area.lastMessageId > 0)d["last_message"] = String(area.lastMessageId);
		if(area.messages.length > 0)
		{
			var messageList = "";
			for(var j = 0; j < area.messages.length; j++)
			{
				messageList += PCJSF_EscapeParam(area.messages[j]) + ";";
			}
			d["send"] = messageList;
		}
	}
}

function PCJSF_Chat_HandleResponseData(connecting, data)
{
	var currentTime = (new Date).getTime();
	for(var i = 0; i < PCJSF_Chat_Areas.length; i++)
	{
		var area = PCJSF_Chat_Areas[i];
		var messagesInitialized = area.messagesInitialized;
		area.messagesInitialized = true;
		var g = "chat" + area.index;
		if(data[g] !== undefined)
		{
			var messageAppended = 0;
			var newMessages = 0;
			var operatorMessageAppended = false;
			var chatInfo = data[g];
			if(area.lastMessageId == 0)
			{
				PCJSF_ClearChildren(area.div);
			}
			if(chatInfo["received"] !== undefined)
			{
				var received = PCJSF_SafeParseInt(chatInfo["received"]);
				if(received > area.messages.length)received = area.messages.length;
				if(received > 0)area.messages.splice(0, received);
			}
			var typingElement = PCJSF__Doc.getElementById("PCJSF_TypingMessage" + g);
			if(typingElement)typingElement.parentNode.removeChild(typingElement);
			if(chatInfo["messages"] !== undefined)
			{
				var messages = chatInfo["messages"];
				var commaIndex = messages.indexOf(",");
				if(commaIndex >= 0)
				{
					var serverTime = parseFloat(messages.substr(0, commaIndex));
					var colIndex = messages.indexOf(":", commaIndex);
					if(colIndex >= 0)
					{
						var lastMessageId = parseFloat(messages.substr(commaIndex + 1, colIndex - commaIndex - 1));
						var messageList = messages.substr(colIndex + 1).split(";");
						var messageElements = [];
						for(var j = 0; j < messageList.length; j++)
						{
							var message = messageList[j];
							if(message.length > 0)
							{
								var parts = message.split(",");
								if(parts.length != 4)
								{
									return 0;
								}
								var date = new Date();
								var messageText = PCJSF_DecodeParam(parts[2]);
								messageText = PCJSF_Chat_Process_MessageForForm(messageText);
								messageText = messageText.replace(/%SC%/g, ";"); 
								messageText = messageText.replace(/%FormStyle%/g, PCJSF_Chat_FillFormLinkStyle); 
								var time = parseFloat(parts[0]);
								if(time > PCJSF_Chat_LastAvailableMessage)PCJSF_Chat_LastAvailableMessage = time;
								if(time > PCJSF_Chat_LastSeenMessage)newMessages++;
								date.setTime(parseFloat(parts[0]) * 1000 - serverTime + currentTime);
								messageElements.push(PCJSF_SkinObject.BuildMessageElement(PCJSF_PadNumber(date.getHours(), 2) + ":"  + PCJSF_PadNumber(date.getMinutes(), 2) + ":"  + PCJSF_PadNumber(date.getSeconds(), 2), parts, messageText));
								if(!parseInt(parts[3]))operatorMessageAppended = true;
								messageAppended++;
							}
						}
						area.lastMessageId = lastMessageId;
					}
					else return 0;
				}
				else return 0;
			}
			PCJSF_OnMessagesShown();
			if(messageAppended > 0)
			{
				if(PCJSF_Support_PopupState != "opened")
				{
					area.unreadMessages += newMessages;
					PCJSF_SetUnreadMessageCount();
				}
				for(var j = 0; j < messageElements.length; j++)
				{
					area.cache.push(messageElements[j]);
					area.div.appendChild(messageElements[j]);
				}
				area.containerDiv.scrollTop = 100000;
			}
			if(!operatorMessageAppended)
			{
				if(parseInt(chatInfo["lott"]) < 8)
				{
					var typeMessageSpan = PCJSF__Doc.createElement("span");
					typeMessageSpan.setAttribute("style", PCJSF_Chat_TypingMessageStyle);
					typeMessageSpan.setAttribute("id", "PCJSF_TypingMessage" + g);
					typeMessageSpan.appendChild(PCJSF__Doc.createTextNode(PCJSF_Support_TypingMessage));
					area.div.appendChild(typeMessageSpan);
					area.containerDiv.scrollTop = 100000;
				}
			}
			if(operatorMessageAppended && (messagesInitialized || (((new Date).getTime() - PCJSF_Tracker_CurrentTime) > 5000)))
			{
				if((new Date).getTime() - PCJSF_Support_AutoOpenTime < 1000)
				{
					if(PCJSF_Support_SoundAlarmForAutoMessage)PCJSF_Support_PlayNotificationSound();
				}
				else
				{
					if(PCJSF_Support_SoundAlarmForMessage)PCJSF_Support_PlayNotificationSound();
				}
			}
		}
	}
	return 1;
}

function PCJSF_Chat_Process_GetParam(text, to, index, param)
{
	var foundIndex = text.indexOf(param + "=", index);
	if(foundIndex < 0)return "";
	if(foundIndex > to)return "";
	foundIndex += param.length + 1;
	var endIndex = text.indexOf("&", foundIndex);
	var endIndex2 = text.indexOf("'", foundIndex);
	if((endIndex2 > 0) && (endIndex < 0) || (endIndex2 < endIndex))endIndex = endIndex2;
	if(endIndex < 0)return "";
	return decodeURIComponent(text.substr(foundIndex, endIndex - foundIndex));
}

function PCJSF_Chat_Process_MessageForForm(text)
{
	var i = 0;
	while(i < text.length)
	{
		var index = text.indexOf("%FormDialogUrl%", i);
		if(index < 0)break;
		var from = text.lastIndexOf("\"", index);
		var to = text.indexOf("\"", index);
		if((from < 0) || (to < 0))
		{
			i = index + 1;
		}
		else
		{
			var openScript = "javascript:PCJSF_Support_OpenForm('" + PCJSF_Chat_Process_GetParam(text, to, index, "accountId") + "\','" + PCJSF_Chat_Process_GetParam(text, to, index, "formName") + "');";
			text = text.substr(0, from + 1) + openScript + text.substr(to);
			i = from + 1 + openScript.length;
		}
	}
	return text;
}

function PCJSF_GetUnreadMessageCount()
{
	var count = 0;
	for(var i = 0; i < PCJSF_Chat_Areas.length; i++)
	{
		count += PCJSF_Chat_Areas[i].unreadMessages;
	}
	return count;
}

var PCJSF_Chat_UnreadMessageCount = 0;

function PCJSF_SetUnreadMessageCount()
{
	var count = PCJSF_GetUnreadMessageCount();
	if(PCJSF_Chat_UnreadMessageCount == count)return;
	PCJSF_Chat_UnreadMessageCount = count;
	if(PCJSF_SkinObject)PCJSF_SkinObject.SetUnreadMessageCount(PCJSF_GetUnreadMessageCount());
	if(PCJSF_Support_UnreadMessageCountChangedCallback)PCJSF_Support_UnreadMessageCountChangedCallback();
}

function PCJSF_OnMessagesShown()
{
	if(PCJSF_Support_PopupState == "opened")
	{
		if(PCJSF_Chat_LastAvailableMessage > PCJSF_Chat_LastSeenMessage)PCJSF_Chat_LastSeenMessage = PCJSF_Chat_LastAvailableMessage;
		PCJSF_Support_JSSChanged();
		for(var i = 0; i < PCJSF_Chat_Areas.length; i++)
		{
			PCJSF_Chat_Areas[i].unreadMessages = 0;
		}
		PCJSF_SetUnreadMessageCount();
	}
}

var PCJSF_Chat_DownBeforeUp = false;

function PCJSF_Chat_MessageKeyPress(ev, index)
{
	ev = ev || PCJSF__Win.event;
	if(ev.keyCode == 13)
	{
		if(PCJSF_Chat_DownBeforeUp)
		{
			PCJSF_Chat_DownBeforeUp = false;
			return true;
		}
		return false;
	}
	return true;
}

function PCJSF_Chat_MessageKeyDown(ev, index)
{
	ev = ev || PCJSF__Win.event;
	if(ev.keyCode == 13)
	{
		if(PCJSF_Chat_ShiftDown == 0)
		{
			PCJSF_Chat_SendMessage(index);
			return true;
		}
		else PCJSF_Chat_DownBeforeUp = true;
	}
}

function PCJSF_Chat_SendMessage(index)
{
	var area = PCJSF_Chat_GetArea(index);
	var message = PCJSF_Trim(area.input.value);
	if(message == PCJSF_Support_TypeHereText)message = "";
	if(message.length > 0)
	{
		area.messages.push(message);
		PCJSF_Processor_RegisterRequest(0);
		area.input.value = "";
		area.input.focus();
	}
}

function PCJSF_Chat_OnFocus(ev, index)
{
	var area = PCJSF_Chat_GetArea(index);
	if(!area.typeStarted)
	{
		area.input.value = "";
		area.typeStarted = true;
	}
}

function PCJSF_Chat_KeyDown(ev)
{
    ev = ev || PCJSF__Win.event;
    if(ev.keyCode == 16)PCJSF_Chat_ShiftDown = 1;
}

function PCJSF_Chat_KeyUp(ev)
{
    ev = ev || PCJSF__Win.event;
    if(ev.keyCode == 16)
	{
		PCJSF_Chat_ShiftDown = 0;
	}
}

function PCJSF__InitChat() {
	if (PCJSF__Doc.addEventListener)
	{
		PCJSF__Doc.addEventListener('mousedown', PCJSF_StopEvent, false); 
		PCJSF__Doc.addEventListener('mouseup', PCJSF_StopEvent, false); 
		PCJSF__Doc.addEventListener('click', PCJSF_StopEvent, false); 
		PCJSF__Doc.addEventListener('touchstart', PCJSF_StopEvent, false); 
		PCJSF__Doc.addEventListener('touchend', PCJSF_StopEvent, false); 
		PCJSF__Doc.addEventListener('touchcancel', PCJSF_StopEvent, false); 
		PCJSF__Doc.addEventListener('touchmove', PCJSF_StopEvent, false); 
	}
	else if (PCJSF__Doc.attachEvent)
	{
		PCJSF__Doc.attachEvent('onmousedown', PCJSF_StopEvent);
		PCJSF__Doc.attachEvent('onmouseup', PCJSF_StopEvent);
		PCJSF__Doc.attachEvent('onclick', PCJSF_StopEvent);
		PCJSF__Doc.attachEvent('touchend', PCJSF_StopEvent); 
		PCJSF__Doc.attachEvent('touchcancel', PCJSF_StopEvent); 
		PCJSF__Doc.attachEvent('touchmove', PCJSF_StopEvent); 
	}
	
	if (PCJSF__Doc.addEventListener)
	{
		PCJSF__Doc.addEventListener('keydown', PCJSF_Chat_KeyDown, false); 
		PCJSF__Doc.addEventListener('keyup', PCJSF_Chat_KeyUp, false); 
	}
	else if (PCJSF__Doc.attachEvent)
	{
		PCJSF__Doc.attachEvent('onkeydown', PCJSF_Chat_KeyDown); 
		PCJSF__Doc.attachEvent('onkeyup', PCJSF_Chat_KeyUp); 
	}	
}
function PCJSF_Support_GetTitleHTML(allowHide, title, imageId, separatorHeight, imageWidth, imageHeight, imageMIME, showBottomBorder, text)
{
	if(!title)title = "";
	if(!text)text = "";
	return PCJSF_SkinObject.GetTitleHtml(allowHide, title, imageId, separatorHeight, imageWidth, imageHeight, imageMIME, showBottomBorder, text);
}

function PCJSF_Support_SwitchTitleVisible()
{
	var sw = PCJSF__Doc.getElementById("PCJSF_Support_TitleSwitch");
	var title = PCJSF__Doc.getElementById("PCJSF_Support_Title");
	PCJSF_Support_TitleVisible = PCJSF_Support_TitleVisible ? 0 : 1;
	var stateURL = PCJSF_Support_SkinURL;
	if(PCJSF_Support_TitleVisible)
	{
		stateURL += "CollapseTitle.png";
	}
	else
	{
		stateURL += "ExpandTitle.png";
	}
	sw.style.background = "" + PCJSF_Support_SwitchBackground + " url(" + stateURL + ") no-repeat";
	title.style.height = PCJSF_Support_TitleVisible ? "" : "1px";
	title.style.overflow = PCJSF_Support_TitleVisible ? "auto" : "hidden";
	PCJSF_Support_OnSizeOrStructureChanged();
}

function PCJSF_Support_GetChatHTML(text)
{
	return PCJSF_SkinObject.BuildChatHtml(text);
}

function PCJSF_Support_ElementHeight(id)
{
	return PCJSF_SafeParseInt(PCJSF__Doc.getElementById(id).offsetHeight);
}

function PCJSF_Support_UpdateChatHTML(h)
{	
/*	if(h > 90)h -= 90;
	PCJSF__Doc.getElementById("PCJSF_Support_ChatCell").style.height = h + "px";*/
}

function PCJSF_Support_OnSendClicked()
{
	PCJSF_Chat_SendMessage(0);
}

function PCJSF_Support_UpdateChatDiv()
{
/*	if(PCJSF_Support_IsChrome)return;
	var container = PCJSF__Doc.getElementById("PCJSF_Support_ChatContainer");
	var cell = PCJSF__Doc.getElementById("PCJSF_Support_ChatCell");
	if(cell && container)
	{
		var scrollTop = container.scrollTop;
		container.style.display = "none";
		var newWidth = "";
		var newHeight = "";		
		if(PCJSF__Win.getComputedStyle && (!PCJSF_Support_IsSafari) && (!PCJSF_Support_IsIE9))
		{
			var style = PCJSF__Win.getComputedStyle(cell, null);
			newWidth = (PCJSF_SafeParseInt(style.width) - 4) + "px";
			newHeight = PCJSF_SafeParseInt(style.height) + "px";
		}
		else
		{
			newWidth = (PCJSF_SafeParseInt(cell.offsetWidth) - 4) + "px";
			newHeight = PCJSF_SafeParseInt(cell.offsetHeight) + "px";
		}
		if(PCJSF_SafeParseInt(container.style.width) != PCJSF_SafeParseInt(newWidth))container.style.width = newWidth;
		if(PCJSF_SafeParseInt(container.style.height) != PCJSF_SafeParseInt(newHeight))container.style.height = newHeight;
		container.style.display = "block";
		container.scrollTop = scrollTop;
	}*/
}

function getInternetExplorerVersion()
{
	var rv = -1;
	if (navigator.appName == 'Microsoft Internet Explorer')
	{
		var ua = navigator.userAgent;
		var re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
		if (re.exec(ua) != null) rv = parseFloat( RegExp.$1 );
	}
	else if (navigator.appName == 'Netscape')
	{
		var ua = navigator.userAgent;
		var re  = new RegExp("Trident/.*rv:([0-9]{1,}[\.0-9]{0,})");
		if (re.exec(ua) != null) rv = parseFloat( RegExp.$1 );
	}
	return rv;
}

var PCJSF_Support_OffersActive = false;
var PCJSF_Support_OffersId = "";
var PCJSF_Support_OffersLoading = new Array();
var PCJSF_Support_OffersMap = new Array();
var PCJSF_Support_OffersList = new Array();
var PCJSF_Support_OfferIndex = 0;
var PCJSF_Support_OfferOffset = 0;
var PCJSF_Support_LastOfferScript = 0;
var PCJSF__OfferLen;
var PCJSF__OfferSpace;
var PCJSF__OfferVisible;
var PCJSF__OfferIndent;
var PCJSF__OfferBefore;
var PCJSF__OfferAfter;
var PCJSF__LastMove = 0;

function PCJSF_Support_InitOffers(id)
{
	var box = PCJSF__Doc.getElementById("PCJSF_Support_OffersBox");
	var html = "";
	html += "<div id=\"PCJSF_Support_OfferTable\" width=\"100%\" height=\"70px\" style=\"background:" + PCJSF_Support_OffersBackground + ";\">";
	html += "<div style=\"width:12px;height:70px;margin:11px 0px 0px 6px;float:left;aling:left;\">";
	html += PCJSF_BuildButton(12, 47, "display:block;", PCJSF_Support_SkinURL + "OffersLeft.png", null, null, PCJSF_Support_GotoPrevious);
	html += "</div>";
	html += "<div style=\"width:12px;height:70px;margin:11px 6px 0px 0px;float:right;align:right;\">";
	html += PCJSF_BuildButton(12, 47, "display:block;", PCJSF_Support_SkinURL + "OffersRight.png", null, null, PCJSF_Support_GotoNext);
	html += "</div>";
	html += "<div id=\"PCJSF_Support_OfferContainer\" style=\"margin-left:18px;margine-right:18px;position:relative;height:70px;overflow:hidden;\"></div>";
	html += "</div>";
	html += "<table id=\"PCJSF_Support_OfferTable\" width=\"100%\" height=\"70px\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"background:" + PCJSF_Support_OffersBackground + ";\"><tr><td width = \"6px\"></td><td width = \"12px\" valign=\"center\">";	
	box.innerHTML = PCJSF_FixS(html);
	
	PCJSF_Support_OffersId = id;
	if(PCJSF_Support_OffersLoading[id] == undefined)
	{
		PCJSF_Support_OffersLoading[id] = true;
		var url = PCJSF_Processor_ServerURL + "Public/GetOffers.php";
		var scriptContainer = document.getElementById("PCJSF_ScriptContainer");
		var scriptChildElement = document.createElement("script");
		scriptChildElement.setAttribute("src", url + "?id=" + id);
		scriptChildElement.setAttribute("type", 'text/javascript');
		if(PCJSF_Support_LastOfferScript)scriptContainer.removeChild(PCJSF_Support_LastOfferScript); 
		scriptContainer.appendChild(scriptChildElement);
		PCJSF_Support_LastOfferScript = scriptChildElement;
	}
	PCJSF_Support_StartOffers();
	PCJSF_Support_OffersActive = true;
}

function PCJSF_Support_DestroyOffers()
{
	PCJSF_Support_OffersActive = false;
	var box = PCJSF__Doc.getElementById("PCJSF_Support_OffersBox");
	if(box)
	{
		box.innerHTML = "";
	}
}


function PCJSF_Support_GotoPrevious()
{
	if(PCJSF__OfferLen < 2)return;
	PCJSF__LastMove = (new Date()).getTime();
	PCJSF_Support_CalculateLayout();
	PCJSF_Support_OfferIndex = PCJSF_SafeParseInt((PCJSF_Support_OfferIndex + PCJSF__OfferLen - 1) % PCJSF__OfferLen);
	PCJSF_Support_OfferOffset -= 180 + PCJSF__OfferIndent;
	PCJSF_Support_UpdateOfferPositions();
}

function PCJSF_Support_GotoNext()
{
	if(PCJSF__OfferLen < 2)return;
	PCJSF__LastMove = (new Date()).getTime();
	PCJSF_Support_CalculateLayout();
	PCJSF_Support_OfferIndex = PCJSF_SafeParseInt((PCJSF_Support_OfferIndex + 1) % PCJSF__OfferLen);
	PCJSF_Support_OfferOffset += 180 + PCJSF__OfferIndent;
	PCJSF_Support_UpdateOfferPositions();
}

function Promptchat_Support_OffersReceived(id, offers)
{
	offers = PCJSF_Encoding_Decode(offers);
	var offerList = new Array();
	var op = PCJSF_SplitParameters(offers);
	for(var i = 0; i < op.length - 4; i += 5)
	{
		var offer = {};
		offer.title = op[i];
		offer.text = op[i + 1];
		offer.footer = op[i + 2];
		offer.url = op[i + 3];
		offer.img = op[i + 4];
		offerList.push(offer);
	}
	PCJSF_Support_OffersMap[id] = offerList;
	if(id == PCJSF_Support_OffersId)PCJSF_Support_StartOffers();
}

function PCJSF_Support_RandomizeArray(array)
{
	for(var i = 0; i < array.length; i++)
	{
		var ind = Math.floor(array.length * Math.random());
		if(ind >= array.length)ind = array.length - 1;
		if(ind != i)
		{
			var buf = array[ind];
			array[ind] = array[i];
			array[i] = buf;
		}
	}
}

function PCJSF_Support_StartOffers()
{
	PCJSF_Support_OffersList = new Array();
	if(PCJSF_Support_OffersMap[PCJSF_Support_OffersId] == undefined)return;
	var offerList = PCJSF_Support_OffersMap[PCJSF_Support_OffersId];
	var html = "";
	var vis = (PCJSF_Support_PopupState == "opened") ? "visible" : "hidden";
	for(var i = 0; i < offerList.length; i++)
	{
		var offer = offerList[i];
		html += "<div id=\"PCJSF_Support_Offer" + i + "\" style=\"visibility:" + vis + ";position:absolute;top:5px;left:0px;width:180px; height:60px;overflow:hidden;\">";
		html += "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr>";
		if(offer.img.length > 0)
		{
			html += "<td width=\"52px\" height=\"52px\">";
			html += "<a href=\"" + offer.url + "\" target=\"_blank\"><img src=\"" + PCJSF_Processor_ServerURL + "Public/OfferImage.php?id=" + offer.img + "\" width=\"50\" height=\"50\" style=\"border:" + PCJSF_Support_OfferBorder + ";\" /></a>";
			html += "</td><td width=\"4px\"></td>";
		}
		html += "<td><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td>";
		html += "<a href=\"" + offer.url + "\" target=\"_blank\" style=\"text-decoration:" + PCJSF_Support_OfferTitleDecoration + ";\">" + PCJSF_BuildText("span", null, PCJSF_Support_OfferFont, PCJSF_Support_OfferTitleSize, PCJSF_Support_OfferTitleColor, PCJSF_Support_OfferTitleWeight, "normal", offer.title) + "</a>";
		html += "</td></tr><tr><td>";
		html += "<a href=\"" + offer.url + "\" target=\"_blank\" style=\"text-decoration:" + PCJSF_Support_OfferTextDecoration + ";\">" + PCJSF_BuildText("span", null, PCJSF_Support_OfferFont, PCJSF_Support_OfferTextSize, PCJSF_Support_OfferTextColor, PCJSF_Support_OfferTextWeight, "normal", offer.text) + "</a>";
		html += "</td></tr><tr><td>";
		html += "<a href=\"" + offer.url + "\" target=\"_blank\" style=\"text-decoration:" + PCJSF_Support_OfferFooterDecoration + ";\">" + PCJSF_BuildText("span", null, PCJSF_Support_OfferFont, PCJSF_Support_OfferFooterSize, PCJSF_Support_OfferFooterColor, PCJSF_Support_OfferFooterWeight, "normal", offer.footer) + "</a>";
		html += "</td></tr></table></td></tr></table></a></div>";
		PCJSF_Support_OffersList.push(i);
	}
	PCJSF__Doc.getElementById("PCJSF_Support_OfferContainer").innerHTML = PCJSF_FixS(html);
	PCJSF_Support_RandomizeArray(PCJSF_Support_OffersList);
	PCJSF_Support_OfferIndex = 0;
	PCJSF_Support_OfferOffset = 0;
	PCJSF__LastMove = (new Date()).getTime();
	PCJSF_Support_UpdateOfferPositions();
}

function PCJSF_Support_CalculateLayout()
{
	var len = PCJSF_Support_OffersList.length;
	if(len == 0)return;
	var space = PCJSF_SafeParseInt(PCJSF__Doc.getElementById("PCJSF_Support_OfferTable").scrollWidth) - 36;
	var visibleItems = PCJSF_SafeParseInt(space / 200);
	if(visibleItems < 1)visibleItems = 1;
	var indent = PCJSF_SafeParseInt((space - visibleItems * 178) / (visibleItems + 1));
	var before = 0;
	var after = 0;
	if(len > visibleItems)
	{
		before = PCJSF_SafeParseInt((PCJSF_Support_OfferOffset <= 0) ? ((len - visibleItems) / 2) : ((len - visibleItems + 1) / 2));
		after = PCJSF_SafeParseInt((PCJSF_Support_OfferOffset <= 0) ? ((len - visibleItems + 1) / 2) : ((len - visibleItems) / 2));
	}
	PCJSF__OfferLen = len;
	PCJSF__OfferSpace = space;
	PCJSF__OfferVisible = visibleItems;
	PCJSF__OfferIndent = indent;
	PCJSF__OfferBefore = before;
	PCJSF__OfferAfter = after;
}

function PCJSF_Support_UpdateOfferPositions()
{
	if(!PCJSF_Support_OffersActive)return;
	PCJSF_Support_CalculateLayout();
	var i;
	var l = PCJSF__OfferVisible + PCJSF__OfferAfter;
	if(l + PCJSF__OfferBefore > PCJSF__OfferLen)l = PCJSF__OfferLen - PCJSF__OfferBefore;
	for(i = -PCJSF__OfferBefore; i < l; i++)
	{
		var index = (PCJSF_Support_OfferIndex + PCJSF__OfferLen + i) % PCJSF__OfferLen;
		var divObj = PCJSF__Doc.getElementById("PCJSF_Support_Offer" + PCJSF_Support_OffersList[index]);
		divObj.style.left = ((PCJSF__OfferIndent * (i + 1) + i * 180) + PCJSF_Support_OfferOffset) + "px";
	}
}

function PCJSF_Support_SetVisible(visible)
{
	if(!PCJSF_Support_OffersActive)return;
	for(var i = 0;i < PCJSF_Support_OffersList.length; i++)
	{
		PCJSF__Doc.getElementById("PCJSF_Support_Offer" + i).style.visibility = visible ? "visible" : "hidden";
	}
}

function PCJSF_Support_MoveOffers()
{
	if(!PCJSF_Support_OffersActive)return;
	var currentTime = (new Date()).getTime();
	if(currentTime - PCJSF__LastMove > PCJSF_Support_OfferAutoMovePeriod)
	{
		PCJSF_Support_GotoNext();
	}
	if(PCJSF_Support_OfferOffset == 0)return;
	if(Math.abs(PCJSF_Support_OfferOffset) < 2)
	{
		PCJSF_Support_OfferOffset = 0;
	}
	else
	{
		PCJSF_Support_OfferOffset = PCJSF_SafeParseInt(PCJSF_Support_OfferOffset * 0.7);
	}
	PCJSF_Support_UpdateOfferPositions();
}

setInterval("PCJSF_Support_MoveOffers()", PCJSF_Support_OfferAnimPeriod);

var PCJSF_Support_Loading_DotCount = 0;
var PCJSF_Support_Loading_Timeout;

function PCJSF_Support_Loading_Activate()
{
	PCJSF_Support_ContainerDiv.innerHTML = PCJSF_FixS(
		"<table width=\"100%\" height=\"100%\"><tr><td id=\"PCJSF_Support_Loading_P\" style=\"font-size:20px;color:#cccccc;text-align:center;vertical-align:middle;\">" +
		 "</td></tr></table>");
	PCJSF_Support_Loading_Timeout = setInterval("PCJSF_Support_Loading_Update();", 300);
	PCJSF_Support_Loading_Update();
	PCJSF_DisableSelectionById("PCJSF_Support_Loading_P", "default");
}

function PCJSF_Support_Loading_Deactivate()
{
	clearInterval(PCJSF_Support_Loading_Timeout);
	PCJSF_ClearChildren(PCJSF_Support_ContainerDiv);
}

function PCJSF_Support_Loading_Update()
{
	PCJSF_Support_Loading_DotCount = (PCJSF_Support_Loading_DotCount + 1) % 10;
	var txt = PCJSF_Support_TxtLoading + "<br />";
	for(var i = 0; i <= PCJSF_Support_Loading_DotCount; i++)txt += ".";
	PCJSF__Doc.getElementById("PCJSF_Support_Loading_P").innerHTML = txt;
}
var PCJSF_Support_WFV_HasChat = false;

function PCJSF_Support_WFV_InputStyle()
{
	return 	"border:" + PCJSF_Support_InputBorder +
			";background:" + PCJSF_Support_TypeBackground +
			";font-family:" + PCJSF_Support_Font +
			";font-size:" + PCJSF_Support_TypeSize +
			";color:" + PCJSF_Support_TypeColor +
			";font-weight:" + PCJSF_Support_TypeWeight + ";";
}

function PCJSF_Support_WFV_Activate()
{
	PCJSF_Support_WFV_HasChat = false;
	var title = PCJSF_Support_OperatorAvailable ? PCJSF_Support_WFV_TitleHTML : PCJSF_Support_WFV_NATitleHTML;
	var text = PCJSF_Support_OperatorAvailable ? PCJSF_Support_WFV_InviteTextHTML : PCJSF_Support_WFV_NATextHTML;
	var hasText = (text.length > 0) && PCJSF_SkinObject.IsTitleTextAllowed();
	var hasStartChat = (PCJSF_Support_OperatorAvailable && !PCJSF_Support_AllowChatInWFV);
	var hasLeaveAMessage = (PCJSF_Support_AllowLeaveAMessage && (!PCJSF_Support_OperatorAvailable || PCJSF_Support_AllowLeaveAMessageOpAv));
	var hasTextPanel = (hasText || hasStartChat || hasLeaveAMessage);
	var html = "";
	var bottomOffset = 0;
	if(PCJSF_Support_WFV_ShowOffers && PCJSF_SkinObject.AreOffersAllowed())
	{
		html += "<div id=\"PCJSF_Support_OffersBox\" style=\"position:absolute;width:100%;height:70px;bottom:0px;\"></div>";
		html += "<div style=\"position:absolute;width:100%;height:" + PCJSF_Support_InnerBorderWidth + ";bottom:70px;background:" + PCJSF_Support_InnerBorderColor + ";\"></div>";
		bottomOffset += 70 + PCJSF_SafeParseInt(PCJSF_Support_InnerBorderWidth);
	}
	html += "<div style=\"position:absolute;width:100%;top:0px;bottom:" + bottomOffset + "px;overflow:hidden;\">";
	html += "<div style=\"display:table;width:100%;height:100%;\">";
	html += "<div style=\"display:table-row;\"><div style=\"display:table-cell;background:" + PCJSF_Support_TitleBackground + ";vertical-align:top;\">";
	html += PCJSF_Support_GetTitleHTML(PCJSF_Support_WFV_AllowHideTitle, title, "picture_wfv", PCJSF_Support_InnerBorderWidth, PCJSF_Support_WFV_ImageWidth, PCJSF_Support_WFV_ImageHeight, PCJSF_Support_WFV_ImageMIME, hasTextPanel, text);
	if(hasTextPanel)
	{
		html += "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td colspan=\"2\" height=\"7px\"></td></tr><tr><td width=\"12px\"></td><td>";
		if(hasText)
		{
			html += PCJSF_BuildText("span", null, PCJSF_Support_Font, PCJSF_Support_MainTextSize, PCJSF_Support_MainTextColor, "bold", "normal", text);
			if(hasStartChat || hasLeaveAMessage)html += "<br /><br />";
		}
		if(hasStartChat)
		{
			if(PCJSF_Support_AskForEMail)
			{
				html += PCJSF_BuildText("span", null, PCJSF_Support_Font, PCJSF_Support_MainTextSize, PCJSF_Support_MainTextColor, "bold", "normal", PCJSF_Support_WFV_EMailCaption);
				html += "<input id=\"PCJSF_Support_WFV_EMail\" type=\"text\" style = \"width:100%;height:" + PCJSF_Support_InputHeight + ";" + PCJSF_Support_WFV_InputStyle() + "\"/><br /><br />";
			}
			html += PCJSF_BuildTextButton(PCJSF_Support_WFV_StartChatButtonText, PCJSF_Support_WFV_StartChat) + "<div style=\"width:10px;height:20px;float:left;\"></div>";
		}
		if(hasLeaveAMessage)
		{
			html += PCJSF_BuildTextButton(PCJSF_Support_WFV_LeaveAMessageButtonText, PCJSF_Support_WFV_LeaveAMessage);
		}
		html += "</td><td width=\"12px\"></td></tr><tr><td colspan=\"2\" height=\"7px\"></td></tr></table>";
	}
	html += "</div></div>";
	if(PCJSF_Support_AllowChatInWFV && (PCJSF_Support_OperatorAvailable || PCJSF_Support_AllowChatInWFVWO))
	{
		html += "<div style=\"display:table-row;height:100%;\"><div id=\"PCJSF_Support_IEContainerCell\" style=\"display:table-cell;vertical-align:top;\">";
		html += PCJSF_Support_GetChatHTML(text);
		html += "</div></div>";
	}
	html += "</div></div>";
	PCJSF_Support_ContainerDiv.innerHTML = PCJSF_FixS(html);
	PCJSF_DisableSelectionById("PCJSF_Support_Title_Text", "default");
	if(PCJSF_Support_AllowChatInWFV && (PCJSF_Support_OperatorAvailable || PCJSF_Support_AllowChatInWFVWO))
	{
		PCJSF_Chat_InitChatArea(PCJSF__Doc.getElementById("PCJSF_Support_ChatDiv"), PCJSF__Doc.getElementById("PCJSF_Support_ChatContainer"), PCJSF__Doc.getElementById("PCJSF_Support_ChatInput"), 0);
		PCJSF_Support_WFV_HasChat = true;
	}
	if(PCJSF_Support_WFV_ShowOffers && PCJSF_SkinObject.AreOffersAllowed())PCJSF_Support_InitOffers(PCJSF_Support_OffersId);
}

function PCJSF_Support_WFV_StartChat()
{
	var emailInput = PCJSF__Doc.getElementById("PCJSF_Support_WFV_EMail");
	if(emailInput)
	{
		var email = emailInput.value;
		if((email.indexOf(".") > 2) && (email.indexOf("@") > 0))
		{
			PCJSF_Support_WFV_EMail = email;
		}
		else
		{
			alert(PCJSF_Support_WFV_InvalidEMail);
			return;
		}
	}
	PCJSF_Support_Commands.push("wfv_start_chat");
	PCJSF_Processor_RegisterRequest(0);
}

function PCJSF_Support_WFV_LeaveAMessage()
{
	PCJSF_Support_Commands.push("wfv_leave_a_message");
	PCJSF_Processor_RegisterRequest(0);
}

function PCJSF_Support_WFV_Deactivate()
{
	PCJSF_Support_DestroyOffers();
	if(PCJSF_Support_WFV_HasChat)
	{
		PCJSF_Chat_DestroyChatArea(0);
	}
	PCJSF_ClearChildren(PCJSF_Support_ContainerDiv);
}

var PCJSF_Support_WFO_HasChat = false;

function PCJSF_Support_WFO_Activate()
{
	PCJSF_Support_WFO_HasChat = false;
	
	var title = PCJSF_Support_OperatorAvailable ? PCJSF_Support_WFO_TitleHTML : PCJSF_Support_WFO_NATitleHTML;
	var text = PCJSF_Support_OperatorAvailable ? PCJSF_Support_WFO_WaitTextHTML : PCJSF_Support_WFO_NATextHTML;
	var hasText = (text.length > 0) && PCJSF_SkinObject.IsTitleTextAllowed();
	var hasLeaveAMessage = (PCJSF_Support_AllowLeaveAMessage && (!PCJSF_Support_OperatorAvailable || PCJSF_Support_AllowLeaveAMessageOpAv));
	var hasTextPanel = (hasText || hasLeaveAMessage);
	var html = "";
	var bottomOffset = 0;
	if(PCJSF_Support_WFO_ShowOffers && PCJSF_SkinObject.AreOffersAllowed())
	{
		html += "<div id=\"PCJSF_Support_OffersBox\" style=\"position:absolute;width:100%;height:70px;bottom:0px;\"></div>";
		html += "<div style=\"position:absolute;width:100%;height:" + PCJSF_Support_InnerBorderWidth + ";bottom:70px;background:" + PCJSF_Support_InnerBorderColor + ";\"></div>";
		bottomOffset += 70 + PCJSF_SafeParseInt(PCJSF_Support_InnerBorderWidth);
	}
	html += "<div style=\"position:absolute;width:100%;top:0px;bottom:" + bottomOffset + "px;overflow:hidden;\">";
	html += "<div style=\"display:table;width:100%;height:100%;\">";
	html += "<div style=\"display:table-row;\"><div style=\"display:table-cell;background:" + PCJSF_Support_TitleBackground + ";vertical-align:top;\">";
	html += PCJSF_Support_GetTitleHTML(PCJSF_Support_WFO_AllowHideTitle, title, "picture_wfo", PCJSF_Support_InnerBorderWidth, PCJSF_Support_WFO_ImageWidth, PCJSF_Support_WFO_ImageHeight, PCJSF_Support_WFO_ImageMIME, hasTextPanel, text);
	if(hasTextPanel)
	{
		html += "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td colspan=\"2\" height=\"7px\"></td></tr><tr><td width=\"12px\"></td><td>";
		if(hasText)
		{
			html += PCJSF_BuildText("span", null, PCJSF_Support_Font, PCJSF_Support_MainTextSize, PCJSF_Support_MainTextColor, "bold", "normal", text);
			if(hasLeaveAMessage)html += "<br /><br />";
		}
		if(hasLeaveAMessage)
		{
			html += PCJSF_BuildTextButton(PCJSF_Support_WFO_LeaveAMessageButtonText, PCJSF_Support_WFO_LeaveAMessage);
		}
		html += "</td><td width=\"12px\"></td></tr><tr><td colspan=\"2\" height=\"7px\"></td></tr></table>";
	}
	html += "</div></div>";
	if(PCJSF_Support_AllowChatInWFO && (PCJSF_Support_OperatorAvailable || PCJSF_Support_AllowChatInWFOWO))
	{
		html += "<div style=\"display:table-row;height:100%;\"><div id=\"PCJSF_Support_IEContainerCell\" style=\"display:table-cell;vertical-align:top;\">";
		html += PCJSF_Support_GetChatHTML(text);
		html += "</div></div>";
	}
	html += "</div></div>";
	PCJSF_Support_ContainerDiv.innerHTML = PCJSF_FixS(html);
	PCJSF_DisableSelectionById("PCJSF_Support_Title_Text", "default");
	if(PCJSF_Support_AllowChatInWFO && (PCJSF_Support_OperatorAvailable || PCJSF_Support_AllowChatInWFOWO))
	{
		PCJSF_Chat_InitChatArea(PCJSF__Doc.getElementById("PCJSF_Support_ChatDiv"), PCJSF__Doc.getElementById("PCJSF_Support_ChatContainer"), PCJSF__Doc.getElementById("PCJSF_Support_ChatInput"), 0);
		PCJSF_Support_WFO_HasChat = true;
	}
	if(PCJSF_Support_WFO_ShowOffers && PCJSF_SkinObject.AreOffersAllowed())PCJSF_Support_InitOffers(PCJSF_Support_OffersId);
}

function PCJSF_Support_WFO_LeaveAMessage()
{
	PCJSF_Support_Commands.push("wfo_leave_a_message");
	PCJSF_Processor_RegisterRequest(0);
}

function PCJSF_Support_WFO_Deactivate()
{
	PCJSF_Support_DestroyOffers();
	if(PCJSF_Support_WFO_HasChat)
	{
		PCJSF_Chat_DestroyChatArea(0);
	}
	PCJSF_ClearChildren(PCJSF_Support_ContainerDiv);
}

function PCJSF_Support_SES_Activate()
{
	PCJSF_Support_WFO_HasChat = false;
	var text = PCJSF_Support_SES_MainText;
	var hasText = (text.length > 0) && PCJSF_SkinObject.IsTitleTextAllowed();
	var hasEMail = PCJSF_Support_AllowTranscriptEMail;
	var hasTextPanel = (hasText || hasEMail);
	var html = "";
	var bottomOffset = 0;
	if(PCJSF_Support_SES_ShowOffers && PCJSF_SkinObject.AreOffersAllowed())
	{
		html += "<div id=\"PCJSF_Support_OffersBox\" style=\"position:absolute;width:100%;height:70px;bottom:0px;\"></div>";
		html += "<div style=\"position:absolute;width:100%;height:" + PCJSF_Support_InnerBorderWidth + ";bottom:70px;background:" + PCJSF_Support_InnerBorderColor + ";\"></div>";
		bottomOffset += 70 + PCJSF_SafeParseInt(PCJSF_Support_InnerBorderWidth);
	}
	html += "<div style=\"position:absolute;width:100%;top:0px;bottom:" + bottomOffset + "px;overflow:hidden;\">";
	html += "<div style=\"display:table;width:100%;height:100%;\">";
	html += "<div style=\"display:table-row;\"><div style=\"display:table-cell;background:" + PCJSF_Support_TitleBackground + ";vertical-align:top;\">";
	html += PCJSF_Support_GetTitleHTML(PCJSF_Support_SES_AllowHideTitle, PCJSF_Support_SES_TitleHTML, "picture_ses", hasTextPanel ? PCJSF_Support_InnerBorderWidth : 0, PCJSF_Support_SES_ImageWidth, PCJSF_Support_SES_ImageHeight, PCJSF_Support_SES_ImageMIME, true, text);
	if(hasTextPanel)
	{
		html += "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td colspan=\"2\" height=\"7px\"></td></tr><tr><td width=\"12px\"></td><td>";
		if(hasText)
		{
			html += PCJSF_BuildText("span", null, PCJSF_Support_Font, PCJSF_Support_MainTextSize, PCJSF_Support_MainTextColor, "bold", "normal", text);
			if(hasEMail)html += "<br /><br />";
		}
		if(hasEMail)
		{
			var val = PCJSF_Support_SES_EMail;
			val = val.replace("\"", "\\\"");
			if(PCJSF_SkinObject.GetSessionSetEMailHTML)html += PCJSF_SkinObject.GetSessionSetEMailHTML(val);
			else
			{
				html += "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr>";
				html += "<td width=\"100%\" style=\"vertical-alignment:top\"><input id=\"PCJSF_Support_SES_EMail\" type=\"email\" style = \"width:100%;height:" + PCJSF_Support_InputHeight + ";" + PCJSF_Support_WFV_InputStyle() + "\" value=\"" + ((val != "") ? val : PCJSF_Support_SES_SetEMailLabel) + "\" onfocus=\"if(this.value=='" + PCJSF_Support_SES_SetEMailLabel + "')this.value='';\" onblur=\"if(PCJSF_IntWin.PCJSF_Trim(this.value)=='')this.value='" + PCJSF_Support_SES_SetEMailLabel + "';\" /></td>";
				html += "<td>&nbsp;&nbsp;</td>";
				html += "<td>" + PCJSF_BuildTextButton(PCJSF_Support_SES_SetEMailButtonText.replace(" ", "&nbsp;"), PCJSF_Support_SES_SetEMail) + "</td>";
				html += "</tr></table>";
			}
		}
		html += "</td><td width=\"12px\"></td></tr><tr><td colspan=\"2\" height=\"7px\"></td></tr></table>";
	}	
	html += "</div></div>";
	html += "<div style=\"display:table-row;height:100%;\"><div id=\"PCJSF_Support_IEContainerCell\" style=\"display:table-cell;vertical-align:top;\">";
	html += PCJSF_Support_GetChatHTML(PCJSF_Support_SES_MainText);
	html += "</div></div>";
	html += "</div></div>";
	PCJSF_Support_ContainerDiv.innerHTML = PCJSF_FixS(html);
	PCJSF_DisableSelectionById("PCJSF_Support_Title_Text", "default");
	PCJSF_Chat_InitChatArea(PCJSF__Doc.getElementById("PCJSF_Support_ChatDiv"), PCJSF__Doc.getElementById("PCJSF_Support_ChatContainer"), PCJSF__Doc.getElementById("PCJSF_Support_ChatInput"), 0);
	if(PCJSF_Support_SES_ShowOffers && PCJSF_SkinObject.AreOffersAllowed())PCJSF_Support_InitOffers(PCJSF_Support_OffersId);
}

function PCJSF_Support_SES_SetEMail()
{
	var email = PCJSF__Doc.getElementById("PCJSF_Support_SES_EMail").value;
	if(email == PCJSF_Support_SES_SetEMailLabel)email = "";
	email = PCJSF_Trim(email);
	if(!PCJSF_IsValidEMail(email)){ alert(PCJSF_Support_SES_EMailInvalidText); return; }
	PCJSF_Support_SES_EMail = email;
	PCJSF_Support_Commands.push("ses_set_email");
	PCJSF_Processor_RegisterRequest(0);
	alert(PCJSF_Support_SES_EMailSetConfirmationText);
}

function PCJSF_Support_SES_Deactivate()
{
	PCJSF_Support_DestroyOffers();
	PCJSF_Chat_DestroyChatArea(0);
	PCJSF_ClearChildren(PCJSF_Support_ContainerDiv);
}

function PCJSF_Support_LAM_InputStyle()
{
	return 	"border:" + PCJSF_Support_InputBorder +
			";background:" + PCJSF_Support_TypeBackground +
			";font-family:" + PCJSF_Support_Font +
			";font-size:" + PCJSF_Support_TypeSize +
			";color:" + PCJSF_Support_TypeColor +
			";font-weight:" + PCJSF_Support_TypeWeight + ";";
}

function PCJSF_Support_LAM_Activate()
{
	var pagePadding = PCJSF_SkinObject.GetPagePadding();
	var html = "";
	html += "<div id=\"PCJSF_lamt\" style=\"width:100%;height:100%;overflow:auto;\">";
	html += "<table width=\"100%\" height=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"background:" + PCJSF_Support_TitleBackground + ";\"><tr><td id=\"PCJSF_lamh\" height=\"10px\" valign=\"top\">";
	html += PCJSF_Support_GetTitleHTML(PCJSF_Support_LAM_AllowHideTitle, PCJSF_Support_LAM_TitleHTML, "picture_lam", PCJSF_Support_InnerBorderWidth, PCJSF_Support_LAM_ImageWidth, PCJSF_Support_LAM_ImageHeight, PCJSF_Support_LAM_ImageMIME, true, "");
	html +=
		"<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td colspan=\"2\" height=\"7px\"></td></tr><tr><td width=\"" + pagePadding + "px\"></td><td colspan=\"2\">" +
		PCJSF_BuildText(
			"span", null,
			PCJSF_Support_Font, PCJSF_Support_MainTextSize, PCJSF_Support_MainTextColor, "bold", "normal", PCJSF_Support_LAM_TextHTML) +
		"<br /><br />";
	html += PCJSF_BuildTextButton(PCJSF_Support_LAM_BackButtonText, PCJSF_Support_LAM_GoBack) + "&nbsp;";
	html += "</td><td width=\"" + pagePadding + "px\"></td></tr>";
	html += "<tr><td colspan=\"4\" height=\"7px\"></td></tr>";
	html += "<tr><td width=\"" + pagePadding + "px\"></td><td colspan=\"2\">";
	html += PCJSF_BuildText("span", null, PCJSF_Support_Font, PCJSF_Support_MainTextSize, PCJSF_Support_MainTextColor, "bold", "normal", PCJSF_Support_LAM_EMailLabelText);
	html += "<td width=\"" + pagePadding + "px\"></td></td></tr>";
	html += "<tr><td width=\"" + pagePadding + "px\"></td><td colspan=\"2\"><input id=\"PCJSF_Support_LAM_EMail\" type=\"email\" style = \"width:100%;height:" + PCJSF_Support_InputHeight + ";" + PCJSF_Support_LAM_InputStyle() + "\"/></td><td width=\"" + pagePadding + "px\"></td></tr>";
	html += "<tr><td colspan=\"4\" height=\"7px\"></td></tr>";
	html += "<tr><td width=\"" + pagePadding + "px\"></td><td colspan=\"2\">";
	html += PCJSF_BuildText("span", null, PCJSF_Support_Font, PCJSF_Support_MainTextSize, PCJSF_Support_MainTextColor, "bold", "normal", PCJSF_Support_LAM_NameLabelText);
	html += "<td width=\"" + pagePadding + "px\"></td></td></tr>";
	html += "<tr><td width=\"" + pagePadding + "px\"></td><td colspan=\"2\"><input id=\"PCJSF_Support_LAM_Name\" type=\"text\" style = \"width:100%;height:" + PCJSF_Support_InputHeight + ";" + PCJSF_Support_LAM_InputStyle() + "\"/></td><td width=\"" + pagePadding + "px\"></td></tr>";
	html += "<tr><td colspan=\"4\" height=\"7px\"></td></tr>";
	html += "<tr><td width=\"" + pagePadding + "px\"></td><td colspan = \"2\">";
	html += PCJSF_BuildText("span", null, PCJSF_Support_Font, PCJSF_Support_MainTextSize, PCJSF_Support_MainTextColor, "bold", "normal", PCJSF_Support_LAM_MessageLabelText);
	html += "</td><td width=\"" + pagePadding + "px\"></td></tr>";
	html += "<tr><td width=\"" + pagePadding + "px\"></td><td colspan = \"2\"><textarea id=\"PCJSF_Support_LAM_Message\" style=\"width:100%;height:50px;" + PCJSF_Support_LAM_InputStyle() + "\"></textarea><td width=\"" + pagePadding + "px\"></td></tr>";
	html += "<tr><td colspan=\"4\" height=\"7px\"></td></tr>";
	html += "<tr><td width=\"" + pagePadding + "px\"></td><td colspan = \"2\">";
	html += PCJSF_BuildTextButton(PCJSF_Support_LAM_SendButtonText, PCJSF_Support_LAM_Send) + "&nbsp;";
	html += "</td><td width=\"" + pagePadding + "px\"></td></tr>";
	html += "</table>";
	var add = "";
	html += "</td></tr><tr><td" + add + ">&nbsp;";
	if(PCJSF_Support_LAM_ShowOffers)
	{
		html += "</td></tr><tr><td height=\"7px\" style=\"font-size:4px;\">";
		html += "	<div style=\"width:100%;height:7px;background:" + PCJSF_Support_InnerBorderColor + ";\"></div>";
		html += "</td></tr><tr><td height=\"70px\"><div id=\"PCJSF_Support_OffersBox\" style=\"width:100%;height:70px;\"></div>";
	}
	html += "</td></tr></table>";
	PCJSF_Support_ContainerDiv.innerHTML = PCJSF_FixS(html);
	PCJSF_DisableSelectionById("PCJSF_Support_Title_Text", "default");
	if(PCJSF_Support_LAM_ShowOffers)PCJSF_Support_InitOffers(PCJSF_Support_OffersId);
}

function PCJSF_Support_LAM_GoBack()
{
	PCJSF_Support_Commands.push("lam_go_back");
	PCJSF_Processor_RegisterRequest(0);
}

function PCJSF_Support_LAM_Send()
{
	PCJSF_Support_LAM_EMail = PCJSF__Doc.getElementById("PCJSF_Support_LAM_EMail").value;
	PCJSF_Support_LAM_Name = PCJSF__Doc.getElementById("PCJSF_Support_LAM_Name").value;
	PCJSF_Support_LAM_Message = PCJSF__Doc.getElementById("PCJSF_Support_LAM_Message").value;
	PCJSF_Support_Commands.push("lam_leave_a_message");
	PCJSF_Processor_RegisterRequest(0);	
}

function PCJSF_Support_LAM_Deactivate()
{
	PCJSF_Support_DestroyOffers();
	PCJSF_ClearChildren(PCJSF_Support_ContainerDiv);
}

	var PCJSF_Support_Form_AccountId = 0;
var PCJSF_Support_Form_Name = "";
var PCJSF_Support_Form_Id = "";
var PCJSF_Support_Form_Map = {};
var PCJSF_Support_Form_Active = false;
var PCJSF_Support_Form_SentMessage = "";

function PCJSF_Support_Form_InputStyle()
{
	return 	"border:" + PCJSF_Support_InputBorder +
			";background:" + PCJSF_Support_TypeBackground +
			";font-family:" + PCJSF_Support_Font +
			";font-size:" + PCJSF_Support_TypeSize +
			";color:" + PCJSF_Support_TypeColor +
			";font-weight:" + PCJSF_Support_TypeWeight + ";";
}

function PCJSF_Support_Form_Activate()
{
	PCJSF_Support_Form_Active = true;
	PCJSF_Support_Form_Id = PCJSF_Support_Form_AccountId + "_" + PCJSF_Support_Form_Name;
	var formInfo = PCJSF_Support_Form_Map[PCJSF_Support_Form_Id];
	if(formInfo)
	{
		PCJSF_Support_Form_Loaded();
		return;
	}
	var scriptContainer = document.getElementById("PCJSF_ScriptContainer");
	var scriptChildElement = document.createElement("script");
	scriptChildElement.setAttribute("src", PCJSF_Processor_ServerURL + "Public/LoadForm.php?accountId=" + encodeURIComponent(PCJSF_Support_Form_AccountId) + "&formName=" + encodeURIComponent(PCJSF_Support_Form_Name) + "&method=PCJSF_Support_Form_OnLoaded");
	scriptChildElement.setAttribute("type", 'text/javascript');
	scriptContainer.appendChild(scriptChildElement); 
	var html = "<table width=\"100%\" height=\"100%\"><tr><td align=\"center\" valign=\"middle\">" +
		PCJSF_BuildText(
			"span", "PCJSF_Support_Loading_P",
			PCJSF_Support_Font, PCJSF_Support_LargeTextSize, PCJSF_Support_LoadingColor, "bold", "normal",
			PCJSF_Support_TxtLoading) +
		 "</td></tr></table>";
	PCJSF_Support_ContainerDiv.innerHTML = PCJSF_FixS(html);
}

function PCJSF_Support_Form_Loaded()
{
	if(!PCJSF_Support_Form_Active)return;
	var formInfo = PCJSF_Support_Form_Map[PCJSF_Support_Form_Id];
	if(!formInfo)return;
	var pagePadding = PCJSF_SkinObject.GetPagePadding();
	var html = "";
	html += "<div style=\"width:100%;height:100%;position:relative\"><div id=\"PCJSF_lamt\" style=\"position:absolute;top:0px;left:0px;width:100%;height:100%;overflow:auto;\">";
	html += "<table width=\"100%\" height=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"background:" + PCJSF_Support_TitleBackground + ";\"><tr><td id=\"PCJSF_lamh\" height=\"10px\" style=\"vertical-align:top\">";
	html +=
		"<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td colspan=\"2\" height=\"7px\"></td></tr><tr><td width=\"" + pagePadding + "px\"></td><td colspan=\"2\">" +
		PCJSF_BuildText(
			"span", null,
			PCJSF_Support_Font, PCJSF_Support_TitleTextSize, PCJSF_Support_TitleColor, PCJSF_Support_TitleWeight, "normal", formInfo.title) + "<br />" +
		PCJSF_BuildText(
			"span", null,
			PCJSF_Support_Font, PCJSF_Support_MainTextSize, PCJSF_Support_MainTextColor, "bold", "normal", formInfo.intro) +
		"<br /><br />";
	html += PCJSF_BuildTextButton(PCJSF_Support_Common_BackButtonText, PCJSF_Support_Form_GoBack) + "&nbsp;";
	html += "</td><td width=\"" + pagePadding + "px\"></td></tr>";
	for(var i = 0; i < formInfo.fields.length; i++)
	{
		var field = formInfo.fields[i];
		html += "<tr><td colspan=\"4\" height=\"7px\"></td></tr>";
		html += "<tr><td width=\"" + pagePadding + "px\"></td><td colspan=\"2\">";
		html += PCJSF_BuildText("span", null, PCJSF_Support_Font, PCJSF_Support_MainTextSize, PCJSF_Support_MainTextColor, "bold", "normal", field.label);
		html += "<td width=\"" + pagePadding + "px\"></td></td></tr>";
		html += "<tr><td width=\"" + pagePadding + "px\"></td><td colspan=\"2\">";
		var type = field.type;
		if(type == "SingleLineText")
		{
			html += "<input id=\"PCJSF_Support_Form_Item" + i + "\" type=\"text\" style=\"width:100%;height:" + PCJSF_Support_InputHeight + ";" + PCJSF_Support_Form_InputStyle() + "\" />";
		}
		else if(type == "MultiLineText")
		{
			html += "<textarea id=\"PCJSF_Support_Form_Item" + i + "\" type=\"text\" style=\"width:100%;height:60px;" + PCJSF_Support_Form_InputStyle() + "\"></textarea>";
		}
		else if(type == "EMail")
		{
			html += "<input id=\"PCJSF_Support_Form_Item" + i + "\" type=\"email\" style=\"width:100%;height:" + PCJSF_Support_InputHeight + ";" + PCJSF_Support_Form_InputStyle() + "\" />";
		}
		else if(type == "Url")
		{
			html += "<input id=\"PCJSF_Support_Form_Item" + i + "\" type=\"text\" style=\"width:100%;height:" + PCJSF_Support_InputHeight + ";" + PCJSF_Support_Form_InputStyle() + "\" />";
		}
		else if(type == "Checkbox")
		{
			html += "<input id=\"PCJSF_Support_Form_Item" + i + "\" type=\"checkbox\" style=\"" + PCJSF_Support_Form_InputStyle() + "\" />";
		}
		else if(type == "DropDown")
		{
			html += "<select id=\"PCJSF_Support_Form_Item" + i + "\" style=\"" + PCJSF_Support_Form_InputStyle() + "\" />";
			var options = field.options.split(",");
			for(var j = 0; j < options.length; j++)
			{
				var option = PCJSF_Trim(options[j]);
				if(option.length > 0)
				{
					html += "<option value=\"" + option + "\">" + option + "</option>";
				}
			}
			html += "</select> ";
		}
		html += "</td><td width=\"" + pagePadding + "px\"></td></tr>";
		
	}
	html += "<tr><td colspan=\"4\" height=\"7px\"></td></tr>";
	html += "<tr><td width=\"" + pagePadding + "px\"></td><td colspan=\"2\">";
	html += PCJSF_BuildTextButton(formInfo.sendLabel, PCJSF_Support_Form_Send) + "&nbsp;";
	html += "</td><td width=\"" + pagePadding + "px\"></td></tr>";
	html += "</table>";
	var add = "";
	html += "</td></tr><tr><td" + add + ">&nbsp;";
	html += "</td></tr></table>";
	html += "</div></div>";
	setTimeout(function(){PCJSF_Support_ContainerDiv.innerHTML = PCJSF_FixS(html);}, 10);
	PCJSF_Support_Form_SentMessage = formInfo.sentText;
}

function PCJSF_Support_Form_Send()
{
	if(!PCJSF_Support_Form_Active)return;
	var formInfo = PCJSF_Support_Form_Map[PCJSF_Support_Form_Id];
	if(!formInfo)return;
	var error = null;
	var content = "";
	for(var i = 0; i < formInfo.fields.length; i++)
	{
		var field = formInfo.fields[i];
		var type = field.type;
		var element = PCJSF__Doc.getElementById("PCJSF_Support_Form_Item" + i);
		var value = (element && element.value) ? PCJSF_Trim(element.value) : "";
		content += "<b>" + field.label + " </b>";
		if(type == "SingleLineText")
		{
			if((field.required == "1") && (value.length < 1)) { error = field.error; break; }
			content += PCJSF_EscapeHtml(value);
		}
		else if(type == "MultiLineText")
		{
			if((field.required == "1") && (value.length < 1)) { error = field.error; break; }
			content += PCJSF_EscapeHtml(value);
		}
		else if(type == "EMail")
		{
			if(((value.length > 0) && (!PCJSF_IsValidEMail(value))) || ((field.required == "1") && (value.length < 1))) { error = field.error; break; }
			content += PCJSF_EscapeHtml(value);
		}
		else if(type == "Url")
		{
			if(((value.length > 0) && (!PCJSF_IsValidUrl(value))) || ((field.required == "1") && (value.length < 1))) { error = field.error; break; }
			content += PCJSF_EscapeHtml(value);
		}
		else if(type == "Checkbox")
		{
			content += element.checked ? "yes" : "no";
		}
		else if(type == "DropDown")
		{
			if((field.required == "1") && (value.length < 1)) { error = field.error; break; }
			content += PCJSF_EscapeHtml(value);
		}
		content += "<br />";
	}
	if(error !== null)
	{
		alert(error);
		return;
	}
	var scriptContainer = document.getElementById("PCJSF_ScriptContainer");
	var scriptChildElement = document.createElement("script");
	scriptChildElement.setAttribute("src", PCJSF_Processor_ServerURL + "Public/SendPopupForm.php?accountId=" + encodeURIComponent(PCJSF_Support_Form_AccountId) + "&formName=" + encodeURIComponent(PCJSF_Support_Form_Name) + "&method=PCJSF_Support_Form_EMailSent&content=" + encodeURIComponent(content));
	scriptChildElement.setAttribute("type", 'text/javascript');
	scriptContainer.appendChild(scriptChildElement); 
}

function PCJSF_Support_Form_EMailSent(success)
{
	if(success)
	{
		alert(PCJSF_UnescapeHtml(PCJSF_Support_Form_SentMessage));
		PCJSF_Support_CloseForm();
	}
	else
	{
		alert("Sending failed.");
	}
}

function PCJSF_Support_Form_GoBack()
{
	PCJSF_Support_CloseForm();
}

function PCJSF_Support_Form_OnLoaded(accountId, formName, json)
{
	if(!json)return;
	PCJSF_Support_Form_Map[accountId + "_" + formName] = json;
	PCJSF_Support_Form_Loaded();
}

function PCJSF_Support_Form_Deactivate()
{
	PCJSF_Support_Form_Active = false;
	PCJSF_ClearChildren(PCJSF_Support_ContainerDiv);
}

var PCJSF_Support_PopupState = "closed";
var PCJSF_Support_PopupStateExecuted = false;
var PCJSF_Support_State = "unk";
var PCJSF_Support_VisibleState = "";
var PCJSF_Support_ContainerDiv = null;
var PCJSF_Support_MasterDiv = null;
var PCJSF_Support_Temp = navigator.userAgent.toLowerCase();
var PCJSF_Support_IEVersion = getInternetExplorerVersion();
var PCJSF_Support_IsIE = (getInternetExplorerVersion() >= 6);
var PCJSF_Support_IsIE9 = PCJSF_Support_IsIE ? (getInternetExplorerVersion() >= 9.0) : false;
var PCJSF_Support_IsIE8 = PCJSF_Support_IsIE ? (getInternetExplorerVersion() >= 8.0) : false;
var PCJSF_Support_IsIE6 = PCJSF_Support_IsIE ? (getInternetExplorerVersion() < 7.0) : false;
var PCJSF_Support_IsChrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
var PCJSF_Support_IsSafari = (PCJSF_Support_Temp.indexOf("safari") >= 0);
var PCJSF_Support_MinimizeButtonIndex;
var PCJSF_Support_LoadedSets = new Array();
var PCJSF_Support_SkinURL;
var PCJSF_Support_TitleVisible = 1;
var PCJSF_Support_SentCommands = new Array();
var PCJSF_Support_Commands = new Array();
var PCJSF_Support_SetStateDone = false;
var PCJSF_Support_TempUpdateChatDiv = 0;
var PCJSF_Support_AutoOpenCallback = false;
var PCJSF_Support_UnreadMessageCountChangedCallback = false;
var PCJSF_Support_NotifyEventList = "";
var PCJSF_Support_OldNotifyEventList = "";
var PCJSF_SkinObject = null;

//Skin
var PCJSF_Support_Font = "Arial";

var PCJSF_Support_LargeTextSize = "20px";
var PCJSF_Support_TitleTextSize = "14px";
var PCJSF_Support_ButtonTextSize = "11px";
var PCJSF_Support_MainTextSize = "12px";
var PCJSF_Support_PoweredByTextSize = "10px";

var PCJSF_Support_LoadingColor = "brown";
var PCJSF_Support_HeaderColor = "#e0e0e0";
var PCJSF_Support_BorderColor = "#000000";
var PCJSF_Support_BorderAlpha = 55;
var PCJSF_Support_InnerBorderColor = "#666666";
var PCJSF_Support_BaseColor = "#ffffff";
var PCJSF_Support_TitleColor = "#000000";
var PCJSF_Support_TitleWeight = "bold";
var PCJSF_Support_ButtonColor = "#d0d0d0";
var PCJSF_Support_ButtonHOverColor = "#f0f0f0";
var PCJSF_Support_MainTextColor = "#000000";
var PCJSF_Support_PoweredByHeight = "12px";
var PCJSF_Support_PoweredByTextColor = "#ffffff";

var PCJSF_Support_SwitchBackground = "#cccccc";
var PCJSF_Support_SwitchBorder = "#999999";
var PCJSF_Support_TitleBackground = "#ffffff";
var PCJSF_Support_ChatBackground = "#ffffff";
var PCJSF_Support_TypeSize = "12px";
var PCJSF_Support_TypeColor = "#000000";
var PCJSF_Support_TypeWeight = "normal";
var PCJSF_Support_TypeBackground = "#ffffff";
var PCJSF_Support_OffersBackground = "#ffffff";
var PCJSF_Support_OfferBorder = "1px solid #cccccc";
var PCJSF_Support_ButtonBorder = "1px solid black";
var PCJSF_Support_ButtonBackground = "#2d2d2d";
var PCJSF_Support_InputBorder = "1px solid black";
var PCJSF_Support_InputHeight = "20px";

var PCJSF_Support_OfferFont = "Tahoma";
var PCJSF_Support_OfferTitleDecoration = "none";
var PCJSF_Support_OfferTitleSize = "11px";
var PCJSF_Support_OfferTitleColor = "#000000";
var PCJSF_Support_OfferTitleWeight = "bold";
var PCJSF_Support_OfferTextDecoration = "none";
var PCJSF_Support_OfferTextSize = "11px";
var PCJSF_Support_OfferTextColor = "#000000";
var PCJSF_Support_OfferTextWeight = "normal";
var PCJSF_Support_OfferFooterDecoration = "none";
var PCJSF_Support_OfferFooterSize = "11px";
var PCJSF_Support_OfferFooterColor = "#000000";
var PCJSF_Support_OfferFooterWeight = "bold";

var PCJSF_Support_ChatSeparatorHeight = "24px";
var PCJSF_Support_BorderWidth = "6px";
var PCJSF_Support_InnerBorderWidth = "7px";
var PCJSF_Support_ImageBorderWidth = "4px";
var PCJSF_Support_ImagePadding = "7px";
var PCJSF_Support_ButtonPadding = 5;

var PCJSF_Chat_TypingMessageStyle = "font-family:Arial;font-size:10px;font-weight:normal;color:#666666;";
var PCJSF_Chat_FillFormLinkStyle = "";
var PCJSF_Support_UnreadMessagesStyle = "width:20px;height:20px;border-radius:10px;font-size:12px;color:#ffffff;background:#ff0000;position:absolute;magin:0px;font-weight:bold;";

//Messages
var PCJSF_Support_TxtLoading = "Loading";

//Global configuration
var PCJSF_Support_GlobalConf = 0;
var PCJSF_Support_ConfigurationCode = "";
var PCJSF_Support_TitleType = 0; //0-Default, 1-Image, 2-Text
var PCJSF_Support_TitleText = "";
var PCJSF_Support_Skin = "default";
var PCJSF_Support_Width = 0;
var PCJSF_Support_Height = 0;
var PCJSF_Support_MinWidth =300;
var PCJSF_Support_MinHeight = 300;
var PCJSF_Support_MaxWidth = 800;
var PCJSF_Support_MaxHeight = 800;
var PCJSF_Support_AlignmentX = 2;
var PCJSF_Support_AlignmentY = 2;
var PCJSF_Support_OffsetX = 30;
var PCJSF_Support_OffsetY = 30;
var PCJSF_Support_AllowMove = 1;
var PCJSF_Support_AllowResize = 1;
var PCJSF_Support_AllowChatInWFO = 1;
var PCJSF_Support_AllowChatInWFV = 1;
var PCJSF_Support_AllowLeaveAMessage = 1;
var PCJSF_Support_AllowLeaveAMessageInSES = 1;
var PCJSF_Support_AllowLeaveAMessageOpAv = 1;
var PCJSF_Support_AskForEMail = 0;
var PCJSF_Support_AllowTranscriptEMail = 0;
var PCJSF_Support_ShowLiveChat = 0;
var PCJSF_Support_LivechatURL = "";
var PCJSF_Support_LivechatScript = "";
var PCJSF_Support_LivechatImageURL = "";
var PCJSF_Support_LivechatImageWidth = 0;
var PCJSF_Support_LivechatImageHeight = 0;
var PCJSF_Support_TypeHereText = "";
var PCJSF_Support_OffersId = "";
var PCJSF_Support_FB_Show = 0;
var PCJSF_Support_FB_ShowWhenOffline = 0;
var PCJSF_Support_FB_AlignmentX = 2;
var PCJSF_Support_FB_AlignmentY = 2;
var PCJSF_Support_FB_OffsetX = 30;
var PCJSF_Support_FB_OffsetY = 30;
var PCJSF_Support_PoweredByText = "";
var PCJSF_Support_PoweredByURL = "";
var PCJSF_Support_TypingMessage = "";
var PCJSF_Support_AccountId = "";
var PCJSF_Support_BaseURL = "";
var PCJSF_Support_EnableSoundAlarm = 1;
var PCJSF_Support_SoundAlarmForAutoMessage = 0;
var PCJSF_Support_SoundAlarmForProactiveOpen = 1;
var PCJSF_Support_SoundAlarmForMessage = 0;
var PCJSF_Support_SoundAlarmInactivePeriod = 0;
var PCJSF_Support_ClickToChat = "";
var PCJSF_Support_SendButtonCaption = "";
var PCJSF_Support_SES_EMailInvalidText = "";
var PCJSF_Support_PlatformFilter = 0;
var PCJSF_Support_PcEngine = "";
var PCJSF_Support_MobileEngine = "";
var PCJSF_Support_Common_BackButtonText = "";
var PCJSF_Support_AllowChatInWFOWO = 0;
var PCJSF_Support_AllowChatInWFVWO = 0;

var PCJSF_Support_OperatorAvailableRetrieved = 0;
var PCJSF_Support_OperatorAvailable = 0;

var PCJSF_Support_ConnectedCallback = null;

//WFV
var PCJSF_Support_WFV_TitleHTML = "";
var PCJSF_Support_WFV_NATitleHTML = "";
var PCJSF_Support_WFV_ImageMIME = "";
var PCJSF_Support_WFV_ImageWidth = 0;
var PCJSF_Support_WFV_ImageHeight = 0;
var PCJSF_Support_WFV_InviteTextHTML = "";
var PCJSF_Support_WFV_NATextHTML = "";
var PCJSF_Support_WFV_LeaveAMessageButtonText = "";
var PCJSF_Support_WFV_StartChatButtonText = "";
var PCJSF_Support_WFV_AllowHideTitle = 1;
var PCJSF_Support_WFV_ShowOffers = 1;
var PCJSF_Support_WFV_EMailCaption = "";
var PCJSF_Support_WFV_InvalidEMail = "";

//WFO
var PCJSF_Support_WFO_TitleHTML = "";
var PCJSF_Support_WFO_NATitleHTML = "";
var PCJSF_Support_WFO_ImageMIME = "";
var PCJSF_Support_WFO_ImageWidth = 0;
var PCJSF_Support_WFO_ImageHeight = 0;
var PCJSF_Support_WFO_WaitTextHTML = "";
var PCJSF_Support_WFO_NATextHTML = "";
var PCJSF_Support_WFO_LeaveAMessageButtonText = "";
var PCJSF_Support_WFO_AllowHideTitle = 1;
var PCJSF_Support_WFO_ShowOffers = 1;

//LAM
var PCJSF_Support_LAM_TitleHTML = "";
var PCJSF_Support_LAM_ImageMIME = "";
var PCJSF_Support_LAM_ImageWidth = 0;
var PCJSF_Support_LAM_ImageHeight = 0;
var PCJSF_Support_LAM_TextHTML = "";
var PCJSF_Support_LAM_EMailLabelText = "";
var PCJSF_Support_LAM_NameLabelText = "";
var PCJSF_Support_LAM_MessageLabelText = "";
var PCJSF_Support_LAM_SendButtonText = "";
var PCJSF_Support_LAM_BackButtonText = "";
var PCJSF_Support_LAM_AllowHideTitle = 1;
var PCJSF_Support_LAM_ShowOffers = 1;
var PCJSF_Support_LAM_SentMessage = "";

//SES
var PCJSF_Support_SES_TitleHTML = "";
var PCJSF_Support_SES_ImageMIME = "";
var PCJSF_Support_SES_ImageWidth = 0;
var PCJSF_Support_SES_ImageHeight = 0;
var PCJSF_Support_SES_AllowHideTitle = 1;
var PCJSF_Support_SES_ShowOffers = 1;
var PCJSF_Support_SES_MainText = "";
var PCJSF_Support_SES_SetEMailButtonText = "";
var PCJSF_Support_SES_SetEMailLabel = "";
var PCJSF_Support_SES_EMailSetConfirmationText = "";

var PCJSF_Support_LAM_EMail = "";
var PCJSF_Support_LAM_Name = "";
var PCJSF_Support_LAM_Message = "";

var PCJSF_Support_WFV_EMail = "";

var PCJSF_Support_SES_EMail = "";

var PCJSF_Support_NotificationSoundUrl = null;
var PCJSF_Support_NotificationSound = null;

var PCJSF_Support_PendingParamData = null;

/*string*/function PCJSF_Support_ParseUrlParameter(/*string*/value) {
	var /*int*/len = value.length;
	var /*string*/result = "";
	var /*int*/i = 0;
	while(i < len) {
		var /*char*/sym = value.charAt(i);
		i++;
		if(sym == "+")result += " ";
		else if(sym == "%") {
			if(i + 1 < len) {
				var /*int*/code = parseInt(value.substr(i, 2), 16);
				if(!isNaN(code))result += String.fromCharCode(code);
			}
			i += 2;
		}
		else result += sym;
	}
	return result;
}

/*Array[string=>string]*/function PCJSF_Support_ParseUrlParameters(/*string*/url) {
	var result = [];
	var index = url.indexOf("?");
	if(index < 0)return result;
	url = url.substr(index + 1);
	var parts = url.split("&");
	for(var i = 0; i < parts.length; i++) {
		var part = parts[i];
		index = part.indexOf("=");
		if(index >= 0)
			result[PCJSF_Support_ParseUrlParameter(part.substr(0, index))] = PCJSF_Support_ParseUrlParameter(part.substr(index + 1));
		else
			result[PCJSF_Support_ParseUrlParameter(part)] = "";
	}
	return result;
}

function PCJSF_Support_EscapeParamElement(text)
{
	text = text.replace(/\\/g, "\\e");
	text = text.replace(/,/g, "\\c");
	text = text.replace(/;/g, "\\s");
	return text;
}

function PCJSF_Support_UnescapeParamElement(text)
{
	text = text.replace(/\\c/g, ",");
	text = text.replace(/\\s/g, ";");
	text = text.replace(/\\e/g, "\\");
	return text;
}

function PCJSF_Support_ExtractCustomParameters(info)
{
	var paramData = "";
	var urlParameters = PCJSF_Support_ParseUrlParameters(PCJSF__Doc.location.toString());
	var paramList = info.split(";");
	for(var i = 0; i < paramList.length; i++)
	{
		var parts = paramList[i].split(",");
		if(parts.length == 3)
		{
			var urlParam = PCJSF_Support_UnescapeParamElement(parts[1]);
			var javaVar = PCJSF_Support_UnescapeParamElement(parts[2]);
			var value = null;
			if(javaVar.length > 0)value = window[javaVar];
			if((!value) && (urlParam.length > 0))value = urlParameters[urlParam];
			if(value && (value.length > 0))
			{
				if(paramData != "")paramData += ";";
				paramData += parts[0] + "," + PCJSF_Support_EscapeParamElement(value);
			}
		}
	}
	if(paramData.length > 0)PCJSF_Support_PendingParamData = paramData;
}

//Communication
function PCJSF_Support_CollectRequestData(connecting, data)
{
	var d = data["support"] = new Array();
	d["state"] = PCJSF_Support_PopupState + ";" + PCJSF_Support_State;
	var load = "";
	if(!PCJSF_Support_GlobalConf)load += "global;";
	if(!PCJSF_Support_LoadedSets[PCJSF_Support_State])load += PCJSF_Support_State + ";";
	if(load.length > 0)d["load"] = load;
	PCJSF_Support_SentCommands = PCJSF_Support_SentCommands.concat(PCJSF_Support_Commands);
	PCJSF_Support_Commands = new Array();
	var commands = "";
	for(var i = 0; i < PCJSF_Support_SentCommands.length; i++)
	{
		if(commands != "")commands += ";";
		var command = PCJSF_Support_SentCommands[i];
		commands += command;
		if(command == "lam_leave_a_message")
		{
			d["mail"] = PCJSF_Support_LAM_EMail;
			d["name"] = PCJSF_Support_LAM_Name;
			d["message"] = PCJSF_Support_LAM_Message;
		}
		else if(command == "wfv_start_chat")
		{
			d["mail"] = PCJSF_Support_WFV_EMail;
		}
		else if(command == "ses_set_email")
		{
			d["tmail"] = PCJSF_Support_SES_EMail;
		}
	}
	if(commands != "")d["commands"] = commands;
	var notifyEvents = (PCJSF_Support_OldNotifyEventList + "," + PCJSF_Support_NotifyEventList).split(",");
	PCJSF_Support_OldNotifyEventList = "";
	var notifyEventList = "";
	for(var i = 0; i < notifyEvents.length; i++)
	{
		var event = PCJSF_Trim(notifyEvents[i]);
		if(event.length > 0)
		{
			if(notifyEventList.length > 0)notifyEventList += ",";
			notifyEventList += event;
		}
	}
	if(notifyEventList.length > 0)
	{
		d["nel"] = notifyEventList;
		PCJSF_Support_OldNotifyEventList = notifyEventList;
	}
	PCJSF_Support_NotifyEventList = "";
	if(PCJSF_Support_PendingParamData)
	{
		d["pad"] = PCJSF_Support_PendingParamData;
		PCJSF_Support_PendingParamData = null;
	}
	if(PCJSF_Support_PopupStateExecuted)d["pstatee"] = 1;
	if(connecting)
	{
		d["connecting"] = "1";
		d["ismobile"] = PCJSF_IsMobileDeviceValue ? "1" : "0";
		var loc = String(PCJSF__Doc.location);
		var qIndex = loc.indexOf("?");
		if(qIndex >= 0)
		{
			var pri = loc.indexOf("prcc=", qIndex);
			if(pri >= 0)
			{
				if((pri == qIndex + 1) || (loc.charAt(pri - 1) == "&"))
				{
					var end = loc.indexOf("&", pri);
					if(end < 0)end = loc.length;
					d["campaign"] = loc.substr(pri + 5, end - pri - 5);
				}
			}
		}
	}
}

function PCJSF_Support_CollectState()
{
	if((PCJSF_Support_Width == 0) || (PCJSF_Support_Height == 0))return "";
	return	PCJSF_Support_OffsetX + "," + PCJSF_Support_OffsetY + "," + PCJSF_Support_Width + "," + PCJSF_Support_Height + "," +
			PCJSF_Support_PopupState + "," + PCJSF_Support_TitleVisible + "," + PCJSF_Chat_LastSeenMessage;
}

function PCJSF_Support_JSSChanged()
{
	if(PCJSF_Tracker_VisitorKey == "")return;
	var state = PCJSF_Support_CollectState();
	if(state != "") {
		var keysToRemove = [];
		var keyList = PCJSF_LSGetAllWithPrefix("PCJSF_JSS");
		for (var i = 0, len = keyList.length; i < len; i++){
			var key = keyList[i];
			var stateData = PCJSF_LSGet(key);
			if(stateData) {
				var index = stateData.indexOf("_");
				if(index < 0)keysToRemove.push(key);
				else {
					var time = parseFloat(stateData.substr(0, index));
					var currentTime = (new Date()).getTime();
					if((time > currentTime) || (time < currentTime - 300 * 1000))keysToRemove.push(key);
				}
			}
        }
		for(var i = 0; i < keysToRemove.length; i++) {
			PCJSF_LSRemove(keysToRemove[i]);
		}
		PCJSF_LSSet("PCJSF_JSS" + PCJSF_Tracker_VisitorKey, (new Date()).getTime() + "_" + state);
	}
}

function PCJSF_Support_SetState(state)
{
	if(!state)return;
	var parts = state.split(",");	
	if(parts.length == 7)
	{
		if(PCJSF_Support_PopupState != "embedded")
		{
			PCJSF_Support_OffsetX = parseInt(parts[0]);
			PCJSF_Support_OffsetY = parseInt(parts[1]);
			PCJSF_Support_Width = parseInt(parts[2]);
			PCJSF_Support_Height = parseInt(parts[3]);
			if(PCJSF_Support_Width < PCJSF_Support_MinWidth)PCJSF_Support_Width = PCJSF_Support_MinWidth;
			if(PCJSF_Support_Width > PCJSF_Support_MaxWidth)PCJSF_Support_Width = PCJSF_Support_MaxWidth;
			if(PCJSF_Support_Height < PCJSF_Support_MinHeight)PCJSF_Support_Height = PCJSF_Support_MinHeight;
			if(PCJSF_Support_Height > PCJSF_Support_MaxHeight)PCJSF_Support_Height = PCJSF_Support_MaxHeight;
		}
		if((PCJSF_Support_PopupState != "embedded") && (parts[4] != "embedded"))PCJSF_Support_PopupState = parts[4];
		PCJSF_Support_TitleVisible = parseInt(parts[5]);
		PCJSF_Chat_LastSeenMessage = parseFloat(parts[6]);
	}
}

function PCJSF_Support_SkinLoaded()
{
	if(PCJSF_Chat_FillFormLinkStyle == "")PCJSF_Chat_FillFormLinkStyle = PCJSF_Chat_OCStyle + ";text-decoration:underline;cursor:pointer;";
	PCJSF_Support_GlobalConf = 1;
	if(PCJSF_Support_PopupState != "embedded")
	{
		if(PCJSF_Support_GlobalConf && !PCJSF_Support_MasterDiv)PCJSF_Support_CreatePopup();
	}
	PCJSF_Support_UpdateState(false);
}

var PCJSF_Support_AutoOpenTime = 0;

function PCJSF_Support_HandleResponseData(connecting, data)
{
	if(data["support"] !== undefined)
	{
		var d = data["support"];
		if(d["global"] != undefined)
		{
			var gp = PCJSF_SplitParameters(d["global"]);
			PCJSF_Support_ConfigurationCode = gp[0];
			PCJSF_Support_TitleType = gp[1];
			PCJSF_Support_TitleText = gp[2];
			PCJSF_Support_Skin = gp[3];
			PCJSF_Support_AllowMove = parseInt(gp[4]);
			PCJSF_Support_AllowResize = parseInt(gp[5]);
			PCJSF_Support_AlignmentX = parseInt(gp[6]);
			PCJSF_Support_AlignmentY = parseInt(gp[7]);
			PCJSF_Support_OffsetX = parseInt(gp[8]);
			PCJSF_Support_OffsetY = parseInt(gp[9]);
			PCJSF_Support_MinWidth = parseInt(gp[10]);
			PCJSF_Support_MaxWidth = parseInt(gp[11]);
			if(PCJSF_Support_PopupState != "embedded")
			{
				PCJSF_Support_Width = parseInt(gp[12]);
			}
			PCJSF_Support_MinHeight = parseInt(gp[13]);
			PCJSF_Support_MaxHeight = parseInt(gp[14]);
			if(PCJSF_Support_PopupState != "embedded")
			{
				PCJSF_Support_Height = parseInt(gp[15]);
			}
			PCJSF_Support_AllowChatInWFO = parseInt(gp[16]);
			PCJSF_Support_AllowChatInWFV = parseInt(gp[17]);
			PCJSF_Support_AllowLeaveAMessage = parseInt(gp[18]);
			PCJSF_Support_AllowLeaveAMessageInSES = parseInt(gp[19]);
			PCJSF_Support_AllowLeaveAMessageOpAv = parseInt(gp[20]);
			PCJSF_Support_ShowLiveChat = parseInt(gp[21]);
			PCJSF_Support_LivechatURL = gp[22];
			PCJSF_Support_LivechatScript = gp[23];
			PCJSF_Support_LivechatImageURL = gp[24];
			PCJSF_Support_LivechatImageWidth = parseInt(gp[25]);
			PCJSF_Support_LivechatImageHeight = parseInt(gp[26]);
			PCJSF_Support_TypeHereText = gp[27];
			PCJSF_Support_OffersId = gp[28];
			PCJSF_Support_FB_Show = parseInt(gp[29]);
			PCJSF_Support_FB_ShowWhenOffline = parseInt(gp[30]);
			PCJSF_Support_FB_AlignmentX = parseInt(gp[31]);
			PCJSF_Support_FB_AlignmentY = parseInt(gp[32]);
			PCJSF_Support_FB_OffsetX = parseInt(gp[33]);
			PCJSF_Support_FB_OffsetY = parseInt(gp[34]);
			PCJSF_Support_AskForEMail = parseInt(gp[35]);
			PCJSF_Support_AllowTranscriptEMail = parseInt(gp[36]);
			PCJSF_Support_PoweredByText = gp[37];
			PCJSF_Support_PoweredByURL = gp[38];
			PCJSF_Support_TypingMessage = gp[39];
			PCJSF_Support_AccountId = gp[40];
			PCJSF_Support_BaseURL = gp[41];
			PCJSF_Support_EnableSoundAlarm = parseInt(gp[42]);
			PCJSF_Support_SoundAlarmForAutoMessage = parseInt(gp[43]);
			PCJSF_Support_SoundAlarmForProactiveOpen = parseInt(gp[44]);
			PCJSF_Support_SoundAlarmForMessage = parseInt(gp[45]);
			PCJSF_Support_SoundAlarmInactivePeriod = parseInt(gp[46]);
			PCJSF_Support_ClickToChat = gp[47];
			PCJSF_Support_SendButtonCaption = gp[48];
			PCJSF_Support_SES_EMailInvalidText = gp[49];
			PCJSF_Support_PlatformFilter = parseInt(gp[50]);
			PCJSF_Support_PcEngine = gp[51];
			PCJSF_Support_MobileEngine = gp[52];
			PCJSF_Support_Common_BackButtonText = gp[53];
			PCJSF_Support_AllowChatInWFOWO = parseInt(gp[54]);
			PCJSF_Support_AllowChatInWFVWO = parseInt(gp[55]);
			
			PCJSF_Support_SkinURL = PCJSF_Processor_ServerURL + "Public/Skins/" + PCJSF_Support_Skin + "/";
			if((PCJSF_Tracker_VisitorKey != "") && (!PCJSF_Support_SetStateDone))
			{
				PCJSF_Support_SetStateDone = true;
				var stateData = localStorage.getItem("PCJSF_JSS" + PCJSF_Tracker_VisitorKey);
				if(stateData) {
					var index = stateData.indexOf("_");
					if(index >= 0)PCJSF_Support_SetState(stateData.substr(index + 1));
				}
			}
			if(PCJSF_Support_GlobalConf == 0)
			{
				var scriptContainer = document.getElementById("PCJSF_ScriptContainer");
				var scriptChildElement = document.createElement("script");
				var engine = PCJSF_Support_PcEngine;
				if(engine == "")engine = "default";
				if(PCJSF_IsMobileDeviceValue)
				{
					engine = PCJSF_Support_MobileEngine;
					if(engine == "")engine = "mobile";
				}
				scriptChildElement.setAttribute("src", PCJSF_Processor_ServerURL + "Public/LoadSkin.php?skin=" + PCJSF_Support_Skin + "&engine=" + engine + "&prefix=PCJSF_");
				scriptChildElement.setAttribute("type", 'text/javascript');
				scriptContainer.appendChild(scriptChildElement); 
			}
		}
		if(d["wfv"] != undefined)
		{
			var vp = PCJSF_SplitParameters(d["wfv"]);
			PCJSF_Support_WFV_TitleHTML = vp[0];
			PCJSF_Support_WFV_ImageMIME = vp[1];
			PCJSF_Support_WFV_ImageWidth = parseInt(vp[2]);
			PCJSF_Support_WFV_ImageHeight = parseInt(vp[3]);
			PCJSF_Support_WFV_InviteTextHTML = vp[4];
			PCJSF_Support_WFV_NATextHTML = vp[5];
			PCJSF_Support_WFV_LeaveAMessageButtonText = vp[6];
			PCJSF_Support_WFV_StartChatButtonText = vp[7];
			PCJSF_Support_WFV_AllowHideTitle = parseInt(vp[8]);
			PCJSF_Support_WFV_ShowOffers = parseInt(vp[9]);
			PCJSF_Support_WFV_EMailCaption = vp[10];
			PCJSF_Support_WFV_InvalidEMail = vp[11];
			PCJSF_Support_WFV_NATitleHTML = vp[12];
			PCJSF_Support_LoadedSets["wfv"] = true;
		}
		if(d["wfo"] != undefined)
		{
			var vp = PCJSF_SplitParameters(d["wfo"]);
			PCJSF_Support_WFO_TitleHTML = vp[0];
			PCJSF_Support_WFO_ImageMIME = vp[1];
			PCJSF_Support_WFO_ImageWidth = parseInt(vp[2]);
			PCJSF_Support_WFO_ImageHeight = parseInt(vp[3]);
			PCJSF_Support_WFO_WaitTextHTML = vp[4];
			PCJSF_Support_WFO_NATextHTML = vp[5];
			PCJSF_Support_WFO_LeaveAMessageButtonText = vp[6];
			PCJSF_Support_WFO_AllowHideTitle = parseInt(vp[7]);
			PCJSF_Support_WFO_ShowOffers = parseInt(vp[8]);
			PCJSF_Support_WFO_NATitleHTML = vp[9];
			PCJSF_Support_LoadedSets["wfo"] = true;
		}
		if(d["lam"] != undefined)
		{
			var vp = PCJSF_SplitParameters(d["lam"]);
			PCJSF_Support_LAM_TitleHTML = vp[0];
			PCJSF_Support_LAM_ImageMIME = vp[1];
			PCJSF_Support_LAM_ImageWidth = parseInt(vp[2]);
			PCJSF_Support_LAM_ImageHeight = parseInt(vp[3]);
			PCJSF_Support_LAM_TextHTML = vp[4];
			PCJSF_Support_LAM_EMailLabelText = vp[5];
			PCJSF_Support_LAM_NameLabelText = vp[6];
			PCJSF_Support_LAM_MessageLabelText = vp[7];
			PCJSF_Support_LAM_SendButtonText = vp[8];
			PCJSF_Support_LAM_BackButtonText = vp[9];
			PCJSF_Support_LAM_AllowHideTitle = parseInt(vp[10]);
			PCJSF_Support_LAM_ShowOffers = parseInt(vp[11]);
			PCJSF_Support_LAM_SentMessage = vp[12];
			PCJSF_Support_LoadedSets["lam"] = true;
		}
		if(d["ses"] != undefined)
		{
			var vp = PCJSF_SplitParameters(d["ses"]);
			PCJSF_Support_SES_TitleHTML = vp[0];
			PCJSF_Support_SES_ImageMIME = vp[1];
			PCJSF_Support_SES_ImageWidth = parseInt(vp[2]);
			PCJSF_Support_SES_ImageHeight = parseInt(vp[3]);
			PCJSF_Support_SES_AllowHideTitle = parseInt(vp[4]);
			PCJSF_Support_SES_ShowOffers = parseInt(vp[5]);
			PCJSF_Support_SES_MainText = vp[6];
			PCJSF_Support_SES_SetEMailButtonText = vp[7];
			PCJSF_Support_SES_EMailSetConfirmationText = vp[8];
			PCJSF_Support_SES_EMail = vp[9];
			PCJSF_Support_SES_SetEMailLabel = vp[10];
			PCJSF_Support_LoadedSets["ses"] = true;
		}
		if(d["par"] != undefined)
		{
			PCJSF_Support_ExtractCustomParameters(d["par"]);
		}
		if(PCJSF_Support_PopupState != "embedded")
		{
			if(PCJSF_Support_GlobalConf && !PCJSF_Support_MasterDiv)PCJSF_Support_CreatePopup();
		}
		if(d["nela"] != undefined)
		{
			PCJSF_Support_OldNotifyEventList = "";
		}
		if(d["state"] != undefined)
		{
			PCJSF_Support_State = d["state"];
		}
		PCJSF_Support_PopupStateExecuted = false;
		if(d["auto_opened"] == "yes")PCJSF_Support_AutoOpenTime = (new Date).getTime();
		if((PCJSF_Support_PopupState != "embedded") && (d["pstate"] != undefined))
		{
			PCJSF_Support_PopupStateExecuted = true;
			if(d["pstate"] == "opened")
			{
				if((d["auto_opened"] == "yes") && PCJSF_Support_SoundAlarmForAutoMessage)
				{
					PCJSF_Support_PlayNotificationSound();
				}
				else if((d["auto_opened"] != "yes") && PCJSF_Support_SoundAlarmForProactiveOpen)
				{
					PCJSF_Support_PlayNotificationSound();
				}
			}
			PCJSF_Support_PopupState = d["pstate"];
		}
		var operatorStateChanged = false;
		if(d["opav"] != undefined)
		{
			var newOperatorState = (d["opav"] == "1") ? 1 : 0;
			if(PCJSF_Support_OperatorAvailableRetrieved && (PCJSF_Support_OperatorAvailable != newOperatorState))operatorStateChanged = true;
			PCJSF_Support_OperatorAvailable = newOperatorState;
			PCJSF_Support_OperatorAvailableRetrieved = 1;
		}
		PCJSF_Support_UpdateState(operatorStateChanged);
		PCJSF_Support_SentCommands = new Array();
		var timeout;
		if(PCJSF_Support_State == "ses")timeout = PCJSF_Support_SESUpdateTimeout;
		else if(PCJSF_Support_State == "lam")timeout = PCJSF_Support_LAMUpdateTimeout;
		else if(PCJSF_Support_State == "wfo")timeout = PCJSF_Support_WFOUpdateTimeout;
		else timeout = PCJSF_Support_WFVUpdateTimeout;
		if(PCJSF_Tracker_Mode != 0)
		{
			PCJSF_Processor_RegisterRequest(timeout);
		}
		if(d["auto_opened"] == "yes")
		{
			if(PCJSF_Support_AutoOpenCallback)
			{
				PCJSF_Support_AutoOpenCallback();
			}
		}
		if(PCJSF_Support_ConnectedCallback)
		{
			PCJSF_Support_ConnectedCallback();
			PCJSF_Support_ConnectedCallback = null;
		}
		if(d["lam_performed"] == "yes")
		{
			if(PCJSF_Support_LAM_SentMessage != "")
			{
				alert(PCJSF_Support_LAM_SentMessage);
			}
		}
		if(d["pushs"] != undefined)
		{
			setTimeout(function() { PCJSF_PerformPush(d["pushs"]); }, 10);
		}
		return 1;
	}
	return 0;
}

function PCJSF_PerformPush(text)
{
	text = PCJSF_Trim(text);
	var index = text.indexOf("://");
	if(index >= 0)
	{
		var protocol = text.substr(0, index).toLowerCase();
		if((protocol == "http") || (protocol == "https"))
		{
			PCJSF__Doc.location = text;
			return;
		}
	}
	eval(text);
}

function PCJSF_Support_OnSizeOrStructureChanged()
{
	PCJSF_Support_UpdatePosition();
	PCJSF_Support_UpdateChatDiv();
	PCJSF_Support_UpdateOfferPositions();
	PCJSF_Support_TempUpdateChatDiv = 2;
}

function PCJSF_Support_GetEmbeddedContainerHTML(addFrame, width, height, noFrameBorderColor)
{
	return PCJSF_FixS("<div id = \"PCJSF_Support_ContainerDiv\" align=\"center\" style = \"width:" + width + "px;height:" + height + "px;border:solid 1px " + noFrameBorderColor + ";overflow:hidden;padding:0px;margin:0px;\"></div>");
}

function PCJSF_Support_CreatePopup()
{
	PCJSF_Support_MasterDiv = PCJSF_SkinObject.BuildPopup(PCJSF_Support_SkinURL, PCJSF_Support_Width, PCJSF_Support_Height);
	PCJSF__Doc.body.appendChild(PCJSF_Support_MasterDiv);
	PCJSF_Support_UpdatePosition();
	if(PCJSF_Support_TitleType == 2)PCJSF_DisableSelectionById("PCJSF_Support_HeaderText", "move");
	PCJSF_Support_ContainerDiv = PCJSF__Doc.getElementById("PCJSF_Support_ContainerDiv");
}

var PCJSF_Support_FloatingButton = null;

function PCJSF_ShowFloatingButton(operatorStateChanged)
{
	if(!PCJSF_Support_FB_Show || (!PCJSF_Support_FB_ShowWhenOffline && !PCJSF_Support_OperatorAvailable))
	{
		PCJSF_HideFloatingButton();
		return;
	}
	if(window.PCJSF_SkinObject)
	{
		if((PCJSF_Support_FloatingButton == null) || operatorStateChanged)PCJSF_Support_FloatingButton = PCJSF_SkinObject.BuildFloatingButton(PCJSF_FloatingButton_Click);
		PCJSF_Support_UpdatePosition();
		PCJSF_Support_FloatingButton.style.visibility = "visible";
	}
}

function PCJSF_FloatingButton_Click()
{
	PCJSF_Support_Open();
}

function PCJSF_HideFloatingButton()
{
	if(PCJSF_Support_FloatingButton != null)
	{
		PCJSF_Support_FloatingButton.style.visibility = "hidden";
	}
}

function PCJSF_Support_UpdateSize(force)
{
	PCJSF_SkinObject.UpdateSize(force);
}

var PCJSF_Support_Moving = false;
var PCJSF_Support_Resizing = false;
var PCJSF_Support_ResizeDirections = false;
var PCJSF_Support_MoveStartPos;
var PCJSF_Support_MoveInitalPos;

function PCJSF_Support_MouseDownInHeader(event)
{
	if((!PCJSF_Support_Moving) && (!PCJSF_Support_Resizing))
	{
		if(PCJSF_SkinObject.IsMoveAndResizeAllowed())
		{
			PCJSF_Support_Moving = true;
			PCJSF_Support_OnStartMoveResize(event);
		}
	}
}

function PCJSF_Support_MouseDownForResize(event, directions)
{
	if((!PCJSF_Support_Moving) && (!PCJSF_Support_Resizing))
	{
		PCJSF_Support_ResizeDirections = directions;
		PCJSF_Support_Resizing = true;
		PCJSF_Support_OnStartMoveResize(event);
	}
}

function PCJSF_Support_OnStartMoveResize(event)
{	
	PCJSF_Support_MoveStartPos = {};
	PCJSF_Support_MoveStartPos.x = event.clientX;
	PCJSF_Support_MoveStartPos.y = event.clientY;
	PCJSF_Support_MoveInitalPos = {};
	PCJSF_Support_MoveInitalPos.x = PCJSF_SafeParseInt(PCJSF_Support_MasterDiv.offsetLeft);
	PCJSF_Support_MoveInitalPos.y = PCJSF_SafeParseInt(PCJSF_Support_MasterDiv.offsetTop);
	if (PCJSF__Doc.addEventListener)
	{
		PCJSF__Doc.addEventListener('mousemove', PCJSF_Support_MouseMove, false); 
		PCJSF__Doc.addEventListener('mouseup', PCJSF_Support_MouseUp, false); 
	}
	else if (PCJSF__Doc.attachEvent)
	{
		PCJSF__Doc.attachEvent('onmousemove', PCJSF_Support_MouseMove); 
		PCJSF__Doc.attachEvent('onmouseup', PCJSF_Support_MouseUp); 
	}
	PCJSF_Support_MouseMove(event);
}

function PCJSF_Support_OnStopMoveResize()
{
	if (PCJSF__Doc.removeEventListener)
	{
		PCJSF__Doc.removeEventListener('mousemove', PCJSF_Support_MouseMove, false); 
		PCJSF__Doc.removeEventListener('mouseup', PCJSF_Support_MouseUp, false); 
	}
	else if (PCJSF__Doc.detachEvent)
	{
		PCJSF__Doc.detachEvent('onmousemove', PCJSF_Support_MouseMove); 
		PCJSF__Doc.detachEvent('onmouseup', PCJSF_Support_MouseUp); 
	}
	PCJSF_Support_UpdatePosition();
}

function PCJSF_Support_MouseMove(event)
{
	var dx = event.clientX - PCJSF_Support_MoveStartPos.x;
	var dy = event.clientY - PCJSF_Support_MoveStartPos.y;
	if(PCJSF_Support_Moving)
	{
		PCJSF_SkinObject.UpdateTempPosition(PCJSF_Support_MoveInitalPos.x + dx, PCJSF_Support_MoveInitalPos.y + dy);
		return false;
	}
	else if(PCJSF_Support_Resizing)
	{
		var newWidth = parseInt(PCJSF_Support_Width);
		var newHeight = parseInt(PCJSF_Support_Height);
		if((PCJSF_Support_ResizeDirections & 1) != 0)newWidth -= dx;
		if((PCJSF_Support_ResizeDirections & 2) != 0)newWidth += dx;
		if((PCJSF_Support_ResizeDirections & 4) != 0)newHeight += dy;
		if(newWidth < PCJSF_Support_MinWidth)newWidth = PCJSF_Support_MinWidth;
		if(newWidth > PCJSF_Support_MaxWidth)newWidth = PCJSF_Support_MaxWidth;
		if(newHeight < PCJSF_Support_MinHeight)newHeight = PCJSF_Support_MinHeight;
		if(newHeight > PCJSF_Support_MaxHeight)newHeight = PCJSF_Support_MaxHeight;
		PCJSF_Support_MasterDiv.style.width = newWidth + "px";
		PCJSF_Support_MasterDiv.style.height = newHeight + "px";
		PCJSF_SkinObject.UpdatePosition();
		PCJSF_Support_OnSizeOrStructureChanged();
		return false;
	}
}

function PCJSF_Support_CalcOffset(content, container, align, pos)
{
	var offset = 0;
	if(align == 0)offset = pos;
	else if(align == 1)offset = pos + PCJSF_SafeParseInt((content - container) / 2);
	else if(align == 2)offset = container - pos - content;
	return offset;
}

function PCJSF_Support_MouseUp(event)
{
	var scroll = PCJSF_GetScroll();
	var windowSize = PCJSF_GetWindowSize();
	if(PCJSF_Support_Moving)
	{
		PCJSF_Support_Moving = false;
		PCJSF_Support_OffsetX = PCJSF_Support_CalcOffset(PCJSF_Support_Width, windowSize.width, PCJSF_Support_AlignmentX, PCJSF_SafeParseInt(PCJSF_Support_MasterDiv.style.left));
		PCJSF_Support_OffsetY = PCJSF_Support_CalcOffset(PCJSF_Support_Height, windowSize.height, PCJSF_Support_AlignmentY, PCJSF_SafeParseInt(PCJSF_Support_MasterDiv.style.top));
		if(PCJSF_Support_IsIE)
		{
			PCJSF_Support_OffsetX += scroll.x;
			PCJSF_Support_OffsetY += scroll.y;
		}
		PCJSF_Support_OnStopMoveResize();
		PCJSF_Support_JSSChanged();
	}
	else if(PCJSF_Support_Resizing)
	{
		PCJSF_Support_Resizing = false;
		PCJSF_Support_Width = PCJSF_SafeParseInt(PCJSF_Support_MasterDiv.style.width);
		PCJSF_Support_Height = PCJSF_SafeParseInt(PCJSF_Support_MasterDiv.style.height);
		PCJSF_Support_OnStopMoveResize();
		PCJSF_Support_OnSizeOrStructureChanged();
		PCJSF_Support_JSSChanged();
	}
}

//Position management
function PCJSF_Support_UpdatePosition()
{
	if(PCJSF_Support_IsIE)
	{
		var container = PCJSF__Doc.getElementById("PCJSF_Support_IEContainerCell");
		var content = PCJSF__Doc.getElementById("PCJSF_Support_IEContentCell");
		if(container && content)
		{
			var size = PCJSF_MeasureElement(container);
			content.style.height = size[1] + "px";
		}
	}
	if(PCJSF_Support_MasterDiv && !PCJSF_Support_Moving && !PCJSF_Support_Resizing)PCJSF_SkinObject.UpdatePosition();
	if(PCJSF_Support_FloatingButton)PCJSF_SkinObject.UpdateFloatingButtonPosition();
}

//Commands
function PCJSF_Support_UpdateState(operatorStateChanged)
{
	var skinURL = PCJSF_Support_SkinURL;
	if(PCJSF_Support_PopupState == "closed")
	{
		if(PCJSF_Support_MasterDiv)PCJSF_Support_MasterDiv.style.visibility = "hidden";
		PCJSF_Support_SetVisible(false);
		PCJSF_ShowFloatingButton(operatorStateChanged);
	}
	else
	{
		PCJSF_HideFloatingButton();
	}
	if(PCJSF_Support_PopupState == "opened")
	{
		PCJSF_OnMessagesShown();
		if(PCJSF_Support_MasterDiv)
		{
			PCJSF_Support_MasterDiv.style.visibility = "visible";
			PCJSF_SkinObject.UpdateState();
			PCJSF_Support_SetVisible(true);
		}
	}
	else if(PCJSF_Support_PopupState == "minimized")
	{
		if(PCJSF_Support_MasterDiv)
		{
			PCJSF_Support_MasterDiv.style.visibility = "visible";
			PCJSF_SkinObject.UpdateState();
		}
	}
	PCJSF_Support_UpdatePosition();
	if(PCJSF_Support_ContainerDiv)
	{
		var targetState = PCJSF_Support_State;
		if(PCJSF_Support_OverrideWithFormState)targetState = "form";
		if(!PCJSF_Support_GlobalConf)targetState = "loading";
		if((PCJSF_Support_VisibleState != targetState) || (operatorStateChanged))
		{			
			if(PCJSF_Support_VisibleState == "loading")PCJSF_Support_Loading_Deactivate();
			else if(PCJSF_Support_VisibleState == "wfv")PCJSF_Support_WFV_Deactivate();
			else if(PCJSF_Support_VisibleState == "wfo")PCJSF_Support_WFO_Deactivate();
			else if(PCJSF_Support_VisibleState == "lam")PCJSF_Support_LAM_Deactivate();
			else if(PCJSF_Support_VisibleState == "ses")PCJSF_Support_SES_Deactivate();
			else if(PCJSF_Support_VisibleState == "form")PCJSF_Support_Form_Deactivate();
			var state = "loading";
			if(targetState == "form")state = "form";
			if(PCJSF_Support_LoadedSets[targetState])state = targetState;
			if(state == "loading")PCJSF_Support_Loading_Activate();
			else if(state == "wfv")PCJSF_Support_WFV_Activate();
			else if(state == "wfo")PCJSF_Support_WFO_Activate();
			else if(state == "lam")PCJSF_Support_LAM_Activate();
			else if(state == "ses")PCJSF_Support_SES_Activate();
			else if(state == "form")PCJSF_Support_Form_Activate();
			PCJSF_Support_VisibleState = state;
			PCJSF_Support_OnSizeOrStructureChanged();
		}
	}
	PCJSF_Support_JSSChanged();
}

var PCJSF_Support_OverrideWithFormState = false;

function PCJSF_Support_OpenForm(accountId, formName)
{
	PCJSF_Support_Form_AccountId = parseInt(accountId);
	PCJSF_Support_Form_Name = formName;
	PCJSF_Support_OverrideWithFormState = true;
	PCJSF_Support_UpdateState(false);
}

function PCJSF_Support_CloseForm()
{
	PCJSF_Support_OverrideWithFormState = false;
	PCJSF_Support_UpdateState(false);
}

function PCJSF_Support_Minimize()
{
	if(PCJSF_Support_PopupState != "opened")return;
	PCJSF_Support_PopupState = "minimized";
	PCJSF_Support_UpdateState(false);
}

function PCJSF_Support_Maximize()
{
	if(PCJSF_Support_PopupState != "minimized")return;
	PCJSF_Support_PopupState = "opened";
	PCJSF_Support_UpdateState(false);
}

function PCJSF_Support_Close()
{
	if((PCJSF_Support_PopupState == "closed") || (PCJSF_Support_PopupState == "embedded"))return;
	PCJSF_Support_PopupState = "closed";
	PCJSF_Support_UpdateState(false);
	PCJSF_Processor_RegisterRequest(0);
}

function PCJSF_Support_Open()
{
	if(PCJSF_Support_PopupState == "minimized")PCJSF_Support_Maximize();
	if(PCJSF_Support_PopupState == "opened")return;
	if(PCJSF_Support_PopupState == "embedded")return;
	PCJSF_Support_PopupState = "opened";
	PCJSF_Support_UpdateState(false);
}

function XtDirect_Open()
{
	PCJSF_Support_Open();
}

function XtDirect_IsOperatorAvailable()
{
	if(!PCJSF_Support_OperatorAvailableRetrieved)return -1;
	return PCJSF_Support_OperatorAvailable;
}

function XtDirect_SetConnectedCallback(callback)
{
	PCJSF_Support_ConnectedCallback = callback;
}

function XtDirect_SetAutoOpenCallback(callback)
{
	PCJSF_Support_AutoOpenCallback = callback;
}

function XtDirect_NotifyForEvent(event)
{
	PCJSF_Support_NotifyEventList += "," + event;
}

function XtDirect_GetUnreadMessageCount()
{
	return PCJSF_GetUnreadMessageCount();
}

function XtDirect_SetUnreadMessageCountChangedCallback(callback)
{
	PCJSF_Support_UnreadMessageCountChangedCallback = callback;
}

function ISL_ISF_UserOpenNormal()
{
	XtDirect_Open();
}

function PCJSF_Support_Cycle()
{
	if(PCJSF_Support_MasterDiv && (!PCJSF_Support_Moving) && (!PCJSF_Support_Resizing))
	{
		PCJSF_Support_UpdatePosition();
	}
}

function PCJSF_Support_PlayNotificationSound()
{
	if(!PCJSF_Support_EnableSoundAlarm)return;
	if(PCJSF_Support_SoundAlarmInactivePeriod > 0)
	{
		var maxTime = Math.max(PCJSF_Tracker_LastMouseTime, PCJSF_Tracker_LastKeyboardTime);
		if(((new Date).getTime() - maxTime) < PCJSF_Support_SoundAlarmInactivePeriod)return;
	}
	var url = PCJSF_Processor_ServerURL + "Public/alert";
	if(PCJSF_Support_NotificationSoundUrl != url)
	{
		PCJSF_Support_NotificationSoundUrl = url;
		if(typeof(Audio) == "function")
		{
			PCJSF_Support_NotificationSound = new Audio(PCJSF_Support_NotificationSoundUrl + ".mp3");
			if(PCJSF_Support_NotificationSound.canPlayType("audio/mpeg") == "")
			{
				if(PCJSF_Support_NotificationSound.canPlayType("audio/ogg") != "")
				{
					PCJSF_Support_NotificationSound = new Audio(PCJSF_Support_NotificationSoundUrl + ".ogg");
				}
				else
				{
					PCJSF_Support_NotificationSound = new Audio(PCJSF_Support_NotificationSoundUrl + ".wav");
				}
			}
		}
	}
	if(PCJSF_Support_NotificationSound)PCJSF_Support_NotificationSound.play();
}

if(window.XtDirect_Embedded)
{
	var PCJSF_Support_Width = 400;
	var PCJSF_Support_Height = 400;
	var PCJSF_Support_BorderColor = "#000000";
	if(window.XtDirect_Width)PCJSF_Support_Width = PCJSF_SafeParseInt(window.XtDirect_Width);
	if(window.XtDirect_Height)PCJSF_Support_Height = PCJSF_SafeParseInt(window.XtDirect_Height);
	if(isNaN(PCJSF_Support_Width))PCJSF_Support_Width = 400;
	if(isNaN(PCJSF_Support_Height))PCJSF_Support_Height = 400;
	if((PCJSF_Support_Width < 100) || (PCJSF_Support_Width > 2000))PCJSF_Support_Width = 400;
	if((PCJSF_Support_Height < 100) || (PCJSF_Support_Height > 2000))PCJSF_Support_Height = 400;
	if(window.XtDirect_BorderColor)PCJSF_Support_BorderColor = String(window.XtDirect_BorderColor);
	PCJSF_Support_PopupState = "embedded";
	if(window.XtDirect_ContainerDiv)
	{
		PCJSF_Support_ContainerDiv = window.XtDirect_ContainerDiv;
		if(window.XtDirect_ContainerDivDocument)PCJSF__Doc = window.XtDirect_ContainerDivDocument;
		if(window.XtDirect_ContainerDivWindow)PCJSF__Win = window.XtDirect_ContainerDivWindow;
	}
	else if(window.XtDirect_ContainerId)
	{
		PCJSF_Support_ContainerDiv = PCJSF__Doc.getElementById(window.XtDirect_ContainerId);
	}
	else
	{
		PCJSF__Doc.write(PCJSF_Support_GetEmbeddedContainerHTML	(false, PCJSF_Support_Width, PCJSF_Support_Height, PCJSF_Support_BorderColor));
		PCJSF_Support_ContainerDiv = PCJSF__Doc.getElementById("PCJSF_Support_ContainerDiv");
	}
}

PCJSF__Win["PCJSF_IntWin"] = window;
window["PCJSF_IntWin"] = window;

PCJSF__InitTracker();
PCJSF__InitChat();

setInterval("PCJSF_Support_Cycle()", PCJSF_Support_IsIE ? PCJSF_Support_CycleIEPeriod : PCJSF_Support_CyclePeriod);
var PCJSF_Processor_CommunicationState = "not_started";
var PCJSF_Processor_ServerURL = "";
var PCJSF_Processor_ConsequentErrors = 0;
var PCJSF_Processor_NextRequestTime = 0;
var PCJSF_Processor_NextRequestTimeout = null;
var PCJSF_Processor_SuspendNextRequestTimeoutChanges = 0;
var PCJSF_Processor_Handling = 0;
var PCJSF_Processor_Handling_Id = 0;

function PCJSF_Processor_Process()
{
	PCJSF_Processor_Handling++;
	PCJSF_Processor_Handling_Id = "Process" + PCJSF_Processor_CommunicationState;
	switch(PCJSF_Processor_CommunicationState)
	{
		case "not_started":
			var serverURL = PCJSF_LSGet("PCJSF_Processor_SURL");
			if(serverURL)
			{
				var index = serverURL.indexOf("_");
				if(index >= 0) {
					var time = parseFloat(serverURL.substr(0, index));
					var currentTime = (new Date()).getTime();
					if((time > currentTime) || (time > currentTime - PCJSF_Processor_ServerURLCookieLifetime * 3600 * 1000)) {
						serverURL = serverURL.substr(index + 1);
						PCJSF_Processor_ServerURL = serverURL;
						PCJSF_Processor_CommunicationState = "connect";
						PCJSF_Processor_Process();
						PCJSF_Processor_Handling--;
						return;
					}
				}
			}
			PCJSF_Processor_CommunicationState = "server_url";
			PCJSF_Processor_Process();
			break;
		
		case "server_url":
			var data = new Array();
			data["indentify"] = new Array();
			data["indentify"]["location"] = String(window.XtDirect_LocationOverride ? window.XtDirect_LocationOverride : PCJSF__Doc.location);
			PCJSF_Processor_CommunicationState = "wait_server_url";
			PCJSF_SendRequest(PCJSF_Processor_IdentifyServerURL + "Public/Identify.php", data, function(response){PCJSF_Processor_HandleServerURLResponse(response);}, PCJSF_Processor_IdentifyServerTimeout);
			break;
			
		case "wait_server_url":
			break;
			
		case "connect":
			var data = new Array();
			PCJSF_Processor_SuspendNextRequestTimeoutChanges = 1;
			PCJSF_Processor_CollectRequestData(true, data);
			PCJSF_Processor_SuspendNextRequestTimeoutChanges = 0;
			PCJSF_Processor_CommunicationState = "wait_connect";
			PCJSF_SendRequest(PCJSF_Processor_ServerURL + "Public/Processor.php", data, function(response){PCJSF_Processor_HandleResponse(true, response);}, PCJSF_Processor_ServerTimeout);
			break;
			
		case "wait_connect":
			break;
			
		case "cycle":
			if(PCJSF_Processor_NextRequestTimeout)clearTimeout(PCJSF_Processor_NextRequestTimeout);
			PCJSF_Processor_NextRequestTimeout = null;
			if(PCJSF_Processor_NextRequestTime == 0)
			{
				PCJSF_Processor_Handling--;
				return;
			}
			var currentTime = (new Date()).getTime();
			if(PCJSF_Processor_NextRequestTime <= currentTime)
			{
				PCJSF_Processor_CommunicationState = "cycle_send";
				PCJSF_Processor_Process();
				PCJSF_Processor_Handling--;
				return;
			}
			else
			{
				setTimeout("PCJSF_Processor_Process()", PCJSF_Processor_NextRequestTime - currentTime);
				PCJSF_Processor_Handling--;
				return;
			}
			break;
			
		case "cycle_send":
			var data = new Array();
			PCJSF_Processor_SuspendNextRequestTimeoutChanges = 1;
			PCJSF_Processor_CollectRequestData(false, data);
			PCJSF_Processor_SuspendNextRequestTimeoutChanges = 0;
			if(PCJSF_Processor_NextRequestTimeout)clearTimeout(PCJSF_Processor_NextRequestTimeout);
			PCJSF_Processor_NextRequestTimeout = null;
			PCJSF_Processor_NextRequestTime = 0;
			PCJSF_Processor_CommunicationState = "cycle_send_wait";
			PCJSF_SendRequest(PCJSF_Processor_ServerURL + "Public/Processor.php", data, function(response){PCJSF_Processor_HandleResponse(false, response);}, PCJSF_Processor_ServerTimeout);
			break;
			
		case "cycle_send_wait":
			break;
		
		case "wait_for_reconnect":
			setTimeout("PCJSF_Processor_CommunicationState = \"server_url\"; PCJSF_Processor_Process();", PCJSF_Processor_ReconnectTimeout);
			break;
	}
	PCJSF_Processor_Handling--;
}

function PCJSF_Processor_HandleServerURLResponse(response)
{
	PCJSF_Processor_Handling++;
	PCJSF_Processor_Handling_Id = "URLResponse";
	if(response != null)
	{
		var identifyInfo = (response["indentify"] !== undefined) ? response["indentify"] : null;
		if(identifyInfo)
		{
			var result = (identifyInfo["result"] !== undefined) ? identifyInfo["result"] : "";
			if(result === "not_found")
			{
				PCJSF_Processor_CommunicationState = "idle";
				PCJSF_Processor_Handling--;
				return;
			}
			else if(result === "found")
			{
				if(identifyInfo["location"] !== undefined)
				{
					PCJSF_Processor_ConsequentErrors = 0;
					PCJSF_Processor_ServerURL = identifyInfo["location"];
					PCJSF_LSSet("PCJSF_Processor_SURL", (new Date()).getTime() + "_" + PCJSF_Processor_ServerURL);
					PCJSF_Processor_CommunicationState = "connect";
					PCJSF_Processor_Process();
					PCJSF_Processor_Handling--;
					return;
				}
			}
		}
	}
	PCJSF_Processor_CommunicationState = "server_url";
	PCJSF_Processor_Process();
	PCJSF_Processor_Handling--;
}

function PCJSF_Processor_HandleResponse(connecting, response)
{
	PCJSF_Processor_Handling++;
	PCJSF_Processor_Handling_Id = "Response";
	if(response != null)
	{
		PCJSF_Processor_SuspendNextRequestTimeoutChanges = 1;
		var handlingResult = PCJSF_Processor_HandleResponseData(connecting, response);
		PCJSF_Processor_SuspendNextRequestTimeoutChanges = 0;
		if(handlingResult == 1)
		{
			PCJSF_Processor_ConsequentErrors = 0;
			PCJSF_Processor_CommunicationState = "cycle";
			PCJSF_Processor_Process();
			PCJSF_Processor_Handling--;
			return;
		}
	}
	PCJSF_Processor_ConsequentErrors++;
	if(PCJSF_Processor_ConsequentErrorsToReconnect == PCJSF_Processor_ConsequentErrors)
	{
		PCJSF_Processor_ServerURL = "";
		PCJSF_Processor_CommunicationState = "wait_for_reconnect";
		PCJSF_Processor_Process();
		PCJSF_Processor_Handling--;
		return;
	}
	PCJSF_Processor_CommunicationState = "wait_for_reconnect";
	PCJSF_Processor_Process();
	PCJSF_Processor_Handling--;
}

function PCJSF_Processor_RegisterRequest(delay)
{
	var currentTime = (new Date()).getTime();
	var nextRequestTime = currentTime + delay;
	var changed = 0;
	if((PCJSF_Processor_NextRequestTime == 0) || (nextRequestTime < PCJSF_Processor_NextRequestTime))
	{
		PCJSF_Processor_NextRequestTime = nextRequestTime;
		changed = 1;
	}
	if((changed) && (PCJSF_Processor_CommunicationState == "cycle") && (PCJSF_Processor_SuspendNextRequestTimeoutChanges == 0))PCJSF_Processor_Process();
}

function PCJSF_Processor_CollectRequestData(connecting, data)
{
	PCJSF_Tracker_CollectRequestData(connecting, data);
	PCJSF_Support_CollectRequestData(connecting, data);
	PCJSF_Chat_CollectRequestData(connecting, data);
}

function PCJSF_Processor_HandleResponseData(connecting, response)
{
	var result = 1;
	if(PCJSF_Tracker_HandleResponseData(connecting, data) == 0)result = 0;
	if(PCJSF_Support_HandleResponseData(connecting, data) == 0)result = 0;
	if(PCJSF_Chat_HandleResponseData(connecting, data) == 0)result = 0;
	return result;
}

function PCJSF_Processor_Guard()
{
	if(PCJSF_Processor_Handling > 0)
	{
		PCJSF_Processor_Handling = 0;
		PCJSF_Processor_CommunicationState = "not_started";
		PCJSF_Processor_Process();
	}
}

setTimeout(function(){
    var PCJSF_ScriptContainerElement = document.createElement("div");
    PCJSF_ScriptContainerElement.setAttribute("id", "PCJSF_ScriptContainer");
    PCJSF_ScriptContainerElement.style.display = "none";
    document.body.appendChild(PCJSF_ScriptContainerElement);

    PCJSF_Processor_Process();
}, 50);

setInterval("PCJSF_Processor_Guard();", 5000);
