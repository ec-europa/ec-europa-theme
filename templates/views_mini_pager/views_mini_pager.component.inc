<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_atomium_theme_HOOK().
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
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_views_mini_pager(&$variables, $hook) {
  atomium_include('atomium', 'templates/pager/pager.component.inc');
  atomium_include('europa', 'templates/pager/pager.component.inc');

  atomium_preprocess_pager($variables, $hook);
  europa_preprocess_pager($variables, $hook);

  unset($variables[$hook][$hook]['#items']['pager_current']);
  unset($variables[$hook][$hook]['#items']['pager_ellipsis__2']);
  unset($variables[$hook][$hook]['#items']['pager_last']);
  unset($variables[$hook][$hook]['#items']['pager_first']);
}
