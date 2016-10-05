		<!-- LR: commented out - the styles on this el hid the past/present event links -->
    <!-- <section id="section-2"> -->
    <section>

      <div class="event-header">
        <h1>FIND AN EVENT NEAR YOU</h1>

        <!-- query content on page: -->
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
            <div>
              <p>
                <?php echo $events_page_content ?>
              </p>
            </div>
            <?php
          }
        ?>

        <?php // PAST & ALL events links ?>
        <?php // LR: change text & path of link depending on past/present events view ?>
        <?php if (get_query_var('past') ==='true') {
          $compare = '<'; ?>
          <li><a href="<?php echo trailingslashit( get_post_type_archive_link( 'events' ) ); ?>">See All Events</a></li>
        <?php } else {
          $compare = '>='; ?>
          <li><a href="<?php echo trailingslashit( path_join( get_post_type_archive_link( 'events' ), 'past' ) ); ?>">See Past Events</a></li>
        <?php } ?>

      </div>

    </section>

<section id="section-3">












<!-- 8.7.16 LR start here jQ tabs -->
<?php
  // doing this manually because want in specific order
  $chapterSlugArr = [
    'new-york'        =>  'New York',
    'new-jersey'      =>  'New Jersey',
    'connecticut'     =>  'Connecticut',
    'washington-dc'   =>  'Washington DC'
  ];
?>


<!-- jq ui tabs -->
    <div id="tabs">
      <ul>

        <?php
        //* tabs headers *//
        $counter = 1;
        foreach ($chapterSlugArr as $chapterSlug => $chapterName ) { ?>
          <li><a href="#tabs-<?php echo $counter; ?>"><?php echo $chapterName; ?></a></li>
        <?php $counter++;  ?>
        <?php } ?>


      </ul>

      <?php
      //* tabs content *//
      $anotherCounter = 1;
      foreach ($chapterSlugArr as $chapterSlug => $chapterName ) { ?>
        <!--  -->

        <?php
        // query for CPT in that chapter
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
        $chapterEvents = get_posts( $args );

        if ( count($chapterEvents) == 0 ) { ?>
          <p class="no-event">
            THERE ARE NO EVENTS IN <?php echo $upCaseName; ?> AT THIS TIME.
          </p>
        <?php } ?>

        <?php foreach ($chapterEvents as $event ) { ?>

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


        <!--  -->
        <div id="tabs-<?php echo $anotherCounter; ?>">
          <p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu.</p>


          <!-- event title: -->
          <?php if ($eventTitle) { ?>
            <p>
              <!-- <b><span>Event Title: </span></b> -->
              <a href="<?php echo $eventLink; ?>"><?php echo $eventTitle; ?></a>
            </p>
          <?php } ?>

          <!-- event date: -->
          <?php if ($eventDate) { ?>
            <p>
              Event date:
              <?php echo date('F j, Y', strtotime($eventDate)); ?>
            </p>
          <?php } ?>

          <!-- chapter: -->
          <!-- Note: the admin can select mult. chapters; I only display the 1st one -->
          <?php if ($eventChapters) { ?>
            <p>Chapter:
              <?php echo $eventChapters[0]->name;	?>
            </p>
          <?php } ?>

          <!-- event time: -->
          <?php if ($eventTime) { ?>
            <p>
              Event time:
              <?php echo $eventTime; ?>
            </p>
          <?php } ?>

          <!-- venue: -->
          <?php if ($venueName) { ?>
            <p>
              Venue:
              <?php echo $venueName; ?>
            </p>
          <?php } ?>

          <!-- venue address: -->
          <?php if ($venueAddress) { ?>
            <p>
              Address:
              <?php echo $venueAddress; ?>
            </p>
          <?php } ?>

        </div> <!-- end tab content -->



      <?php $anotherCounter++;  ?>
      <?php } ?>
    <?php } ?>


    </div>
<!-- / jq ui tabs -->







  <?php // chapter-separated events

  // doing this manually because want in specific order
  $chapterSlugArr = [
    'new-york'        =>  'New York',
    'new-jersey'      =>  'New Jersey',
    'connecticut'     =>  'Connecticut',
    'washington-dc'   =>  'Washington DC'
  ];

  // var_dump($chapterSlugArr);


  // loop over term slugs
  foreach ($chapterSlugArr as $chapterSlug => $chapterName ) { ?>

    <?php $upCaseName = strtoupper($chapterName); ?>

    <h2><?php echo $upCaseName; ?></h2>

    <?php
    // query for CPT in that chapter
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
    $chapterEvents = get_posts( $args );

    // var_dump($chapterEvents);

    if ( count($chapterEvents) == 0 ) { ?>
      <p class="no-event">
        THERE ARE NO EVENTS IN <?php echo $upCaseName; ?> AT THIS TIME.
      </p>
    <?php }

    // loop over events in that chapter
    foreach ($chapterEvents as $event ) {

      // info about events: ?>
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

    <div class="event-outer">
      <div class="event-wrapper">

        <!-- event title: -->
        <?php if ($eventTitle) { ?>
          <h3>
            <!-- <b><span>Event Title: </span></b> -->
            <a href="<?php echo $eventLink; ?>"><?php echo $eventTitle; ?></a>
          </h3>
        <?php } ?>

        <div class="event-inner">
          <!-- event date: -->
          <?php if ($eventDate) { ?>
            <p>
              Event date:
              <?php echo date('F j, Y', strtotime($eventDate)); ?>
            </p>
          <?php } ?>

          <!-- chapter name: -->
          <!-- Note: the admin can select mult. chapters; I only display the 1st one -->
          <?php if ($eventChapters) { ?>
            <p>Chapter:
              <?php echo $eventChapters[0]->name;	?>
            </p>
          <?php } ?>

          <!-- event time: -->
          <?php if ($eventTime) { ?>
            <p>
              Event time:
              <?php echo $eventTime; ?>
            </p>
          <?php } ?>

          <!-- venue: -->
          <?php if ($venueName) { ?>
            <p>
              Venue:
              <?php echo $venueName; ?>
            </p>
          <?php } ?>

          <!-- venue address: -->
          <?php if ($venueAddress) { ?>
            <p>
              Address:
              <?php echo $venueAddress; ?>
            </p>
          <?php } ?>
        </div> <!-- .event-inner -->

      </div><!-- .event-wrapper -->
    </div><!-- .event-outer -->



    <?php } // end loop over members

  } // end for each loop over chapter slugs
  ?>





<!--  -->
<!--  -->
<!--  -->
  <?php	$terms = get_terms('chapter'); // arr of term objs ?>




  <!-- LOOP 1: tab headers -->
  			<div id="tabs">
  			  <ul>
  					<?php
  					$firstCounter = 1;
  					foreach($terms as $term) { ?>
  						<?php $chapterName = $term->name; ?>
  			    	<li><a href="#tabs-<?php echo $firstCounter; ?>"><?php echo $chapterName; ?></a></li>
  						<?php $firstCounter++; ?>
  					<?php } ?>
  				</ul> <!-- end tab headings -->
  <!-- end loop 1 -->



  <!-- SECOND LOOP: tab content -->
  				<?php $secondCounter = 1; ?>
  				<?php	foreach($terms as $term) { ?>
  					<?php $chapterName = $term->name; ?>

  				  <div id="tabs-<?php echo $secondCounter; ?>">
  				    <p><?php echo $chapterName; ?></p>

  						<?php // get the Event posts w/the tax 'chapter'
  						$posts = get_posts(array(
  				      'post_type' => 'events',
  				      'tax_query' => array(
  				        array(
  				          'taxonomy' => 'chapter',
  				          'field' => 'slug',
  				          'terms' => $term->slug
  				        )
  				      ),
  				      'numberposts' => -1
  				    ));
  						?>
  						<?php // Check if there are no events in that chapter first. ?>
  						<?php if ( count($posts) == 0 ) { ?>
  							<div>There are no upcoming events for this chapter at this time.</div>
  						<?php } else { // if there are events, this is where all the info goes: ?>

  							<?php foreach($posts as $event) { ?>

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

  						    <div class="event-outer">
  						      <div class="event-wrapper">

  						        <!-- event title: -->
  						        <?php if ($eventTitle) { ?>
  						          <h3>
  						            <a href="<?php echo $eventLink; ?>"><?php echo $eventTitle; ?></a>
  						          </h3>
  						        <?php } ?>

  						        <div class="event-inner">

  						          <!-- event date: -->
  						          <?php if ($eventDate) { ?>
  						            <p>
  						              <?php echo date('F j, Y', strtotime($eventDate)); ?>
  						            </p>
  						          <?php } ?>

  						          <!-- event time: -->
  						          <?php if ($eventTime) { ?>
  						            <p>
  						              <?php echo $eventTime; ?>
  						            </p>
  						          <?php } ?>

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

  										</div> <!-- .event-inner -->
  						      </div><!-- .event-wrapper -->
  						    </div><!-- .event-outer -->

  					    <?php } // end loop over all posts in chapter ?>

  						<?php } // end else ?>
  					</div> <!-- end chapter tab div -->
  					<?php $secondCounter++; ?>
  				<?php } // end loop over chapter terms ?>
  <!-- end SECOND LOOP -->

  			</div><!-- #tabs -->

<!--  -->
<!--  -->
<!--  -->


 </section>
