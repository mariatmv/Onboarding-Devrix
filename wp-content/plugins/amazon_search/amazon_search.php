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
    <input type="url" id="amazonUrl" name="amazonUrl">
    <label for="duration">Choose duration (in seconds):</label>
    <select id="transientDuration" name="duration">
        <option value="10">10</option>
        <option value="15">15</option>
        <option value="20">20</option>
    </select>
    <button id="searchUrlBtn">Search</button>
    <div id="container"><?php  cache_results_display(); ?></div>
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
	setting_url_and_duration_transient($url, $duration_in_seconds);
	display_results();
	wp_die();
}

/** Checks if we have transient and calls the display function if we do */
function cache_results_display() {
	$result = get_transient( 'search_results' );
	if ( false !== $result ){
		display_results();
	}
}

/** Sets the url and the duration in transient */
function setting_url_and_duration_transient($url, $duration_in_seconds) {
    if ($url !== '') {
        if (!$duration_in_seconds) {
            $duration_in_seconds = 10;
        }
	    set_transient('search_results', $url, $duration_in_seconds);
    }
}

/** Displays the results to the user */
function display_results() {
    $url = get_transient('search_results');
    $contents = file_get_contents($url);
    echo $contents;
}

?>