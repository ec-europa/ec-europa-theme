<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_atomium_definition_HOOK().
 */
function europa_atomium_definition_table() {
  return array(
    'label' => 'Tables',
    'description' => 'Tables.',
    'preview' => array(
      'header' => array(
        'Title 1',
        'Title 2',
        'Title 3',
      ),
      'rows' => array(
        array('body cell 1', 'body cell 2', 'body cell 3'),
        array('body cell 4', 'body cell 5', 'body cell 6'),
      ),
      'footer' => array(
        array('footer cell 1', 'footer cell 2', 'footer cell 3'),
        array('footer cell 4', 'footer cell 5', 'footer cell 6'),
      ),
    ),
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_table(&$variables, $hook) {
  // We needs this patch in order to have the <tfoot> tag working properly:
  // https://www.drupal.org/node/806982#comment-12035531
  $variables['attributes']['class'][] = 'table-responsive';
}

/**
 * Implements hook_preprocess_views_view_table().
 */
function europa_preprocess_views_view_table(&$variables) {
  $variables['classes_array'][] = 'table-responsive';
}
