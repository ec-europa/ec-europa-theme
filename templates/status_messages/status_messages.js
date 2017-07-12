/**
 * @file
 * JS file for Europa theme.
 */

(function ($) {
  Drupal.behaviors.status_messages = {
    attach: function (context) {
      ECL.initMessages();
    }
  };
})(jQuery);

