<?php

/**
 * @file
 * Contains texfield component file.
 */

/**
 * Implements hook_preprocess_HOOK() for the form textfield.
 */
function europa_preprocess_textfield(&$variables, $hook) {
  $classes = _europa_form_set_css_class(
    $variables['element'],
    array('ecl-text-input'));
  $variables['attributes_array']['class'] = $classes;
}
