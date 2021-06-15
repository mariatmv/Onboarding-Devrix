<?php
get_header(); ?>
<?php
$posts_per_page = 10;
$args = array(
	'post_type' => 'students',
	'posts_per_page' => $posts_per_page,
	'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
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
        echo paginate_links();
	?>
<?php endif; ?>
<?php get_sidebar('Students Sidebar') ?>
<?php get_footer() ?>