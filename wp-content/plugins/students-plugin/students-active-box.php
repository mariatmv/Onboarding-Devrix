<?php
/**
 * Function to create e "Active" column in the Students admin panel
 */
function set_students_activity_checkbox($columns) {
	$columns['active'] = __('Active', 'twentytwentyone');
	return $columns;
}
add_filter('manage_students_posts_columns', 'set_students_activity_checkbox');

/**
 * Function to display the "Active" column in the Students admin panel
 * @param $column
 */
function activity_checkbox_column($column) {
	$status = get_post_meta(get_the_ID(), 'active')[0];
	if ($column === 'active') :?>
		<input id="<?php echo get_the_ID(); ?>" type="checkbox" class="activity_checkbox" <?php checked($status, 1) ?>>
	<?php endif;
}
add_action('manage_students_posts_custom_column', 'activity_checkbox_column');

/**
 * Function to update the activity of a student from the Students admin panel
 */
function update_activity() {
    $post_id = intval($_POST['post_id']);
    if ( get_post_meta($post_id, 'active')[0] == 1 ) {
        update_post_meta( $post_id, 'active', 0 );
    } else {
        update_post_meta( $post_id, 'active', 1 );
    }
}
add_action( 'wp_ajax_update_activity', 'update_activity' );

/**
 * Function to enqueue script
 */
function enqueue_script() {
	wp_register_script( 'get-activity-script', WP_PLUGIN_URL . '/students-plugin/get-activity-script.js', array( 'jquery' ) );
	wp_localize_script( 'get-activity-script', 'activity_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'get-activity-script' );
}
add_action( 'admin_init', 'enqueue_script' );

/**
 * Function to make the "Active" column in the Students admin panel sortable
 *
 * @param $columns
 *
 * @return $columns
 */
function set_custom_students_sortable_column( $columns ) {
	$columns['active'] = 'active';

	return $columns;
}
add_filter( 'manage_edit-students_sortable_columns', 'set_custom_students_sortable_column' );

/**
 * Function to sort the "Active" column in the Students admin panel
 */
add_filter( 'request', 'order_by_active' );
function order_by_active( $vars ) {
	if ( isset( $vars['orderby'] ) && 'active' == $vars['orderby'] ) {
		$vars = array_merge( $vars, array(
			'meta_key' => 'active',
			'orderby' => 'meta_value_num'
		) );
	}
	return $vars;
}
add_filter( 'request', 'order_by_active');