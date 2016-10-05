
<?php
/*
	Template Name: Jobs Page
*/
?>

<?php get_header(); ?>
<!-- ****************************************-->
<!-- Not using! Use archive-jobs.php instead -->
<!-- ****************************************-->

<p>
	Reading from page-jobs.php!!
</p>
<p>
	Submit a job: <a href="<?php echo get_site_url(); ?>/jobs/submit-job/"><?php echo get_site_url(); ?>/jobs/submit-job/</a>
</p>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		// start loop to get content on jobs page //
		while ( have_posts() ) : the_post();
			get_template_part( 'content', 'page' );
			get_template_part( 'template-parts/content', 'page' );
		endwhile;
		?>
		<hr>
		<?php

		// get the jobs cpts //
		$args = array(
			'post_type'	=> 'jobs',
			'post_status'	=> 'publish',
			'posts_per_page' => -1,
			'order' => 'DESC',
			'oderby' => 'date'
		);
		$jobs_posts = get_posts($args);

		foreach ( $jobs_posts as $job ) {
			$jobID 			= $job->ID;
			$jobPostDate 	= $job->post_date;
			$jobTitle 		= $job->post_title;
			?>
			<p><?php echo $jobID; ?></p>
			<p>Posted on: <?php echo date('F j, Y', strtotime($jobPostDate)); ?></p>
			<p><?php echo $jobTitle; ?></p>
			<p>
				<a href="<?php echo get_post_permalink($jobID); ?>">
					<?php echo get_post_permalink($jobID); ?>
				</a>
			</p>
			<p><?php echo get_post_meta($jobID, 'job_location', true); ?></p>
			<?php
			$jobTypes = get_the_terms( $jobID, 'job_type' );

			if ( $jobTypes && ! is_wp_error($jobTypes) ) {
				foreach ($jobTypes as $typeObj) {
					// if no type selected, make general the default
					$typeSlug = 'general-job';
					?>
					<p>Job type:
						<?php echo $typeObj->slug; ?>
					</p>
					<?php
				}
			}	?>
			<hr>
			<?php
		}

		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php //get_footer(); ?>
