<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_atomium_theme_hook().
 */
function europa_atomium_theme_expandable() {
  return array(
    'expandable' => array(
      'variables' => array(
        'title' => NULL,
        'body' => NULL,
        'id' => NULL,
        'icon' => NULL,
      ),
      'template' => 'expandable',
    ),
  );
}

/**
 * Implements hook_atomium_definition_hook().
 */
function europa_atomium_definition_expandable() {
  return array(
    'label' => 'Expandable',
    'description' => 'Expandable layout.',
    'preview' => array(
      'title' => 'Title line 1',
      'body' => 'Text block first Line 1',
      'id' => 'test1',
      'icon' => 'icon icon--yellowbg icon--growth',
    ),
  );
}
