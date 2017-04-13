<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_atomium_theme_HOOK().
 */
function europa_atomium_theme_site_header() {
  return array(
    'site_header' => array(
      'template' => 'site-header',
      'variables' => array(
        'logo' => array(
          '#theme' => array('logo'),
        ),
        'lang_select_site' => array(
          '#theme' => array('lang_select_site'),
        ),
        'search_bar' => array(
          '#theme' => array('search_bar'),
        ),
        'site_slogan' => NULL,
        'site_name' => NULL,
      ),
    ),
  );
}

/**
 * Implements hook_atomium_definition_HOOK().
 */
function europa_atomium_definition_site_header() {
  return array(
    'label' => 'Site Header',
    'description' => 'Site header.',
    'preview' => array(),
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_site_header(&$variables, $hook) {
  if (drupal_is_front_page() && !empty(variable_get('site_slogan'))) {
    $variables['site_slogan'] = array(
      '#type' => 'html_tag',
      '#tag' => 'p',
      '#value' => variable_get('site_slogan'),
    );
  }
  $variables['site_name'] = variable_get('site_name', '');
}
