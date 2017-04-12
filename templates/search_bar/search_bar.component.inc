<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_atomium_theme_HOOK().
 */
function europa_atomium_theme_search_bar() {
  return array(
    'search_bar' => array(
      'template' => 'search-bar',
      'variables' => array(
        'search_form' => module_invoke('search', 'block_view'),
      ),
    ),
  );
}

/**
 * Implements hook_atomium_definition_HOOK().
 */
function europa_atomium_definition_search_bar() {
  return array(
    'label' => 'Site search bar',
    'description' => 'Site search bar.',
  );
}
