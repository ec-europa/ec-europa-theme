<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_atomium_definition_HOOK().
 */
function europa_atomium_definition_button() {
  return array(
    'label' => 'Button',
    'description' => 'Button template.',
    'preview' => array(
      array(
        'type' => 'submit',
        'value' => 'Default',
        'attributes' => array(
          'class' => array(
            'ecl-button--default',
          ),
        ),
      ),
      array(
        'type' => 'submit',
        'value' => 'Primary',
        'attributes' => array(
          'class' => array(
            'ecl-button--primary',
          ),
        ),
      ),
      array(
        'type' => 'submit',
        'value' => 'Secondary',
        'attributes' => array(
          'class' => array(
            'ecl-button--secondary',
          ),
        ),
      ),
      array(
        'type' => 'submit',
        'value' => 'Call to action',
        'attributes' => array(
          'class' => array(
            'ecl-button--call',
            'ecl-button--caret-right',
          ),
        ),
      ),
      array(
        'type' => 'submit',
        'value' => 'Timeline',
        'attributes' => array(
          'class' => array(
            'ecl-button--default',
            'ecl-button--caret-down',
          ),
        ),
      ),
      array(
        'type' => 'submit',
        'value' => 'Icon: Caret up',
        'attributes' => array(
          'class' => array(
            'ecl-button--default',
            'ecl-button--caret-up',
          ),
        ),
      ),
      array(
        'type' => 'submit',
        'value' => 'Icon: Caret right',
        'attributes' => array(
          'class' => array(
            'ecl-button--default',
            'ecl-button--caret-right',
          ),
        ),
      ),
      array(
        'type' => 'submit',
        'value' => 'Icon: Caret down',
        'attributes' => array(
          'class' => array(
            'ecl-button--default',
            'ecl-button--caret-down',
          ),
        ),
      ),
      array(
        'type' => 'submit',
        'value' => 'Icon: Caret left',
        'attributes' => array(
          'class' => array(
            'ecl-button--default',
            'ecl-button--caret-left',
          ),
        ),
      ),
      array(
        'type' => 'submit',
        'value' => 'Primary button, block-wide, with caret-down',
        'attributes' => array(
          'class' => array(
            'ecl-button--primary',
            'ecl-button--block',
            'ecl-button--caret-down',
          ),
        ),
      ),
    ),
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_button(&$variables) {
  if (empty($variables['attributes_array']['class'])) {
    $variables['attributes_array']['class'] = array();
  }
  array_unshift($variables['attributes_array']['class'], 'ecl-button');

  if (_europa_array_find('ecl-button--', $variables['attributes_array']['class']) === FALSE) {
    $variables['attributes_array']['class'][] = 'ecl-button--default';
  }
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_button__primary(&$variables) {
  $variables['attributes_array']['class'] = array(
    'ecl-button--primary',
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_button__secondary(&$variables) {
  $variables['attributes_array']['class'] = array(
    'ecl-button--secondary',
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_button__call(&$variables) {
  $variables['attributes_array']['class'] = array(
    'ecl-button--call',
    'ecl-button--caret-right',
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_button__timeline(&$variables) {
  $variables['attributes_array']['class'] = array(
    'ecl-button--call',
    'ecl-button--caret-down',
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_button__caret_up(&$variables) {
  $variables['attributes_array']['class'] = array(
    'ecl-button--default',
    'ecl-button--caret-up',
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_button__caret_right(&$variables) {
  $variables['attributes_array']['class'] = array(
    'ecl-button--default',
    'ecl-button--caret-right',
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_button__caret_down(&$variables) {
  $variables['attributes_array']['class'] = array(
    'ecl-button--default',
    'ecl-button--caret-down',
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_button__caret_left(&$variables, $hook) {
  $variables['attributes_array']['class'] = array(
    'ecl-button--default',
    'ecl-button--caret_left',
  );
}

/**
 * Implements hook_preprocess_HOOK().
 */
function europa_preprocess_button__primary_block(&$variables, $hook) {
  $variables['attributes_array']['class'] = array(
    'ecl-button--primary',
    'ecl-button--block',
    'ecl-button--caret-down',
  );
}
