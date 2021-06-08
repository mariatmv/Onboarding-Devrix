<?php
/**
 * Plugin Name: My Onboarding Plugin
 * Version: 1.0
 * Author: Maria Tomovich
 */

if (get_option('is_checked') === 'checked') {
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

}

/** Creates a submenu to the Settings administration menu */

add_action( 'admin_menu', 'my_onboarding_menu' );

function my_onboarding_menu() {
	add_options_page( 'My Onboarding Options', 'My Onboarding', 'manage_options', 'my-unique-identifier', 'my_onboarding_options' );
}

function my_onboarding_options() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	} ?>
    <br><br><br>
    <div>
        <br><br><br>
        <input type="checkbox" id="filters_checkbox" name="checkbox" <?php echo get_option('is_checked') ?>>
        <label for="checkbox">Filters enabled</label>
    </div>

	<?php
}
add_action( 'admin_enqueue_scripts', 'enqueue_filters_script' );
function enqueue_filters_script() {
	wp_enqueue_script( 'enabled_filters_script', plugins_url( 'checkbox.js', __FILE__ ), array('jquery') );

	// in JavaScript, object properties are accessed as ajax_object.ajax_url, ajax_object.we_value
	wp_localize_script( 'enabled_filters_script', 'enabled_filters_object',
		array( 'enabled_filters_url' => admin_url( 'admin-ajax.php' ), 'is_checked' => get_option('is_checked') ) );
}

// Same handler function...
add_action( 'wp_ajax_enable_filters', 'enable_filters' );
function enable_filters() {
	$is_checked = $_POST['is_checked'];
	update_option('is_checked', $is_checked);
	wp_die();
}
?>