<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package portaldoenvelhecimento
 */

get_header();
?>

<main id="primary" class="site-main">

   <section class="error-404 not-found py-16 w-full flex flex-col items-center justify-center bg-white">
      <header class="page-header">
         <h1 class="page-title text-gray-800 text-4xl font-bold">
            <?php esc_html_e('Ops! Essa página não pode ser encontrada..', 'portaldoenvelhecimento'); ?>
         </h1>
      </header><!-- .page-header -->

      <div class="page-content flex flex-col justify-center items-center">
         <h1 class="text-[9.375rem] font-bold text-gray-800">404</h1>
         <a href="<?php echo get_home_url() ?>" class="bg-yellow-400 text-gray-800 py-2 px-5 max-auto">Go home</a>
      </div><!-- .page-content -->
   </section><!-- .error-404 -->

</main><!-- #main -->

<?php
get_footer();
