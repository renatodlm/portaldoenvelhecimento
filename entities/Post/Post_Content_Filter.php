<?php

if (!defined('ABSPATH'))
{
   exit;
}

class PE_Post_Content_Filter
{
   private $related_posts_parts = [];
   private $post_article;

   public function __construct()
   {
      add_filter('the_content', [$this, 'filter_content'], 5);
   }

   public function filter_content($content)
   {
      if (!is_single() || 'post' !== get_post_type())
      {
         return $content;
      }

      $blocks = $this->parse_blocks($content);

      if (empty($blocks))
      {
         return $content;
      }

      $this->post_article = new PE_Post();

      remove_filter('the_content', 'wpautop');

      $this->get_related_posts_parts();

      $new_content = $this->render_content($blocks);

      return $new_content;
   }

   private function parse_blocks($content)
   {
      return has_blocks($content) ? parse_blocks($content) : [];
   }

   private function render_content($blocks)
   {
      $filtered_blocks = array_filter($blocks, function ($block)
      {
         return !empty($block['blockName']);
      });

      $total_paragraphs = count(array_filter($filtered_blocks, function ($block)
      {
         return 'core/paragraph' === $block['blockName'];
      }));

      $paragraph_index = 1;

      $new_content = '';

      $total_blocks = count($filtered_blocks);
      $twenty_percent = (int) ($total_blocks * 0.2);
      $forty_percent = (int) ($total_blocks * 0.4);
      $sixty_percent = (int) ($total_blocks * 0.5);
      $eighty_percent = (int) ($total_blocks * 0.8);

      foreach ($filtered_blocks as $block)
      {
         $new_content .= render_block($block);

         if ('core/paragraph' !== $block['blockName'])
         {
            continue;
         }

         if ($paragraph_index === $twenty_percent)
         {
            $new_content .= $this->add_related_posts($this->related_posts_parts[1]);
         }
         if ($paragraph_index === $sixty_percent && $total_blocks >= 10)
         {
            $new_content .= $this->add_newsletter();
         }
         if ($paragraph_index  === $eighty_percent)
         {
            $new_content .= $this->add_center_ad();
         }
         // if ($paragraph_index === $eighty_percent && $total_blocks >= 10)
         // {
         //    $new_content .= $this->add_center_ad();
         // }

         $paragraph_index++;
      }

      return $new_content;
   }

   private function get_related_posts_parts()
   {
      $related_posts_ID = $this->post_article->get_related_posts_ID();

      $this->related_posts_parts = [
         array_slice($related_posts_ID, 0, 1) ?? [],
         array_slice($related_posts_ID, 1)    ?? [],
      ];
   }

   private function add_related_posts($posts_ID)
   {
      ob_start();
      get_template_part('template-parts/content-related-posts', null, [
         'posts_ID' => $posts_ID,
      ]);
      return ob_get_clean();
   }

   private function add_center_ad()
   {
      ob_start();

      $Post = new PE_Post();
      if (!empty($Post->get_category_ID()))
      {
         $category = get_category($Post->get_category_ID());
?>
         <div class="my-5 flex flex-col gap-6 divide-y divide-gray-400 mx-auto text-center">
            <?php
            $sidebar = 'ads-' . sanitize_title($category->slug);
            dynamic_sidebar($sidebar);
            ?>
         </div>
      <?php
      }
      return ob_get_clean();
   }

   private function add_newsletter()
   {;
      ob_start();


      ?>
      <div class="my-6 p-4 flex flex-col gap-6 text-center bg-gray-100 float-right sm:ml-6 sm:w-1/2">
         <!-- Subscription Form -->
         <style>
            .sp-force-hide {
               display: none;
            }

            .sp-form[sp-id="213245"] {
               display: block;
               padding: 15px;
               width: 450px;
               max-width: 100%;
               border-radius: 8px;
               border-style: solid;
               border-width: 1px;
               font-family: Arial, "Helvetica Neue", sans-serif;
               background-repeat: no-repeat;
               background-position: center;
               background-size: auto;
            }

            .sp-form[sp-id="213245"] input[type="checkbox"] {
               display: inline-block;
               opacity: 1;
               visibility: visible;
            }

            .sp-form[sp-id="213245"] .sp-form-fields-wrapper {
               margin: 0 auto;
               width: 420px;
            }

            .sp-form[sp-id="213245"] .sp-form-control {
               background: #ffffff;
               border-color: #cccccc;
               border-style: solid;
               border-width: 1px;
               font-size: 15px;
               padding-left: 8.75px;
               padding-right: 8.75px;
               border-radius: 4px;
               height: 35px;
               width: 100%;
            }

            .sp-form[sp-id="213245"] .sp-field label {
               color: #444444;
               font-size: 13px;
               font-style: normal;
               font-weight: bold;
            }

            .sp-form[sp-id="213245"] .sp-button-messengers {
               border-radius: 4px;
            }

            .sp-form[sp-id="213245"] .sp-button {
               border-radius: 4px;
               background-color: #f28643;
               color: #ffffff;
               width: auto;
               font-weight: 700;
               font-style: normal;
               font-family: Arial, sans-serif;
               box-shadow: none;
            }

            .sp-form[sp-id="213245"] .sp-button-container {
               text-align: left;
            }
         </style>
         <div class="sp-form-outer sp-force-hide">
            <div id="sp-form-213245" sp-id="213245" sp-hash="15fb2a9e6e45d7edaace8602d79c4c9b56e3ea0ed52cc899ef9814232ffd486d" sp-lang="pt-br" class="sp-form sp-form-regular sp-form-embed" sp-show-options="%7B%22satellite%22%3Afalse%2C%22maDomain%22%3A%22login.sendpulse.com%22%2C%22formsDomain%22%3A%22forms.sendpulse.com%22%2C%22condition%22%3A%22onEnter%22%2C%22scrollTo%22%3A25%2C%22delay%22%3A10%2C%22repeat%22%3A3%2C%22background%22%3A%22rgba(0%2C%200%2C%200%2C%200.5)%22%2C%22position%22%3A%22bottom-right%22%2C%22animation%22%3A%22%22%2C%22hideOnMobile%22%3Afalse%2C%22urlFilter%22%3Afalse%2C%22urlFilterConditions%22%3A%5B%7B%22force%22%3A%22hide%22%2C%22clause%22%3A%22contains%22%2C%22token%22%3A%22%22%7D%5D%2C%22analytics%22%3A%7B%22ga%22%3A%7B%22eventLabel%22%3Anull%2C%22send%22%3Afalse%7D%2C%22ym%22%3A%7B%22counterId%22%3Anull%2C%22eventLabel%22%3Anull%2C%22targetId%22%3Anull%2C%22send%22%3Afalse%7D%7D%2C%22utmEnable%22%3Afalse%7D">
               <div class="sp-form-fields-wrapper">
                  <div class="sp-message">
                     <div></div>
                  </div>
                  <form novalidate="" class="sp-element-container ">
                     <div class="sp-field sp-field-full-width" sp-id="sp-e44e1c11-721d-4f6b-8c13-2ed057a31f1e">
                        <div style="font-family: inherit; line-height: 1.2;">
                           <p>Receba as últimas notícias da área do envelhecimento!</p>
                        </div>
                     </div>
                     <div class="sp-field " sp-id="sp-55782b64-1bf2-4cd2-8d8a-58285d0f94c0"><label class="sp-control-label"><span>Email</span><strong>*</strong></label><input type="email" sp-type="email" name="sform[email]" class="sp-form-control " placeholder="nomedeusuário@gmail.com" sp-tips="%7B%22required%22%3A%22Campo%20obrigat%C3%B3rio%22%2C%22wrong%22%3A%22E-mail%20errado%22%7D" autocomplete="on" required="required"></div>
                     <div class="sp-field sp-button-container " sp-id="sp-0e14df84-bf0a-45e6-a215-2b1e27cdd751"><button id="sp-0e14df84-bf0a-45e6-a215-2b1e27cdd751" class="sp-button">Quero me inscrever! </button></div>
                  </form>
                  <div class="sp-link-wrapper sp-brandname__left"><a class="sp-link " target="_blank" href="https://sendpulse.com/forms-powered-by-sendpulse?sn=UG9ydGFsIGRvIEVudmVsaGVjaW1lbnRv"><span class="sp-link-img"> </span><span translate="FORM.PROVIDED_BY">Desenvolvido por SendPulse</span></a></div>
               </div>
            </div>
         </div>
         <script type="text/javascript" async="async" src="//web.webformscr.com/apps/fc3/build/default-handler.js?1653643444289"></script>
         <!-- /Subscription Form -->
      </div>
<?php
      return ob_get_clean();
   }
}

new PE_Post_Content_Filter();
