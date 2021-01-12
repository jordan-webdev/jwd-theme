(function($) {

  var main_popup = $('.main-popup');
  var hide_popup = Cookies.get("hide_main_popup");

  if (hide_popup == "y") {
    main_popup.remove();
  } else {
    main_popup.addClass('active');
  }

  $('.main-popup').on('click', function() {
    Cookies.set("hide_main_popup", "y", {
      expires: 1
    });
    main_popup.remove();
  });

})(jQuery)
