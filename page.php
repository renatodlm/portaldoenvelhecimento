<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portaldoenvelhecimento
 */

get_header();

?>

<main id="primary" class="site-main">

   <div class="container py-12">
      <div class="flex gap-6 w-full"><!-- flex-grow -->
         <div class="flex-1 flex-col flex gap-8 w-full">

            <?php
            while (have_posts()) :
               the_post();

               get_template_part('template-parts/content', 'page');

            endwhile; // End of the loop.
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
