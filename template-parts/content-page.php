<?php

/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portaldoenvelhecimento
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
   <header class="entry-header">
      <?php the_title('<h1 class="entry-title font-bold text-2xl mb-5">', '</h1>'); ?>
   </header><!-- .entry-header -->

   <?php portaldoenvelhecimento_post_thumbnail(); ?>

   <div class="entry-content">
      <?php
      the_content();

      wp_link_pages(
         array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'portaldoenvelhecimento'),
            'after'  => '</div>',
         )
      );
      ?>
   </div><!-- .entry-content -->


</article><!-- #post-<?php the_ID(); ?> -->
