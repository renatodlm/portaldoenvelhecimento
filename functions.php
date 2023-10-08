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

function filter_search($query)
{
   if ($query->is_search)
   {
      $query->set('post_type', 'post');
   }
   return $query;
}

add_filter('pre_get_posts', 'filter_search');
