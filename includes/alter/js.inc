<?php

/**
 * @file
 * js.inc
 */

/**
 * Implements hook_js_alter().
 */
function europa_js_alter(&$js) {
  $path_fancybox = libraries_get_path('fancybox');

  unset(
    $js[$path_fancybox . '/jquery.fancybox.pack.js'],
    $js[$path_fancybox . '/helpers/jquery.fancybox-thumbs.js'],
    $js[$path_fancybox . '/helpers/jquery.fancybox-buttons.js'],
    $js[$path_fancybox . '/helpers/jquery.fancybox-media.js']
  );
}
