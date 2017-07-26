<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_preprocess_hook().
 */
function europa_preprocess_menu_tree__main_menu(&$variables, $hook) {
  if (isset($variables['#tree'])) {
    $children = element_children($variables['#tree']);
    if (isset($children[0])) {
      $item = $variables['#tree'][$children[0]];
      if ($item) {
        $original_link = $item['#original_link'];
        $menu = menu_load($original_link['menu_name']);
        $variables['title'] = $menu['title'];
        if ($variables['depth'] > 1) {
          $variables['attributes_array']['id'][] = 'nav-menu-expandable-group-' . $original_link['plid'];
        }
        if ($variables['depth'] == 1) {

          $variables['attributes_array']['class'][] = 'ecl-navigation-menu__root';
          $variables['attributes_array']['id'][] = 'nav-menu-expandable-root';
        }
        else {
          $variables['attributes_array']['class'][] = 'ecl-navigation-menu__group';
        }
      }
    }
  }
}

/**
 * Implements hook_preprocess_hook().
 */
function europa_preprocess_menu_tree__user_menu(&$variables, $hook) {
  global $user;
  $variables['logged_in_user'] = '';
  if (!user_is_anonymous()) {
    $variables['logged_in_user'] = t('Logged in as %username', array('%username' => format_username($user)));
  }
  $variables['attributes_array']['class'][] = 'site-user-menu__list';
}

/**
 * Implements hook_preprocess_hook().
 */
function europa_preprocess_menu_tree__menu_nexteuropa_service_links(&$variables, $hook) {
  $variables['attributes_array']['class'][] = 'ecl-footer__menu';
  $variables['attributes_array']['class'][] = 'ecl-list-inline';
}

/**
 * Implements hook_preprocess_hook().
 */
function europa_preprocess_menu_tree__menu_service_tools(&$variables, $hook) {
  $variables['attributes_array']['class'][] = 'ecl-footer__menu';
  $variables['attributes_array']['class'][] = 'ecl-list-inline';
}

/**
 * Implements hook_preprocess_hook().
 */
function europa_preprocess_menu_tree__menu_nexteuropa_social_media(&$variables, $hook) {
  $variables['attributes_array']['class'][] = 'ecl-footer__menu';
  $variables['attributes_array']['class'][] = 'ecl-list-inline';
}

/**
 * Implements hook_preprocess_hook().
 */
function europa_preprocess_menu_tree__menu_nexteuropa_inst_links(&$variables, $hook) {
  $variables['attributes_array']['class'][] = 'ecl-footer__menu';
}

/**
 * Implements hook_preprocess_hook().
 */
function europa_preprocess_menu_tree__menu_nexteuropa_site_links(&$variables, $hook) {
  $variables['attributes_array']['class'][] = 'ecl-footer__menu';
}

/**
 * Implements hook_preprocess_hook().
 */
function europa_preprocess_menu_tree__secondary(&$variables, $hook) {
  // TODO: is this still necessary ?
  $variables['attributes_array']['class'][] = 'menu';
  $variables['attributes_array']['class'][] = 'nav';
  $variables['attributes_array']['class'][] = 'navbar-nav';
  $variables['attributes_array']['class'][] = 'secondary';
}
