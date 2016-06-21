/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages
         var LEAGUE_COSTS = {"Monday Night Advanced" : 30, "Men's League" : 10, "Wednesday Night Recreational" : 15};
         function update_cost() {
             var total = 0;
             var did_check = false;
             var leagues = [];
             $('input[name="item_meta[127][]"]').each(function() {
                 if (this.checked) {
                     if ((this.value === "Women's Advanced League" ||
                                        this.value === "Women's Rec League")) {
                                            if (!did_check) {
                                                total += 10;
                                                leagues.push("Women's League");
                                                did_check = true;
                                            }
                     } else {
                         leagues.push(this.value);
                         total += LEAGUE_COSTS[this.value];
                     }
                 }
             });
             var disc_val = $('input[name="item_meta[154]"]:checked');
             if (disc_val.val() === 'Yes') {
                 leagues.push("CMUA Disc");
                 total += 10;
             }
             
             leagues.push("Lights fee");
             total += 5;
             var description = leagues.join(", ");
             $('#field_hidden_cost').val(total);
             $('#field_hidden_description').val(description);
             $('#field_cost').val('$' + total + ' (' + description + ')');
	 }
	  function update_wildwood_cost() {
	      var total=10;
	      var leagues = ["4v4 Wildwood League"];
	      var disc_val = $('input[name="item_meta[197]"]:checked');
              if (disc_val.val() === 'Yes') {
                  leagues.push("CMUA Disc");
                  total += 10;
              }
	      var description = leagues.join(", ");
              $('#field_hidden_cost2').val(total);
              $('#field_hidden_description2').val(description);
              $('#field_cost2').val('$' + total + ' (' + description + ')');
	  }

          update_cost();
	  update_wildwood_cost();
         $('input[name="item_meta[127][]"]').change(function() {
             update_cost();
         });
         $('input[name="item_meta[154]"]').change(function(){
             update_cost();
         });
	  $('input[name="item_meta[197]"]').change(function(){
             update_wildwood_cost();
         });
          },
          finalize: function() {
            // JavaScript to be fired on all pages, after page specific JS is fired
          }
        },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
