(function($) {


  // Init aria attr
  $('.js-modal-init').attr({
    'aria-expanded': 'false',
    'aria-haspopup': 'true',
  });

  // Close on esc
  $(document).on('keydown', function(event) {
    if (event.keyCode == 27) {
      close_modals(true);
    }
  });




  // Popup click init
  $('.js-modal-init').on('click', function(e) {
    var that = $(this);
    var popup = that.find(".js-modal");
    popup = popup.length ? popup : that.next('.js-modal');
    var is_open = popup.hasClass('open');

    // Close existing modals, except the current one
    $('.js-modal-init.open').not(that).removeClass('open');
    $('.js-modal.open').not(popup).removeClass('open');

    // Open / Close popup
    if (!is_open) {
      // Open popup
      that.addClass('open');
      popup.addClass('open');
      that.attr('aria-expanded', 'true');
    } else {
      // Close popup
      that.removeClass('open');
      popup.removeClass('open');
      that.attr('aria-expanded', 'false');
    }

    e.preventDefault();
    e.stopPropagation();

  });


  // Close btn
  $('.js-modal-close').on('click', function() {
    close_modals(true);
  });


  // Close popup on focus out
  $('.js-modal *').not('.js-modal-close').on('focusout', function() {
    setTimeout(function() {
      var is_in_modal = $(document.activeElement).closest('.js-modal').length;

      if (!is_in_modal) {
        close_modals();
      }
    }, 10);
  });


  // Needed for close popup on outside click
  $('.js-modal').on('click', function(e) {
    var target = e.target;
    var el_type = target.nodeName;
    var is_close_btn = $(target).hasClass('js-modal-close');

    if (el_type != "A" && !is_close_btn) {
      e.stopPropagation();
    }
  });


  // Close popup on outside click
  $('body').on('click', function() {
    close_modals();
  });




  function close_modals(focus = false) {
    var open_modal_init = $('.js-modal-init.open');

    $('.js-modal.open').removeClass('open');
    if (focus) {
      open_modal_init.focus();
    }
    open_modal_init.removeClass("open").attr('aria-expanded', 'false');
  }



})(jQuery)