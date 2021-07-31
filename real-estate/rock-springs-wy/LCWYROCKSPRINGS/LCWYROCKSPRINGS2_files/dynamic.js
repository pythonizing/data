




/*
     FILE ARCHIVED ON 0:34:18 Jan 9, 2013 AND RETRIEVED FROM THE
     INTERNET ARCHIVE ON 16:25:24 Aug 11, 2016.
     JAVASCRIPT APPENDED BY WAYBACK MACHINE, COPYRIGHT INTERNET ARCHIVE.

     ALL OTHER CONTENT MAY ALSO BE PROTECTED BY COPYRIGHT (17 U.S.C.
     SECTION 108(a)(3)).
*/
window.disableGATracking=false;window.disableListHubTracking=false;window.disableBingMap=false;window.disablePanoramio=false;window.disableFacebookAuth=false;window.cookieDomain='.century21.com';




$(document).ready(function() { 
   $('#myc21Username').html(''); 

   // Create a helper frame for XSS transactions
   var jFrame = $('<iframe style="display: none" />');
//   jFrame.get(0).onload = function() {
//     window.proxyAjax = jFrame.get(0).contentWindow.proxyAjax;
//   };
   jFrame.attr('src', portalAjax.getPersonalUrl() + '/js/iframe.proxy.html');
   $(document.body).append(jFrame);
   
   var loggedin = 'false';
   if(loggedin == 'true') {
      myc21.toggleLogInState();
      $("#saveSearch").show();
      $("#saveSearch").css({'display':'block'});
      
      $(".myNotesContainer").show();
      $(".myNotesContainer").css({'display':'block'});
      
      $("#myNotesContainerTitle").show();
      $("#myNotesContainerTitle").css({'display':'block'});
      
      $("#propertyNote").val("");
   }  else {
      $("#saveSearch").show();
      $("#saveSearch").css({'display':'block'});

      //show the login screen for the user to sign in
      if($("body").hasClass("liquidLayout")) {      
         $("#saveSearch").find("#saveSearchButton").attr("onclick", "Track.doEvent('Hybrid Mapping', 'Left Lane', 'Select Login to My C21 to Save Search'); myc21.loginForm.open(true);");
      } else {
         $("#saveSearch").find("#saveSearchButton").attr("onclick", "myc21.loginForm.open(true);");
      }   
   }
   
});     

//ViewSession Javascript 
var ViewSession = new function() {

   //Favorites:
   //Load the fav properties
   var favoriteProperties = new Array();
   var index = 0;
   
            
   //Load the fav agents   
   var favoriteAgents = new Array();
   var index = 0;
   
            
   //Load the fav offices
   var favoriteOffices = new Array();
   var index = 0;
   
        
   //Hidden:
   //Load the hidden properties
   var hiddenProperties = new Array();
   var index = 0;
   
            
   //Load the hidden agents   
   var hiddenAgents = new Array();
   var index = 0;
   
            
   //Load the hidden offices
   var hiddenOffices = new Array();
   var index = 0;
   
        
            
   // FIXME: This function will only return accurate favorites from the initially loaded page
   //        BUT since the user can change favorites w/o reloading the page, the
   //        information eventually becomes outdated...
   function arrayContains(arr, value) {
       var i = arr.length;
       while (i--) {
           if (arr[i] === value) return true;
       }
       return false;
   }    
   
   /**
    * Set the favorite [blank]   
    * @param aItems {Array} the items to check against
    * @param elId {String|jQuery} the element to change
    * @param sId {String} the item's id
    * @return {Boolean} True if the item is a favorite, otherwise False
    */
   var setFavorite = function(aItems, elId, sId) {
      var jEl = (typeof elId == "string") ? $("#" + elId) : elId,
         bFavorite = arrayContains(aItems, sId);

      jEl.toggleClass('favorite', bFavorite);
      return bFavorite;
   }

   this.setFavoriteProperty = function(elId, sId) {
      return setFavorite(favoriteProperties, elId, sId);
   }
   
   //Set the favorite agent   
   this.setFavoriteAgent = function(elId, sId) {
      return setFavorite(favoriteAgents, elId, sId);
   }            
   
   //Set the favorite office   
   this.setFavoriteOffice = function(elId, sId) {
      return setFavorite(favoriteOffices, elId, sId);
   }            
   
   //Set the Hidden property   
   this.setHiddenProperty = function(elId, sId) {
      if (arrayContains(hiddenProperties, sId)) {
         $("#" + elId).addClass('hidden');
      }   
   }            
   
   //Set the Hidden agent   
   this.setHiddenAgent = function(elId, sId) {
      if (arrayContains(hiddenAgents, sId)) {
         $("#" + elId).addClass('hidden');
      }   
   }            
   
   //Set the Hidden office   
   this.setHiddenOffice = function(elId, sId) {
      if (arrayContains(hiddenOffices, sId)) {
         $("#" + elId).addClass('hidden');
      }   
   }     
      
   //Add a favorite property
   this.addFavoriteProperty = function(sId) {
      if (!arrayContains(favoriteProperties, sId)) {
         var lastIndex = favoriteProperties.length;
         favoriteProperties[lastIndex] = sId;
      }      
   }       
   
   //Remove a favorite property
   this.removeFavoriteProperty = function(sId) {
      if (arrayContains(favoriteProperties, sId)) {
         for(var i=0; i < favoriteProperties.length; i++ ) {
            if(favoriteProperties[i] == sId) {
               favoriteProperties.splice(i,1); 
            }           
         }
      }
   }
   
   //Add a Hidden property
   this.addHiddenProperty = function(sId) {
      if (!arrayContains(hiddenProperties, sId)) {
         var lastIndex = hiddenProperties.length;
         hiddenProperties[lastIndex] = sId;
      }      
   }       
   
   //Remove a Hidden property
   this.removeHiddenProperty = function(sId) {
      if (arrayContains(hiddenProperties, sId)) {
         for(var i=0; i < hiddenProperties.length; i++ ) {
            if(hiddenProperties[i] == sId) {
               hiddenProperties.splice(i,1); 
            }           
         }
      }
   }        
           
   //Add a favorite Agent
   this.addFavoriteAgent = function(sId) {
      if (!arrayContains(favoriteAgents, sId)) {
         var lastIndex = favoriteAgents.length;
         favoriteAgents[lastIndex] = sId;
      }      
   }       
   
   //Remove a favorite Agent
   this.removeFavoriteAgent = function(sId) {
      if (arrayContains(favoriteAgents, sId)) {
         for(var i=0; i < favoriteAgents.length; i++ ) {
            if(favoriteAgents[i] == sId) {
               favoriteAgents.splice(i,1); 
            }           
         }
      }
   }
   
   //Add a Hidden Agent
   this.addHiddenAgent = function(sId) {
      if (!arrayContains(hiddenAgents, sId)) {
         var lastIndex = hiddenAgents.length;
         hiddenAgents[lastIndex] = sId;
      }      
   }       
   
   //Remove a Hidden Agent
   this.removeHiddenAgent = function(sId) {
      if (arrayContains(hiddenAgents, sId)) {
         for(var i=0; i < hiddenAgents.length; i++ ) {
            if(hiddenAgents[i] == sId) {
               hiddenAgents.splice(i,1); 
            }           
         }
      }
   }
   
   //Add a favorite Office
   this.addFavoriteOffice = function(sId) {
      if (!arrayContains(favoriteOffices, sId)) {
         var lastIndex = favoriteOffices.length;
         favoriteOffices[lastIndex] = sId;
      }      
   }       
   
   //Remove a favorite Office
   this.removeFavoriteOffice = function(sId) {
      if (arrayContains(favoriteOffices, sId)) {
         for(var i=0; i < favoriteOffices.length; i++ ) {
            if(favoriteOffices[i] == sId) {
               favoriteOffices.splice(i,1); 
            }           
         }
      }
   }
   
   //Add a Hidden Office
   this.addHiddenOffice = function(sId) {
      if (!arrayContains(hiddenOffices, sId)) {
         var lastIndex = hiddenOffices.length;
         hiddenOffices[lastIndex] = sId;
      }      
   }       
   
   //Remove a Hidden Office
   this.removeHiddenOffice = function(sId) {
      if (arrayContains(hiddenOffices, sId)) {
         for(var i=0; i < hiddenOffices.length; i++ ) {
            if(hiddenOffices[i] == sId) {
               hiddenOffices.splice(i,1); 
            }           
         }
      }
   }                           
}
