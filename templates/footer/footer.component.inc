<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_atomium_theme_hook().
 */
function europa_atomium_theme_footer() {
  return array(
    'footer' => array(
      'variables' => array(
        'footer_left' => NULL,
        'footer_right' => NULL,
        'footer_middle' => NULL,
        'footer_bottom' => NULL,
        'footer_improved' => NULL,
      ),
      'template' => 'footer',
    ),
  );
}

/**
 * Implements hook_atomium_definition_hook().
 */
function europa_atomium_definition_footer() {
  return array(
    'label' => 'Footer',
    'description' => 'Footer.',
    'preview' => array(
      'footer_left' => NULL,
      'footer_right' => NULL,
      'footer_middle' => NULL,
      'footer_bottom' => NULL,
      'footer_improved' => NULL,
    ),
  );
}
