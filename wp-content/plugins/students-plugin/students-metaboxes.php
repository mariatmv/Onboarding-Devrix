<?php
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
	$value = '';
	$grade = get_post_meta(get_the_ID(), 'grade');
	if (count($grade) === 1) {
		$value = $grade[0];
	}
	?>
	<label for="grade">Grade:</label>
	<input type="text" name="grade" value="<?php echo intval($value);?>">
    <?php
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

/**
 * saving the activity of the student
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

