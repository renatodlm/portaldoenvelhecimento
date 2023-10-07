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

<body <?php body_class('overflow-x-hidden'); ?>>
   <?php wp_body_open(); ?>
   <header class="lg:border-none border-b border-gray-800">

      <div class="flex flex-col" x-data="menuHeader">

         <div class="container flex gap-[6.25rem] items-center py-4 lg:py-8">
            <?php the_custom_logo() ?>
            <div class="ads flex-1 lg:flex justify-end items-center hidden">
               <?php dynamic_sidebar('sidebar-2')
               ?>
            </div>
            <button x-on:click="showMenuMobile = true" class="lg:hidden flex items-center justify-center w-8 h-8 ml-auto text-gray-900">
               <?php render_svg('hamburger') ?>
            </button>
         </div>
         <div x-bind:class="{'-mr-[100vw]':!showMenuMobile}" class="menu-primary-container bg-neutral-500 uppercase lg:flex lg:transition-none transition-all">
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
         </div>
      </div>
   </header>

   <ul class="lg:flex hidden flex-col space-y-2 w-fit fixed left-0 ml-1 top-1/2 -translate-y-1/2">
      <li class="p-1 bg-white border border-gray-800">
         <a href="https://www.facebook.com/portaldoenvelhecimento" class="text-gray-800" target="_blank">
            <?php render_svg('facebook', 'w-6 h-6') ?>
         </a>
      </li>
      <li class="p-1 bg-white border border-gray-800">
         <a href="https://www.instagram.com/portaldoenvelhecimento/" class="text-gray-800" target="_blank">
            <?php render_svg('instagram', 'w-6 h-6') ?>
         </a>
      </li>
      <li class="p-1 bg-white border border-gray-800">
         <a href="https://www.youtube.com/channel/UCUdVNLrCWEY6HuweJUo3Dpg" class="text-gray-800" target="_blank">
            <?php render_svg('youtube', 'w-6 h-6') ?>
         </a>
      </li>
      <li class="p-1 bg-white border border-gray-800">
         <a href="https://www.linkedin.com/company/portaldoenvelhecimento/" class="text-gray-800" target="_blank">
            <?php render_svg('linkedin', 'w-6 h-6') ?>
         </a>
      </li>
   </ul>
