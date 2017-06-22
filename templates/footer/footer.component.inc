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
      'variables' => array(),
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
    ),
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_footer(&$variables, $hook) {
  $variables['footer_left'] = block_get_blocks_by_region('footer_left');
  $variables['footer_right'] = block_get_blocks_by_region('footer_right');
  $variables['footer_middle'] = block_get_blocks_by_region('footer_middle');
  $variables['footer_bottom'] = block_get_blocks_by_region('footer_bottom');
}
