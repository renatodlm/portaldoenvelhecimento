<div class="flex gap-2 items-center ml-auto">
   <h2 class="text-base uppercase font-semibold"><?php esc_html_e('Compartilhe com:', 'portaldoenvelhecimento') ?></h2>
   <ul class="flex gap-2 items-center">
      <li class="py-1 px-4 bg-[#60D669] text-white">
         <a href="https://api.whatsapp.com/send?text=<?php echo get_the_title() ?> : <?php echo get_permalink() ?>" target="_blank" class="text-sm flex items-center space-x-2 hover:text-white">
            <?php render_svg('whatsapp', 'w-6 h-6') ?>
            <span><?php esc_html_e('Whatsapp') ?></span>
         </a>
      </li>
      <li class="py-1 px-4 bg-[#1877F2] text-white">
         <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink() ?>" target="_blank" class="text-sm flex items-center space-x-2 hover:text-white">
            <?php render_svg('facebook', 'w-6 h-6') ?>
            <span><?php esc_html_e('Facebook') ?></span>
         </a>
      </li>
      <li class="py-1 px-4 text-white bg-gray-800">
         <a href="mailto:?subject=<?php echo get_the_title() ?>&body=<?php echo get_permalink() ?>" target="_blank" class="text-sm flex items-center space-x-2 hover:text-white">
            <?php render_svg('mail', 'w-6 h-6') ?>
            <span><?php esc_html_e('E-mail') ?></span>
         </a>
      </li>
   </ul>
</div>
