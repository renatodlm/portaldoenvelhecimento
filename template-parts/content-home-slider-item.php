<?php

/**
 * Template part for displaying home slider
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portaldoenvelhecimento
 */

?>
<div class="swiper-slide">
   <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

      <div class="flex lg:flex-row flex-col gap-10 items-center">
         <?php
         if (has_post_thumbnail())
         {
         ?>
            <div class="portaldoenvelhecimento-post-thumbnail w-full thumb-h-full aspect-16/15 lg:aspect-video">
               <?php portaldoenvelhecimento_post_thumbnail(); ?>
            </div>
         <?php
         }

         ?>
         <div class="flex-1 flex flex-col gap-2 absolute bottom-0 left-0 right-0 w-full p-4 bg-gradient-to-b from-transparent to-[rgba(0,0,0,0.7)]">
            <div class="flex gap-2.5">
               <?php
               tags_in_posts()
               ?>
            </div>
            <header class="entry-header">
               <?php

               the_title('<h2 class="text-base leading-snug lg:text-3xl font-medium block lg:max-w-[calc(100%-3.125rem-1rem)] max-w-[calc(100%-2rem-1rem)]"><a class="text-white hover:text-white focus:text-white" href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');

               if ('post' === get_post_type()) :
               ?>
                  <div class="entry-meta">
                     <?php
                     portaldoenvelhecimento_posted_on();
                     ?>
                  </div>
               <?php endif; ?>
            </header>


            <div class="entry-content text-gray-300 text-base lg:block hidden lg:max-w-[calc(100%-3.125rem-1rem)]">
               <?php
               echo show_excerpt();
               ?>
            </div>
         </div>
      </div>

   </article>
</div>
