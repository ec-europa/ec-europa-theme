/**
 * @file
 * JS file for Europa theme.
 */

(function ($) {
  Drupal.behaviors.menu_tree = {
    attach: function (context) {
      ECL.megamenu('.ecl-navigation-menu__root');
      ECL.initExpandables('.ecl-navigation-menu__toggle');
    }
  };
})(jQuery);

