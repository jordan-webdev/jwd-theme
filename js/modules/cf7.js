(function($) {

  $('.wpcf7 label').each(function(i, v) {
    //let el = $(v);
    //let old_id = $(this).attr('for');

    //assign_new_id(el, old_id);
  });

  $('.wpcf7 select').each(function() {
    $(this).parent('span').addClass('common-select');
  })



  function assign_new_id(el, old_id) {
    let new_id = old_id + '-' + (1 + Math.floor(Math.random() * 1000));

    if ($('#' + new_id).length > 0) {
      assign_new_id(el, old_id)
    } else {
      $('#' + old_id).attr('id', new_id);
      el.attr('for', new_id);
    }

  }



})(jQuery)