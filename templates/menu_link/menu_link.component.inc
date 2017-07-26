<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_preprocess_hook().
 */
function europa_preprocess_menu_link(&$variables, $hook) {
  $variables['output']['#options']['attributes']['class'][] = 'ecl-link';
  $variables['output']['#options']['attributes']['class'][] = 'ecl-link--standalone';
}

/**
 * Implements hook_preprocess_hook().
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
function europa_preprocess_menu_link__menu_service_tools(&$variables, $hook) {
  $variables['attributes_array']['class'][] = 'ecl-list-inline__item';
}

/**
 * Implements hook_preprocess_hook().
 */
function europa_preprocess_menu_link__menu_nexteuropa_service_links(&$variables, $hook) {
  $variables['attributes_array']['class'][] = 'ecl-list-inline__item';
  $variables['output']['#options']['attributes']['class'] = array_diff(
    $variables['output']['#options']['attributes']['class'],
    array('ecl-link--standalone')
  );
}

/**
 * Implements hook_preprocess_hook().
 */
function europa_preprocess_menu_link__menu_nexteuropa_service_links__footer(&$variables, $hook) {
  $variables = _europa_menu_link_footer_alter($variables);
}

/**
 * Implements hook_preprocess_hook().
 */
function europa_preprocess_menu_link__menu_nexteuropa_social_media(&$variables, $hook) {
  $variables['attributes_array']['class'][] = 'ecl-list-inline__item';
  $variables['output']['#options']['attributes']['class'] = array_diff(
    $variables['output']['#options']['attributes']['class'],
    array('ecl-link--standalone')
  );
}

/**
 * Implements hook_preprocess_hook().
 */
function europa_preprocess_menu_link__menu_nexteuropa_social_media__footer(&$variables, $hook) {
  $variables = _europa_menu_link_footer_alter($variables);
}

/**
 * Implements hook_preprocess_hook().
 */
function europa_preprocess_menu_link__menu_nexteuropa_inst_links(&$variables, $hook) {
  $variables['output']['#options']['attributes']['class'] = array_diff(
    $variables['output']['#options']['attributes']['class'],
    array('ecl-link--standalone')
  );
}

/**
 * Implements hook_preprocess_hook().
 */
function europa_preprocess_menu_link__menu_nexteuropa_inst_links__footer(&$variables, $hook) {
  $variables = _europa_menu_link_footer_alter($variables);
}

/**
 * Implements hook_preprocess_hook().
 */
function europa_preprocess_menu_link__menu_nexteuropa_site_links(&$variables, $hook) {
  $variables['output']['#options']['attributes']['class'] = array_diff(
    $variables['output']['#options']['attributes']['class'],
    array('ecl-link--standalone')
  );
}

/**
 * Implements hook_preprocess_hook().
 */
function europa_preprocess_menu_link__menu_nexteuropa_site_links__footer(&$variables, $hook) {
  $variables = _europa_menu_link_footer_alter($variables);
}

/**
 * Alter specific menu link for the footer.
 *
 * @param array $variables
 *   The array of variables.
 *
 * @return array
 *   The array of variables.
 */
function _europa_menu_link_footer_alter(array $variables) {
  $variables['attributes_array']['class'][] = 'ecl-footer__menu-item';
  $variables['output']['#options']['attributes']['class'][] = 'ecl-footer__link';

  $classes = &$variables['output']['#options']['attributes']['class'];
  if (!empty($classes) && in_array('ecl-icon', $classes)) {
    $classes[] = 'ecl-footer__social-icon';
  }

  // As we pass the parameter with reference, this is not mandatory.
  // It is just to ensure compatibility with the two way of working.
  return $variables;
}
