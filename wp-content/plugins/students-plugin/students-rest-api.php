<?php
/**
 * Registering rest route to get all the students
 */
function register_route_to_get_all_students() {
	register_rest_route(
		'students',
		'/all',
		array(
			'methods' => 'GET',
			'callback' => 'get_all_students',
			'permission_callback' => '__return_true'
		)
	);
}
add_action('rest_api_init', 'register_route_to_get_all_students');

/**
 * Callback function to get all the active students and return them
 * @return int[]|WP_Post[]|null
 */
function get_all_students() {
	$posts = get_posts(array(
		'post_type' => 'students',
		'meta_key'       => 'active',
		'meta_query'     => array(
			'key'     => 'active',
			'value'   => '1',
			'compare' => '=',
	)));

	if (empty($posts)) {
		return null;
	}

	return $posts;
}


/**
 * Registering rest route to get a student by ID
 */
function register_route_to_get_student_by_id() {
	register_rest_route(
		'students',
		'/id=(?P<id>[\d]+)',
		array(
			'methods' => 'GET',
			'callback' => 'get_student_by_id',
			'permission_callback' => '__return_true'
		)
	);
}
add_action('rest_api_init', 'register_route_to_get_student_by_id');

/**
 * Callback function to get a student by id and return it
 */
function get_student_by_id($params) {
	$post = get_posts(array(
		'post_type' => 'students',
		'p' => $params['id']
	));

	if (empty($post)) {
		return null;
	}

	return $post;
}


/**
 * Registering rest route to create a new student
 */
function register_route_to_create_new_student() {
	register_rest_route(
		'students',
		'/create',
		array(
			'methods' => 'POST',
			'callback' => 'create_new_student',
			'permission_callback' => function() {
				return current_user_can('edit_others_posts');
			}
		)
	);
}
add_action('rest_api_init', 'register_route_to_create_new_student');

/**
 * Callback function to create a new student
 * Returns messages indicating if the API call was successful or not
 */
function create_new_student() {
	if (isset($_POST['post_title']) && isset($_POST['post_content']) && isset($_POST['post_excerpt'])) {
		$post = array(
			'post_type' => 'students',
			'post_title' => sanitize_title($_POST['post_title']),
			'post_content' => sanitize_text_field($_POST['post_content']),
			'post_excerpt' => sanitize_text_field($_POST['post_excerpt']),
			'post_status' => 'publish'
		);

		$post_id = wp_insert_post($post);
		return 'Successfully created new student with ID: ' . $post_id;
	}
	return 'Could not create a new student';
}

/**
 * Registering rest route to edit student by id
 */
function register_route_to_edit_student() {
	register_rest_route(
		'students',
		'/edit/id=(?P<id>[\d]+)',
		array(
			'methods' => 'POST',
			'callback' => 'edit_student',
			'permission_callback' => function() {
				return current_user_can('edit_others_posts');
			}
		)
	);
}
add_action('rest_api_init', 'register_route_to_edit_student');

/**
 * Callback function to edit a student by id
 * Returns a success message if the call was executed
 */
function edit_student($params) {
	if (isset($_POST['post_title']) && isset($_POST['post_content']) && isset($_POST['post_excerpt'])) {
		$post = array(
			'ID' => $params['id'],
			'post_title' => sanitize_title($_POST['post_title']),
			'post_content' => sanitize_text_field($_POST['post_content']),
			'post_excerpt' => sanitize_text_field($_POST['post_excerpt']),
		);

		$post_id = wp_insert_post($post);
		return 'Successfully edited student with ID: ' . $post_id;
	}
}


/**
 * Registers a route to delete a student by id
 */
function register_route_to_delete_student() {
	register_rest_route(
		'students',
		'/delete/id=(?P<id>[\d]+)',
		array(
			'methods' => 'DELETE',
			'callback' => 'delete_student',
			'permission_callback' => function() {
				return current_user_can('edit_others_posts');
			}
		)
	);
}
add_action('rest_api_init', 'register_route_to_delete_student');

/**
 * Callback function to delete a student by his id
 * Returns the student on success
 */
function delete_student( $params ) {
	return wp_delete_post( $params['id'] );
}