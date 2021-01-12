(function($) {

  let slider = $('.main-slider .slider');

  if (slider.length > 0) {

    slider.slick({
      swipe: false,
      fade: true,
      speed: 500,
      dots: true,
      arrows: false,
      cssEase: 'ease-in-out',
    });

    slider.on("init", function(event, slick, currentSlide, nextSlide) {
      toggle_videos(slider, currentSlide);
    });

    slider.on("afterChange", function(event, slick, currentSlide, nextSlide) {
      toggle_videos(slider, currentSlide);
    });

  }


})(jQuery)