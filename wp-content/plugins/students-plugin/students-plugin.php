<?php
/**
 * Plugin Name: Students
 * Version: 1.0
 * Author: Maria Tomovich
 */

include substr(plugin_dir_path(__FILE__), 0, -1).'\\students-rest-api.php';
include substr(plugin_dir_path(__FILE__), 0, -1).'\\students-metaboxes.php';
include substr(plugin_dir_path(__FILE__), 0, -1).'\\students-active-box.php';
include substr(plugin_dir_path(__FILE__), 0, -1).'\\students-shortcode.php';
include substr(plugin_dir_path(__FILE__), 0, -1).'\\students-widget.php';
include substr(plugin_dir_path(__FILE__), 0, -1).'\\students-sidebar.php';
include substr(plugin_dir_path(__FILE__), 0, -1).'\\students-block\students-block.php';


/**
 * Function to create a Students CPT
 *
 */

function custom_post_type() {

	$labels = array(
		'name'                => _x( 'students', 'Post Type General Name', 'twentytwentyone' ),
		'singular_name'       => _x( 'Student', 'Post Type Singular Name', 'twentytwentyone' ),
		'menu_name'           => __( 'Students', 'twentytwentyone' ),
		'all_items'           => __( 'All Students', 'twentytwentyone' ),
		'view_item'           => __( 'View Student', 'twentytwentyone' ),
		'add_new_item'        => __( 'Add New Student', 'twentytwentyone' ),
		'add_new'             => __( 'Add New Student', 'twentytwentyone' ),
	);

	$args = array(
		'label'               => __( 'students', 'twentytwentyone' ),
		'description'         => __( 'Students', 'twentytwentyone' ),
		'labels'              => $labels,
		'supports'            => array( 'thumbnail', 'excerpt', 'title', 'editor',),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'show_in_rest' => true,

	);
	register_post_type( 'students', $args );
}
add_action( 'init', 'custom_post_type', 0 );
?>