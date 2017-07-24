<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_atomium_theme_hook().
 */
function europa_atomium_theme_views_mini_pager() {
  return array(
    'views_mini_pager' => array(
      'variables' => array(
        'tags' => array(),
        'element' => 0,
        'parameters' => array(),
        'quantity' => 1,
        // This is only for hook_atomium_definition_hook().
        'pager_page_array' => NULL,
        'pager_total' => NULL,
      ),
      'template' => 'views-mini-pager',
    ),
  );
}

/**
 * Implements hook_preprocess_hook().
 */
function europa_preprocess_views_mini_pager(&$variables, $hook) {
  $variables[$hook]['#theme'] = 'pager';
  $variables[$hook]['#quantity'] = 1;
}
