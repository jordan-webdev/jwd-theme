(function($) {

  $('.accordions__pullout').slideUp(1);
  $('body').on('click', '.accordions__toggler', function() {
    var arrow = $(this);
    var pullout = $(this).next('.accordions__pullout');
    $(this).parent('.accordions__accordion').addClass('active');
    $('.accordions__pullout').not(pullout).slideUp(300).parent('.accordions__accordion').removeClass('active');
    pullout.slideDown(300);
  });

})(jQuery)
