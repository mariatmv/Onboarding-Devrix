<?php
/**
 * Plugin Name: My Onboarding Plugin
 * Version: 1.0
 * Author: Maria Tomovich
 */

add_filter('the_content', 'onboarding_filter_message', 1);

function onboarding_filter_message( $content) {
    return 'Onboarding filter: by Maria Tomovich' . $content;
}

add_filter('the_content', 'div_insertion', 6);

function div_insertion($content) {
    return $content . '<div style="display: none"></div>';
}

add_filter('the_content', 'p_insertion', 5);

function p_insertion($content) {
	return $content . '<p id="1">';
}

add_filter('the_content', 'second_p_insertion', 7);

function second_p_insertion($content) {
	return $content . '</p>';
}

add_filter('wp_nav_menu_items', 'add_custom_element_in_nav');
function add_custom_element_in_nav($nav) {
	if (is_user_logged_in()) {
		return $nav = '<a href="/testing/wp-admin/profile.php">Profile Settings</a>';
	}
}

add_filter('profile_update', 'send_email_when_profile_is_updated');

function send_email_when_profile_is_updated() {
	var_dump(wp_mail('mariatomovich@gmail.com', 'Success', 'The plugin worked!'));
}
?>