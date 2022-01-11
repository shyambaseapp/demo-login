<?php
/*
Plugin Name: Demo Login
Plugin URI: 
Description: As an admin login as demo using secret_key.
Version: 1.0
Text Domain: demo_login
Author: Shyam Sundar Maury
Author URI: https://www.baseapp.com
License:
License URI:
Date : September 14, 2021  "first release".
*/

# Check urls,if it has a key matching with secret_key then user will logged in as demo(admin).
function do_demo_login()
{
     if (is_user_logged_in()) {
          return;
     }
     $secret_key = "demo";

     if (strpos($_SERVER['REQUEST_URI'], $secret_key) !== false) {
          // lets login
          $user_info = get_userdata(1);
          $username = $user_info->user_login;
          $login_name = $username;
          $user = get_user_by('login', $login_name);
          wp_set_current_user($user->ID, $login_name);
          wp_set_auth_cookie($user->ID);
          do_action('wp_login', $login_name, $user);
          $time = gmdate(DATE_W3C);
          add_option('last_login_date', $time);
          update_option('last_login_date', $time);
        }
}

# Redirect to redirect_urls page after login as demo secret_key
function custom_redirect(){
        $redirect_url = get_option('redirect_urls');
        if($redirect_url){
                wp_redirect($redirect_url);
        }
}

# Add reset timer node on admin_bar_menu.
function my_admin_bar( $wp_admin_bar ) {

        $arg = array(
                "id" => "demo",
                "title" => "<p style='color:red;'>Demo will reset in : <h id='demo'>Reset Timer</h></p>",
                );
        $wp_admin_bar->add_node($arg);
}

# Add javascript file in wordpress.
function reset_timer() {
        wp_enqueue_script ( 'reset_timer', '/wp-content/mu-plugins/reset_time.js' );
}

add_action('wp', 'do_demo_login', 1);
add_action('wp_login' , 'custom_redirect');
add_action( 'admin_bar_menu', 'my_admin_bar',120);
add_action('wp_enqueue_scripts', 'reset_timer');
add_action('admin_enqueue_scripts', 'reset_timer');

