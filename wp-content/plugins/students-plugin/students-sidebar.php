<?php
/**
 * Function to register a custom sidebar called 'Students'
 */
function register_students_sidebar() {
	register_sidebar( array(
		'name'          => __( 'Students Sidebar', 'twentytwentyone' ),
		'id'            => 'students-sidebar',
		'before_widget' => '<ul><li id="%1$s" class="widget %2$s"><a href="' . the_permalink() . '">',
		'after_widget'  => '</a></li></ul>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'register_students_sidebar' );

/**
 * Function to display the Students sidebar
 *
 */
function display_students_sidebar(  ) {
	if ( is_active_sidebar( 'students-sidebar' ) ) { ?>
		<aside class="sidebar">
			<?php dynamic_sidebar( 'students-sidebar' ); ?>
		</aside>
		<?php
	}
}
add_filter( 'get_footer', 'display_students_sidebar' );