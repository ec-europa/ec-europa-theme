<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_menu_link__main_menu(&$variables, $hook) {
  $link = $variables['element']['#original_link'];
  $variables['attributes_array']['class'][] = 'ecl-navigation-menu__item';
  $variables['output']['#options']['attributes']['class'][] = 'ecl-navigation-menu__link';
  if ($link['in_active_trail']) {
    if ($link['depth'] == 1) {
      $variables['attributes_array']['class'][] = 'ecl-navigation-menu__item--active';
    }
    else {
      $variables['output']['#options']['attributes']['class'][] = 'ecl-navigation-menu__link--active';
    }
  }
  // If the menu item has a submenu and has a depth of 1,
  // render it as a button.
  if (!empty($variables['sub_menu']) && $link['depth'] == 1) {
    $variables['output']['#options']['attributes']['id'][] = 'nav-menu-expandable-label-' . $link['mlid'];
    $variables['output']['#options']['attributes']['aria-controls'][] = 'nav-menu-expandable-group-' . $link['mlid'];
    $variables['output']['#options']['attributes']['aria-expanded'][] = 'false';
    $variables['output']['#options']['attributes']['aria-haspopup'][] = 'true';
    $variables['output'] = array(
      '#type' => 'html_tag',
      '#tag' => 'button',
      '#attributes' => $variables['output']['#options']['attributes'],
      '#value' => $variables['output']['#text'],
    );
  }
}

/**
 * Implements hook_preprocess_hook().
 */
function europa_preprocess_menu_link__user_menu(&$variables, $hook) {
  $variables['attributes_array']['class'][] = 'site-user-menu__option';
}

/**
 * Implements hook_preprocess_hook().
 */
function europa_preprocess_menu_link__menu_nexteuropa_service_links(&$variables, $hook) {
  $variables['attributes_array']['class'][] = 'ecl-footer__menu-item';
  $variables['attributes_array']['class'][] = 'ecl-list-inline__item';
}

/**
 * Implements hook_preprocess_hook().
 */
function europa_preprocess_menu_link__menu_service_tools(&$variables, $hook) {
  $variables['attributes_array']['class'][] = 'ecl-footer__menu-item';
  $variables['attributes_array']['class'][] = 'ecl-list-inline__item';
}

/**
 * Implements hook_preprocess_hook().
 */
function europa_preprocess_menu_link__menu_nexteuropa_social_media(&$variables, $hook) {
  $variables['attributes_array']['class'][] = 'ecl-footer__menu-item';
  $variables['attributes_array']['class'][] = 'ecl-list-inline__item';
}

/**
 * Implements hook_preprocess_hook().
 */
function europa_preprocess_menu_link__menu_nexteuropa_inst_links(&$variables, $hook) {
  $variables['attributes_array']['class'][] = 'ecl-footer__menu-item';
}

/**
 * Implements hook_preprocess_hook().
 */
function europa_preprocess_menu_link__menu_nexteuropa_site_links(&$variables, $hook) {
  $variables['attributes_array']['class'][] = 'ecl-footer__menu-item';
}
