      @php
          $contact_us = \App\Models\ContactUs::whereNull('deleted_by')->first();
      @endphp
   
  
  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="fa-solid fa-arrow-up"></i></a>
    <div class="float-container">
        @if($contact_us && $contact_us->contact_number)
            <a href="tel:{{ $contact_us->contact_number }}" class="icon one">Call Us</a>
        @endif

        @if($contact_us && $contact_us->email)
            <a href="mailto:{{ $contact_us->email }}" class="icon two">Email Us</a>
        @endif

        @if($contact_us && $contact_us->map_url)
            <a href="{{ $contact_us->map_url }}" target="_blank" class="icon three">Reach Us</a>
        @endif
    </div>
  <!-- Vendor JS Files -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <!-- Main JS File -->
  <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
  
  <!-- Script to auto-show modal after 10s -->
  <script>
document.addEventListener("DOMContentLoaded", function () {

    var videoModalEl = document.getElementById('videoModal');

    // Exit if modal does not exist on this page
    if (!videoModalEl) return;

    // Show modal once per session
    if (!sessionStorage.getItem("videoPopupShown")) {
        setTimeout(function () {
            var myModal = new bootstrap.Modal(videoModalEl);
            myModal.show();
            sessionStorage.setItem("videoPopupShown", "true");
        }, 10000);
    }

    // Stop video when modal closes
    videoModalEl.addEventListener('hidden.bs.modal', function () {
        var video = document.getElementById('popupVideo');
        if (video) {
            video.pause();
            video.currentTime = 0;
        }
    });
});
</script>


<script>
  $(".alumni-carousal-slide").owlCarousel({
    loop: true,
    margin: 20,
    nav: true,
    dots: false,
    autoplay: true,
    autoplayTimeout: 4000,
    smartSpeed: 800,
    responsive: {
      0: { items: 1 },
      576: { items: 1 },
      992: { items: 3 },
      1200: { items: 4 }
    },
    navText: [
      "<i class='fa fa-angle-left' aria-hidden='true'></i>",
      "<i class='fa fa-angle-right' aria-hidden='true'></i>"
    ]
  });

  // accessibility fix
  $(".alumni-carousal-slide").on("initialized.owl.carousel", function () {
    $(this).find(".owl-prev").attr("aria-label", "Previous slide");
    $(this).find(".owl-next").attr("aria-label", "Next slide");
  });
</script>


  <script>
    $(".client-carousel").owlCarousel({
      loop: true,
      margin: 20,
      autoplay: true,
      autoplayTimeout: 2500,
      autoplayHoverPause: true,
      responsiveClass: true,
      responsive: {
        0: { items: 2 },
        576: { items: 3 },
        768: { items: 2 },
        992: { items: 6 },
        1200: { items: 6 }
      }
    });
  </script>

<script>
  $(document).ready(function () {
    $(".emctesti-carousel").owlCarousel({
      loop: true,
      margin: 30,
      nav: true,
      dots: true,
      autoplay: true,
      autoplayTimeout: 3000,
      smartSpeed: 800,
      responsiveClass: true,
      responsive: {
        0: { items: 1 },
        576: { items: 1 },
        768: { items: 1 },
        992: { items: 2 },
        1200: { items: 2 }
      },
      navText: [
        "<i class='fa fa-angle-left' aria-hidden='true'></i>",
        "<i class='fa fa-angle-right' aria-hidden='true'></i>"
      ]
    });

    // accessibility fix
    $(".emctesti-carousel").on("initialized.owl.carousel", function () {
      $(this).find(".owl-prev").attr("aria-label", "Previous testimonial");
      $(this).find(".owl-next").attr("aria-label", "Next testimonial");
    });
  });
</script>


  <!--<script>-->
  <!--  var swiper = new Swiper(".mySwiper", {-->
  <!--    slidesPerView: 1,-->
  <!--    spaceBetween: 20,-->
  <!--    loop: true,-->
  <!--    autoplay: {-->
  <!--      delay: 4000,-->
  <!--      disableOnInteraction: false,-->
  <!--    },-->
  <!--    pagination: {-->
  <!--      el: ".swiper-pagination",-->
  <!--      clickable: true,-->
  <!--    },-->
  <!--    navigation: {-->
  <!--      nextEl: ".swiper-button-next",-->
  <!--      prevEl: ".swiper-button-prev",-->
  <!--    },-->
  <!--    breakpoints: {-->
  <!--      640: {-->
  <!--        slidesPerView: 1,-->
  <!--        spaceBetween: 20,-->
  <!--      },-->
  <!--      768: {-->
  <!--        slidesPerView: 2,-->
  <!--        spaceBetween: 25,-->
  <!--      },-->
  <!--      1024: {-->
  <!--        slidesPerView: 2,-->
  <!--        spaceBetween: 30,-->
  <!--      },-->
  <!--      1440: {-->
  <!--        slidesPerView: 2,-->
  <!--        spaceBetween: 40,-->
  <!--      }-->
  <!--    }-->
  <!--  });-->
  <!--</script>-->

<script>
  $('.latest-blog-carousel').owlCarousel({
    loop: true,
    margin: 20,
    nav: true,
    dots: false,
    autoplay: true,
    autoplayTimeout: 4000,
    smartSpeed: 800,
    responsive: {
      0: { items: 1 },
      768: { items: 1 },
      992: { items: 1 }
    },
    navText: [
      "<i class='fa fa-angle-left' aria-hidden='true'></i>",
      "<i class='fa fa-angle-right' aria-hidden='true'></i>"
    ]
  });

  // accessibility fix
  $('.latest-blog-carousel').on('initialized.owl.carousel', function () {
    $(this).find('.owl-prev').attr('aria-label', 'Previous slide');
    $(this).find('.owl-next').attr('aria-label', 'Next slide');
  });
</script>
