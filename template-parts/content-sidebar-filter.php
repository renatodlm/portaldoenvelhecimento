<?php

$current_category_page = '';
if (is_category())
{
   $current_category_page = get_queried_object();
}

?>
<div class="w-full lg:w-[23.75rem] h-fit flex flex-col divide-y divide-gray-400">
   <div class="py-5 px-4">
      <h5 class="font-semibold text-lg mb-3 uppercase text-gray-800">
         <?php esc_html_e('Tags', 'portaldoenvelhecimento') ?>
      </h5>
      <ul class="inline-block space-y-2 space-x-1">
         <?php
         $tags = get_the_tags();

         if ($tags)
         {
            $contador = 0;
            foreach ($tags as $tag)
            {
               $contador++;
               $tag_color = get_theme_mod('tag_color_' . $tag->term_id, '#2ecc71');

         ?>
               <li class="text-sm inline-block">
                  <a class="py-1 px-2 bg-blue-500 text-white text-xs hover:text-white focus:text-white" href="<?php echo get_tag_link($tag->term_id) ?>" style="background-color:<?php echo $tag_color ?>"><?php echo $tag->name ?></a>
               </li>
         <?php

            }
         }
         ?>
      </ul>
   </div>
   <div class="py-5 px-4">
      <h5 class="font-semibold text-lg mb-3 uppercase text-gray-800">
         <?php esc_html_e('Categorias', 'portaldoenvelhecimento') ?>
      </h5>
      <ul class="flex flex-col divide-y divide-gray-100">
         <?php

         $categories = get_categories();

         foreach ($categories as $category)
         {
            if (is_category())
            {
               $class_active = $current_category_page->name === $category->name ? 'text-blue-500 font-semibold' : '';
            }
         ?>

            <li class="w-full text-sm py-2">
               <a class="<?php echo $class_active; ?>" href="<?php echo get_category_link($category->term_id) ?>">
                  <?php echo  $category->name  ?>
               </a>
            </li>
         <?php
         }
         ?>
      </ul>
   </div>
   <?php

   if (is_category())
   {
      $current_category = get_queried_object();
      $categories = get_categories(array(
         'parent' => $current_category->term_id,
         'hide_empty' => false
      ));

      if (!empty($categories))
      {
   ?>
         <div class="py-5 px-4">
            <h5 class="font-semibold text-lg mb-3 uppercase text-gray-800">
               <?php esc_html_e('Subcategorias', 'portaldoenvelhecimento') ?>
            </h5>
            <ul class="flex flex-col divide-y divide-gray-100">
               <?php

               foreach ($categories as $category)
               {
               ?>

                  <li class="w-full text-sm py-2">
                     <a href="<?php echo get_category_link($category->term_id) ?>">
                        <?php echo $category->name  ?>
                     </a>
                  </li>
               <?php
               }
               ?>
            </ul>
         </div>
   <?php }
   } ?>
   <!-- <div class="py-5 px-4">
      <?php
      //get_sidebar('sidebar-1')
      ?>
   </div> -->
   <div class="py-5 px-4">
      <a class="py-2 px-4 bg-red-600 text-white hover:text-white focus:text-white" href="<?php echo home_url(); ?>">
         <?php esc_html_e('Leia mais', 'portaldoenvelhecimento') ?>
      </a>
   </div>
</div>
