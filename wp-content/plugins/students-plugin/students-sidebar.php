<?php
/** Register custom sidebar */
add_action( 'widgets_init', 'register_students_sidebar' );
function register_students_sidebar() {
	register_sidebar( array(
		'name'          => __( 'Students Sidebar', 'twentytwentyone' ),
		'id'            => 'students-sidebar',
		'before_widget' => '<ul><li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li></ul>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}

add_filter( 'the_content', 'display_students_sidebar' );

function display_students_sidebar( $the_content ) {
	if ( is_active_sidebar( 'students-sidebar' ) ) { ?>
		<aside class="sidebar">
			<?php dynamic_sidebar( 'students-sidebar' ); ?>
		</aside>
		<?php
	}
	return $the_content;
}