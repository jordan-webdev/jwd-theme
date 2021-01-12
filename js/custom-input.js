(function($) {

  // Custom radio buttons
  $('.js-radio').on("click", function() {
    var radio_item = $("#" + $(this).data("for"));
    var radio_group = $(radio_item).data("group");
    $('[data-group="' + radio_group + '"]').removeClass("active");
    $(radio_item).addClass("active");

  });

})(jQuery);
