<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_preprocess_views_view_table().
 */
function europa_preprocess_views_view_table(&$variables, $hook) {
  $variables['classes_array'][] = 'table-responsive';
}
