<?php
/*
	Template Name: Submission Success Page
*/
?>

<?php get_header(); ?>

<div id="jobs-page">
	<section id="section-1-show">

	</section>
	<section id="section-2", class="full">
		<div class="success-wrapper">
			<h1 class="success">SUCCESS!</h1>
			<img src="/pwc/wp-content/themes/underscores/images/checkmark.png" alt="">
		</div>
	</section>
</div>

<?php while ( have_posts() ) : the_post(); ?>

  <?php get_template_part( 'template-parts/content', 'page' ); ?>

<?php endwhile; // End of the loop. ?>

<?php get_footer(); ?>
