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

  $form['europa']['ec_europa_breadcrumb_menu'] = [
    '#type' => 'select',
    '#title' => t('Check the menu to be used at the beginning of your breadcrumb.'),
    '#options' => menu_get_menus(),
    '#description' => t('By default this is set to be the breadcrumb menu provided by the NextEuropa platform.'),
    '#default_value' => theme_get_setting('ec_europa_breadcrumb_menu', 'europa'),
  ];

  $form['europa']['ec_europa_improved_website'] = [
    '#type' => 'checkbox',
    '#title' => t('Is this an "improved website"?'),
    '#description' => t('If this website is an "improved" one, we are going to show a site identification element in the page header.'),
    '#default_value' => theme_get_setting('ec_europa_improved_website', 'europa'),
  ];

  $form['europa']['ec_europa_improved_website_home'] = [
    '#type' => 'checkbox',
    '#title' => t('Do you want to show the site identification also in the home page?'),
    '#description' => t('The site identification could duplicate your page title in homepage, you can hide it.'),
    '#default_value' => theme_get_setting('ec_europa_improved_website_home', 'europa'),
    '#states' => [
      'visible' => [
        ':input[name="ec_europa_improved_website"]' => [
          'checked' => TRUE,
        ],
      ],
    ],
  ];
}
