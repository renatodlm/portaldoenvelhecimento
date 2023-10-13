<?php

/**
 * Template part for post single
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portaldoenvelhecimento
 */

$index = $args['index'] ?? false;

$content_class = $index === 0 ? 'flex-1' : 'flex-1';
$title_class = $index === 0 ? 'text-3xl font-medium' : 'text-xl font-medium';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

   <div class="flex gap-10 flex-col items-center">
      <div class="<?php echo $content_class ?> flex flex-col gap-2 max-w-full">
         <header class="entry-header !mb-4">
            <?php
            if (is_singular()) :
               the_title('<h1 class="' . $title_class . '">', '</h1>');
            else :
               the_title('<h2 class="' . $title_class . '"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
            endif;
            ?><div class="flex gap-2.5 my-2">
               <?php
               tags_in_posts()
               ?>
            </div><?php

                  if ('post' === get_post_type()) :
                  ?>
               <div class="entry-meta">
                  <?php
                     portaldoenvelhecimento_posted_on();
                     // portaldoenvelhecimento_posted_by();
                  ?>
               </div><!-- .entry-meta -->
            <?php endif; ?>
         </header><!-- .entry-header -->

         <div class="portaldoenvelhecimento-post-thumbnail w-full">
            <?php portaldoenvelhecimento_post_thumbnail(null, 'w-full max-full object-cover lg:aspect-16/6 aspect-video'); ?>
         </div>
         <div class="py-2 flex lg:flex-row flex-col flex-wrap">
            <?php get_template_part('template-parts/content', 'social-share-top'); ?>
         </div>
         <div class="entry-content text-gray-600 text-base">
            <?php
            echo show_excerpt(-1, '');
            ?>
            <div class="mt-6">
               <?php the_content() ?>
            </div>
         </div><!-- .entry-content -->
      </div>
   </div>
   <?php get_template_part('template-parts/content', 'social-share'); ?>
   <div class="navigation my-6">
      <h3 class="text-lg uppercase mb-3 font-bold text-gray-800"><?php esc_html_e('Leia mais', 'portaldoenvelhecimento') ?></h3>
      <div class="flex gap-4 justify-between items-center">
         <?php

         the_post_navigation(
            array(
               'prev_text' => '<span class="nav-subtitle">' . esc_html__('Anterior:', 'portaldoenvelhecimento') . '</span> <span class="nav-title">%title</span>',
               'next_text' => '<span class="nav-subtitle">' . esc_html__('Próximo:', 'portaldoenvelhecimento') . '</span> <span class="nav-title">%title</span>',
            )
         );
         ?>
      </div>
   </div>

   <div class="w-full">
      <?php
      $author_id = get_the_author_meta('ID');
      $author_name = get_the_author_meta('display_name', $author_id);
      $author_bio = get_the_author_meta('description', $author_id);
      $author_avatar = get_avatar_url($author_id, array('size' => 150));

      $post_count = count_user_posts($author_id);
      ?>

      <div class="bg-gray-100 p-4 mb-4 mt-6">
         <div class="flex mb-4 gap-4">
            <div class="flex-shrink-0">
               <img class="w-[5rem] h-[5rem]" src="<?php echo $author_avatar; ?>" alt="Avatar do Autor">
            </div>
            <div class="flex flex-col gap-4">
               <h3 class="text-xl font-bold text-gray-800 mb-0"><?php echo $author_name; ?></h3>
               <p class="text-base text-gray-500 mb-0"><?php echo $author_bio; ?></p>
               <p class="text-gray-400 text-xs uppercase mb-0"><?php echo $author_name; ?> escreveu <?php echo $post_count; ?> posts</p>
               <a href="<?php echo get_author_posts_url($author_id); ?>" class="text-blue-500 block hover:underline">
                  <?php
                  esc_html_e('Veja todos os posts de ', 'portaldoenvelhecimento');
                  echo $author_name;
                  ?></a>
            </div>
         </div>
      </div>

   </div>
   <?php echo do_shortcode('[wpdevart_facebook_comment curent_url="' . get_permalink() . '" order_type="social" title_text="Comentários" title_text_color="#000000" title_text_font_size="22" title_text_position="left" width="100%" bg_color="#d4d4d4" animation_effect="random" count_of_comments="3" ]'); ?>
   <p class="text-base font-semibold text-red-600 my-6">
      <?php

      esc_html_e('Os comentários dos leitores não refletem a opinião do Portal do Envelhecimento e Longeviver', 'portaldoenvelhecimento')

      ?>
   </p>

</article><!-- #post-<?php the_ID(); ?> -->
