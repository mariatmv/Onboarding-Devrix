<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="site-header">
	<p class="site-title">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php bloginfo( 'name' ); ?>
		</a>
	</p>
	<p class="site-description"><?php bloginfo( 'description' ); ?></p>
</header>
<div class="site-content">
    <a href='localhost/testing/site-archives'>Site Archive</a>
	<?php
    posts_nav_link();
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
	posts_nav_link();
	wp_reset_postdata();
	?>
</div><!-- .site-content -->
<?php wp_footer(); ?>
</body>
</html>