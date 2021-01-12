(function($) {


  $('.float-label-wrap label').on('click', function() {
    let label = $(this);
    $(this).addClass('active');
  });

  $('.float-label-wrap input, .float-label-wrap textarea').on('focus', function() {
    let label = $(this).closest('.float-label-wrap').find('.float-label');
    label.addClass('active');
  });


})(jQuery)