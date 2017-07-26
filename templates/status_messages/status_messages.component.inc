<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_atomium_theme_hook().
 */
function europa_atomium_theme_status_messages() {
  return array(
    'status_messages' => array(
      'variables' => array(
        'messages' => array(),
      ),
      'template' => 'status-messages',
    ),
  );
}

/**
 * Implements hook_atomium_definition_hook().
 */
function europa_atomium_definition_status_messages() {
  return array(
    'label' => 'Status messages',
    'description' => 'Status messages.',
    'preview' => array(
      'messages' => array(
        'success' => array(
          'Success message',
        ),
        'informative' => array(
          'Informative message',
        ),
        'warning' => array(
          'Warning message',
        ),
        'error' => array(
          'Error message',
        ),
        'live_stream' => array(
          'Live Stream message',
        ),
        'status' => array(
          'Status message 1',
          'Status message 2',
        ),
      ),
    ),
  );
}

/**
 * Implements hook_preprocess_hook().
 */
function europa_preprocess_status_messages(&$variables, $hook) {
  $status_heading = array(
    'success' => t('Success message'),
    'informative' => t('Informative message'),
    'live_stream' => t('Live Stream message'),
  );

  $status_modifier = array(
    'success' => 'success',
    'informative' => 'informative',
    'live_stream' => 'live_stream',
    'status' => 'success',
    'warning' => 'warning',
    'error' => 'error',
  );

  foreach ($variables['status_messages']['status_messages'] as $type => &$messages) {
    if (!empty($status_modifier[$type])) {
      $messages['modifier'] = $status_modifier[$type];
    }

    if ((empty($messages['messages']['#title'])) && (!empty($status_modifier[$type]))) {
      $messages['messages']['#title'] = $status_heading[$type];
    }
    $messages['status_heading'] = $messages['messages']['#title'];

    if (empty($messages['messages']['#attributes']['class'])) {
      $messages['messages']['#attributes']['class'] = array();
    }
    $messages['messages']['#attributes']['class'][] = "ecl-message__body";
    $messages['messages']['#attributes']['class'][] = "ecl-list";
  }
}
