<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_atomium_theme_HOOK().
 */
function europa_atomium_theme_views_view_table() {
  return array(
    'views_view_table' => array(
      'variables' => array(
        'header' => NULL,
        'footer' => NULL,
        'rows' => array(),
        'attributes' => array(),
        'caption' => NULL,
        'colgroups' => array(),
        'sticky' => TRUE,
        'empty' => '',
        'header_attributes' => array(),
        'row_attributes' => array(),
        'column_attributes' => array(),
      ),
      'template' => 'views-view-table',
    ),
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_views_view_table(&$variables, $hook) {
  $variables['attributes_array']['class'][] = 'ecl-table';

  foreach ($variables['header'] as $field_name => $label) {
    $variables['header_attributes'][$field_name]['scope'] = 'col';
    $variables['header_attributes'][$field_name]['class'][] = isset($variables['header_classes'][$field_name]) ? $variables['header_classes'][$field_name] : NULL;
  }

  foreach ($variables['rows'] as $row_key => $row) {
    $variables['row_attributes'][$row_key] = array();

    foreach ($row as $column_key => $column) {
      $variables['column_attributes'][$row_key][$column_key] = array();
    }
  }
}

/**
 * Implements hook_process_HOOK().
 */
function europa_process_views_view_table(&$variables, $hook) {
  foreach ($variables['header'] as $field_name => $label) {
    $variables['header_attributes'][$field_name] = atomium_drupal_attributes($variables['header_attributes'][$field_name]);
  }

  foreach ($variables['rows'] as $row_key => $row) {
    $variables['row_attributes'][$row_key] = atomium_drupal_attributes($variables['row_attributes'][$row_key]);

    foreach ($row as $column_key => $column) {
      $variables['column_attributes'][$row_key][$column_key] = atomium_drupal_attributes($variables['column_attributes'][$row_key][$column_key]);
    }
  }
}
