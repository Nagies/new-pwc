<?php
/**
 *
 * Template Name: Board Members
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
					<h1>
						BOARD OF DIRECTORS
					</h1>
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



<!-- query content on page: -->
					<?php
						$args = array(
							'post_type' 	=> 	'page',
							'name'				=>	'board-of-directors'
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
			  <ul>
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
			          'post_type' 			=> 'board-members',
			          'post_status' 		=> 'publish',
			          'posts_per_page' 	=>    - 1,
								'orderby'					=> 'title',
			          'order'          	=> 'ASC'
			        );
			        $chapterBoardMembersPostArr = get_posts( $args );

						} else {	// Get all posts in certain location
			        $args = array(
			          'post_type' 			=> 'board-members',
			          'chapter' 				=> $chapterSlug,
			          'post_status' 		=> 'publish',
			          'posts_per_page' 	=>    - 1,
								'orderby'					=> 'title',
			          'order'          	=>    'ASC'
			        );
			        $chapterBoardMembersPostArr = get_posts( $args );
						} // end else
					?>

					<?php // loop over array of posts (sponsors in that chapter) ?>
					<?php if ( count($chapterBoardMembersPostArr) == 0 ) { // If no posts, display a message ?>
						<h3 class="no-events">There are no board members listed for this chapter at this time.</h3>

					<?php }	else { // if there are posts, loop over them ?>

						<?php foreach($chapterBoardMembersPostArr as $boardMember) { ?>

				      <?php //* info about sponsor: *// ?>
				      <?php $boardMemberID 						= $boardMember->ID; ?>
				      <?php $boardMemberName 					= $boardMember->post_title; ?>
							<?php $boardMemberChaptersArr 	= wp_get_post_terms( $boardMemberID, 'chapter' ); ?>
							<?php $boardMemberChapter 			= $boardMemberChaptersArr[0]->name; ?>
							<?php $boardMember_website     	= get_post_meta($boardMemberID, 'sponsor_website', true); ?>

							<?php $memberDescription = $boardMember->post_content; ?>
							<?php $memberJobTitle = get_post_meta( $boardMemberID, 'job_title', true ); ?>
							<?php	$memberCompany = get_post_meta( $boardMemberID, 'company', true ); ?>

							<?php
							//* featured img -- uncomment desired img size: *//
							?>
							<?php $boardMember_img_id = get_post_thumbnail_id($boardMemberID); ?>

							<?php
							/* THUMB: (default 150px x 150px max) */
							?>
							<?php // $img_url_array = wp_get_attachment_image_src($boardMember_img_id, 'thumbnail', true); ?>

							<?php
							/* MEDIUM: (default 300px x 300px max) */
							?>
							<?php // $img_url_array = wp_get_attachment_image_src($boardMember_img_id, 'medium', true); ?>

							<?php
							/* LARGE: (default 640px x 640px max) */
							?>
							<?php $img_url_array = wp_get_attachment_image_src($boardMember_img_id, 'large', true); ?>

							<?php
							/* ORIGINAL: (unmodified) */
							?>
							<?php // $img_url_array = wp_get_attachment_image_src($boardMember_img_id, 'full', true); ?>

							<?php $img_url = $img_url_array[0]; ?>

							<?php
								// echo $boardMemberID;
								// echo $boardMemberName;
								// echo $boardMemberChapter;
								// echo $boardMember_img_id;
								// echo $img_url;
								// echo $memberDescription;
								// echo $memberJobTitle;
								// echo $memberCompany;
							?>

<!-- begin individual a.sponsor "card" -->
							<div class="event-wrapper height-auto">

								<div class="image-wrapper">
						      <?php if ($boardMember_img_id) { ?>
						        <img src="<?php echo $img_url ?>" alt="" style="height: 200px;" />
						      <?php } ?>
						    </div>

						    <div class="text-wrapper">

						      <?php if ($boardMemberName) { ?>
						        <h3 class="about-header"><?php echo $boardMemberName; ?></h3>
						      <?php } ?>

						      <?php if ($memberJobTitle) { ?>
										<p><?php echo $memberJobTitle; ?>, <?php echo $memberCompany; ?></p>
									<?php } ?>

									<?php if ($boardMemberChapter) { ?>
										<p class="about-sub-header" style="padding-top: 5px;"><?php echo $boardMemberChapter; ?></p>
									<?php } ?>

								</div>
								<div style="clear: both;"></div>
								<div style="padding-top: 20px;">
									<?php if ($memberDescription) { ?>
										<p><?php echo $memberDescription; ?></p>
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
	</div>
</div>

	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
