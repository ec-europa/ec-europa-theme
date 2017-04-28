<?php

/**
 * @file
 * theme-settings.php
 */

/**
 * Implements hook_form_system_theme_settings_alter().
 */
function europa_form_system_theme_settings_alter(&$form, &$form_state) {
  // Build the form.
  if (empty($form['europa'])) {
    $form['europa'] = [
      '#type' => 'fieldset',
      '#title' => t('Europa settings'),
    ];
  }

  $form['europa']['ec_europa_improved_website'] = [
    '#type' => 'checkbox',
    '#title' => t('Is this an "improved website"?'),
    '#default_value' => theme_get_setting('ec_europa_improved_website', 'europa'),
  ];
}
