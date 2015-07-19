<?php

/**
 * @file
 * template.php
 */

/**
 * Implements hook_preprocess_node().
 */
function pm_kickstart_theme_preprocess_node(&$vars) {
  $vars['submitted'] = '<h5>' . t('Created by !username on !datetime',
    array(
      '!username' => $vars['name'],
      '!datetime' => $vars['date'],
    )) . '</h5>';
}

function pm_kickstart_theme_node_view_alter(&$node) {
  // Needs work.
  // $node['links']['comment']['#links']['comment-add']['attributes']['class'][] = 'btn';
  // $node['links']['comment']['#links']['comment-add']['attributes']['class'][] = 'btn-success';
}

function pm_kickstart_theme_comment_view_alter(&$comment) {
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
function pm_kickstart_theme_preprocess_page(&$vars) {
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
function pm_kickstart_theme_preprocess_html(&$vars) {
  $vars['body_attributes_array']['class'][] = 'navbar-is-fixed-top';
}

/**
 * Implements hook_preprocess_views_view_table().
 */
function pm_kickstart_theme_preprocess_views_view_table(&$vars) {
  $vars['classes_array'][] = 'table table-stripped table-bordered table-hover';
}


function pm_kickstart_theme_preprocess_ctools_dropdown(&$vars) {
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

function pm_kickstart_theme_preprocess_links__ctools_dropbutton(&$vars) {
  $vars['dropdown_menu'] = array();
  $vars['default_link']  = array();

  $flag_first_item = TRUE;
  foreach ($vars['links'] as $key => $value) {
    if (isset($value['attributes']['class'])) {
      if ($key = array_search('icon compact add', $value['attributes']['class']) !== FALSE) {
        unset($value['attributes']['class'][0]);
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

function pm_kickstart_theme_preprocess_pm_dashboard_link(&$variables) {
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
function pm_kickstart_theme_bootstrap_search_form_wrapper($variables) {
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
function pm_kickstart_theme_form_alter(array &$form, array &$form_state = array(), $form_id = NULL) {
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
 * Implements hook_theme
 */
function pm_kickstart_theme_theme() {
  return array(
    'user_login' => array(
      'render element' => 'form',
      'template' => 'user-login',
      'arguments' => array('form' => NULL),
      'path' => drupal_get_path('theme', 'pm_kickstart_theme') . '/templates',
    ),
    'user_register_form' => array(
      'render element' => 'form',
      'template' => 'user-register',
      'arguments' => array('form' => NULL),
      'path' => drupal_get_path('theme', 'pm_kickstart_theme') . '/templates',
    ),
    'user_pass' => array(
      'render element' => 'form',
      'template' => 'user-pass',
      'arguments' => array('form' => NULL),
      'path' => drupal_get_path('theme', 'pm_kickstart_theme') . '/templates',
    ),
  );
}

function pm_kickstart_theme_preprocess_user_login(&$variables) {
  $variables['intro_text'] = t('Login');
  pm_kickstart_theme_user_form_links($variables);
}

function pm_kickstart_theme_preprocess_user_register_form(&$variables) {
  $variables['intro_text'] = t('Register');
  pm_kickstart_theme_user_form_links($variables);
}

function pm_kickstart_theme_preprocess_user_pass(&$variables) {
  $variables['intro_text'] = t('Forgot Password');
  pm_kickstart_theme_user_form_links($variables);
}

function pm_kickstart_theme_user_form_links(&$variables) {
  $variables['rendered'] = drupal_render_children($variables['form']);

  $variables['forgot_password_link'] = (drupal_valid_path('user/password')) ? l(t('Forgot password?'), 'user/password') : '';
  $variables['new_user_register_link'] = (drupal_valid_path('user/register')) ? l(t('Register?'), 'user/register') : '';
  $variables['user_login_link'] = (drupal_valid_path('user/login')) ? l(t('Login?'), 'user/login') : '';
}

function pm_kickstart_theme_preprocess_links(&$vars) {
  if (isset($vars['attributes']['class']) AND ($key = array_search('links inline', $vars['attributes']['class']) !== FALSE)) {
    $vars['attributes']['class'][$key] = 'list-inline';
  }
}

function pm_kickstart_theme_preprocess_ctools_dropbutton(&$vars) {
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

function pm_kickstart_theme_ctools_collapsible($vars) {
  $class = $vars['collapsed'] ? ' ctools-collapsed' : '';
  $output = '<div class="xoxo ctools-collapsible-container' . $class . '">';
  $output .= '<div class="ctools-collapsible-handle">' . $vars['handle'] . '</div>';
  $output .= '<div class="ctools-collapsible-content">' . $vars['content'] . '</div>';
  $output .= '</div>';

  return $output;
}

function pm_kickstart_theme_css_alter(&$css) {
  unset($css[drupal_get_path('module', 'homebox') . '/homebox.css']);
}

function pm_kickstart_theme_preprocess_user_picture(&$variables) {
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
