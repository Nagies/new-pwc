<?php

/////////////////////////////////////////////////////////
/////// Membership Applications (member-apps) //////////
///////////////////////////////////////////////////////

// Membership Type taxonomy
add_action( 'init', 'create_membership_taxonomies', 0 );
function create_membership_taxonomies() {
  register_taxonomy(
    'membership_app_type',
    'member-apps',
    array(
      'labels' => array(
      'name' => 'Membership Application Types',
      'add_new_item' => 'Add New Membership Application Type',
      'new_item_name' => "New Membership Application Type"
    ),
    'show_ui' => true,
    'show_in_menu' => true,
    'show_tagcloud' => false,
    'hierarchical' => true
    )
  );
}

// Membership Apps meta boxes:
function member_apps_meta_boxes() {
  add_meta_box(
    'member_app_type_info',
    'Application Type',
    'member_app_type_info_markup',
    'member-apps',
    'normal'
  );

  add_meta_box(
    'member_app_form_info',
    'Application Info',
    'member_app_form_info_markup',
    'member-apps',
    'normal'
  );

}
add_action('add_meta_boxes', 'member_apps_meta_boxes');

function member_app_type_info_markup() { ?>
  <p>
    hello
  </p>
<?php }


function member_app_form_info_markup() {
  global $post; ?>

  <!-- professional license/title | meta -->
  <div>
    <label for="prof_title">Professional license or title:</label>
    <input type="text" name="prof_title" id="prof_title" size=60
           value="<?php echo get_post_meta($post->ID, 'prof_title', true) ?>"><br>
  </div>

  <!-- company name | meta -->
  <div>
    <label for="company_name">Company Name:</label>
    <input type="text" name="company_name" id="company_name" size=60
           value="<?php echo get_post_meta($post->ID, 'company_name', true) ?>"><br>
  </div>

  <!-- company title | meta -->
  <div>
    <label for="company_title">Company Job Title:</label>
    <input type="text" name="company_title" id="company_title" size=60
           value="<?php echo get_post_meta($post->ID, 'company_title', true) ?>"><br>
  </div>

  <!-- preferred mailing address | meta | radio -->
  <?php $preferred_mailing = get_post_meta($post->ID, 'preferred_mailing', true); ?>
  <div>
    <label for="preferred_mailing">Preferred mailing address:</label><br>
    <input type="radio" name="preferred_mailing" value="business"
      <?php if ($preferred_mailing == "business") { ?>
        checked="checked"
      <?php } ?>
      > Business <br>
    <input type="radio" name="preferred_mailing" value="home"
      <?php if ($preferred_mailing == "home") { ?>
        checked="checked"
      <?php } ?>
      > Home<br>
  </div>


  <hr>


  <p><b>Business Information:</b></p>

  <!-- biz address | meta -->
  <div>
    <label for="biz_address">Business Address:</label>
    <input type="text" name="biz_address" id="biz_address" size=60
           value="<?php echo get_post_meta($post->ID, 'biz_address', true) ?>"><br>
  </div>

  <!-- biz website | meta -->
  <div>
    <label for="biz_website">Business website:</label>
    <input type="text" name="biz_website" id="biz_website" size=60
           value="<?php echo get_post_meta($post->ID, 'biz_website', true) ?>"><br>
  </div>


  <!-- biz phone | meta -->
  <div>
    <label for="biz_phone">Business phone number:</label>
    <input type="text" name="biz_phone" id="biz_phone" size=60
           value="<?php echo get_post_meta($post->ID, 'biz_phone', true) ?>"><br>
  </div>

  <!-- biz fax | meta -->
  <div>
    <label for="biz_fax">Business fax number:</label>
    <input type="text" name="biz_fax" id="biz_fax" size=60
           value="<?php echo get_post_meta($post->ID, 'biz_fax', true) ?>"><br>
  </div>

  <!-- biz email | meta -->
  <div>
    <label for="biz_email">Business email:</label>
    <input type="text" name="biz_email" id="biz_email" size=60
           value="<?php echo get_post_meta($post->ID, 'biz_email', true) ?>"><br>
  </div>

	<!-- Biz type/specialty | meta -->
  <div>
    <label for="biz_type_specialty">Business type and specialty:</label><br>
    <span>i.e., GC, CM, Sub. Prof. Service, Consulting, Supplier, Manufacturer. Please be specific regarding product(s).</span><br>
    <textarea name="biz_type_specialty" id="biz_type_specialty">
      <?php echo get_post_meta($post->ID, 'biz_type_specialty', true) ?>
    </textarea>
  </div>

  <!-- Biz owner | meta | select-->
  <?php $biz_owner = get_post_meta($post->ID, 'biz_owner', true ); ?>
  <div>
		<label for="biz_owner">Are you an owner of the company?:</label>
		<select name="biz_owner">
			<option value=""></option>
			<option value="yes"
        <?php if ($biz_owner == "yes") { ?>
          selected="selected"
        <?php } ?>
      >Yes</option>
			<option value="no"
        <?php if ($biz_owner == "no") { ?>
          selected="selected"
        <?php } ?>
      >No</option>
		</select><br>
  </div>

  <!-- biz owner percentage | meta -->
  <div>
    <label for="biz_percentage">Percentage owned by you:</label>
    <input type="text" name="biz_percentage" id="biz_percentage" size=5
           value="<?php echo get_post_meta($post->ID, 'biz_percentage', true) ?>">%
  </div>

  <!-- employee status | meta -->
  <?php $employe_status = get_post_meta($post->ID, 'employee_status', true); ?>
  <div>
		<label for="employee_status">Your status with the company:</label>
		<select name="employee_status">
			<option value=""></option>
			<option value="owner"
        <?php if ($employe_status == "owner") { ?>
          selected="selected"
        <?php } ?>
      >Owner</option>
			<option value="partner"
        <?php if ($employe_status == "partner") { ?>
          selected="selected"
        <?php } ?>
      >Partner</option>
			<option value="employee"
        <?php if ($employe_status == "employee") { ?>
          selected="selected"
        <?php } ?>
      >Employee</option>
		</select><br>
  </div>

  <!-- Annual sales | meta -->
  <?php $annual_gross = get_post_meta($post->ID, 'annual_gross', true); ?>
  <div>
    <label for="annual_gross">Annual gross sales:</label>
    <select name="annual_gross">
      <option value="">Select</option>
      <option value="under-500"
        <?php if ($annual_gross == "under-500") { ?>
          selected="selected"
        <?php } ?>
      >Under $500K</option>
      <option value="500k-2m"
        <?php if ($annual_gross == "500k-2m") { ?>
          selected="selected"
        <?php } ?>
      >$500K&nbsp;to&nbsp;$2M</option>
      <option value="2m-5m"
        <?php if ($annual_gross == "2m-5m") { ?>
          selected="selected"
        <?php } ?>
      >$2M&nbsp;to&nbsp;$5M</option>
      <option value="5m-10m"
        <?php if ($annual_gross == "5m-10m") { ?>
          selected="selected"
        <?php } ?>
      >$5M&nbsp;to&nbsp;$10M</option>
      <option value="10m-25m"
        <?php if ($annual_gross == "10m-25m") { ?>
          selected="selected"
        <?php } ?>
      >$10M&nbsp;to&nbsp;$25M</option>
      <option value="25m-plus"
        <?php if ($annual_gross == "25m-plus") { ?>
          selected="selected"
        <?php } ?>
      >$25M+</option>
    </select><br>
  </div>

  <hr>

  <p><b>Home Information:</b></p>

  <!-- home address | meta -->
  <div>
    <label for="home_address">Home Address:</label>
    <input type="text" name="home_address" id="home_address" size=60
           value="<?php echo get_post_meta($post->ID, 'home_address', true) ?>">
  </div>

  <!-- home cell phone | meta -->
  <div>
    <label for="home_cell">Home cell phone:</label>
    <input type="text" name="home_cell" id="home_cell" size=60
           value="<?php echo get_post_meta($post->ID, 'home_cell', true) ?>">
  </div>

  <!-- home phone | meta -->
  <div>
    <label for="home_phone">Home phone number:</label>
    <input type="text" name="home_phone" id="home_phone" size=60
           value="<?php echo get_post_meta($post->ID, 'home_phone', true) ?>">
  </div>

  <!-- home fax | meta -->
  <div>
    <label for="home_fax">Home fax number:</label>
    <input type="text" name="home_fax" id="home_fax" size=60
           value="<?php echo get_post_meta($post->ID, 'home_fax', true) ?>">
  </div>

  <!-- home email | meta -->
  <div>
    <label for="home_email">Home email:</label>
    <input type="text" name="home_email" id="home_email" size=60
           value="<?php echo get_post_meta($post->ID, 'home_email', true) ?>">
  </div>


  <hr>


  <!-- membership category | meta -->
  <?php $member_type = get_post_meta($post->ID, 'member_type', true); ?>
  <div>
    <label for="member_type"><b>Membership Category:</b></label><br>
    <span>Final approval of membership is at the discretion of the PWC Board of Directors.</span><br><br>
    <input type="radio" value="corp-a" name="member_type"
      <?php if ($member_type == 'corp-a') { ?>
        checked="checked"
      <?php } ?>
    ><b>Corporate A</b><br>
    <input type="radio" value="corp-b" name="member_type"
      <?php if ($member_type == 'corp-b') { ?>
        checked="checked"
      <?php } ?>
    ><b>Corporate B</b><br>
    <input type="radio" value="business" name="member_type"
      <?php if ($member_type == 'business') { ?>
        checked="checked"
      <?php } ?>
    ><b>Business</b><br>
    <input type="radio" value="individual" name="member_type"
      <?php if ($member_type == 'individual') { ?>
        checked="checked"
      <?php } ?>
    ><b>Individual</b><br>
    <input type="radio" value="student" name="member_type"
      <?php if ($member_type == 'student') { ?>
        checked="checked"
      <?php } ?>
    ><b>Student</b>
  </div>

  <div>
    <p>Corporate or Business applicants, please provide the names, titles, telephone numbers, fax numbers, and email addresses of your representatives:</p>
    <textarea name="reps" rows="5" cols="40">
      <?php echo get_post_meta($post->ID, 'reps', true); ?>
    </textarea>
  </div>


  <hr>


  <div>
    <b><p>Student applicants, please indicate:</p></b>

    <!-- student: school | meta -->
    <div>
      <p>School:</p>
      <input type="text" name="student_app_school" value="<?php echo get_post_meta($post->ID, 'student_app_school', true); ?>">
    </div>

    <!-- student: area of concentration | meta -->
    <div>
      <p>Area of concentration:</p>
      <input type="text" name="student_app_concentration" value="<?php echo get_post_meta($post->ID, 'student_app_concentration', true); ?>">
    </div>

  </div>


  <hr>


  <p><b>Business Survey:</b></p>

	<!-- other associations | meta -->
  <div>
    <p>
      If you or your company are members of other business or professional associations, please list association names:
    </p>
    <textarea name="other_associations" rows="8" cols="40">
      <?php echo get_post_meta($post->ID, 'student_app_concentration', true); ?>
    </textarea>
  </div>

  <!-- biz ownership | meta -->
  <?php $business_owned = get_post_meta($post->ID, 'business_owned', true); ?>
  <div>
    <label for="business_owned">Is your business owned (5l% or more) and controlled by:</label>
    <select name="business_owned">
      <option value=""></option>
      <option value="women"
        <?php if ($business_owned == "women") { ?>
          selected="selected"
        <?php } ?>
      >Women</option>
      <option value="minorities"
        <?php if ($business_owned == "minorities") { ?>
          selected="selected"
        <?php } ?>
      >Minorities</option>
      <option value="both"
        <?php if ($business_owned == "both") { ?>
          selected="selected"
        <?php } ?>
      >Women and minorities</option>
    </select>
  </div>

  <!-- gov agency | meta | checkbox -->
  <?php $gov_agency_arr = get_post_meta($post->ID, 'gov_agency', true); ?>
  <div>
    <span>Is your company currently certified by any government agency as:</span><br>

    <input type="checkbox" name="gov_agency[]" value="mbe"
      <?php if ( $gov_agency_arr != '' && array_search( 'mbe', $gov_agency_arr ) !== false ) { ?>
        checked="checked"
      <?php } ?>
    ><label for="">Minority Business Enterprise (MBE)</label><br>

    <input type="checkbox" name="gov_agency[]" value="dbe"
      <?php if (  $gov_agency_arr != '' && array_search( 'dbe', $gov_agency_arr ) !== false ) { ?>
        checked="checked"
      <?php } ?>
    ><label for="">Disadvantaged Business Enterprise (DBE)</label><br>

    <input type="checkbox" name="gov_agency[]" value="wbe"
      <?php if (  $gov_agency_arr != '' && array_search( 'wbe', $gov_agency_arr ) !== false ) { ?>
        checked="checked"
      <?php } ?>
    ><label for="">Women's Business Enterprise (WBE)</label><br>
  </div>

  <!-- agency certification | meta -->
  <div>
    <p>Agencies that have certified your company:</p>
    <textarea name="agency_cert">
      <?php echo get_post_meta($post->ID, 'agency_cert', true); ?>
    </textarea>
  </div>

<?php } // end app info markup

///////////////////////////////

// save any new info
add_action('save_post', 'save_app_info_meta');
function save_app_info_meta() {
  global $post;
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
    if ( !empty( $_POST[$post_meta_array[$i]] ) ) {      // if not empty
      if ( isset( $_POST[$post_meta_array[$i]] ) ) {    // if set
        if ( $post_meta_array[$i] == 'gov_agency') {    // if 'gov_agency' (checkbox -- don't need to strip)
          update_post_meta( $post->ID, 'gov_agency', $_POST['gov_agency'] );
        } else {                                        // everything else
          update_post_meta( $post->ID, $post_meta_array[$i], esc_attr(strip_tags($_POST[$post_meta_array[$i]])) );
        }
      }
    }
  } // end for

} // end save_app_info
























//
