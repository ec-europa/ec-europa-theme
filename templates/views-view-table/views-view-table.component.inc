<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_preprocess_views_view_table().
 */
function europa_preprocess_views_view_table(&$variables) {
  // We needs this patch in order to have the <tfoot> tag working properly:
  // https://www.drupal.org/node/806982#comment-12035531
  $variables['classes'][] = 'table-responsive';
}
