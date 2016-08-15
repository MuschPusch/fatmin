<?php

/**
 * @file
 * template.php
 */

/**
 * Implements hook_preprocess_node().
 */
function fatmin_preprocess_node(&$vars) {
  $vars['submitted'] = '<h5>' . t('Created by !username on !datetime',
    array(
      '!username' => $vars['name'],
      '!datetime' => $vars['date'],
    )) . '</h5>';
}

function fatmin_node_view_alter(&$node) {
  // Needs work.
  // $node['links']['comment']['#links']['comment-add']['attributes']['class'][] = 'btn';
  // $node['links']['comment']['#links']['comment-add']['attributes']['class'][] = 'btn-success';
}

function fatmin_comment_view_alter(&$comment) {
  foreach ($comment['links']['comment']['#links'] as &$link) {
    $btn = 'btn-success';
    if ($link['title'] == 'delete') {
      $btn = 'btn-danger';
    }
    $link['attributes'] = array('class' => array('btn', $btn));
  }
}

/**
 * Implements hook_preprocess_page().
 */
function fatmin_preprocess_page(&$vars) {
  // Select minimalist login screen template for anonymous users.
  if (!empty($vars['user']) && empty($vars['user']->uid)) {
    $vars['theme_hook_suggestions'][] = 'page__pmkickstart_minimalist_user_login';
  }

  $no_panel_wrapper = array('pm/dashboard');
  $vars['show_panel'] = FALSE;
  if (!in_array(current_path(), $no_panel_wrapper)) {
    $vars['show_panel'] = TRUE;
  }
}
/**
 * Implements hook_preprocess_html().
 */
function fatmin_preprocess_html(&$vars) {
  $vars['body_attributes_array']['class'][] = 'navbar-is-fixed-top';
}

/**
 * Implements hook_preprocess_views_view_table().
 */
function fatmin_preprocess_views_view_table(&$vars) {
  $vars['classes_array'][] = 'table table-stripped table-bordered table-hover';
}


function fatmin_preprocess_ctools_dropdown(&$vars) {
  $vars['dropdown_menu'] = array();
  $vars['default_link']  = array();

  $flag_first_item = TRUE;
  foreach ($vars['links'] as $key => $value) {
    $options = array();
    $href = $value['href'];
    if (isset($value['query'])) {
      $options = array(
        'query' => $value['query'],
      );
    }
    $url = !empty($href) ? check_plain(url($href, $options)) : '';

    if ($flag_first_item) {
      $vars['default_link'] = $value;
      $vars['default_link']['url'] = $url;
      $vars['default_link']['class'] = !empty($value['attributes']['class']) ? implode(' ', $value['attributes']['class']) : '';
    }
    else {
      $vars['dropdown_menu'][$key] = $value;
      $vars['dropdown_menu'][$key]['url'] = $url;
      $vars['dropdown_menu'][$key]['class'] = !empty($value['attributes']['class']) ? implode(' ', $value['attributes']['class']) : '';
    }
    $flag_first_item = FALSE;
  }
}

/**
 * Implements theme_preprocess_links__ctools_dropbutton().
 */
function fatmin_preprocess_links__ctools_dropbutton(&$vars) {
  $vars['dropdown_menu'] = array();
  $vars['default_link']  = array();

  $flag_first_item = TRUE;
  foreach ($vars['links'] as $key => $value) {
    if (isset($value['attributes'])) {

      if (isset($value['attributes']['class']) && !is_array($value['attributes']['class'])) {
        $value['attributes']['class'] = array($value['attributes']['class']);
      }
      elseif (is_array($value['attributes']['class'])) {
        unset($value['attributes']['class'][0]);
      }
      if ($key = array_search('icon compact add', $value['attributes']['class']) !== FALSE) {
        $value['title'] = '<i class="fa fa-plus"></i> ' . $value['title'];
        $value['attributes']['class'][] = 'btn';
        $value['attributes']['class'][] = 'btn-default';
      }
      if ($key = array_search('icon compact rearrange', $value['attributes']['class']) !== FALSE) {
        unset($value['attributes']['class'][0]);
        $value['title'] = '<i class="fa fa-gear"></i> ' . $value['title'];
        $value['attributes']['class'][] = 'btn';
        $value['attributes']['class'][] = 'btn-default';
      }
    }

    $options = array();
    $href = $value['href'];
    if (isset($value['query'])) {
      $options = array(
        'query' => $value['query'],
      );
    }
    $url = !empty($href) ? check_plain(url($href, $options)) : '';

    if ($flag_first_item) {
      $vars['default_link'] = $value;
      $vars['default_link']['url'] = $url;
      $vars['default_link']['class'] = (isset($value['attributes']['class']) && is_array($value['attributes']['class'])) ? implode(' ', $value['attributes']['class']) : '';
    }
    else {
      $vars['dropdown_menu'][$key] = $value;
      $vars['dropdown_menu'][$key]['url'] = $url;
      $vars['dropdown_menu'][$key]['class'] = !empty($value['attributes']['class']) ? implode(' ', $value['attributes']['class']) : '';
    }
    $flag_first_item = FALSE;
  }
}

function fatmin_preprocess_pm_dashboard_link(&$variables) {
  switch ($variables['icon']) {
    case 'pmconfiguration':
      $variables['fa_icon'] = 'fa-gear';
      break;
    case 'pmexpenses':
      $variables['fa_icon'] = 'fa-money';
      break;
    case 'pmnotes':
      $variables['fa_icon'] = 'fa-file-o';
      break;
    case 'pmtimetrackings':
      $variables['fa_icon'] = 'fa-clock-o';
      break;
    case 'pmtickets':
      $variables['fa_icon'] = 'fa-ticket';
      break;
    case 'pmtasks':
      $variables['fa_icon'] = 'fa-tasks';
      break;
    case 'pmprojects':
      $variables['fa_icon'] = 'fa-flask';
      break;
    case 'pmteams':
      $variables['fa_icon'] = 'fa-users';
      break;
    case 'pmorganizations':
      $variables['fa_icon'] = 'fa-institution';
      break;
    default:
      $variables['fa_icon'] = 'fa-wrench';
      break;
  }
  $variables['href'] = check_plain(url($variables['path']));
  $variables['href_add'] = FALSE;
  if ($variables['add_type']) {
    $variables['href_add'] = check_plain(url('node/add/' . $variables['add_type']));
  }
}
/**
 * Theme function implementation for bootstrap_search_form_wrapper.
 */
function fatmin_bootstrap_search_form_wrapper($variables) {
  $parent = reset($variables['element']['#parents']);
  $prefix = TRUE;
  $button_type = 'button';
  switch ($parent) {
    case 'name':
      $fa_icon = 'fa-user';
      break;
    case 'pass':
      $fa_icon = 'fa-key';
      break;
    case 'search_block_form':
      $fa_icon = 'fa-search';
      $button_type = 'submit';
      $prefix = FALSE;
      break;
    default:
      $fa_icon = 'fa-keyboard-o';
      break;
  }

  $button  = '<span class="input-group-btn">';
  $button .= '<button type="' . $button_type . '" tabIndex="-1" class="btn btn-default">';
  $button .= '<i class="fa '. $fa_icon .' fa-fw"></i>';
  $button .= '</button>';
  $button .= '</span>';

  $output  = '<div class="input-group">';

  if ($prefix) {
    $output .= $button . $variables['element']['#children'];
  }
  else {
    $output .= $variables['element']['#children'] . $button;
  }

  $output .= '</div>';

  return $output;
}


/**
 * Implements hook_form_alter().
 */
function fatmin_form_alter(array &$form, array &$form_state = array(), $form_id = NULL) {
  if ($form_id) {
    switch ($form_id) {
      case 'user_login_form':
      case 'user_login_block':
        $form['name']['#theme_wrappers'] = array('bootstrap_search_form_wrapper');
        $form['pass']['#theme_wrappers'] = array('bootstrap_search_form_wrapper');
        break;

      case 'search_block_formdddd':
        $form['#attributes']['class'][] = 'form-search';

        $form['search_block_form']['#title'] = '';
        $form['search_block_form']['#attributes']['placeholder'] = t('Search');

        // Hide the default button from display and implement a theme wrapper
        // to add a submit button containing a search icon directly after the
        // input element.
        $form['actions']['submit']['#attributes']['class'][] = 'element-invisible';
        $form['search_block_form']['#theme_wrappers'] = array('bootstrap_search_form_wrapper');

        // Apply a clearfix so the results don't overflow onto the form.
        $form['#attributes']['class'][] = 'content-search';
        break;
    }

  }
}

/**
 * Implements hook_theme().
 */
function fatmin_theme() {
  return array(
    'user_login' => array(
      'render element' => 'form',
      'template' => 'user-login',
      'arguments' => array('form' => NULL),
      'path' => drupal_get_path('theme', 'fatmin') . '/templates',
    ),
    'user_register_form' => array(
      'render element' => 'form',
      'template' => 'user-register',
      'arguments' => array('form' => NULL),
      'path' => drupal_get_path('theme', 'fatmin') . '/templates',
    ),
    'user_pass' => array(
      'render element' => 'form',
      'template' => 'user-pass',
      'arguments' => array('form' => NULL),
      'path' => drupal_get_path('theme', 'fatmin') . '/templates',
    ),
    'billing_navigation' => array(
      'path' => drupal_get_path('theme', 'fatmin') . '/templates',
      'template' => 'billing-navigation',
      'variables' => array(
        'links' => NULL,
      ),
    ),
  );
}

function fatmin_preprocess_user_login(&$variables) {
  $variables['intro_text'] = t('Login');
  fatmin_user_form_links($variables);
}

function fatmin_preprocess_user_register_form(&$variables) {
  $variables['intro_text'] = t('Register');
  fatmin_user_form_links($variables);
}

function fatmin_preprocess_user_pass(&$variables) {
  $variables['intro_text'] = t('Forgot Password');
  fatmin_user_form_links($variables);
}

function fatmin_user_form_links(&$variables) {
  $variables['rendered'] = drupal_render_children($variables['form']);

  $variables['forgot_password_link'] = (drupal_valid_path('user/password')) ? l(t('Forgot password?'), 'user/password') : '';
  $variables['new_user_register_link'] = (drupal_valid_path('user/register')) ? l(t('Register?'), 'user/register') : '';
  $variables['user_login_link'] = (drupal_valid_path('user/login')) ? l(t('Login?'), 'user/login') : '';
}

function fatmin_preprocess_links(&$vars) {
  if (!empty($vars['attributes']['class']) && is_array($vars['attributes']['class']) && ($key = array_search('links inline', $vars['attributes']['class']) !== FALSE)) {
    $vars['attributes']['class'][$key] = 'list-inline';
  }
}

function fatmin_preprocess_ctools_dropbutton(&$vars) {
  $vars['dropdown_menu'] = array();
  $vars['default_link']  = array();

  $flag_first_item = TRUE;
  foreach ($vars['links'] as $key => $value) {
    $options = array();
    $href = $value['href'];
    if (isset($value['query'])) {
      $options = array(
        'query' => $value['query'],
      );
    }
    $url = !empty($href) ? check_plain(url($href, $options)) : '';

    if ($flag_first_item) {
      $vars['default_link'] = $value;
      $vars['default_link']['url'] = $url;
      $vars['default_link']['class'] = !empty($value['attributes']['class']) ? implode(' ', $value['attributes']['class']) : '';
    }
    else {
      $vars['dropdown_menu'][$key] = $value;
      $vars['dropdown_menu'][$key]['url'] = $url;
      $vars['dropdown_menu'][$key]['class'] = !empty($value['attributes']['class']) ? implode(' ', $value['attributes']['class']) : '';
    }
    $flag_first_item = FALSE;
  }
}

function fatmin_ctools_collapsible($vars) {
  $class = $vars['collapsed'] ? ' ctools-collapsed' : '';
  $output = '<div class="xoxo ctools-collapsible-container' . $class . '">';
  $output .= '<div class="ctools-collapsible-handle">' . $vars['handle'] . '</div>';
  $output .= '<div class="ctools-collapsible-content">' . $vars['content'] . '</div>';
  $output .= '</div>';

  return $output;
}

function fatmin_css_alter(&$css) {
  unset($css[drupal_get_path('module', 'homebox') . '/homebox.css']);
}

function fatmin_preprocess_user_picture(&$variables) {
  $variables['user_picture'] = '';
  if (variable_get('user_pictures', 0)) {
    $account = $variables['account'];
    if (!empty($account->picture)) {
      // @TODO: Ideally this function would only be passed file objects, but
      // since there's a lot of legacy code that JOINs the {users} table to
      // {node} or {comments} and passes the results into this function if we
      // a numeric value in the picture field we'll assume it's a file id
      // and load it for them. Once we've got user_load_multiple() and
      // comment_load_multiple() functions the user module will be able to load
      // the picture files in mass during the object's load process.
      if (is_numeric($account->picture)) {
        $account->picture = file_load($account->picture);
      }
      if (!empty($account->picture->uri)) {
        $filepath = $account->picture->uri;
      }
    }
    elseif (variable_get('user_picture_default', '')) {
      $filepath = variable_get('user_picture_default', '');
    }
    if (isset($filepath)) {
      $alt = t("@user's picture", array('@user' => format_username($account)));
      // If the image does not have a valid Drupal scheme (for eg. HTTP),
      // don't load image styles.
      if (module_exists('image') && file_valid_uri($filepath) && $style = variable_get('user_picture_style', '')) {
        $variables['user_picture'] = theme('image_style', array('style_name' => $style, 'path' => $filepath, 'alt' => $alt, 'title' => $alt));
      }
      else {
        $variables['user_picture'] = theme('image', array('path' => $filepath, 'alt' => $alt, 'title' => $alt, 'attributes' => array('class' => array('img-circle', 'media-object'))));
        // Hack.
        $variables['user_picture'] = str_replace('img-responsive', '', $variables['user_picture']);
      }
      if (!empty($account->uid) && user_access('access user profiles')) {
        $attributes = array('attributes' => array('title' => t('View user profile.')), 'html' => TRUE);
        $variables['user_picture'] = l($variables ['user_picture'], "user/$account->uid", $attributes);
      }
    }
  }
}

/**
 * Implements hook_navbar().
 */
function _menu_links() {

  $items = array(
    'orders' => array(
      'title' => 'Alle Rechnungen',
      'href' => '/admin/commerce/orders',
    ),
    'recurring-orders' => array(
      'title' => t('Recurring Orders'),
      'href' => '/admin/billing/recurring-orders',
      'icon' => 'fa-repeat',
    ),
    'create-recurring-order' => array(
      'title' => t('Create Recurring Order'),
      'href' => '/node/add/billing-recurring-order',
      'icon' => 'fa-plus',
    ),
    'create-invoice' => array(
      'title' => 'Rechnung erstellen',
      'href' => '/admin/commerce/orders/add',
    ),
    'customer-profiles' => array(
      'title' => 'Alle Kundenprofile',
      'href' => '/admin/commerce/customer-profiles',
    ),
    'reporting' => array(
      'title' => 'Reporting',
      'href' => '/admin/commerce/reports',
    ),
    'billables' => array(
      'title' => 'Billable items',
      'href' => '/admin/billing/billables',
    ),
    'billables-peruser' => array(
      'title' => 'Billable items per user',
      'href' => '/admin/billing/billables/byuser',
    ),
    'expenses' => array(
      'title' => 'Expenses',
      'href' => '/admin/billing/expenses',
    ),
  );

  return $items;
}

/**
 * Themes the table showing existing entity references in the widget.
 *
 * @param $variables
 *   Contains the form element data from $element['entities'].
 */
function fatmin_inline_entity_form_entity_table($variables) {
  $form = $variables['form'];
  $entity_type = $form['#entity_type'];
  $fields = $form['#table_fields'];
  // Sort the fields by weight.
  uasort($fields, 'drupal_sort_weight');
  // If one of the rows is in form context, disable tabledrag.
  $has_tabledrag = TRUE;
  foreach (element_children($form) as $key) {
    if (!empty($form[$key]['form'])) {
      $has_tabledrag = FALSE;
    }
  }

  $header = array();
  if ($has_tabledrag) {
    $header[] = array('data' => '', 'class' => array('ief-tabledrag-header'));
    $header[] = array('data' => t('Sort order'), 'class' => array('ief-sort-order-header'));
  }
  // Add header columns for each field.
  $first = TRUE;
  foreach ($fields as $field_name => $field) {
    $column = array('data' => $field['label']);
    // The first column gets a special class.
    if ($first) {
      $column['class'] = array('ief-first-column-header');
      $first = FALSE;
    }
    $header[] = $column;
  }
  $header[] = array('data' => t('Hours referenced'));
  $header[] = array('data' => t('Operations'));

  // Build an array of entity rows for the table.
  $rows = array();
  foreach (element_children($form) as $key) {
    $entity = $form[$key]['#entity'];
    list($entity_id) = entity_extract_ids($entity_type, $entity);
    // Many field formatters (such as the ones for files and images) need
    // certain data that might be missing on unsaved entities because the field
    // load hooks haven't run yet. Because of that, those hooks are invoked
    // explicitly. This is the same trick used by node_preview().
    if ($form[$key]['#needs_save']) {
      _field_invoke_multiple('load', $entity_type, array($entity_id => $entity));
    }

    $row_classes = array('ief-row-entity');
    $cells = array();
    if ($has_tabledrag) {
      $cells[] = array('data' => '', 'class' => array('ief-tabledrag-handle'));
      $cells[] = drupal_render($form[$key]['delta']);
      $row_classes[] = 'draggable';
    }
    // Add a special class to rows that have a form underneath, to allow
    // for additional styling.
    if (!empty($form[$key]['form'])) {
      $row_classes[] = 'ief-row-entity-form';
    }

    // Add fields that represent the entity.
    $wrapper = entity_metadata_wrapper($entity_type, $entity);
    foreach ($fields as $field_name => $field) {
      $data = '';
      if ($field['type'] == 'property') {
        $property = $wrapper->{$field_name};
        // label() returns human-readable versions of token and list properties.
        $data = $property->label() ? $property->label() : $property->value();
        $data = check_plain($data);
      }
      elseif ($field['type'] == 'field' && isset($entity->{$field_name})) {
        $display = array(
          'label' => 'hidden',
        ) + $field;
        // The formatter needs to be under the 'type' key.
        if (isset($display['formatter'])) {
          $display['type'] = $display['formatter'];
          unset($display['formatter']);
        }

        $renderable_data = field_view_field($entity_type, $entity, $field_name, $display);
        // The field has specified an exact delta to display.
        if (isset($field['delta'])) {
          if (!empty($renderable_data[$field['delta']])) {
            $renderable_data = $renderable_data[$field['delta']];
          }
          else {
            // The field has no value for the specified delta, show nothing.
            $renderable_data = array();
          }
        }
        $data = drupal_render($renderable_data);
      }

      $cells[] = array('data' => $data, 'class' => array('inline-entity-form-' . $entity_type . '-' . $field_name));
    }
    // Add the buttons belonging to the "Operations" column.
    $quantity = array();
    foreach ($wrapper->field_billed_items as $delta => $timetracking_item) {
      $quantity[] = $timetracking_item->pm_duration->value();
    }
    $total = array('#markup' => round(array_sum($quantity), 2) . " Hours");
    $cells[] = array('data' => drupal_render($total));
    $cells[] = drupal_render($form[$key]['actions']);
    // Create the row.
    $rows[] = array('data' => $cells, 'class' => $row_classes);

    // If the current entity array specifies a form, output it in the next row.
    if (!empty($form[$key]['form'])) {
      $row = array(
        array('data' => drupal_render($form[$key]['form']), 'colspan' => count($fields) + 1),
      );
      $rows[] = array('data' => $row, 'class' => array('ief-row-form'), 'no_striping' => TRUE);
    }
  }

  if (!empty($rows)) {
    $id = 'ief-entity-table-' . $form['#id'];
    if ($has_tabledrag) {
      // Add the tabledrag JavaScript.
      drupal_add_tabledrag($id, 'order', 'sibling', 'ief-entity-delta');
    }

    // Return the themed table.
    $table_attributes = array(
      'id' => $id,
      'class' => array('ief-entity-table'),
    );
    return theme('table', array('header' => $header, 'rows' => $rows, 'sticky' => FALSE, 'attributes' => $table_attributes));
  }
}

/**
 * Implements theme_menu_local_action().
 */
function fatmin_menu_local_action($variables) {
  $link = $variables['element']['#link'];

  $output = '<li>';
  if (isset($link['href'])) {
    $attributes = isset($link['localized_options']) ? $link['localized_options'] : array();
    $attributes['attributes']['class'] = array('btn', 'btn-success', 'btn-xs');
    $attributes['html'] = TRUE;
    $output .= l('<i class="fa fa-plus fa-w"></i>  ' . $link['title'], $link['href'], $attributes);
  }
  elseif (!empty($link['localized_options']['html'])) {
    $output .= $link['title'];
  }
  else {
    $output .= check_plain($link['title']);
  }
  $output .= "</li>\n";

  return $output;
}
