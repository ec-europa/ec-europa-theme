<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_atomium_theme_HOOK().
 */
function europa_atomium_theme_timelines() {
  return array(
    'timelines' => array(
      'variables' => array(
        'title' => NULL,
        'text' => NULL,
        'footer' => NULL,
      ),
      'template' => 'timelines',
    ),
  );
}

/**
 * Implements hook_atomium_definition_HOOK().
 */
function europa_atomium_definition_timelines() {
  return array(
    'label' => 'Timelines',
    'description' => 'Timelines.',
    'preview' => array(
      'title' => 'By late 2015',
      'text' => 'The Commission will convene the first energy infrastructure forum to discuss and find solutions to issues that are common to all regions across Europe.',
      'footer' => array(
        '#type' => 'button',
        '#value' => 'Show all timeline',
        '#attributes' => array(
          'class' => array(
            'btn',
            'btn-time',
            'btn-time-line',
          ),
        ),
      ),
    ),
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_timelines(&$variables, $hook) {
  $view = &$variables['view'];
  foreach ($variables['options'] as $id => $field) {
    if (isset($view->field[$field])) {
      $variables[$id] = $view->style_plugin->get_field($view->row_index, $field);
    }
  }
}
