<?php
/**
 * Plugin Name: My Onboarding Plugin
 * Version: 1.0
 * Author: Maria Tomovich
 */

/**
 * Checks if the filters in the admin menu are enabled
 * @return bool
 */
function filters_enabled() {
    return get_option('is_checked') === 'checked';
}


/**
 * Adds a message before the content of a post
 */
function onboarding_filter_message( $the_excerpt) {
    if ( filters_enabled() ) {
	    return 'Onboarding filter: by Maria Tomovich' . '<br>' . $the_excerpt;
    }
}
add_filter( 'the_excerpt', 'onboarding_filter_message', 1 );

/**
 * Inserts a div element in the past p element
 */
function div_insertion($content) {
    if ( filters_enabled() ) {
	    return preg_replace( '</p>', '/p><div style="display:none">Hello</div', $content, 1 );
    }
}
add_filter('the_content', 'div_insertion', 6);

/**
 * Adds a paragraph element
 */
function p_insertion($content) {
    if ( filters_enabled() ) {
	    return preg_replace( '<p>', 'p>This Paragraph was added programmatically.</p><p', $content, 1 );
    }
}
add_filter('the_content', 'p_insertion', 5);


/**
 * Adds a custom element in the nav menu which redirects to the profile settings
 */
function add_custom_element_in_nav($nav) {
    if ( filters_enabled() ) {
	    if (is_user_logged_in()) {
		    $settings_url= get_admin_url() . 'profile.php';
		    return $nav .= "<a href='$settings_url'>Profile Settings</a>";
	    }
    }
}
add_filter('wp_nav_menu_items', 'add_custom_element_in_nav');


/**
 * Sends an email to the site administrator every time someone updates their profile
 */
function send_email_when_profile_is_updated() {
    if ( filters_enabled() ) {
	    wp_mail(get_option('admin_email'), 'Success', 'The plugin worked!');
    }
}
add_filter('profile_update', 'send_email_when_profile_is_updated');


/** Creates a submenu to the Settings administration menu */

function my_onboarding_menu() {
	add_options_page(
	        'My Onboarding Options',
            'My Onboarding',
            'manage_options', 'my-unique-identifier', 'my_onboarding_options' );
}
add_action( 'admin_menu', 'my_onboarding_menu' );

/**
 * Function that displays the options page in the Settings menu
 */
function my_onboarding_options() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	} ?>
    <div>
        <input type="checkbox" id="filters_checkbox" name="checkbox" <?php echo get_option('is_checked') ?>>
        <label for="checkbox">Filters enabled</label>
    </div>

	<?php
}

/**
 * Function to enqueue the checkbox script and localize it
 */
function enqueue_filters_script() {
	wp_enqueue_script( 'enabled_filters_script', plugins_url( 'checkbox.js', __FILE__ ), array('jquery') );

	// in JavaScript, object properties are accessed as ajax_object.ajax_url, ajax_object.we_value
	wp_localize_script( 'enabled_filters_script', 'enabled_filters_object',
		array( 'enabled_filters_url' => admin_url( 'admin-ajax.php' ), 'is_checked' => get_option('is_checked') ) );
}
add_action( 'admin_enqueue_scripts', 'enqueue_filters_script' );


/**
 * Handles the AJAX response from the checkbox.js
 */
function enable_filters() {
	$is_checked = $_POST['is_checked'];
	update_option('is_checked', $is_checked);
	wp_die();
}
add_action( 'wp_ajax_enable_filters', 'enable_filters' );
?>