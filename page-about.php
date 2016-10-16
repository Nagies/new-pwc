<?php
/**
 *
 * Template Name: About Page
 *
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

get_header();
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div id="about-page">
				<section id="section-1">
					<div class="overlay"></div>
					<div class="text-wrapper">
						<h1>WHO WE ARE</h1>
					</div>
				</section>
				<section id="section-2">
					<div class="about-container">

					<div class="side-menu">
						
						<h1>
							About
						</h1>

						<?php get_sidebar(); ?>
						
					</div>
					<div class="text-wrapper">
						<h1>
							ABOUT PWC
						</h1>

						<p>
							Professional Women in Construction (PWC) is a nonprofit organization committed to advancing professional, entrepreneurial and managerial opportunities for women and other "non-traditional" populations in construction and related industries. With 6 chapters and over 1,000 members, PWC serves a constituency of close to 15,000, representing a broad spectrum of the industry. As its mission, PWC encourages and advances the goals and interests of woman and minority-owned businesses.
						</p>

						<!-- <div class="divider"></div> -->

						<h1>
							MEMBERS
						</h1>

						<p>
							PWC's members represent a broad spectrum of the industry that serves real estate owners, developers, facilities & property managers and public agencies. They include general construction and specialty contractors; A & E firms, environmental services and suppliers of all kinds of goods and services. Because our core client industries have many and diverse needs, PWC also draws representatives from the services sector: law and accounting firms, insurance/surety & bonding companies, banks and financial services, graphic designers, printers, computer consultants, travel agencies, marketing specialists and more. Membership is open to business and professional women and men, private companies and public agencies in construction and allied industries.
						</p>

						<!-- <div class="divider"></div> -->
						<h1>
							SUPPORTERS
						</h1>

						<p>
							Many major national and international corporations and public agencies are members and sponsors supporting the aims of PWC. We applaud the small and w/mbe member companies that have also joined as PWC annual sponsors.
						</p>

						<!-- <div class="divider"></div> -->
						<h1>
							ADVOCATE FOR WOMAN + MINORITY-OWNED FIRMS
						</h1>

						<p class="m-bottom">
							PWC encourages and advances the aims and goals of woman- and minority-owned businesses. The PWC annual W/MBE Technical Assistance Workshop & Opportunity Fair disseminates information on government certification and promotes business interchange with public agencies and companies with supplier diversity programs.
						</p>
					</div>
					</div>
				</section>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
