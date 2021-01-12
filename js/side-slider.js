(function($) {

  var images = window.location.origin + "/wp-content/themes/jwd-master/images";

  //Side Slider Mobile menu
  sideSliderMenu(true, true); //parameters (bool $add_logo, bool $fade_banner)
  function sideSliderMenu(logo, fadeBanner) {

    // Slide in on menu click
    $('#js-mobile-menu-toggle').on('click', function() {
      let menu = $(this).attr('data-toggles');
      slide_menu_animation(menu, fadeBanner);
    });

    // Setup submenus with headers and chevrons
    $('#mobile-menu .sub-menu').each(function() {
      $(this).prepend(
        '<li class="sub-menu-header">' +
        '<button class="sub-menu-back-button">' +
        '<img class="arrow left-arrow style-svg" src="' + images + '/pull-menu-left.svg" alt="" />' +
        '</button>' +
        $(this).prev('a').text() +
        '</li>'
      );
    });


    // Setup haschildren chevrons and wrappers
    $('#mobile-menu .menu-item-has-children').each(function() {
      $('> a', this).wrap(
        '<div class="menu-item-has-children-items-wrapper">').after(
        '<img class="arrow right-arrow style-svg" src="' + images + '/pull-menu-right.svg" alt="" />'
      )
    });


    // Close btn
    $('#mobile-site-navigation').prepend(
      '<button class="close-btn" data-toggles="#mobile-menu">' +
      'X' +
      '<span class="screen-reader-text">Click to toggle menu</span>' +
      '</button>'
    );

    $('#mobile-site-navigation .close-btn').on('click', function() {
      let menu = $(this).attr('data-toggles');
      slide_menu_animation(menu, fadeBanner, false, false);
    });


    // Sub menu animation
    $('#mobile-menu .menu-item-has-children').on('click', function() {

      let menu = $('> .sub-menu', this);
      let is_slide_in = !menu.hasClass('active');

      if (is_slide_in) {
        slide_menu_animation(menu, false);
      } else {
        slide_menu_animation(menu, false, false);
      }

      return false;
    });

    $('#mobile-menu .menu-item-has-children .sub-menu .menu-item:not(.menu-item-has-children) a').on('click', function(e) {
      e.stopPropagation();
    });


    // Logo
    if (logo) {
      $('#mobile-menu').prepend(
        '<li class="menu-logo-wrapper">' +
        '<a href="' + localizedVar.homeURL + '" >' +
        localizedVar.logo +
        '</a>' +
        '</li>'
      );
    }

  }



  // Slide Menu Animation
  function slide_menu_animation(menu, fadeBanner, anim_in = true, close_btn_anim_in = true) {
    $(menu).toggleClass('active');
    $('.sub-menu.active').not(menu).removeClass('active');

    // Menu items animation
    let menu_items = $(menu).find('> .menu-item');
    animate_menu_items(menu_items, anim_in);

    // Close btn animation
    animate_close_btn(close_btn_anim_in);

    if (fadeBanner) {
      menu = [$(menu), $('.sub-menu')];
      menuFadeBanner($(menu));
    }
  }



  // Fade banner (needed for side slider)
  function menuFadeBanner(menu) {
    if ($('#menu-fade-banner').length == 0) {
      $('.site-header').prepend(
        '<div id="menu-fade-banner" class="fade-banner js-scroll-blocker" data-toggles="#mobile-menu"><span class="screen-reader-text">Click to toggle menu</span></div>');
      $('#menu-fade-banner').on('click', function() {
        let menu = $(this).attr('data-toggles');
        slide_menu_animation(menu, true, false, false);
      });
    } else {
      $('.scroll-blocker').removeClass('scroll-blocker');
      $('#menu-fade-banner').remove();
    }
  }


  // Animate menu items
  function animate_menu_items(menu_items, anim_in) {
    menu_items.each(function(i, v) {
      setTimeout(function() {
        if (anim_in) {
          $(v).addClass('active');
        } else {
          $(v).removeClass('active');
        }
      }, (i + 1) * 200);
    });
  }



  // Animate close btn
  function animate_close_btn(anim_in) {
    let close_btn = $('#mobile-site-navigation').find('.close-btn');
    if (anim_in) {
      close_btn.addClass('active');
      setTimeout(function() {
        close_btn.addClass('active-b')
      }, 300);
    } else {
      close_btn.removeClass('active active-b');
    }
  }



})(jQuery)