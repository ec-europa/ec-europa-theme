<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_atomium_theme_HOOK().
 */
function europa_atomium_theme_blockquote() {
  return array(
    'blockquote' => array(
      'variables' => array(
        'markup' => NULL,
      ),
      'template' => 'blockquote',
    ),
  );
}

/**
 * Implements hook_atomium_definition_HOOK().
 */
function europa_atomium_definition_blockquote() {
  return array(
    'label' => 'Blockquote',
    'description' => 'Blockquote.',
    'preview' => array(
      'markup' => 'Blockquote element.',
    ),
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_blockquote(&$variables, $hook) {
  $variables[$hook] = array(
    $hook => array(
      '#markup' => $variables['markup'],
    ),
  );
  $variables['attributes_array']['class'][] = 'ecl-blockquote';
}
