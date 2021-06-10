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
		'supports'            => array( 'thumbnail', 'excerpt', 'title', 'editor',),
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

/** The following two functions are adding a meta box for CPT "students" about their subjects */
add_action('add_meta_boxes', 'add_subjects_custom_box');
function add_subjects_custom_box() {
	$screens = ['students'];
	foreach ($screens as $screen) {
		add_meta_box(
			'subjects',
			'Subjects',
			'subjects_custom_box_html',
			$screen
		);
	}
}

function subjects_custom_box_html($post) {
    $value = '';
	$subjects = get_post_meta(get_the_ID(), 'subjects');
	if (count($subjects) === 1) {
	    $value = $subjects[0];
    }
    ?>
    <label for="subjects">Subjects:</label>
    <input type="text" name="subjects" value="<?php echo $value;?>">
	<?php
}

/** The following two functions are adding a meta box for CPT "students" about where they live */
add_action('add_meta_boxes', 'add_lives_in_custom_box');
function add_lives_in_custom_box() {
	$screens = ['students'];
	foreach ($screens as $screen) {
		add_meta_box(
			'lives_in',
			'Lives In',
			'lives_in_custom_box_html',
			$screen
		);
	}
}

function lives_in_custom_box_html($post) {
	$value = '';
	$lives_in = get_post_meta(get_the_ID(), 'lives_in');
	if (count($lives_in) === 1) {
		$value = $lives_in[0];
	}
    ?>
	<label for="lives_in">Lives In:</label>
	<input type="text" name="lives_in" value="<?php echo $value;?>">
<?php
}

/** The following two functions are adding a meta box for CPT "students" about where their addresses */
add_action('add_meta_boxes', 'add_address_custom_box');
function add_address_custom_box() {
	$screens = ['students'];
	foreach ($screens as $screen) {
		add_meta_box(
			'address',
			'Address',
			'address_custom_box_html',
			$screen
		);
	}
}

function address_custom_box_html($post) {
	$value = '';
	$address = get_post_meta(get_the_ID(), 'address');
	if (count($address) === 1) {
		$value = $address[0];
	}
	?>
	<label for="address">Address:</label>
	<input type="text" name="address" value="<?php echo $value;?>">
	<?php
}

/** The following two functions are adding a meta box for CPT "students" about where their birthday */
add_action('add_meta_boxes', 'add_birthdate_custom_box');
function add_birthdate_custom_box() {
	$screens = ['students'];
	foreach ($screens as $screen) {
		add_meta_box(
			'birthday',
			'Birth date',
			'birthday_custom_box_html',
			$screen
		);
	}
}

function birthday_custom_box_html($post) {
	$value = '';
	$birthday = get_post_meta(get_the_ID(), 'birthday');
	if (count($birthday) === 1) {
		$value = $birthday[0];
	}
	?>
	<label for="birthday">Birth date:</label>
	<input type="date" name="birthday" value="<?php echo $value;?>">
	<?php
}

/** The following two functions are adding a meta box for CPT "students" about where their grade */
add_action('add_meta_boxes', 'add_grade_custom_box');
function add_grade_custom_box() {
	$screens = ['students'];
	foreach ($screens as $screen) {
		add_meta_box(
			'grade',
			'Grade',
			'grade_custom_box_html',
			$screen
		);
	}
}

function grade_custom_box_html($post) {
    ?>
    <label for="grade">Grade:</label>
    <select name="grade">
        <?php
	$value = '';
	$grade = get_post_meta(get_the_ID(), 'grade');
	if (count($grade) === 1) {
	    $value = $grade[0];
	    ?>
        <option value="<?php echo $value;?>"> <?php echo $value;?> </option> </select>
	<?php }
	else { ?>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
	</select>
	<?php }
}

/** The following two functions are adding a meta box for CPT "students" about where their activity status */
add_action('add_meta_boxes', 'add_activity_custom_box');
function add_activity_custom_box() {
	$screens = ['students'];
	foreach ($screens as $screen) {
		add_meta_box(
			'active',
			'Active',
			'activity_custom_box_html',
			$screen
		);
	}
}

function activity_custom_box_html($post) {
	$value = get_post_meta(get_the_ID(), 'active')[0];
	?>
    <label for="active">Active</label>
    <input type="checkbox" name="active" value="1"  <?php checked( $value, 1, true ); ?>>
	<?php
}


/** Saves the "Subjects" data in the DB */
add_action('post_updated', 'subjects_save_postdata');
function subjects_save_postdata($post_id) {
	update_post_meta(
		$post_id,
		'subjects',
		sanitize_text_field($_POST['subjects'])
	);
}

/** Saves the "Lives In" data in the DB */
add_action('post_updated', 'lives_in_save_postdata');
function lives_in_save_postdata($post_id) {
    update_post_meta(
            $post_id,
        'lives_in',
        sanitize_text_field($_POST['lives_in'])
    );
}

/** Saves the "Address" data in the DB */
add_action('post_updated', 'address_save_postdata');
function address_save_postdata($post_id) {
	update_post_meta(
		$post_id,
		'address',
		sanitize_text_field($_POST['address'])
	);
}

/** Saves the "Birth Date" data in the DB */
add_action('post_updated', 'birthday_save_postdata');
function birthday_save_postdata($post_id) {
	update_post_meta(
		$post_id,
		'birthday',
        $_POST['birthday']
	);
}

/** Saves the "Grade" data in the DB */
add_action('post_updated', 'grade_save_postdata');
function grade_save_postdata($post_id) {
	update_post_meta(
		$post_id,
		'grade',
		$_POST['grade']
	);
}

/** Saves the "Active" data in the DB */
add_action('post_updated', 'activity_save_postdata');
function activity_save_postdata($post_id) {
    if ($_POST['active'] !== 1) {
	    $_POST['active'] = 0;
    }
	update_post_meta(
		$post_id,
		'active',
		$_POST['active']
	);
}

add_filter('manage_students_posts_columns', 'set_students_activity_checkbox');
function set_students_activity_checkbox($columns) {
    $columns['active'] = __('Active', 'twentytwentyone');
    return $columns;
}

add_action('manage_students_posts_custom_column', 'activity_checkbox_column');
function activity_checkbox_column($column) {
    $status = get_post_meta(get_the_ID(), 'active')[0];
    if ($column === 'active') :?>
	    <input type="checkbox" class="active-student" <?php checked($status, 1) ?> disabled>
    <?php endif;
}

add_filter( 'manage_edit-students_sortable_columns', 'set_custom_students_sortable_column' );
function set_custom_students_sortable_column( $columns ) {
	$columns['active'] = 'active';

	return $columns;
}

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

?>