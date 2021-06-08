<?php
/**
 * Plugin Name: Amazon Search
 * Version: 1.0
 * Author: Maria Tomovich
 */

add_action('admin_menu', 'amazon_search_menu');

function amazon_search_menu() {
	add_options_page('Amazon Search Options', 'Amazon Search', 'manage_options',
		'my-unique-identifier', 'amazon_search_options');
}

function amazon_search_options() {
	if (!current_user_can('manage_options')) {
		wp_die('You do not have permission to access this page');
	}
	?>
    <br><br><br>
    <input type="url" id="amazonUrl" name="amazonUrl">
    <label for="duration">Choose duration (in seconds):</label>
    <select id="transientDuration" name="duration">
        <option value="10">10</option>
        <option value="15">15</option>
        <option value="20">20</option>
    </select>
    <button id="searchUrlBtn">Search</button>
    <br>
    <div id="container"><?php echo cache_results_display(); ?></div>
   <?php
}


add_action( 'admin_enqueue_scripts', 'enqueue_amazon_search_script' );
function enqueue_amazon_search_script() {
	wp_enqueue_script( 'amazon_search_script', plugins_url( 'get_url.js', __FILE__ ), array('jquery') );

	wp_localize_script( 'amazon_search_script', 'amazon_search_object',
		array( 'amazon_search_url' => admin_url( 'admin-ajax.php' )));
}

add_action( 'wp_ajax_amazon_search', 'amazon_search' );
function amazon_search() {
	$url = $_POST['data']['amazon_url'];
	$duration_in_seconds = $_POST['data']['transient_duration'];
	setting_url_transient($url, $duration_in_seconds);
	display_results();
	wp_die();
}

function cache_results_display() {
	$result = get_transient( 'search_results' );
	if ( false !== $result ){
		display_results();
	}
}

function setting_url_transient($url, $duration_in_seconds) {
    set_transient('search_results', $url, $duration_in_seconds);
}

function display_results() {
    echo wp_remote_request(get_transient('search_results'))['body'];
}

?>