<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_links(&$variables, $hook) {
  // Links can be empty.
  if (empty($variables['links'])) {
    return;
  }

  foreach ($variables['links']['links']['#items'] as &$link) {
    $link['link']['#options']['attributes_array']['class'][] = 'ecl-link';
    $link['link']['#options']['attributes_array']['class'][] = 'ecl-link--standalone';
  }
}
