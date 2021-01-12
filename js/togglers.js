(function($) {

  // Generic Togglers
  $('.js-toggler').on("click", function() {
    var toggle_items = $(this).data("toggles");
    var toggle_items = $.isArray(toggle_items) ? toggle_items : [toggle_items];

    var focus_in_el = $($(this).data("focus-in"));
    var focus_out_el = $($(this).data("focus-out"));
    var toggle_offset = $(this).data("toggle-offset");

    $.each(toggle_items, function(i, v) {
      var toggles = v;

      $(toggles).toggleClass("active");

      // Adjust focus
      if (!focus_in_el.hasClass('is-focus')) {
        focus_out_el.removeClass('is-focus')
        focus_in_el.addClass('is-focus');
        $(focus_in_el).focus();
      } else {
        focus_in_el.removeClass('is-focus');
        focus_out_el.addClass('is-focus')
        $(focus_out_el).focus();
      }

    });

    // Scroll
    /*if (toggle_scroll_to) {
      var scroll_target = '#' + toggle_scroll_to;
      //var is_sticky = window.matchMedia("(min-width: 1055px)").matches ? true : false;
      var endingPosition = parseInt($(scroll_target).offset().top) + parseInt(toggle_offset);
      //endingPosition = is_sticky ? endingPosition - 104 : endingPosition;

      $('html, body').animate({
        scrollTop: endingPosition
      }, 1000, function() {
        // Callback after animation
        // Must change focus!
        var $target = $(scroll_target);
        $target.focus();
        if ($target.is(":focus")) { // Checking if the target was focused
          return false;
        } else {
          $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
          $target.focus(); // Set focus again
        };
      });
    }*/


  });




  // Tax accordions
  $('.tax-accordions__pullout').slideUp(1);
  $('body').on('click', '.tax-accordions__toggler', function() {
    var arrow = $(this);
    var pullout = $(this).next('.tax-accordions__pullout');

    $('.tax-accordions__accordion').not($(this).parent()).removeClass('active');
    $(this).parent('.tax-accordions__accordion').toggleClass('active');
    $('.tax-accordions__pullout').not(pullout).slideUp().toggleClass('active');
    pullout.slideToggle();

    // Rotate the arrow
    $('.tax-accordions__accordion .tax-accordions__arrow').css('transform', 'rotate(180deg)');
    $('.tax-accordions__accordion.active .tax-accordions__arrow').css('transform', 'rotate(0)');
  });

})(jQuery)