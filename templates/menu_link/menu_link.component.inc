<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Override theme_menu_link().
 */
function europa_menu_link__user_menu(&$variables) {

  $variables['element']['#attributes']['class'][] = 'site-user-menu__option';
  return theme_menu_link($variables);
}

/**
 * Override theme_menu_link().
 */
function europa_menu_link__menu_nexteuropa_service_links(&$variables) {
  return _europa_menu_link__footer($variables);
}

/**
 * Override theme_menu_link().
 */
function europa_menu_link__menu_service_tools(&$variables) {
  return _europa_menu_link__footer($variables);
}

/**
 * Override theme_menu_link().
 */
function europa_menu_link__menu_nexteuropa_social_media(&$variables) {
  return _europa_menu_link__footer($variables);
}

/**
 * Override theme_menu_link().
 */
function europa_menu_link__menu_nexteuropa_inst_links(&$variables) {
  return _europa_menu_link__footer($variables);
}

/**
 * Override theme_menu_link().
 */
function europa_menu_link__menu_nexteuropa_site_links(&$variables) {
  return _europa_menu_link__footer($variables);
}
