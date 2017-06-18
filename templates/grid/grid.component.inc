<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_atomium_theme_HOOK().
 */
function europa_atomium_theme_grid() {
  return array(
    'grid' => array(
      'variables' => array(
        'title' => NULL,
        'caption' => NULL,
        'rows' => array(),
        'attributes_array' => array('class' => array('ecl-container')),
        'row_classes' => array(),
        'column_classes' => array(),
      ),
      'template' => 'grid',
    ),
  );
}

/**
 * Implements hook_atomium_definition_HOOK().
 */
function europa_atomium_definition_grid() {
  return array(
    'label' => 'Grid',
    'description' => 'Grid layout.',
    'preview' => array(
      'title' => 'A grid title',
      'caption' => 'A grid caption',
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
