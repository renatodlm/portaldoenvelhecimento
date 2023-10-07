<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portaldoenvelhecimento
 */

get_header();
?>

<main id="primary" class="site-main">

   <div class="container py-12">
      <div class="flex lg:flex-row flex-col gap-6 w-full flex-wrap"><!-- flex-grow -->
         <div class="flex-1 flex-col flex gap-8 w-full">
            <?php
            $i = 0;
            if (have_posts()) :

               while (have_posts()) :
                  the_post();

                  get_template_part('template-parts/content', null, [
                     'index' => $i
                  ]);
                  $i++;
               endwhile;

            else :

               get_template_part('template-parts/content', 'none');

            endif;
            ?>

            <?php
            $categorias = get_field('categorias_home', 'option');

            if (!empty($categorias))
            {
            ?>
               <div class="flex flex-col gap-8 items-center">
                  <?php

                  $i = 0;

                  foreach ($categorias as $categoria)
                  {
                     $categoria_id = $categoria->term_id;

                     $args = array(
                        'category__in' => array($categoria_id),
                        'posts_per_page' => 2
                     );

                     $posts = new WP_Query($args);
                     if ($posts->have_posts())
                     {
                        $category_color = get_theme_mod('category_color_' . $categoria_id, '#2ecc71');
                  ?>
                        <div class="category-<?php echo $categoria_slug ?> bg-gray-100 pb-4 items-center">
                           <h2 class="py-1 px-2 w-fit text-white text-base uppercase hover:text-white mb-4" style="background-color:<?php echo $category_color ?>">
                              <?php echo $categoria->name ?>
                           </h2>
                           <ul class="flex">
                              <?php
                              while ($posts->have_posts())
                              {
                                 $posts->the_post();
                              ?>
                                 <li class="grid lg:grid-cols-2 gap-4 px-4 items-center">
                                    <div class="col-span-1"><?php portaldoenvelhecimento_post_thumbnail() ?></div>
                                    <p class="col-span-1 leading-tight lg:leading-snug mb-0">
                                       <a class="text-sm lg:text-lg font-bold" href="<?php echo  get_permalink() ?>"><?php echo  get_the_title() ?></a>
                                    </p>
                                 </li>
                              <?php
                              }
                              ?>
                           </ul>
                        </div>
                  <?php
                     }
                     wp_reset_postdata();
                     $i++;
                  }
                  ?>
               </div>
            <?php } ?>
         </div>
         <?php

         get_template_part('template-parts/content', 'sidebar');

         ?>
      </div>
   </div>

</main><!-- #main -->

<?php
get_footer();
