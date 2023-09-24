<?php

/**
 * Template Name: Home
 */


get_header();

?>

<main>

   <?php if (have_rows('hero')) : ?>
      <section class="hero">

         <?php while (have_rows('hero')) : the_row();
            $image           = get_sub_field('image');
            $img_src         = $image['sizes']['large'] ?? '';
            $image_secondary = get_sub_field('image_secondary');
            $img2_src        = $image_secondary['sizes']['large'] ?? '';
            $background      = get_sub_field('background');
            $img3_src        = $background['sizes']['large'] ?? '';
         ?>
            <div class="container-around">
               <img class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-0 h-full w-auto object-cover" src="<?php echo $img3_src ?>" alt="">
               <div class="container lg:max-w-[71.25rem] flex flex-wrap relative py-12 lg:py-[7.5rem]">
                  <div class="w-full flex flex-wrap gap-12 lg:gap-14 relative z-30">
                     <div class="w-full">
                        <?php
                        $custom_logo_id = get_theme_mod('custom_logo');
                        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                        $logo_url = $logo[0];

                        ?>
                        <img class="h-16 w-auto max-w-full object-contain z-30" src="<?php echo $logo_url ?>" alt="">
                     </div>
                     <div class="lg:flex-1">
                        <h1 class="text-[3.5rem] lg:text-[6rem] text-purple-900 leading-none font-bold z-30 relative mb-6">
                           <span class="text-purple-400">H</span>ANDS</br>
                           <span class="text-purple-400">O</span>N</br>
                           <span class="text-purple-400">W</span>ORKSHOP</br>
                        </h1>
                        <button class="bg-yellow-500 text-purple-400 py-2 px-4 rounded-[16px] cursor-default">
                           LONDON, ON - 2024
                        </button>
                     </div>
                     <div class="lg:flex-1">
                        <?php
                        if (!empty($img2_src)) : ?>
                           <img class="lg:ml-auto lg:h-[23.6875rem] w-auto lg:max-w-full object-contain z-10 max-w-[70%]" src="<?php echo $img2_src ?>" alt="">
                        <?php endif; ?>
                     </div>
                  </div>

                  <?php if (!empty($img_src)) : ?>
                     <img class="absolute bottom-0 left-1/2 -translate-x-1/2 ml-[8%] z-20" src="<?php echo $img_src ?>" alt="">
                  <?php endif;
                  ?>


               </div>
            </div>
         <?php endwhile; ?>


      </section>
   <?php endif; ?>

   <?php if (have_rows('primary_about')) : ?>
      <section class="py-12 lg:py-[7.5rem]">
         <div class="container flex gap-12 lg:gap-[7.8125rem] items-center justify-center lg:max-w-[71.25rem] lg:flex-nowrap flex-wrap">

            <?php while (have_rows('primary_about')) : the_row();
               $title   = get_sub_field('title');
               $text    = get_sub_field('text');
               $image   = get_sub_field('image');
               $img_src = $image['sizes']['large'] ?? '';
            ?>

               <div class="w-full lg:w-1/2">
                  <?php if (!empty($img_src)) : ?>
                     <img class="w-full h-auto max-w-[27.8125rem] object-contain" src="<?php echo $img_src ?>" alt="">
                  <?php endif; ?>
               </div>
               <div class="w-full lg:w-1/2">
                  <?php if (!empty($title)) : ?>
                     <h3 class="text-purple-900 text-[1.2rem] lg:text-[2rem] font-bold mb-6"><?php echo $title ?></h3>
                  <?php endif;
                  if (!empty($text)) : ?>
                     <p class="text-purple-500 text-[1.2rem] lg:text-[2rem] mb-0"><?php echo $text ?></p>
                  <?php endif; ?>
               </div>

            <?php endwhile; ?>

         </div>
      </section>
   <?php endif; ?>

   <?php if (have_rows('secondary_about')) : ?>
      <section class="py-12 lg:py-[7.5rem] bg-neutral-300">
         <div class="container flex gap-12 lg:gap-[7.8125rem] items-center justify-center lg:max-w-[71.25rem] lg:flex-nowrap flex-wrap">

            <?php while (have_rows('secondary_about')) : the_row();
               $title   = get_sub_field('title');
               $text    = get_sub_field('text');
               $image   = get_sub_field('image');
               $img_src = $image['sizes']['large'] ?? '';
            ?>

               <div class="w-full lg:w-1/2 md:order-2 order-1">
                  <?php if (!empty($img_src)) : ?>
                     <img class="w-full h-auto max-w-[27.8125rem]" src="<?php echo $img_src ?>" alt="">
                  <?php endif; ?>
               </div>
               <div class="w-full lg:w-1/2 md:order-1 order-2">
                  <?php if (!empty($title)) : ?>
                     <h3 class="text-purple-900 text-[1.2rem] lg:text-[2rem] font-bold mb-6"><?php echo $title ?></h3>
                  <?php endif;
                  if (!empty($text)) : ?>
                     <p class="text-purple-500 text-[1.2rem] lg:text-[2rem] mb-0"><?php echo $text ?></p>
                  <?php endif; ?>
               </div>

            <?php endwhile; ?>

         </div>
      </section>
   <?php endif; ?>

   <section class="py-12 lg:py-[7.5rem]">
      <div class="container flex flex-col gap-2 lg:max-w-[71.25rem]">
         <h3 class="text-purple-900 text-[1.2rem] lg:text-[2rem] font-bold mb-6">
            KEY FEATURES:
         </h3>
         <div class="rounded-[24px] p-6 border border-purple-500">
            <h4 class="text-purple-500 font-bold text-[1.2rem] lg:text-[2rem] mb-2">Pre-workshop material:</h4>
            <ul class="text-purple-500 text-[1.2rem] lg:text-[2rem] flex flex-col gap-2 leading-snug">
               <li>Printed slides from all workshop lectures</li>
               <li>Updated list of references in BT</li>
               <li>GU and GYN anatomy classes (ARC Bootcamp)</li>
            </ul>
         </div>
         <div class="rounded-[24px] p-6 border border-purple-500">
            <h4 class="text-purple-500 font-bold text-[1.2rem] lg:text-[2rem] mb-2">Patient preparation:</h4>
            <ul class="text-purple-500 text-[1.2rem] lg:text-[2rem] flex flex-col gap-2 leading-snug">
               <li>Clinical optimization</li>
               <li>Imaging and pre-planning</li>
            </ul>
         </div>
         <div class="rounded-[24px] p-6 border border-purple-500">
            <h4 class="text-purple-500 font-bold text-[1.2rem] lg:text-[2rem] mb-2">Procedure:</h4>
            <ul class="text-purple-500 text-[1.2rem] lg:text-[2rem] flex flex-col gap-2 leading-snug">
               <li>Anesthesia</li>
               <li>Application selection and insertion</li>
               <li>Image-guidance</li>
               <li>Applicator removal and management</li>
            </ul>
         </div>
         <div class="rounded-[24px] p-6 border border-purple-500">
            <h4 class="text-purple-500 font-bold text-[1.2rem] lg:text-[2rem]">Post-procedure care</h4>
         </div>
         <div class="rounded-[24px] p-6 border border-purple-500">
            <h4 class="text-purple-500 font-bold text-[1.2rem] lg:text-[2rem]">Interactive brachytherapy planning between RO and MP with expert assistance</h4>
         </div>
         <div class="rounded-[24px] p-6 border border-purple-500">
            <h4 class="text-purple-500 font-bold text-[1.2rem] lg:text-[2rem]">Hands-On experience in anthropomorphic phantoms</h4>
         </div>
         <div class="rounded-[24px] p-6 border border-purple-500">
            <h4 class="text-purple-500 font-bold text-[1.2rem] lg:text-[2rem]">Tips, pearls, and troubleshooting</h4>
         </div>
         <div class="flex gap-2 items-center flex-wrap">
            <div class="flex-1 rounded-[24px] p-6 bg-purple-500 text-white font-bold text-[1.2rem] lg:text-[2rem]">
               + Expert Guidance
            </div>
            <div class="flex-1 rounded-[24px] p-6 bg-purple-500 text-white font-bold text-[1.2rem] lg:text-[2rem]">
               + Networking Opportunities
            </div>
         </div>
      </div>
   </section>

   <?php if (have_rows('form')) : ?>
      <section class="py-12 md:py-[7.5rem] lg:py-[10rem] bg-purple-500 text-white">
         <div class="container flex lg:max-w-[71.25rem]">

            <?php while (have_rows('form')) : the_row();
               $title   = get_sub_field('title');
               $text    = get_sub_field('text');
               $image   = get_sub_field('image');
               $img_src = $image['sizes']['large'] ?? '';
            ?>
               <div class="w-full lg:w-[48%] lg:pr-2">
                  <?php if (!empty($title)) : ?>
                     <h3 class="bg-yellow-500 text-purple-400 font-bold py-2 px-4 rounded-[16px] text-center mb-6 uppercase leading-snug"><?php echo $title ?></h3>
                  <?php endif; ?>

                  <form id="homeForm">
                     <p class="mb-4">
                        <label class="mb-4 text-base font-bold block" for="name">Name*:</label>
                        <input class="bg-white w-full rounded-[16px] pl-4 h-[3rem] placeholder:text-sm text-neutral-100" type="text" id="name" name="name" placeholder="Insert your name" required minlength="3">
                     </p>

                     <p class="mb-4">
                        <label class="mb-4 text-base font-bold block" for="institution">Institution*:</label>
                        <input class="bg-white w-full rounded-[16px] pl-4 h-[3rem] placeholder:text-sm text-neutral-100" type="text" id="institution" name="institution" placeholder="Insert your institution" required minlength="3">
                     </p>

                     <p class="mb-4">
                        <label class="mb-4 text-base font-bold block" for="email">E-mail*:</label>
                        <input class="bg-white w-full rounded-[16px] pl-4 h-[3rem] placeholder:text-sm text-neutral-100" type="email" id="email" name="email" placeholder="Insert your e-mail" required minlength="3">
                     </p>

                     <p class="mb-0">
                        <input class="bg-yellow-500 rounded-[16px] h-[2.1875rem] cursor-pointer min-w-[159px] flex items-center justify-center placeholder:text-sm text-purple-400" type="submit" value="SEND">
                     </p>
                     <span id="dataResponse" class="bg-yellow-500 text-purple-400 text-base rounded-md my-4 hidden py-2 px-4"></span>
                  </form>

                  <?php if (!empty($text)) : ?>
                     <p class="mt-6 text-sm uppercase"><?php echo $text ?></p>
                  <?php endif; ?>
               </div>
               <div class="w-[52%] lg:pl-2 relative lg:block hidden">
                  <?php if (!empty($img_src)) : ?>
                     <img class="mx-auto max-w-full h-auto" src="<?php echo $img_src ?>" alt="">
                  <?php endif; ?>
               </div>
            <?php endwhile; ?>

         </div>
      </section>
   <?php endif; ?>



</main>

<?php

get_footer();
