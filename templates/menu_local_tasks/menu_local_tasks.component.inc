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

    // Set the default nav title which is mandatory in the Europa component.
    $variables['primary']['#title'] = t('Navigation');
  }
}
