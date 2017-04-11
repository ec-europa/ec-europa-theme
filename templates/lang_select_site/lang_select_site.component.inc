<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_atomium_theme_HOOK().
 */
function europa_atomium_theme_lang_select_site() {
  return array(
    'lang_select_site' => array(
      'template' => 'lang-select-site',
      'variables' => array(
        'lang' => NULL,
      ),
    ),
  );
}

/**
 * Implements hook_atomium_definition_HOOK().
 */
function europa_atomium_definition_lang_select_site() {
  return array(
    'label' => 'Site language selector',
    'description' => 'Site language selector.',
    'preview' => array(),
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_lang_select_site(&$variables, $hook) {
  $variables['lang'] = 'fr';
}
