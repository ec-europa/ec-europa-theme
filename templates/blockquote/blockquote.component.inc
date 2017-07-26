<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_atomium_theme_hook().
 */
function europa_atomium_theme_blockquote() {
  return array(
    'blockquote' => array(
      'variables' => array(
        'body' => NULL,
        'author' => NULL,
      ),
      'template' => 'blockquote',
    ),
  );
}

/**
 * Implements hook_atomium_definition_hook().
 */
function europa_atomium_definition_blockquote() {
  return array(
    'label' => 'Blockquote',
    'description' => 'Blockquote.',
    'preview' => array(
      'body' => 'Blockquote body.',
      'author' => 'Blockquote author.',
    ),
  );
}

/**
 * Implements hook_preprocess_hook().
 */
function europa_preprocess_blockquote(&$variables, $hook) {
  $variables['attributes_array']['class'][] = 'ecl-blockquote';
}
