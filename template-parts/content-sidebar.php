<div class="w-full lg:w-[23.75rem]  h-fit flex flex-col divide-y divide-gray-400">
   <div class="">
      <div class="pb-5 px-4">
         <h5 class="font-bold text-lg text-gray-800 mb-6 uppercase">
            <?php esc_html_e('Mais lidas') ?>
         </h5>
         <?php
         $posts = get_posts(array(
            'numberposts' => 3,
            'category_name' => 'mais-lida',
            'orderby' => 'date',
            'order' => 'DESC'
         ));

         if ($posts)
         { ?>
            <div class="flex flex-col gap-4">
               <?php
               foreach ($posts as $post)
               {
                  $thumbnail_url = get_the_post_thumbnail_url($post->ID, 'post-thumbnail');
                  $title = $post->post_title;
               ?>
                  <div class="flex gap-4">
                     <div class="w-2/5">
                        <a class="flex gap-3" href="<?php echo get_permalink($post->ID) ?>">
                           <img class="w-full object-cover aspect-video" src="<?php echo $thumbnail_url ?>" class="w-full">
                        </a>
                     </div>
                     <div class="flex-1">
                        <a class="flex gap-3 mb-1" href="<?php echo get_permalink($post->ID) ?>">
                           <h3 class="text-sm font-semibold"><?php echo $title ?></h3>
                        </a>
                        <?php portaldoenvelhecimento_posted_on('text-gray-400 text-[0.625rem]'); ?>
                     </div>
                  </div>
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
      /*
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
      <?php */ ?>
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
   <div class="">
      <div class="py-5 px-4">
         <h5 class="font-bold text-lg text-gray-800 mb-6 uppercase">
            <?php esc_html_e('Revista') ?>
         </h5>
         <?php
         $posts = get_posts(array(
            'numberposts' => 6,
            'tag_slug__in' => array('revista'),
            'orderby' => 'date',
            'order' => 'DESC'
         ));

         if ($posts)
         { ?>
            <div class="flex flex-col gap-4">
               <?php
               foreach ($posts as $key => $post)
               {
                  $thumbnail_url = get_the_post_thumbnail_url($post->ID, 'post-thumbnail');
                  $title = $post->post_title;

                  if ($key === 0)
                  {
               ?>
                     <div class="border-b border-gray-400 pb-3">
                        <a class="flex flex-col gap-3" href="<?php echo get_permalink($post->ID) ?>">
                           <div>
                              <img class="w-full object-cover aspect-video" src="<?php echo $thumbnail_url ?>" class="w-full">
                           </div>
                           <div>
                              <h3 class="text-base font-bold"><?php echo $title ?></h3>

                           </div>
                        </a>
                        <?php portaldoenvelhecimento_posted_on('text-gray-400 text-xs'); ?>
                     </div>
                  <?php
                  }
                  else
                  {
                  ?>
                     <div>
                        <a class="flex gap-3" href="<?php echo get_permalink($post->ID) ?>">
                           <div class="flex-1">
                              <h3 class="text-sm font-semibold"><?php echo $title ?></h3>
                           </div>
                        </a>
                        <?php portaldoenvelhecimento_posted_on('text-gray-400 text-xs'); ?>
                     </div>
               <?php
                  }
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
      dynamic_sidebar('sidebar-1')
      ?>
   </div>
</div>
