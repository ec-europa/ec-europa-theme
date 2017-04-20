<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_card(&$variables, $hook) {
  $view = &$variables['view'];

  foreach ($variables['options'] as $id => $field) {
    if (isset($view->field[$field])) {
      $variables[$id] = $view->style_plugin->get_field($view->row_index, $field);
    }
  }
}
