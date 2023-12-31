<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package portaldoenvelhecimento
 */

$current_year = wp_date('Y');
?>

<footer class="bg-neutral-700">
   <div class="container">
      <div class="py-12">
         <div class="lg:grid lg:flex-row flex-col lg:grid-cols-2 xl:grid-cols-5">
            <div class="col-span-1 xl:col-span-2 px-4 lg:mb-0 mb-8 flex flex-col gap-8">
               <div class="lg:text-left text-center">
                  <h4 class="text-white text-xl font-bold mb-5 uppercase lg:text-left text-center">
                     <?php esc_html_e('Sobre Nós', 'portaldoenvelhecimento') ?>
                  </h4>
                  <div class="mb-3">
                     <?php the_custom_logo() ?>
                  </div>
                  <p class="text-gray-300 leading-tight text-sm">
                     <?php esc_html_e('Somos profissionais de diversas áreas e oriundos de diversas regiões do Brasil e de outros países, todos estudiosos do processo de envelhecimento na perspectiva do ser que envelhece e não unicamente que adoece. Esta nossa filosofia e “atitude” frente ao envelhecimento é o pressuposto para o desenvolvimento da contínua construção de uma “Cultura da Longevidade”.', 'portaldoenvelhecimento') ?>
                  </p>
               </div>
            </div>
            <div class="col-span-1 px-4 lg:mb-0 mb-8 flex flex-col gap-8">
               <div>
                  <h4 class="text-white text-xl font-bold mb-5 uppercase lg:text-left text-center">
                     <?php esc_html_e('Menu', 'portaldoenvelhecimento') ?>
                  </h4>
                  <div class="footer-menu-primary">
                     <?php
                     wp_nav_menu([
                        'theme_location'  => 'footer',
                        'container_class' => '',
                        'container'       => 'nav',
                        'menu_class'      => 'menu-primary'
                     ]);
                     ?>
                  </div>
               </div>
               <div class="lg:text-left text-center">
                  <h4 class="text-white text-xl font-bold mb-5 uppercase lg:text-left text-center">
                     <?php esc_html_e('Arquivos', 'portaldoenvelhecimento') ?>
                  </h4>
                  <select name="archive-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
                     <option value=""><?php echo esc_attr(__('Selecione o Mês')); ?></option>
                     <?php wp_get_archives('type=monthly&format=option&show_post_count=1'); ?>
                  </select>
               </div>
            </div>
            <div class="col-span-2 px-4 flex flex-col gap-8">
               <div>
                  <h4 class="text-white text-xl font-bold mb-5 uppercase lg:text-left text-center">Contatos</h4>
                  <ul class="footer-contacts-ul divide-y divide-gray-500 text-gray-300 text-sm">
                     <li class="py-2">São Paulo | Brasil</li>
                     <li class="py-2">Fone: <a href="tel:+55 (11) 2579-9697">+55 (11) 2579-9697</a></li>
                     <li class="py-2">Fone: <a href="tel:+55 (11) 5587-4334">+55 (11) 5587-4334</a></li>
                     <li class="py-2"><a href="https://maps.app.goo.gl/FButqVkPzj1PbnpD6" target="_blank">Avenida Pedro Severino Júnior, 366 Sala 166 Vila Guarani.</a></li>
                     <li class="py-2 !border-none">Cep: 04310-060</li>
                     <li class="py-2">E-mail: <a href="mailto:contato@portaldoenvelhecimento.com.br">contato@portaldoenvelhecimento.com.br</a></li>
                     <li class="py-2">Website: <a href="portaldoenvelhecimento.com.br">portaldoenvelhecimento.com.br</a></li>
                  </ul>
               </div>
               <div class="lg:text-left text-center">
                  <h4 class="text-white text-xl font-bold mb-5 uppercase lg:text-left text-center">
                     <?php esc_html_e('Redes sociais', 'portaldoenvelhecimento') ?>
                  </h4>
                  <ul class="flex space-x-4 lg:mx-0 mx-auto w-fit">
                     <li target="_blank">
                        <a class="text-white" href="https://www.facebook.com/portaldoenvelhecimento" class="text-gray-800">
                           <?php render_svg('facebook', 'w-6 h-6') ?>
                        </a>
                     </li>
                     <li>
                        <a class="text-white" href="https://www.instagram.com/portaldoenvelhecimento/" class="text-gray-800" target="_blank">
                           <?php render_svg('instagram', 'w-6 h-6') ?>
                        </a>
                     </li>
                     <li>
                        <a class="text-white" href="https://www.youtube.com/channel/UCUdVNLrCWEY6HuweJUo3Dpg" class="text-gray-800" target="_blank">
                           <?php render_svg('youtube', 'w-6 h-6') ?>
                        </a>
                     </li>
                     <li>
                        <a class="text-white" href="https://www.linkedin.com/company/portaldoenvelhecimento/" class="text-gray-800" target="_blank">
                           <?php render_svg('linkedin', 'w-6 h-6') ?>
                        </a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="bg-neutral-800 py-4">
      <div class="container flex gap-3 lg:gap-6 items-center lg:text-left lg:justify-between flex-wrap justify-center text-center">
         <div>
            <p class="text-gray-300 m-0">Copyright © <span><?php echo $current_year ?></span> <?php esc_html_e('Portal do Envelhecimento. Todos os direitos reservados.', 'portaldoenvelhecimento') ?></p>
         </div>
         <div class="flex flex-col gap-x-3">
            <div class="subfooter-menu-primary">
               <?php
               wp_nav_menu([
                  'theme_location'  => 'institutional',
                  'container_class' => '',
                  'container'       => 'nav',
                  'menu_class'      => 'menu-primary'
               ]);
               ?>
            </div>
         </div>
      </div>
   </div>
</footer>

<?php
wp_footer(); ?>

</body>

</html>
