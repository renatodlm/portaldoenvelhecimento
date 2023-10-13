<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package portaldoenvelhecimento
 */

get_header();

$currentCat_id = !empty($_GET['categoria']) ? $_GET['categoria'] : false;
$category_name = false;
$cat_color = '';

if (!empty($currentCat_id))
{
   $cat = get_category($currentCat_id);
   $category_name = $cat->name;
   $cat_color = get_theme_mod('category_color_' . $cat->term_id, '#E98B40');
}

?>
<main id="primary" class="site-main">

   <div class="container py-12">
      <div class="flex lg:flex-row flex-col gap-10 w-full">
         <div class="flex gap-6 w-full flex-wrap"><!-- flex-grow -->
            <div class="flex-1 flex-col flex gap-8">
               <?php if (have_posts()) : ?>

                  <header x-data="{currentCat:<?php echo  $currentCat_id ?>, categoryName: '<?php echo $category_name ?>' }" class="page-header">
                     <h1 class="page-title text-2xl uppercase">
                        <?php
                        /* translators: %s: search query. */
                        printf(esc_html__('Resultados para: %s', 'portaldoenvelhecimento'), '<span class="font-bold " style="text-transform: none;">' . get_search_query() . '</span>');
                        ?>
                     </h1>
                     <p x-show="categoryName !== 'false'" x-cloak class="my-4 text-sm uppercase text-gray-600">
                        <?php esc_html_e('Na categoria: ', 'portaldoenvelhecimento') ?>
                        <span class="py-1 px-2 text-gray-800 text-xs hover:text-gray-800 focus:text-gray-800" style="background-color: <?php echo $cat_color ?>;" x-text="categoryName"></span>
                     </p>
                  </header><!-- .page-header -->
                  <?php get_search_form() ?>

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
