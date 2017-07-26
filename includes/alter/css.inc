<?php

/**
 * @file
 * css.inc
 */

/**
 * Implements hook_css_alter().
 */
function europa_css_alter(&$css) {
  $path_fancybox = libraries_get_path('fancybox');

  unset(
    $css[drupal_get_path('module', 'date') . '/date_api/date.css'],
    $css[$path_fancybox . '/helpers/jquery.fancybox-buttons.css'],
    $css[$path_fancybox . '/helpers/jquery.fancybox-thumbs.css'],
    $css[$path_fancybox . '/jquery.fancybox.css']
  );
}
