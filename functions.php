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
 * Render svg
 */
require get_template_directory() . '/inc/render-svg.php';
/**
 * Custom setup
 */
require get_template_directory() . '/inc/setup.php';

/**
 * Handle assets
 */
require get_template_directory() . '/inc/handle-assets.php';

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


function tags_in_posts($max = 4)
{
   $tags = get_the_tags();

   if ($tags)
   {
      $contador = 0;
      foreach ($tags as $tag)
      {
         $contador++;
         $tag_color = get_theme_mod('tag_color_' . $tag->term_id, '#2ecc71');

         if ($contador <= $max)
         {
            echo '<a class="py-1 px-2 text-white text-xs hover:text-white" href="' . get_tag_link($tag->term_id) . '" style="background-color:' . $tag_color . '">' . $tag->name . '</a>';
         }
      }
   }
}
