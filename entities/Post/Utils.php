<?php

if (!defined('ABSPATH'))
{
   exit;
}

class PE_Singular_Utils
{
   public static function get_posts($custom_args = [])
   {
      $default_args = [
         'post_type'   => 'post',
         'numberposts' => get_option('posts_per_page', 8),
         'fields'      => 'ids',
      ];

      return get_posts(wp_parse_args($custom_args, $default_args));
   }
}
