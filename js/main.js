(function($) {

  // Click Banner
  click_banner();

  function click_banner() {
    $(document).on('click-banner-added', function() {
      $('body').on('click', function() {
        $('.js-click-banner').remove();
      });
    });
  }




  //Close button
  //closeBtn();

  function closeBtn() {
    $('.close-btn').on('click', function() {
      var target = $(this).attr('data-closes');
      $(target).fadeTo(0, 1000, function() {
        $(this).remove();
      });
    });
    $('.css-close-btn').on('click', function() {
      var target = $(this).attr('data-closes');
      $(target).removeClass('active');
    });
  }




  //Responsive BG images
  //responsiveBG();

  function responsiveBG() {
    $('.js-responsive-bg').each(function() {
      var that = $(this);
      var mq = window.matchMedia('(min-width: 1190px)');
      if (mq.matches) {
        //Preload
        $('<img/>').attr('src', $(this).attr('data-lg-bg')).on('load',
          function() {
            $(this).remove(); // prevent memory leaks as @benweet suggested
            that.css('background-image', 'url(' + that.attr(
              'data-lg-bg') + ')');
            requestAnimationFrame(function() {
              setTimeout(function() {
                that.addClass('active');
                that.find('.loader').addClass('active');
              }, 200); //Edit this value depending on the image

            });
          });
      } else {
        //Preload
        if ($(this).data('sm-bg')) {
          $('<img/>').attr('src', $(this).attr('data-sm-bg')).on('load', function() {
            $(this).remove(); // prevent memory leaks as @benweet suggested
            that.css('background-image', 'url(' + that.attr('data-sm-bg') + ')');
            requestAnimationFrame(function() {
              setTimeout(function() {
                that.addClass('active');
                that.find('.loader').addClass('active');
              }, 400); //Edit this value depending on the image
            });
          });
        }
      }
    });
  }




  // ReCaptcha
  jwd_recaptcha();

  function jwd_recaptcha() {
    $('form.wpcf7-form input, form.wpcf7-form textarea').on('focus', function() {
      $('.grecaptcha-badge').addClass('active');
    });
  }




  // Not Clickable
  $('.not-clickable').on('click', function() {
    return false;
  });




  // Remove hash URL navigation from Fancybox
  if ($.fancybox) {
    $.fancybox.defaults.hash = false;
  }

})(jQuery)
