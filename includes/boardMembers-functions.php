<?php

///////////////////////////////
///// Board Members //////////
/////////////////////////////

// Annual Sponsor meta box
function board_member_metabox() {
    add_meta_box(
        'board-member-info',
        'Board Member Info',
        'board_member_markup',
        'board-members',
        'normal'
    );
}
add_action('add_meta_boxes', 'board_member_metabox');

function board_member_markup() {
    global $post;
    ?>
    <!-- job title -->
    <div>
        <p>Job Title:</p>
        <input type="text" name="job_title"
               value="<?php echo get_post_meta( $post->ID, 'job_title', true ); ?>"
               placeholder="Example: Director of Space Planning"
               size=60>
    </div>

    <!-- company -->
    <div>
        <p>Company:</p>
        <input type="text" name="company"
               value="<?php echo get_post_meta( $post->ID, 'company', true ); ?>"
               placeholder="Example: Skanska"
               size=60>
    </div>
    <?php
}

add_action('save_post', 'save_board_member_info');
function save_board_member_info($post_id) {
    global $post;
    // save speaker job title
    if ( ! empty( $_POST['job_title'] ) ) {
        $job_title = sanitize_text_field( $_POST['job_title'] );
        update_post_meta( $post_id, 'job_title', $job_title );
    }
    // save company
    if ( ! empty( $_POST['company'] ) ) {
        $company = sanitize_text_field( $_POST['company'] );
        update_post_meta( $post_id, 'company', $company );
    }

}

