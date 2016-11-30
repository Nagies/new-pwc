<?php
/**
 *
 * Template Name: Scholarships archive page
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
						Scholarships
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
							'name'				=>	'scholarships'
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
<!--  -->
<!--  -->
<!--  -->
<!--  -->




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
			          'post_type' 			=> 'scholarships',
			          'post_status' 		=> 'publish',
			          'posts_per_page' 	=>    - 1,
			          'order'          	=>    'ASC'
			        );
			        $chapterScholarshipsPostArr = get_posts( $args );

						} else {	// Get all posts in certain location
			        $args = array(
			          'post_type' 			=> 'scholarships',
			          'chapter' 				=> $chapterSlug,
			          'post_status' 		=> 'publish',
			          'posts_per_page' 	=>    - 1,
			          'order'          	=>    'ASC'
			        );
			        $chapterScholarshipsPostArr = get_posts( $args );
						} // end else
					?>

					<?php // loop over array of posts (scholarships in that chapter) ?>
					<?php if ( count($chapterScholarshipsPostArr) == 0 ) { // If no posts, display a message ?>
						<h3 class="no-events">There are no scholarships listed for this chapter at this time.</h3>

					<?php }	else { // if there are posts, loop over them ?>

						<?php foreach($chapterScholarshipsPostArr as $scholarship) { ?>

				      <?php //* info about post: *// ?>
				      <?php $scholarshipID 						= $scholarship->ID; ?>
				      <?php $scholarshipName 					= $scholarship->post_title; ?>
							<?php $scholarshipChaptersArr 	= wp_get_post_terms( $scholarshipID, 'chapter' ); ?>
							<?php $scholarshipChapter 			= $scholarshipChaptersArr[0]->name; ?>
							<?php $scholarship_website     	= get_post_meta($scholarshipID, 'sponsor_website', true); ?>

							<?php $memberDescription = $scholarship->post_content; ?>
							<?php $memberJobTitle = get_post_meta( $scholarshipID, 'job_title', true ); ?>
							<?php	$memberCompany = get_post_meta( $scholarshipID, 'company', true ); ?>

							<?php
								// echo $scholarshipID;
								// echo $scholarshipName;
								// echo $scholarshipChapter;
								// echo $scholarship_img_id;
								// echo $img_url;
								// echo $memberDescription;
								// echo $memberJobTitle;
								// echo $memberCompany;
							?>

<!-- begin individual a.sponsor "card" -->
							<div class="event-wrapper height-auto">
					      <?php if ($scholarshipName) { ?>
					        <h3 class="about-header"><?php echo $scholarshipName; ?></h3>
					      <?php } ?>

					      <?php if ($scholarship_img_id) { ?>
					        <img src="<?php echo $img_url ?>" alt="" />
					      <?php } ?>

								<?php if ($scholarshipChapter) { ?>
									<h5 class="about-sub-header"><?php echo $scholarshipChapter; ?></h5>
								<?php } ?>

								<?php if ($memberJobTitle) { ?>
									<p><?php echo $memberJobTitle; ?>, <?php echo $memberCompany; ?></p>
								<?php } ?>

								<?php if ($memberDescription) { ?>
									<p class="about-body"><?php echo $memberDescription; ?></p>
								<?php } ?>
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
	</section>
	
	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
