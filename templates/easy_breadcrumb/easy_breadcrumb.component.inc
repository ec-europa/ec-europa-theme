<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_atomium_theme_HOOK().
 */
function europa_atomium_theme_easy_breadcrumb() {
  return array(
    'easy_breadcrumb' => array(
      'variables' => array(
        'segments_quantity' => NULL,
        'breadcrumb' => NULL,
      ),
      'template' => 'easy-breadcrumb',
    ),
  );
}

/**
 * Implements hook_atomium_definition_HOOK().
 */
function europa_atomium_definition_easy_breadcrumb() {
  return array(
    'label' => 'Easy breadcrumb',
    'description' => 'Easy breadcrumb.',
    'preview' => array(
      'prefix' => '<div style="background-color: #004494; padding: 5px 15px 15px; float: left; width: 100%;">',
      'suffix' => '</div>',
      'segments_quantity' => 3,
      'breadcrumb' => array(
        array(
          'content' => 'Home',
          'url' => '/',
        ),
        array(
          'content' => 'News',
          'url' => '/',
        ),
        array(
          'content' => '',
        ),
      ),
    ),
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_easy_breadcrumb(&$variables, $hook) {
  $variables['attributes_array']['class'][] = 'ecl-breadcrumbs';
  $variables['here'] = t('You are here');

  _europa_breadcrumb_menu($variables);
  $breadcrumb = $variables['breadcrumb'];
  $segments_quantity = $variables['segments_quantity'];
  $html = '';

  if ($segments_quantity > 0) {
    for ($i = 0, $s = $segments_quantity; $i < $segments_quantity; ++$i) {
      $item = $breadcrumb[$i];

      // Removing classes from $item['class'] array and adding BEM classes.
      $classes = array();
      if (isset($item['class'])) {
        $classes = $item['class'];
      }
      $classes[] = 'ecl-breadcrumbs__segment';

      $attributes = [
        'class' => ['ecl-breadcrumbs__link'],
      ];

      if ($i == 0) {
        $classes[] = 'ecl-breadcrumbs__segment--first';
        $attributes['class'][] = 'is-internal';
        $attributes += ['rel' => 'home'];
      }
      elseif ($i == ($s - 1)) {
        $classes[] = 'ecl-breadcrumbs__segment--last';
      }

      $class = implode(' ', $classes);
      $full_item = $item['content'];
      if (isset($item['url'])) {
        $full_item = l($item['content'], $item['url'], [
          'attributes' => $attributes,
          'html' => TRUE,
        ]);
      }

      // TODO: Check if the active class actually appears.
      $element_visibility = in_array('active',
        $classes) ? ' element-invisible' : '';
      $html .= '<li class="' . $class . $element_visibility . '">' . $full_item . '</li>';
    }
  }

  $variables[$hook] = $html;
}

/**
 * Generate the first breadcrumb items basing on a custom menu.
 */
function _europa_breadcrumb_menu(&$variables) {
  module_load_include('inc', 'easy_breadcrumb', 'includes/easy_breadcrumb.blocks');

  $menu_links = menu_tree('menu-breadcrumb-menu');
  $new_items = array();
  global $language;
  $front = drupal_is_front_page();

  if (!empty($menu_links)) {
    $i = 0;
    foreach ($menu_links as $key => $menu_item) {
      if (is_numeric($key)) {
        // We don't want to show the home link in the home page.
        if (!($front && $menu_item['#href'] == '<front>')) {
          $options = ['language' => $language];
          $title = token_replace($menu_item['#title'], $menu_item,
            $options);
          $new_items[] = _easy_breadcrumb_build_item($title, array(),
            $menu_item['#href']);
          $i++;
        }
      }
    }

    if (!empty($new_items)) {
      // The menu is used as the starting point of the breadcrumb.
      $variables['breadcrumb'] = array_merge($new_items,
        (array) $variables['breadcrumb']);
      // Alter the number of segments in the breadcrumb.
      $variables['segments_quantity'] += $i;
    }
  }
}
