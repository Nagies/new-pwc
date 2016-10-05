<?php
////////////////////////
/////// JOBS //////////
//////////////////////

// Job Type taxonomy
add_action( 'init', 'create_jobs_taxonomies', 0 );
function create_jobs_taxonomies() {
    register_taxonomy(
        'job_type',
        'jobs',
        array(
            'labels' => array(
            'name' => 'Job Types',
            'add_new_item' => 'Add New Job Type',
            'new_item_name' => "New Job Type"
        ),
        'show_ui' => true,
        'show_in_menu' => true,
        'show_tagcloud' => false,
        'hierarchical' => true
        )
    );
}

// Jobs CPT meta boxes
function job_info_meta_box() {
    add_meta_box(
        'job-info',
        'Job Information',
        'job_info_markup',
        'jobs',
        'normal'
    );
    add_meta_box(
        'company-info',
        'Company Information',
        'company_info_markup',
        'jobs',
        'normal'
    );
    add_meta_box(
        'billing-info',
        'Billing Information',
        'billing_info_markup',
        'jobs',
        'normal'
    );
}
add_action('add_meta_boxes', 'job_info_meta_box');

// Job info //
function job_info_markup() {
    wp_nonce_field(plugin_basename(__FILE__), 'job_info_nonce');
    global $post;
    ?>
    <p>Job Location:</p>
    <input type="text" name="job_location"
           value="<?php echo get_post_meta($post->ID, 'job_location', true) ?>"
           size=60
           placeholder="Example: New York, NY">

    <p>URL of Job Posting:</p>
    <input type="text" name="job_url"
           value="<?php echo get_post_meta($post->ID, 'job_url', true) ?>"
           size=60
           placeholder="Example: http://www.apple.com/jobs/123">

    <p>Job contact email:</p>
    <input type="text" name="job_contact_email"
           value="<?php echo get_post_meta($post->ID, 'job_contact_email', true) ?>"
           size=60>
    <?php
}
// save job info //
add_action('save_post', 'save_job_info');
function save_job_info() {
  global $post;
  if( isset($_POST['job_location']) ) {
    update_post_meta( $post->ID, 'job_location', $_POST['job_location'] );
  }
  if( isset($_POST['job_url']) ) {
    update_post_meta( $post->ID, 'job_url', $_POST['job_url'] );
  }
  if( isset($_POST['job_contact_email']) ) {
    update_post_meta( $post->ID, 'job_contact_email', $_POST['job_contact_email'] );
  }
}

// Company info: //
function company_info_markup() {
  global $post; ?>
  <p>Company Name:</p>
  <input type="text" name="company_name"
         value="<?php echo get_post_meta($post->ID, 'company_name', true) ?>"
         size=60
         placeholder="Example: Apple, inc.">
  <p>Company Website:</p>
  <input type="text" name="company_website"
         value="<?php echo get_post_meta($post->ID, 'company_website', true) ?>"
         size=60
         placeholder="Example: http://www.apple.com">
  <?php
}
// Save company info: //
add_action('save_post', 'save_company_info');
function save_company_info() {
  global $post;
  if( isset($_POST['company_name']) ) {
    update_post_meta( $post->ID, 'company_name', $_POST['company_name'] );
  }
  if( isset($_POST['company_website']) ) {
    update_post_meta( $post->ID, 'company_website', $_POST['company_website'] );
  }
  if( isset($_POST['company_location']) ) {
    update_post_meta( $post->ID, 'company_location', $_POST['company_location'] );
  }
}


// Billing info: //
function billing_info_markup() {
  wp_nonce_field(plugin_basename(__FILE__), 'billing_info_nonce');
  global $post;
  ?>
  <p>Billing Contact Name:</p>
  <input type="text" name="billing_name"
         value="<?php echo get_post_meta($post->ID, 'billing_name', true) ?>"
         size=60>

  <p>Billing Contact Email:</p>
  <input type="text" name="billing_email"
         value="<?php echo get_post_meta($post->ID, 'billing_email', true) ?>"
         size=60>

  <p>Billing Contact Address:</p>
  <input type="text" name="billing_address"
         value="<?php echo get_post_meta($post->ID, 'billing_address', true) ?>"
         size=60>

  <p>Billing Contact Phone:</p>
  <input type="text" name="billing_phone"
         value="<?php echo get_post_meta($post->ID, 'billing_phone', true) ?>"
         size=60>
  <?php
}
// save billing info //
add_action('save_post', 'save_billing_info');
function save_billing_info() {
  global $post;
  if( isset($_POST['billing_name']) ) {
    update_post_meta( $post->ID, 'billing_name', $_POST['billing_name'] );
  }
  if( isset($_POST['billing_email']) ) {
    update_post_meta( $post->ID, 'billing_email', $_POST['billing_email'] );
  }
  if( isset($_POST['billing_address']) ) {
    update_post_meta( $post->ID, 'billing_address', $_POST['billing_address'] );
  }
  if( isset($_POST['billing_phone']) ) {
    update_post_meta( $post->ID, 'billing_phone', $_POST['billing_phone'] );
  }
}

/* end jobs */
