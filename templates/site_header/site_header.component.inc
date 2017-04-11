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
      'template' => 'site_header',
      'variables' => array(
        'dummy' => t('Home'),
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
