<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_atomium_theme_HOOK().
 */
function europa_atomium_theme_link() {
  return array(
    'link' => array(
      'template' => 'link',
      'variables' => array(
        'text' => NULL,
        'path' => NULL,
        'options' => array(),
        'prefix' => NULL,
      ),
    ),
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_link(&$variables, $hook) {
  if(FALSE === _europa_array_find('ecl-', $variables['attributes_array']['class'])){
    $variables['attributes_array']['class'][] = 'ecl-link';
    if (function_exists('url_is_external') && url_is_external($variables['path'])) {
      $variables['attributes_array']['class'][] = 'ecl-link--external';
    }
  }

  // Add the span tag for the icon.
  if(in_array('ecl-icon', $variables['attributes_array']['class'])){
    $icon_classes = array_filter($variables['attributes_array']['class'], function($class, $key) use (&$variables) {
      if (FALSE !== stripos($class, 'ecl-icon') || FALSE !== stripos($class, '__social-icon')) {
        unset($variables['attributes_array']['class'][$key]);
        return TRUE;
      }
      return FALSE;
    }, ARRAY_FILTER_USE_BOTH);

    $variables['prefix'] = array(
      '#type' => 'html_tag',
      '#tag' => 'span',
      '#attributes' => array(
        'class' => $icon_classes,
      ),
    );
  }
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_link__default(&$variables, $hook) {
  $variables['attributes_array']['class'] = array(
    'ecl-button',
    'ecl-button--default',
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_link__primary(&$variables, $hook) {
  $variables['attributes_array']['class'] = array(
    'ecl-button',
    'ecl-button--primary',
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_link__secondary(&$variables, $hook) {
  $variables['attributes_array']['class'] = array(
    'ecl-button',
    'ecl-button--secondary',
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_link__call(&$variables, $hook) {
  $variables['attributes_array']['class'] = array(
    'ecl-button',
    'ecl-button--call',
    'ecl-button--caret-right',
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_link__timeline(&$variables, $hook) {
  $variables['attributes_array']['class'] = array(
    'ecl-button',
    'ecl-button--call',
    'ecl-button--caret-down',
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_link__caret_up(&$variables, $hook) {
  $variables['attributes_array']['class'] = array(
    'ecl-button',
    'ecl-button--default',
    'ecl-button--caret-up',
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_link__caret_right(&$variables, $hook) {
  $variables['attributes_array']['class'] = array(
    'ecl-button',
    'ecl-button--default',
    'ecl-button--caret-right',
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_link__caret_down(&$variables, $hook) {
  $variables['attributes_array']['class'] = array(
    'ecl-button',
    'ecl-button--default',
    'ecl-button--caret-down',
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_link__caret_left(&$variables, $hook) {
  $variables['attributes_array']['class'] = array(
    'ecl-button',
    'ecl-button--default',
    'ecl-button--caret_left',
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_link__primary_block(&$variables, $hook) {
  $variables['attributes_array']['class'] = array(
    'ecl-button',
    'ecl-button--primary',
    'ecl-button--block',
    'ecl-button--caret-down',
  );
}
