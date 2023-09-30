<?php

/**
 * portaldoenvelhecimento functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package portaldoenvelhecimento
 */

if (!defined('_S_VERSION'))
{
   // Replace the version number of the theme on each release.
   define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
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
         'menu-1' => esc_html__('Primary', 'portaldoenvelhecimento'),
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
add_action('after_setup_theme', 'portaldoenvelhecimento_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function portaldoenvelhecimento_content_width()
{
   $GLOBALS['content_width'] = apply_filters('portaldoenvelhecimento_content_width', 640);
}
add_action('after_setup_theme', 'portaldoenvelhecimento_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function portaldoenvelhecimento_widgets_init()
{
   register_sidebar(
      array(
         'name'          => esc_html__('Sidebar', 'portaldoenvelhecimento'),
         'id'            => 'sidebar-1',
         'description'   => esc_html__('Add widgets here.', 'portaldoenvelhecimento'),
         'before_widget' => '<section id="%1$s" class="widget %2$s">',
         'after_widget'  => '</section>',
         'before_title'  => '<h2 class="widget-title">',
         'after_title'   => '</h2>',
      )
   );
}
add_action('widgets_init', 'portaldoenvelhecimento_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function portaldoenvelhecimento_scripts()
{
   // wp_enqueue_script('swiper', get_template_directory_uri() . '/assets/lib/swiper-bundle.min.js', array(), _S_VERSION, true);
   // wp_enqueue_style('swiper', get_template_directory_uri() . '/assets/lib/swiper-bundle.min.css', array(), '1.0.0', 'all');
   wp_enqueue_style('all', get_template_directory_uri() . '/assets/css/all.min.css', array(), '1.0.0', 'all');

   wp_enqueue_script('navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), _S_VERSION, true);
   if (is_singular() && comments_open() && get_option('thread_comments'))
   {
      wp_enqueue_script('comment-reply');
   }
   wp_enqueue_script('all', get_template_directory_uri() . '/assets/js/all.min.js', array(), _S_VERSION, true);

   wp_localize_script('all', 'ajax', [
      'ajaxNonce' => wp_create_nonce('defaultNonce'),
      'ajaxUrl'   => admin_url('admin-ajax.php'),
   ]);
}
add_action('wp_enqueue_scripts', 'portaldoenvelhecimento_scripts');

/**
 * Render svg
 */
require get_template_directory() . '/inc/render-svg.php';
/**
 * Custom setup
 */
require get_template_directory() . '/inc/setup.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION'))
{
   require get_template_directory() . '/inc/jetpack.php';
}

add_action('wp_ajax_register_ajax_callback', 'register_ajax_callback');
add_action('wp_ajax_nopriv_register_ajax_callback', 'register_ajax_callback');
function register_ajax_callback()
{
   $nonce = $_POST['_ajax_nonce'];
   if (!wp_verify_nonce($nonce, 'defaultNonce'))
   {
      wp_send_json_error('Nonce inválido');
   }

   if (empty($_POST['name']) || empty($_POST['email']))
   {
      wp_send_json_error(
         [
            'message' => esc_html__('Erro ao capturar pagamento da API', 'englishpass')
         ],
         WP_Http::BAD_REQUEST
      );
   }

   if (username_exists($_POST['email']) || email_exists($_POST['email']))
   {
      wp_send_json_error(
         [
            'message' => esc_html__('E-mail ja cadastrado!', 'englishpass')
         ],
         WP_Http::BAD_REQUEST
      );
   }

   $password = wp_generate_password(12, false);

   $new_user_id = wp_create_user($_POST['email'], $password, $_POST['email']);

   if (is_wp_error($new_user_id))
   {
      wp_send_json_error([
         'message' => esc_html__('Erro ao criar usuário.', 'englishpass'),
      ], WP_Http::BAD_REQUEST);
   }

   if (!empty($_POST['institution']))
   {
      update_user_meta($new_user_id, 'portaldoenvelhecimento_institution', $_POST['institution']);
   }

   $name = $_POST['name'];
   $email = $_POST['email'];
   $institution = $_POST['institution'];

   $subject = get_bloginfo('name') . ' - Novo usuário criado';
   $message = "Um novo usuário foi criado com as seguintes informações:\n\n";
   $message .= "Nome: $name\n";
   $message .= "E-mail: $email\n";
   $message .= "Instituição: $institution";

   $admin_email = get_option('admin_email');

   wp_mail($admin_email, $subject, $message);

   wp_send_json_success([
      'message' => 'Dados enviados com sucesso!'
   ]);
}

function adicionar_coluna_portaldoenvelhecimento_institution($columns)
{
   $columns['portaldoenvelhecimento_institution'] = 'Instituição';
   return $columns;
}
add_filter('manage_users_columns', 'adicionar_coluna_portaldoenvelhecimento_institution');

function exibir_valor_portaldoenvelhecimento_institution($value, $column_name, $user_id)
{
   if ($column_name === 'portaldoenvelhecimento_institution')
   {
      $portaldoenvelhecimento_institution = get_user_meta($user_id, 'portaldoenvelhecimento_institution', true);
      return $portaldoenvelhecimento_institution;
   }
   return $value;
}
add_filter('manage_users_custom_column', 'exibir_valor_portaldoenvelhecimento_institution', 10, 3);


function adicionar_campo_portaldoenvelhecimento_institution($user)
{
?>
   <h3>Informações Adicionais</h3>
   <table class="form-table">
      <tr>
         <th><label for="portaldoenvelhecimento_institution">Instituição</label></th>
         <td>
            <input type="text" name="portaldoenvelhecimento_institution" id="portaldoenvelhecimento_institution" value="<?php echo esc_attr(get_user_meta($user->ID, 'portaldoenvelhecimento_institution', true)); ?>" class="regular-text">
         </td>
      </tr>
   </table>
<?php
}
add_action('show_user_profile', 'adicionar_campo_portaldoenvelhecimento_institution');
add_action('edit_user_profile', 'adicionar_campo_portaldoenvelhecimento_institution');
