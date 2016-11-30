<?php
/**
 *
 * Template Name: News page
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package underscores
 */

get_header(); ?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">
    <div id="news-page">

      <section id="section-1">
        <div class="overlay"></div>
        <div class="text-wrapper">
          <h1>
            News
          </h1>
        </div>
      </section>
      
      <section id="section-2">
        <div class="news-container">
        <!-- news cpts loop: -->
        <?php if ( have_posts() ) : ?>
          <?php /* Start the Loop */ ?>
            <?php // while ( have_posts() ) : the_post(); ?> <!-- commenting this out gets rid of the triple loop error -->

            <?php // get the jobs cpts //
            $args = array(
              'post_type'       =>    'news',
              'post_status'     =>    'publish',
              'posts_per_page'  =>    -1,
              'order'           =>    'DESC',
              'oderby'          =>    'date'
            );
            $news_posts = get_posts($args);

            foreach ( $news_posts as $newsPost ) {

              // var_dump($newsPost);

              $newsPostID                   =   $newsPost->ID;
              $newsPostTitle                =   $newsPost->post_title;
              $newsPostURL                  =   get_post_permalink($newsPostID);
              $newsPostPostDate             =   $newsPost->post_date;
              $formattedNewsPostDate        =   date('F j, Y', strtotime($newsPostPostDate));
              $excerpt                      =   $newsPost->post_excerpt;
              $newsPost_img_id              =   get_post_thumbnail_id( $newsPostID );
              $newsPost_img                 =   wp_get_attachment_url( $newsPost_img_id );
              ?>
              
                <div class="news-wrapper">
                  <!-- Title and link -->
                  <h3>
                    <a href="<?php echo $newsPostURL ?>"><?php echo $newsPostTitle; ?></a>
                  </h3>

                  <!-- Posted date -->
                  <?php if ($formattedNewsPostDate) { ?>
                    <p class="date-posted">Posted on: <?php echo $formattedNewsPostDate; ?></p>
                  <?php } ?>

                  <!-- Excerpt -->
                  <?php if ($excerpt) { ?>
                    <p>
                      <?php echo $excerpt; ?>...
                    </p>
                  <?php } ?>

                  <!-- post img -->
                  <img src=" <?php echo $newsPost_img; ?> " alt="" />

                  <!-- <div class="divider"></div> -->
                </div>


              <?php
            } // end for each news post ?>
          <?php // endwhile; ?> <!-- commenting this out gets rid of the triple loop error -->

          <?php // the_posts_navigation(); ?>

        <?php else : ?>

          <?php get_template_part( 'template-parts/content', 'none' ); ?>

        <?php endif; ?>
        </div>
      </section>
    </div><!-- news-page -->
  </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
