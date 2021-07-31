




/*
     FILE ARCHIVED ON 4:12:41 Jan 27, 2016 AND RETRIEVED FROM THE
     INTERNET ARCHIVE ON 21:29:56 Aug 11, 2016.
     JAVASCRIPT APPENDED BY WAYBACK MACHINE, COPYRIGHT INTERNET ARCHIVE.

     ALL OTHER CONTENT MAY ALSO BE PROTECTED BY COPYRIGHT (17 U.S.C.
     SECTION 108(a)(3)).
*/
function ChatSystem_RetrieveLocalValue(id) {
	if(!localStorage || !localStorage.getItem)return null;
	return localStorage.getItem(id);
}

function ChatSystem_FindSubElementsByType(element, elementType, nodes) {
	if(!nodes)nodes = [];
	if(element.nodeName && (element.nodeName.toLowerCase() == elementType))nodes.push(element);
	for(var i = 0; i < element.childNodes.length; i++) {
		var childNode = element.childNodes[i];
		ChatSystem_FindSubElementsByType(childNode, elementType, nodes);
	}
	return nodes;
}

function ChatSystem_CompactSpace(text) {
	var result = "";
	var isSpace = true;
	var lastNoSpaceLength = 0;
	for(var i = 0; i < text.length; i++) {
		var current = text.charAt(i);
		if((current == " ") || (current == "\t") || (current == "\r") || (current == "\n")) {
			if(!isSpace) {
				result += " ";
				isSpace = true;
			}
		}
		else {
			result += current;
			isSpace = false;
			lastNoSpaceLength = result.length;
		}
	}
	return result.substr(0, lastNoSpaceLength);
}

function  ChatSystem_ExtractPlainText(element) {
	var text = "";
	if(element.nodeType == 3) {
		text += element.textContent;
	}
	for(var i = 0; i < element.childNodes.length; i++) {
		var childNode = element.childNodes[i];
		if(childNode.nodeType == 1) {
			text += ChatSystem_ExtractPlainText(childNode);
		}
		else if(childNode.nodeType == 3) {
			text += childNode.textContent;
		}
	}
	return ChatSystem_CompactSpace(text);
}


function LoadChatSystem() {
	var isCentury21CoreProperty = false;
	var locationValue = "" + document.location;
	locationValue = locationValue.toLowerCase();
	if(locationValue.indexOf("century21.com") >= 0) {
		var contactSections = document.getElementsByClassName("contactAddress");
		if(contactSections) {
			for(var i = 0; i < contactSections.length; i++) {
				var html = contactSections[i].innerHTML;
				if(html.indexOf("CENTURY 21 Core Partners") >= 0) {
					isCentury21CoreProperty = true;
					if(!window.Fliber_TopicMap) {
						var idValue = locationValue;
						var index = idValue.indexOf("?");
						if(index >= 0)idValue = idValue.substr(0, index);
						index = idValue.indexOf("#");
						if(index >= 0)idValue = idValue.substr(0, index);
						index = idValue.lastIndexOf("/");
						if(index >= 0)idValue = idValue.substr(index + 1);
						
						var imageUrl = null;
						var imageSection = document.getElementById("largeImagePreview");
						if(imageSection) {
							var images = ChatSystem_FindSubElementsByType(imageSection, "img");
							if(images.length > 0) {
								imageUrl = images[0].getAttribute("rel");
							}
						}
						
						var price = "";
						var priceSections = document.getElementsByClassName("mainPropPrice");
						if(priceSections && (priceSections.length > 0)) {
							var bolds = ChatSystem_FindSubElementsByType(priceSections[0], "b");
							if(bolds.length > 0) {
								price = ChatSystem_ExtractPlainText(bolds[0]);
							}
						}
						
						var title = "";
						var bodyLeftLaneSection = document.getElementById("BodyLeftLane");
						if(bodyLeftLaneSection) {
							var laneTitles = document.getElementsByClassName("LaneTitle");
							for(var i = 0; i < laneTitles.length; i++) {
								var laneTitle = laneTitles[i];
								var parentMatch = false;
								var current = laneTitle;
								while(current) {
									if(current == bodyLeftLaneSection) {
										parentMatch = true;
										break;
									}
									current = current.parentNode;
								}
								if(parentMatch) {
									var headers = ChatSystem_FindSubElementsByType(laneTitle, "h1");
									if(headers.length > 0) {
										title = ChatSystem_ExtractPlainText(headers[0]);
										break;
									}
								}
							}
						}
						
						var accountName = "";
						var accountNames = ChatSystem_FindSubElementsByType(contactSections[i], "a");
						if(accountNames.length > 0) {
							accountName = ChatSystem_ExtractPlainText(accountNames[0]);
						}
						
						if(idValue && (idValue.length > 0) && imageUrl && (imageUrl.length > 0)) {
							var propertyInfo =
								{
									"Id": idValue,
									"AgentId": "master",
									"Image": imageUrl, "ImageText": price, "ImageUrl": ("" + document.location),
									"Title": accountName,
									"Location": title,
								};
							window.Fliber_TopicMap = {};
							window.Fliber_TopicMap[propertyInfo.Id] = propertyInfo;
						}
					}
				}
			}
		}
	}

	var hasRecentPortalChat = false;
	var hasActiveChatsTime = ChatSystem_RetrieveLocalValue("HasActiveChatsTime");
	if(hasActiveChatsTime) {
		var hasActiveChatsTimeValue = parseInt(hasActiveChatsTime);
		if(!isNaN(hasActiveChatsTimeValue)) {
			if(Math.abs(hasActiveChatsTimeValue - (new Date()).getTime()) < 60000)hasRecentPortalChat = true;
		}
	}
	
	if(isCentury21CoreProperty || hasRecentPortalChat) {
		var scriptElement = document.createElement("script");
		scriptElement.setAttribute("type", "text/javascript");
		scriptElement.setAttribute("src", "/web/20160127041241/https://c21chat.com/InlineTracker.js");
		document.body.appendChild(scriptElement);
	}
	else {
		var scriptElement = document.createElement("script");
		scriptElement.setAttribute("type", "text/javascript");
		scriptElement.setAttribute("src", "/web/20160127041241/http://chat.xtdirect.com/Chat/MasterServer/Public/ScriptProviderReal.php");
		document.body.appendChild(scriptElement);
	}
}
LoadChatSystem();