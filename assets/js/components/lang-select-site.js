/**
 * @file
 * Site level language switcher related behaviors.
 */

(function ($) {
  Drupal.behaviors.europa_lang_select_site = {
    attach: function (context) {
      var $overlay = $('.splash-page--overlay'),
          overlay = '.splash-page--overlay',
          closeBtn = '.splash-page__btn-close',
          body = 'body';

      $('.ecl-lang-select-sites').on('click', 'a.ecl-lang-select-sites__link', function (event) {
        // We only want to load it once.
        if (!$overlay.find(closeBtn).length) {
          $.get($(this).attr('href'), function (splashscreen) {
            // Store our object.
            var $jQueryObject = $($.parseHTML(splashscreen));
            // Output the part we want to our overlay.
            $overlay.html($jQueryObject.find('.page-content'))
          });
        }

        // Show overlay.
        $(overlay).show();
        $(body).addClass('disablescroll');

        // Hide frame helper function.
        var closeSplashScreen = function (event) {
          $(overlay).hide();
          $(body).removeClass('disablescroll');
        };

        // Hide frame on click.
        $overlay.on('click', closeBtn, function (event) {
          closeSplashScreen();
          // Prevent the actual close a href to trigger. This should only work
          // if javascript is disabled.
          event.preventDefault();
        });

        // Hide frame on pressing ESC.
        $(document).keyup(function (e) {
          // Escape key maps to keycode '27'.
          if (e.keyCode == 27) {
            closeSplashScreen();
          }
        });

        // Prevent the default click, if javascript is disabled this link
        // will keep on working.
        event.preventDefault();
      });
    }
  };
})(jQuery);
