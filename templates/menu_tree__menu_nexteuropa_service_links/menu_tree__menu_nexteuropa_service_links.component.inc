<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_menu_tree__menu_nexteuropa_service_links(&$variables) {
  return _europa_menu_tree_footer($variables['tree'], TRUE);
}