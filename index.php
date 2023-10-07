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
      <div class="flex lg:flex-row flex-col gap-10 w-full flex-wrap"><!-- flex-grow -->
         <div class="w-full lg:w-[calc(100%-23.75rem-2.5rem)] flex-1 flex-col grid lg:grid-cols-3 gap-y-8 gap-x-4">
            <?php
            $i = 0;

            $posts_slider = '';
            $posts_after_slider = '';
            $posts_slider_thumbs = '';

            $post_args = [
               'posts_per_page' => 12,
               'orderby'        => 'date',
               'order'          => 'DESC'
            ];

            $home_posts = new WP_Query($post_args);
            if ($home_posts->have_posts()) :
               while ($home_posts->have_posts()) : $home_posts->the_post();


                  if ($i < 6)
                  {
                     ob_start();
                     get_template_part('template-parts/content', 'home-slider-item', [
                        'index' => $i
                     ]);
                     $posts_slider .= ob_get_clean();

                     ob_start();
            ?>
                     <div class="swiper-slide">
                        <?php portaldoenvelhecimento_post_thumbnail('thumbnail', 'w-full max-full object-cover aspect-video', false) ?>
                     </div>
            <?php
                     $posts_slider_thumbs .= ob_get_clean();
                  }
                  else
                  {
                     ob_start();
                     get_template_part('template-parts/content', 'new', [
                        'index' => $i
                     ]);
                     $posts_after_slider .= ob_get_clean();
                  }

                  $i++;
               endwhile;
            endif;
            wp_reset_postdata();
            ?>

            <div class="col-span-3 lg:pb-6 lg:border-b lg:border-gray-400">
               <div class="swiper max-w-full homeSlider2">
                  <div class="swiper-wrapper">
                     <?php echo $posts_slider ?>
                  </div>
                  <div class="swiper-pagination"></div>
                  <div class="swiper-button-next"></div>
                  <div class="swiper-button-prev"></div>
               </div>
               <div class="swiper max-w-full homeSlider">
                  <div class="swiper-wrapper">
                     <?php echo $posts_slider_thumbs ?>
                  </div>
               </div>
            </div>

            <?php

            echo $posts_after_slider;



            $categorias = get_field('categorias_home', 'option');

            if (!empty($categorias))
            {
            ?>
               <div class="flex flex-col gap-8 items-center col-span-3">
                  <?php

                  $i = 0;

                  foreach ($categorias as $categoria)
                  {
                     $categoria_id = $categoria->term_id;
                     $categoria_slug = $categoria->slug;

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
