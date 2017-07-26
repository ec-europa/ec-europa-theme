<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_atomium_definition_hook().
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
 * Implements hook_preprocess_hook().
 */
function europa_preprocess_table(&$variables, $hook) {
  $variables['attributes']['class'][] = 'ecl-table';
}
