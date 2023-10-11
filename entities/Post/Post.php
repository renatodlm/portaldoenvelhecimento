<?php

if (!defined('ABSPATH'))
{
   exit;
}

class PE_Post extends PE_Singular
{
   public function hide_post_thumbnail()
   {
      return function_exists('get_field') && (bool) get_field('hide_single_thumbnail');
   }

   public function get_related_posts_ID($numberposts = 4)
   {
      $related_posts_ID = [];

      $category_ID = $this->get_category_ID();

      if (!empty($category_ID))
      {
         $related_posts_ID = PE_Singular_Utils::get_posts([
            'numberposts'  => $numberposts,
            'post__not_in' => [$this->get_ID()],
            'tax_query'    => [
               [
                  'taxonomy'         => 'category',
                  'field'            => 'term_id',
                  'terms'            => $category_ID,
                  'include_children' => false
               ],
            ],
         ]);
      }

      return $related_posts_ID;
   }
}
