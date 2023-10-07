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
      <div class="portaldoenvelhecimento-post-thumbnail w-full">
         <?php portaldoenvelhecimento_post_thumbnail(null, 'w-full max-full object-cover lg:aspect-16/6 aspect-video'); ?>
      </div>
      <div class="<?php echo $content_class ?> flex flex-col gap-2">
         <div class="flex gap-2.5">
            <?php
            $tags = get_the_tags();

            if ($tags)
            {
               $contador = 0;
               foreach ($tags as $tag)
               {
                  $contador++;
                  $tag_color = get_theme_mod('tag_color_' . $tag->term_id, '#2ecc71');
                  if ($contador <= 3)
                  {
                     echo '<a class="py-1 px-2 text-white text-xs hover:text-white" href="' . get_tag_link($tag->term_id) . '" style="background-color:' . $tag_color . '">' . $tag->name . '</a>';
                  }
               }
            }
            ?>
         </div>
         <header class="entry-header">
            <?php
            if (is_singular()) :
               the_title('<h1 class="' . $title_class . '">', '</h1>');
            else :
               the_title('<h2 class="' . $title_class . '"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
            endif;

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
               <a href="<?php echo get_author_posts_url($author_id); ?>" class="text-blue-500 block hover:underline">Veja todos os posts de <?php echo $author_name; ?></a>
            </div>
         </div>
      </div>

      <div>
         <?php
         $current_post_id = get_the_ID();

         // Obtém as tags do post atual
         $tags = wp_get_post_tags($current_post_id);

         if ($tags)
         {
            $tag_ids = array();
            foreach ($tags as $tag)
            {
               $tag_ids[] = $tag->term_id;
            }

            $related_posts = get_posts(array(
               'tag__in' => $tag_ids,
               'post__not_in' => array($current_post_id),
               'posts_per_page' => 2,
               'orderby' => 'rand'
            ));
         }

         ?>

      </div>
   </div>
   <div>
      <h4 class="py-4 text-xl font-bold text-gray-800">
         <?php esc_html_e('Posts relacionados', 'portaldoenvelhecimento') ?>
      </h4>
      <div class="container p-0 m-0 grid gap-4 lg:grid-cols-2">
         <?php if ($related_posts) :
            foreach ($related_posts as $post) :
               $thumbnail_url = get_the_post_thumbnail_url($post->ID, 'thumbnail');
         ?>
               <div class="col-span-1 flex gap-4">
                  <div class="w-1/2">
                     <a href="<?php echo get_permalink($post->ID) ?>">
                        <img class="w-full object-cover h-[7.5rem]" src="<?php echo $thumbnail_url ?>" class="w-full">
                     </a>
                  </div>
                  <div class="w-1/2">
                     <a href="<?php echo get_permalink($post->ID) ?>">
                        <h3 class="text-sm font-medium"><?php echo $post->post_title; ?></h3>
                     </a>
                     <?php
                     if ('post' === get_post_type()) :
                     ?>
                        <div class="entry-meta mt-2">
                           <?php
                           portaldoenvelhecimento_posted_on();
                           // portaldoenvelhecimento_posted_by();
                           ?>
                        </div><!-- .entry-meta -->
                     <?php endif; ?>
                  </div>
               </div>
         <?php endforeach;
         endif; ?>
      </div>
   </div>

</article><!-- #post-<?php the_ID(); ?> -->
