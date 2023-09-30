<?php

function show_excerpt($limit = 120, $final = '...')
{
   $excerpt = apply_filters('the_excerpt', get_the_excerpt());
   $excerpt = mb_strimwidth($excerpt, 0, $limit, $final);

   return $excerpt;
}
