<?php

/**
 * @file
 * form.inc
 */

/**
 * Implements hook_form_alter().
 */
function europa_form_alter(&$form, &$form_state, $form_id) {
  if (isset($form['views_bulk_operations'])) {
    $children = element_children($form['views_bulk_operations']);
    foreach ($children as $child) {
      if ($form['views_bulk_operations'][$child]['#type'] == 'checkbox') {
        $form['views_bulk_operations'][$child]['#title'] = ' ';
      }
    }
  }
}

/**
 * Overrides theme_form_element().
 */
function europa_form_element(&$variables) {
  $element = &$variables['element'];
  $is_checkbox = FALSE;
  $is_radio = FALSE;
  $feedback_message = FALSE;

  // This function is invoked as theme wrapper, but the rendered form element
  // may not necessarily have been processed by form_builder().
  $element += [
    '#title_display' => 'before',
  ];

  // Add element #id for #type 'item'.
  if (isset($element['#markup']) && !empty($element['#id'])) {
    $attributes['id'] = $element['#id'];
  }

  // Check for errors and set correct error class.
  if (isset($element['#parents']) && form_get_error($element)) {
    $attributes['class'][] = 'has-error';
    if (in_array($element['#type'], ['radio', 'checkbox'])) {
      if ($element['#required']) {
        $feedback_message = '<div class="feedback-message is-error"><p>' . form_get_error($element) . '</p></div>';
      }
    }
    else {
      $feedback_message = '<div class="feedback-message is-error"><p>' . form_get_error($element) . '</p></div>';
    }
  }

  if (!empty($element['#type'])) {
    $attributes['class'][] = 'form-type-' . strtr($element['#type'], '_', '-');
  }

  if (!empty($element['#name'])) {
    $attributes['class'][] = 'form-item-' . strtr($element['#name'], [
      ' ' => '-',
      '_' => '-',
      '[' => '-',
      ']' => '',
    ]);
  }

  // Add a class for disabled elements to facilitate cross-browser styling.
  if (!empty($element['#attributes']['disabled'])) {
    $attributes['class'][] = 'form-disabled';
  }

  if (!empty($element['#autocomplete_path'])
    && drupal_valid_path($element['#autocomplete_path'])
  ) {
    $attributes['class'][] = 'form-autocomplete';
  }

  $attributes['class'][] = 'form-item';

  // See https://www.drupal.org/node/154137
  if (!empty($element['#id']) && $element['#id'] == 'edit-querytext') {
    $element['#children'] = str_replace('type="text"', 'type="search"', $element['#children']);
  }

  // See http://getbootstrap.com/css/#forms-controls.
  if (isset($element['#type'])) {
    switch ($element['#type']) {
      case "radio":
        $attributes['class'][] = 'radio';
        $is_radio = TRUE;
        break;

      case "checkbox":
        $attributes['class'][] = 'checkbox';
        $is_checkbox = TRUE;
        break;

      case "managed_file":
        $attributes['class'][] = 'file-upload';
        break;

      default:
        // Check if it is not our search form. Because we don't want the default
        // bootstrap class here.
        if (!in_array('form-item-QueryText', $attributes['class'])) {
          $attributes['class'][] = 'form-group';
          // Apply an extra wrapper class to our select list.
          if ($element['#type'] == 'select') {
            $attributes['class'][] = 'form-select';
          }
        }
    }
  }

  // Putting description into variable since it is not going to change.
  if (!empty($element['#description'])) {
    $description = '<p class="ecl-help-block">' . $element['#description'] . '</p>';
  }

  $output = '<div' . drupal_attributes($attributes) . '>' . "\n";

  // If #title is not set, we don't display any label or required marker.
  if (!isset($element['#title'])) {
    $element['#title_display'] = 'none';
  }

  $prefix = '';
  $suffix = '';
  if (isset($element['#field_prefix']) || isset($element['#field_suffix'])) {
    // Determine if "#input_group" was specified.
    if (!empty($element['#input_group'])) {
      $prefix .= '<div class="input-group">';
      $prefix .= isset($element['#field_prefix']) ? '<span class="input-group-addon">' . $element['#field_prefix'] . '</span>' : '';
      $suffix .= isset($element['#field_suffix']) ? '<span class="input-group-addon">' . $element['#field_suffix'] . '</span>' : '';
      $suffix .= '</div>';
    }
    else {
      $prefix .= isset($element['#field_prefix']) ? $element['#field_prefix'] : '';
      $suffix .= isset($element['#field_suffix']) ? $element['#field_suffix'] : '';
    }
  }

  switch ($element['#title_display']) {
    case 'before':
    case 'invisible':
      $output .= ' ' . theme('form_element_label', array('element' => $variables));
      $output .= ' ' . $prefix . $element['#children'] . $suffix . "\n";

      if (!empty($description)) {
        $output .= $description;
      }

      $output .= $feedback_message;
      break;

    case 'after':
      if ($is_radio || $is_checkbox) {
        $output .= ' ' . $prefix . $element['#children'] . $suffix;
        unset($element['#children']);
      }
      else {
        $variables['#children'] = ' ' . $prefix . $element['#children'] . $suffix;
      }

      $output .= ' ' . theme('form_element_label', array('element' => $variables)) . "\n";
      $output .= $feedback_message;
      break;

    default:
      $output .= ' ' . $prefix . $element['#children'] . $suffix . "\n";

      // Output no label and no required marker, only the children.
      if (!empty($description)) {
        $output .= $description;
      }

      $output .= $feedback_message;
  }

  $output .= "</div>\n";

  return $output;
}

/**
 * A search_form alteration.
 */
function europa_form_nexteuropa_europa_search_search_form_alter(&$form, &$form_state, $form_id) {
  $form['search_input_group']['europa_search_submit']['#prefix'] = '<span class="input-group-btn search-form__btn-wrapper">';
  $form['search_input_group']['europa_search_submit']['#suffix'] = '</span>';
  $form['search_input_group']['europa_search_submit']['#attributes']['class'][] = 'search-form__btn';
  $form['search_input_group']['QueryText']['#prefix'] = '<label class="search-form__textfield-wrapper"><span class="sr-only">' . t('Search this website') . '</span>';
  $form['search_input_group']['QueryText']['#suffix'] = '</label>';
  $form['search_input_group']['QueryText']['#attributes']['class'][] = 'search-form__textfield';
  $form['search_input_group']['QueryText']['#attributes']['title'] = t('Search');

  unset($form['search_input_group']['QueryText']['#attributes']['placeholder']);
  unset($form['search_input_group']['europa_search_submit']['#attributes']['tabindex']);
}

/**
 * Implements hook_FORM_ID_alter().
 */
function europa_form_search_block_form_alter(&$form, &$form_state, $form_id) {
  $form['#attributes']['class'][] = 'search-block';
  $form['search_block_form']['#attributes']['class'][] = 'search-form__textfield form-control';
  $form['actions']['submit']['#attributes']['class'][] = 'btn-search search-form__btn btn btn-primary';
}

/**
 * Implements hook_form_BASE_FORM_ID_alter().
 */
function europa_form_views_exposed_form_alter(&$form, &$form_state, $form_id) {
  // Button value change on all the views exposed forms is due to a
  // design/ux requirement which uses the 'Refine results' label for all the
  // filter forms.
  $form['submit']['#value'] = t('Refine results');
  $form['submit']['#attributes']['class'][] = 'btn-primary';
  $form['submit']['#attributes']['class'][] = 'filters__btn-submit';
  $form['reset']['#attributes']['class'][] = 'filters__btn-reset';
}
