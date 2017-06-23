<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_menu_link(&$variables, $hook) {
$link = $variables['element']['#original_link'];
  switch ($link['menu_name']) {
    case 'main-menu':
      $variables['attributes_array']['class'][] = 'ecl-navigation-menu__item';
      $variables['output']['#options']['attributes']['class'][] = 'ecl-navigation-menu__link';
      if ($link['in_active_trail']) {
        $variables['attributes_array']['class'][] = 'ecl-navigation-menu__item--active';
        $variables['output']['#options']['attributes']['class'][] = 'ecl-navigation-menu__link--active';
      }
      break;
  }
}

/**
 * Override theme_menu_link().
 */
function europa_menu_link__main_menu(&$variables) {

  echo '<pre>';
  print_r($variables);
  die();
  return theme_menu_link($variables);
}

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

/**
 * Helper applying BEM to footer menu item links.
 *
 * @param array $variables
 *   Link render array.
 *
 * @return string
 *   HTML markup
 */
function _europa_menu_link__footer(array &$variables) {
  $element = $variables['element'];
  $sub_menu = '';

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }

  $element['#attributes']['class'][] = 'footer__menu-item';

  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}
