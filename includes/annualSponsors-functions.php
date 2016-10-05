<?php

///////////////////////////////
///// Annual Sponsors ////////
/////////////////////////////

// Annual Sponsor meta box
function annual_sponsor_metabox() {
    add_meta_box(
        'annual-sponsor-info',
        'Annual Sponsor Info',
        'annual_sponsor_markup',
        'annual-sponsors',
        'normal'
    );
}
add_action('add_meta_boxes', 'annual_sponsor_metabox');

function annual_sponsor_markup() {
    global $post; ?>

    <p>Company website:</p>
    <input type="text" name="sponsor_website"
           value="<?php echo get_post_meta($post->ID, 'sponsor_website', true) ?>"
           size=60
           placeholder="Example: www.armandcorp.com">

    <br><br>
    <?php
}

function save_annual_sponsor_info( $post_id ){
    global $post;

    // save website
    $sponsor_website = sanitize_text_field( $_POST['sponsor_website'] );
    update_post_meta( $post_id, 'sponsor_website', $sponsor_website );
}
add_action('save_post', 'save_annual_sponsor_info');
