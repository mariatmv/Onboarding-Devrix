<?php
/**
 * Function to add a 'Subjects' meta box to the Students CPT
 */
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
add_action('add_meta_boxes', 'add_subjects_custom_box');

/**
 * Callback for the add_meta_box function
 * @param $post
 * Returns the html of the 'Subjects' meta box
 */
function subjects_custom_box_html($post) {
	$value = '';
	$subjects = get_post_meta(get_the_ID(), 'subjects');
	if (count($subjects) === 1) {
		$value = $subjects[0];
	}
	?>
	<label for="subjects">Subjects:</label>
	<input type="text" name="subjects" value="<?php echo sanitize_text_field($value);?>">
	<?php
}

/**
 * Function to add a 'Lives in' metabox to the Students CPT
 */
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
add_action('add_meta_boxes', 'add_lives_in_custom_box');

/**
 * Callback for the add_meta_box function
 * @param $post
 * Returns the html of the 'Lives in' meta box
 */
function lives_in_custom_box_html($post) {
	$value = '';
	$lives_in = get_post_meta(get_the_ID(), 'lives_in');
	if (count($lives_in) === 1) {
		$value = $lives_in[0];
	}
	?>
	<label for="lives_in">Lives In:</label>
	<input type="text" name="lives_in" value="<?php echo sanitize_text_field($value);?>">
	<?php
}

/**
 * Function to add a 'Address' metabox to the Students CPT
 */
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
add_action('add_meta_boxes', 'add_address_custom_box');

/**
 * Callback for the add_meta_box function
 * @param $post
 * Returns the html of the 'Address' meta box
 */
function address_custom_box_html($post) {
	$value = '';
	$address = get_post_meta(get_the_ID(), 'address');
	if (count($address) === 1) {
		$value = $address[0];
	}
	?>
	<label for="address">Address:</label>
	<input type="text" name="address" value="<?php echo sanitize_text_field($value);?>">
	<?php
}

/**
 * Function to add a 'Birth Date' metabox to the Students CPT
 */
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
add_action('add_meta_boxes', 'add_birthdate_custom_box');

/**
 * Callback for the add_meta_box function
 * @param $post
 * Returns the html of the 'Birth Date' meta box
 */
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

/**
 * Function to add a 'Grade' metabox to the Students CPT
 */
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
add_action('add_meta_boxes', 'add_grade_custom_box');

/**
 * Callback for the add_meta_box function
 * @param $post
 * Returns the html of the 'Grade' meta box
 */
function grade_custom_box_html($post) {
	$value = '';
	$grade = get_post_meta(get_the_ID(), 'grade');
	if (count($grade) === 1) {
		$value = $grade[0];
	}
	?>
	<label for="grade">Grade:</label>
	<input type="text" name="grade" value="<?php echo intval(sanitize_text_field($value));?>">
    <?php
}

/**
 * Function to add a 'Active' metabox to the Students CPT
 */
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
add_action('add_meta_boxes', 'add_activity_custom_box');

/**
 * Callback for the add_meta_box function
 * @param $post
 * Returns the html of the 'Active' meta box
 */
function activity_custom_box_html($post) {
	$value = get_post_meta(get_the_ID(), 'active')[0];
	?>
	<label for="active">Active</label>
	<input type="checkbox" name="active" value="1"  <?php checked( $value, 1, true ); ?>>
	<?php
}


/**
 * Saving the subjects of the student
 *
 * @param (int) $post_id
 */
add_action('post_updated', 'subjects_save_postdata');
function subjects_save_postdata($post_id) {
	update_post_meta(
		$post_id,
		'subjects',
		sanitize_text_field($_POST['subjects'])
	);
}

/**
 * Saving the city and country of the student
 *
 * @param (int) $post_id
 */
add_action('post_updated', 'lives_in_save_postdata');
function lives_in_save_postdata($post_id) {
	update_post_meta(
		$post_id,
		'lives_in',
		sanitize_text_field($_POST['lives_in'])
	);
}

/**
 * Saving the address of the student
 *
 * @param (int) $post_id
 */
add_action('post_updated', 'address_save_postdata');
function address_save_postdata($post_id) {
	update_post_meta(
		$post_id,
		'address',
		sanitize_text_field($_POST['address'])
	);
}

/**
 * Saving the birth date of the student
 *
 * @param (int) $post_id
 */
add_action('post_updated', 'birthday_save_postdata');
function birthday_save_postdata($post_id) {
	update_post_meta(
		$post_id,
		'birthday',
		($_POST['birthday'])
	);
}

/**
 * Saving the grade of the student
 *
 * @param (int) $post_id
 */
add_action('post_updated', 'grade_save_postdata');
function grade_save_postdata($post_id) {
	update_post_meta(
		$post_id,
		'grade',
		sanitize_text_field($_POST['grade'])
	);
}


/**
 * Saving the activity of the student
 *
 * @param (int) $post_id
 */
function activity_save_postdata($post_id) {
    if ($_POST['active'] != 1) {
        $_POST['active'] = 0;
    }
	update_post_meta(
		$post_id,
		'active',
		$_POST['active']
	);
}
add_action('post_updated', 'activity_save_postdata');

