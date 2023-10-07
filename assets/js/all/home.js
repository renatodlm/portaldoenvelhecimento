document.addEventListener('DOMContentLoaded', function () {

   // var homeSlider = new Swiper('#homeSlider', {
   //    slidesPerView: 1,
   //    spaceBetween: 10,
   //    navigation: {
   //       nextEl: '.swiper-button-next',
   //       prevEl: '.swiper-button-prev',
   //    },
   //    pagination: {
   //       el: '.swiper-pagination',
   //       clickable: true,
   //    },
   //    autoplay: {
   //       delay: 3000,
   //       disableOnInteraction: false,
   //    },
   //    thumbs: {
   //       swiper: {
   //          el: '.swiper-thumbs',
   //          slidesPerView: 3,
   //       }
   //    }
   // });

   var swiper = new Swiper(".homeSlider", {
      loop: true,
      spaceBetween: 10,
      slidesPerView: 6,
      freeMode: true,
      watchSlidesProgress: true,
   });
   var swiper2 = new Swiper(".homeSlider2", {
      loop: true,
      spaceBetween: 10,
      navigation: {
         nextEl: ".swiper-button-next",
         prevEl: ".swiper-button-prev",
      },
      thumbs: {
         swiper: swiper,
      },
   });
});
