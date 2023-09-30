<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portaldoenvelhecimento
 */

$index = $args['index'] ?? false;
$thumb_class = $index === 0 ? 'w-1/2 max-w-full h-[19.625rem] thumb-h-full' : 'w-[18.75rem] h-[11.25rem] thumb-h-full max-w-full';
$content_class = $index === 0 ? 'flex-1' : 'flex-1';
$title_class = $index === 0 ? 'text-4xl font-medium' : 'text-2xl font-medium';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

   <div class="flex gap-10 items-center">
      <div class="portaldoenvelhecimento-post-thumbnail <?php echo $thumb_class ?>">
         <?php portaldoenvelhecimento_post_thumbnail(); ?>
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
                  if ($contador <= 3)
                  {
                     echo '<a class="py-1 px-2 bg-blue-500 rounded-md text-white text-xs hover:text-white" href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>';
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
            the_excerpt();
            ?>
         </div><!-- .entry-content -->
      </div>
   </div>

</article><!-- #post-<?php the_ID(); ?> -->
