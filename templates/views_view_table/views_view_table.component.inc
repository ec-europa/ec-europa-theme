<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_preprocess_hook().
 */
function europa_preprocess_views_view_table(&$variables, $hook) {
  $variables['classes_array'][] = 'ecl-table';
  $variables['classes_array'][] = 'table-responsive';
}
