<div class="w-full lg:w-[17.5rem] bg-gray-100 h-fit flex flex-col divide-y divide-gray-400">
   <div class="">
      <div class="py-5 px-4">
         <h5 class="font-semibold text-base text-gray-800 mb-6">
            <?php esc_html_e('Você também pode gostar...') ?>
         </h5>
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
                        <img class="w-full object-cover max-h-[2.5rem]" src="<?php echo $thumbnail_url ?>" class="w-full">
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
   </div>
   <div class=" flex flex-col gap-6 divide-y divide-gray-400">
      <?php
      dynamic_sidebar('newsletter-1')
      ?>
      <form action="" class="flex flex-col gap-3 px-4 py-5">
         <h5 class="font-semibold text-lg text-gray-800">
            <?php esc_html_e('Newsletter', 'portaldoenvelhecimento') ?>
         </h5>
         <p class="m-0 italic text-gray-800 text-sm">
            <?php
            esc_html_e('Cadastre-se e receba o conteúdo mais atualizado sobre o envelhecimento em seu e-mail!', 'portaldoenvelhecimento') ?>
         </p>
         <input name="newsletter-email" type="email" placeholder="Endereço de e-mail" required>
         <p class="m-0 italic text-gray-500 text-xs">
            <?php
            esc_html_e('Ao se cadastrar você está concordando com os termos e em receber informações sobre a nossa programação de cursos e lançamentos.', 'portaldoenvelhecimento')
            ?>
         </p>
         <button class="bg-yellow-400 py-2 px-4 uppercase font-medium text-base text-black" type="submit">
            <?php esc_html_e('QUERO ME CADASTRAR!', 'portaldoenvelhecimento') ?>
         </button>
      </form>
   </div>
   <div class="">
      <div class="py-5 px-4">
         <h5 class="font-semibold text-lg mb-3 text-gray-800">
            <?php esc_html_e('Categorias', 'portaldoenvelhecimento') ?>
         </h5>
         <ul class="flex flex-col divide-y divide-gray-100">
            <?php
            $categories = get_categories();

            foreach ($categories as $category)
            {
            ?>

               <li class="w-full text-sm font-medium py-2">
                  <a href="<?php echo get_category_link($category->term_id) ?>">
                     <?php echo  $category->name  ?>
                  </a>
               </li>
            <?php
            }
            ?>
         </ul>
      </div>
   </div>
   <div class=" flex flex-col gap-6 divide-y divide-gray-400">
      <?php
      dynamic_sidebar('sidebar-1')
      ?>
   </div>
</div>
