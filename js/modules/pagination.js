(function($) {

  let pagination = $('.pagination');

  pagination.find('.btn').on('click', function() {

    // Toggle btns
    pagination.find('.btn.active').removeClass('active');
    $(this).addClass('active');

    let result_set = $(this).data('result-set');
    let results = $(pagination.data('results'));
    let active_items = results.find('.item.active');
    let new_active_items = results.find('.item[data-result-set="' + result_set + '"]');
    let transition = 0;

    // Toggle items
    active_items.removeClass('active');

    // Scroll to results
    $('html, body').animate({
      scrollTop: results.offset().top - 100
    }, 1000, function() {});

    setTimeout(function() {
      active_items.addClass('none');
      new_active_items.removeClass('none');
      new_active_items.addClass('active');


    }, transition);


  });

})(jQuery)