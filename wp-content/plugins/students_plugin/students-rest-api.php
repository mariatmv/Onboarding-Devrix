<?php
/** Registering rest route to get all the students */
add_action('rest_api_init', 'register_route_to_get_all_students');
function register_route_to_get_all_students() {
	register_rest_route(
		'students',
		'/all',
		array(
			'methods' => 'GET',
			'callback' => 'get_all_students'
		)
	);
}
function get_all_students() {
	$posts = get_posts(array(
		'post_type' => 'students'
	));

	if (empty($posts)) {
		return null;
	}

	return $posts;
}


/** Registering rest route to get a student by ID */
add_action('rest_api_init', 'register_route_to_get_student_by_id');
function register_route_to_get_student_by_id() {
	register_rest_route(
		'students',
		'/id=(?P<id>[\d]+)',
		array(
			'methods' => 'GET',
			'callback' => 'get_student_by_id'
		)
	);
}
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


/** Registering rest route to create a new student */
add_action('rest_api_init', 'register_route_to_create_new_student');
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

/** Registering rest route to edit student by id */
add_action('rest_api_init', 'register_route_to_edit_student');
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
	return $_POST['post_title'];
}


/** Registers a route to delete a student by id */
add_action('rest_api_init', 'register_route_to_delete_student');
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
function delete_student( $params ) {
	return wp_delete_post( $params['id'] );
}