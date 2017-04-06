<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_button(&$variables) {
  $variables['attributes_array']['class'][] = 'btn';
  $variables['attributes_array']['class'][] = 'btn-default';
}

