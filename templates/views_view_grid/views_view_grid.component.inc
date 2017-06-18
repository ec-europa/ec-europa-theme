<?php

/**
 * @file
 * Contains grid component file.
 */

/**
 * Implements hook_atomium_theme_HOOK().
 */
function europa_atomium_theme_views_view_grid() {
  return array(
    'views_view_grid' => array(
      'variables' => array(
        'title' => NULL,
        'rows' => NULL,
      ),
      'template' => 'views-view-grid',
    ),
  );
}
