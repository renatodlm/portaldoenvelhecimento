<?php

function custom_excerpt_filter($excerpt)
{
   $limite = 120;
   $excerpt = mb_strimwidth($excerpt, 0, $limite, '...');

   $excerpt = str_replace('[...]', '...', $excerpt);

   return $excerpt;
}

add_filter('the_excerpt', 'custom_excerpt_filter');
