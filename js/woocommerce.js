(function($) {

  var home_url = window.location.origin;

  // AJAX add to cart
  $('.products form, .product form').each(function() {
    $(this).append($(this).next('input'));
  });

  // Products AJAX update cart
  $('body').on('submit', '.js-sizes-form form', function() {

    var $theForm = $(this);

    // Show loader
    var $addCartButton = $theForm.parent('.js-sizes-form').prev('.sizes-btn');
    var $view_cart_button = $theForm.closest('.sizes-wrapper').find('.added-msg-wrap');

    $addCartButton.html('<span class="fa fa-spinner fa-spin" aria-hidden="true"></span>');

    // send xhr request
    $.post({
      type: $theForm.prop('method'),
      url: $theForm.prop('action'),
      data: $theForm.serialize(),
      success: function(data) {
        $(document).trigger('jwd-product-added');

        // Change the Add To Cart button to a link
        $view_cart_button.addClass('active');
        // Update the list in the header
        $('.top-bar .cart-wrapper').load(home_url + ' .top-bar .cart-wrapper > *', function() {
          $(document).trigger('jwd-header-cart-updated');
        });
      }
    });

    // prevent submitting again
    return false;

  });

  // Cart List (in header) AJAX update cart
  $('.top-bar').on('submit', '.jwd-cart-list form', function() {

    var $theForm = $(this);

    // Show loader
    var $addCartButton = $theForm.find('.update-btn.active');
    $addCartButton.text('').append('<span class="fa fa-spinner fa-spin" aria-hidden="true"></span>');

    // send xhr request
    $.post({
      type: $theForm.prop('method'),
      url: $theForm.prop('action'),
      data: $theForm.serialize(),
      success: function(data) {
        $(document).trigger('jwd-cart-updated');

        // Change the Add To Cart button to a link
        $addCartButton.find('.fa').removeClass('fa-spinner fa-spin').addClass('fa-check');
        setTimeout(function() {
          $addCartButton.removeClass('active').remove('.fa');
          setTimeout(function() {
            $addCartButton.text('UPDATE');
          }, 300);
        }, 1000);

        // Update the list in the header
        $('.top-bar .cart').load(home_url + ' .top-bar .cart > *', function() {
          $(document).trigger('jwd-header-cart-count-updated');
        });
        $('.top-bar .jwd-cart-list').load(home_url + ' .top-bar .jwd-cart-list > *', function() {
          $(document).trigger('jwd-header-cart-updated');
        });
      }
    });

    // prevent submitting again
    return false;

  });

  // Cart Page Update - Refresh Header Cart Count
  $('.page-id-80').on('submit', '.woocommerce-cart-form', function() {
    update_cart_count();
  });

  $('.page-id-80').on('click', '.js-remove-product', function() {
    update_cart_count();
  });

  // Delete
  $('.top-bar').on('click', '.delete a', function() {

    var href = $(this).prop('href');
    var $theForm = $('.top-bar .jwd-cart-list form');

    // Add spinner
    $(this).find('.fa-trash').removeClass('fa-trash').addClass('fa-spinner fa-spin');

    // send xhr request
    $.post({
      type: $theForm.prop('method'),
      url: href,

      success: function(data) {
        $(document).trigger('jwd-cart-updated');

        // Update the list in the header
        $('.top-bar .cart').load(home_url + ' .top-bar .cart > *', function() {
          $(document).trigger('jwd-header-cart-count-updated');
        });
        $('.top-bar .jwd-cart-list').load(home_url + ' .top-bar .jwd-cart-list > *', function() {
          $(document).trigger('jwd-header-cart-updated');
        });
      }
    });

    return false;
  });

  function update_cart_count() {
    // Update the list in the header after waiting for WooCommerce to submit form
    setTimeout(function() {
      $('.top-bar .cart').load(home_url + ' .top-bar .cart > *', function() {
        $(document).trigger('jwd-header-cart-count-updated');
      });
    }, 1000);
  }

})(jQuery)
