var swiper = new Swiper(".mySwiper", {
  centeredSlides: true,
  loop: true,
  autoplay: {
      delay: 5000,
      disableOnInteraction: false,
  },
  pagination: {
      el: ".swiper-pagination",
  },
  navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
  },
});

var swiper2 = new Swiper('.mySwiper2', {
  slidesPerView: 1,
  centeredSlides: true,
  spaceBetween: 10,
  pagination: {
      el: '.number-pagination',
      clickable: true,
      renderBullet: function (index, className) {
          return '<span class="' + className + '">' + (index + 1) + '</span>';
      }
  },
  navigation: {
      nextEl: '.btn-right',
      prevEl: '.btn-left',
  },
  autoHeight: true
});