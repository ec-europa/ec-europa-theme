<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements hook_preprocess_hook().
 */
function europa_preprocess_form_required_marker(&$variables, $hook) {
  $t = get_t();
  $variables['attributes_array'] = array(
    'class' => 'form-required text-danger',
    'title' => $t('This field is required.'),
  );
  $variables[$hook] = '*';
}
