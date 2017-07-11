<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_atomium_theme_HOOK().
 */
function europa_atomium_theme_logo() {
  return array(
    'logo' => array(
      'template' => 'logo',
      'variables' => array(
        'title' => '',
        'url' => '',
        'type' => '',
      ),
    ),
  );
}

/**
 * Implements hook_atomium_definition_HOOK().
 */
function europa_atomium_definition_logo() {
  return array(
    'label' => 'Logo',
    'description' => 'Logo.',
    'preview' => array(
      array(
        'title' => 'Home - European Commission',
        'url' => 'https://ec.europa.eu/info/index',
      ),
    ),
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function atomium_preprocess_logo(&$variables) {

  $variables['attributes_array']['title'] = $variables['title'];
  $variables['attributes_array']['href'] = $variables['url'];
  if (empty($variables['attributes_array']['class'])) {
    $variables['attributes_array']['class'] = array();
  }
  $variables['attributes_array']['class'][] = 'ecl-logo';
  if (!empty($variables['type'])) {
    switch ($variables['type']) {
      case 'below':
        $variables['attributes_array']['class'][] = 'ecl-logo--logotypebelow';
        break;

      case 'right':
        $variables['attributes_array']['class'][] = 'ecl-logo--logotype';
        break;

    }
  }
}
