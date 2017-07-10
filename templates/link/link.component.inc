<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_link__default(&$variables) {
  $variables['attributes_array']['class'] = array(
    'ecl-button',
    'ecl-button--default',
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_link__primary(&$variables) {
  $variables['attributes_array']['class'] = array(
    'ecl-button',
    'ecl-button--primary',
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_link__secondary(&$variables) {
  $variables['attributes_array']['class'] = array(
    'ecl-button',
    'ecl-button--secondary',
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_link__call(&$variables) {
  $variables['attributes_array']['class'] = array(
    'ecl-button',
    'ecl-button--call',
    'ecl-button--caret-right',
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_link__timeline(&$variables) {
  $variables['attributes_array']['class'] = array(
    'ecl-button',
    'ecl-button--call',
    'ecl-button--caret-down',
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_link__caret_up(&$variables) {
  $variables['attributes_array']['class'] = array(
    'ecl-button',
    'ecl-button--default',
    'ecl-button--caret-up',
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_link__caret_right(&$variables) {
  $variables['attributes_array']['class'] = array(
    'ecl-button',
    'ecl-button--default',
    'ecl-button--caret-right',
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_link__caret_down(&$variables) {
  $variables['attributes_array']['class'] = array(
    'ecl-button',
    'ecl-button--default',
    'ecl-button--caret-down',
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_link__caret_left(&$variables) {
  $variables['attributes_array']['class'] = array(
    'ecl-button',
    'ecl-button--default',
    'ecl-button--caret_left',
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_link__primary_block(&$variables) {
  $variables['attributes_array']['class'] = array(
    'ecl-button',
    'ecl-button--primary',
    'ecl-button--block',
    'ecl-button--caret-down',
  );
}
