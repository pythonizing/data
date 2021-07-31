




/*
     FILE ARCHIVED ON 0:34:17 Jan 9, 2013 AND RETRIEVED FROM THE
     INTERNET ARCHIVE ON 16:25:23 Aug 11, 2016.
     JAVASCRIPT APPENDED BY WAYBACK MACHINE, COPYRIGHT INTERNET ARCHIVE.

     ALL OTHER CONTENT MAY ALSO BE PROTECTED BY COPYRIGHT (17 U.S.C.
     SECTION 108(a)(3)).
*/

(function(window, undefined) {
  // ensure we reference the correct document
  var document = window.document;
  
  var ListHubTracker = (function() {
    var baseEventUrl = document.location.protocol + '//tracking.listhub.net/images/event.gif';
    
    // allow the user to call ListHubTracker directly
    var ListHubTracker = function(conf, event, data) {
      if (conf === undefined) {
        return {
          submit: function(event, data) {}
        }
      }
      var tracker = new ListHubTracker.fn.init(conf);
      if (event !== undefined && data !== undefined) {
        tracker.submit(event, data);
      }
      return tracker;
    };
    
    // define ListHubTracker functions
    ListHubTracker.fn = ListHubTracker.prototype = {
      
      init: function(conf) {
        if (typeof conf === 'string') {
          this.conf = { 'provider': conf };
        } else {
          this.conf = conf;
        }
      },
      
      submit: function(event, data) {
        // if data is either a string or an object, put it in an array
        if (typeof data === 'string' || data.splice === undefined) {
          data = [data];
        }
        for (var element in data) {
          // don't iterate over inherited properties
          if (data.hasOwnProperty(element)) {
            var params = new Object();
            var value = data[element];
            if (typeof value === 'string') {
              params['lid'] = value;
            } else {
              // it's a map
              for (var prop in value) {
                // don't iterate over inherited properties
                if (value.hasOwnProperty(prop)) {
                  params[prop] = value[prop];
                }
              }
            }
            params.cid = this.conf['provider'];
            params.evt = (this.conf['test'] == true) ? 'QA_' + event : event;
            params.ref = (this.conf['referrer'] === undefined) ? document.referrer : this.conf['referrer'];
            params.ocid = (this.conf['upstream'] === undefined) ? '' : this.conf['upstream'];
            params.t = new Date().getTime();
            this.send(params);
          }
        }
      },
      
      send: function(params) {
        (new Image()).src = this.createUrl(params);
      },
      
      createUrl: function(params) {
        var parts = [];
        parts.push(this.conf['base'] === undefined ? baseEventUrl : this.conf['base']);
        if (params !== undefined) {
          var sep = "?";
          if (typeof params === "string") {
            if (params[0] != "?") {
              parts.push(sep);
            }
            parts.push(params);
          } else {
            for (param in params) {
              if (params.hasOwnProperty(param)) {
                parts.push(sep);
                parts.push(escape(param));
                var value = params[param];
                if (value !== undefined) {
                  parts.push("=");
                  parts.push(escape(value));
                }
                sep = "&";
              }
            }
          }
        }
        return parts.join("");
      }
    };
    
    // allows the user to instantiate ListHubTracker
    ListHubTracker.fn.init.prototype = ListHubTracker.fn;

    // set the GLOBAL ListHubTracker instance
    return (window.ListHubTracker = ListHubTracker);

  })();
  
})(window);

// maintain backwards compatibility
function _listhub_tracker(listingId, channelId, event, origChan, referrer, eventUrl) {
  try { if ((typeof _listhub_tracker_qa != 'undefined') && _listhub_tracker_qa) { event = 'QA_' + event; } } catch (err) {}
  ListHubTracker({provider: channelId, upstream: origChan, referrer: referrer, base: eventUrl}, event, listingId);
  return true;
}
