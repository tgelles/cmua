<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');


/**
 * Show signup button
 */
function signup_button($attrs) {
  if(is_user_logged_in()) {
    global $user_ID;
    global $wpdb;
    $results = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$wpdb->prefix.'frm_items WHERE user_id = %d AND form_id = %d', $user_ID, $attrs['form_id']), ARRAY_A);
    if(!empty($results)) {
      return '<a class="btn btn-primary btn-lg" href="'.$attrs['form_url'].'">'.$attrs['edit_text'].'</a>';
    }

    return '<a class="btn btn-primary btn-lg" href="'.$attrs['form_url'].'">'.$attrs['new_text'].'</a>';
  }

  /*return '<a class="btn btn-primary btn-lg" href="/wp-login?redirect_to='.urlencode(get_permalink()).'">Create an Account/Login</a>';*/
  return '<a class="btn btn-primary btn-lg" href="'.wp_login_url( home_url() ).'">Create an Account/Login</a>';
}
add_shortcode('signup_button', __NAMESPACE__ . '\\signup_button');
