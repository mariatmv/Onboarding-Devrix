<?php
/**
 * Adding a shortcut for displaying a student by id
 */
// [student student_id="student-id"]
function find_student($args) {
	$query_args = array(
		'p' => $args['student_id'],
		'post_type' => 'students'
	);
	$the_query = new WP_Query($query_args);
	if ($the_query->have_posts()) {
		while ($the_query->have_posts()) {
			$the_query->the_post();
			$output = '<div>';
			$output .= '<h3> Name: ' . get_the_title() . '</h3>';
			$output .= '<img src="' . get_the_post_thumbnail();
			$output .= '<span>Grade: ' . get_post_meta(get_the_ID(), 'grade')[0] . '</span>';
			return $output;
		}
	} else {
		return '<h1>Sorry, but no student with ID: ' . $args['student_id'] . ' was found!</h1>';
	}
}
add_shortcode('student', 'find_student');