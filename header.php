<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package portaldoenvelhecimento
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
   <meta charset="<?php bloginfo('charset'); ?>">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="profile" href="https://gmpg.org/xfn/11">

   <?php wp_head(); ?>
</head>

<body x-data="{ scrolled: false }" <?php body_class('overflow-x-hidden'); ?>>
   <?php wp_body_open(); ?>
   <div class="container py-2 flex items-center justify-between relative" x-bind:class="{'h-[146px]':scrolled}">
      <div></div>
      <div x-data="{userMenu: false}" class="flex gap-4 items-center divide-x divide-gray-400">
         <ul class="flex space-x-4 w-fit">
            <li class="">
               <a href="https://www.facebook.com/portaldoenvelhecimento" class="text-gray-800" target="_blank">
                  <?php render_svg('facebook', 'w-5 h-5') ?>
               </a>
            </li>
            <li class="">
               <a href="https://www.instagram.com/portaldoenvelhecimento/" class="text-gray-800" target="_blank">
                  <?php render_svg('instagram', 'w-5 h-5') ?>
               </a>
            </li>
            <li class="">
               <a href="https://www.youtube.com/channel/UCUdVNLrCWEY6HuweJUo3Dpg" class="text-gray-800" target="_blank">
                  <?php render_svg('youtube', 'w-5 h-5') ?>
               </a>
            </li>
            <li class="">
               <a href="https://www.linkedin.com/company/portaldoenvelhecimento/" class="text-gray-800" target="_blank">
                  <?php render_svg('linkedin', 'w-5 h-5') ?>
               </a>
            </li>
         </ul>
         <div class="pl-4 relative">
            <?php if (is_user_logged_in()) : ?>
               <button class="flex gap-2 items-center px-2 py-1 text-gray-800 text-sm font-semibold" href="<?php wp_login_url() ?>" @click="userMenu = !userMenu">
                  <span x-show="!userMenu">
                     <?php render_svg('user', 'w-4 h-4'); ?>
                  </span>
                  <span x-show="userMenu" x-cloak>
                     <?php render_svg('close', 'w-4 h-4'); ?>
                  </span>
                  <?php

                  esc_html_e('Olá, ', 'portaldoenvelhecimento');
                  $user_id = get_current_user_id();
                  $current_user = wp_get_current_user();
                  $user_name = get_user_meta($user_id, 'first_name', true);

                  if (empty($user_name))
                  {
                     $user_name = $current_user->display_name;
                     $user_name = explode(' ', $user_name)[0];
                  }

                  echo esc_html($user_name);

                  ?>
               </button>
               <div class="absolute right-0 top-[calc(100%+0.5rem)] w-[calc(100%-1.25rem)] text-center bg-red-600 shadow z-40" x-cloak x-show="userMenu">
                  <a class="block px-4 py-2 text-white hover:text-white focus:text-white" href="<?php echo wp_logout_url() ?>"><?php esc_html_e('Sair', 'portaldoenvelhecimento'); ?></a>
               </div>
            <?php else : ?>
               <a class="flex gap-2 items-center px-2 py-1 text-gray-800 text-sm font-semibold hover:text-gray-400" href="<?php echo wp_login_url() ?>">
                  <?php

                  render_svg('lock', 'w-4 h-4');
                  esc_html_e('Entrar', 'portaldoenvelhecimento');

                  ?>
               </a>
            <?php endif; ?>
         </div>
      </div>

   </div>
   <header class="lg:border-none border-b border-gray-800 bg-[#2B86BB] z-[9999] w-full" x-on:scroll.window="scrolled = (window.scrollY > 146)" :class="{ 'fixed top-0 bg-white shadow-lg': scrolled, '': !scrolled }">

      <div class="flex flex-col" x-data="menuHeader">

         <div class="container flex justify-between gap-[3.125rem] items-center py-4">
            <?php the_custom_logo() ?>
            <button x-on:click="showMenuMobile = true" class="lg:hidden flex items-center justify-center w-8 h-8 ml-auto text-white">
               <?php render_svg('hamburger') ?>
            </button>
            <div x-data="{searchOpen: false}" x-bind:class="{'-mr-[100vw]':!showMenuMobile}" class="relative menu-primary-container uppercase lg:flex lg:transition-none transition-all items-center">
               <button x-on:click="showMenuMobile = false" class="lg:hidden absolute right-4 top-8 flex items-center justify-center w-8 h-8  ml-auto text-white">
                  <?php render_svg('close') ?>
               </button>
               <div class="container lg:mt-0 mt-4">
                  <?php
                  wp_nav_menu([
                     'theme_location'  => 'menu-1',
                     'container_class' => '',
                     'container'       => 'nav',
                     'menu_class'      => 'menu-primary'
                  ]);
                  ?>
               </div>
               <button x-show="!searchOpen" class="lg:block hidden w-6 h-6 flex justify-center items-center ml-4 relative" @click="searchOpen=true">
                  <?php render_svg('search') ?>
               </button>
               <button x-show="searchOpen" class="hidden w-6 h-6 lg:flex justify-center items-center ml-4 relative text-white" @click="searchOpen=false" x-cloak>
                  <?php render_svg('close') ?>
               </button>
               <div class="absolute right-0 top-full min-w-[10rem] bg-red-600 p-2 shadow mt-2 hidden" x-bind:class="{'hidden': !searchOpen}">
                  <?php get_search_form() ?>
               </div>
               <a class="mx-auto block w-fit lg:ml-6 bg-red-600 text-whitep py-2 px-4 text-xs font-semibold text-white hover:text-white focus:text-white" href="<?php echo home_url('newsletter') ?>"><?php esc_html_e('NEWSLETTER', 'portaldoenvelhecimento') ?></a>
            </div>

         </div>
      </div>
   </header>
   <div class="ads">
      <div class="flex justify-center items-center container">
         <?php

         dynamic_sidebar('sidebar-2')

         ?>
      </div>
   </div>
