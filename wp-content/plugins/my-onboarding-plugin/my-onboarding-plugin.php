<?php
/**
 * Plugin Name: My Onboarding Plugin
 * Version: 1.0
 * Author: Maria Tomovich
 */

add_filter('the_content', 'onboarding_filter_message', 1);
/** Adds the returned message before the content of a post */
function onboarding_filter_message( $content) {
    return 'Onboarding filter: by Maria Tomovich' . $content;
}

add_filter('the_content', 'div_insertion', 6);
/** Inserts a div element after the past p element */
function div_insertion($content) {
    return $content . '<div style="display: none"></div>';
}

add_filter('the_content', 'p_insertion', 5);
/** The following two functions pack the div elements into a paragraph */
function p_insertion($content) {
	 return $content .= '<p id="1">';
}

add_filter('the_content', 'second_p_insertion', 7);

function second_p_insertion($content) {
	return $content .= '</p>';
}

/** Adds a custom element in the nav menu which redirects to the profile settings */
add_filter('wp_nav_menu_items', 'add_custom_element_in_nav');
function add_custom_element_in_nav($nav) {
	if (is_user_logged_in()) {
		return $nav = '<a href="/testing/wp-admin/profile.php">Profile Settings</a>';
	}
}

add_filter('profile_update', 'send_email_when_profile_is_updated');
/** Sends an email to the site administrator every time someone updates their profile */
function send_email_when_profile_is_updated() {
	var_dump(wp_mail('mariatomovich@gmail.com', 'Success', 'The plugin worked!'));
}
?>