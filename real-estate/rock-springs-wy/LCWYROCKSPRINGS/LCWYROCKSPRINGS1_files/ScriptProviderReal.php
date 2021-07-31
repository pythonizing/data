




/*
     FILE ARCHIVED ON 22:08:06 Dec 15, 2015 AND RETRIEVED FROM THE
     INTERNET ARCHIVE ON 21:30:05 Aug 11, 2016.
     JAVASCRIPT APPENDED BY WAYBACK MACHINE, COPYRIGHT INTERNET ARCHIVE.

     ALL OTHER CONTENT MAY ALSO BE PROTECTED BY COPYRIGHT (17 U.S.C.
     SECTION 108(a)(3)).
*/
var pc_s =
	new Array(	'0','1','2','3','4','5','6','7','8','9',
				'a','b','c','d','e','f','g','h','i','j',
				'k','l','m','n','o','p','q','r','s','t',
				'u','v','x','y','z','A','B','C','D','E',
				'F','G','H','I','J','K','L','M','N','O',
				'P','Q','R','S','T','U','V','W','X','Y',
				'Z','@','^','~');

var pc_t = new Array();
var pc_u = "a".charCodeAt(0);
var pc_v = "z".charCodeAt(0);
var pc_w = "A".charCodeAt(0);
var pc_x = "Z".charCodeAt(0);
var pc_y = "0".charCodeAt(0);
var pc_z = "9".charCodeAt(0);
var pc_A = " ".charCodeAt(0);

function pc_B(pc_C)
{
	var D;
	for(D = 0; D < 128; D++)pc_t.push(0);
	for(D = 0; D < pc_s.length; D++)pc_t[pc_s[D].charCodeAt(0)] = D;
}

pc_B();

function pc_E(pc_C)
{
	return 	((pc_C >= pc_u) && (pc_C <= pc_v)) ||
			((pc_C >= pc_w) && (pc_C <= pc_x)) ||
			((pc_C >= pc_y) && (pc_C <= pc_z)) ||
			(pc_C == pc_A);
}

function pc_F(pc_G)
{
    var H = "";
	var pc_I = 0;
	for(var D = 0; D < pc_G.length; D++)
	{
		var J = pc_I;
	    var pc_C = pc_G.charCodeAt(D) % 131072;
		var K = pc_E(pc_C);
		if(pc_I == 0)
		{
			if(!K)
			{
				J = 1;
				if((D + 1 < pc_G.length) && (!pc_E(pc_G.charCodeAt(D + 1))))
				{
					H += "*";
					pc_I = 1;
				}
				else
				{
					H += "%";
				}
			}
		}
		else
		{
			if(K && (D + 1 < pc_G.length) && (pc_E(pc_G.charCodeAt(D + 1))))
			{
				H += "!";
				J = pc_I = 0;
			}
		}
		if(J)
		{
			if(pc_C < 2048)
			{
				H += pc_s[pc_C % 64];
				H += pc_s[pc_L(pc_C / 64)];
			}
			else
			{
				H += pc_s[pc_C % 64];
				H += pc_s[32 + (pc_L(pc_C / 64) % 32)];
				H += pc_s[pc_L(pc_C / 2048)];
			}
		}
		else
		{
			H += (pc_C == pc_A) ? "_" : pc_G.charAt(D);
		}
	}
	return H;
}

function pc_M(pc_G)
{
	var N = "";
	var pc_I = 0;
	var D = 0;
	while(D < pc_G.length)
	{		
		var O  = pc_I;
		var P = pc_G.charAt(D);
		if(pc_I == 0)
		{
			if(P == "*")
			{
				O = pc_I = 1;
				D++;
				continue;
			}
			else if(P == "%")
			{
				O = 1;
				D++;
			}
		}
		else
		{
			if(P == "!")
			{
				O = pc_I = 0;
				D++;
				continue;
			}
		}
		if(O)
		{
			if(D + 1 < pc_G.length)
			{
				var Q = pc_t[pc_G.charCodeAt(D)];
				var R = pc_t[pc_G.charCodeAt(D + 1)];
				D += 2;
				if(R < 32)
				{
					N += String.fromCharCode(Q + R * 64);
				}
				else if(D < pc_G.length)
				{
					var S = pc_t[pc_G.charCodeAt(D)];
					D++;
					N += String.fromCharCode(Q + (R - 32) * 64 + S * 2048);
				}
				else break;
			}
			else break;
		}
		else
		{
			N += (P == "_") ? " " : P;
			D++;
		}
	}
	return N;
}

var pc_T = "/web/20151215220806/http://chat.xtdirect.com/Chat/MasterServer/";
var pc_U = "/web/20151215220806/http://xtdirect.com";


var pc_V = 15000;


var pc_W = 15000;


var pc_X = 15000;


var pc_Y = 2;


var pc_Z = 5;


var pc_a = 8000;


var pc_b = 100;


var pc_c = 500;


var pc_d = 200;


var pc_e = 500;


var pc_f = 100;


var pc_g = 500;


var pc_h = 100;


var pc_i = 5000;

var pc_j = true;


pc_k = 100;
pc_l = 30;
pc_m = 8000;
pc_n = 8000;
pc_o = 2000;
pc_p = 8000;
pc_q = 30;
pc_rs = 5000;

PCJSF_Chat_MTStyle = "font-family:Tahoma;font-size:11px;font-weight:bold;color:#000000;";
PCJSF_Chat_MCStyle = "font-family:Tahoma;font-size:12px;font-weight:bool;color:#000000;";
PCJSF_Chat_OTStyle = "font-family:Tahoma;font-size:11px;font-weight:bold;color:#1f5d67;";
PCJSF_Chat_OCStyle = "font-family:Tahoma;font-size:12px;font-weight:bool;color:#000000;";

var pc_ss = document;
var pc_ts = window;

var pc_us = false;
var pc_vs = false;
var pc_ws = false;
var pc_xs = false;

function pc_ys() {
	var zs = window.navigator.standalone,
		As = window.navigator.userAgent.toLowerCase(),
		Bs = (new RegExp("safari", "")).test( As ),
		Cs = (new RegExp("iphone|ipod|ipad", "")).test( As );
	if(Cs) {
		pc_us = true;
		if (!zs && Bs)pc_vs = true;
		else if (zs && !Bs)pc_ws = true;
		else if (!zs && !Bs)pc_xs = true;
	}
}

pc_ys();

function pc_L(pc_Ds)
{
	var Es = parseInt(pc_Ds);
	return isNaN(Es) ? 0 : Es;
}

function PCJSF_Trim(pc_Fs)
{
	while(pc_Fs.length > 0)
	{
		var Gs = pc_Fs.charAt(0);
		if((Gs == "\r") || (Gs == "\n") || (Gs == " "))pc_Fs = pc_Fs.substr(1);else break;
	}
	while(pc_Fs.length > 0)
	{
		var Gs = pc_Fs.charAt(pc_Fs.length - 1);
		if((Gs == "\r") || (Gs == "\n") || (Gs == " "))pc_Fs = pc_Fs.substr(0, pc_Fs.length - 1);else break;
	}
	return pc_Fs;
}

function pc_Hs(pc_Fs, pc_Is)
{
	pc_Fs = String(pc_Fs);
	while(pc_Fs.length < pc_Is)pc_Fs = "0" + pc_Fs;
	return pc_Fs;
}

function pc_Js()
{
	var Es = {};
	Es.width = 0;
	Es.height = 0;
	if(pc_Ks && typeof(pc_ts.innerWidth) == 'number')
	{ 
		Es.width = pc_ts.innerWidth;
		Es.height = pc_ts.innerHeight;
	} 
	else if(pc_ss.documentElement && (pc_ss.documentElement.clientWidth || pc_ss.documentElement.clientHeight))
	{
		Es.width = pc_ss.documentElement.clientWidth;
		Es.height = pc_ss.documentElement.clientHeight;
	} 
	else if(pc_ss.body && (pc_ss.body.clientWidth || pc_ss.body.clientHeight)) {
		Es.width = pc_ss.body.clientWidth;
		Es.height = pc_ss.body.clientHeight;
	}
	else if(typeof(pc_ts.innerWidth) == 'number')
	{ 
		Es.width = pc_ts.innerWidth;
		Es.height = pc_ts.innerHeight;
	} 
	return Es;
}

function pc_Ls()
{
	var Es = {};
	Es.x = 0;
	Es.y = 0;
	if(self.pageYOffset)
	{
		Es.x = self.pageXOffset;
		Es.y = self.pageYOffset;
	}
	else if(pc_ss.documentElement && pc_ss.documentElement.scrollTop)
	{
		Es.x = pc_ss.documentElement.scrollLeft;
		Es.y = pc_ss.documentElement.scrollTop;
	}
	else if(pc_ss.body)
	{
		Es.x = pc_ss.body.scrollLeft;
    	Es.y = pc_ss.body.scrollTop;
	}
	return Es;
}

function pc_Ms(pc_Ns)
{
	if(pc_Ns.pageX || pc_Ns.pageY)return {Os:pc_Ns.pageX, Ps:pc_Ns.pageY};
	return {Os:pc_Ns.clientX + pc_ss.body.scrollLeft - pc_ss.body.clientLeft, Ps:pc_Ns.clientY + pc_ss.body.scrollTop  - pc_ss.body.clientTop};
}

function pc_Qs(pc_Rs)
{
	var Ss = "";
	for(var D = 0; D < pc_Rs.length; D++)
	{
		var P = pc_Rs.charAt(D);
		if((P == "\\") || (P == ",") || (P == ")") || (P == ";"))
		{
			if(P == "\\")Ss += "\\\\";
			else if(P == ",")Ss += "\\c";
			else if(P == ";")Ss += "\\d";
			else if(P == ")")Ss += "\\b";
		}
		else Ss += P;
	}
	return Ss;
}

function pc_Ts(pc_Fs)
{
	var Es = "";
	var pc_Us = 0;
	while(pc_Us < pc_Fs.length)
	{
		var Vs = pc_Fs.indexOf("\\", pc_Us);
		if(Vs < 0)break;
		Es += pc_Fs.substr(pc_Us, Vs - pc_Us);
		pc_Us = Vs + 1;
		if(pc_Us < pc_Fs.length)
		{
			var Ws = pc_Fs.charAt(pc_Us);
			pc_Us++;
			if(Ws == "\\")Es += "\\";
			else if(Ws == "c")Es += ",";
			else if(Ws == "d")Es += ";";
			else if(Ws == "b")Es += ")";
			else
			{
				Es += "\\";
				pc_Us--;
			}
		}
		else Es += "\\";
	}
	if(pc_Us < pc_Fs.length)Es += pc_Fs.substr(pc_Us);
	return Es;
}

function pc_Xs(pc_Ys)
{
	if(pc_Ys.length == 0)return "";
	var Zs = pc_L(pc_Ys[0]);
	var as = pc_bs + "," + Zs + ":";
	for(var D = 0; D < pc_Ys.length; D += 4)
	{
		var cs = pc_Ys[D];
		var ds = pc_Ys[D + 1];
		var es = pc_Ys[D + 2];
		var fs = pc_Ys[D + 3];
		as +=	ds + (cs - Zs) +
					"(" + ((es !== null) ? pc_Qs(String(es)) : "") +
					((fs !== null) ? ("," + pc_Qs(String(fs))) : "") + ")";
	}
	return as;
}

function pc_gs(pc_hs, pc_is)
{
	pc_js(pc_ss.getElementById(pc_hs), pc_is);
}

function pc_js(pc_hs, pc_is)
{
	if(!pc_hs)return;
	if (typeof pc_hs.onselectstart != "undefined")
	{
		pc_hs.onselectstart = function(){return false;}
	}
	else if (typeof pc_hs.style.MozUserSelect != "undefined")
	{
		pc_hs.style.MozUserSelect="none";
	}
	else
	{
		pc_hs.onmousedown=function(){return false;}
	}
	pc_hs.style.cursor = pc_is;
}

function PCJSF_StopBubbling(pc_Ns)
{
	if(pc_Ns && pc_Ns.stopPropagation)
	{
		pc_Ns.stopPropagation();
	}
	else
	{
		pc_Ns.cancelBubble=true;
	}
}

function pc_ks(pc_ls)
{
	var ms = new Array();
	var ns = 0;
	var os = "";
	var ps = "";
	var D = 0;
	while(D < pc_ls.length)
	{
		var qs = pc_ls.charAt(D);
		var pc_C = pc_ls.charCodeAt(D);
		D++;
		switch(ns)
		{
			case 0:
				if(qs == ";")
				{
					if(os.length > 0)ms[os] = "";
					os = "";
				}
				else if(qs == ":")ns = 1;
				else if(pc_C > 32)os += qs;
				break;
			case 1:
				if(qs == ";")
				{
					if(os.length > 0)ms[os] = ps;
					os = "";
					ps = "";
					ns = 0;
				}
				else ps += qs;
				break;
		}
	}
	if(os.length > 0)ms[os] = ps;
	var rt = "";
	if((ms["margin"] == undefined) && (ms["margin-left"] == undefined))rt += "margin:0px;";
	if((ms["padding"] == undefined) && (ms["padding-left"] == undefined))rt += "padding:0px;";
	if((ms["border"] == undefined) && (ms["border-left"] == undefined))rt += "border:0px solid;";
	if(ms["line-height"] == undefined)rt += "line-height:100%;";
	if(ms["text-align"] == undefined)rt += "text-align:left;";
	if(ms["vertical-align"] == undefined)rt += "vertical-align:middle;";
	if(ms["text-shadow"] == undefined)rt += "text-shadow:none;";
	if((ms["background"] == undefined) && (ms["background-image"] == undefined))rt += "background:transparent;";
	return rt;
}

function pc_st(pc_tt, pc_ut, pc_vt, pc_wt, pc_xt, pc_yt, pc_ls, pc_zt, pc_At)
{
	return "<" + pc_tt + (pc_ut ? (" id=\"" + pc_ut + "\" "): "") +" style=\"font-family:'" + pc_vt + "';font-size:" + pc_wt + ";color:" + pc_xt + ";font-weight:" + pc_yt + ";font-style:" + pc_ls + ";text-decoration: none;" + pc_At + "\">" + pc_zt + "</" + pc_tt + ">";
}

var pc_Bt = 0;
var pc_Ct = new Array();
var pc_Dt = true;

function pc_Et(pc_Ft, pc_Gt, pc_ls, pc_Ht, pc_It, pc_zt, pc_Jt)
{
	pc_Bt++;
	var Kt = {};
	Kt.width = pc_Ft;
	Kt.height = pc_Gt;
	Kt.style = pc_ls;
	Kt.img = pc_Ht;
	Kt.imgHOver = pc_It;
	Kt.text = pc_zt;
	Kt.func = pc_Jt;
	pc_Ct[pc_Bt] = Kt;
	var pc_Lt = "";
	pc_Lt += "<div id=\"PCJSF_ButtonDiv" + pc_Bt + "\"";
	if(pc_Dt)
	{
		pc_Lt += " onmouseover=\"PCJSF_IntWin.PCJSF_BuildOver(" + pc_Bt + ");\"";
		pc_Lt += " onmouseout=\"PCJSF_IntWin.PCJSF_BuildOut(" + pc_Bt + ");\"";
	}
	pc_Lt += " onmousedown=\"PCJSF_IntWin.PCJSF_StopBubbling(event); PCJSF_IntWin.PCJSF_ButtonOnClick(" + pc_Bt + "); return false;\" style=\"float:left;\">";
	pc_Lt += "<table id=\"PCJSF_ButtonTable" + pc_Bt + "\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"" + pc_Mt(pc_Ht, pc_Ft, pc_Gt, pc_ls) + "\">";
	pc_Lt += "<tr><td id=\"PCJSF_ButtonText" + pc_Bt + "\" align=\"center\" style=\"padding:" + pc_Nt + "px;padding-top:" + (pc_Nt - 4) + "px;;vertical-align:middle;\">";
	if(pc_zt != null)pc_Lt += pc_zt;else pc_Lt += "";
	pc_Lt += "</td></tr></table></div>";
	return pc_Lt;
}

function pc_Mt(pc_Ht, pc_Ft, pc_Gt, pc_Ot)
{
	var pc_ls = "";
	pc_ls += ((pc_Ft != null) ? ("width:" + pc_Ft + "px;") : "") + "height:" + pc_Gt + "px;cursor:hand;cursor:pointer;margin:0px;";
	if(pc_Ht)
	{
		pc_ls += "background-image:url(" + pc_Ht + ");background-repeat:no-repeat;";
	}
	pc_ls += pc_Ot;
	if((pc_ls != "") && (pc_ls[pc_ls.length - 1] != ";"))pc_ls += ";";
	pc_ls += pc_ks(pc_ls);
	return pc_ls;
}

function pc_Pt(pc_zt, pc_Jt)
{
	return pc_Et(null, 17, "border:" + PCJSF_Support_ButtonBorder + ";background:" + PCJSF_Support_ButtonBackground + ";", null, null,
		pc_st(
			"span", null,
			PCJSF_Support_Font, PCJSF_Support_ButtonTextSize, PCJSF_Support_ButtonColor, "bold", "normal", pc_zt),
		pc_Jt);
}

function PCJSF_BuildOver(pc_Us)
{
	var pc_Qt = pc_Ct[pc_Us];
	var pc_Ht = pc_Qt.imgHOver;
	if(pc_Ht == null)pc_Ht = pc_Qt.img;
	var Rt = pc_ss.getElementById("PCJSF_ButtonTable" + pc_Us);
	Rt.setAttribute("style", pc_Mt(pc_Ht, pc_Qt.width, pc_Qt.height, pc_Qt.style));
}

function PCJSF_BuildOut(pc_Us)
{
	var pc_Qt = pc_Ct[pc_Us];
	var pc_Ht = pc_Qt.img;
	var Rt = pc_ss.getElementById("PCJSF_ButtonTable" + pc_Us);
	Rt.setAttribute("style", pc_Mt(pc_Ht, pc_Qt.width, pc_Qt.height, pc_Qt.style));
}

function pc_St(pc_Us, pc_Ft, pc_Gt, pc_Ht, pc_It, pc_zt, pc_Tt, pc_Jt)
{
	var pc_Qt = pc_Ct[pc_Us];
	var Kt = {};
	Kt.width = pc_Ft;
	Kt.height = pc_Gt;
	Kt.style = pc_Qt.style;
	Kt.img = pc_Ht;
	Kt.imgHOver = pc_It;
	Kt.text = pc_zt;
	Kt.textHOver = pc_Tt;
	Kt.func = pc_Jt;
	pc_Ct[pc_Us] = Kt;
	var Rt = pc_ss.getElementById("PCJSF_ButtonTable" + pc_Us);
	Rt.setAttribute("style", pc_Mt(pc_Ht, pc_Qt.width, pc_Qt.height, pc_Qt.style));
	var Ut = pc_ss.getElementById("PCJSF_ButtonText" + pc_Us);
	if(pc_zt != null)Ut.innerHTML = pc_Vt(pc_zt);else Ut.innerHTML = "";
}

function PCJSF_ButtonOnClick(pc_Us)
{
	var pc_Jt = pc_Ct[pc_Us].func;
	if(pc_Jt)pc_Jt();
}

function pc_Wt(pc_Xt)
{
	var pc_ls = "";
	if(pc_Xt < 95)
	{
		if(pc_Yt)
		{
			pc_ls += "filter: alpha(opacity=" + pc_L(pc_Xt) + ");";
			pc_ls += "filter:progid:DXImageTransform.Microsoft.Alpha(opacity=" + pc_L(pc_Xt) + ");";
		}
		else
		{
			pc_ls += "opacity: " + (pc_Xt / 100.0) + ";";
		}
	}
	return pc_ls;
}

function pc_Zt(pc_at)
{
	var bt = pc_at.split(",");
	for(var D = 0; D < bt.length; D++)
	{
		bt[D] = pc_Ts(bt[D]);
	}
	return bt;
}

function pc_Vt(pc_Lt)
{	
	var rt = "";
	var ns = 0;
	var	D = 0;
	var pc_tt = "";
	var ct = "";
	var dt = "";
	var et = false;
	while(D < pc_Lt.length)
	{
		var ft = false;
		var qs = pc_Lt.charAt(D);
		var pc_C = pc_Lt.charCodeAt(D);
		D++;
		switch(ns)
		{
			case 0:
				if(qs == "<")ns = 10;
				break;
			case 10:
				if(pc_C <= 32)ns = 11;
				else if(qs == ">"){ ft = true; ns = 0; }
				else pc_tt += qs;
				break;
			case 11:			
				if(qs == ">"){ ft = true; ns = 0; }
				else if((pc_C <= 32) || (qs == "="))
				{
					if(ct.length > 0)ns = (qs == "=") ? 13 : 12;
				}
				else ct += qs;
				break;
			case 12:
				if(qs == "=")ns=13;
				break;
			case 13:
				if(qs == "\"")ns=14;
				break;
			case 14:
				if(qs == "\"")
				{
					if(ct == "style")
					{
						if(rt[rt.length - 1] != ";")rt += ";";
						rt += pc_ks(dt);
						et = true;
					}
					ns = 11;
					ct = "";
					dt = "";
				}
				else
				{
					dt += qs;
					if(qs == "\\")ns = 15;
				}
				break;
			case 15:
				dt += qs;
				ns = 14;
				break;
		}
		if(ft)
		{
			if((!et) && (pc_tt.indexOf("/") != 0))rt += " style=\"" + pc_ks("") + "\" ";
			ns = 0;
			pc_tt = "";
			et = false;
		}
		rt += qs;
	}
	return rt;
}

function pc_gt(pc_ht)
{
    return (new RegExp("boolean|number|string", "")).test(typeof pc_ht);
}

function pc_it(pc_jt)
{
	return typeof(pc_jt)=='object'&&(pc_jt instanceof Array);
}

function pc_kt(pc_lt) {
	var mt = pc_lt.parentNode && ((pc_lt.parentNode == pc_ss) || !((typeof(nt) !== 'undefined') && (pc_lt.parentNode instanceof nt)));
	var pc_Ft = (pc_lt.style.width.indexOf("%") >= 0) ? 0 : parseInt(pc_lt.style.width);
	var pc_Gt = (pc_lt.style.height.indexOf("%") >= 0) ? 0 : parseInt(pc_lt.style.height);
	if((pc_Ft > 0) && (pc_Gt > 0))return [pc_Ft, pc_Gt];
	if(mt && (pc_lt.offsetWidth > 0) && (pc_lt.offsetHeight > 0))return [pc_lt.offsetWidth, pc_lt.offsetHeight];
	else {
		if(mt)return [pc_lt.offsetWidth, pc_lt.offsetHeight];
		var ot = pc_lt.style.visibility;
		var pt = pc_lt.style.position;
		pc_lt.style.visibility = "hidden";
		pc_lt.style.position = "absolute";
		pc_ss.body.appendChild(pc_lt);
		var pc_wt = [pc_lt.offsetWidth, pc_lt.offsetHeight];
		pc_ss.body.removeChild(pc_lt);
		pc_lt.style.visibility = ot;
		pc_lt.style.position = pt;
		return pc_wt;
	}
}

function pc_qt(pc_lt, pc_ru, pc_su, pc_tu, pc_uu, pc_Ft, pc_Gt) {
	var vu = (pc_Ft > 0) ? [pc_Ft, pc_Gt] : null;
	var wu = null;
	if(!vu)vu = pc_kt(pc_lt);
	if(!wu)wu = pc_Js();
	if(pc_ru == 0) {
		if(wu.width - vu[0] - pc_tu < 0)pc_tu = wu.width - vu[0];
		if(pc_tu < 0)pc_tu = pc_tu;
		pc_lt.style.left = pc_tu + "px";
		pc_lt.style.right = "";
	}
	else if(pc_ru == 1) {
		var xu = (Math.floor((wu.width - vu[0]) / 2) + pc_tu);
		if(xu + vu[0] > wu.width)xu = wu.width - vu[0];
		if(xu < 0)xu = 0;
		pc_lt.style.left = (Math.floor((wu.width - vu[0]) / 2) + pc_tu) + "px";
		pc_lt.style.right = "";		
	}
	else {
		if(wu.width - vu[0] - pc_tu < 0)pc_tu = wu.width - vu[0];
		if(pc_tu < 0)pc_tu = 0;
		pc_lt.style.left = "";
		pc_lt.style.right = pc_tu + "px";
	}
	if(pc_su == 0) {
		if(wu.height - vu[1] - pc_uu < 0)pc_uu = wu.height - vu[1];
		if(pc_uu < 0)pc_uu = pc_uu;
		pc_lt.style.top = pc_uu + "px";
		pc_lt.style.bottom = "";
	}
	else if(pc_su == 1) {
		var xu = (Math.floor((wu.height - vu[1]) / 2) + pc_uu);
		if(xu + vu[1] > wu.height)xu = wu.height - vu[1];
		if(xu < 0)xu = 0;
		pc_lt.style.top = (Math.floor((wu.height - vu[1]) / 2) + pc_uu) + "px";
		pc_lt.style.bottom = "";		
	}
	else {
		if(wu.height - vu[1] - pc_uu < 0)pc_uu = wu.height - vu[1];
		if(pc_uu < 0)pc_uu = 0;
		pc_lt.style.top = "";
		pc_lt.style.bottom = pc_uu + "px";
	}
}

function pc_yu(pc_zu)
{
	var Au = new RegExp("^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$", "");
	return Au.test(pc_zu);
}

function pc_Bu(pc_Cu)
{
	if(pc_Cu.indexOf("http://") == 0)return true;
	if(pc_Cu.indexOf("https://") == 0)return true;
	return false;
}

function pc_Du(pc_lt, pc_ls, pc_Ds)
{
	if(pc_lt.style[pc_ls] != pc_Ds)pc_lt.style[pc_ls] = pc_Ds;
}

function pc_Eu(pc_lt, pc_Fu, pc_Ds)
{
	if(pc_lt.getAttribute(pc_Fu) != pc_Ds)pc_lt.setAttribute(pc_Fu, pc_Ds);
}

function pc_Gu() {
	var Hu = false;
	(function(Iu){
		if(
		(new RegExp("(android|bb\d+|meego).+mobile|avantgo|bada\\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino", "i")).test(Iu)||
		(new RegExp("1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\\-(n|u)|c55\\/|capi|ccwa|cdm\\-|cell|chtm|cldc|cmd\\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\\-s|devi|dica|dmob|do(c|p)o|ds(12|\\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\\-|_)|g1 u|g560|gene|gf\\-5|g\\-mo|go(\\.w|od)|gr(ad|un)|haie|hcit|hd\\-(m|p|t)|hei\\-|hi(pt|ta)|hp( i|ip)|hs\\-c|ht(c(\\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\\-(20|go|ma)|i230|iac( |\\-|\\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\\/)|klon|kpt |kwc\\-|kyo(c|k)|le(no|xi)|lg( g|\\/(k|l|u)|50|54|\\-[a-w])|libw|lynx|m1\\-w|m3ga|m50\\/|ma(te|ui|xo)|mc(01|21|ca)|m\\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\\-2|po(ck|rt|se)|prox|psio|pt\\-g|qa\\-a|qc(07|12|21|32|60|\\-[2-7]|i\\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\\-|oo|p\\-)|sdk\\/|se(c(\\-|0|1)|47|mc|nd|ri)|sgh\\-|shar|sie(\\-|m)|sk\\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\\-|v\\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\\-|tdg\\-|tel(i|m)|tim\\-|t\\-mo|to(pl|sh)|ts(70|m\\-|m3|m5)|tx\\-9|up(\\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\\-|your|zeto|zte\\-", "i")).test(Iu.substr(0,4)))
		Hu = true
	})(navigator.userAgent||navigator.vendor||window.opera);
	return Hu;
}

var pc_Ks = pc_Gu();

function pc_Ju(pc_zt)
{
	pc_zt = pc_zt.replace(new RegExp("&", "g"), "&amp;");
	pc_zt = pc_zt.replace(new RegExp("<", "g"), "&lt;");
	pc_zt = pc_zt.replace(new RegExp(">", "g"), "&gt;");
	pc_zt = pc_zt.replace(new RegExp("\"", "g"), "&quot;");
	pc_zt = pc_zt.replace(new RegExp("'", "g"), "&#39;");
	pc_zt = pc_zt.replace(new RegExp("\\/", "g"), "&#x2F;");
	pc_zt = pc_zt.replace(new RegExp("\\r", "g"), "");
	pc_zt = pc_zt.replace(new RegExp("\\n", "g"), "<br />");
	return pc_zt;
}

function pc_Ku(pc_zt)
{
	pc_zt = pc_zt.replace(new RegExp("&lt;", "g"), "<");
	pc_zt = pc_zt.replace(new RegExp("&gt;", "g"), ">");
	pc_zt = pc_zt.replace(new RegExp("&quot;", "g"), "\"");
	pc_zt = pc_zt.replace(new RegExp("&#39;", "g"), "'");
	pc_zt = pc_zt.replace(new RegExp("&#x2F;", "g"), "/");
	pc_zt = pc_zt.replace(new RegExp("<br \\/>", "g"), "\r\n");
	pc_zt = pc_zt.replace(new RegExp("&amp;", "g"), "&");
	return pc_zt;
}

function pc_Lu(pc_lt) {
	while (pc_lt.firstChild)pc_lt.removeChild(pc_lt.firstChild);
}

var pc_Mu = (pc_ss.styleSheets.length > 0) ? pc_ss.styleSheets[0] : null;

if(pc_Mu == null)
{
	(function() {
		try
		{
			var pc_ls = pc_ss.createElement("style");
			pc_ls.appendChild(pc_ss.createTextNode(""));
			pc_ss.head.appendChild(pc_ls);
			pc_Mu = pc_ls.sheet;
		}
		catch(Nu)
		{
		}
	}) ();
}
	
function pc_Ou(pc_Pu, pc_ls) {
	try
	{
		if(pc_Mu.insertRule)
			pc_Mu.insertRule(pc_Pu + '{' + pc_ls + '}', pc_Mu.cssRules.length);
		else
			pc_Mu.addRule(pc_Pu, pc_ls, -1);
	}
	catch(Nu)
	{
	}
}

var pc_Qu = 0;

/*pc_Ru*/function pc_Su(/*string*/pc_Tu, /*string*/pc_Uu) {
	var Vu = this;
	pc_Qu++;
	var Wu = pc_Qu;
	var Xu = pc_Tu;
	this.GetName = function() { return Xu; };
	pc_Ou("@font-face", 
		"font-family: '" + pc_Tu + "';" +
		"src: url('" + pc_Uu + "/" + pc_Tu + "/" + pc_Tu + ".ttf');" + 
		"src: url('" + pc_Uu + "/" + pc_Tu + "/" + pc_Tu + ".woff') format('woff'),  url('" + pc_Uu + "/" + pc_Tu + "/" + pc_Tu + ".ttf') format('truetype'),  url('" + pc_Uu + "/" + pc_Tu + "/" + pc_Tu + ".svg') format('svg');" +
		"font-weight: normal;" +
		"font-style: normal;");
}

var pc_Yu = {};

/*pc_Ru*/function pc_Zu(/*string*/pc_Tu, /*string*/pc_Uu) {
	var pc_vt = pc_Yu[pc_Tu];
	if(pc_vt)return pc_vt;
	pc_vt = new pc_Su(pc_Tu, pc_Uu);
	pc_Yu[pc_Tu] = pc_vt;
	return pc_vt;
}

function pc_Lu(pc_lt)
{
	while(pc_lt.firstChild)pc_lt.removeChild(pc_lt.firstChild);
}

var pc_au = false;

function pc_bu(pc_cu, pc_Ds)
{
	if(!pc_au)
	{
		try
		{
			localStorage.setItem(pc_cu, pc_Ds);
			return;
		}
		catch(Nu)
		{
		}
	}
	var date = new Date();
	date.setTime(date.getTime()+(8760*60*60*1000));
	var du = "; expires="+date.toGMTString();
	document.cookie = pc_cu+"="+pc_Ds+du+"; path=/";
}

function pc_eu(pc_cu)
{
	if(!pc_au)
	{
		try
		{
			var Es = localStorage.getItem(pc_cu);
			if(Es)return Es;
		}
		catch(Nu)
		{
		}
	}
	var fu = pc_cu + "=";
	var gu = document.cookie.split(';');
	for(var D = 0; D < gu.length; D++)
	{
		var Gs = PCJSF_Trim(gu[D]);
		if (Gs.indexOf(fu) == 0)
		{
			return PCJSF_Trim(Gs.substr(fu.length));
		}
	}
	return null;
}

function pc_hu(pc_cu)
{
	if(!pc_au)
	{
		try
		{
			localStorage.removeItem(pc_cu);
		}
		catch(Nu)
		{
		}
	}
	var date = new Date();
	date.setTime(date.getTime() - (60*60*1000));
	var du = "; expires="+date.toGMTString();
	document.cookie = pc_cu+"="+du+"; path=/";
}

function pc_iu(pc_ju)
{
	var ku = [];
	if(!pc_au)
	{
		try
		{
			var pc_Is = localStorage.length;
			for (var D = 0; D < pc_Is; D++) {
				var pc_cu = localStorage.key(D);
				if(pc_cu.indexOf(pc_ju) == 0)ku.push(pc_cu);
			}
		}
		catch(Nu)
		{
		}
	}
	var gu = document.cookie.split(';');
	for(var D = 0; D < gu.length; D++)
	{
		var Gs = PCJSF_Trim(gu[D]);
		if (Gs.indexOf(pc_ju) == 0)
		{
			var lu = Gs.indexOf("=");
			if(lu >= 0)ku.push(Gs.substr(0, lu));else ku.push(Gs);
		}
	}
	return ku;
}

function pc_mu(pc_nu)
{
	var Es = new Array();
	if(pc_nu.length == 0)return Es;
	var ou = pc_nu.split(",");
	if((ou.length % 2) != 0)return null;
	var pu = pc_L(ou.length / 2);	
	for(var D = 0; D < pu; D++)
	{
		Es[pc_M(ou[D * 2])] = pc_M(ou[D * 2 + 1]);
	}
	return Es;
}

function pc_qu(pc_nu)
{
	var Es = new Array();
	var xu = 0;
	var rv = pc_nu.indexOf(":", sv);
	if(rv < 0)return Es;
	var pc_ut = pc_M(pc_nu.substr(xu, rv - xu));
	Es["_id"] = pc_ut;
	xu = rv + 1;
	while(true)
	{
		var sv = pc_nu.indexOf(":", xu);
		if(sv < 0)break;
		var pc_cu = pc_M(pc_nu.substr(xu, sv - xu));
		var rv = pc_nu.indexOf(".", sv);
		if(rv < 0)break;
		pc_Ds = pc_mu(pc_nu.substr(sv + 1, rv - sv - 1));
		if(pc_Ds === null)break;
		Es[pc_cu] = pc_Ds;
		xu = rv + 1;
	}
	return Es;
}

function pc_tv(pc_nu)
{
	var Es = "";
	for(var pc_cu in pc_nu)
	{
		if(!pc_gt(pc_nu[pc_cu]))continue;
		if(Es !== "")Es += ",";
		Es += pc_F(String(pc_cu)) + "," + pc_F(String(pc_nu[pc_cu]));
	}
	return Es;
}

function pc_uv(pc_nu)
{
	var Es = pc_nu["_id"] + ":";
	for(var pc_cu in pc_nu)
	{
		if(!pc_it(pc_nu[pc_cu]))continue;
		if(pc_cu != "_id")
		{
			Es += pc_F(String(pc_cu)) + ":" + pc_tv(pc_nu[pc_cu]) + ".";
		}
	}
	return Es;
}

var pc_vv = -1;
var pc_wv = null;
var pc_xv = 0;
var pc_yv = null;

function pc_zv(pc_Cu, pc_nu, pc_Av, pc_Bv)
{
	if(pc_yv)Cv(pc_yv);
	pc_yv = setTimeout("PCJSF_SendRequestTimeout()", pc_Bv);
	pc_vv = pc_xv;
	pc_wv = pc_Av;
	pc_xv++;
	pc_nu["_id"] = String(pc_vv);
	var pc_Dv = pc_uv(pc_nu);
	var Ev = document.getElementById("PCJSF_ScriptContainer");
    var Fv = document.createElement("script");
    Fv.setAttribute("src", pc_Cu + "?packets=" + pc_Dv);
    Fv.setAttribute("type", 'text/javascript');
	Fv.setAttribute("id", "PCJSF_CommScriptId");
	var Gv = document.getElementById("PCJSF_CommScriptId"); 
	if(Gv)Ev.removeChild(Gv); 
	Ev.appendChild(Fv); 
}

function pc_Hv(pc_nu)
{
	if(pc_yv)clearTimeout(pc_yv);
	pc_yv = null;
	pc_vv = -1;
	var pc_Av = pc_wv;
	pc_wv = null;
	if(pc_Av)pc_Av(pc_nu);
}

function PCJSF_SendRequestTimeout()
{
	pc_Hv(null);
}

function PCJSF_CommRes(pc_Dv)
{
	pc_nu = pc_qu(String(pc_Dv));
	if(pc_nu["_id"] !== String(pc_vv))return;
	pc_Hv(pc_nu);
}
var pc_Iv = "";
var pc_bs = "";
var pc_Jv = 0;
var pc_Kv = 0;
var pc_Lv = 0;
var pc_Mv = null;
var pc_Nv = null;
var pc_Ov = -1;

function pc_Pv(pc_Qv, pc_nu)
{
	var Rv = (new Date).getTime();
	var Sv = pc_nu["tracker"] = new Array();
	if(pc_Qv)
	{
		if(pc_bs == "")Sv["get_page_key"] = "1";
		Sv["location"] = String(window.XtDirect_LocationOverride ? window.XtDirect_LocationOverride : pc_ss.location);
		var Tv = pc_eu("PCJSF_Tracker_Token");
		if(Tv)Sv["token"] = Tv;
		Sv["referer"] = String(pc_ss.referrer);
		Sv["getmode"] = "1";
		var Uv = pc_eu("PCJSF_Tracker_Key");
		if(Uv)Sv["keylist"] = Uv;
	}
	else
	{
		Sv["key"] = pc_Iv;
	}
	Sv["act"] =
		pc_L(pc_Jv / 1000) + "," +
		pc_L(pc_Kv / 1000) + "," +
		pc_L(pc_Lv / 1000);
	Sv["time"] = String(Rv);
}

function pc_Vv()
{
	if(pc_Ov != 0)
	{
		pc_Wv(pc_a);
	}
}

function pc_Xv(pc_Qv, pc_nu)
{
	if(pc_Qv)
	{
		if(pc_nu["tracker"] !== undefined)
		{
			var Yv = pc_nu["tracker"];
			if(Yv["mode"] !== undefined)pc_Ov = pc_L(Yv["mode"]);
			if(Yv["result"] !== undefined)
			{
				if(Yv["page_key"] !== undefined)pc_bs = Yv["page_key"];
				var Es = Yv["result"];
				var Zv = Yv["key"];
				if(Zv != null)pc_Iv = Zv;
				var av = Yv["keylist"];
				if(av != null)pc_bu("PCJSF_Tracker_Key", av);
				if(Es == "found")
				{
					pc_Vv();
					return 1;
				}
				if(Es == "created")
				{
					if(Yv["token"] !== undefined)pc_bu("PCJSF_Tracker_Token", Yv["token"]);
					pc_Vv();
					return 1;
				}
			}
		}
		return 0;
	}
	else
	{
		if(pc_nu["tracker"] !== undefined)
		{
			var Yv = pc_nu["tracker"];
			if(Yv["mode"] !== undefined)pc_Ov = pc_L(Yv["mode"]);
			if(Yv["result"] !== undefined)
			{
				var Es = Yv["result"];
				if(Es == "found")
				{
					pc_Vv();
					return 1;
				}
			}
		}
		return 0;
	}
}

function PCJSF_Tracker_Cycle()
{
	var Rv = (new Date).getTime();
	
	var wu = pc_Js();
	var bv = pc_Ls();
	if((wu.width != pc_Mv.width) || (wu.height != pc_Mv.height) ||
		(bv.x != pc_Nv.x) || (bv.y != pc_Nv.y))
	{
		pc_Lv = Rv;
		pc_Mv = wu;
		pc_Nv = bv;
	}
}

function pc_cv(pc_dv)
{
	pc_Jv = (new Date).getTime();
}

function pc_ev(pc_dv)
{
	pc_Jv = (new Date).getTime();
}

function pc_fv(pc_dv)
{
	pc_Jv = (new Date).getTime();
}

function pc_gv(pc_dv)
{
	pc_Kv = (new Date).getTime();
}

var pc_hv = (new Date).getTime();

function pc_iv() {
	pc_Mv = pc_Js();
	pc_Nv = pc_Ls();
	setInterval("PCJSF_Tracker_Cycle()", pc_b);

	if (pc_ss.addEventListener)
	{
		pc_ss.addEventListener('mousemove', pc_cv, false); 
		pc_ss.addEventListener('click', pc_ev, false); 
		pc_ss.addEventListener('dblclick', pc_fv, false); 
		pc_ss.addEventListener('keydown', pc_gv, false); 
		pc_ss.addEventListener('keyup', pc_gv, false); 
	}
	else if (pc_ss.attachEvent)
	{
		pc_ss.attachEvent('onmousemove', pc_cv);
		pc_ss.attachEvent('onclick', pc_ev);
		pc_ss.attachEvent('ondblclick', pc_fv);
		pc_ss.attachEvent('onkeydown', pc_gv);
		pc_ss.attachEvent('onkeyup', pc_gv);
	}
}

var pc_jv = [];
var pc_kv = [];
var pc_lv = [];
var pc_mv = 0;
var pc_nv = 0;
var pc_ov = 0;
var pc_pv = 0;

function pc_qv() {
  function rw() {
    return Math.floor((1 + Math.random()) * 0x10000)
      .toString(16)
      .substring(1);
  }
  return rw() + rw() + '-' + rw() + '-' + rw() + '-' +
    rw() + '-' + rw() + rw() + rw();
}

function pc_sw(pc_tw, pc_uw, pc_vw, pc_Us)
{
	var ww = {};
	ww.div = pc_tw;
	ww.containerDiv = pc_uw;
	ww.input = pc_vw;
	ww.index = pc_Us;	
	ww.cache = (pc_jv[pc_Us] !== undefined) ? (pc_jv[pc_Us]) : [];
	ww.sendGuid = pc_qv();
	for(var D = 0; D < ww.cache.length; D++)
	{
		var xw = ww.cache[D];
		if(xw.parentNode)xw.parentNode.removeChild(xw);
		ww.div.appendChild(xw);
	}
	ww.lastMessageId = (pc_kv[pc_Us] !== undefined) ? (parseInt(pc_kv[pc_Us])) : 0;
	ww.messages = [];
	ww.unreadMessages = 0;
	ww.typeStarted = false;
	ww.inputHandlerPress = function(pc_dv){ return pc_yw(pc_dv, pc_Us); };
	ww.inputHandlerDown = function(pc_dv){ return pc_zw(pc_dv, pc_Us); };
	ww.focusHandler = function(pc_dv){ return pc_Aw(pc_dv, pc_Us); };
	ww.messagesInitialized = false;
	pc_vw.onkeypress = ww.inputHandlerPress;
	if (pc_vw.addEventListener)
	{
		pc_vw.addEventListener('keydown', ww.inputHandlerDown, false); 
		pc_vw.addEventListener('focus', ww.focusHandler, false); 
	}
	else if (pc_vw.attachEvent)
	{
		pc_vw.attachEvent('onkeydown', ww.inputHandlerDown);
		pc_vw.attachEvent('onfocus', ww.focusHandler);
	}
	ww.containerDiv.scrollTop = 100000;
	pc_lv.push(ww);
	pc_Wv(0);
	try
	{
		pc_vw.focus();
	}
	catch(Nu)
	{
	}
}

var pc_Bw = 0;

function PCJSF_TempPrevent()
{
	pc_Bw = (new Date()).getTime();
}

function pc_Cw(pc_Ns)
{
	if(!pc_Ns)pc_Ns = pc_ts.event;
	if(pc_Ns.preventDefault)pc_Ns.preventDefault(); else pc_Ns.returnValue = false;
	if(pc_Ns.stopPropagation)pc_Ns.stopPropagation();
	return false;
}

function pc_Dw(pc_Ns)
{
	if(Math.abs((new Date()).getTime() - pc_Bw) < 1000)pc_Cw(pc_Ns);
}

function pc_Ew(pc_Us)
{
	for(var D = 0; D < pc_lv.length; D++)
	{
		var ww = pc_lv[D];
		if(ww.index == pc_Us)
		{
			pc_jv[pc_Us] = ww.cache;
			pc_kv[pc_Us] = ww.lastMessageId;
			if (ww.input.removeEventListener)
			{
				ww.input.removeEventListener('keypress', ww.inputHandlerPress, false); 
				ww.input.removeEventListener('keydown', ww.inputHandlerDown, false); 
				ww.input.removeEventListener('focus', ww.focusHandler, false); 
			}
			else if (ww.input.detachEvent)
			{
				ww.input.detachEvent('onkeypress', ww.inputHandlerPress);
				ww.input.detachEvent('onkeydown', ww.inputHandlerDown);
				ww.input.detachEvent('onfocus', ww.focusHandler);
			}
			pc_lv.splice(D, 1);
			break;
		}
	}
}

function pc_Fw(pc_Us)
{
	for(var D = 0; D < pc_lv.length; D++)
	{
		if((pc_lv[D].index == pc_Us) || (pc_Us == -1))return pc_lv[D];
	}
	return null;
}

function pc_Gw(pc_Qv, pc_nu)
{
	for(var D = 0; D < pc_lv.length; D++)
	{
		var ww = pc_lv[D];
		var Hw = "chat" + ww.index;
		var Sv = pc_nu[Hw] = new Array();
		if(ww.lastMessageId > 0)Sv["last_message"] = String(ww.lastMessageId);
		if(ww.messages.length > 0)
		{
			var Iw = "";
			for(var Jw = 0; Jw < ww.messages.length; Jw++)
			{
				Iw += pc_Qs(ww.messages[Jw]) + ";";
			}
			Sv["send"] = Iw;
			Sv["sendguid"] = ww.sendGuid;
		}
	}
}

function pc_Kw(pc_Qv, pc_nu)
{
	var Rv = (new Date).getTime();
	for(var D = 0; D < pc_lv.length; D++)
	{
		var ww = pc_lv[D];
		var Lw = ww.messagesInitialized;
		ww.messagesInitialized = true;
		var Hw = "chat" + ww.index;
		if(pc_nu[Hw] !== undefined)
		{
			var Mw = 0;
			var Nw = 0;
			var Ow = false;
			var Pw = pc_nu[Hw];
			if(ww.lastMessageId == 0)
			{
				pc_Lu(ww.div);
			}
			if(Pw["received"] !== undefined)
			{
				var Qw = pc_L(Pw["received"]);
				if(Qw > ww.messages.length)Qw = ww.messages.length;
				if(Qw > 0) {
					ww.messages.splice(0, Qw);
					ww.sendGuid = pc_qv();
				}
			}
			var Rw = pc_ss.getElementById("PCJSF_TypingMessage" + Hw);
			if(Rw)Rw.parentNode.removeChild(Rw);
			if(Pw["messages"] !== undefined)
			{
				var Sw = Pw["messages"];
				var Tw = Sw.indexOf(",");
				if(Tw >= 0)
				{
					var Uw = parseFloat(Sw.substr(0, Tw));
					var Vw = Sw.indexOf(":", Tw);
					if(Vw >= 0)
					{
						var Ww = parseFloat(Sw.substr(Tw + 1, Vw - Tw - 1));
						var Iw = Sw.substr(Vw + 1).split(";");
						var Xw = [];
						for(var Jw = 0; Jw < Iw.length; Jw++)
						{
							var pc_G = Iw[Jw];
							if(pc_G.length > 0)
							{
								var Yw = pc_G.split(",");
								if(Yw.length != 4)
								{
									return 0;
								}
								var date = new Date();
								var Zw = pc_Ts(Yw[2]);
								Zw = pc_aw(Zw);
								Zw = Zw.replace(new RegExp("%SC%", "g"), ";"); 
								Zw = Zw.replace(new RegExp("%FormStyle%", "g"), PCJSF_Chat_FillFormLinkStyle); 
								var cs = parseFloat(Yw[0]);
								if(cs > pc_ov)pc_ov = cs;
								if(cs > pc_pv)Nw++;
								date.setTime(parseFloat(Yw[0]) * 1000 - Uw + Rv);
								Xw.push(PCJSF_SkinObject.BuildMessageElement(pc_Hs(date.getHours(), 2) + ":"  + pc_Hs(date.getMinutes(), 2) + ":"  + pc_Hs(date.getSeconds(), 2), Yw, Zw));
								if(!parseInt(Yw[3]))Ow = true;
								Mw++;
							}
						}
						ww.lastMessageId = Ww;
					}
					else return 0;
				}
				else return 0;
			}
			pc_bw();
			if(Mw > 0)
			{
				if(pc_cw != "opened")
				{
					ww.unreadMessages += Nw;
					pc_dw();
				}
				for(var Jw = 0; Jw < Xw.length; Jw++)
				{
					ww.cache.push(Xw[Jw]);
					ww.div.appendChild(Xw[Jw]);
				}
				ww.containerDiv.scrollTop = 100000;
			}
			if(!Ow)
			{
				if(parseInt(Pw["lott"]) < 8)
				{
					var ew = pc_ss.createElement("span");
					ew.setAttribute("style", PCJSF_Chat_TypingMessageStyle);
					ew.setAttribute("id", "PCJSF_TypingMessage" + Hw);
					ew.appendChild(pc_ss.createTextNode(pc_fw));
					ww.div.appendChild(ew);
					ww.containerDiv.scrollTop = 100000;
				}
			}
			if(Ow && (Lw || (((new Date).getTime() - pc_hv) > 5000)))
			{
				if((new Date).getTime() - pc_gw < 1000)
				{
					if(pc_hw)pc_iw();
				}
				else
				{
					if(pc_jw)pc_iw();
				}
			}
		}
	}
	return 1;
}

function pc_kw(pc_zt, pc_lw, pc_Us, pc_Rs)
{
	var mw = pc_zt.indexOf(pc_Rs + "=", pc_Us);
	if(mw < 0)return "";
	if(mw > pc_lw)return "";
	mw += pc_Rs.length + 1;
	var nw = pc_zt.indexOf("&", mw);
	var ow = pc_zt.indexOf("'", mw);
	if((ow > 0) && (nw < 0) || (ow < nw))nw = ow;
	if(nw < 0)return "";
	return pw(pc_zt.substr(mw, nw - mw));
}

function pc_aw(pc_zt)
{
	var D = 0;
	while(D < pc_zt.length)
	{
		var pc_Us = pc_zt.indexOf("%FormDialogUrl%", D);
		if(pc_Us < 0)break;
		var qw = pc_zt.lastIndexOf("\"", pc_Us);
		var pc_lw = pc_zt.indexOf("\"", pc_Us);
		if((qw < 0) || (pc_lw < 0))
		{
			D = pc_Us + 1;
		}
		else
		{
			var rx = "javascript:PCJSF_Support_OpenForm('" + pc_kw(pc_zt, pc_lw, pc_Us, "accountId") + "\','" + pc_kw(pc_zt, pc_lw, pc_Us, "formName") + "');";
			pc_zt = pc_zt.substr(0, qw + 1) + rx + pc_zt.substr(pc_lw);
			D = qw + 1 + rx.length;
		}
	}
	return pc_zt;
}

function pc_sx()
{
	var tx = 0;
	for(var D = 0; D < pc_lv.length; D++)
	{
		tx += pc_lv[D].unreadMessages;
	}
	return tx;
}

var pc_ux = 0;

function pc_dw()
{
	var tx = pc_sx();
	if(pc_ux == tx)return;
	pc_ux = tx;
	if(PCJSF_SkinObject)PCJSF_SkinObject.SetUnreadMessageCount(pc_sx());
	if(pc_vx)pc_vx();
}

function pc_bw()
{
	if(pc_cw == "opened")
	{
		if(pc_ov > pc_pv)pc_pv = pc_ov;
		pc_wx();
		for(var D = 0; D < pc_lv.length; D++)
		{
			pc_lv[D].unreadMessages = 0;
		}
		pc_dw();
	}
}

var pc_xx = false;

function pc_yw(pc_dv, pc_Us)
{
	pc_dv = pc_dv || pc_ts.event;
	if(pc_dv.keyCode == 13)
	{
		if(pc_xx)
		{
			pc_xx = false;
			return true;
		}
		return false;
	}
	return true;
}

function pc_zw(pc_dv, pc_Us)
{
	pc_dv = pc_dv || pc_ts.event;
	if(pc_dv.keyCode == 13)
	{
		if(pc_mv == 0)
		{
			PCJSF_Chat_SendMessage(pc_Us);
			return true;
		}
		else pc_xx = true;
	}
}

function PCJSF_Chat_SendMessage(pc_Us)
{
	var ww = pc_Fw(pc_Us);
	var pc_G = PCJSF_Trim(ww.input.value);
	if(pc_G == pc_yx)pc_G = "";
	if(pc_G.length > 0)
	{
		ww.messages.push(pc_G);
		pc_Wv(0);
		ww.input.value = "";
		ww.input.focus();
	}
}

function pc_Aw(pc_dv, pc_Us)
{
	var ww = pc_Fw(pc_Us);
	if(!ww.typeStarted)
	{
		ww.input.value = "";
		ww.typeStarted = true;
	}
}

function pc_zx(pc_dv)
{
    pc_dv = pc_dv || pc_ts.event;
    if(pc_dv.keyCode == 16)pc_mv = 1;
}

function pc_Ax(pc_dv)
{
    pc_dv = pc_dv || pc_ts.event;
    if(pc_dv.keyCode == 16)
	{
		pc_mv = 0;
	}
}

function pc_Bx() {
	if (pc_ss.addEventListener)
	{
		pc_ss.addEventListener('mousedown', pc_Dw, false); 
		pc_ss.addEventListener('mouseup', pc_Dw, false); 
		pc_ss.addEventListener('click', pc_Dw, false); 
		pc_ss.addEventListener('touchstart', pc_Dw, false); 
		pc_ss.addEventListener('touchend', pc_Dw, false); 
		pc_ss.addEventListener('touchcancel', pc_Dw, false); 
		pc_ss.addEventListener('touchmove', pc_Dw, false); 
	}
	else if (pc_ss.attachEvent)
	{
		pc_ss.attachEvent('onmousedown', pc_Dw);
		pc_ss.attachEvent('onmouseup', pc_Dw);
		pc_ss.attachEvent('onclick', pc_Dw);
		pc_ss.attachEvent('touchend', pc_Dw); 
		pc_ss.attachEvent('touchcancel', pc_Dw); 
		pc_ss.attachEvent('touchmove', pc_Dw); 
	}
	
	if (pc_ss.addEventListener)
	{
		pc_ss.addEventListener('keydown', pc_zx, false); 
		pc_ss.addEventListener('keyup', pc_Ax, false); 
	}
	else if (pc_ss.attachEvent)
	{
		pc_ss.attachEvent('onkeydown', pc_zx); 
		pc_ss.attachEvent('onkeyup', pc_Ax); 
	}	
}
function pc_Cx(pc_Dx, pc_Ex, pc_Fx, pc_Gx, pc_Hx, pc_Ix, pc_Jx, pc_Kx, pc_zt)
{
	if(!pc_Ex)pc_Ex = "";
	if(!pc_zt)pc_zt = "";
	return PCJSF_SkinObject.GetTitleHtml(pc_Dx, pc_Ex, pc_Fx, pc_Gx, pc_Hx, pc_Ix, pc_Jx, pc_Kx, pc_zt);
}

function PCJSF_Support_SwitchTitleVisible()
{
	var Lx = pc_ss.getElementById("PCJSF_Support_TitleSwitch");
	var pc_Ex = pc_ss.getElementById("PCJSF_Support_Title");
	pc_Mx = pc_Mx ? 0 : 1;
	var Nx = pc_Ox;
	if(pc_Mx)
	{
		Nx += "CollapseTitle.png";
	}
	else
	{
		Nx += "ExpandTitle.png";
	}
	Lx.style.background = "" + PCJSF_Support_SwitchBackground + " url(" + Nx + ") no-repeat";
	pc_Ex.style.height = pc_Mx ? "" : "1px";
	pc_Ex.style.overflow = pc_Mx ? "auto" : "hidden";
	pc_Px();
}

function pc_Qx(pc_zt)
{
	return PCJSF_SkinObject.BuildChatHtml(pc_zt);
}

function pc_Rx(pc_ut)
{
	return pc_L(pc_ss.getElementById(pc_ut).offsetHeight);
}

function pc_Sx(pc_Tx)
{	
/*	if(pc_Tx > 90)pc_Tx -= 90;
	pc_ss.getElementById("PCJSF_Support_ChatCell").style.height = pc_Tx + "px";*/
}

function pc_Ux()
{
	PCJSF_Chat_SendMessage(0);
}

function pc_Vx()
{
/*	if(pc_Wx)return;
	var pc_Xx = pc_ss.getElementById("PCJSF_Support_ChatContainer");
	var Yx = pc_ss.getElementById("PCJSF_Support_ChatCell");
	if(Yx && pc_Xx)
	{
		var Zx = pc_Xx.scrollTop;
		pc_Xx.style.display = "none";
		var ax = "";
		var bx = "";		
		if(pc_ts.getComputedStyle && (!pc_cx) && (!pc_dx))
		{
			var pc_ls = pc_ts.getComputedStyle(Yx, null);
			ax = (pc_L(pc_ls.width) - 4) + "px";
			bx = pc_L(pc_ls.height) + "px";
		}
		else
		{
			ax = (pc_L(Yx.offsetWidth) - 4) + "px";
			bx = pc_L(Yx.offsetHeight) + "px";
		}
		if(pc_L(pc_Xx.style.width) != pc_L(ax))pc_Xx.style.width = ax;
		if(pc_L(pc_Xx.style.height) != pc_L(bx))pc_Xx.style.height = bx;
		pc_Xx.style.display = "block";
		pc_Xx.scrollTop = Zx;
	}*/
}

function pc_ex()
{
	var fx = -1;
	if (navigator.appName == 'Microsoft Internet Explorer')
	{
		var gx = navigator.userAgent;
		var Au  = new RegExp("MSIE ([0-9]{1,}[\\.0-9]{0,})");
		if (Au.exec(gx) != null) fx = parseFloat( RegExp.$1 );
	}
	else if (navigator.appName == 'Netscape')
	{
		var gx = navigator.userAgent;
		var Au  = new RegExp("Trident/.*rv:([0-9]{1,}[\\.0-9]{0,})");
		if (Au.exec(gx) != null) fx = parseFloat( RegExp.$1 );
	}
	return fx;
}

var pc_hx = false;
var pc_ix = "";
var pc_jx = new Array();
var pc_kx = new Array();
var pc_lx = new Array();
var pc_mx = 0;
var pc_nx = 0;
var pc_ox = 0;
var pc_px;
var pc_qx;
var pc_ry;
var pc_sy;
var pc_ty;
var pc_uy;
var pc_vy = 0;

function pc_wy(pc_ut)
{
	var xy = pc_ss.getElementById("PCJSF_Support_OffersBox");
	var pc_Lt = "";
	pc_Lt += "<div id=\"PCJSF_Support_OfferTable\" width=\"100%\" height=\"70px\" style=\"background:" + PCJSF_Support_OffersBackground + ";\">";
	pc_Lt += "<div style=\"width:12px;height:70px;margin:11px 0px 0px 6px;float:left;aling:left;\">";
	pc_Lt += pc_Et(12, 47, "display:block;", pc_Ox + "OffersLeft.png", null, null, pc_yy);
	pc_Lt += "</div>";
	pc_Lt += "<div style=\"width:12px;height:70px;margin:11px 6px 0px 0px;float:right;align:right;\">";
	pc_Lt += pc_Et(12, 47, "display:block;", pc_Ox + "OffersRight.png", null, null, pc_zy);
	pc_Lt += "</div>";
	pc_Lt += "<div id=\"PCJSF_Support_OfferContainer\" style=\"margin-left:18px;margine-right:18px;position:relative;height:70px;overflow:hidden;\"></div>";
	pc_Lt += "</div>";
	pc_Lt += "<table id=\"PCJSF_Support_OfferTable\" width=\"100%\" height=\"70px\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"background:" + PCJSF_Support_OffersBackground + ";\"><tr><td width = \"6px\"></td><td width = \"12px\" valign=\"center\">";	
	xy.innerHTML = pc_Vt(pc_Lt);
	
	pc_ix = pc_ut;
	if(pc_jx[pc_ut] == undefined)
	{
		pc_jx[pc_ut] = true;
		var pc_Cu = pc_Ay + "Public/GetOffers.php";
		var Ev = document.getElementById("PCJSF_ScriptContainer");
		var Fv = document.createElement("script");
		Fv.setAttribute("src", pc_Cu + "?id=" + pc_ut);
		Fv.setAttribute("type", 'text/javascript');
		if(pc_ox)Ev.removeChild(pc_ox); 
		Ev.appendChild(Fv);
		pc_ox = Fv;
	}
	pc_By();
	pc_hx = true;
}

function pc_Cy()
{
	pc_hx = false;
	var xy = pc_ss.getElementById("PCJSF_Support_OffersBox");
	if(xy)
	{
		xy.innerHTML = "";
	}
}


function pc_yy()
{
	if(pc_px < 2)return;
	pc_vy = (new Date()).getTime();
	pc_Dy();
	pc_mx = pc_L((pc_mx + pc_px - 1) % pc_px);
	pc_nx -= 180 + pc_sy;
	pc_Ey();
}

function pc_zy()
{
	if(pc_px < 2)return;
	pc_vy = (new Date()).getTime();
	pc_Dy();
	pc_mx = pc_L((pc_mx + 1) % pc_px);
	pc_nx += 180 + pc_sy;
	pc_Ey();
}

function Promptchat_Support_OffersReceived(pc_ut, pc_Fy)
{
	pc_Fy = pc_M(pc_Fy);
	var Gy = new Array();
	var Hy = pc_Zt(pc_Fy);
	for(var D = 0; D < Hy.length - 4; D += 5)
	{
		var Iy = {};
		Iy.title = Hy[D];
		Iy.text = Hy[D + 1];
		Iy.footer = Hy[D + 2];
		Iy.url = Hy[D + 3];
		Iy.img = Hy[D + 4];
		Gy.push(Iy);
	}
	pc_kx[pc_ut] = Gy;
	if(pc_ut == pc_ix)pc_By();
}

function pc_Jy(array)
{
	for(var D = 0; D < array.length; D++)
	{
		var Ky = Math.floor(array.length * Math.random());
		if(Ky >= array.length)Ky = array.length - 1;
		if(Ky != D)
		{
			var Ly = array[Ky];
			array[Ky] = array[D];
			array[D] = Ly;
		}
	}
}

function pc_By()
{
	pc_lx = new Array();
	if(pc_kx[pc_ix] == undefined)return;
	var Gy = pc_kx[pc_ix];
	var pc_Lt = "";
	var My = (pc_cw == "opened") ? "visible" : "hidden";
	for(var D = 0; D < Gy.length; D++)
	{
		var Iy = Gy[D];
		pc_Lt += "<div id=\"PCJSF_Support_Offer" + D + "\" style=\"visibility:" + My + ";position:absolute;top:5px;left:0px;width:180px; height:60px;overflow:hidden;\">";
		pc_Lt += "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr>";
		if(Iy.img.length > 0)
		{
			pc_Lt += "<td width=\"52px\" height=\"52px\">";
			pc_Lt += "<a href=\"" + Iy.url + "\" target=\"_blank\"><img src=\"" + pc_Ay + "Public/OfferImage.php?id=" + Iy.img + "\" width=\"50\" height=\"50\" style=\"border:" + PCJSF_Support_OfferBorder + ";\" /></a>";
			pc_Lt += "</td><td width=\"4px\"></td>";
		}
		pc_Lt += "<td><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td>";
		pc_Lt += "<a href=\"" + Iy.url + "\" target=\"_blank\" style=\"text-decoration:" + PCJSF_Support_OfferTitleDecoration + ";\">" + pc_st("span", null, PCJSF_Support_OfferFont, PCJSF_Support_OfferTitleSize, PCJSF_Support_OfferTitleColor, PCJSF_Support_OfferTitleWeight, "normal", Iy.title) + "</a>";
		pc_Lt += "</td></tr><tr><td>";
		pc_Lt += "<a href=\"" + Iy.url + "\" target=\"_blank\" style=\"text-decoration:" + PCJSF_Support_OfferTextDecoration + ";\">" + pc_st("span", null, PCJSF_Support_OfferFont, PCJSF_Support_OfferTextSize, PCJSF_Support_OfferTextColor, PCJSF_Support_OfferTextWeight, "normal", Iy.text) + "</a>";
		pc_Lt += "</td></tr><tr><td>";
		pc_Lt += "<a href=\"" + Iy.url + "\" target=\"_blank\" style=\"text-decoration:" + PCJSF_Support_OfferFooterDecoration + ";\">" + pc_st("span", null, PCJSF_Support_OfferFont, PCJSF_Support_OfferFooterSize, PCJSF_Support_OfferFooterColor, PCJSF_Support_OfferFooterWeight, "normal", Iy.footer) + "</a>";
		pc_Lt += "</td></tr></table></td></tr></table></a></div>";
		pc_lx.push(D);
	}
	pc_ss.getElementById("PCJSF_Support_OfferContainer").innerHTML = pc_Vt(pc_Lt);
	pc_Jy(pc_lx);
	pc_mx = 0;
	pc_nx = 0;
	pc_vy = (new Date()).getTime();
	pc_Ey();
}

function pc_Dy()
{
	var pc_Is = pc_lx.length;
	if(pc_Is == 0)return;
	var Ny = pc_L(pc_ss.getElementById("PCJSF_Support_OfferTable").scrollWidth) - 36;
	var Oy = pc_L(Ny / 200);
	if(Oy < 1)Oy = 1;
	var Py = pc_L((Ny - Oy * 178) / (Oy + 1));
	var Qy = 0;
	var Ry = 0;
	if(pc_Is > Oy)
	{
		Qy = pc_L((pc_nx <= 0) ? ((pc_Is - Oy) / 2) : ((pc_Is - Oy + 1) / 2));
		Ry = pc_L((pc_nx <= 0) ? ((pc_Is - Oy + 1) / 2) : ((pc_Is - Oy) / 2));
	}
	pc_px = pc_Is;
	pc_qx = Ny;
	pc_ry = Oy;
	pc_sy = Py;
	pc_ty = Qy;
	pc_uy = Ry;
}

function pc_Ey()
{
	if(!pc_hx)return;
	pc_Dy();
	var D;
	var Sy = pc_ry + pc_uy;
	if(Sy + pc_ty > pc_px)Sy = pc_px - pc_ty;
	for(D = -pc_ty; D < Sy; D++)
	{
		var pc_Us = (pc_mx + pc_px + D) % pc_px;
		var Ty = pc_ss.getElementById("PCJSF_Support_Offer" + pc_lx[pc_Us]);
		Ty.style.left = ((pc_sy * (D + 1) + D * 180) + pc_nx) + "px";
	}
}

function pc_Uy(pc_Vy)
{
	if(!pc_hx)return;
	for(var D = 0;D < pc_lx.length; D++)
	{
		pc_ss.getElementById("PCJSF_Support_Offer" + D).style.visibility = pc_Vy ? "visible" : "hidden";
	}
}

function PCJSF_Support_MoveOffers()
{
	if(!pc_hx)return;
	var Rv = (new Date()).getTime();
	if(Rv - pc_vy > pc_rs)
	{
		pc_zy();
	}
	if(pc_nx == 0)return;
	if(Math.abs(pc_nx) < 2)
	{
		pc_nx = 0;
	}
	else
	{
		pc_nx = pc_L(pc_nx * 0.7);
	}
	pc_Ey();
}

setInterval("PCJSF_Support_MoveOffers()", pc_q);

var pc_Wy = 0;
var pc_Xy;

function pc_Yy()
{
	pc_Zy.innerHTML = pc_Vt(
		"<table width=\"100%\" height=\"100%\"><tr><td id=\"PCJSF_Support_Loading_P\" style=\"font-size:20px;color:#cccccc;text-align:center;vertical-align:middle;\">" +
		 "</td></tr></table>");
	pc_Xy = setInterval("PCJSF_Support_Loading_Update();", 300);
	PCJSF_Support_Loading_Update();
	pc_gs("PCJSF_Support_Loading_P", "default");
}

function pc_ay()
{
	clearInterval(pc_Xy);
	pc_Lu(pc_Zy);
}

function PCJSF_Support_Loading_Update()
{
	pc_Wy = (pc_Wy + 1) % 10;
	var by = pc_cy + "<br />";
	for(var D = 0; D <= pc_Wy; D++)by += ".";
	pc_ss.getElementById("PCJSF_Support_Loading_P").innerHTML = by;
}
var pc_dy = false;

function pc_ey()
{
	return 	"border:" + PCJSF_Support_InputBorder +
			";background:" + PCJSF_Support_TypeBackground +
			";font-family:" + PCJSF_Support_Font +
			";font-size:" + PCJSF_Support_TypeSize +
			";color:" + PCJSF_Support_TypeColor +
			";font-weight:" + PCJSF_Support_TypeWeight + ";";
}

function pc_fy()
{
	pc_dy = false;
	var pc_Ex = pc_gy ? pc_hy : pc_iy;
	var pc_zt = pc_gy ? pc_jy : pc_ky;
	var ly = (pc_zt.length > 0) && PCJSF_SkinObject.IsTitleTextAllowed();
	var my = (pc_gy && !pc_ny);
	var oy = (pc_py && (!pc_gy || pc_qy));
	var rz = (ly || my || oy);
	var pc_Lt = "";
	var sz = 0;
	if(pc_tz && PCJSF_SkinObject.AreOffersAllowed())
	{
		pc_Lt += "<div id=\"PCJSF_Support_OffersBox\" style=\"position:absolute;width:100%;height:70px;bottom:0px;\"></div>";
		pc_Lt += "<div style=\"position:absolute;width:100%;height:" + PCJSF_Support_InnerBorderWidth + ";bottom:70px;background:" + PCJSF_Support_InnerBorderColor + ";\"></div>";
		sz += 70 + pc_L(PCJSF_Support_InnerBorderWidth);
	}
	pc_Lt += "<div style=\"position:absolute;width:100%;top:0px;bottom:" + sz + "px;overflow:hidden;\">";
	pc_Lt += "<div style=\"display:table;width:100%;height:100%;\">";
	pc_Lt += "<div style=\"display:table-row;\"><div style=\"display:table-cell;background:" + PCJSF_Support_TitleBackground + ";vertical-align:top;\">";
	pc_Lt += pc_Cx(pc_uz, pc_Ex, "picture_wfv", PCJSF_Support_InnerBorderWidth, pc_vz, pc_wz, pc_xz, rz, pc_zt);
	if(rz)
	{
		pc_Lt += "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td colspan=\"2\" height=\"7px\"></td></tr><tr><td width=\"12px\"></td><td>";
		if(ly)
		{
			pc_Lt += pc_st("span", null, PCJSF_Support_Font, PCJSF_Support_MainTextSize, PCJSF_Support_MainTextColor, "bold", "normal", pc_zt);
			if(my || oy)pc_Lt += "<br /><br />";
		}
		if(my)
		{
			if(pc_yz)
			{
				pc_Lt += pc_st("span", null, PCJSF_Support_Font, PCJSF_Support_MainTextSize, PCJSF_Support_MainTextColor, "bold", "normal", pc_zz);
				pc_Lt += "<input id=\"PCJSF_Support_WFV_EMail\" type=\"text\" style = \"width:100%;height:" + PCJSF_Support_InputHeight + ";" + pc_ey() + "\"/><br /><br />";
			}
			pc_Lt += pc_Pt(pc_Az, pc_Bz) + "<div style=\"width:10px;height:20px;float:left;\"></div>";
		}
		if(oy)
		{
			pc_Lt += pc_Pt(pc_Cz, pc_Dz);
		}
		pc_Lt += "</td><td width=\"12px\"></td></tr><tr><td colspan=\"2\" height=\"7px\"></td></tr></table>";
	}
	pc_Lt += "</div></div>";
	if(pc_ny && (pc_gy || pc_Ez))
	{
		pc_Lt += "<div style=\"display:table-row;height:100%;\"><div id=\"PCJSF_Support_IEContainerCell\" style=\"display:table-cell;vertical-align:top;\">";
		pc_Lt += pc_Qx(pc_zt);
		pc_Lt += "</div></div>";
	}
	pc_Lt += "</div></div>";
	pc_Zy.innerHTML = pc_Vt(pc_Lt);
	pc_gs("PCJSF_Support_Title_Text", "default");
	if(pc_ny && (pc_gy || pc_Ez))
	{
		pc_sw(pc_ss.getElementById("PCJSF_Support_ChatDiv"), pc_ss.getElementById("PCJSF_Support_ChatContainer"), pc_ss.getElementById("PCJSF_Support_ChatInput"), 0);
		pc_dy = true;
	}
	if(pc_tz && PCJSF_SkinObject.AreOffersAllowed())pc_wy(pc_ix);
}

function pc_Bz()
{
	var Fz = pc_ss.getElementById("PCJSF_Support_WFV_EMail");
	if(Fz)
	{
		var pc_zu = Fz.value;
		if((pc_zu.indexOf(".") > 2) && (pc_zu.indexOf("@") > 0))
		{
			pc_Gz = pc_zu;
		}
		else
		{
			alert(pc_Hz);
			return;
		}
	}
	pc_Iz.push("wfv_start_chat");
	pc_Wv(0);
}

function pc_Dz()
{
	pc_Iz.push("wfv_leave_a_message");
	pc_Wv(0);
}

function pc_Jz()
{
	pc_Cy();
	if(pc_dy)
	{
		pc_Ew(0);
	}
	pc_Lu(pc_Zy);
}

var pc_Kz = false;

function pc_Lz()
{
	pc_Kz = false;
	
	var pc_Ex = pc_gy ? pc_Mz : pc_Nz;
	var pc_zt = pc_gy ? pc_Oz : pc_Pz;
	var ly = (pc_zt.length > 0) && PCJSF_SkinObject.IsTitleTextAllowed();
	var oy = (pc_py && (!pc_gy || pc_qy));
	var rz = (ly || oy);
	var pc_Lt = "";
	var sz = 0;
	if(pc_Qz && PCJSF_SkinObject.AreOffersAllowed())
	{
		pc_Lt += "<div id=\"PCJSF_Support_OffersBox\" style=\"position:absolute;width:100%;height:70px;bottom:0px;\"></div>";
		pc_Lt += "<div style=\"position:absolute;width:100%;height:" + PCJSF_Support_InnerBorderWidth + ";bottom:70px;background:" + PCJSF_Support_InnerBorderColor + ";\"></div>";
		sz += 70 + pc_L(PCJSF_Support_InnerBorderWidth);
	}
	pc_Lt += "<div style=\"position:absolute;width:100%;top:0px;bottom:" + sz + "px;overflow:hidden;\">";
	pc_Lt += "<div style=\"display:table;width:100%;height:100%;\">";
	pc_Lt += "<div style=\"display:table-row;\"><div style=\"display:table-cell;background:" + PCJSF_Support_TitleBackground + ";vertical-align:top;\">";
	pc_Lt += pc_Cx(pc_Rz, pc_Ex, "picture_wfo", PCJSF_Support_InnerBorderWidth, pc_Sz, pc_Tz, pc_Uz, rz, pc_zt);
	if(rz)
	{
		pc_Lt += "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td colspan=\"2\" height=\"7px\"></td></tr><tr><td width=\"12px\"></td><td>";
		if(ly)
		{
			pc_Lt += pc_st("span", null, PCJSF_Support_Font, PCJSF_Support_MainTextSize, PCJSF_Support_MainTextColor, "bold", "normal", pc_zt);
			if(oy)pc_Lt += "<br /><br />";
		}
		if(oy)
		{
			pc_Lt += pc_Pt(pc_Vz, pc_Wz);
		}
		pc_Lt += "</td><td width=\"12px\"></td></tr><tr><td colspan=\"2\" height=\"7px\"></td></tr></table>";
	}
	pc_Lt += "</div></div>";
	if(pc_Xz && (pc_gy || pc_Yz))
	{
		pc_Lt += "<div style=\"display:table-row;height:100%;\"><div id=\"PCJSF_Support_IEContainerCell\" style=\"display:table-cell;vertical-align:top;\">";
		pc_Lt += pc_Qx(pc_zt);
		pc_Lt += "</div></div>";
	}
	pc_Lt += "</div></div>";
	pc_Zy.innerHTML = pc_Vt(pc_Lt);
	pc_gs("PCJSF_Support_Title_Text", "default");
	if(pc_Xz && (pc_gy || pc_Yz))
	{
		pc_sw(pc_ss.getElementById("PCJSF_Support_ChatDiv"), pc_ss.getElementById("PCJSF_Support_ChatContainer"), pc_ss.getElementById("PCJSF_Support_ChatInput"), 0);
		pc_Kz = true;
	}
	if(pc_Qz && PCJSF_SkinObject.AreOffersAllowed())pc_wy(pc_ix);
}

function pc_Wz()
{
	pc_Iz.push("wfo_leave_a_message");
	pc_Wv(0);
}

function pc_Zz()
{
	pc_Cy();
	if(pc_Kz)
	{
		pc_Ew(0);
	}
	pc_Lu(pc_Zy);
}

function pc_az()
{
	pc_Kz = false;
	var pc_zt = pc_bz;
	var ly = (pc_zt.length > 0) && PCJSF_SkinObject.IsTitleTextAllowed();
	var cz = pc_dz;
	var rz = (ly || cz);
	var pc_Lt = "";
	var sz = 0;
	if(pc_ez && PCJSF_SkinObject.AreOffersAllowed())
	{
		pc_Lt += "<div id=\"PCJSF_Support_OffersBox\" style=\"position:absolute;width:100%;height:70px;bottom:0px;\"></div>";
		pc_Lt += "<div style=\"position:absolute;width:100%;height:" + PCJSF_Support_InnerBorderWidth + ";bottom:70px;background:" + PCJSF_Support_InnerBorderColor + ";\"></div>";
		sz += 70 + pc_L(PCJSF_Support_InnerBorderWidth);
	}
	pc_Lt += "<div style=\"position:absolute;width:100%;top:0px;bottom:" + sz + "px;overflow:hidden;\">";
	pc_Lt += "<div style=\"display:table;width:100%;height:100%;\">";
	pc_Lt += "<div style=\"display:table-row;\"><div style=\"display:table-cell;background:" + PCJSF_Support_TitleBackground + ";vertical-align:top;\">";
	pc_Lt += pc_Cx(pc_fz, pc_gz, "picture_ses", rz ? PCJSF_Support_InnerBorderWidth : 0, pc_hz, pc_iz, pc_jz, true, pc_zt);
	if(rz)
	{
		pc_Lt += "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td colspan=\"2\" height=\"7px\"></td></tr><tr><td width=\"12px\"></td><td>";
		if(ly)
		{
			pc_Lt += pc_st("span", null, PCJSF_Support_Font, PCJSF_Support_MainTextSize, PCJSF_Support_MainTextColor, "bold", "normal", pc_zt);
			if(cz)pc_Lt += "<br /><br />";
		}
		if(cz)
		{
			var kz = pc_lz;
			kz = kz.replace("\"", "\\\"");
			if(PCJSF_SkinObject.GetSessionSetEMailHTML)pc_Lt += PCJSF_SkinObject.GetSessionSetEMailHTML(kz);
			else
			{
				pc_Lt += "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr>";
				pc_Lt += "<td width=\"100%\" style=\"vertical-alignment:top\"><input id=\"PCJSF_Support_SES_EMail\" type=\"email\" style = \"width:100%;height:" + PCJSF_Support_InputHeight + ";" + pc_ey() + "\" value=\"" + ((kz != "") ? kz : pc_mz) + "\" onfocus=\"if(this.value=='" + pc_mz + "')this.value='';\" onblur=\"if(PCJSF_IntWin.PCJSF_Trim(this.value)=='')this.value='" + pc_mz + "';\" /></td>";
				pc_Lt += "<td>&nbsp;&nbsp;</td>";
				pc_Lt += "<td>" + pc_Pt(pc_nz.replace(" ", "&nbsp;"), PCJSF_Support_SES_SetEMail) + "</td>";
				pc_Lt += "</tr></table>";
			}
		}
		pc_Lt += "</td><td width=\"12px\"></td></tr><tr><td colspan=\"2\" height=\"7px\"></td></tr></table>";
	}	
	pc_Lt += "</div></div>";
	pc_Lt += "<div style=\"display:table-row;height:100%;\"><div id=\"PCJSF_Support_IEContainerCell\" style=\"display:table-cell;vertical-align:top;\">";
	pc_Lt += pc_Qx(pc_bz);
	pc_Lt += "</div></div>";
	pc_Lt += "</div></div>";
	pc_Zy.innerHTML = pc_Vt(pc_Lt);
	pc_gs("PCJSF_Support_Title_Text", "default");
	pc_sw(pc_ss.getElementById("PCJSF_Support_ChatDiv"), pc_ss.getElementById("PCJSF_Support_ChatContainer"), pc_ss.getElementById("PCJSF_Support_ChatInput"), 0);
	if(pc_ez && PCJSF_SkinObject.AreOffersAllowed())pc_wy(pc_ix);
}

function PCJSF_Support_SES_SetEMail()
{
	var pc_zu = pc_ss.getElementById("PCJSF_Support_SES_EMail").value;
	if(pc_zu == pc_mz)pc_zu = "";
	pc_zu = PCJSF_Trim(pc_zu);
	if(!pc_yu(pc_zu)){ alert(pc_oz); return; }
	pc_lz = pc_zu;
	pc_Iz.push("ses_set_email");
	pc_Wv(0);
	alert(pc_pz);
}

function pc_qz()
{
	pc_Cy();
	pc_Ew(0);
	pc_Lu(pc_Zy);
}

function pc_rA()
{
	return 	"border:" + PCJSF_Support_InputBorder +
			";background:" + PCJSF_Support_TypeBackground +
			";font-family:" + PCJSF_Support_Font +
			";font-size:" + PCJSF_Support_TypeSize +
			";color:" + PCJSF_Support_TypeColor +
			";font-weight:" + PCJSF_Support_TypeWeight + ";";
}

function pc_sA()
{
	var tA = PCJSF_SkinObject.GetPagePadding();
	var pc_Lt = "";
	pc_Lt += "<div id=\"PCJSF_lamt\" style=\"width:100%;height:100%;overflow:auto;\">";
	pc_Lt += "<table width=\"100%\" height=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"background:" + PCJSF_Support_TitleBackground + ";\"><tr><td id=\"PCJSF_lamh\" height=\"10px\" valign=\"top\">";
	pc_Lt += pc_Cx(pc_uA, pc_vA, "picture_lam", PCJSF_Support_InnerBorderWidth, pc_wA, pc_xA, pc_yA, true, "");
	pc_Lt +=
		"<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td colspan=\"2\" height=\"7px\"></td></tr><tr><td width=\"" + tA + "px\"></td><td colspan=\"2\">" +
		pc_st(
			"span", null,
			PCJSF_Support_Font, PCJSF_Support_MainTextSize, PCJSF_Support_MainTextColor, "bold", "normal", pc_zA) +
		"<br /><br />";
	pc_Lt += pc_Pt(pc_AA, pc_BA) + "&nbsp;";
	pc_Lt += "</td><td width=\"" + tA + "px\"></td></tr>";
	pc_Lt += "<tr><td colspan=\"4\" height=\"7px\"></td></tr>";
	pc_Lt += "<tr><td width=\"" + tA + "px\"></td><td colspan=\"2\">";
	pc_Lt += pc_st("span", null, PCJSF_Support_Font, PCJSF_Support_MainTextSize, PCJSF_Support_MainTextColor, "bold", "normal", pc_CA);
	pc_Lt += "<td width=\"" + tA + "px\"></td></td></tr>";
	pc_Lt += "<tr><td width=\"" + tA + "px\"></td><td colspan=\"2\"><input id=\"PCJSF_Support_LAM_EMail\" type=\"email\" style = \"width:100%;height:" + PCJSF_Support_InputHeight + ";" + pc_rA() + "\"/></td><td width=\"" + tA + "px\"></td></tr>";
	pc_Lt += "<tr><td colspan=\"4\" height=\"7px\"></td></tr>";
	pc_Lt += "<tr><td width=\"" + tA + "px\"></td><td colspan=\"2\">";
	pc_Lt += pc_st("span", null, PCJSF_Support_Font, PCJSF_Support_MainTextSize, PCJSF_Support_MainTextColor, "bold", "normal", pc_DA);
	pc_Lt += "<td width=\"" + tA + "px\"></td></td></tr>";
	pc_Lt += "<tr><td width=\"" + tA + "px\"></td><td colspan=\"2\"><input id=\"PCJSF_Support_LAM_Name\" type=\"text\" style = \"width:100%;height:" + PCJSF_Support_InputHeight + ";" + pc_rA() + "\"/></td><td width=\"" + tA + "px\"></td></tr>";
	pc_Lt += "<tr><td colspan=\"4\" height=\"7px\"></td></tr>";
	pc_Lt += "<tr><td width=\"" + tA + "px\"></td><td colspan = \"2\">";
	pc_Lt += pc_st("span", null, PCJSF_Support_Font, PCJSF_Support_MainTextSize, PCJSF_Support_MainTextColor, "bold", "normal", pc_EA);
	pc_Lt += "</td><td width=\"" + tA + "px\"></td></tr>";
	pc_Lt += "<tr><td width=\"" + tA + "px\"></td><td colspan = \"2\"><textarea id=\"PCJSF_Support_LAM_Message\" style=\"width:100%;height:50px;" + pc_rA() + "\"></textarea><td width=\"" + tA + "px\"></td></tr>";
	pc_Lt += "<tr><td colspan=\"4\" height=\"7px\"></td></tr>";
	pc_Lt += "<tr><td width=\"" + tA + "px\"></td><td colspan = \"2\">";
	pc_Lt += pc_Pt(pc_FA, pc_GA) + "&nbsp;";
	pc_Lt += "</td><td width=\"" + tA + "px\"></td></tr>";
	pc_Lt += "</table>";
	var HA = "";
	pc_Lt += "</td></tr><tr><td" + HA + ">&nbsp;";
	if(pc_IA)
	{
		pc_Lt += "</td></tr><tr><td height=\"7px\" style=\"font-size:4px;\">";
		pc_Lt += "	<div style=\"width:100%;height:7px;background:" + PCJSF_Support_InnerBorderColor + ";\"></div>";
		pc_Lt += "</td></tr><tr><td height=\"70px\"><div id=\"PCJSF_Support_OffersBox\" style=\"width:100%;height:70px;\"></div>";
	}
	pc_Lt += "</td></tr></table>";
	pc_Zy.innerHTML = pc_Vt(pc_Lt);
	pc_gs("PCJSF_Support_Title_Text", "default");
	if(pc_IA)pc_wy(pc_ix);
}

function pc_BA()
{
	pc_Iz.push("lam_go_back");
	pc_Wv(0);
}

function pc_GA()
{
	pc_JA = pc_ss.getElementById("PCJSF_Support_LAM_EMail").value;
	pc_KA = pc_ss.getElementById("PCJSF_Support_LAM_Name").value;
	pc_LA = pc_ss.getElementById("PCJSF_Support_LAM_Message").value;
	pc_Iz.push("lam_leave_a_message");
	pc_Wv(0);	
}

function pc_MA()
{
	pc_Cy();
	pc_Lu(pc_Zy);
}

	var pc_NA = 0;
var pc_OA = "";
var pc_PA = "";
var pc_QA = {};
var pc_RA = false;
var pc_SA = "";

function pc_TA()
{
	return 	"border:" + PCJSF_Support_InputBorder +
			";background:" + PCJSF_Support_TypeBackground +
			";font-family:" + PCJSF_Support_Font +
			";font-size:" + PCJSF_Support_TypeSize +
			";color:" + PCJSF_Support_TypeColor +
			";font-weight:" + PCJSF_Support_TypeWeight + ";";
}

function pc_UA()
{
	pc_RA = true;
	pc_PA = pc_NA + "_" + pc_OA;
	var VA = pc_QA[pc_PA];
	if(VA)
	{
		pc_WA();
		return;
	}
	var Ev = document.getElementById("PCJSF_ScriptContainer");
	var Fv = document.createElement("script");
	Fv.setAttribute("src", pc_Ay + "Public/LoadForm.php?accountId=" + encodeURIComponent(pc_NA) + "&formName=" + encodeURIComponent(pc_OA) + "&method=PCJSF_Support_Form_OnLoaded");
	Fv.setAttribute("type", 'text/javascript');
	Ev.appendChild(Fv); 
	var pc_Lt = "<table width=\"100%\" height=\"100%\"><tr><td align=\"center\" valign=\"middle\">" +
		pc_st(
			"span", "PCJSF_Support_Loading_P",
			PCJSF_Support_Font, PCJSF_Support_LargeTextSize, PCJSF_Support_LoadingColor, "bold", "normal",
			pc_cy) +
		 "</td></tr></table>";
	pc_Zy.innerHTML = pc_Vt(pc_Lt);
}

function pc_WA()
{
	if(!pc_RA)return;
	var VA = pc_QA[pc_PA];
	if(!VA)return;
	var tA = PCJSF_SkinObject.GetPagePadding();
	var pc_Lt = "";
	pc_Lt += "<div style=\"width:100%;height:100%;position:relative\"><div id=\"PCJSF_lamt\" style=\"position:absolute;top:0px;left:0px;width:100%;height:100%;overflow:auto;\">";
	pc_Lt += "<table width=\"100%\" height=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"background:" + PCJSF_Support_TitleBackground + ";\"><tr><td id=\"PCJSF_lamh\" height=\"10px\" style=\"vertical-align:top\">";
	pc_Lt +=
		"<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td colspan=\"2\" height=\"7px\"></td></tr><tr><td width=\"" + tA + "px\"></td><td colspan=\"2\">" +
		pc_st(
			"span", null,
			PCJSF_Support_Font, PCJSF_Support_TitleTextSize, PCJSF_Support_TitleColor, PCJSF_Support_TitleWeight, "normal", VA.title) + "<br />" +
		pc_st(
			"span", null,
			PCJSF_Support_Font, PCJSF_Support_MainTextSize, PCJSF_Support_MainTextColor, "bold", "normal", VA.intro) +
		"<br /><br />";
	pc_Lt += pc_Pt(pc_XA, pc_YA) + "&nbsp;";
	pc_Lt += "</td><td width=\"" + tA + "px\"></td></tr>";
	for(var D = 0; D < VA.fields.length; D++)
	{
		var ZA = VA.fields[D];
		pc_Lt += "<tr><td colspan=\"4\" height=\"7px\"></td></tr>";
		pc_Lt += "<tr><td width=\"" + tA + "px\"></td><td colspan=\"2\">";
		pc_Lt += pc_st("span", null, PCJSF_Support_Font, PCJSF_Support_MainTextSize, PCJSF_Support_MainTextColor, "bold", "normal", ZA.label);
		pc_Lt += "<td width=\"" + tA + "px\"></td></td></tr>";
		pc_Lt += "<tr><td width=\"" + tA + "px\"></td><td colspan=\"2\">";
		var ds = ZA.type;
		if(ds == "SingleLineText")
		{
			pc_Lt += "<input id=\"PCJSF_Support_Form_Item" + D + "\" type=\"text\" style=\"width:100%;height:" + PCJSF_Support_InputHeight + ";" + pc_TA() + "\" />";
		}
		else if(ds == "MultiLineText")
		{
			pc_Lt += "<textarea id=\"PCJSF_Support_Form_Item" + D + "\" type=\"text\" style=\"width:100%;height:60px;" + pc_TA() + "\"></textarea>";
		}
		else if(ds == "EMail")
		{
			pc_Lt += "<input id=\"PCJSF_Support_Form_Item" + D + "\" type=\"email\" style=\"width:100%;height:" + PCJSF_Support_InputHeight + ";" + pc_TA() + "\" />";
		}
		else if(ds == "Url")
		{
			pc_Lt += "<input id=\"PCJSF_Support_Form_Item" + D + "\" type=\"text\" style=\"width:100%;height:" + PCJSF_Support_InputHeight + ";" + pc_TA() + "\" />";
		}
		else if(ds == "Checkbox")
		{
			pc_Lt += "<input id=\"PCJSF_Support_Form_Item" + D + "\" type=\"checkbox\" style=\"" + pc_TA() + "\" />";
		}
		else if(ds == "DropDown")
		{
			pc_Lt += "<select id=\"PCJSF_Support_Form_Item" + D + "\" style=\"" + pc_TA() + "\" />";
			var aA = ZA.options.split(",");
			for(var Jw = 0; Jw < aA.length; Jw++)
			{
				var bA = PCJSF_Trim(aA[Jw]);
				if(bA.length > 0)
				{
					pc_Lt += "<option value=\"" + bA + "\">" + bA + "</option>";
				}
			}
			pc_Lt += "</select> ";
		}
		pc_Lt += "</td><td width=\"" + tA + "px\"></td></tr>";
		
	}
	pc_Lt += "<tr><td colspan=\"4\" height=\"7px\"></td></tr>";
	pc_Lt += "<tr><td width=\"" + tA + "px\"></td><td colspan=\"2\">";
	pc_Lt += pc_Pt(VA.sendLabel, pc_cA) + "&nbsp;";
	pc_Lt += "</td><td width=\"" + tA + "px\"></td></tr>";
	pc_Lt += "</table>";
	var HA = "";
	pc_Lt += "</td></tr><tr><td" + HA + ">&nbsp;";
	pc_Lt += "</td></tr></table>";
	pc_Lt += "</div></div>";
	setTimeout(function(){pc_Zy.innerHTML = pc_Vt(pc_Lt);}, 10);
	pc_SA = VA.sentText;
}

function pc_cA()
{
	if(!pc_RA)return;
	var VA = pc_QA[pc_PA];
	if(!VA)return;
	var dA = null;
	var pc_eA = "";
	for(var D = 0; D < VA.fields.length; D++)
	{
		var ZA = VA.fields[D];
		var ds = ZA.type;
		var pc_lt = pc_ss.getElementById("PCJSF_Support_Form_Item" + D);
		var pc_Ds = (pc_lt && pc_lt.value) ? PCJSF_Trim(pc_lt.value) : "";
		pc_eA += "<b>" + ZA.label + " </b>";
		if(ds == "SingleLineText")
		{
			if((ZA.required == "1") && (pc_Ds.length < 1)) { dA = ZA.error; break; }
			pc_eA += pc_Ju(pc_Ds);
		}
		else if(ds == "MultiLineText")
		{
			if((ZA.required == "1") && (pc_Ds.length < 1)) { dA = ZA.error; break; }
			pc_eA += pc_Ju(pc_Ds);
		}
		else if(ds == "EMail")
		{
			if(((pc_Ds.length > 0) && (!pc_yu(pc_Ds))) || ((ZA.required == "1") && (pc_Ds.length < 1))) { dA = ZA.error; break; }
			pc_eA += pc_Ju(pc_Ds);
		}
		else if(ds == "Url")
		{
			if(((pc_Ds.length > 0) && (!pc_Bu(pc_Ds))) || ((ZA.required == "1") && (pc_Ds.length < 1))) { dA = ZA.error; break; }
			pc_eA += pc_Ju(pc_Ds);
		}
		else if(ds == "Checkbox")
		{
			pc_eA += pc_lt.checked ? "yes" : "no";
		}
		else if(ds == "DropDown")
		{
			if((ZA.required == "1") && (pc_Ds.length < 1)) { dA = ZA.error; break; }
			pc_eA += pc_Ju(pc_Ds);
		}
		pc_eA += "<br />";
	}
	if(dA !== null)
	{
		alert(dA);
		return;
	}
	var Ev = document.getElementById("PCJSF_ScriptContainer");
	var Fv = document.createElement("script");
	Fv.setAttribute("src", pc_Ay + "Public/SendPopupForm.php?accountId=" + encodeURIComponent(pc_NA) + "&formName=" + encodeURIComponent(pc_OA) + "&method=PCJSF_Support_Form_EMailSent&content=" + encodeURIComponent(pc_eA));
	Fv.setAttribute("type", 'text/javascript');
	Ev.appendChild(Fv); 
}

function pc_fA(pc_gA)
{
	if(pc_gA)
	{
		alert(pc_Ku(pc_SA));
		pc_hA();
	}
	else
	{
		alert("Sending failed.");
	}
}

function pc_YA()
{
	pc_hA();
}

function pc_iA(pc_jA, pc_kA, pc_lA)
{
	if(!pc_lA)return;
	pc_QA[pc_jA + "_" + pc_kA] = pc_lA;
	pc_WA();
}

function pc_mA()
{
	pc_RA = false;
	pc_Lu(pc_Zy);
}

var pc_cw = "closed";
var pc_nA = false;
var pc_oA = "unk";
var pc_pA = "";
var pc_Zy = null;
var pc_qA = null;
var pc_rB = navigator.userAgent.toLowerCase();
var pc_sB = pc_ex();
var pc_Yt = (pc_ex() >= 6);
var pc_dx = pc_Yt ? (pc_ex() >= 9.0) : false;
var pc_tB = pc_Yt ? (pc_ex() >= 8.0) : false;
var pc_uB = pc_Yt ? (pc_ex() < 7.0) : false;
var pc_Wx = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
var pc_cx = (pc_rB.indexOf("safari") >= 0);
var pc_vB;
var pc_wB = new Array();
var pc_Ox;
var pc_Mx = 1;
var pc_xB = new Array();
var pc_Iz = new Array();
var pc_yB = false;
var pc_zB = 0;
var pc_AB = false;
var pc_vx = false;
var pc_BB = "";
var pc_CB = "";
var PCJSF_SkinObject = null;


var PCJSF_Support_Font = "Arial";

var PCJSF_Support_LargeTextSize = "20px";
var PCJSF_Support_TitleTextSize = "14px";
var PCJSF_Support_ButtonTextSize = "11px";
var PCJSF_Support_MainTextSize = "12px";
var pc_DB = "10px";

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
var pc_EB = "12px";
var pc_FB = "#ffffff";

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
var pc_Nt = 5;

var PCJSF_Chat_TypingMessageStyle = "font-family:Arial;font-size:10px;font-weight:normal;color:#666666;";
var PCJSF_Chat_FillFormLinkStyle = "";
var PCJSF_Support_UnreadMessagesStyle = "width:20px;height:20px;border-radius:10px;font-size:12px;color:#ffffff;background:#ff0000;position:absolute;magin:0px;font-weight:bold;";


var pc_cy = "Loading";


var pc_GB = 0;
var pc_HB = "";
var pc_IB = 0; 
var pc_JB = "";
var pc_KB = "default";
var pc_LB = 0;
var pc_MB = 0;
var pc_NB =300;
var pc_OB = 300;
var pc_PB = 800;
var pc_QB = 800;
var pc_RB = 2;
var pc_SB = 2;
var pc_TB = 30;
var pc_UB = 30;
var pc_VB = 1;
var pc_WB = 1;
var pc_Xz = 1;
var pc_ny = 1;
var pc_py = 1;
var pc_XB = 1;
var pc_qy = 1;
var pc_yz = 0;
var pc_dz = 0;
var pc_YB = 0;
var pc_ZB = "";
var pc_aB = "";
var pc_bB = "";
var pc_cB = 0;
var pc_dB = 0;
var pc_yx = "";
var pc_ix = "";
var pc_eB = 0;
var pc_fB = 0;
var pc_gB = 2;
var pc_hB = 2;
var pc_iB = 30;
var pc_jB = 30;
var pc_kB = "";
var pc_lB = "";
var pc_fw = "";
var pc_mB = "";
var pc_nB = "";
var pc_oB = 1;
var pc_hw = 0;
var pc_pB = 1;
var pc_jw = 0;
var pc_qB = 0;
var pc_rC = "";
var pc_sC = "";
var pc_oz = "";
var pc_tC = 0;
var pc_uC = "";
var pc_vC = "";
var pc_XA = "";
var pc_Yz = 0;
var pc_Ez = 0;

var pc_wC = 0;
var pc_gy = 0;

var pc_xC = null;


var pc_hy = "";
var pc_iy = "";
var pc_xz = "";
var pc_vz = 0;
var pc_wz = 0;
var pc_jy = "";
var pc_ky = "";
var pc_Cz = "";
var pc_Az = "";
var pc_uz = 1;
var pc_tz = 1;
var pc_zz = "";
var pc_Hz = "";


var pc_Mz = "";
var pc_Nz = "";
var pc_Uz = "";
var pc_Sz = 0;
var pc_Tz = 0;
var pc_Oz = "";
var pc_Pz = "";
var pc_Vz = "";
var pc_Rz = 1;
var pc_Qz = 1;


var pc_vA = "";
var pc_yA = "";
var pc_wA = 0;
var pc_xA = 0;
var pc_zA = "";
var pc_CA = "";
var pc_DA = "";
var pc_EA = "";
var pc_FA = "";
var pc_AA = "";
var pc_uA = 1;
var pc_IA = 1;
var pc_yC = "";


var pc_gz = "";
var pc_jz = "";
var pc_hz = 0;
var pc_iz = 0;
var pc_fz = 1;
var pc_ez = 1;
var pc_bz = "";
var pc_nz = "";
var pc_mz = "";
var pc_pz = "";

var pc_JA = "";
var pc_KA = "";
var pc_LA = "";

var pc_Gz = "";

var pc_lz = "";

var pc_zC = null;
var pc_AC = null;

var pc_BC = null;

/*string*/function pc_CC(/*string*/pc_Ds) {
	var /*int*/pc_Is = pc_Ds.length;
	var /*string*/Es = "";
	var /*int*/D = 0;
	while(D < pc_Is) {
		var /*DC*/EC = pc_Ds.charAt(D);
		D++;
		if(EC == "+")Es += " ";
		else if(EC == "%") {
			if(D + 1 < pc_Is) {
				var /*int*/pc_C = parseInt(pc_Ds.substr(D, 2), 16);
				if(!isNaN(pc_C))Es += String.fromCharCode(pc_C);
			}
			D += 2;
		}
		else Es += EC;
	}
	return Es;
}

/*Array[string=>string]*/function pc_FC(/*string*/pc_Cu) {
	var Es = [];
	var pc_Us = pc_Cu.indexOf("?");
	if(pc_Us < 0)return Es;
	pc_Cu = pc_Cu.substr(pc_Us + 1);
	var Yw = pc_Cu.split("&");
	for(var D = 0; D < Yw.length; D++) {
		var GC = Yw[D];
		pc_Us = GC.indexOf("=");
		if(pc_Us >= 0)
			Es[pc_CC(GC.substr(0, pc_Us))] = pc_CC(GC.substr(pc_Us + 1));
		else
			Es[pc_CC(GC)] = "";
	}
	return Es;
}

function pc_HC(pc_zt)
{
	pc_zt = pc_zt.replace(new RegExp("\\\\", "g"), "\\e");
	pc_zt = pc_zt.replace(new RegExp(",", "g"), "\\c");
	pc_zt = pc_zt.replace(new RegExp(";", "g"), "\\s");
	return pc_zt;
}

function pc_IC(pc_zt)
{
	pc_zt = pc_zt.replace(new RegExp("\\\\c", "g"), ",");
	pc_zt = pc_zt.replace(new RegExp("\\\\s", "g"), ";");
	pc_zt = pc_zt.replace(new RegExp("\\\\e", "g"), "\\");
	return pc_zt;
}

function pc_JC(pc_Qt)
{
	var KC = "";
	var LC = pc_FC(pc_ss.location.toString());
	var MC = pc_Qt.split(";");
	for(var D = 0; D < MC.length; D++)
	{
		var Yw = MC[D].split(",");
		if(Yw.length == 3)
		{
			var NC = pc_IC(Yw[1]);
			var OC = pc_IC(Yw[2]);
			var pc_Ds = null;
			if(OC.length > 0)pc_Ds = window[OC];
			if((!pc_Ds) && (NC.length > 0))pc_Ds = LC[NC];
			if(pc_Ds && (pc_Ds.length > 0))
			{
				if(KC != "")KC += ";";
				KC += Yw[0] + "," + pc_HC(pc_Ds);
			}
		}
	}
	if(KC.length > 0)pc_BC = KC;
}


function pc_PC(pc_Qv, pc_nu)
{
	var Sv = pc_nu["support"] = new Array();
	Sv["state"] = pc_cw + ";" + pc_oA;
	var QC = "";
	if(!pc_GB)QC += "global;";
	if(!pc_wB[pc_oA])QC += pc_oA + ";";
	if(QC.length > 0)Sv["load"] = QC;
	pc_xB = pc_xB.concat(pc_Iz);
	pc_Iz = new Array();
	var RC = "";
	for(var D = 0; D < pc_xB.length; D++)
	{
		if(RC != "")RC += ";";
		var SC = pc_xB[D];
		RC += SC;
		if(SC == "lam_leave_a_message")
		{
			Sv["mail"] = pc_JA;
			Sv["name"] = pc_KA;
			Sv["message"] = pc_LA;
		}
		else if(SC == "wfv_start_chat")
		{
			Sv["mail"] = pc_Gz;
		}
		else if(SC == "ses_set_email")
		{
			Sv["tmail"] = pc_lz;
		}
	}
	if(RC != "")Sv["commands"] = RC;
	var TC = (pc_CB + "," + pc_BB).split(",");
	pc_CB = "";
	var UC = "";
	for(var D = 0; D < TC.length; D++)
	{
		var pc_Ns = PCJSF_Trim(TC[D]);
		if(pc_Ns.length > 0)
		{
			if(UC.length > 0)UC += ",";
			UC += pc_Ns;
		}
	}
	if(UC.length > 0)
	{
		Sv["nel"] = UC;
		pc_CB = UC;
	}
	pc_BB = "";
	if(pc_BC)
	{
		Sv["pad"] = pc_BC;
		pc_BC = null;
	}
	if(pc_nA)Sv["pstatee"] = 1;
	if(pc_Qv)
	{
		Sv["connecting"] = "1";
		Sv["ismobile"] = pc_Ks ? "1" : "0";
		var VC = String(pc_ss.location);
		var WC = VC.indexOf("?");
		if(WC >= 0)
		{
			var XC = VC.indexOf("prcc=", WC);
			if(XC >= 0)
			{
				if((XC == WC + 1) || (VC.charAt(XC - 1) == "&"))
				{
					var YC = VC.indexOf("&", XC);
					if(YC < 0)YC = VC.length;
					Sv["campaign"] = VC.substr(XC + 5, YC - XC - 5);
				}
			}
		}
	}
}

function pc_ZC()
{
	if((pc_LB == 0) || (pc_MB == 0))return "";
	return	pc_TB + "," + pc_UB + "," + pc_LB + "," + pc_MB + "," +
			pc_cw + "," + pc_Mx + "," + pc_pv;
}

function pc_wx()
{
	if(pc_Iv == "")return;
	var pc_I = pc_ZC();
	if(pc_I != "") {
		var aC = [];
		var bC = pc_iu("PCJSF_JSS");
		for (var D = 0, pc_Is = bC.length; D < pc_Is; D++){
			var pc_cu = bC[D];
			var cC = pc_eu(pc_cu);
			if(cC) {
				var pc_Us = cC.indexOf("_");
				if(pc_Us < 0)aC.push(pc_cu);
				else {
					var cs = parseFloat(cC.substr(0, pc_Us));
					var Rv = (new Date()).getTime();
					if((cs > Rv) || (cs < Rv - 300 * 1000))aC.push(pc_cu);
				}
			}
        }
		for(var D = 0; D < aC.length; D++) {
			pc_hu(aC[D]);
		}
		pc_bu("PCJSF_JSS" + pc_Iv, (new Date()).getTime() + "_" + pc_I);
	}
}

function pc_dC(pc_I)
{
	if(!pc_I)return;
	var Yw = pc_I.split(",");	
	if(Yw.length == 7)
	{
		if(pc_cw != "embedded")
		{
			pc_TB = parseInt(Yw[0]);
			pc_UB = parseInt(Yw[1]);
			pc_LB = parseInt(Yw[2]);
			pc_MB = parseInt(Yw[3]);
			if(pc_LB < pc_NB)pc_LB = pc_NB;
			if(pc_LB > pc_PB)pc_LB = pc_PB;
			if(pc_MB < pc_OB)pc_MB = pc_OB;
			if(pc_MB > pc_QB)pc_MB = pc_QB;
		}
		if((pc_cw != "embedded") && (Yw[4] != "embedded"))pc_cw = Yw[4];
		pc_Mx = parseInt(Yw[5]);
		pc_pv = parseFloat(Yw[6]);
	}
}

function PCJSF_Support_SkinLoaded()
{
	if(PCJSF_Chat_FillFormLinkStyle == "")PCJSF_Chat_FillFormLinkStyle = PCJSF_Chat_OCStyle + ";text-decoration:underline;cursor:pointer;";
	pc_GB = 1;
	if(pc_cw != "embedded")
	{
		if(pc_GB && !pc_qA)pc_eC();
	}
	pc_fC(false);
}

var pc_gw = 0;

function pc_gC(pc_Qv, pc_nu)
{
	if(pc_nu["support"] !== undefined)
	{
		var Sv = pc_nu["support"];
		if(Sv["global"] != undefined)
		{
			var hC = pc_Zt(Sv["global"]);
			pc_HB = hC[0];
			pc_IB = hC[1];
			pc_JB = hC[2];
			pc_KB = hC[3];
			pc_VB = parseInt(hC[4]);
			pc_WB = parseInt(hC[5]);
			pc_RB = parseInt(hC[6]);
			pc_SB = parseInt(hC[7]);
			pc_TB = parseInt(hC[8]);
			pc_UB = parseInt(hC[9]);
			pc_NB = parseInt(hC[10]);
			pc_PB = parseInt(hC[11]);
			if(pc_cw != "embedded")
			{
				pc_LB = parseInt(hC[12]);
			}
			pc_OB = parseInt(hC[13]);
			pc_QB = parseInt(hC[14]);
			if(pc_cw != "embedded")
			{
				pc_MB = parseInt(hC[15]);
			}
			pc_Xz = parseInt(hC[16]);
			pc_ny = parseInt(hC[17]);
			pc_py = parseInt(hC[18]);
			pc_XB = parseInt(hC[19]);
			pc_qy = parseInt(hC[20]);
			pc_YB = parseInt(hC[21]);
			pc_ZB = hC[22];
			pc_aB = hC[23];
			pc_bB = hC[24];
			pc_cB = parseInt(hC[25]);
			pc_dB = parseInt(hC[26]);
			pc_yx = hC[27];
			pc_ix = hC[28];
			pc_eB = parseInt(hC[29]);
			pc_fB = parseInt(hC[30]);
			pc_gB = parseInt(hC[31]);
			pc_hB = parseInt(hC[32]);
			pc_iB = parseInt(hC[33]);
			pc_jB = parseInt(hC[34]);
			pc_yz = parseInt(hC[35]);
			pc_dz = parseInt(hC[36]);
			pc_kB = hC[37];
			pc_lB = hC[38];
			pc_fw = hC[39];
			pc_mB = hC[40];
			pc_nB = hC[41];
			pc_oB = parseInt(hC[42]);
			pc_hw = parseInt(hC[43]);
			pc_pB = parseInt(hC[44]);
			pc_jw = parseInt(hC[45]);
			pc_qB = parseInt(hC[46]);
			pc_rC = hC[47];
			pc_sC = hC[48];
			pc_oz = hC[49];
			pc_tC = parseInt(hC[50]);
			pc_uC = hC[51];
			pc_vC = hC[52];
			pc_XA = hC[53];
			pc_Yz = parseInt(hC[54]);
			pc_Ez = parseInt(hC[55]);
			
			pc_Ox = pc_Ay + "Public/Skins/" + pc_KB + "/";
			if((pc_Iv != "") && (!pc_yB))
			{
				pc_yB = true;
				var cC = localStorage.getItem("PCJSF_JSS" + pc_Iv);
				if(cC) {
					var pc_Us = cC.indexOf("_");
					if(pc_Us >= 0)pc_dC(cC.substr(pc_Us + 1));
				}
			}
			if(pc_GB == 0)
			{
				var Ev = document.getElementById("PCJSF_ScriptContainer");
				var Fv = document.createElement("script");
				var iC = pc_uC;
				if(iC == "")iC = "default";
				if(pc_Ks)
				{
					iC = pc_vC;
					if(iC == "")iC = "mobile";
				}
				Fv.setAttribute("src", pc_Ay + "Public/LoadSkin.php?skin=" + pc_KB + "&engine=" + iC + "&prefix=PCJSF_");
				Fv.setAttribute("type", 'text/javascript');
				Ev.appendChild(Fv); 
			}
		}
		if(Sv["wfv"] != undefined)
		{
			var jC = pc_Zt(Sv["wfv"]);
			pc_hy = jC[0];
			pc_xz = jC[1];
			pc_vz = parseInt(jC[2]);
			pc_wz = parseInt(jC[3]);
			pc_jy = jC[4];
			pc_ky = jC[5];
			pc_Cz = jC[6];
			pc_Az = jC[7];
			pc_uz = parseInt(jC[8]);
			pc_tz = parseInt(jC[9]);
			pc_zz = jC[10];
			pc_Hz = jC[11];
			pc_iy = jC[12];
			pc_wB["wfv"] = true;
		}
		if(Sv["wfo"] != undefined)
		{
			var jC = pc_Zt(Sv["wfo"]);
			pc_Mz = jC[0];
			pc_Uz = jC[1];
			pc_Sz = parseInt(jC[2]);
			pc_Tz = parseInt(jC[3]);
			pc_Oz = jC[4];
			pc_Pz = jC[5];
			pc_Vz = jC[6];
			pc_Rz = parseInt(jC[7]);
			pc_Qz = parseInt(jC[8]);
			pc_Nz = jC[9];
			pc_wB["wfo"] = true;
		}
		if(Sv["lam"] != undefined)
		{
			var jC = pc_Zt(Sv["lam"]);
			pc_vA = jC[0];
			pc_yA = jC[1];
			pc_wA = parseInt(jC[2]);
			pc_xA = parseInt(jC[3]);
			pc_zA = jC[4];
			pc_CA = jC[5];
			pc_DA = jC[6];
			pc_EA = jC[7];
			pc_FA = jC[8];
			pc_AA = jC[9];
			pc_uA = parseInt(jC[10]);
			pc_IA = parseInt(jC[11]);
			pc_yC = jC[12];
			pc_wB["lam"] = true;
		}
		if(Sv["ses"] != undefined)
		{
			var jC = pc_Zt(Sv["ses"]);
			pc_gz = jC[0];
			pc_jz = jC[1];
			pc_hz = parseInt(jC[2]);
			pc_iz = parseInt(jC[3]);
			pc_fz = parseInt(jC[4]);
			pc_ez = parseInt(jC[5]);
			pc_bz = jC[6];
			pc_nz = jC[7];
			pc_pz = jC[8];
			pc_lz = jC[9];
			pc_mz = jC[10];
			pc_wB["ses"] = true;
		}
		if(Sv["par"] != undefined)
		{
			pc_JC(Sv["par"]);
		}
		if(pc_cw != "embedded")
		{
			if(pc_GB && !pc_qA)pc_eC();
		}
		if(Sv["nela"] != undefined)
		{
			pc_CB = "";
		}
		if(Sv["state"] != undefined)
		{
			pc_oA = Sv["state"];
		}
		pc_nA = false;
		if(Sv["auto_opened"] == "yes")pc_gw = (new Date).getTime();
		if((pc_cw != "embedded") && (Sv["pstate"] != undefined))
		{
			pc_nA = true;
			if(Sv["pstate"] == "opened")
			{
				if((Sv["auto_opened"] == "yes") && pc_hw)
				{
					pc_iw();
				}
				else if((Sv["auto_opened"] != "yes") && pc_pB)
				{
					pc_iw();
				}
			}
			pc_cw = Sv["pstate"];
		}
		var pc_kC = false;
		if(Sv["opav"] != undefined)
		{
			var lC = (Sv["opav"] == "1") ? 1 : 0;
			if(pc_wC && (pc_gy != lC))pc_kC = true;
			pc_gy = lC;
			pc_wC = 1;
		}
		pc_fC(pc_kC);
		pc_xB = new Array();
		var pc_Bv;
		if(pc_oA == "ses")pc_Bv = pc_o;
		else if(pc_oA == "lam")pc_Bv = pc_p;
		else if(pc_oA == "wfo")pc_Bv = pc_n;
		else pc_Bv = pc_m;
		if(pc_Ov != 0)
		{
			pc_Wv(pc_Bv);
		}
		if(Sv["auto_opened"] == "yes")
		{
			if(pc_AB)
			{
				pc_AB();
			}
		}
		if(pc_xC)
		{
			pc_xC();
			pc_xC = null;
		}
		if(Sv["lam_performed"] == "yes")
		{
			if(pc_yC != "")
			{
				alert(pc_yC);
			}
		}
		if(Sv["pushs"] != undefined)
		{
			setTimeout(function() { pc_mC(Sv["pushs"]); }, 10);
		}
		return 1;
	}
	return 0;
}

function pc_mC(pc_zt)
{
	pc_zt = PCJSF_Trim(pc_zt);
	var pc_Us = pc_zt.indexOf("://");
	if(pc_Us >= 0)
	{
		var nC = pc_zt.substr(0, pc_Us).toLowerCase();
		if((nC == "http") || (nC == "https"))
		{
			pc_ss.location = pc_zt;
			return;
		}
	}
	oC(pc_zt);
}

function pc_Px()
{
	pc_pC();
	pc_Vx();
	pc_Ey();
	pc_zB = 2;
}

function pc_qC(pc_rD, pc_Ft, pc_Gt, pc_sD)
{
	return pc_Vt("<div id = \"PCJSF_Support_ContainerDiv\" align=\"center\" style = \"width:" + pc_Ft + "px;height:" + pc_Gt + "px;border:solid 1px " + pc_sD + ";overflow:hidden;padding:0px;margin:0px;\"></div>");
}

function pc_eC()
{
	pc_qA = PCJSF_SkinObject.BuildPopup(pc_Ox, pc_LB, pc_MB);
	pc_ss.body.appendChild(pc_qA);
	pc_pC();
	if(pc_IB == 2)pc_gs("PCJSF_Support_HeaderText", "move");
	pc_Zy = pc_ss.getElementById("PCJSF_Support_ContainerDiv");
}

var pc_tD = null;

function pc_uD(pc_kC)
{
	if(!pc_eB || (!pc_fB && !pc_gy))
	{
		pc_vD();
		return;
	}
	if(window.PCJSF_SkinObject)
	{
		if((pc_tD == null) || pc_kC)pc_tD = PCJSF_SkinObject.BuildFloatingButton(pc_wD);
		pc_pC();
		pc_tD.style.visibility = "visible";
	}
}

function pc_wD()
{
	pc_xD();
}

function pc_vD()
{
	if(pc_tD != null)
	{
		pc_tD.style.visibility = "hidden";
	}
}

function pc_yD(pc_zD)
{
	PCJSF_SkinObject.UpdateSize(pc_zD);
}

var pc_AD = false;
var pc_BD = false;
var pc_CD = false;
var pc_DD;
var pc_ED;

function PCJSF_Support_MouseDownInHeader(pc_Ns)
{
	if((!pc_AD) && (!pc_BD))
	{
		if(PCJSF_SkinObject.IsMoveAndResizeAllowed())
		{
			pc_AD = true;
			pc_FD(pc_Ns);
		}
	}
}

function PCJSF_Support_MouseDownForResize(pc_Ns, pc_GD)
{
	if((!pc_AD) && (!pc_BD))
	{
		pc_CD = pc_GD;
		pc_BD = true;
		pc_FD(pc_Ns);
	}
}

function pc_FD(pc_Ns)
{	
	pc_DD = {};
	pc_DD.x = pc_Ns.clientX;
	pc_DD.y = pc_Ns.clientY;
	pc_ED = {};
	pc_ED.x = pc_L(pc_qA.offsetLeft);
	pc_ED.y = pc_L(pc_qA.offsetTop);
	if (pc_ss.addEventListener)
	{
		pc_ss.addEventListener('mousemove', pc_HD, false); 
		pc_ss.addEventListener('mouseup', pc_ID, false); 
	}
	else if (pc_ss.attachEvent)
	{
		pc_ss.attachEvent('onmousemove', pc_HD); 
		pc_ss.attachEvent('onmouseup', pc_ID); 
	}
	pc_HD(pc_Ns);
}

function pc_JD()
{
	if (pc_ss.removeEventListener)
	{
		pc_ss.removeEventListener('mousemove', pc_HD, false); 
		pc_ss.removeEventListener('mouseup', pc_ID, false); 
	}
	else if (pc_ss.detachEvent)
	{
		pc_ss.detachEvent('onmousemove', pc_HD); 
		pc_ss.detachEvent('onmouseup', pc_ID); 
	}
	pc_pC();
}

function pc_HD(pc_Ns)
{
	var KD = pc_Ns.clientX - pc_DD.x;
	var LD = pc_Ns.clientY - pc_DD.y;
	if(pc_AD)
	{
		PCJSF_SkinObject.UpdateTempPosition(pc_ED.x + KD, pc_ED.y + LD);
		return false;
	}
	else if(pc_BD)
	{
		var ax = parseInt(pc_LB);
		var bx = parseInt(pc_MB);
		if((pc_CD & 1) != 0)ax -= KD;
		if((pc_CD & 2) != 0)ax += KD;
		if((pc_CD & 4) != 0)bx += LD;
		if(ax < pc_NB)ax = pc_NB;
		if(ax > pc_PB)ax = pc_PB;
		if(bx < pc_OB)bx = pc_OB;
		if(bx > pc_QB)bx = pc_QB;
		pc_qA.style.width = ax + "px";
		pc_qA.style.height = bx + "px";
		PCJSF_SkinObject.UpdatePosition();
		pc_Px();
		return false;
	}
}

function pc_MD(pc_eA, pc_Xx, pc_ND, pc_OD)
{
	var xu = 0;
	if(pc_ND == 0)xu = pc_OD;
	else if(pc_ND == 1)xu = pc_OD + pc_L((pc_eA - pc_Xx) / 2);
	else if(pc_ND == 2)xu = pc_Xx - pc_OD - pc_eA;
	return xu;
}

function pc_ID(pc_Ns)
{
	var bv = pc_Ls();
	var wu = pc_Js();
	if(pc_AD)
	{
		pc_AD = false;
		pc_TB = pc_MD(pc_LB, wu.width, pc_RB, pc_L(pc_qA.style.left));
		pc_UB = pc_MD(pc_MB, wu.height, pc_SB, pc_L(pc_qA.style.top));
		if(pc_Yt)
		{
			pc_TB += bv.x;
			pc_UB += bv.y;
		}
		pc_JD();
		pc_wx();
	}
	else if(pc_BD)
	{
		pc_BD = false;
		pc_LB = pc_L(pc_qA.style.width);
		pc_MB = pc_L(pc_qA.style.height);
		pc_JD();
		pc_Px();
		pc_wx();
	}
}


function pc_pC()
{
	if(pc_Yt)
	{
		var pc_Xx = pc_ss.getElementById("PCJSF_Support_IEContainerCell");
		var pc_eA = pc_ss.getElementById("PCJSF_Support_IEContentCell");
		if(pc_Xx && pc_eA)
		{
			var pc_wt = pc_kt(pc_Xx);
			pc_eA.style.height = pc_wt[1] + "px";
		}
	}
	if(pc_qA && !pc_AD && !pc_BD)PCJSF_SkinObject.UpdatePosition();
	if(pc_tD)PCJSF_SkinObject.UpdateFloatingButtonPosition();
}


function pc_fC(pc_kC)
{
	var PD = pc_Ox;
	if(pc_cw == "closed")
	{
		if(pc_qA)pc_qA.style.visibility = "hidden";
		pc_Uy(false);
		pc_uD(pc_kC);
	}
	else
	{
		pc_vD();
	}
	if(pc_cw == "opened")
	{
		pc_bw();
		if(pc_qA)
		{
			pc_qA.style.visibility = "visible";
			PCJSF_SkinObject.UpdateState();
			pc_Uy(true);
		}
	}
	else if(pc_cw == "minimized")
	{
		if(pc_qA)
		{
			pc_qA.style.visibility = "visible";
			PCJSF_SkinObject.UpdateState();
		}
	}
	pc_pC();
	if(pc_Zy)
	{
		var QD = pc_oA;
		if(pc_RD)QD = "form";
		if(!pc_GB)QD = "loading";
		if((pc_pA != QD) || (pc_kC))
		{			
			if(pc_pA == "loading")pc_ay();
			else if(pc_pA == "wfv")pc_Jz();
			else if(pc_pA == "wfo")pc_Zz();
			else if(pc_pA == "lam")pc_MA();
			else if(pc_pA == "ses")pc_qz();
			else if(pc_pA == "form")pc_mA();
			var pc_I = "loading";
			if(QD == "form")pc_I = "form";
			if(pc_wB[QD])pc_I = QD;
			if(pc_I == "loading")pc_Yy();
			else if(pc_I == "wfv")pc_fy();
			else if(pc_I == "wfo")pc_Lz();
			else if(pc_I == "lam")pc_sA();
			else if(pc_I == "ses")pc_az();
			else if(pc_I == "form")pc_UA();
			pc_pA = pc_I;
			pc_Px();
		}
	}
	pc_wx();
}

var pc_RD = false;

function pc_SD(pc_jA, pc_kA)
{
	pc_NA = parseInt(pc_jA);
	pc_OA = pc_kA;
	pc_RD = true;
	pc_fC(false);
}

function pc_hA()
{
	pc_RD = false;
	pc_fC(false);
}

function pc_TD()
{
	if(pc_cw != "opened")return;
	pc_cw = "minimized";
	pc_fC(false);
}

function pc_UD()
{
	if(pc_cw != "minimized")return;
	pc_cw = "opened";
	pc_fC(false);
}

function PCJSF_Support_Close()
{
	if((pc_cw == "closed") || (pc_cw == "embedded"))return;
	pc_cw = "closed";
	pc_fC(false);
	pc_Wv(0);
}

function pc_xD()
{
	if(pc_cw == "minimized")pc_UD();
	if(pc_cw == "opened")return;
	if(pc_cw == "embedded")return;
	pc_cw = "opened";
	pc_fC(false);
}

function XtDirect_Open()
{
	pc_xD();
}

function XtDirect_IsOperatorAvailable()
{
	if(!pc_wC)return -1;
	return pc_gy;
}

function XtDirect_SetConnectedCallback(pc_Av)
{
	pc_xC = pc_Av;
}

function XtDirect_SetAutoOpenCallback(pc_Av)
{
	pc_AB = pc_Av;
}

function pc_VD(pc_Ns)
{
	pc_BB += "," + pc_Ns;
}

function pc_WD()
{
	return pc_sx();
}

function pc_XD(pc_Av)
{
	pc_vx = pc_Av;
}

function ISL_ISF_UserOpenNormal()
{
	XtDirect_Open();
}

function PCJSF_Support_Cycle()
{
	if(pc_qA && (!pc_AD) && (!pc_BD))
	{
		pc_pC();
	}
}

function pc_iw()
{
	if(!pc_oB)return;
	if(pc_qB > 0)
	{
		var YD = Math.max(pc_Jv, pc_Kv);
		if(((new Date).getTime() - YD) < pc_qB)return;
	}
	var pc_Cu = pc_Ay + "Public/alert";
	if(pc_zC != pc_Cu)
	{
		pc_zC = pc_Cu;
		if(typeof(ZD) == "function")
		{
			pc_AC = new ZD(pc_zC + ".mp3");
			if(pc_AC.canPlayType("audio/mpeg") == "")
			{
				if(pc_AC.canPlayType("audio/ogg") != "")
				{
					pc_AC = new ZD(pc_zC + ".ogg");
				}
				else
				{
					pc_AC = new ZD(pc_zC + ".wav");
				}
			}
		}
	}
	if(pc_AC)pc_AC.play();
}

if(window.XtDirect_Embedded)
{
	var pc_LB = 400;
	var pc_MB = 400;
	var PCJSF_Support_BorderColor = "#000000";
	if(window.XtDirect_Width)pc_LB = pc_L(window.XtDirect_Width);
	if(window.XtDirect_Height)pc_MB = pc_L(window.XtDirect_Height);
	if(isNaN(pc_LB))pc_LB = 400;
	if(isNaN(pc_MB))pc_MB = 400;
	if((pc_LB < 100) || (pc_LB > 2000))pc_LB = 400;
	if((pc_MB < 100) || (pc_MB > 2000))pc_MB = 400;
	if(window.XtDirect_BorderColor)PCJSF_Support_BorderColor = String(window.XtDirect_BorderColor);
	pc_cw = "embedded";
	if(window.XtDirect_ContainerDiv)
	{
		pc_Zy = window.XtDirect_ContainerDiv;
		if(window.XtDirect_ContainerDivDocument)pc_ss = window.XtDirect_ContainerDivDocument;
		if(window.XtDirect_ContainerDivWindow)pc_ts = window.XtDirect_ContainerDivWindow;
	}
	else if(window.XtDirect_ContainerId)
	{
		pc_Zy = pc_ss.getElementById(window.XtDirect_ContainerId);
	}
	else
	{
		pc_ss.write(pc_qC	(false, pc_LB, pc_MB, PCJSF_Support_BorderColor));
		pc_Zy = pc_ss.getElementById("PCJSF_Support_ContainerDiv");
	}
}

pc_ts["PCJSF_IntWin"] = window;
window["PCJSF_IntWin"] = window;

pc_iv();
pc_Bx();

setInterval("PCJSF_Support_Cycle()", pc_Yt ? pc_l : pc_k);
var pc_aD = "not_started";
var pc_Ay = "";
var pc_bD = 0;
var pc_cD = 0;
var pc_dD = null;
var pc_eD = 0;
var pc_fD = 0;
var pc_gD = 0;

function PCJSF_Processor_Process()
{
	pc_fD++;
	pc_gD = "Process" + pc_aD;
	switch(pc_aD)
	{
		case "not_started":
			var hD = pc_eu("PCJSF_Processor_SURL");
			if(hD)
			{
				var pc_Us = hD.indexOf("_");
				if(pc_Us >= 0) {
					var cs = parseFloat(hD.substr(0, pc_Us));
					var Rv = (new Date()).getTime();
					if((cs > Rv) || (cs > Rv - pc_Y * 3600 * 1000)) {
						hD = hD.substr(pc_Us + 1);
						pc_Ay = hD;
						pc_aD = "connect";
						PCJSF_Processor_Process();
						pc_fD--;
						return;
					}
				}
			}
			pc_aD = "server_url";
			PCJSF_Processor_Process();
			break;
		
		case "server_url":
			var pc_nu = new Array();
			pc_nu["indentify"] = new Array();
			pc_nu["indentify"]["location"] = String(window.XtDirect_LocationOverride ? window.XtDirect_LocationOverride : pc_ss.location);
			pc_aD = "wait_server_url";
			pc_zv(pc_T + "Public/Identify.php", pc_nu, function(pc_iD){pc_jD(pc_iD);}, pc_V);
			break;
			
		case "wait_server_url":
			break;
			
		case "connect":
			var pc_nu = new Array();
			pc_eD = 1;
			pc_kD(true, pc_nu);
			pc_eD = 0;
			pc_aD = "wait_connect";
			pc_zv(pc_Ay + "Public/Processor.php", pc_nu, function(pc_iD){pc_lD(true, pc_iD);}, pc_W);
			break;
			
		case "wait_connect":
			break;
			
		case "cycle":
			if(pc_dD)clearTimeout(pc_dD);
			pc_dD = null;
			if(pc_cD == 0)
			{
				pc_fD--;
				return;
			}
			var Rv = (new Date()).getTime();
			if(pc_cD <= Rv)
			{
				pc_aD = "cycle_send";
				PCJSF_Processor_Process();
				pc_fD--;
				return;
			}
			else
			{
				setTimeout("PCJSF_Processor_Process()", pc_cD - Rv);
				pc_fD--;
				return;
			}
			break;
			
		case "cycle_send":
			var pc_nu = new Array();
			pc_eD = 1;
			pc_kD(false, pc_nu);
			pc_eD = 0;
			if(pc_dD)clearTimeout(pc_dD);
			pc_dD = null;
			pc_cD = 0;
			pc_aD = "cycle_send_wait";
			pc_zv(pc_Ay + "Public/Processor.php", pc_nu, function(pc_iD){pc_lD(false, pc_iD);}, pc_W);
			break;
			
		case "cycle_send_wait":
			break;
		
		case "wait_for_reconnect":
			setTimeout("PCJSF_Processor_CommunicationState = \"server_url\"; PCJSF_Processor_Process();", pc_X);
			break;
	}
	pc_fD--;
}

function pc_jD(pc_iD)
{
	pc_fD++;
	pc_gD = "URLResponse";
	if(pc_iD != null)
	{
		var mD = (pc_iD["indentify"] !== undefined) ? pc_iD["indentify"] : null;
		if(mD)
		{
			var Es = (mD["result"] !== undefined) ? mD["result"] : "";
			if(Es === "not_found")
			{
				pc_aD = "idle";
				pc_fD--;
				return;
			}
			else if(Es === "found")
			{
				if(mD["location"] !== undefined)
				{
					pc_bD = 0;
					pc_Ay = mD["location"];
					pc_bu("PCJSF_Processor_SURL", (new Date()).getTime() + "_" + pc_Ay);
					pc_aD = "connect";
					PCJSF_Processor_Process();
					pc_fD--;
					return;
				}
			}
		}
	}
	pc_aD = "server_url";
	PCJSF_Processor_Process();
	pc_fD--;
}

function pc_lD(pc_Qv, pc_iD)
{
	pc_fD++;
	pc_gD = "Response";
	if(pc_iD != null)
	{
		pc_eD = 1;
		var nD = pc_oD(pc_Qv, pc_iD);
		pc_eD = 0;
		if(nD == 1)
		{
			pc_bD = 0;
			pc_aD = "cycle";
			PCJSF_Processor_Process();
			pc_fD--;
			return;
		}
	}
	pc_bD++;
	if(pc_Z == pc_bD)
	{
		pc_Ay = "";
		pc_aD = "wait_for_reconnect";
		PCJSF_Processor_Process();
		pc_fD--;
		return;
	}
	pc_aD = "wait_for_reconnect";
	PCJSF_Processor_Process();
	pc_fD--;
}

function pc_Wv(pc_pD)
{
	var Rv = (new Date()).getTime();
	var qD = Rv + pc_pD;
	var rE = 0;
	if((pc_cD == 0) || (qD < pc_cD))
	{
		pc_cD = qD;
		rE = 1;
	}
	if((rE) && (pc_aD == "cycle") && (pc_eD == 0))PCJSF_Processor_Process();
}

function pc_kD(pc_Qv, pc_nu)
{
	pc_Pv(pc_Qv, pc_nu);
	pc_PC(pc_Qv, pc_nu);
	pc_Gw(pc_Qv, pc_nu);
}

function pc_oD(pc_Qv, pc_iD)
{
	var Es = 1;
	if(pc_Xv(pc_Qv, pc_nu) == 0)Es = 0;
	if(pc_gC(pc_Qv, pc_nu) == 0)Es = 0;
	if(pc_Kw(pc_Qv, pc_nu) == 0)Es = 0;
	return Es;
}

function PCJSF_Processor_Guard()
{
	if(pc_fD > 0)
	{
		pc_fD = 0;
		pc_aD = "not_started";
		PCJSF_Processor_Process();
	}
}

setTimeout(function(){
	var sE = document.createElement("div");
	sE.setAttribute("id", "PCJSF_ScriptContainer");
	sE.style.display = "none";
	document.body.appendChild(sE);
	
	PCJSF_Processor_Process();
}, 50);

setInterval("PCJSF_Processor_Guard();", 5000);
