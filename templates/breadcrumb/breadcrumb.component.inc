<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_atomium_definition_HOOK().
 */
function europa_atomium_definition_breadcrumb() {
  return array(
    'label' => 'Breadcrumb',
    'description' => 'Site breadcrumb.',
    'preview' => array(
      'breadcrumb' => array(
        array(
          '#theme' => array('link'),
          '#text' => 'Home',
          '#href' => '/',
        ),
        array(
          '#theme' => array('link'),
          '#text' => 'News',
          '#href' => '/',
        ),
        array(
          '#theme' => array('link'),
          '#text' => t('My news title'),
          '#href' => '/',
        ),
      ),
    ),
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_breadcrumb(&$variables, $hook) {
  if (empty($variables[$hook])) {
    return;
  }
  $variables['here'] = t('You are here');
  $variables['attributes_array']['class'][] = 'ecl-breadcrumbs__segments-wrapper';
  $breadcrumb_items = array();
  foreach ($variables[$hook][$hook]['#items'] as $key => $item) {
    if (isset($item['#text'])) {
      $item['#text'] = array(
        '#markup' => $item['#text'],
        '#theme_wrappers' => array('html_tag'),
        '#tag' => 'span',
        '#attributes' => array(
          'class' => array(
            'ecl-breadcrumbs__text',
          ),
        ),
      );
    }
    $item['link']['#options']['attributes_array']['class'][] = 'ecl-breadcrumbs__link';
    $item['#attributes']['class'][] = 'ecl-breadcrumbs__segment';

    $breadcrumb_items[] = $item;

  }
  $variables[$hook] = array(
    $hook => array(
      '#theme' => array('item_list'),
      '#items' => $breadcrumb_items,
      '#type' => 'ol',
      '#wrapper' => FALSE,
      '#attributes' => $variables['attributes_array'],
    ),
    'suffix' => array(
      '#markup' => '...',
      '#theme_wrappers' => array('html_tag'),
      '#tag' => 'span',
      '#attributes' => array(
        'class' => array(
          'ecl-breadcrumbs__btn-separator',
        ),
        'style' => 'display: none;',
      ),
    ),
  );
}
