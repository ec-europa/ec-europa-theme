<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_atomium_theme_hook().
 */
function europa_atomium_theme_logo() {
  return array(
    'logo' => array(
      'template' => 'logo',
      'variables' => array(
        'title' => NULL,
        'type' => NULL,
      ),
    ),
  );
}

/**
 * Implements hook_atomium_definition_hook().
 */
function europa_atomium_definition_logo() {
  return array(
    'label' => 'Logo',
    'description' => 'Logo.',
    'preview' => array(
      'title' => 'Home - European Commission',
    ),
  );
}

/**
 * Implements hook_preprocess_hook().
 */
function europa_preprocess_logo(&$variables, $hook) {
  $variables['attributes_array'] += array(
    'class' => array(),
    'href' => 'https://ec.europa.eu/info/index',
  );
  $variables['attributes_array']['title'] = $variables['title'];
  $variables['attributes_array']['class'][] = 'ecl-logo';

  if (!empty($variables['type'])) {
    switch ($variables['type']) {
      case 'below':
        $variables['attributes_array']['class'][] = 'ecl-logo--logotypebelow';
        break;

      case 'right':
        // TODO: Check if this is valid.
        $variables['attributes_array']['class'][] = 'ecl-logo--logotype';
        break;

    }
  }
}
