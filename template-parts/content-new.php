<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portaldoenvelhecimento
 */

$thumb_class     =  'w-full lg:w-[18.75rem] lg:h-[11.25rem] thumb-h-full max-w-full lg:aspect-auto aspect-video';
$content_class   =  'flex-1';
$title_class     =  'text-base font-medium';
$container_class =  '';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('col-span-1'); ?>>

   <div class="flex flex-col gap-y-4 items-center <?php echo $container_class ?>">
      <?php
      if (has_post_thumbnail())
      {
      ?>
         <div class="portaldoenvelhecimento-post-thumbnail <?php echo $thumb_class ?>">
            <?php portaldoenvelhecimento_post_thumbnail(); ?>
         </div>
      <?php
      }

      ?>
      <div class="<?php echo $content_class ?> flex flex-col gap-2">
         <div class="flex gap-2.5">
            <?php
            tags_in_posts(2)
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
                  portaldoenvelhecimento_posted_on('text-gray-400 uppercase text-[0.625rem]');
                  // portaldoenvelhecimento_posted_by();
                  ?>
               </div><!-- .entry-meta -->
            <?php endif; ?>
         </header><!-- .entry-header -->


         <div class="entry-content text-gray-600 text-sm entry-content-new">
            <?php
            echo show_excerpt(60);
            ?>
         </div><!-- .entry-content -->
      </div>
   </div>

</article><!-- #post-<?php the_ID(); ?> -->
