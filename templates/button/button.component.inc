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
          ),
        ),
      ),
      array(
        'type' => 'submit',
        'value' => 'Form',
        'attributes' => array(
          'class' => array(
            'ecl-button--form',
          ),
        ),
      ),
      array(
        'type' => 'submit',
        'value' => 'Form primary',
        'attributes' => array(
          'class' => array(
            'ecl-button--form-primary',
          ),
        ),
      ),
      array(
        'type' => 'submit',
        'value' => 'Light',
        'attributes' => array(
          'class' => array(
            'ecl-button--light',
          ),
        ),
      ),
      array(
        'type' => 'submit',
        'value' => 'Icon: Arrow up',
        'attributes' => array(
          'class' => array(
            'ecl-button--default',
            'ecl-button--arrow-up',
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
