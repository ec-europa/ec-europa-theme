<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_atomium_theme_HOOK().
 */
function europa_atomium_theme_europa_status_message(&$variables, $hook) {
  return array(
    'europa_status_message' => array(
      'template' => 'europa-status-message',
      'variables' => array(
        'message_classes' => '',
        'message_title' => '',
        'message_type' => '',
        'message_body' => '',
      ),
    ),
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_europa_status_message(&$variables) {
  if (!empty($variables['message_classes']) && is_array($variables['message_classes'])) {
    $variables['message_classes'] = ' ' . implode(' ', $variables['message_classes']);
  }
}
