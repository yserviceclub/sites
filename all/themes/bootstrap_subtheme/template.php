<?php

/**
 * @file
 * template.php
 */





/* --------------------------
|	  calendar header fix   	|
----------------------------*/

// this function is customized to shorten the date format that appears in the calendar header
function bootstrap_subtheme_date_nav_title($params) {
	$granularity = $params['granularity'];
	$view = $params['view'];
	$date_info = $view->date_info;
	$link = !empty($params['link']) ? $params['link'] : FALSE;
	$format = !empty($params['format']) ? $params['format'] : NULL;
	switch ($granularity) {
		case 'year':
		$title = $date_info->year;
		$date_arg = $date_info->year;
		break;
		case 'month':
		$format = !empty($format) ? $format : (empty($date_info->mini) ? 'F Y' : 'F Y');
		$title = date_format_date($date_info->min_date, 'custom', $format);
		$date_arg = $date_info->year .'-'. date_pad($date_info->month);
		break;
		case 'day':
		$format = !empty($format) ? $format : (empty($date_info->mini) ? 'l, F j Y' : 'l, F j');
		$title = date_format_date($date_info->min_date, 'custom', $format);
		$date_arg = $date_info->year .'-'. date_pad($date_info->month) .'-'. date_pad($date_info->day);
		break;
		case 'week':
		$format = !empty($format) ? $format : (empty($date_info->mini) ? 'F j Y' : 'F j');
		$title = t('Week of @date', array('@date' => date_format_date($date_info->min_date, 'custom', $format)));
		$date_arg = $date_info->year .'-W'. date_pad($date_info->week);
		break;
	}
	if (!empty($date_info->mini) || $link) {
		// Month navigation titles are used as links in the mini view.
		$attributes = array('title' => t('View full page month'));
		$url = date_pager_url($view, $granularity, $date_arg, TRUE);
		return l($title, $url, array('attributes' => $attributes));
	}
	else {
		return $title;
	}
}



/**
 * Theme function for the modal.
 */
function bootstrap_subtheme_bootstrap_login_modal_output($vars) {
  $links = '<ul class="menu nav navbar-nav pull-right"><li><a href="#" data-toggle="modal" data-target="#login-modal">' . t('Login') . '</a></li>';
  // Login modal.
  $login_form = drupal_get_form('user_login');
  $login_modal = '
      <div class="modal fade" id="login-modal" role="dialog" aria-labelledby="modalLoginLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">' . t('Close') . '</span></button>
              <h4 class="modal-title" id="modalLoginLabel">' . t('Login') . '</h4>
            </div>
      <div class="modal-body">
      ' . drupal_render($login_form) . '
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">' . t('Close') . '</button>
      </div>
          </div>
        </div>
      </div>
      ';
  // Register modal and link.
  $register_modal = '';
  if (variable_get('user_register', USER_REGISTER_VISITORS_ADMINISTRATIVE_APPROVAL)) {
    $register_form = drupal_get_form('user_register_form');
    $links .= '<li><a href="#" data-toggle="modal" data-target="#register-modal">' . t('Register') . '</a></li>';
    $register_modal = '
      <div class="modal fade" id="register-modal" role="dialog" aria-labelledby="modalRegisterLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">' . t('Close') . '</span></button>
              <h4 class="modal-title" id="modalRegisterLabel">' . t('Register') . '</h4>
            </div>
      <div class="modal-body">
      ' . drupal_render($register_form)  . '
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">' . t('Close') . '</button>
      </div>
          </div>
        </div>
      </div>
      ';
  }
  $links .= '</ul>';
  // JS to move modals, this is needed so modals do not appear under overlay.
  drupal_add_js(
  'Drupal.behaviors.bootstrap_login_modal = {
      attach: function (context) {
        jQuery("#login-modal", context).appendTo("body");
        jQuery("#register-modal", context).appendTo("body");
      }
  };',
  'inline');
  return $links . $login_modal;
}


