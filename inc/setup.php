<?php

if (!function_exists('sanitize_hex_color'))
{
   function sanitize_hex_color($color)
   {
      if ($color === '') return '';
      if (false === strpos($color, '#')) return '';
      if (1 === preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $color)) return $color;
      return '';
   }
}

function show_excerpt($limit = 120, $final = '...')
{
   $excerpt = apply_filters('the_excerpt', get_the_excerpt());
   $excerpt = mb_strimwidth($excerpt, 0, $limit, $final);

   return $excerpt;
}

function register_category_colors_customizer($wp_customize)
{
   $wp_customize->add_section('category_colors_section', array(
      'title' => __('Cores da Categoria', 'text-domain'),
      'priority' => 30,
   ));

   $categories = get_categories();

   foreach ($categories as $category)
   {
      $wp_customize->add_setting('category_color_' . $category->term_id, array(
         'default' => '#2ecc71',
         'sanitize_callback' => 'sanitize_hex_color',
      ));

      $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'category_color_' . $category->term_id, array(
         'label' => $category->name,
         'section' => 'category_colors_section',
         'settings' => 'category_color_' . $category->term_id,
      )));
   }
}
add_action('customize_register', 'register_category_colors_customizer');

function register_tag_colors_customizer($wp_customize)
{
   $wp_customize->add_section('tag_colors_section', array(
      'title' => __('Cores das Tags', 'text-domain'),
      'priority' => 30,
   ));

   $tags = get_tags();

   foreach ($tags as $tag)
   {
      $wp_customize->add_setting('tag_color_' . $tag->term_id, array(
         'default' => '#2ecc71',
         'sanitize_callback' => 'sanitize_hex_color',
      ));

      $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'tag_color_' . $tag->term_id, array(
         'label' => $tag->name,
         'section' => 'tag_colors_section',
         'settings' => 'tag_color_' . $tag->term_id,
      )));
   }
}
add_action('customize_register', 'register_tag_colors_customizer');
class Advertisement_Widget extends WP_Widget
{

   public function __construct()
   {
      parent::__construct(
         'advertisement_widget',
         'TG: Advertisement',
         array('description' => 'Widget para exibir anúncios com título, imagem e link.')
      );
   }

   public function widget($args, $instance)
   {
      $title = apply_filters('widget_title', $instance['title']);
      $image = $instance['image'];
      $link = $instance['link'];
      $size = $instance['size'];

      echo $args['before_widget'];
      if (!empty($title))
      {
         echo $args['before_title'] . $title . $args['after_title'];
      }
?>
      <div class="advertisement_<?php echo $size; ?>">
         <div class="advertisement-title">
         </div>
         <div class="advertisement-content">
            <a href="<?php echo $link; ?>" class="single_ad_<?php echo $size; ?>" target="_blank" rel="nofollow">
               <img src="<?php echo $image; ?>" width="<?php echo $this->get_size_width($size); ?>" height="<?php echo $this->get_size_height($size); ?>">
            </a>
         </div>
      </div>
   <?php
      echo $args['after_widget'];
   }

   public function form($instance)
   {
      $title = isset($instance['title']) ? $instance['title'] : '';
      $image = isset($instance['image']) ? $instance['image'] : '';
      $link = isset($instance['link']) ? $instance['link'] : '';
      $size = isset($instance['size']) ? $instance['size'] : '728x90';
   ?>
      <p>
         <label for="<?php echo $this->get_field_id('title'); ?>">Título:</label>
         <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
      </p>
      <p>
         <label for="<?php echo $this->get_field_id('image'); ?>">Imagem:</label>
      <div class="media-upload-container">
         <div class="media-upload-wrapper">
            <img class="custom_media_image" src="<?php echo esc_url($image); ?>" style="max-width: 100%; height: auto; display: block;" />
            <input type="hidden" class="widefat custom_media_url" name="<?php echo $this->get_field_name('image'); ?>" value="<?php echo esc_url($image); ?>">
            <button type="button" class="button custom_media_upload">Selecionar Imagem</button>
            <button type="button" class="button custom_media_remove">Remover Imagem</button>
         </div>
      </div>
      </p>
      <p>
         <label for="<?php echo $this->get_field_id('link'); ?>">URL do Link:</label>
         <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo esc_attr($link); ?>">
      </p>
      <p>
         <label for="<?php echo $this->get_field_id('size'); ?>">Tamanho:</label>
         <select id="<?php echo $this->get_field_id('size'); ?>" name="<?php echo $this->get_field_name('size'); ?>">
            <option value="728x90" <?php selected($size, '728x90'); ?>>728x90</option>
            <option value="300x250" <?php selected($size, '300x250'); ?>>300x250</option>
            <option value="125x125" <?php selected($size, '125x125'); ?>>125x125</option>
         </select>
      </p>
<?php
   }

   public function update($new_instance, $old_instance)
   {
      $instance = array();
      $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
      $instance['image'] = (!empty($new_instance['image'])) ? strip_tags($new_instance['image']) : '';
      $instance['link'] = (!empty($new_instance['link'])) ? strip_tags($new_instance['link']) : '';
      $instance['size'] = (!empty($new_instance['size'])) ? strip_tags($new_instance['size']) : '728x90';
      return $instance;
   }

   private function get_size_width($size)
   {
      switch ($size)
      {
         case '728x90':
            return 728;
         case '300x250':
            return 300;
         case '125x125':
            return 125;
         default:
            return 728;
      }
   }

   private function get_size_height($size)
   {
      switch ($size)
      {
         case '728x90':
            return 90;
         case '300x250':
            return 250;
         case '125x125':
            return 125;
         default:
            return 90;
      }
   }
}

function register_advertisement_widget()
{
   register_widget('Advertisement_Widget');
}

add_action('widgets_init', 'register_advertisement_widget');
