<?php

/**
 * @file
 * Contains component file.
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

/**
 * Implements hook_atomium_definition_HOOK().
 */
function europa_atomium_definition_views_view_grid() {
  return array(
    'label' => 'Grid for Views',
    'description' => 'Views grid layout.',
    'preview' => array(
      'title' => 'A grid template',
      'rows' => array(
        array(
          'Entry first line 1',
          'Entry first Line 2',
        ),
        array(
          'Entry line 1.',
          'Entry line 2.',
        ),
        array(
          'Entry last line 1.',
          'Entry last line 2.',
        ),
      ),
    ),
  );
}
