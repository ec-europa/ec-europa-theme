<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_atomium_theme_hook().
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
      ),
    ),
  );
}

/**
 * Implements hook_atomium_definition_hook().
 */
function europa_atomium_definition_site_header() {
  return array(
    'label' => 'Site Header',
    'description' => 'Site header.',
    'preview' => array(),
  );
}

/**
 * Implements hook_preprocess_hook().
 */
function europa_preprocess_site_header(&$variables, $hook) {
  $variables['logo'] = array(
    '#theme' => 'logo',
    '#title' => 'Home - European Commission',
    '#attributes_array' => array(
      'class' => array('ecl-site-header__logo'),
    ),
  );
}
