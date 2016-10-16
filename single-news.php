<?php
/**
 * The template for displaying a single news post.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package underscores
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div id="news-page">
			<section id="section-1-show">

			</section>

			<section id="section-2-show">


			<?php while ( have_posts() ) : the_post(); ?>
				<?php global $post; ?>
	      <?php $news = $post; ?>

				<?php $newsID = $news->ID; ?>
        <?php $newsPost_img_id = get_post_thumbnail_id( $newsID ); ?>
        <?php $newsPost_img = wp_get_attachment_url( $newsPost_img_id ); ?>
				<?php $newsTitle = $news->post_title; ?>
				<?php $newsDate = get_post_meta( $newsID, 'event_date', true ); ?>
				<?php $newsPostContent = $news->post_content; ?>
				<?php $newsPostDate = $news->post_date; ?>
				<?php $newsPostDate = date( 'F j, Y', strtotime( $newsPostDate ) ); ?>

				<?php // not using: ?>
				<?php $newsChapters = wp_get_post_terms( $newsID, 'chapter' ); ?>
				<?php $newsLink = get_post_permalink( $newsID ); ?>

				<!-- event date: -->
				<?php if ($newsPostDate) { ?>
					<div class="date-wrapper">
						<h3>
							Posted on
							<?php echo date('F j, Y', strtotime($newsPostDate)); ?>
						</h3>
					</div>
				<?php } ?>

				<div class="event-show-img-wrapper">
					<!-- img -->
	        <?php if ($newsPost_img) { ?>
	          <img src=" <?php echo $newsPost_img; ?> " alt="" />
	        <?php } ?>
				</div>

        <div class="event-show-header">

	        <!-- event title: -->
					<?php if ($newsTitle) { ?>
						<h3 class="event-show-title">
							<?php echo $newsTitle; ?>
						</h3>
					<?php } ?>

				</div>

				
			<div class="news-description">
				<!-- description: -->
				<?php if ($newsPostContent) { ?>
					<p class="description">
						<?php echo $newsPostContent; ?>
					</p>
				<?php } ?>
			</div>

			<?php endwhile; // End of the loop. ?>
		</section>

    </div>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>
