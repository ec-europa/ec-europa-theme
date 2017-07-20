<?php

/**
 * @file
 * Implements component taxonomy_term.
 */

/**
 * Implements hook_preprocess_hook().
 */
function europa_preprocess_taxonomy_term(&$variables, $hook) {
  // Add default section component to the entity regions.
  $variables['left_classes'] = $variables['right_classes'] = $variables['central_classes'] = 'section';
  // Add information about the number of sidebars.
  if (!empty($variables['left']) && !empty($variables['right'])) {
    $variables['content_column_class'] = 'col-md-6';
  }
  elseif (!empty($variables['left']) || !empty($variables['right'])) {
    $variables['content_column_class'] = 'col-md-9';
  }
  else {
    $variables['content_column_class'] = 'col-md-12';
  }
  $variables['site_name'] = variable_get('site_name');
}
