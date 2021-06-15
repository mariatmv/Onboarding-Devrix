<?php
/** Students Widget */
class students_widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'students_widget',
			__('Students Widget', 'wpb_widget_domain'),
			array('description' => __('Students', 'wpb_widget_domain'))
		);
	}

	/**
     * Widget front-end
     */
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];

		$posts_per_page = $instance['posts_per_page'];
		$status = ( 'active' === $instance['status'] ) ? 1 : 0;
		$args = array(
			'post_type' => 'students',
			'posts_per_page' => $posts_per_page,
			'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
			'meta_key'       => 'active',
			'meta_query'     => array(
				'key'     => 'active',
				'value'   => $status,
				'compare' => '=',
			),
		);
		wp_reset_query();
		$query = new WP_Query($args);
		if ($query->have_posts()) : ?>
			<ul>
				<?php
				while ($query->have_posts()) :
					$query->the_post(); ?>
					<li><a href="<?php get_the_permalink(); ?>"><?php the_title() ?></a></li>
				<?php
				endwhile;
				?>
			</ul>
		<?php
		endif;

		echo $args['after_widget'];
	}

	/**
     * Widget back-end
     *
	 * @param array $instance
	 *
	 * @return string|void
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'wpb_widget_domain' );
		}

		?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
                   name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
                   value="<?php echo esc_attr( $title ); ?>" />
        </p>
		<?php

		$posts_per_page = $instance['posts_per_page'];
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'posts_per_page'); ?>">Posts per page:</label>
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'posts_per_page' ); ?>"
                   name="<?php echo $this->get_field_name( 'posts_per_page' ); ?>" type="number"
                   value="<?php echo $posts_per_page; ?>">
		</p>
		<?php

		$status = $instance['status'];

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'status' ); ?>">Status:</label>
			<select id="<?php echo $this->get_field_id( 'status' ); ?>"
                    name="<?php echo $this->get_field_name( 'status' ); ?>">

				<option value="active" <?php echo ( 'active' === $status ) ? 'selected' : ''; ?>>Active</option>
				<option value="inactive" <?php echo ( 'inactive' === $status ) ? 'selected' : ''; ?>>Inactive</option>

			</select>
		</p>
		<?php

}

	/**
     * Updating widget
     * Replacing old instances with new ones
     *
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['posts_per_page'] = $new_instance['posts_per_page'];
		$instance['status']  = $new_instance['status'];

		return $instance;
	}

}

/**
 * Registers the Students widget
 */
function wpb_load_students_widget() {
	register_widget( 'students_widget' );
}
add_action( 'widgets_init', 'wpb_load_students_widget' );