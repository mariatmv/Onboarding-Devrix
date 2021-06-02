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

get_header(); ?>
<?php
$args = array(
	'post_type'      => 'post',
	'posts_per_page' => 2,
    'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
);
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) :
	echo '<ul>'; ?>
	<?php
	while ( $the_query->have_posts() ) :
		$the_query->the_post();?>
        <article>
            <a href="#"><?php the_title()?></a>
            <p><?php the_content(); ?></p>
            <small style="text-decoration: underline"><?php the_time('Y jS M'); ?></small>
        </article>
	<?php endwhile; ?>
	<?php echo paginate_links();?>
<?php endif; ?>
<?php get_footer() ?>
