(function($) {

  var host_name = "https://" + window.location.hostname;

  $.jwd_dropdown_init = function() {
    $(".jwd-dropdown").each(function() {

      select = $(this);
      var existing = select.next(".jwd-dde");

      if (existing.length < 1) {

        // Custom placeholder
        var placeholder = select.find(".jwd-placeholder").text();
        placeholder = placeholder ? placeholder : select.find('option[value=""]').text();
        var matching_option = $(select).find("option.jwd-is-match");
        var selected = get_selected_text(placeholder, matching_option);

        var element = "<div class=\"jwd-dde\">";
        element += "<button class=\"jwd-dde__selected\" type=\"button\"> <span class=\"jwd-dde__selected-inner\"><span class=\"jwd-dde__selected-text\">" + selected + "</span><img class=\"jwd-dde__icon\" src=\"" + host_name + "/wp-content/uploads/more-min.png\" alt=\"\" /></span></button>";
        element += "<ul class=\"jwd-dde__list\">";

        $(select).find("option").each(function(i, v) {
          element += "<li class=\"jwd-dde__item " + (i == 0 ? "none" : "") + "\"><button class=\"jwd-dde__item-btn\" type=\"button\" data-val=\"" + $(this).val() + "\">" + $(this).text() + "</button></li>";
        });

        element += "</ul></div>"
        select.after(element);
      }
    });

    $('.jwd-dde__item-btn').on('click', function() {
      // On drop down click, update values

      var jwd_dde = $(this).closest(".jwd-dde");
      var list = jwd_dde.find('.jwd-dde__list');
      var select = jwd_dde.prev(".jwd-dropdown");
      var val = $(this).data("val");

      // Custom placeholder
      var placeholder = select.find(".jwd-placeholder").text();
      var matching_option = $(select).find("option.jwd-is-match");
      var text = $(this).text();

      update_jwd_dd(jwd_dde, list, select, val, text);
    });

    $('.jwd-dde').on("jwd-clear-dde", function() {

      var jwd_dde = $(this);
      var list = jwd_dde.find('.jwd-dde__list');
      var select = jwd_dde.prev(".jwd-dropdown");
      var text = select.find(".jwd-placeholder").text();

      clear_jwd_dd(jwd_dde, list, select, text);

    });

    $('.jwd-dde').on("jwd-update-dde", function() {
      // Update jwd-dde with the corresponding <select> value

      var jwd_dde = $(this);
      var list = jwd_dde.find('.jwd-dde__list');
      var select = $(this).prev(".jwd-dropdown");
      var val = $(select).val();

      // Custom placeholder
      var placeholder = select.find(".jwd-placeholder").text();
      var matching_option = $(select).find("option.jwd-is-match");
      var text = get_selected_text(placeholder, matching_option);

      update_jwd_dd(jwd_dde, list, select, val, text);
    });

    $('.jwd-dde').on("mouseenter", function() {
      $(this).find(".jwd-dde__list").addClass('active');
    });
    $('.jwd-dde').on("mouseleave", function() {
      $(this).find(".jwd-dde__list").removeClass('active');
    });
  }








  function clear_jwd_dd(jwd_dde, list, select, text) {
    select.find(".jwd-is-match").removeClass("jwd-is-match");
    select.find("option:selected").prop("selected", false);
    jwd_dde.find(".jwd-dde__selected-text").text(text);

    // Trigger change event
    jwd_dde.trigger("jwd-change");

    // Hide the dropdown
    list.removeClass("active");
  }




  function get_selected_text(placeholder, matching_option) {
    if (!matching_option.length > 0) {
      // If there are no matching options (from GET or POST queries), display the placeholder
      var selected = placeholder;
    } else {
      // Otherwise, display the selected text
      var selected = $(matching_option).text();
    }

    return selected;
  }




  function update_jwd_dd(jwd_dde, list, select, val, text) {

    select.find(".jwd-is-match").removeClass("jwd-is-match");
    select.find("option:selected").prop("selected", false);


    select.find("option[value=\"" + val + "\"]").prop("selected", true).addClass("jwd-is-match");


    jwd_dde.find(".jwd-dde__selected-text").text(text);

    // Trigger change event
    jwd_dde.trigger("jwd-change");

    // Hide the dropdown
    list.removeClass("active");
  }





  // Convert a select of class "jwd-drop-down" to a custom drop down element
  $.jwd_dropdown_init();

  $(document).on("jwd-dropdown-init", function() {
    $.jwd_dropdown_init();
  });

})(jQuery)
