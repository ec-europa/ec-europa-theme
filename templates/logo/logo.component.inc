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
        'classes' => array(),
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
    'preview' => array(),
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function atomium_preprocess_logo(&$variables) {
  if (!empty($variables['type'])) {
    switch ($variables['type']) {
      case 'below':
        $variables['classes'][] = 'ecl-logo--logotypebelow';
        break;

      case 'right':
        $variables['classes'][] = 'ecl-logo--logotype';
        break;

    }
  }
  if (!empty($variables['classes'])) {
    if (is_array($variables['classes'])) {
      $variables['classes'] = implode(' ', $variables['classes']);
    }
    $variables['classes'] = ' ' . $variables['classes'];
  }
}
