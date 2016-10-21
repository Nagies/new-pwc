<?php
/*
	Template Name: New Membership Form
*/


?>

<?php

// Pulling content from old template: http://pwcusa.org/membership.php
// page-new-membership-app.php
?>

<?php

global $post;
$postTitleError = '';

// Upon submit & proper validation
if ( isset( $_POST['submitted'] ) && isset( $_POST['post_nonce_field'] ) && wp_verify_nonce( $_POST['post_nonce_field'], 'post_nonce' ) ) {
	// if job title empty
	if ( trim( $_POST['member_name'] ) === '' ) {
		$postTitleError = 'Please enter a title.';
		$hasError = true;
	}
}

if ( $postTitleError !== '' ) { ?>
	<span class="error"><?php echo $postTitleError; ?></span>
	<div class="clearfix"></div>
<?php }

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
	// var_dump($new_post_id);
	// $newPostObj = get_post( $new_post_id );
	// var_dump($newPostObj);


	// save post meta
	$post_meta_array = [
		'prof_title',
		'company_name',
		'company_title',
		'preferred_mailing', // radio
		'biz_address',
		'biz_website',
		'biz_phone',
		'biz_fax',
		'biz_email',
		'biz_type_specialty',
		'biz_percentage',
		'biz_owner', // select
		'employee_status', // select
		'annual_gross', // select
		'home_address',
		'home_cell',
		'home_phone',
		'home_fax',
		'home_email',
		'member_type',	// radio
		'reps',
		'student_app_school',
		'student_app_concentration',
		'other_associations',
		'business_owned', // select
		'agency_cert',
		'gov_agency' // checkbox
	];

	for ( $i=0; $i < count($post_meta_array); $i++ ) {
		// check if not empty && isset, then update post meta
		if( !empty( $_POST[$post_meta_array[$i]] ) ) {      // if not empty
			if ( isset( $_POST[$post_meta_array[$i]] ) ) {    // if set
				if ( $post_meta_array[$i] == 'gov_agency') {    // if 'gov_agency' (checkbox)
					update_post_meta( $new_post_id, 'gov_agency', $_POST['gov_agency'] );
				} else {                                        // everything else
					update_post_meta( $new_post_id, $post_meta_array[$i], esc_attr(strip_tags($_POST[$post_meta_array[$i]])) );
				}
			}
		}
	}


	// save as 'new' membership application type
	$term_tax_ids_memb_type = wp_set_object_terms( $new_post_id, 'new', 'membership_app_type' );

	// save chapter as tax
	if (isset($_POST['chapter_preference'])) {
		$chosen_chapter = $_POST['chapter_preference'];
		$term_tax_ids_chapter = wp_set_object_terms( $new_post_id, $chosen_chapter, 'chapter' );
	}



	// redirect to success page:
	// $redirectPage = get_site_url() . "/submission-success/";
	// wp_redirect( $redirectPage );
	// exit;



} // end insert post meta


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
		'name'				=>	'new-membership-application'
	);

	$page_objs = get_posts( $args );
	// gives you back an array; loop through to get content (should only be one)
	foreach ($page_objs as $obj ) {
		$page_content = $obj->post_content; ?>

		<?php if ($page_content) { ?>
				<h3 class="page-content-header">
					<?php echo $page_content ?>
				</h3>
		<?php } ?>
	<?php } ?>
<!-- end query page content -->

  <form id="new-member-submission-form" class="" method="post">

  	<h1 class="center">New Membership</h1>


		<!-- member name | post title -->
		<label for="member_name">Name:</label>
		<input type="text" name="member_name" id="member_name"
					 value="" size=60><br>

		<!-- professional license/title | meta -->
		<label for="prof_title">Professional license or title:</label>
		<input type="text" name="prof_title" id="prof_title"
					 size=60 value=""><br>

		<!-- company name | meta -->
		<label for="company_name">Company Name:</label>
		<input type="text" name="company_name" id="company_name"
					 size=60 value=""><br>

		<!-- company title | meta -->
		<label for="company_title">Company Job Title:</label>
		<input type="text" name="company_title" id="company_title"
					 size=60 value=""><br>

		<!-- preferred mailing address | meta | radio -->
			<label for="preferred_mailing">Please indicate preferred mailing address:</label>
			<div style="overflow: hidden;">
				<div class="radio-wrapper">
					<label for="business">Business</label>
					<input type="radio" name="preferred_mailing" value="business">
				</div>
				<div class="radio-wrapper">
					<label for="home">Home</label>
					<input type="radio" name="preferred_mailing" value="home">
				</div> 
			</div>

		<p><b>Business Information:</b></p>

		<!-- biz address | meta -->
		<label for="biz_address">Business Address:</label>
		<input type="text" name="biz_address" id="biz_address"
					 value="" size=60>

		<!-- biz website | meta -->
		<label for="biz_website">Business website:</label>
		<input type="text" name="biz_website" id="biz_website"
					 value="" size=60>

		<!-- biz phone | meta -->
		<label for="biz_phone">Business phone number:</label>
		<input type="text" name="biz_phone" id="biz_phone"
					 value="" size=60>

		<!-- biz fax | meta -->
		<label for="biz_fax">Business fax number:</label>
		<input type="text" name="biz_fax" id="biz_fax"
					 value="" size=60>

		<!-- biz email | meta -->
		<label for="biz_email">Business email:</label>
		<input type="text" name="biz_email" id="biz_email"
					 value="" size=60>

		<!-- Biz type/specialty | meta -->
		<label for="biz_type_specialty">Business type and specialty:</label>
		<span>i.e., GC, CM, Sub. Prof. Service, Consulting, Supplier, Manufacturer. Please be specific regarding product(s).</span>
		<textarea name="biz_type_specialty" id="biz_type_specialty"></textarea>

		<!-- Biz owner | meta -->
		<label for="biz_owner">Are you an owner of the company?:</label>
		<select name="biz_owner">
			<option value=""></option>
			<option value="yes">Yes</option>
			<option value="no">No</option>
		</select>

		<!-- biz owner percentage | meta -->
		<label for="biz_percentage">Percentage owned by you:</label>
		<input type="text" name="biz_percentage" id="biz_percentage"
					 value="" size=5>


		<!-- employee status | meta -->
		<label for="employee_status">Your status with the company:</label>
		<select name="employee_status">
			<option value="" selected></option>
			<option value="owner">Owner</option>
			<option value="partner">Partner</option>
			<option value="employee">Employee</option>
		</select>

		<!-- Annual sales | meta -->
		<label for="annual_gross">Annual gross sales:</label>
		<select name="annual_gross">
			<option value="">Select</option>
			<option value="under-500">Under $500K</option>
			<option value="500k-2m">$500K&nbsp;to&nbsp;$2M</option>
			<option value="2m-5m">$2M&nbsp;to&nbsp;$5M</option>
			<option value="5m-10m">$5M&nbsp;to&nbsp;$10M</option>
			<option value="10m-25m">$10M&nbsp;to&nbsp;$25M</option>
			<option value="25m-plus">$25M+</option>
		</select>


		<p><b>Home Information:</b></p>

		<!-- home address | meta -->
		<label for="home_address">Home Address:</label>
		<input type="text" name="home_address" id="home_address"
					 value="" size=60><br>

		<!-- home cell phone | meta -->
		<label for="home_cell">Home cell phone:</label>
		<input type="text" name="home_cell" id="home_cell"
					 value="" size=60><br>

		<!-- home phone | meta -->
		<label for="home_phone">Home phone number:</label>
		<input type="text" name="home_phone" id="home_phone"
					 value="" size=60><br>

		<!-- home fax | meta -->
		<label for="home_fax">Home fax number:</label>
		<input type="text" name="home_fax" id="home_fax"
					 value="" size=60><br>

		<!-- home email | meta -->
		<label for="home_email">Home email:</label>
		<input type="text" name="home_email" id="home_email"
					 value="" size=60><br>

		<!-- chapter_preference | taxonomy 'chapter' -->
		<b><label for="chapter_preference">Chapter Preference:</label></b>
		<span>You may vote and/or hold elected office only in the Chapter to which you belong. You may attend events of any Chapter at member discount rate.</span><br>
		<div style="overflow: hidden;">
			<div class="radio-wrapper">
				<label for="new-york">New York</label>
				<input type="radio" name="chapter_preference" value="new-york">
			</div>
			<div class="radio-wrapper">
				<label for="new-jersey">New Jersey</label>
				<input type="radio" name="chapter_preference" value="new-jersey">
			</div>
			<div class="radio-wrapper">
				<label for="connecticut">Connecticut</label>
				<input type="radio" name="chapter_preference" value="connecticut">
			</div>
			<div class="radio-wrapper">
				<label for="washington-dc">Washington, D.C.</label>
				<input type="radio" name="chapter_preference" value="washington-dc">
			</div>
		</div>

		<!-- membership category | meta -->
    <div>
      <label for="member_type"><b>Membership Category:</b></label>
      <span>Final approval of membership is at the discretion of the PWC Board of Directors.</span><br>
			
			<label for="member_type"><b>Corporate A</b>: gross income: $5M+ / entitled to 6 representatives / annual dues: $750</label>
      <input type="radio" value="corp-a" name="member_type">

      <label for="member_type"><b>Corporate B</b>: gross income: under $5M / entitled to 4 representatives / annual dues: $450</label>
      <input type="radio" value="corp-a" name="member_type">

      <label for="member_type"><b>Business</b>: sole prop./consultant  with 3 or fewer employees / entitled to 2 reps / annual dues: $275</label>
      <input type="radio" value="corp-a" name="member_type">

      <label for="member_type"><b>Individual</b>: employee / entitled to self-representation (does not extend to employer) / annual dues: $225</label>
      <input type="radio" value="corp-a" name="member_type">

      <label for="member_type"><b>Student</b>: matriculating at accredited institution; non-voting category / annual dues: $65</label>
      <input type="radio" value="corp-a" name="member_type">
    </div>

		<div>
      <p>Corporate or Business applicants, please provide the names, titles, telephone numbers, fax numbers, and email addresses of your representatives:</p>
      <textarea name="reps" rows="8" cols="40"></textarea>
    </div>


		<div>
      <b><p>Student applicants, please indicate:</p></b>

			<!-- student: school | meta -->
        <label for="student_app_school">School</label>
        <input type="text" name="student_app_school" value="">

			<!-- student: area of concentration | meta -->
				<label for="student_app_concentration">Area of Concentration</label>
        <input type="text" name="student_app_concentration" value="">

    </div>




    <p><b>Business Survey:</b></p>
    <p>Please complete anything applicable</p>

		<!-- other associations | meta -->
    <div>
      <p>
        If you or your company are members of other business or professional associations, please list association names:
        <textarea name="other_associations" rows="8" cols="40"></textarea>
      </p>
    </div>

		<!-- biz ownership | meta -->
    <div>
      <label for="business_owned">Is your business owned (5l% or more) and controlled by:</label>
      <select name="business_owned">
        <option value=""></option>
        <option value="women">Women</option>
        <option value="minorities">Minorities</option>
        <option value="both">Women and minorities</option>
      </select>
    </div>

    <br>

			<!-- gov agency | meta -->
    <div>
      <p><b>Is your company currently certified by any government agency as:</b></p>

      <label for="">Minority Business Enterprise (MBE)</label>
      <input type="checkbox" name="gov_agency[]" value="mbe">

      <label for="">Disadvantaged Business Enterprise (DBE)</label>
      <input type="checkbox" name="gov_agency[]" value="dbe">

      <label for="">Women's Business Enterprise (WBE)</label>
      <input type="checkbox" name="gov_agency[]" value="wbe">
    </div>

		<!-- agency certification | meta -->
    <div>
      <p>Please indicate agencies that have certified your company:</p>
      <textarea name="agency_cert"></textarea>
    </div>

		<!-- submit btn -->
		<input type="hidden" name="submitted" id="submitted" value="true" />
		<button type="submit" class="submit">Submit</button>

  </form>

</section>

	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
