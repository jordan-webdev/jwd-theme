(function($) {

  $(document).on('jwd-header-cart-updated', function() {
    var amount = parseInt($('.cart-wrapper .count').text());
    var show_cart = amount > 0 ? true : false;
    if (show_cart) {
      show_the_cart();
      update_thumbs();
    } else {
      hide_the_cart();
    }
  });

  $('.top-bar').on('change', '.jwd-cart-list .quantity input', function() {
    var the_button = $(this).closest('.update').find('.update-btn');
    $('.update-btn.active').not(the_button).removeClass('active');
    the_button.addClass('active');
  });

  function hide_the_cart() {
    $('.cart-wrapper').addClass('disabled');
  }

  function show_the_cart() {
    $('.cart-wrapper.disabled').removeClass('disabled');
  }

  function update_thumbs() {
    $('.c-item .thumb-wrap img').each(function() {
      var src = $(this).prop('src');
      if (src.indexOf('1x1.trans.gif') !== -1) {
        $(this).prop('src', $(this).data('orig-file'));
      }
    });
  }

})(jQuery)
