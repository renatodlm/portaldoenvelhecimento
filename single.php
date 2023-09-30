<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package portaldoenvelhecimento
 */

get_header();
?>

<main id="primary" class="site-main">
   <div class="container py-12">
      <div class="flex gap-6"><!-- flex-grow -->
         <div class="flex-1 flex-col flex gap-8">
            <?php
            $i = 0;
            if (have_posts()) :

               while (have_posts()) :
                  the_post();

                  get_template_part('template-parts/content', get_post_type(), [
                     'index' => $i
                  ]);
                  $i++;
               endwhile;

            else :

               get_template_part('template-parts/content', 'none');

            endif;
            ?>
         </div>
         <?php

         get_template_part('template-parts/content', 'sidebar');

         ?>
      </div>
   </div>

</main><!-- #main -->
<?php

get_footer();
