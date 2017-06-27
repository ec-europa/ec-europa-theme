<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_atomium_theme_HOOK().
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
 * Implements hook_atomium_definition_HOOK().
 */
function europa_atomium_definition_footer() {
  return array(
    'label' => 'Footer',
    'description' => 'Footer.',
    'preview' => array(
      'footer_left' => block_get_blocks_by_region('footer_left'),
      'footer_right' => block_get_blocks_by_region('footer_right'),
      'footer_middle' => block_get_blocks_by_region('footer_middle'),
      'footer_bottom' => block_get_blocks_by_region('footer_bottom'),
      'footer_improved' => block_get_blocks_by_region('footer_improved'),
    ),
  );
}
