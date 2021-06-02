<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();

paginate_links();
$args = array(
	'post_type'         => 'post',
	'posts_per_page'    => 10
);
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {
	echo '<ul>';
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		echo '<li>' . get_the_title() . '</li>';
		echo '<p>' . the_content() . '</p>';
		echo '<small>' . the_time('Y, jS M') . '</small>';
	}
	echo '</ul>';
}
paginate_links();
wp_reset_postdata();

get_footer();
