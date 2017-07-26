/**
 * @file
 * File component related behaviors.
 */

(function ($) {
  Drupal.behaviors.dt_file = {
    attach: function (context) {
      "use strict";
      var $button = $('.file__translations-control');

      $button.click(function (event) {
        $(event.target).toggleClass('is-collapsed');
      });
    }
  };
})(jQuery);
