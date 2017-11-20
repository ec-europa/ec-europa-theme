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
        body = 'body',
        formContainer = '.views-exposed-form';

      $('.lang-select-site').on('click', 'a.lang-select-site__link', function (event) {
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
          if (e.keyCode === 27) {
            closeSplashScreen();
          }
        });

        // Add queryString to link if has some values on exposed form.
        if ($(formContainer).length > 0 && location.search.substr(1) !== '') {
          $overlay.once('europa_lang_select_site', function (event) {
            // Add handler to link.
            $overlay.on('click', 'a.splash-page__btn-language', function (event) {
              var parameters = prepareFormValues();
              if (parameters) {
                $(this).attr('href', $(this).attr('href') + '?' + $.param(parameters));
              }
            });
          });
        }

        // Prevent the default click, if javascript is disabled this link
        // will keep on working.
        event.preventDefault();
      });

      // Get form fields and return an array of this values.
      function prepareFormValues() {
        var parameters = {};
        // Get all inputs and exclude buttons hiddens text and unchecked checkboxes
        // + input text with datepicker.
        $(formContainer)
          .find(":input:not(:button, :hidden, :text, input:checkbox:not(:checked)), .js-hide input.date-picker-parent")
          .each(function () {
            // Exclude empty values.
            if (this.value !== '') {
              parameters[this.name] = encodeURIComponent(this.value);
            }
          });

        return (Object.keys(parameters).length === 0) ? false : parameters;
      }

    }
  };
})(jQuery);
