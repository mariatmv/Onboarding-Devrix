<?php
get_header();

/* Start the Loop */
while ( have_posts() ) :
	the_post();
    var_dump(get_post_meta(get_the_ID()));
?>
	<article style="padding: 100px;">
		<h1><?php the_title()?></h1>
        <img src="<?php the_post_thumbnail() ?>
		<p><?php the_content(); ?></p>
		<p>Lives In: <?php echo get_post_meta(get_the_ID(), 'lives_in')[0];?></p>
        <p>Address: <?php echo get_post_meta(get_the_ID(), 'address')[0];?></p>
        <p>Birth Date: <?php echo get_post_meta(get_the_ID(), 'birthday')[0];?></p>
        <p>Grade: <?php echo get_post_meta(get_the_ID(), 'grade')[0];?></p>
		<span>Subjects:</span>
        <ul>
			<?php
			$subjects = explode(', ', get_post_meta(get_the_ID(), 'subjects', true));
			foreach ($subjects as $subject) : ?>
			    <li><?php echo $subject; ?></li>
            <?php endforeach;
			?>
        </ul>
	</article>
<?php
endwhile; // End of the loop.

get_footer();
