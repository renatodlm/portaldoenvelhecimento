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
      <div class="flex gap-6 flex-grow">
         <div class="flex-1 flex-col flex gap-8">
            <?php
            $i = 0;
            if (have_posts()) :

               /* Start the Loop */
               while (have_posts()) :
                  the_post();

                  /*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
                  get_template_part('template-parts/content', get_post_type(), [
                     'index' => $i
                  ]);
                  $i++;
               endwhile;

               the_posts_navigation();

            else :

               get_template_part('template-parts/content', 'none');

            endif;
            ?>
         </div>
         <div class="w-[17.5rem] bg-[#D9D9D9] rounded-lg p-4">
            <?php //get_sidebar('sidebar-1') 
            ?>
            <div>
               <h5><?php esc_html_e('Newsletter semanal', 'portaldoenvelhecimento') ?></h5>

            </div>
            <div>
               <h5><?php esc_html_e('Categorias', 'portaldoenvelhecimento') ?></h5>
            </div>
         </div>
      </div>

      <?php
      // Array com os slugs das categorias
      $categorias = array('blogs', 'direitos', 'mais-lida');

      // Loop para fazer as consultas
      foreach ($categorias as $categoria_slug)
      {
         // Recupera os IDs das categorias a partir dos slugs
         $categoria = get_category_by_slug($categoria_slug);
         $categoria_id = $categoria->term_id;

         // Consulta para obter 2 posts da categoria
         $args = array(
            'category__in' => array($categoria_id),
            'posts_per_page' => 2
         );

         $posts = new WP_Query($args);

         // Verifica se há posts na consulta
         if ($posts->have_posts())
         {
            echo '<div class="categoria-' . $categoria_slug . '">';
            echo '<h2>' . $categoria->name . '</h2>';
            echo '<ul>';

            while ($posts->have_posts())
            {
               $posts->the_post();
               echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
            }

            echo '</ul>';
            echo '</div>';
         }

         // Restaura os dados originais do post
         wp_reset_postdata();
      }
      ?>

   </div>

</main><!-- #main -->

<?php
get_footer();
