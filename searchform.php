<?php $currentCat = !empty($_GET['categoria']) ? $_GET['categoria'] : 'Todas';  ?>
<form x-data="{currentCat:<?php echo  $currentCat ?> }" role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
   <label>
      <span class="screen-reader-text"><?php echo _x('Resultados para:', 'label', 'textdomain'); ?></span>
      <input type="search" class="search-field" placeholder="<?php echo esc_attr_x('Pesquisar...', 'placeholder', 'portaldoenvelhecimento'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
   </label>


   <select class="text-sm -ml-[1.1rem] h-10 border-l-transparent" name="categoria" id="categoria" value="<?php echo  $currentCat ?>" x-bind:value="currentCat">
      <?php

      echo '<option value="0">' . esc_html__('Todas') . '</option>';

      $categories = get_categories();

      foreach ($categories as $category)
      {
         echo '<option value="' . $category->term_id . '">' . $category->name . '</option>';
      }
      ?>
   </select>
   <button type="submit" class="search-submit"><?php render_svg('search') ?></button>
</form>
