(function($) {

  var go_to_top_button = $('.go-to-top');

  $(window).on('scroll', function() {
    var scroll_amount = $(this).scrollTop();
    if (scroll_amount > 500) {
      go_to_top_button.addClass('active');
    } else {
      go_to_top_button.removeClass('active');
    }
  });

})(jQuery)
