<?php
/**
 *  Events - Event Sponsors
 */

// Event Sponsors meta boxes
function event_sponsors_meta_box() {
	add_meta_box(
		'event-sponsors',
		'Event Sponsors',
		'event_sponsors_markup',
		'event-sponsors', // add to events CPT
		'normal'
	);
}

add_action( 'add_meta_boxes', 'event_sponsors_meta_box' );

function event_sponsors_markup() {
	global $post;

	$prefix = 'sponsor_';

	$custom_meta_fields = array(
		array(
			'label' => 'Company Url:',
			'desc'  => 'http://example.com',
			'id'    => $prefix . 'company_url',
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

/* Save sponsors as `Event sponsors` CPT */
add_action( 'save_post', 'save_sponsors' );

// Save the Data
function save_sponsors( $post_id ) {

	$prefix = 'sponsor_';

	$custom_meta_fields = array(
		array(
			'label' => 'Company Url:',
			'desc'  => 'http://example.com',
			'id'    => $prefix . 'company_url',
			'type'  => 'text'
		),
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
	foreach ($custom_meta_fields as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	} // end foreach
}




