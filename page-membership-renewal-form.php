<?php
/*
	Template Name: Membership Renewal Form
*/

// Pulling content from old template: http://pwcusa.org/membership-renewal.php
?>


<?php global $post; ?>

<?php

// insert as new membership application post:
$post_information = array(
	'post_title' 		=> 	wp_strip_all_tags( $_POST['member_name'] ),
	'post_type' 		=> 	'member-apps',
	'post_status' 	=> 	'pending'
);

// insert post & get back the ID of the new post:
$new_post_id = wp_insert_post( $post_information, $wp_error );

// use the new post id to insert post meta:
if ( $new_post_id ) {

	// save as 'new' membership application type
	$term_tax_ids_memb_type = wp_set_object_terms( $new_post_id, 'renewal', 'membership_app_type' );

	// save chapter as tax
	$chosen_chapter = $_POST['chapter_preference'];
	$term_tax_ids_chapter = wp_set_object_terms( $new_post_id, $chosen_chapter, 'chapter' );

	// save post meta
	$post_meta_array = [
		'company_name',
		'home_address',
		'home_phone',
		'home_email',
		'reps',
		'member_type'	// radio
	];

	for ( $i=0; $i < count($post_meta_array); $i++ ) {
		// check if not empty && isset, then update post meta
		if( !empty( $_POST[$post_meta_array[$i]] ) ) {      // if not empty
			if ( isset( $_POST[$post_meta_array[$i]] ) ) {    // if set
				update_post_meta( $new_post_id, $post_meta_array[$i], esc_attr(strip_tags($_POST[$post_meta_array[$i]])) );
			}
		}
	}

	// redirect to success page:
	// $redirectPage = get_site_url() . "/submission-success/";
	// wp_redirect( $redirectPage );
	// exit;



}


?>


<?php get_header(); ?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div id="jobs-page">
			<div id="section-1-show">
				
			</div>

			<div id="section-2-show">
			

    <form id="member-renewal-submission-form" class="" method="post">

    	<h1 class="center">Renew Membership</h1>

			<!-- member name | post title -->
			<label for="member_name">Name:*</label>
			<input type="text" name="member_name" id="member_name"
						 value="" size=60><br>

			<!-- company name | meta -->
			<label for="company_name">Company:</label>
			<input type="text" name="company_name" id="company_name"
						 size=60 value=""><br>

		  <!-- home address | meta -->
			<label for="home_address">Home Address:</label>
			<input type="text" name="home_address" id="home_address"
						 value="" size=60><br>

			<!-- home phone | meta -->
			<label for="home_phone">Home phone number:</label>
			<input type="text" name="home_phone" id="home_phone"
						 value="" size=60><br>

		  <!-- home email | meta -->
			<label for="home_email">Home email:</label>
			<input type="text" name="home_email" id="home_email"
						 value="" size=60><br>

			<!-- chapter_preference | taxonomy 'chapter' -->
			<b><label for="chapter_preference">Chapter Preference*:</label></b>
			<span>You may vote and/or hold elected office only in the Chapter to which you belong. You may attend events of any Chapter at member discount rate.</span>
			
			<div style="overflow: hidden; margin: 10px 0;">
				<div class="radio-wrapper">
					<input type="radio" name="chapter_preference" value="new-york"> New York
				</div>
				<div class="radio-wrapper">
					<input type="radio" name="chapter_preference" value="new-jersey"> New Jersey
				</div>
				<div class="radio-wrapper">
					<input type="radio" name="chapter_preference" value="connecticut"> Connecticut
				</div>
				<div class="radio-wrapper">
					<input type="radio" name="chapter_preference" value
				="washington-dc"> Washington, D.C.
				</div>
			</div>

			<!-- membership category | meta -->
			<div>
				<label for="member_type"><b>Membership Category:</b></label>
				<span>Final approval of membership is at the discretion of the PWC Board of Directors.</span><br>

				<div style="margin-top: 10px; overflow: hidden;">

				<div class="radio-wrapper no-margin-r vert-margin">
					<input type="radio" value="corp-a" name="member_type">
						<b>Corporate A</b>: gross income: $5M+ / entitled to 6 representatives / annual dues: $750<br>
				</div>

				<div class="radio-wrapper no-margin-r vert-margin">
					<input type="radio" value="corp-b" name="member_type">
						<b>Corporate B</b>: gross income: under $5M / entitled to 4 representatives / annual dues: $450<br>
				</div>

				<div class="radio-wrapper no-margin-r vert-margin">
					<input type="radio" value="business" name="member_type">
						<b>Business</b>: sole prop./consultant  with 3 or fewer employees / entitled to 2 reps / annual dues: $275<br>
				</div>

				<div class="radio-wrapper no-margin-r vert-margin">
					<input type="radio" value="individual" name="member_type">
						<b>Individual</b>: employee / entitled to self-representation (does not extend to employer) / annual dues: $225<br>
				</div>

				<div class="radio-wrapper no-margin-r vert-margin">
					<input type="radio" value="student" name="member_type">
						<b>Student</b>: matriculating at accredited institution; non-voting category / annual dues: $65
				</div>
			</div>

			<div>
				<p>Corporate or Business members, please indicate below if any change of your designated representatives:</p>
				<textarea name="reps" rows="4" cols="20"></textarea>
			</div>

			<!-- submit btn -->
			<input type="hidden" name="submitted" id="submitted" value="true" />
			<button type="submit" class="submit">Submit</button>



    </form>
    </div>
	</div>
  </main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
