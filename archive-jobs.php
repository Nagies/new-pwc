<?php
/**
 *
 * Template Name: Jobs
 *
 * The template for displaying the jobs archive page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package underscores
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
      <div id="jobs-page">

        <section id="section-1">
          <div class="text-wrapper">
            <h1>
              JOBS
            </h1>
          </div>
        </section>

  			<?php get_sidebar(); ?>


        <section id="section-2">
          <div class="text-wrap">


          <!-- query content on page: -->
					<?php
						$args = array(
							'post_type' 	=> 	'page',
							'name'				=>	'jobs'
						);

						$page_objs = get_posts( $args );
						// gives you back an array; loop through to get content (should only be one)
						foreach ($page_objs as $obj ) {
							$page_content = $obj->post_content;
							?>
							<div>
								<p>
									<?php echo $page_content ?>
								</p>
							</div>
							<?php
						}
					?>

            <!-- "Submit a Job" link: -->
            <p>
              <a href="<?php echo get_site_url(); ?>/submit-job/">Click here to submit a job/contract >> </a>
            </p>
          </div>


        <div class="job-wrap">




            <!-- jobs cpts loop: -->
            <?php if ( have_posts() ) : ?>

              <?php /* Start the Loop */ ?>
              <?php // while ( have_posts() ) : the_post(); ?> <!-- commenting this out gets rid of the triple loop error -->

                <?php // get the jobs cpts //
                $args = array(
                  'post_type'	=> 'jobs',
                  'post_status'	=> 'publish',
                  'posts_per_page' => -1,
                  'order' => 'DESC',
                  'oderby' => 'date'
                );
                $jobs_posts = get_posts($args);

                foreach ( $jobs_posts as $job ) {
                  $jobID 			            =   $job->ID;
                  $jobTitle 		          =   $job->post_title;
                  $jobURL                 =   get_post_permalink($jobID);
                  $jobPostDate 	          =   $job->post_date;
                  $formattedJobPostDate   =   date('F j, Y', strtotime($jobPostDate));
                  $jobLocation            =   get_post_meta($jobID, 'job_location', true);
                  $jobCompany             =   get_post_meta( $jobID, 'company_name', true );
                  ?>

                  <h3>
                    <a href="<?php echo $jobURL ?>"><?php echo $jobTitle; ?></a>
                  </h3>

                  <?php if ($formattedJobPostDate) { ?>
                    <p>Posted on: <?php echo $formattedJobPostDate; ?></p>
                  <?php } ?>

                  <?php if ($jobCompany) { ?>
                    <p>Company: <?php echo $jobCompany; ?></p>
                  <?php } ?>

                  <?php if ($jobLocation) { ?>
                    <p>Location: <?php echo $jobLocation; ?></p>
                  <?php } ?>

                  <?php
                } ?>
              <?php // endwhile; ?> <!-- commenting this out gets rid of the triple loop error -->

              <?php // the_posts_navigation(); ?>

            <?php else : ?>

              <?php get_template_part( 'template-parts/content', 'none' ); ?>

            <?php endif; ?>
          </div>

      </section>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
