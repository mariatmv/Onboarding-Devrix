<?php
get_header();

/* Start the Loop */
while ( have_posts() ) :
	the_post(); ?>
	<article style="padding: 100px;">
		<h1><?php the_title()?></h1>
        <img src="<?php the_post_thumbnail() ?>
		<p><?php the_content(); ?></p>
		<span>Subjects:</span>
        <ul>
			<?php
			$subjects = explode(', ', get_post_meta(get_the_ID(), 'category', true));
			foreach ($subjects as $subject) : ?>
			    <li><?php echo $subject; ?></li>
            <?php endforeach;
			?>
        </ul>
	</article>
<?php
endwhile; // End of the loop.

get_footer();
