<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package portaldoenvelhecimento
 */

get_header();
?>

<main id="primary" class="site-main">

   <div class="container py-12">
      <div class="flex lg:flex-row flex-col gap-10 w-full">
         <div class="flex gap-6 w-full"><!-- flex-grow -->
            <div class="flex-1 flex-col flex gap-8">
               <?php if (have_posts()) : ?>

                  <header class="page-header">
                     <h1 class="page-title text-2xl font-bold">
                        <?php
                        /* translators: %s: search query. */
                        printf(esc_html__('Search Results for: %s', 'portaldoenvelhecimento'), '<span>' . get_search_query() . '</span>');
                        ?>
                     </h1>
                  </header><!-- .page-header -->


                  <?php
                  /* Start the Loop */
                  while (have_posts()) :
                     the_post();

                     /*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
                     get_template_part('template-parts/content');

                  endwhile;

                  ?>
                  <div class="pagination">
                     <?php
                     global $wp_query;

                     $big = 999999999; // Número suficientemente grande para garantir que a estrutura de links funcione corretamente

                     echo paginate_links(array(
                        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                        'format' => '?paged=%#%',
                        'current' => max(1, get_query_var('paged')),
                        'total' => $wp_query->max_num_pages,
                        'prev_text' => 'Anterior',
                        'next_text' => 'Próxima'
                     ));
                     ?>
                  </div>
               <?php

               else :

                  get_template_part('template-parts/content', 'none');

               endif;
               ?>
            </div>
         </div>
         <div>
            <?php

            get_template_part('template-parts/content', 'sidebar-filter');

            ?>
         </div>
      </div>
   </div>
</main><!-- #main -->

<?php
get_footer();
