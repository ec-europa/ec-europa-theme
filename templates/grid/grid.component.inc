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
        'row_attributes' => array(),
        'column_attributes' => array(),
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

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_grid(&$variables, $hook) {
  foreach ($variables['rows'] as $row_key => $row) {
    $variables['row_attributes'][$row_key] = array(
      'class' => array(
        'ecl-row',
      ),
    );

    foreach ($row as $column_key => $column) {
      $variables['column_attributes'][$column_key] = array(
        'class' => array(
          'ecl-column',
        ),
      );
    }
  }
}

/**
 * Implements hook_process_HOOK().
 */
function europa_process_grid(&$variables, $hook) {
  foreach ($variables['rows'] as $row_key => $row) {
    $variables['row_attributes'][$row_key] = atomium_drupal_attributes($variables['row_attributes'][$row_key]);

    foreach ($row as $column_key => $column) {
      $variables['column_attributes'][$row_key][$column_key] = atomium_drupal_attributes($variables['column_attributes'][$column_key]);
    }
  }
}
