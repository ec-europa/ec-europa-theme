<?php

/**
 * @file
 * Menu_local_tasks.preprocess.inc.
 */

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_menu_local_tasks(&$variables, $hook) {
  // Primary menu tabs preprocess.
  if (isset($variables['primary']) && !empty($variables['primary'])) {
    // Quite the theme implementation set in Atomium in order to
    // define the template as expected.
    unset($variables['primary']['#theme']);
    unset($variables['primary']['#type']);

    $variables['menu_tab_links'] = $variables['primary']['#items'];
    $variables['primary']['#attributes']['class'][] = 'ecl-navigation';
    $variables['primary']['#attributes']['class'][] = 'ecl-navigation--tabs';
  }

  // Secondary menu tabs preprocess.
  if (isset($variables['secondary']) && !empty($variables['secondary'])) {
    $variables['secondary']['#attributes']['class'][] = 'nav';
    $variables['secondary']['#attributes']['class'][] = 'nav-pills';
  }
}
