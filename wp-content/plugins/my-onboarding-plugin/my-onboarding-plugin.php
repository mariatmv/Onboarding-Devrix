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
		$settings_url= get_admin_url() . 'profile.php';
		return $nav = "<a href='$settings_url'>Profile Settings</a>";
	}
}

add_filter('profile_update', 'send_email_when_profile_is_updated');
/** Sends an email to the site administrator every time someone updates their profile */
function send_email_when_profile_is_updated() {
	var_dump(wp_mail(get_option('admin_email'), 'Success', 'The plugin worked!'));
}
/** Creates a submenu to the Settings administration menu */

add_action( 'admin_menu', 'my_onboarding_menu' );

function my_onboarding_menu() {
	add_options_page( 'My Onboarding Options', 'My Onboarding', 'manage_options', 'my-unique-identifier', 'my_onboarding_options' );
}

function my_onboarding_options() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo '<div class="wrap">';
	echo '<br>';echo '<br>';echo '<br>';
	echo '<input type="checkbox" id="checkbox" name="checkbox">';
	echo '<label for="vehicle1"> Filters enabled</label><br>';
	echo '</div>';
}

?>