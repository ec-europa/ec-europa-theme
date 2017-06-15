<?php

/**
 * @file
 * Contains component file.
 */

/**
 * Implements theme_file_widget().
 *
 * @todo Refactor the use of variable_get to use the field info instance
 * settings instead.
 */
function europa_file_widget($variables) {
  $output = '';
  $element = $variables['element'];
  $bundle = $element['#bundle'];
  $field_name = $element['#field_name'];

  // Checks if its to use the DT component in the front end.
  $check_use = variable_get('dt_shared_functions_dt_file_use_component_' . $bundle . '_' . $field_name, TRUE);
  if ($check_use) {
    $has_file = FALSE;
    if (!empty($element['#default_value']['fid'])) {
      $has_file = TRUE;
    }

    // Added the JS file to the element upload to be rendered.
    $element['upload']['#attached']['js'][] = drupal_get_path('theme', 'europa') . '/assets/js/components/file-upload.js';

    // Immediately render hidden elements before the rest of the output.
    // The uploadprogress extension requires that the hidden identifier input
    // element appears before the file input element. They must also be siblings
    // inside the same parent element.
    // @see https://www.drupal.org/node/2155419
    $hidden_elements = [];
    $upload_button = [];
    foreach (element_children($element) as $child) {
      if ($element[$child]['#type'] === 'hidden') {
        $hidden_elements[$child] = $element[$child];
        unset($element[$child]);
      }
      elseif ($element[$child]['#type'] === 'submit') {
        $upload_button[$child] = $element[$child];
        $upload_button[$child]['#attributes']['class'][] = 'ecl-button--primary';
        unset($element[$child]);
      }
    }

    // The "form-managed-file" class is required for proper Ajax functionality.
    $output .= '<div class="file-widget form-managed-file input-group clearfix">';

    $output .= render($hidden_elements);
    $output .= drupal_render_children($element);

    if (!$has_file) {
      $output .= '<div class="form-control file-upload__input form-file" tabindex="0">';
      $output .= '<span class="file-upload__message">' . t('No file selected.') . '</span>';
      $output .= '</div>';
    }
    $output .= '<span class="input-group-btn">';
    if (!$has_file) {
      $output .= '<label class="btn btn-default file-upload__label" for="' . $element['upload']['#id'] . '" tabindex="1">' . t('Browse') . '</label>';
    }

    // Checks if the upload button is to added to the front end.
    $check_upload = variable_get('dt_shared_functions_dt_file_show_upload_' . $bundle . '_' . $field_name, TRUE);
    if ($check_upload) {
      // The newline is to give the same space that we have in the style guide.
      $output .= "\n" . drupal_render($upload_button);
    }

    $output .= '</span>';
    $output .= '</div>';
  }

  return $output;
}
