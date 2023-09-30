<div class="w-[17.5rem] bg-[#D9D9D9] rounded-lg p-4 h-fit">
   <?php //get_sidebar('sidebar-1')
   ?>
   <div>
      <h5><?php esc_html_e('Você também pode gostar...') ?></h5>
      <?php
      $posts = get_posts(array(
         'numberposts' => 3
      ));

      if ($posts)
      { ?>
         <div class="flex flex-col gap-4">
            <?php
            foreach ($posts as $post)
            {
               $thumbnail_url = get_the_post_thumbnail_url($post->ID, 'thumbnail');
               $title = $post->post_title;
            ?>
               <a class="flex gap-3" href="<?php echo get_permalink($post->ID) ?>">
                  <div class="w-[4.1875rem]">
                     <img class="w-full rounded-md object-cover max-h-[2.5rem]" src="<?php echo $thumbnail_url ?>" class="w-full">
                  </div>
                  <div class="flex-1">
                     <h3 class="text-xs"><?php echo $title ?></h3>
                  </div>
               </a>
            <?php
            }
            ?>
         </div>
      <?php
         wp_reset_postdata();
      }
      ?>

   </div>
   <div>
      <h5><?php esc_html_e('Newsletter semanal', 'portaldoenvelhecimento') ?></h5>
   </div>
   <div>
      <h5><?php esc_html_e('Categorias', 'portaldoenvelhecimento') ?></h5>
   </div>
</div>
