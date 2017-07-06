<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_html_tag(&$variables, $hook) {
  $headers = ['h1', 'h2', 'h3', 'h4', 'h5'];
  if (in_array($variables['element']['#tag'], $headers)) {
    $variables['attributes_array']['class'][] = 'ecl-heading';
    $variables['attributes_array']['class'][] = 'ecl-heading--' . $variables['element']['#tag'];
  }
}
