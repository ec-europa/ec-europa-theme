<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_menu_tree(&$variables, $hook) {
  if (isset($variables['#tree'])) {
    $children = element_children($variables['#tree']);
    if (isset($children[0])) {
      $item = $variables['#tree'][$children[0]];
      if ($item) {
        $original_link = $item['#original_link'];
        switch ($original_link['menu_name']) {
          case 'main-menu':
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
            break;
        }
      }
    }
  }

}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_menu_tree__user_menu(&$variables) {
  $tree = $variables['tree'];
  global $user;
  $logged_in_user = '';
  if ($user->uid > 0) {
    $logged_in_user = t('Logged in as %username', array('%username' => format_username($user)));
  }
  return '<ul class="site-user-menu__list">' . $logged_in_user . $tree . '</ul>';
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_menu_tree__menu_nexteuropa_service_links(&$variables) {
  return _europa_menu_tree_footer($variables['tree'], TRUE);
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_menu_tree__menu_service_tools(&$variables) {
  return _europa_menu_tree_footer($variables['tree'], TRUE);
}

/**
 * Europa theme wrapper function for the EC menu links.
 *
 * @see theme_menu_tree()
 */
function europa_menu_tree__menu_nexteuropa_social_media(&$variables) {
  return _europa_menu_tree_footer($variables['tree'], TRUE);
}

/**
 * Europa theme wrapper function for the EC menu links.
 *
 * @see theme_menu_tree()
 */
function europa_menu_tree__menu_nexteuropa_inst_links(&$variables) {
  return _europa_menu_tree_footer($variables['tree']);
}

/**
 * Europa theme wrapper function for the EC menu links.
 *
 * @see theme_menu_tree()
 */
function europa_menu_tree__menu_nexteuropa_site_links(&$variables) {
  return _europa_menu_tree_footer($variables['tree']);
}

/**
 * Bootstrap theme wrapper function for the primary menu links.
 */
function europa_menu_tree__secondary(&$variables) {
  return '<ul class="menu nav navbar-nav secondary">' . $variables['tree'] . '</ul>';
}

/**
 * Create the needed wrapper for menus in the footer.
 */
function _europa_menu_tree_footer($tree, $inline = FALSE) {
  $classes[] = 'footer__menu';

  if ($inline) {
    $classes[] = 'ul-list-inline';
  }

  return '<ul class="' . implode(' ', $classes) . '">' . $tree . '</ul>';
}
