(function($) {

  var main_popup = $('.main-popup');
  var hide_popup = sessionStorage.getItem("hide_main_popup");

  if (hide_popup == "y") {
    main_popup.remove();
  } else {
    main_popup.addClass('active');
  }

  $('.main-popup').on('click', function() {
    sessionStorage.setItem("hide_main_popup", "y");
    main_popup.remove();
  });

})(jQuery)