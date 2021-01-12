(function($) {

  // Lightbox syncinc for product gallery
  $('.hardscape-intro__main-thumb-item .hardscape-intro__lightbox-link').on('click', function() {
    var href = $(this).prop('href');
    var matching_element = $('.hardscape-intro__thumb-item a[href$="' + href + '"]');
    matching_element.click();

    return false;
  });

  var active_text = $('.product-2 .text.active');
  adjust_height(active_text);

  $('.product-2 .link').on('click', function() {
    $('.product-2 .active').removeClass('active');
    $(this).addClass('active');

    var toggles = $(this).data('toggles');
    $('.product-2 .js-toggle.active').removeClass('active');
    $(toggles).addClass('active');

    adjust_height(toggles);

  });

  function adjust_height(toggles) {
    var new_height = $(toggles).height() + 15 + 'px';
    $('.product-2 .text-wrapper').animate({
      'height': new_height,
    }, 300);
  }

})(jQuery)
