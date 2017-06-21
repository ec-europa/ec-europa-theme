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
    'preview' => array(),
  );
}

