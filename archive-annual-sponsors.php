<?php
/**
 *
 * Template Name: Annual Sponsors page
 *
 * The template for displaying the board of directors archive page.
 *
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div id="about-page">
			<section id="section-1">
				<div class="overlay"></div>
				<div class="text-wrapper">
					<h1>SPONSORS</h1>
				</div>
			</section>
			<section id="section-2">
				<div class="about-container">

				<div class="side-menu">
					
					<h1>
						About
					</h1>

					<?php get_sidebar(); ?>
				</div>

				<div class="text-wrapper">

					<!-- get page content -->
					<!-- query content on page: -->
					<?php
						$args = array(
							'post_type' 	=> 	'page',
							'name'				=>	'sponsors'
						);

						$page_objs = get_posts( $args );
						// gives you back an array; loop through to get content (should only be one)
						foreach ($page_objs as $obj ) {
							$page_content = $obj->post_content;
							?>
							<div>
								<p class="short-title">
									<?php echo $page_content ?>
								</p>
							</div>
							<?php
						}
					?>


			
<!-- end get page content -->

		<section id="events-tabs-section">

<!-- Manual chapter arr -->
			<?php
			  // doing this manually because want in specific order
			  $chapterSlugArr = [
					'all'							=>  'ALL',
					'new-york'        =>  'NEW YORK',
			    'new-jersey'      =>  'NEW JERSEY',
			    'connecticut'     =>  'CONNECTICUT',
			    'washington-dc'   =>  'WASHINGTON DC'
			  ];
			?>
<!-- end Manual chapter arr -->

<!-- Begin tab div -->
			<div id="tabs">

<!-- LOOP #1: Make tab headers -->
			  <ul class="ui-tabs-nav">
					<?php $firstCounter = 1; ?>
					<?php foreach ( $chapterSlugArr as $chapterSlug => $chapterName ) { ?>
			    	<li><a href="#tabs-<?php echo $firstCounter; ?>"><?php echo $chapterName; ?></a></li>
						<?php $firstCounter++; ?>
					<?php } ?>
				</ul>
<!-- end Make tab header -->


<!-- LOOP #2: Loop over each chapter/location & get all a.sponsor posts in that chapter -->
			<?php $secondCounter = 1; ?>
			<?php foreach ( $chapterSlugArr as $chapterSlug => $chapterName ) { ?>

				<div id="tabs-<?php echo $secondCounter; ?>">

					<?php
						if ($chapterSlug == 'all') { // the ALL tab contains all sponsors, so omit the "chapter" query
			        $args = array(
			          'post_type' 			=> 'annual-sponsors',
			          'post_status' 		=> 'publish',
			          'posts_per_page' 	=>    - 1,
			          'order'          	=>    'ASC'
			        );
			        $chapterASponsorPostArr = get_posts( $args );

						} else {	// Get all posts in certain location
			        $args = array(
			          'post_type' 			=> 'annual-sponsors',
			          'chapter' 				=> $chapterSlug,
			          'post_status' 		=> 'publish',
			          'posts_per_page' 	=>    - 1,
			          'order'          	=>    'ASC'
			        );
			        $chapterASponsorPostArr = get_posts( $args );
						} // end else
					?>

					<?php // loop over array of posts (sponsors in that chapter) ?>
					<?php if ( count($chapterASponsorPostArr) == 0 ) { // If no posts, display a message ?>
						<h3 class="no-events">There are no sponsors listed for this chapter at this time.</h3>

					<?php }	else { // if there are posts, loop over them ?>

						<?php foreach($chapterASponsorPostArr as $annSponsor) { ?>

				      <?php //* info about sponsor: *// ?>
				      <?php $sponsorID 						= $annSponsor->ID; ?>
				      <?php $sponsorTitle 				= $annSponsor->post_title; ?>
							<?php $sponsorChaptersArr 	= wp_get_post_terms( $sponsorID, 'chapter' ); ?>
							<?php $sponsorChapter 			= $sponsorChaptersArr[0]->name; ?>
							<?php $sponsor_website     	= get_post_meta($sponsorID, 'sponsor_website', true); ?>

							<?php //* featured img -- uncomment desired img size: *// ?>
							<?php $sponsor_img_id = get_post_thumbnail_id($sponsorID); ?>
							<?php /* THUMB: (default 150px x 150px max) */ ?>
							<?php // $img_url_array = wp_get_attachment_image_src($sponsor_img_id, 'thumbnail', true); ?>
							<?php /* MEDIUM: (default 300px x 300px max) */ ?>
							<?php // $img_url_array = wp_get_attachment_image_src($sponsor_img_id, 'medium', true); ?>
							<?php /* LARGE: (default 640px x 640px max) */ ?>
							<?php $img_url_array = wp_get_attachment_image_src($sponsor_img_id, 'large', true); ?>
							<?php /* ORIGINAL: (unmodified) */ ?>
							<?php // $img_url_array = wp_get_attachment_image_src($sponsor_img_id, 'full', true); ?>

							<?php $img_url = $img_url_array[0]; ?>

							<?php
								// echo $sponsorID;
								// echo $sponsorTitle;
								// echo $sponsorChapter;
								// echo $sponsor_img_id;
								// echo $img_url;
							?>

<!-- begin individual a.sponsor "card" -->
							<div class="event-wrapper shorter">

								<div class="image-wrapper">

									<?php if ($sponsor_img_id) { ?>
						        <img src="<?php echo $img_url ?>" alt="" />
						      <?php } ?>
						    </div>

						    <div class="text-wrapper">

						      <?php if ($sponsor_website) { ?>
						        <h3><a href="<?php echo $sponsor_website; ?> "><?php echo $sponsorTitle; ?></a></h3>
						      <?php } else { ?>
						        <h3><?php echo $sponsorTitle; ?></h3>
						      <?php } ?>

									<?php if ($sponsorChapter) { ?>
										<p><?php echo $sponsorChapter; ?></p>
									<?php } ?>
								</div>

					      

							</div>
<!-- end "card" -->





						<?php } // end individual post ?>

					<?php } // end loop over all posts ?>

				</div> <!-- #tabs-num end div for individual tabs -->
				<?php $secondCounter++; ?>

			<?php } // end loop over chapters to get all posts ?>
<!-- end LOOP #2 -->

					</div> <!-- #tabs end jQuery tabs section-->
				</section> <!-- end #events-tabs-section -->
			</div><!-- End text wrapper -->
		</section><!-- End section 2 -->
		</div>

		</div><!-- About div -->
	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
