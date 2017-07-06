<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_atomium_theme_HOOK().
 */
function europa_atomium_theme_page_header() {
  return array(
    'page_header' => array(
      'variables' => array(
        'breadcrumb' => NULL,
        'identity' => NULL,
        'title' => NULL,
        'introduction' => NULL,
        'meta' => NULL,
      ),
      'template' => 'page-header',
    ),
  );
}

/**
 * Implements hook_atomium_definition_HOOK().
 */
function europa_atomium_definition_page_header() {
  return array(
    'label' => 'Page header',
    'description' => 'Page header.',
    'preview' => array(
      'breadcrumb' => array(
        '#theme' => array('breadcrumb'),
      ),
      'identity' => 'Digital single market',
      'title' => 'Business, Economy, Euro',
      'introduction' => 'EU economy, finance and the euro, and practical information for EU businesses and entrepreneurs on product safety, environmental regulations, trade with non-EU countries and competition rules.',
      'meta' => array(
        '#theme' => array('meta'),
        '#type' => 'News article',
        '#timestamp' => '2015-07-06T17:44:28+02:00',
        '#date' => '6 July 2015',
        '#location'  => 'Brussels',
      ),
    ),
  );
}
