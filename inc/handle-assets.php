<?php

/**
 * Enqueue scripts and styles.
 */
function portaldoenvelhecimento_scripts()
{
   // wp_enqueue_script('swiper', get_template_directory_uri() . '/assets/lib/swiper-bundle.min.js', array(), _S_VERSION, true);
   // wp_enqueue_style('swiper', get_template_directory_uri() . '/assets/lib/swiper-bundle.min.css', array(), '1.0.0', 'all');
   wp_enqueue_script('alpine', get_template_directory_uri() . '/assets/lib/alpinejs3.min.js', array(), null, ['strategy' => 'defer']);

   // wp_enqueue_script('all',  get_template_directory_uri() .  'assets/js/all.min.js', ['alpine'], false, true);
   // wp_enqueue_script('alpine-js', '/assets/lib/alpinejs3.min.js', array(), null, true);

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

function conectar_scripts_personalizados()
{
   wp_enqueue_script('select2');
   wp_enqueue_style('select2');
   wp_enqueue_script('customizer-controls', get_template_directory_uri() . '/assets/js/customizer-controls.js', array('jquery', 'customize-controls'), '', true);
}

add_action('customize_controls_enqueue_scripts', 'conectar_scripts_personalizados');


add_action('wp_enqueue_scripts', 'portaldoenvelhecimento_scripts');

function enqueue_custom_admin_scripts($hook)
{
   if ('widgets.php' === $hook)
   {
      wp_enqueue_media();

      wp_enqueue_script('custom-widget-media-upload', get_template_directory_uri() . '/assets/js/custom-widget-media-upload.js', array('jquery'), null, true);
   }
}

add_action('admin_enqueue_scripts', 'enqueue_custom_admin_scripts');
