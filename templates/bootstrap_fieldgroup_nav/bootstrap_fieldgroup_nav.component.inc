<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_preprocess_bootstrap_tabs().
 */
function europa_preprocess_bootstrap_fieldgroup_nav(&$variables) {
  drupal_add_js(drupal_get_path('theme', 'europa') . '/js/libraries/jquery-accessible-tabs.js');
  $group = &$variables['group'];

  $variables['nav_classes'] = '';

  switch ($group->format_settings['instance_settings']['bootstrap_nav_type']) {
    case 'tabs':
      $variables['nav_classes'] .= ' nav-tabs nav-tabs--with-content';
      break;

    case 'pills':
      $variables['nav_classes'] .= ' nav-pills';
      break;

    default:
  }

  if ($group->format_settings['instance_settings']['bootstrap_stacked']) {
    $variables['nav_classes'] .= ' nav-stacked';
  }

  $i = 0;
  foreach ($variables['items'] as $item) {
    // Check if item is not empty and we have access to it.
    if ($item && (!isset($item['#access']) || $item['#access'])) {

      $id = 'bootstrap-fieldgroup-nav-item--' . drupal_html_id($item['#title']);

      // Is an explicit nav item?
      if (!empty($item['#type']) && 'bootstrap_fieldgroup_nav_item' == $item['#type']) {
        $classes = $item['#group']->classes;
      }
      // Otherwise, just a regular field under the nav.
      else {
        $classes = '';
      }

      $variables['navs'][$i] = [
        'content' => l(
          $item['#title'],
          NULL,
          [
            'attributes' => [
              'data-toggle' => 'tab',
              'class' => ['js-tablist__link'],
            ],
            'fragment' => $id,
            'external' => TRUE,
            'html' => TRUE,
          ]
        ),
        'classes' => $classes,
      ];

      $variables['panes'][$i]['id'] = $id;
      $variables['panes'][$i]['title'] = check_plain($item['#title']);
      $i++;
    }
  }
}
