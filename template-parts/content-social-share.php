<div class="max-w-md flex gap-2 items-center bg-white my-6">
   <h2 class="text-xl font-semibold"><?php esc_html_e('Compartilhe', 'portaldoenvelhecimento') ?></h2>
   <ul class="flex gap-2 items-center">
      <li class="p-1 bg-white border border-gray-800">
         <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink() ?>" target="_blank" class="flex items-center space-x-2">
            <?php render_svg('facebook', 'w-6 h-6') ?>
         </a>
      </li>
      <li class="p-1 bg-white border border-gray-800">
         <a href="mailto:?subject=<?php echo get_the_title() ?>&body=<?php echo get_permalink() ?>" target="_blank" class="flex items-center space-x-2">
            <?php render_svg('mail', 'w-6 h-6') ?>
         </a>
      </li>
      <li class="p-1 bg-white border border-gray-800">
         <a href="https://api.whatsapp.com/send?text=<?php echo get_the_title() ?> : <?php echo get_permalink() ?>" target="_blank" class="flex items-center space-x-2">
            <?php render_svg('whatsapp', 'w-6 h-6') ?>
         </a>
      </li>
   </ul>
</div>
