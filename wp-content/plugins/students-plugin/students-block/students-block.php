<?php
/**
 * Plugin Name:       Students Block
 * Description:       Example block written with ESNext standard and JSX support – build step required.
 * Requires at least: 5.7
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       students-block
 *
 * @package           create-block
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/writing-your-first-block-type/
 */


/**
 * Registers the Students block type and the index.js script
 */
function create_block_students_block_block_init() {
	$res = wp_register_script('students-block-js',
		plugins_url('students-block/src/index.js'),
		array('wp-blocks', 'wp-i18n', 'wp-editor'));


	register_block_type_from_metadata( __DIR__, array(
			'render_callback' => 'render_students_callback',
			'attributes' => array(
					'status' => array(
							'type' => 'string',
					),
					'count' => array(
							'type' => 'int',
					),
			)));

}
add_action( 'init', 'create_block_students_block_block_init' );



/**
 * Renders the active/inactive students on the front-end
 */
function render_students_callback($props) {
	$status = ($props['status'] == 'active') ? 1 : 0;
	$posts_per_page = $props['count'];
	$args = array(
		'post_type' => 'students',
		'post_status' => 'publish',
		'posts_per_page' => $posts_per_page,
		'meta_key'       => 'active',
		'meta_query'     => array(
			'key'     => 'active',
			'value'   => $status,
			'compare' => '=',
		),
	);

	$the_query = new WP_Query($args);

	ob_start(); ?>
	<?php if ($the_query->have_posts()) :?>
		<div>
			<ul>
			<?php while ($the_query->have_posts()) : ?>
				<?php  $the_query->the_post(); ?>
					<li>
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</li>
			<?php endwhile; ?>
			</ul>
		</div>
	<?php endif; ?>

<?php
	return ob_get_clean();
}
