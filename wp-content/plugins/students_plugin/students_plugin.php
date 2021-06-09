<?php
/**
 * Plugin Name: Students
 * Version: 1.0
 * Author: Maria Tomovich
 */

/*
* Creating a function to create our CPT
*/

function custom_post_type() {

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'students', 'Post Type General Name', 'twentytwentyone' ),
		'singular_name'       => _x( 'Student', 'Post Type Singular Name', 'twentytwentyone' ),
		'menu_name'           => __( 'Students', 'twentytwentyone' ),
		'all_items'           => __( 'All Students', 'twentytwentyone' ),
		'view_item'           => __( 'View Student', 'twentytwentyone' ),
//		'add_new_item'        => __( 'Add New Student', 'twentytwentyone' ),
//		'add_new'             => __( 'Add New', 'twentytwentyone' ),
//		'edit_item'           => __( 'Edit Movie', 'twentytwentyone' ),
//		'update_item'         => __( 'Update Movie', 'twentytwentyone' ),
//		'search_items'        => __( 'Search Movie', 'twentytwentyone' ),
//		'not_found'           => __( 'Not Found', 'twentytwentyone' ),
//		'not_found_in_trash'  => __( 'Not found in Trash', 'twentytwentyone' ),
	);

// Set other options for Custom Post Type

	$args = array(
		'label'               => __( 'students', 'twentytwentyone' ),
		'description'         => __( 'Students', 'twentytwentyone' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'thumbnail', 'excerpt', 'title', 'editor', 'custom-fields'),
		// You can associate this CPT with a taxonomy or custom taxonomy.
//		'taxonomies'          => array( 'genres' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/
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

	// Registering your Custom Post Type
	register_post_type( 'students', $args );

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not
* unnecessarily executed.
*/

add_action( 'init', 'custom_post_type', 0 );
?>