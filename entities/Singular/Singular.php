<?php

if (!defined('ABSPATH'))
{
   exit;
}

class PE_Singular
{
   protected $post;
   protected $ID = 0;

   public function __construct($post = null)
   {
      if (is_null($post))
      {
         $this->post = get_post();
      }
      elseif (is_numeric($post))
      {
         $this->post = get_post($post);
      }
      elseif (is_a($post, 'WP_Post'))
      {
         $this->post = $post;
      }

      $this->ID = (int) $this->post->ID;
   }

   public function get_ID()
   {
      return $this->ID;
   }

   public function get_link()
   {
      return get_permalink($this->post);
   }

   public function get_title()
   {
      return apply_filters('the_title', $this->post->post_title, $this->ID);
   }

   public function get_short_title()
   {
      if (function_exists('get_field') && !empty(get_field('short_title', $this->ID)))
      {
         return esc_html(get_field('short_title', $this->ID));
      }

      return $this->get_title();
   }

   public function has_excerpt()
   {
      return has_excerpt($this->ID);
   }

   public function get_excerpt($excerpt_size = 20)
   {
      if ($this->has_excerpt())
      {
         return get_the_excerpt($this->ID);
      }

      $content = get_the_content(null, false, $this->ID);

      return wp_trim_words(wp_strip_all_tags($content), (int) $excerpt_size, '...');
   }

   public function has_thumbnail()
   {
      return has_post_thumbnail($this->ID);
   }

   public function get_thumbnail($size = 'medium')
   {
      return get_the_post_thumbnail($this->ID, $size);
   }

   public function get_thumbnail_caption()
   {
      return get_the_post_thumbnail_caption($this->ID);
   }

   public function get_content()
   {
      return apply_filters('the_content', $this->post->post_content);
   }

   public function get_category_ID($category_id_context = 0)
   {
      if (!empty($category_id_context))
      {
         $category = get_category($category_id_context, false);
      }
      else
      {
         $category = get_category(get_query_var('cat', 0), false);
      }

      if (empty($category) || is_wp_error($category))
      {
         if (function_exists('yoast_get_primary_term_id') && !empty(yoast_get_primary_term_id('category', $this->ID)))
         {
            $first_post_category = get_category(yoast_get_primary_term_id('category', $this->ID));
         }
         else
         {
            $first_post_category = current(get_the_category($this->ID));
         }

         if (empty($first_post_category) || is_wp_error($first_post_category))
         {
            return;
         }

         return (int) $first_post_category->cat_ID;
      }

      $post_categories_arr = get_the_category($this->ID);

      foreach ($post_categories_arr as $post_category)
      {
         $post_category_id = $post_category->cat_ID;

         if ($category->cat_ID === $post_category_id || cat_is_ancestor_of($category->cat_ID, $post_category_id))
         {
            return (int) $post_category_id;
         }
      }

      return;
   }

   public function get_date($format = 'd M Y')
   {
      return get_the_date($format, $this->ID);
   }

   public function get_reading_time()
   {
      $word_count   = str_word_count(strip_tags(get_post_field('post_content', $this->ID)));
      $reading_time = ceil($word_count / 228);

      return sprintf(esc_html('%d min de leitura', 'bora-investir'), $reading_time);;
   }

   public function get_tags()
   {
      $post_tags = get_the_tags($this->ID);

      return !empty($post_tags) && !is_wp_error($post_tags) ? $post_tags : false;
   }

   public function get_share_buttons($nav_class = '', $title = null, $url = null)
   {
      return get_template_part('components/share-buttons', null, [
         'nav_class' => $nav_class,
         'title'     => rawurlencode($title ?? $this->get_title()),
         'url'       => esc_url($url ?? $this->get_link()),
      ]);
   }

   public function get_terms($taxonomy)
   {
      return get_the_terms($this->ID, $taxonomy);
   }
}
