




/*
     FILE ARCHIVED ON 0:34:18 Jan 9, 2013 AND RETRIEVED FROM THE
     INTERNET ARCHIVE ON 16:25:25 Aug 11, 2016.
     JAVASCRIPT APPENDED BY WAYBACK MACHINE, COPYRIGHT INTERNET ARCHIVE.

     ALL OTHER CONTENT MAY ALSO BE PROTECTED BY COPYRIGHT (17 U.S.C.
     SECTION 108(a)(3)).
*/
var surroundingAreasMappingDefault=new function(){function a(){$("label.c21hoverstate").each(function(){var e=$(this),c=e.attr("for"),d=e.find("#"+c);if(d.is(":checked")){e.addClass("checked")}else{e.removeClass("checked")}})}function b(){$("label").each(function(){var e=$(this),c=e.attr("for"),d;if(c){d=e.find("#"+c)}else{return}if(d.length==0){return}e.addClass("c21hoverstate");d.change(function(){a()});e.hover(function(){if(!d.attr("disabled")){e.addClass("hover")}},function(){e.removeClass("hover")})})}this.initialize=function(){this.initSurroundingAreas();this.initRadiusSelect();$("#surroundingAreasOptionsContent").find($("select, input:checkbox, input:radio")).uniform();if(!$("#surroundingAreasRadio").attr("checked")&&!$("#surroundingRadiusRadio").attr("checked")){$("#surroundingRadiusRadio").attr("checked",true)}if($("#surroundingRadiusRadio").attr("checked")){this.surroundingRadiusRadioClicked()}else{if($("#surroundingAreasRadio").attr("checked")){this.surroundingAreasRadioClicked()}}b();a();$.uniform.update();$(".checker").removeClass("disabled")};this.initSurroundingAreas=function(){var d=$("#selectedSurroundingAreas").val();if(d!=null&&d.length>0){var c=d.split(",");$("#surroundingCheckContainer").find("input").each(function(h,g){for(var f=0;f<c.length;f++){if($(this).val()==c[f]){$(this).attr("checked",true)}}})}};this.initRadiusSelect=function(){var c=$("#surroundingRadiusSelect").val();if(c==null||c.length==0){$("#surroundingRadiusSelect").val(5)}};this.surroundingRadiusRadioClicked=function(){var c=$("#surroundingRadiusRadio").attr("checked");if(c){$("#surroundingRadiusSelect").attr("disabled",false);$("#surroundingCheckContainer").find("input").each(function(){$(this).attr("disabled",true);$(this).attr("checked",false)})}else{$("#surroundingRadiusSelect").attr("disabled","disabled");$("#surroundingCheckContainer").find("input").each(function(){$(this).attr("disabled",false)})}a();$.uniform.update();$(".checker").removeClass("disabled")};this.surroundingAreasRadioClicked=function(){var c=$("#surroundingAreasRadio").attr("checked");if(c=="checked"){$("#surroundingRadiusSelect").attr("disabled","disabled");$("#surroundingCheckContainer").find("input").each(function(){$(this).attr("disabled",false)})}else{$("#surroundingRadiusSelect").attr("disabled",false);$("#surroundingCheckContainer").find("input").each(function(){$(this).attr("disabled",true);$(this).attr("checked",false)})}a();$.uniform.update();$(".checker").removeClass("disabled")};this.reset=function(){$("#surroundingAreasOptionsContent").find($("input:checkbox")).each(function(){var c=$(this).attr("id");$("#"+c).attr("checked",false);$("#"+c).attr("disabled","disabled")});$("#surroundingRadiusRadio").attr("checked","checked");$("#surroundingRadiusSelect").val(5);$("#surroundingRadiusSelect").attr("disabled",false);a();$.uniform.update();$(".checker").removeClass("disabled")};this.search=function(){if($("#surroundingRadiusRadio").attr("checked")){portalResults.changeSurroundingAreas($("#surroundingRadiusSelect").val())}else{if($("#surroundingAreasRadio").attr("checked")){aAreas=[];$("#surroundingCheckContainer").find("input").each(function(){if($(this).attr("checked")){aAreas.push($(this).val())}});if(aAreas.length>0){portalResults.changeSurroundingAreas(null,aAreas)}}}Track.doEvent("Surrounding Areas Selector","Submit");modalWindows.closeWindow()}};