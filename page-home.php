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
					<div class="overlay"></div>
					
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
						<h1>Professional Women in Construction</h1>
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

				<section id="section-3">
					<div class="inner-wrapper">
						<h1>
							Who We Are
						</h1>
						<p>
							Professional Women in Construction (PWC) is a nonprofit organization committed to advancing professional, entrepreneurial and managerial opportunities for women and other "non-traditional" populations in construction and related industries.
						</p>
						<a href="/pwc/about" class="learn-more">Learn More >></a>
						<div class="we-wrapper">
							<div class="we">
								<img src="<?php echo site_url(); ?>/wp-content/themes/pwc-underscores/images/network.png" alt="">
								<span class="span-header-font">
									6
								</span>
								<p>
									Chapters
								</p>
							</div>
							<div class="we">
								<img src="<?php echo site_url(); ?>/wp-content/themes/pwc-underscores/images/users.png" alt="">
								<span class="span-header-font">
									1000
								</span>
								<p>
									Members
								</p>
							</div>
							<div class="we">
								<img src="<?php echo site_url(); ?>/wp-content/themes/pwc-underscores/images/briefcase.png" alt="">
								<span class="span-header-font">
									800
								</span>
								<p>
									Jobs
								</p>
							</div>
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
								<a href="pwc/membership">Apply for Membership >></a>
							</div>
						</div>
						<div class="icon">
							<div class="inner">
								<img src="http://pwc.lizaramo.com/wp-content/uploads/2016/09/photo-1452827073306-6e6e661baf57-1.jpeg" alt="">
								<p>
									PWC is a resource for design & construction firms, government agencies and recruiters.
								</p>
								<a href="/pwc/jobs">View or Post a Job >></a>
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
								<a href="pwc/news-blog">Read More >></a>
							</div>
						</div>
					</div>
				</section>

				<section id="section-4">
					<div class="overlay"></div>
						<div class="text-wrapper">
							<h3>
								View Events Near You
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
