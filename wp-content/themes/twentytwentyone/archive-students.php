<?php
get_header(); ?>
<?php
$args = array(
	'post_type'      => 'students',
	'posts_per_page' => 4,
	'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
);
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) :
	echo '<ul>'; ?>
	<?php
	while ( $the_query->have_posts() ) :
		$the_query->the_post();?>
		<article>
			<a href="<?php the_permalink(); ?>"><?php the_title()?></a>
			<p><?php the_excerpt(); ?></p>
		</article>
	<?php endwhile; ?>
	<?php echo paginate_links();?>
<?php endif; ?>
<?php get_footer() ?>