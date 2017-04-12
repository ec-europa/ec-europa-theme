<?php

/**
 * @file
 * template.php
 */

atomium_include('atomium', 'includes/alter');
atomium_include('europa', 'includes/alter');

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

/**
 * Implements hook_date_popup_process_alter().
 */
function europa_date_popup_process_alter(&$element, &$form_state, $context) {
  // Removing the description from the datepicker.
  unset($element['date']['#description']);
  unset($element['time']['#description']);
}

/**
 * Implements hook_bootstrap_colorize_text_alter().
 */
function europa_bootstrap_colorize_text_alter(&$texts) {
  $texts['contains'][t('Save')] = 'primary';
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
  // Here Bootstrap tooltips have been removed since in current implemenation we
  // will use descriptions that are displayed under <label> element.
  if (!empty($element['#description'])) {
    $description = '<p class="help-block">' . $element['#description'] . '</p>';
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
 * Override theme_file_link().
 */
function europa_file_link($variables) {
  if (function_exists('_nexteuropa_formatters_file_markup')) {
    $file = $variables['file'];

    // Submit the language along witht the file.
    $langcode = $GLOBALS['language_content']->language;
    if (!empty($langcode)) {
      $file->language = $langcode;
    }

    return _nexteuropa_formatters_file_markup($file);
  }
  else {
    return theme_file_link($variables);
  }
}

/**
 * Implements hook_preprocess_views_view().
 */
function europa_preprocess_views_view(&$variables) {
  // Checking if exposed filters are set and add variable that stores active
  // filters.
  if (module_exists('dt_exposed_filter_data')) {
    $variables['active_filters'] = _dt_exposed_filter_data_get_exposed_filter_output();
  }
}

/**
 * Implements theme_file_upload_help().
 */
function europa_file_upload_help($variables) {
  // This is to avoid having the code duplicated from function
  // theme_file_upload_help and also to avoid the function
  // bootstrap_file_upload_help because we don't need popup's, just theme
  // this normally.
  // @codingStandardsIgnoreLine
  return theme_file_upload_help($variables);
}

/**
 * Implements hook_ds_pre_render_alter().
 *
 * Setting variables for non-node entities in the DS templates.
 */
function europa_ds_pre_render_alter(&$layout_render_array, $context, &$variables) {
  $entity = $variables['elements'];
  $entity_type = $entity['#entity_type'];

  switch ($entity_type) {
    case 'user':
      $uri = entity_uri($entity_type, $variables['elements']['#account']);
      $variables['node_url'] = url($uri['path']);

      if (!empty($entity['europa_user_fullname_first'])) {
        $title = $entity['europa_user_fullname_first'][0]['#markup'];
      }
      elseif (!empty($entity['europa_user_fullname_last'])) {
        $title = $entity['europa_user_fullname_last'][0]['#markup'];
      }
      else {
        $title = $variables['elements']['#account']->name;
      }

      // We get the value wrapped in a <p> tag.
      $variables['title'] = strip_tags($title);
      break;

    case 'taxonomy_term':
      $uri = entity_uri($entity_type, $variables['term']);
      $variables['node_url'] = url($uri['path']);
      $variables['title'] = $entity['#term']->name;
      break;

  }
}
