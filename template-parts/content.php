<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portaldoenvelhecimento
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

   <div class="flex gap-10">
      <div>
         <?php portaldoenvelhecimento_post_thumbnail(); ?>
      </div>
      <div>
         <header class="entry-header">
            <?php
            if (is_singular()) :
               the_title('<h1 class="entry-title">', '</h1>');
            else :
               the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
            endif;

            if ('post' === get_post_type()) :
            ?>
               <div class="entry-meta">
                  <?php
                  portaldoenvelhecimento_posted_on();
                  portaldoenvelhecimento_posted_by();
                  ?>
               </div><!-- .entry-meta -->
            <?php endif; ?>
         </header><!-- .entry-header -->


         <div class="entry-content">
            <?php
            the_excerpt();
            ?>
         </div><!-- .entry-content -->
      </div>
   </div>

</article><!-- #post-<?php the_ID(); ?> -->
