<?php
/**
 *  Events - Event Speakers
 */

// Event Speakers meta boxes
function event_speakers_meta_box() {
	add_meta_box(
		'event-speakers',
		'Event Speakers',
		'event_speakers_markup',
		'event-speakers', // add to events CPT
		'normal'
	);
}

add_action( 'add_meta_boxes', 'event_speakers_meta_box' );

function event_speakers_markup() {
	global $post;
	$prefix = 'speaker_';

	$custom_meta_fields = array(
		array(
			'label' => 'Job Title:',
			'desc'  => 'Example: Director of Space Planning',
			'id'    => $prefix . 'job_title',
			'type'  => 'text'
		),
		array(
			'label' => 'Company:',
			'desc'  => 'Example: Skanska',
			'id'    => $prefix . 'company',
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
			case 'text':
				echo '<input type="text" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" size="30" />
        <br /><span class="description">' . $field['desc'] . '</span>';
				break;

		} //end switch
		echo '</td></tr>';
	} // end foreach

	echo '</table>';
}

/* Save speakers as `Event Speakers` CPT */
add_action( 'save_post', 'save_speakers' );

// Save the Data
function save_speakers( $post_id ) {

	$custom_meta_fields = array(
		'speaker_job_title',
		'speaker_company',
	);

	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	// check permissions
	if ( 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		}
	} elseif ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}

	// loop through fields and save the data
	foreach ( $custom_meta_fields as $field ) {
		$old = get_post_meta( $post_id, $field, true );
		$new = $_POST[ $field ];
		if ( $new && $new != $old ) {
			update_post_meta( $post_id, $field, $new );
		} elseif ( '' == $new && $old ) {
			delete_post_meta( $post_id, $field, $old );
		}
	} // end foreach
}




