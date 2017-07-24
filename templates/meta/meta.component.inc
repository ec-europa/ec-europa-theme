<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_atomium_theme_hook().
 */
function europa_atomium_theme_meta() {
  return array(
    'meta' => array(
      'variables' => array(
        'type' => '',
        'timestamp' => '',
        'date' => '',
        'location'  => '',
      ),
      'template' => 'meta',
    ),
  );
}

/**
 * Implements hook_atomium_definition_hook().
 */
function europa_atomium_definition_meta() {
  return array(
    'label' => 'Meta',
    'description' => 'Meta.',
    'preview' => array(
      'type' => 'News article',
      'timestamp' => '2015-07-06T17:44:28+02:00',
      'date' => '6 July 2015',
      'location'  => 'Brussels',
    ),
  );
}

/**
 * Implements hook_preprocess_hook().
 */
function europa_preprocess_meta(&$variables, $hook) {
  $variables['attributes_array']['class'][] = 'ecl-meta';
}
