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
			<div id="events-page">
			<section id="section-1-show">

			</section>

			<section id="section-2-show">


			<?php while ( have_posts() ) : the_post(); ?>
				<?php global $post;
	      $event = $post; ?>

				<?php // var_dump($post) ?>

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

				<!-- event date: -->
				<?php if ($eventDate) { ?>
					<div class="date-wrapper">
						<h3>
							<?php echo date('F j, Y', strtotime($eventDate)); ?>
						</h3>
					</div>
				<?php } ?>

				<div class="event-show-img-wrapper">
					<?php if ( $event_img_id ) { // if post has an img ?>
						<img src=" <?php echo $img_url; ?> ">
					<?php } else { // if post doesn't have img, randomize a pre-set img ?>
						<img src=" <?php echo $stockImgArr[$randomIndex]; ?> ">
					<?php } ?>
				</div>


				<div class="event-show-header">
					<!-- event title: -->
					<?php if ($eventTitle) { ?>
						<h3 class="event-show-title">
							<?php echo $eventTitle; ?>
						</h3>
					<?php } ?>

					

					<!-- chapter: -->
					<!-- Note: the admin can select mult. chapters; I only display the 1st one -->
					<?php if ($eventChapters) { ?>
						<p class="event-show-chapter">Chapter:
							<span><?php echo $eventChapters[0]->name;	?></span>
						</p>
					<?php } ?>
				</div>

				<div class="event-show-description">

					<!-- event description: -->
					<?php if ($eventDescripEditor) { ?>
						<p>
							<?php echo $eventDescripEditor; ?>
						</p>
					<?php } ?>

				</div>

				<div class="event-show-info">

					<!-- event time: -->
					<?php if ($eventTime) { ?>
						<p>
							Event time:
							<span>
							<?php echo $eventTime; ?>
							</span>
						</p>
					<?php } ?>

					<!-- venue: -->
					<?php if ($venueName) { ?>
						<p>
							Venue:
							<span>
							<?php echo $venueName; ?>
							</span>
						</p>
					<?php } ?>

					<!-- venue address: -->
					<?php if ($venueAddress) { ?>
						<p>
							Address:
							<span>
							<?php echo $venueAddress; ?>
							</span>
						</p>
					<?php } ?>

					<div class="event-show-btns">

						<a href="">
							<button class="event-show-btn register-btn">
								Register
							</button>
						</a>

						<a href="">
							<button class="event-show-btn see-photos-btn">
								See Photos
							</button>
						</a>
					</div>

					<!-- event registration url: -->
					<div style="display: none;">
						<?php if ($registerURL) { ?>
							<p>
								Register:
								<?php echo $registerURL = esc_url( $registerURL ); ?>
							</p>
						<?php } ?>
					</div>

					<!-- event photos url: -->
					<div style="display: none;">
					<?php if ($photosURL) { ?>
						<p>
							Photos:
							<?php echo $photosURL; ?>
						</p>
					<?php } ?>
					</div>
				</div>

				<div class="event-show-speakers-wrapper">
				<!-- event speakers: -->
	      <?php if ($event_speakers) { ?>
	        <h3>
						Speakers
					</h3>

	          <?php // begin looping through speakers:
							$counter = 0;
	            foreach ($event_speakers as $key => $value) {
								$counter++;
								// info about a speaker:
								$speaker_id = $value['speaker_id'];
								$all_speaker_info = get_post($speaker_id);
								//print_r( $all_speaker_info);
								$all_speaker_meta = get_post_meta($speaker_id);
								// print_r($all_speaker_meta);
								$speaker_name = $all_speaker_info->post_title;
								$speaker_job_title = get_post_meta($speaker_id, 'job_title', true);
								$speaker_company = get_post_meta($speaker_id, 'company', true);
								$speaker_bio = $all_speaker_info->post_content;
								$speaker_img_id = get_post_thumbnail_id( $speaker_id );
								$speaker_img = wp_get_attachment_url( $speaker_img_id );
								// if no speaker img provided:
								$default_speaker_img = 'https://0.gravatar.com/avatar/09c96925292b9671a1a6dac1ff587972?s=300&amp;d=retro&amp;r=G';

								$speaker_role = $value['roles'];
								switch ($speaker_role) {
									case '1':
										$speaker_role = 'Honoree';
										break;
									case '2':
										$speaker_role = 'Panelist';
										break;
									case '3':
										$speaker_role = 'Honoree';
										break;
								} // end switch
								?>

								<div class="speaker-wrapper">
									<!-- speaker img -->
									<?php if ($speaker_img_id) { // display provided speaker img ?>
										<img src=" <?php echo $speaker_img; ?> " alt="" />
										<br>
									<?php } else { // otherwise display default mysteray man img ?>
										<img src=" <?php echo $default_speaker_img; ?> " alt="" />
										<br>
									<?php } ?>

									<div style="height: 115px;">
										<p>Speaker #<?php echo $counter; ?>: 
											<span><?php echo $speaker_name; ?></span>
										</p>

										<!-- speaker's job title: -->
										<?php if ($speaker_job_title) { ?>
											<p>Job Title: <span><?php echo $speaker_job_title; ?></span> </p>
										<?php } ?>

										<!-- speaker company: -->
										<?php if ($speaker_company) { ?>
											<p>Company: <span><?php echo $speaker_company; ?></span> </p>
										<?php } ?>

										<!-- speaker role: -->
										<?php if ($speaker_role) { ?>
											<p>Role: <span> <?php echo $speaker_role; ?></span> </p>
										<?php } ?>
									</div>

								<!-- speaker bio: -->
								<?php if ($speaker_bio) { ?>
									<p class="speaker-bio"><?php echo $speaker_bio; ?> </p>
								<?php } ?>

								</div>

							<?php } // end looping over each event speaker
	           ?>
	      <?php } ?>
	     	</div>

				<div class="event-show-sponsors-wrapper">
	      <?php $event_sponsors = get_post_meta( $eventID, 'event_sponsors', true ); ?>
	      <?php if ($event_sponsors) { ?>
	        <h3>
	          Sponsors
	         </h3>
						<!-- <p>
							<?php // print_r($event_sponsors); ?>
						</p> -->
						<?php
	          foreach ($event_sponsors as $key => $value) {

							// sponsor info:
	            $event_sponsor_id = $value;
	            $all_sponsor_info = get_post($event_sponsor_id);
							// echo print_r($all_sponsor_info);
							$sponsor_name = $all_sponsor_info->post_title;
							$sponsor_descrip = $all_sponsor_info->post_content;
							$sponsor_img_id = get_post_thumbnail_id( $event_sponsor_id );
							$sponsor_img = wp_get_attachment_url( $sponsor_img_id );
							?>

							<div class="sponsor-wrapper">

								<!-- sponsor name: -->
								<?php if ($sponsor_name) { ?>
									<h5 class="sponsor-title"><?php echo $sponsor_name;?> </h5>
								<?php } ?>
							
								<img src=" <?php echo $sponsor_img; ?> " alt="" />

								<!-- sponsor description: -->
								<?php if ($sponsor_descrip) { ?>
									<p class="sponsor-descrip"><?php echo $sponsor_descrip;?> </p>
								<?php } ?>
							

							
							
							</div>

							<div class="modal-container" style="display: none;">
								<div class="modal">
									<span>x</span>
									<h3>Eddard Stark</h3>
									<img src="https://lovelace-media.imgix.net/uploads/1461/9ff59620-8ef9-0133-3955-06e18a8a4ae5.jpg?" alt="">
									<p>
										Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat, id repudiandae deserunt obcaecati, odit minus, suscipit et quam minima laborum facilis vel excepturi accusantium ad reiciendis pariatur ullam, aspernatur laboriosam.

									</p>
								</div>
							</div>
							
						<?php } ?>
	      <?php } ?>
	     </div>

			<?php endwhile; // End of the loop. ?>
		</section>



		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>
