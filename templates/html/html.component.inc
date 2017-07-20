<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_preprocess_hook().
 */
function europa_preprocess_html(&$variables, $hook) {
  $this_theme_path = drupal_get_path('theme', 'europa');
  $variables['theme_path'] = $this_theme_path;
  $language = $variables['language'];

  if (isset($language->prefix)) {
    $variables['classes_array'][] = 'language-' . $language->prefix;
  }

  // Add the ie9 only css.
  drupal_add_css(
    $this_theme_path . '/assets/css/ie9.css',
    array(
      'browsers' => array(
        'IE' => 'IE 9',
        '!IE' => FALSE,
      ),
    )
  );
  // Add conditional js.
  $ie9_js = array(
    '#tag' => 'script',
    '#attributes' => array(
      'src' => file_create_url($this_theme_path . '/assets/js/ie9.js'),
    ),
    '#prefix' => '<!--[if IE 9]>',
    '#suffix' => '<![endif]-->',
  );
  drupal_add_html_head($ie9_js, 'ie9_js');

  // For some reason, the front page handles tokens different.
  if (drupal_is_front_page()) {
    $data = ['node' => menu_get_object('node')];
    $last_modified = array(
      '#tag' => 'meta',
      '#attributes' => array(
        'name' => 'last-modified',
        'content' => token_replace('[dt_tokens:dt_update_date]', $data),
      ),
    );
    drupal_add_html_head($last_modified, 'last_modified');
  }

  // Override splash screen title.
  $menu_item = menu_get_item();
  if (isset($menu_item['path']) && $menu_item['path'] == 'splash' && !variable_get('splash_screen_title_value', FALSE)) {
    $site_name = variable_get('site_name');
    $variables['head_title'] = $site_name;
    drupal_set_title($site_name);
  }
}
