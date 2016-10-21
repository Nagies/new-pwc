<?php
/*
	Template Name: Jobs Form Page
*/

global $post;
$postTitleError = '';

// Upon submit & proper validation
if ( isset( $_POST['submitted'] ) && isset( $_POST['post_nonce_field'] ) && wp_verify_nonce( $_POST['post_nonce_field'], 'post_nonce' ) ) {
	// if job title empty
	if ( trim( $_POST['job_title'] ) === '' ) {
		$postTitleError = 'Please enter a title.';
		$hasError = true;
	}
}

if ( $postTitleError !== '' ) { ?>
	<span class="error"><?php echo $postTitleError; ?></span>
	<div class="clearfix"></div>
<?php }

// insert as new Job post:
$post_information = array(
	'post_title' 		=> 	wp_strip_all_tags( $_POST['job_title'] ),
	'post_content' 	=> 	$_POST['job_description'],
	'post_type' 		=> 	'jobs',
	'post_status' 	=> 	'pending'
);

// insert post & get back the ID of the new post:
$new_post_id = wp_insert_post( $post_information, $wp_error );

// use the new post id to insert post meta:
if ( $new_post_id ) {
	// Update Custom Meta
	update_post_meta($new_post_id, 'company_name', esc_attr(strip_tags($_POST['company_name'])));
	update_post_meta($new_post_id, 'job_location', esc_attr(strip_tags($_POST['job_location'])));
	update_post_meta($new_post_id, 'company_website', esc_attr(strip_tags($_POST['company_website'])));
	update_post_meta($new_post_id, 'job_url', esc_attr(strip_tags($_POST['job_url'])));
	update_post_meta($new_post_id, 'job_contact_email', esc_attr(strip_tags($_POST['job_contact_email'])));
	update_post_meta($new_post_id, 'billing_name', esc_attr(strip_tags($_POST['billing_name'])));
	update_post_meta($new_post_id, 'billing_email', esc_attr(strip_tags($_POST['billing_email'])));
	update_post_meta($new_post_id, 'billing_address', esc_attr(strip_tags($_POST['billing_address'])));
	update_post_meta($new_post_id, 'billing_phone', esc_attr(strip_tags($_POST['billing_phone'])));

	// save selected categories
	if (isset($_POST['job_category'])) {
		$cat_slugs = $_POST['job_category'];
		$term_taxonomy_ids = wp_set_object_terms( $new_post_id, $cat_slugs, 'job_type' );
	}

	// redirect to success page:
	$redirectPage = get_site_url() . "/submission-success/";
	wp_redirect( $redirectPage );
	exit;

}

if ( $wp_error ) {
	var_dump($post);
}
?>

<?php get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div id="jobs-page">
			<section id="section-1-show">

			</section>

			<section id="section-2-show">

      <!-- query content on page: -->
			<?php
				$args = array(
					'post_type' 	=> 	'page',
					'name'				=>	'submit-job'
				);

				$page_objs = get_posts( $args );
				// gives you back an array; loop through to get content (should only be one)
				foreach ($page_objs as $obj ) {
					$page_content = $obj->post_content; ?>

					<?php if ($page_content) { ?>
						<div>
							<p>
								<?php echo $page_content ?>
							</p>
						</div>
					<?php } ?>
				<?php } ?>


	<?php
	// start loop to get content on jobs form page --> not working
	while ( have_posts() ) : the_post();
		get_template_part( 'content', 'page' );
		get_template_part( 'template-parts/content', 'page' );
	endwhile;
	?>

	<section id="job-forms">
	  <form id="job-submission-form" class="" method="post">
			<h3>Job Information</h3>
			<p>
				Fill out the form below and a member of PWC will contact you for payment details. After payment is received, jobs will be posted on the website for 6 months.
			</p>

			<div class="form-fields">
				
				<!-- *job title | post title -->
				<label for="job_title">Job Title*</label>
				<input type="text" name="job_title" id="job_title" class="required"
				value="<?php echo get_post_meta($post->ID, 'job_title', true) ?>"
				size=60>

				<!-- company name | meta -->
				<label for="company_name">Company Name*</label>
				<input type="text" name="company_name" id="company_name" class="required"
							 size=60 value="<?php echo $_POST['company_name']; ?>">

				<!-- job location | meta -->
				<label for="job_location">Location*</label>
				<input type="text" name="job_location" id="job_location" class="required"
							 value="<?php echo $_POST['job_location']; ?>" size=60>

			  <!-- company website | meta -->
				<label for="company_website">Company Website</label>
				<input type="text" name="company_website" id="company_website"
							 value="<?php echo $_POST['company_website']; ?>" size=60>

				<!-- job url | meta -->
				<label for="job_url">URL of Job Posting</label>
				<input type="text" name="job_url" id="job_url"
							 value="<?php echo $_POST['job_url']; ?>" size=60>

				<!-- contact email | meta -->
				<label for="job_contact_email">Job Contact Email</label>
				<input type="text" name="job_contact_email" id="job_contact_email"
							 value="<?php echo $_POST['job_contact_email']; ?>" size=60>


			  <!-- job tax | meta?? -->
				<label>Job Type</label>
				<?php

				$taxonomies = array(
					'job_type'
				);
				$args = array(
					'hide_empty' => false
				);
				$terms = get_terms($taxonomies, $args);
				if ( ! is_wp_error( $terms ) ) {
					foreach ($terms as $term) {
						//var_dump($term);
						?>
						<div class="checkbox-wrapper">
							<label for="<?php echo $term->slug ?>"><?php echo $term->name ?> <?php // echo $term->term_id ?></label>
							<input type="checkbox" name="job_category[]" id="<?php echo $term->slug ?>" value="<?php echo $term->slug ?>">
						</div>


						<?php
					}
				}
		 		?>

		 		<div style="clear: both;"></div>

		 		<div style="padding-top: 5px;">

				<!-- *job description | post content -->
				<label for="job_description">Job Description:*</label>
				<textarea name="job_description" id="job_description">
					<?php
					if (isset( $_POST['job_description'])) {
						if (function_exists('stripslashes')) {
							// echo stripslashes( $_POST['job_description'] );
							echo wp_strip_all_tags( $_POST['job_description'], true );
						} else {
							echo $_POST['job_description'];
						}
					} ?>
				</textarea>

				</div>


				<h3>Billing Information:</h3>

				<!-- billing name | meta -->
				<label for="billing_name">Billing Contact Name:*</label>
				<input type="text" name="billing_name" id="billing_name" class="required"
							 value="<?php	echo $_POST['billing_name']; ?>" size=60><br>

				<!-- billing email | meta -->
				<label for="billing_email">Email address of billing contact:*</label>
				<input type="text" name="billing_email" id="billing_email" class="required"
							 value="<?php	echo $_POST['billing_email']; ?>" size=60><br>

				<!-- billing address | meta -->
				<label for="billing_address">Billing Contact Address:</label>
				<input type="text" name="billing_address" id="billing_address"
							 value="<?php	echo $_POST['billing_address']; ?>" size=60><br>

				<!-- billing phone | meta -->
				<label for="billing_phone">Billing Contact Phone:</label>
				<input type="text" name="billing_phone" id="billing_phone"
							 value="<?php	echo $_POST['billing_phone']; ?>" size=60><br>

				<!-- submit btn -->
				<input type="hidden" name="submitted" id="submitted" value="true" />
				<button type="submit", class="submit">Submit</button>
		</div>
	</form>
	</section>
	 </section>

	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
