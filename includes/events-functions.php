<?php
///////////////////
///// Events /////
/////////////////


// change default length of event description 'excerpt'
function custom_excerpt_length( $length ) {
	return 5;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );



// Add query var 'past' to Events CPT
function events_add_query_var() {
	global $wp;
	$wp->add_query_var( 'past' );
}
add_filter( 'init', 'events_add_query_var' );

// Change URL when viewing 'past' events
function events_rewrite_rules() {
	add_rewrite_rule( 'events/past$', 'index.php?post_type=events&past=true', 'top' );
}
add_action( 'init', 'events_rewrite_rules' );

// *** NOT USING?
// Register custom post status 'past events' ==> exists but isn't showing in admin ui?
function my_custom_post_status() {
	register_post_status( 'unread', array(
		'label'                     => _x( 'Unread', 'post' ),
		'public'                    => true,
		'exclude_from_search'       => false,
		'show_in_admin_all_list'    => true,
		'show_in_admin_status_list' => true,
		'label_count'               => _n_noop( 'Unread <span class="count">(%s)</span>', 'Unread <span class="count">(%s)</span>' ),
	) );
}

add_action( 'init', 'my_custom_post_status' );

// meta boxes for 'events' cpt:
function event_info_metabox() {
	add_meta_box(
		'event_info',
		'Event Info',
		'event_info_markup',
		'events',
		'normal'
	);

	add_meta_box(
		'event_speakers',
		'Event Speakers',
		'events_speakers_markup',
		'events',
		'normal'
	);
	add_meta_box(
		'event_sponsors',
		'Event Sponsors',
		'events_sponsors_markup',
		'events',
		'normal'
	);
}
add_action( 'add_meta_boxes', 'event_info_metabox' );

// AE: custom script - repeatable fields
add_action( 'admin_head', 'add_custom_scripts' );
function add_custom_scripts() {
	$screen = get_current_screen();
	if ( 'events' === $screen->post_type ) {
		$output = '<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
				<script type="text/javascript">
          jQuery(function() {
          	jQuery(".datepicker").datepicker();
          	jQuery(".repeatable-add").click(function() {
          		field = jQuery(this).closest("td").find(".custom_repeatable li:last").clone(true);
          		fieldLocation = jQuery(this).closest("td").find(".custom_repeatable li:last");
          		jQuery("select", field).val("").attr("name", function(index, name) {
          			return name.replace(/(\d+)/, function(fullMatch, n) {
          				return Number(n) + 1;
          			});
          		});
          		field.insertAfter(fieldLocation, jQuery(this).closest("td"));
          		return false;
          	});
          	jQuery(".repeatable-remove").click(function(){
          		jQuery(this).parent().remove();
          		return false;
          		});
          	jQuery(".custom_repeatable").sortable({
          		opacity: 0.6,
          		revert: true,
          		cursor: "move",
          		handle: ".sort"
          		});
          });
        </script>';
		echo $output;
	}
}

/* markup for event info metabox */
function event_info_markup() {
	global $post;

	if ( is_admin() ) {
		wp_enqueue_script( 'jquery-ui-datepicker' );
	}

	$prefix = 'event_';

	$custom_meta_fields = array(
		array(
			'label' => 'Date',
			'desc'  => 'Date of event',
			'id'    => $prefix . 'date',
			'type'  => 'date'
		),
		array(
			'label' => 'Event Time:',
			'desc'  => 'Example: 6:30 - 9:00pm',
			'id'    => $prefix . 'time',
			'type'  => 'text'
		),
		array(
			'label' => 'Venue Name:',
			'desc'  => 'Example: The Yale Club Ballroom',
			'id'    => $prefix . 'venue_name',
			'type'  => 'text'
		),
		array(
			'label' => 'Venue Address:',
			'desc'  => 'Example: 50 Vanderbilt Ave, New York, NY 10017',
			'id'    => $prefix . 'venue_address',
			'type'  => 'text'
		),
		array(
			'label' => 'Event Registration URL:',
			'desc'  => 'Example: https://pwcusa.givezooks.com/events/university-construction-breakfast-panel',
			'id'    => $prefix . 'register_url',
			'type'  => 'text'
		),
		array(
			'label' => 'URL of Event Photos:',
			'desc'  => 'Example: www.flickr.com/pwc/photos/christmas-party',
			'id'    => $prefix . 'photos_url',
			'type'  => 'text'
		),
	);

	echo '<table class="form-table">';

	foreach ( $custom_meta_fields as $field ) {
		// get value of this field if it exists for this post
		$meta = get_post_meta( $post->ID, $field['id'], true );

		// begin a table row with
		echo '<tr>
            <th><label for="' . $field['id'] . '">' . $field['label'] . '</label></th>
            <td>';
		switch ( $field['type'] ) {
			// case items will go here
			case 'date':
				if ( ! empty( $meta ) ) {
					$meta = date( 'm/d/Y', strtotime( $meta ) );
				}
				echo '<input type="text" class="datepicker" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" size="30" />
			<br /><span class="description">' . $field['desc'] . '</span>';
				break;
			case 'text':
				echo '<input type="text" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" size="30" />
        <br /><span class="description">' . $field['desc'] . '</span>';
				break;

		} //end switch
		echo '</td></tr>';
	} // end foreach

	echo '</table>';
}

/**
 * Event Speakers
 */
function events_speakers_markup() {
	global $post;

	if ( is_admin() ) {
		wp_enqueue_script( 'jquery-ui-datepicker' );
	}

	$prefix = 'event_';

	$custom_meta_fields = array(
		array(
			'label' => 'Speakers',
			'desc'  => '',
			'id'    => $prefix . 'speakers',
			'type'  => 'repeatable'
		),
	);

	echo '<table class="form-table">';

	foreach ( $custom_meta_fields as $field ) {
		// get value of this field if it exists for this post
		$meta = get_post_meta( $post->ID, $field['id'], true );

		// begin a table row with
		echo '<tr>
      <th><label for="' . $field['id'] . '">' . $field['label'] . '</label></th>
      <td>';
		switch ( $field['type'] ) {
			// case items will go here
			case 'repeatable':
				echo '<a class="repeatable-add button" href="#">+</a>
            <ul id="' . $field['id'] . '-repeatable" class="custom_repeatable">';
				$i     = 0;
				$items = get_posts( array(
					'post_type'      => 'event-speakers',
					'posts_per_page' => - 1
				) );

				$speaker_roles = array(
					'1' => 'Honoree',
					'2' => 'Panelist',
					'3' => 'Moderator',
				);

				if ( $meta ) {
					foreach ( $meta as $row ) {
						echo '<li><span class="sort hndle">||</span>';
						echo '<select name="' . $field['id'] . '[' . $i . '][' . 'speaker_id' . ']" id="' . $field['id'] . '">
 <option value="">Select One</option>'; // Select One
						foreach ( $items as $item ) {
							echo '<option value="' . $item->ID . '"', $row['speaker_id'] == $item->ID ? ' selected="selected"' : '', '>' . $item->post_title . '</option>';
						} // end foreach
						echo '</select>';
						echo '<select name="' . $field['id'] . '[' . $i . '][' . 'roles' . ']" id="' . $field['id'] . '">
 <option value="">Select Role</option>'; // Select One
						foreach ( $speaker_roles as $id => $role ) {
							echo '<option value="' . $id . '"', $row['roles'] == $id ? ' selected="selected"' : '', '>' . $role . '</option>';
						} // end foreach
						echo '</select>';
						echo '<a class="repeatable-remove button" href="#">-</a></li>';
						$i ++;
					}
				} else {
					echo '<li><span class="sort hndle">||</span>';
					echo '<select name="' . $field['id'] . '[' . $i . '][' . 'speaker_id' . ']" id="' . $field['id'] . '">
 <option value="">Select One</option>'; // Select One
					foreach ( $items as $item ) {
						echo '<option value="' . $item->ID . '">' . $item->post_title . '</option>';
					} // end foreach
					echo '</select>';

					echo '<select name="' . $field['id'] . '[' . $i . '][' . 'roles' . ']" id="' . $field['id'] . '">
 <option value="">Select Role</option>'; // Select One
					foreach ( $speaker_roles as $id => $role ) {
						echo '<option value="' . $id . '">' . $role . '</option>';
					} // end foreach
					echo '</select>';

					echo '<a class="repeatable-remove button" href="#">-</a></li>';
				}
				echo '</ul>
        <span class="description">' . $field['desc'] . '</span>';
				break;

		} //end switch
		echo '</td></tr>';
	} // end foreach

	echo '</table>';
}

/**
 * Event Sponsors
 */
function events_sponsors_markup() {
	global $post;

	if ( is_admin() ) {
		wp_enqueue_script( 'jquery-ui-datepicker' );
	}

	$prefix = 'event_';

	$custom_meta_fields = array(
		array(
			'label' => 'Sponsors',
			'desc'  => '',
			'id'    => $prefix . 'sponsors',
			'type'  => 'repeatable'
		),
	);

	echo '<table class="form-table">';

	foreach ( $custom_meta_fields as $field ) {
		// get value of this field if it exists for this post
		$meta = get_post_meta( $post->ID, $field['id'], true );

		// begin a table row with
		echo '<tr>
                <th><label for="' . $field['id'] . '">' . $field['label'] . '</label></th>
                <td>';
		switch ( $field['type'] ) {
			// case items will go here
			case 'repeatable':
				echo '<a class="repeatable-add button" href="#">+</a>
            <ul id="' . $field['id'] . '-repeatable" class="custom_repeatable">';
				$i     = 0;
				$items = get_posts( array(
					'post_type'      => 'event-sponsors',
					'posts_per_page' => - 1
				) );

				if ( $meta ) {
					foreach ( $meta as $row ) {
						echo '<li><span class="sort hndle">||</span>';
						echo '<select name="' . $field['id'] . '[' . $i . ']" id="' . $field['id'] . '">
								<option value="">Select One</option>';
						foreach ( $items as $item ) {
							echo '<option value="' . $item->ID . '"', $row == $item->ID ? ' selected="selected"' : '', '>' . $item->post_title . '</option>';
						} // end foreach
						echo '</select>';
						echo '<a class="repeatable-remove button" href="#">-</a></li>';
						$i ++;
					}
				} else {
					echo '<li><span class="sort hndle">||</span>';
					echo '<select name="' . $field['id'] . '[' . $i . ']" id="' . $field['id'] . '">
 <option value="">Select One</option>'; // Select One
					foreach ( $items as $item ) {
						echo '<option value="' . $item->ID . '">' . $item->post_title . '</option>';
					} // end foreach
					echo '</select>';
					echo '<a class="repeatable-remove button" href="#">-</a></li>';
				}
				echo '</ul>
        <span class="description">' . $field['desc'] . '</span>';
				break;

		} //end switch
		echo '</td></tr>';
	} // end foreach

	echo '</table>';
}

/* Save event info */
add_action( 'save_post', 'save_event_info' );
function save_event_info( $post_id ) {
	$prefix = 'event_';

	$custom_meta_fields = array(
		array(
			'label' => 'Date',
			'desc'  => '03/14/2018',
			'id'    => $prefix . 'date',
			'type'  => 'date'
		),
		array(
			'label' => 'Event Time:',
			'desc'  => 'Example: 6:30 - 9:00pm',
			'id'    => $prefix . 'time',
			'type'  => 'text'
		),
		array(
			'label' => 'Venue Name:',
			'desc'  => 'Example: The Yale Club Ballroom',
			'id'    => $prefix . 'venue_name',
			'type'  => 'text'
		),
		array(
			'label' => 'Venue Address:',
			'desc'  => 'Example: 50 Vanderbilt Ave, New York, NY 10017',
			'id'    => $prefix . 'venue_address',
			'type'  => 'text'
		),
		array(
			'label' => 'Event Registration URL:',
			'desc'  => 'Example: https://pwcusa.givezooks.com/events/university-construction-breakfast-panel',
			'id'    => $prefix . 'register_url',
			'type'  => 'text'
		),
		array(
			'label' => 'URL of Event Photos:',
			'desc'  => 'Example: www.flickr.com/pwc/photos/christmas-party',
			'id'    => $prefix . 'photos_url',
			'type'  => 'text'
		),
		array(
			'label' => 'Speakers',
			'desc'  => '',
			'id'    => $prefix . 'speakers',
			'type'  => 'repeatable'
		),
		array(
			'label' => 'Sponsors',
			'desc'  => '',
			'id'    => $prefix . 'sponsors',
			'type'  => 'repeatable'
		),
	);

	// loop through fields and save the data
	foreach ( $custom_meta_fields as $field ) {

		$old = get_post_meta( $post_id, $field['id'], true );
		$new = $_POST[ $field['id'] ];


		if ( $new && $new != $old ) {
			if ( $field['type'] === 'date' ) {
				$new = date( 'Ymd', strtotime( $new ) );
			}
			update_post_meta( $post_id, $field['id'], $new );
		} elseif ( '' == $new && $old ) {
			delete_post_meta( $post_id, $field['id'], $old );
		}
	}

} // end save event info
