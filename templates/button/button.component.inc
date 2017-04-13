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
    'label' => 'Buttons',
    'description' => 'Button templates. These can be formatted in UI. Check nexteuropa_formatters feature for more details.',
    'preview' => array(
      array(
        'type' => 'submit',
        'value' => 'Button default',
        'attributes' => array(
          'class' => array(
            'btn-default',
          ),
        ),
      ),
      array(
        'type' => 'submit',
        'value' => 'Button primary',
        'attributes' => array(
          'class' => array(
            'btn-primary',
          ),
        ),
      ),
      array(
        'type' => 'submit',
        'value' => 'Button secondary',
        'attributes' => array(
          'class' => array(
            'btn-secondary',
          ),
        ),
      ),
      array(
        'type' => 'submit',
        'value' => 'Button call to action',
        'attributes' => array(
          'class' => array(
            'btn-ctn',
          ),
        ),
      ),
      array(
        'type' => 'submit',
        'value' => 'Button call to action with border',
        'attributes' => array(
          'class' => array(
            'btn-ctn--border',
          ),
        ),
      ),
      array(
        'type' => 'submit',
        'value' => 'Button menu',
        'attributes' => array(
          'class' => array(
            'btn-menu',
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
  $variables['attributes_array']['class'][] = 'btn';
}
