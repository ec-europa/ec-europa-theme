<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_status_messages(&$variables, $hook) {
  $status_heading = array(
    'status' => t('Success'),
    'error' => t('Error'),
    'warning' => t('Warning'),
    'info' => t('Information'),
  );

  $variables += array(
    $hook => array(
      $hook => array(),
    ),
  );

  $output = array();
  foreach ($variables[$hook][$hook] as $type => $messages) {
    unset($messages['messages']['#title']);

    $output[$type] = array(
      '#theme' => array('europa_status_message__' . $type),
      '#message_classes' => array(
        $type,
        'alert',
      ),
      '#message_title' => $status_heading[$type],
      '#message_type' => $type . ' message',
      '#message_body' => $messages['messages'],
    );
  }

  $variables[$hook] = array(
    $hook => $output,
  );
}
