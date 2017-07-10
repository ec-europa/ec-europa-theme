<?php

/**
 * @file
 * Contains component file.
 */

function europa_preprocess_link__default(&$variables, $hook) {
  $variables['attributes_array']['class'] = array(
    'ecl-button',
    'ecl-button--default'
  );
}

function europa_preprocess_link__primary(&$variables, $hook) {
  $variables['attributes_array']['class'] = array(
    'ecl-button',
    'ecl-button--primary'
  );
}

function europa_preprocess_link__secondary(&$variables, $hook) {
  $variables['attributes_array']['class'] = array(
    'ecl-button',
    'ecl-button--secondary'
  );
}

function europa_preprocess_link__call(&$variables, $hook) {
  $variables['attributes_array']['class'] = array(
    'ecl-button',
    'ecl-button--call',
    'ecl-button--caret-right'
  );
}

function europa_preprocess_link__timeline(&$variables, $hook) {
  $variables['attributes_array']['class'] = array(
    'ecl-button',
    'ecl-button--call',
    'ecl-button--caret-down'
  );
}

function europa_preprocess_link__form(&$variables, $hook) {
  $variables['attributes_array']['class'] = array(
    'ecl-button',
    'ecl-button--form'
  );
}

function europa_preprocess_link__form_primary(&$variables, $hook) {
  $variables['attributes_array']['class'] = array(
    'ecl-button',
    'ecl-button--form'
  );
}

function europa_preprocess_link__caret_up(&$variables, $hook) {
  $variables['attributes_array']['class'] = array(
    'ecl-button',
    'ecl-button--default',
    'ecl-button--caret-up'
  );
}

function europa_preprocess_link__caret_right(&$variables, $hook) {
  $variables['attributes_array']['class'] = array(
    'ecl-button',
    'ecl-button--default',
    'ecl-button--caret-right'
  );
}

function europa_preprocess_link__caret_down(&$variables, $hook) {
  $variables['attributes_array']['class'] = array(
    'ecl-button',
    'ecl-button--default',
    'ecl-button--caret-down'
  );
}

function europa_preprocess_link__caret_left(&$variables, $hook) {
  $variables['attributes_array']['class'] = array(
    'ecl-button',
    'ecl-button--default',
    'ecl-button--caret_left'
  );
}

function europa_preprocess_link__primary_block(&$variables, $hook) {

  $variables['attributes_array']['class'] = array(
    'ecl-button',
    'ecl-button--primary',
    'ecl-button--block',
    'ecl-button--caret-down'
  );

}