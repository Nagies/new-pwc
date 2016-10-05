<?php
/**
 *
 * Template Name: Membership Page
 *
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package underscores
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div id="membership-page">
				<section id="section-1">
					<div class="text-wrapper">
						<h1>
							Membership
						</h1>
						<h3>
							Membership is open to professional women and men, companies and public agencies in construction and allied industries.
						</h3>
					</div>
				</section>

				<section id="section-2">
					<div class="center-wrapper">
				  	<div class="membership-wrapper">
							<div class="membership">
								<h1>
									Apply for a new membership
								</h1>
								<div class="buttons">
									<a href=" <?php echo site_url( 'new-membership-application/' ); ?> ", class="button">View Web</a>
									<!-- <a href="http://pwcusa.org/membership.php", class="button">View Web</a> -->
									<a href="http://www.pwcusa.org/chapter-specific/NY01/downloads/PWC_AppForm.pdf", class="button fill">Via post mail</a>
								</div>
							</div>
						</div>
						<div class="membership-wrapper">
							<div class="membership">
								<h1>
									Renew an existing membership
								</h1>
								<div class="buttons">
									<a href=" <?php echo site_url( 'membership-renewal-application/' ); ?> ", class="button">View Web</a>
									<!-- <a href="http://pwcusa.org/membership-renewal.php" class="button">View Web</a> -->
									<a href="http://www.pwcusa.org/chapter-specific/NY01/downloads/PWC_RenewalForm.pdf" class="button fill">Via post mail</a>
								</div>
							</div>
						</div>
					</div>
				</section>


			</div>
		</main><!-- #main -->
	</div><!-- #primary -->


			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

			<?php endwhile; // End of the loop. ?>


<?php get_footer(); ?>
