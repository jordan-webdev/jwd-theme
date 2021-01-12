(function($) {

  // Drop Down
  doDDL($('.drop-down__btn'));

  function doDDL(btn) {
    // Click animation
    btn.on('click forceclick', function(e) {
      var list = $(this).next('.drop-down__list');
      dropDownListToggle(list);

      // Rotate the arrow
      var caret = $(this).find('.drop-down__caret');
      caret.toggleClass('active');

    }); // Button click

    // Close drop down list on clicking a filter, and on mobile
    $('.drop-down--filters__link').on('click', function(){
      var list = $(this).closest('.drop-down__list');
      var mq = window.matchMedia( "(max-width: 600px)" );
      if (mq.matches){
        dropDownListToggle(list);
      }

    });

    function dropDownListToggle(list) {
      list.slideToggle();
    }

  } // doDDL function

})(jQuery)
