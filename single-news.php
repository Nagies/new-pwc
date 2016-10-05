<?php
/**
 * The template for displaying a single news post.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package underscores
 */

get_header(); ?>

<h3>*Reading from: single-news.php*</h3>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div id="events-page">
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

        <!-- img -->
        <?php if ($newsPost_img) { ?>
          <img src=" <?php echo $newsPost_img; ?> " alt="" />
        <?php } ?>

        <!-- event title: -->
				<?php if ($newsTitle) { ?>
					<h3>
						<?php echo $newsTitle; ?>
					</h3>
				<?php } ?>

				<!-- event date: -->
				<?php if ($newsPostDate) { ?>
					<p>
						Posted on
						<?php echo date('F j, Y', strtotime($newsPostDate)); ?>
					</p>
				<?php } ?>

				<!-- description: -->
				<?php if ($newsPostContent) { ?>
					<p>
						<?php echo $newsPostContent; ?>
					</p>
				<?php } ?>

			<?php endwhile; // End of the loop. ?>
		</section>

    </div>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>
