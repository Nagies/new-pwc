<?php
/**
 *
 * Template Name: Events
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
		<div id="events-page">

			<section id="section-1">
				<div class="overlay"></div>
				<div class="text-wrapper">
					<h1>
						EVENTS
					</h1>
				</div>
			</section>

			<section id="events-tabs-section">


<!-- query Events page content: -->
      <?php
        $args = array(
          'post_type' 	=> 	'page',
          'name'				=>	'events'
        );

        $event_page_objs = get_posts( $args );
        // gives you back an array; loop through to get content (should only be one)
        foreach ($event_page_objs as $obj ) {
          $events_page_content = $obj->post_content;
          ?>
          <div style="display: none;">
            <p>
              <?php echo $events_page_content ?>
            </p>
          </div>
          <?php
        }
      ?>
<!-- end query content on page: -->


<!-- PAST & ALL events links -->
      <?php // LR: change text & path of link depending on past/present events view ?>
      <?php if (get_query_var('past') ==='true') {
        $compare = '<'; ?>
        <li class="events-li"><a href="<?php echo trailingslashit( get_post_type_archive_link( 'events' ) ); ?>" class="events-a">See All Events</a></li>
      <?php } else {
        $compare = '>='; ?>
        <li class="events-li"><a href="<?php echo trailingslashit( path_join( get_post_type_archive_link( 'events' ), 'past' ) ); ?>" class="events-a">See Past Events</a></li>
      <?php } ?>
<!-- end PAST & ALL events links -->


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

<!-- LOOP #2: Loop over each chapter & get all event posts in that chapter -->
			<?php $secondCounter = 1; ?>
			<?php foreach ( $chapterSlugArr as $chapterSlug => $chapterName ) { ?>

				<div id="tabs-<?php echo $secondCounter; ?>">

					<?php
						if ($chapterSlug == 'all') { // the ALL tab contains all events, so omit the "chapter" query
			        $args = array(
			          'post_type' 			=> 'events',
			          'post_status' 		=> 'publish',
			          'posts_per_page' 	=>    - 1,
			          'order'          	=>    'ASC',
			          'orderby'        	=>    'meta_value_num',
			          'meta_key'       	=>    'event_date',
			            'meta_query'    =>    array(
			              array(
			                'key'     =>    'event_date',
			                'type'    =>    'DATE',
			                'compare' =>    $compare,
			                'value'   =>    date('Ymd'),
			              )
			            )
			        );
			        $chapterEventPostArr = get_posts( $args );

						} else {	// Get all posts in certain location
			        $args = array(
			          'post_type' 			=> 'events',
			          'chapter' 				=> $chapterSlug,
			          'post_status' 		=> 'publish',
			          'posts_per_page' 	=>    - 1,
			          'order'          	=>    'ASC',
			          'orderby'        	=>    'meta_value_num',
			          'meta_key'       	=>    'event_date',
			            'meta_query'    =>    array(
			              array(
			                'key'     =>    'event_date',
			                'type'    =>    'DATE',
			                'compare' =>    $compare,
			                'value'   =>    date('Ymd'),
			              )
			            )
			        );
			        $chapterEventPostArr = get_posts( $args );
						}
					?>

					<?php // loop over array of posts (events in that chapter) ?>
					<?php if ( count($chapterEventPostArr) == 0 ) { // If no posts, display a message ?>
						<h3 class="no-events">There are no events for this chapter at this time.</h3>
					<?php }	else { // if there are events, loop over them ?>

						<?php foreach($chapterEventPostArr as $event) { ?>

				      <?php // info about events: ?>
				      <?php $eventID = $event->ID; ?>
				      <?php $eventTitle = $event->post_title; ?>
				      <?php $eventDate = get_post_meta( $eventID, 'event_date', true ); ?>
							<?php $eventChapters = wp_get_post_terms( $eventID, 'chapter' ); ?>
							<?php $eventPostDate = $event->post_date; ?>
				      <?php $eventDescripEditor = $event->post_content; ?>
				      <?php $eventLink = get_post_permalink( $eventID ); ?>
				      <?php $eventPostDate = date( 'F j, Y', strtotime( $eventPostDate ) ); ?>
				      <?php $eventTime = get_post_meta( $eventID, 'event_time', true ); ?>
				      <?php $venueName = get_post_meta( $eventID, 'event_venue_name', true ); ?>
				      <?php $venueAddress = get_post_meta( $eventID, 'event_venue_address', true ); ?>
				      <?php $registerURL = get_post_meta( $eventID, 'event_register_url', true ); ?>
				      <?php $photosURL = get_post_meta( $eventID, 'event_photos_url', true );  ?>
				      <?php $event_speakers = get_post_meta( $eventID, 'event_speakers', true ); ?>


							<?php // featured img -- uncomment desired img size: ?>
							<?php $event_img_id = get_post_thumbnail_id($eventID); ?>
							<?php /* THUMB: (default 150px x 150px max) */ ?>
							<?php // $img_url_array = wp_get_attachment_image_src($event_img_id, 'thumbnail', true); ?>
							<?php /* MEDIUM: (default 300px x 300px max) */ ?>
							<?php // $img_url_array = wp_get_attachment_image_src($event_img_id, 'medium', true); ?>
							<?php /* LARGE: (default 640px x 640px max) */ ?>
							<?php $img_url_array = wp_get_attachment_image_src($event_img_id, 'large', true); ?>
							<?php /* ORIGINAL: (unmodified) */ ?>
							<?php // $img_url_array = wp_get_attachment_image_src($event_img_id, 'full', true); ?>
							<?php $img_url = $img_url_array[0]; ?>


							<?php // Default stock event images ?>
							<?php $stockImgArr = array(
								'http://c5.staticflickr.com/2/1562/24350573036_2d4f7c25c4_c.jpg',
								'http://c5.staticflickr.com/2/1557/24081188540_a90f9a7342_c.jpg',
								'http://c1.staticflickr.com/8/7465/27107093712_097d1a0bbd_h.jpg',
								'http://c4.staticflickr.com/2/1489/24009576859_535075cf43_h.jpg',
								'http://c5.staticflickr.com/2/1689/23748979724_14ee85c8b1_h.jpg',
								'http://c6.staticflickr.com/2/1590/24009290469_f07adadffd_h.jpg',
								'http://c4.staticflickr.com/8/7631/16916674371_738f08c8d8_h.jpg',
								'http://c7.staticflickr.com/9/8753/16891682526_8eefb89c79_h.jpg',
								'http://c7.staticflickr.com/9/8729/16295240214_9f5c7dea78_h.jpg'
							); ?>
							<?php $randomIndex = array_rand($stockImgArr) ?>


							<div class="event-wrapper">

								<?php if ( $event_img_id ) { // if post has an img ?>
									<?php $bg_img_url = $img_url; ?>
								<?php } else { // if post doesn't have img, randomize a pre-set img ?>
									<?php $bg_img_url = $stockImgArr[$randomIndex]; ?>
								<?php } ?>

								<div class="image-wrapper" style="background-image: url('<?php echo $bg_img_url; ?>');">
									<!-- event date: -->
				          <?php if ($eventDate) { ?>
				            <p class="event-date">
				              <?php echo date('F j, Y', strtotime($eventDate)); ?>
				            </p>
				          <?php } ?>
								</div>

								<div class="text-wrapper">
					        <!-- event title: -->
					        <?php if ($eventTitle) { ?>
					          <h3>
					            <a href="<?php echo $eventLink; ?>"><?php echo $eventTitle; ?></a>
					          </h3>
					        <?php } ?>

				          <!-- event location: -->
				          <?php if ($eventTime) { // this only echoes the first chapter location (if the admin accidentally selected more than one) ?>
				            <p class="event-time">
											<?php echo $eventChapters[0]->name; ?> •
										</p>
				          <?php } ?>

				          <!-- event time: -->
				          <?php if ($eventTime) { ?>
				            <p class="event-time">
				              <?php echo $eventTime; ?>
										</p>
				          <?php } ?>


				         	<div class="event-description-container">
					          <p class="event-description"><?php echo $eventDescripEditor; ?></p>
					        </div>


									<div style="display: none;">
					          <!-- venue: -->
					          <?php if ($venueName) { ?>
					            <p>
					              <?php echo $venueName; ?>
					            </p>
					          <?php } ?>

					          <!-- venue address: -->
					          <?php if ($venueAddress) { ?>
					            <p>
					              <?php echo $venueAddress; ?>
					            </p>
					          <?php } ?>
					        </div>

									<div class="icon-wrapper">
				        		<icon class="icon-arrow-right"></icon>
				        	</div>

				        </div>


		          </div>

						<?php } // end individual post ?>

					<?php } // end loop over all events ?>

				</div> <!-- #tabs-num end div for individual tabs -->
				<?php $secondCounter++; ?>

			<?php } // end loop over chapters to get all posts ?>
<!-- end LOOP #2 -->

			</div> <!-- #tabs end jQuery tabs section-->
			</section>
		</div><!-- #events-page -->
	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
