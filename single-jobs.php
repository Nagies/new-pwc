<?php
/**
 * The template for displaying a single job post.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package underscores
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div id="jobs-page">
			<section id="section-1-show">

			</section>

			<section id="section-2", class="fill">
				<div class="text-wrap">



		<?php while ( have_posts() ) : the_post(); ?>
			<?php global $post; ?>

			<?php // var_dump($post) ?>
			<?php $companyName = get_post_meta( $post->ID, 'company_name', true); ?>
			<?php $jobLocation = get_post_meta( $post->ID, 'job_location', true); ?>
			<?php $companyWebsite = get_post_meta( $post->ID, 'company_website', true); ?>
			<?php $jobURL = get_post_meta( $post->ID, 'job_url', true); ?>
			<?php $jobContactEmail = get_post_meta( $post->ID, 'job_contact_email', true); ?>

			<!-- job title -->
			<h1><?php the_title(); ?></h1>

			<!-- company name: -->
			<?php if ( $companyName ) { ?>
				<p><b>Company Name: </b><?php echo $companyName; ?></p>
			<?php } ?>

			<!-- job location -->
			<?php if ( $jobLocation ) { ?>
				<p><b>Job Location: </b><?php echo $jobLocation ?></p>
			<?php } ?>

			<!-- company website -->
			<?php if ( $companyWebsite ) { ?>
				<p><b>Company Website: </b><a href="<?php echo $companyWebsite ?></p>"><?php echo $companyWebsite ?></a>
			<?php } ?>

			<!-- url of job posting -->
			<?php if ( $jobURL ) { ?>
				<p><b>URL of job posting: </b><a href="<?php echo $jobURL ?></p>"><?php echo $jobURL ?></a>
			<?php } ?>

			<!-- job contact email -->
			<?php if ( $jobContactEmail ) { ?>
				<p><b>Job contact email: </b><?php echo $jobContactEmail ?></p>
			<?php } ?>

			<!-- job type -->
			<?php
			$jobTypes = get_the_terms( $jobID, 'job_type' );
			if ( $jobTypes && ! is_wp_error($jobTypes) ) { ?>
				<p><b>Job type: </b>
					<?php
					$counter = 0;
					$separator = '';
					?>
					<?php foreach ($jobTypes as $typeObj) {
						if ($counter > 0 ) {
							$separator = '• ';
						}
						?>
						<span><?php echo $separator;?><?php echo trim($typeObj->name); ?></span>
						<?php $counter++; ?>
					<?php } ?>
				</p>
			<?php }	?>

			<!-- job description -->
			<?php if ( $post->post_content !=="" ) { ?>
				<p>
					<b>Job description: </b>
						<?php the_content(); ?>
				</p>

			<?php } ?>

			<?php // get_template_part( 'template-parts/content', 'single' ); ?>
			<?php // the_post_navigation(); ?>

		<?php endwhile; // End of the loop. ?>

		</div>

		<a href="/pwc/jobs", class="back">Go back to view all jobs</a>
			</section>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>
