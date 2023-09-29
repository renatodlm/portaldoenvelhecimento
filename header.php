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

<body <?php body_class(); ?>>
   <?php wp_body_open(); ?>
   <header>

      <div class="flex flex-col">

         <div class="container flex gap-[6.25rem] items-center py-8">
            <?php the_custom_logo() ?>
            <div class="ads bg-gray-400 flex-1 h-[8.5625rem] flex justify-center items-center">
               Banner - Pub
            </div>
         </div>
         <div class="bg-neutral-500 py-3.5 uppercase">
            <div class="container">
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
