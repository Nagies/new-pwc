<?php
/**
 *
 * Template Name: Home Page
 *
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package underscores
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div id="index-page">
				<section id="section-1">
					<?php
						echo do_shortcode("[metaslider id=3193 percentwidth=100]");
					?>
					<!-- <div class="text-wrap">
						<h1>
							Professional Women in Construction
						</h1>
						<h5>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa aliquid quisquam magnam iusto, quod.
						</h5>
						<button>
							Become a Member
						</button>
					</div> -->
					<div class="text-wrap">
						<h3>NATIONAL ASSOCIATION OF</h3>
						<h1>PROFESSIONAL WOMEN IN CONSTRUCTION</h1>
						<!-- <h5>
							- Advancing <span>professional</span>, <span>entrepreneurial</span> and <span>managerial</span> opportunities for women and other "non-traditional" populations -
						</h5> -->
						<div class="buttons-wrapper">
							<a href="/pwc/membership">
								<button>JOIN US</button>
							</a>
							<a href="/pwc/events">
								<button class="trans">EVENTS</button>
							</a>
						</div>
					</div>
				</section>

				<section id="section-2">
					<!-- <div class="about">
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos, numquam consequatur earum aliquid libero magnam, fugit dolores excepturi, ab minima, deserunt alias vero beatae nesciunt facilis hic qui doloremque architecto.
						</p>
					</div> -->
					<!-- <h3>
						PWC
					</h3> -->
					<div class="icons-wrapper">
						<div class="icon">
							<div class="inner">
								<img src="http://pwc.lizaramo.com/wp-content/uploads/2016/09/photo-1458400411386-5ae465c4e57e-1.jpeg" alt="">
								<p>
									PWC is open to professional women and men, companies and public agencies in construction and allied industries.
								</p>
								<a href="pwc/membership">Apply for membership >></a>
							</div>
						</div>
						<div class="icon">
							<div class="inner">
								<img src="http://pwc.lizaramo.com/wp-content/uploads/2016/09/photo-1452827073306-6e6e661baf57-1.jpeg" alt="">
								<p>
									PWC is a resource for design & construction firms, government agencies and recruiters.
								</p>
								<a href="/pwc/jobs">View or Post a job >></a>
							</div>
						</div>
						<div class="icon">
							<div class="inner">
								<img src="http://www.pwcusa.org/v2/images/hmpg-chelsea.jpg" alt="">
								<p>
									We are delighted to announce PWC's new executive director,
									<span>
										Chelsea LeMar.
									</span>
								</p>
								<a href="pwc/news-blog">Read more >></a>
							</div>
						</div>
					</div>

					<!-- <ul class="stately">
				    <li data-state="al" class="al">A</li>
				    <li data-state="ak" class="ak">B</li>
				    <li data-state="ar" class="ar">C</li>
				    <li data-state="az" class="az">D</li>
				    <li data-state="ca" class="ca">E</li>
				    <li data-state="co" class="co">F</li>
				    <li data-state="ct" class="ct">G</li>
				    <li data-state="de" class="de">H</li>
				    <li data-state="dc" class="dc">I</li>
				    <li data-state="fl" class="fl">J</li>
				    <li data-state="ga" class="ga">K</li>
				    <li data-state="hi" class="hi">L</li>
				    <li data-state="id" class="id">M</li>
				    <li data-state="il" class="il">N</li>
				    <li data-state="in" class="in">O</li>
				    <li data-state="ia" class="ia">P</li>
				    <li data-state="ks" class="ks">Q</li>
				    <li data-state="ky" class="ky">R</li>
				    <li data-state="la" class="la">S</li>
				    <li data-state="me" class="me">T</li>
				    <li data-state="md" class="md">U</li>
				    <li data-state="ma" class="ma">V</li>
				    <li data-state="mi" class="mi">W</li>
				    <li data-state="mn" class="mn">X</li>
				    <li data-state="ms" class="ms">Y</li>
				    <li data-state="mo" class="mo">Z</li>
				    <li data-state="mt" class="mt">a</li>
				    <li data-state="ne" class="ne">b</li>
				    <li data-state="nv" class="nv">c</li>
				    <li data-state="nh" class="nh">d</li>
				    <li data-state="nj" class="nj">e</li>
				    <li data-state="nm" class="nm">f</li>
				    <li data-state="ny" class="ny">g</li>
				    <li data-state="nc" class="nc">h</li>
				    <li data-state="nd" class="nd">i</li>
				    <li data-state="oh" class="oh">j</li>
				    <li data-state="ok" class="ok">k</li>
				    <li data-state="or" class="or">l</li>
				    <li data-state="pa" class="pa">m</li>
				    <li data-state="ri" class="ri">n</li>
				    <li data-state="sc" class="sc">o</li>
				    <li data-state="sd" class="sd">p</li>
				    <li data-state="tn" class="tn">q</li>
				    <li data-state="tx" class="tx">r</li>
				    <li data-state="ut" class="ut">s</li>
				    <li data-state="va" class="va">t</li>
				    <li data-state="vt" class="vt">u</li>
				    <li data-state="wa" class="wa">v</li>
				    <li data-state="wv" class="wv">w</li>
				    <li data-state="wi" class="wi">x</li>
				    <li data-state="wy" class="wy">y</li>
					</ul>
					<div class="state-wrap">
						<p>NJ</p>
						<p>NY</p>
						<p>CT</p>
						<p>DC</p>
					</div> -->
				</section>

				<section id="section-3">
					<div class="inner-wrapper">
						<h1>
							WHO WE ARE
						</h1>
						<p>
							Professional Women in Construction (PWC) is a nonprofit organization committed to advancing professional, entrepreneurial and managerial opportunities for women and other "non-traditional" populations in construction and related industries.
						</p>
						<a href="/pwc/about" class="learn-more">Learn more >></a>
						<div class="we-wrapper">
							<div class="we">
								<img src="<?php echo site_url(); ?>/wp-content/themes/pwc-underscores/images/group.svg" alt="">
								<span>
									6
								</span>
								<p>
									Chapters
								</p>
							</div>
							<div class="we">
								<img src="<?php echo site_url(); ?>/wp-content/themes/pwc-underscores/images/engineer.svg" alt="">
								<span>
									1000
								</span>
								<p>
									Members
								</p>
							</div>
							<div class="we">
								<img src="<?php echo site_url(); ?>/wp-content/themes/pwc-underscores/images/id-card.svg" alt="">
								<span>
									800
								</span>
								<p>
									Jobs
								</p>
							</div>
						</div>
					</div>
				</section>

				<section id="section-4">
					<div class="overlay"></div>
						<div class="text-wrapper">
							<h3>
								VIEW EVENTS NEAR YOU
							</h3>
							<a href="/pwc/events">
								EVENTS
							</a>
						</div>
					<!-- <h3>
						Videos
					</h3> -->
					<!-- <p>
						PWC is a resource for design & construction firms, government agencies and recruiters. Submit your ad today for just $50 per ad (call for annual rates). Listings are $25 for all PWC members and sponsors. Everyone is welcome to review employment opportunities listed on the PWC website.
					</p> -->
					<!-- <div class="buttons">
						<button>
							View Jobs
						</button>
						<button>
							Post Jobs
						</button>
					</div> -->
				</section>

				<!-- <section id="section-5">
					<h3>
						SPONSORS
					</h3>
					<div class="sponsor-wrap">
						<div class="sponsor"></div>
						<div class="sponsor"></div>
						<div class="sponsor"></div>
						<div class="sponsor"></div>
						<div class="sponsor"></div>
						<div class="sponsor"></div>
						<div class="sponsor"></div>
						<div class="sponsor"></div>
						<div class="sponsor"></div>
						<div class="sponsor"></div>
						<div class="sponsor"></div>
						<div class="sponsor"></div>
					</div>
				</section> -->

				<!-- <section id="section-6">
					current news, events, past events
				</section> -->

			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
