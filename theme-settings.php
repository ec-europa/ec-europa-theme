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

  $form['europa']['improved'] = [
    '#type' => 'fieldset',
    '#title' => t('Europa settings about improved websites'),
  ];

  $form['europa']['improved']['ec_europa_improved_website'] = [
    '#type' => 'checkbox',
    '#title' => t('Is this an "improved website"?'),
    '#description' => t('If the website is an "improved" one, it will display a site identification element in the page header.'),
    '#default_value' => theme_get_setting('ec_europa_improved_website', 'europa'),
    '#weight' => 0,
  ];

  $form['europa']['improved']['ec_europa_improved_identification'] = [
    '#type' => 'checkbox',
    '#title' => t('Do you want to display the site identification element?'),
    '#description' => t('You can find a demo of the site identification <a href="@here">in the Europa styleguide</a>', ['@here' => 'https://ec-europa.github.io/ec-europa-theme/section-page-header.html#kssref-page-header-4']),
    '#default_value' => theme_get_setting('ec_europa_improved_identification', 'europa'),
    '#weight' => 0,
  ];

  $form['europa']['improved']['ec_europa_improved_website_home'] = [
    '#type' => 'checkbox',
    '#title' => t('Do you want to display the site identification also in the home page?'),
    '#description' => t('The site identification could duplicate your page title in homepage, you can hide it.'),
    '#default_value' => theme_get_setting('ec_europa_improved_website_home', 'europa'),
    '#weight' => 0,
    '#states' => [
      'visible' => [
        ':input[name="ec_europa_improved_identification"]' => [
          'checked' => TRUE,
        ],
      ],
    ],
  ];

  $form['europa']['improved']['ec_europa_improved_website_header'] = [
    '#type' => 'radios',
    '#title' => t('Select the type of page header for your website'),
    '#description' => t('You can choose between two different layouts for your page header, see <a href="@here">in the Europa styleguide</a>', ['@here' => 'https://ec-europa.github.io/ec-europa-theme/section-page-header.html']),
    '#default_value' => theme_get_setting('ec_europa_improved_website_header', 'europa'),
    '#options' => [
      'basic' => t('Basic'),
      'complete' => t('Complete'),
    ],
    '#weight' => 0,
    '#states' => [
      'visible' => [
        ':input[name="ec_europa_improved_website"]' => [
          'checked' => TRUE,
        ],
      ],
    ],
  ];
}
