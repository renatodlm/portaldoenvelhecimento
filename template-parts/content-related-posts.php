<?php

if (!defined('ABSPATH'))
{
   exit;
}

$current_post_id = !empty($args['posts_ID']) ? $args['posts_ID'] : get_the_ID();

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
<div class="my-6">

   <h4 class="mb-4 !text-sm !uppercase text-gray-800">
      <?php esc_html_e('Posts relacionados', 'portaldoenvelhecimento') ?>
   </h4>
   <div class="container p-0 m-0 grid gap-4 md:grid-cols-2">
      <?php if ($related_posts) :
         foreach ($related_posts as $post)
         {
            $thumbnail_url = get_the_post_thumbnail_url($post->ID, 'post-thumbnail');
            $title = $post->post_title;
      ?>
            <div class="col-span-1 flex gap-4">
               <div class="w-2/5">
                  <a class="flex gap-3" href="<?php echo get_permalink($post->ID) ?>">
                     <img class="w-full object-cover aspect-video" src="<?php echo $thumbnail_url ?>" class="w-full">
                  </a>
               </div>
               <div class="flex-1">
                  <a class="flex gap-3 mb-1" href="<?php echo get_permalink($post->ID) ?>">
                     <h3 class="!text-sm !font-semibold !text-gray-800"><?php echo $title ?></h3>
                  </a>
                  <?php portaldoenvelhecimento_posted_on('!text-gray-400 !text-[0.625rem]'); ?>
               </div>
            </div>
      <?php
         }
      endif;
      wp_reset_postdata();
      ?>
   </div>
</div>
