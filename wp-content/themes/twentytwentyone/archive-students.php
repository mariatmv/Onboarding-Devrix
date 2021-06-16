<?php
get_header(); ?>
<?php
$posts_per_page = 4;
$paged = ( get_query_var('paged') ? get_query_var('paged') : 1);
$args = array(
	'post_type' => 'students',
	'posts_per_page' => $posts_per_page,
	'paged' => $paged,
	'meta_key'       => 'active',
	'meta_query'     => array(
		'key'     => 'active',
		'value'   => '1',
		'compare' => '=',
	),
);
$the_query = new WP_Query($args);
if ( $the_query->have_posts() ) :
	echo '<ul>'; ?>
	<?php
	while ( $the_query->have_posts() ) :
		$the_query->the_post();
        $thumbnail_id = get_post_thumbnail_id();
        ?>
            <article>
                <a href="<?php the_permalink(); ?>"><?php the_title()?></a>
                <p><?php the_excerpt(); ?></p>
            </article>
        <?php
    endwhile;
	?>
	<?php
	$big = 999999999; // need an unlikely integer

	echo paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $the_query->max_num_pages
	) );
	?>
<?php endif; ?>

<?php    wp_reset_query(); ?>

<?php get_footer() ?>