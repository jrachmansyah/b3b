"use strict";



  if ($("body").attr("data-page") === "homepage") {
    var swiper1 = new Swiper(".offerslidetab1", {
      slidesPerView: "auto",
      spaceBetween: 0,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    });
    var swiper2 = new Swiper(".offerslide2tab1", {
      slidesPerView: "auto",
      spaceBetween: 0,
    });
    var swiper3 = new Swiper(".categoriestab1", {
      slidesPerView: "auto",
      spaceBetween: 0,
    });
    var swiper4 = new Swiper(".categories2tab1", {
      slidesPerView: "auto",
      spaceBetween: 10,
    });

    $("#search-tab").on("shown.bs.tab", function (e) {
      var swiper5 = new Swiper(".offerslide2tab2", {
        slidesPerView: "auto",
        spaceBetween: 0,
      });

      var swiper6 = new Swiper(".categories2tab2", {
        slidesPerView: "auto",
        spaceBetween: 10,
      });
    });
  }

  if ($("body").attr("data-page") === "payment") {
    var swiper7 = new Swiper(".swipercards", {
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: "auto",
      spaceBetween: 15,
      coverflowEffect: {
        rotate: 30,
        stretch: 0,
        depth: 80,
        modifier: 1,
        slideShadows: true,
      },
    });
  }
  if ($("body").attr("data-page") === "thankyou") {
    setTimeout(function () {
      window.location.replace("index.html");
    }, 3500);
  }

  if ($("body").attr("data-page") === "productpage") {
    var galleryThumbs = new Swiper(".gallery-thumbs", {
      spaceBetween: 10,
      slidesPerView: 4,
      freeMode: true,
      watchSlidesVisibility: true,
      watchSlidesProgress: true,
    });
    var galleryTop = new Swiper(".gallery-top", {
      spaceBetween: 10,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      thumbs: {
        swiper: galleryThumbs,
      },
    });
  }

