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

add_action('customize_register', 'register_category_colors_customizer');
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

add_action('customize_register', 'register_tag_colors_customizer');
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
      $sizes = explode('x', $size);
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
               <img src="<?php echo $image; ?>" width="<?php echo $this->get_size_width($size); ?>" height="<?php echo $this->get_size_height($size); ?>" style="width:<?php echo $sizes[0] ?>px!important;height:<?php echo $sizes[1] ?>px!important">
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

add_action('widgets_init', 'register_advertisement_widget');
function register_advertisement_widget()
{
   register_widget('Advertisement_Widget');
}


/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
add_action('after_setup_theme', 'portaldoenvelhecimento_setup');
function portaldoenvelhecimento_setup()
{
   /*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on portaldoenvelhecimento, use a find and replace
		* to change 'portaldoenvelhecimento' to the name of your theme in all the template files.
		*/
   load_theme_textdomain('portaldoenvelhecimento', get_template_directory() . '/languages');

   // Add default posts and comments RSS feed links to head.
   add_theme_support('automatic-feed-links');

   /*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
   add_theme_support('title-tag');

   /*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
   add_theme_support('post-thumbnails');

   // This theme uses wp_nav_menu() in one location.
   register_nav_menus(
      array(
         'menu-1'        => esc_html__('Primary', 'portaldoenvelhecimento'),
         'institutional' => esc_html__('Institutional', 'portaldoenvelhecimento'),
         'footer'        => esc_html__('Footer', 'portaldoenvelhecimento'),
      )
   );

   /*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
   add_theme_support(
      'html5',
      array(
         'search-form',
         'comment-form',
         'comment-list',
         'gallery',
         'caption',
         'style',
         'script',
      )
   );

   // Set up the WordPress core custom background feature.
   add_theme_support(
      'custom-background',
      apply_filters(
         'portaldoenvelhecimento_custom_background_args',
         array(
            'default-color' => 'ffffff',
            'default-image' => '',
         )
      )
   );

   // Add theme support for selective refresh for widgets.
   add_theme_support('customize-selective-refresh-widgets');

   /**
    * Add support for core custom logo.
    *
    * @link https://codex.wordpress.org/Theme_Logo
    */
   add_theme_support(
      'custom-logo',
      array(
         'height'      => 250,
         'width'       => 250,
         'flex-width'  => true,
         'flex-height' => true,
      )
   );
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
add_action('after_setup_theme', 'portaldoenvelhecimento_content_width', 0);
function portaldoenvelhecimento_content_width()
{
   $GLOBALS['content_width'] = apply_filters('portaldoenvelhecimento_content_width', 640);
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
add_action('widgets_init', 'portaldoenvelhecimento_widgets_init');
function portaldoenvelhecimento_widgets_init()
{
   register_sidebar(
      array(
         'name'          => esc_html__('Sidebar', 'portaldoenvelhecimento'),
         'id'            => 'sidebar-1',
         'description'   => esc_html__('Add widgets here.', 'portaldoenvelhecimento'),
         'before_widget' => '<section id="%1$s" class="py-5 px-4 widget %2$s">',
         'after_widget'  => '</section>',
         'before_title'  => '<h2 class="widget-title">',
         'after_title'   => '</h2>',
      )
   );
   register_sidebar(
      array(
         'name'          => esc_html__('Header ADS', 'portaldoenvelhecimento'),
         'id'            => 'sidebar-2',
         'description'   => esc_html__('Add widgets here.', 'portaldoenvelhecimento'),
         'before_widget' => '<section id="%1$s" class="py-5 px-4 widget %2$s">',
         'after_widget'  => '</section>',
         'before_title'  => '<h2 class="widget-title">',
         'after_title'   => '</h2>',
      )
   );
   register_sidebar(
      array(
         'name'          => esc_html__('Sidebar 3', 'portaldoenvelhecimento'),
         'id'            => 'sidebar-3',
         'description'   => esc_html__('Add widgets here.', 'portaldoenvelhecimento'),
         'before_widget' => '<section id="%1$s" class="py-5 px-4 widget %2$s">',
         'after_widget'  => '</section>',
         'before_title'  => '<h2 class="widget-title">',
         'after_title'   => '</h2>',
      )
   );
   register_sidebar(
      array(
         'name'          => esc_html__('Newsletter Sidebar', 'portaldoenvelhecimento'),
         'id'            => 'newsletter-1',
         // 'description'   => esc_html__('Add widgets here.', 'portaldoenvelhecimento'),
         'before_widget' => '<section id="%1$s" class="py-5 px-4 widget %2$s">',
         'after_widget'  => '</section>',
         'before_title'  => '<h2 class="widget-title">',
         'after_title'   => '</h2>',
      )
   );

   register_sidebar(
      array(
         'name'          => esc_html__('Newsletter Dentro do Post', 'portaldoenvelhecimento'),
         'id'            => 'newsletter-2',
         // 'description'   => esc_html__('Add widgets here.', 'portaldoenvelhecimento'),
         'before_widget' => '<section id="%1$s" class="py-5 px-4 widget %2$s">',
         'after_widget'  => '</section>',
         'before_title'  => '<h2 class="widget-title">',
         'after_title'   => '</h2>',
      )
   );

   $categories = get_categories();

   if (!empty($categories))
   {
      foreach ($categories as $category)
      {
         register_sidebar(
            array(
               'name'          => esc_html__('ADS para Categoria ' . $category->name, 'portaldoenvelhecimento'),
               'id'            => 'ads-' . $category->slug,
               'description'   => esc_html__('Coloque aqui apenas o ads correspondente a categoria ' . $category->name, 'portaldoenvelhecimento'),
               'before_widget' => '<section id="%1$s" class="py-5 px-4 widget %2$s">',
               'after_widget'  => '</section>',
               'before_title'  => '<h2 class="widget-title">',
               'after_title'   => '</h2>',
            )
         );
      }
   }
}

/**
 * Create Theme Options Page
 */
if (function_exists('acf_add_options_page'))
{
   $parent = acf_add_options_page(array(
      'page_title' => 'Opções do Tema',
      'menu_title' => 'Opções do Tema',
      'redirect'   => 'Opções do Tema',
      'menu_slug'  => 'theme-general-settings',
   ));
}

if (function_exists('acf_add_local_field_group')) :

   acf_add_local_field_group(array(
      'key' => 'group_65190494d23ff',
      'title' => 'Categorias Home',
      'fields' => array(
         array(
            'key' => 'field_6519049a7c103',
            'label' => 'Categorias Home',
            'name' => 'categorias_home',
            'type' => 'taxonomy',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
               'width' => '',
               'class' => '',
               'id' => '',
            ),
            'taxonomy' => 'category',
            'field_type' => 'multi_select',
            'allow_null' => 0,
            'add_term' => 1,
            'save_terms' => 0,
            'load_terms' => 0,
            'return_format' => 'object',
            'multiple' => 0,
         ),
      ),
      'location' => array(
         array(
            array(
               'param' => 'options_page',
               'operator' => '==',
               'value' => 'theme-general-settings',
            ),
         ),
      ),
      'menu_order' => 0,
      'position' => 'normal',
      'style' => 'default',
      'label_placement' => 'top',
      'instruction_placement' => 'label',
      'hide_on_screen' => '',
      'active' => true,
      'description' => '',
      'show_in_rest' => 0,
   ));

endif;


add_action('wp_footer', 'accessibility_button');
function accessibility_button()
{
   ?>
   <script src="https://cdn.assistive.com.br/plugin/AssistiveWebPlugin.js" charset="UTF-8" type="text/javascript" async onload="assistive.init({})"></script>
<?php
}

add_action('after_setup_theme', 'ocultar_barra_admin');
function ocultar_barra_admin()
{
   if (!current_user_can('administrator'))
   {
      show_admin_bar(false);
   }
}

add_action('pre_get_posts', 'custom_search_filter');
function custom_search_filter($query)
{
   if (!is_admin() && $query->is_main_query() && $query->is_search)
   {
      if (isset($_GET['categoria']))
      {
         $categoria = $_GET['categoria'];

         if ($categoria != 0)
         {
            $query->set('tax_query', array(
               array(
                  'taxonomy' => 'category',
                  'field' => 'id',
                  'terms' => $categoria
               )
            ));
         }
      }
   }
}
