(function($) {
  let mega_menu = $('.nav-desktop .is-mega.type-b');
  if (mega_menu.length == 0) {
    return false;
  }

  mega_menu.each(function() {
    let curr_mega = $(this);
    let current_page_el = curr_mega.find('.current-menu-item');

    // Add wrapper
    curr_mega.find('.sub-menu').removeClass('sub-menu').addClass('sub-menu-list');
    curr_mega.find('.sub-menu-list').wrap('<div class="sub-menu"></div');
    let mega_wrap = curr_mega.find('.sub-menu');


    // Append images to wrapper
    mega_wrap.append('<div class="imgs-wrap"></div>');
    let imgs_wrap = mega_wrap.find('.imgs-wrap');
    let menu_icons = curr_mega.find('.menu-icon');
    menu_icons.each(function() {
      imgs_wrap.append($(this));
    });

    // Default img on enter
    let default_img = current_page_el.length > 0 ? menu_icons.eq(current_page_el.index() + 1) : menu_icons.first();
    let active_img = default_img;
    menu_icons_toggle(menu_icons, active_img);

    // IMG hover reveal
    curr_mega.find('.menu-item').on('mouseenter', function() {
      let i = $(this).index();
      let active_img = menu_icons.eq(i + 1);
      menu_icons_toggle(menu_icons, active_img);
    });

    // Default IMG on mouseleave
    mega_wrap.on('mouseleave', function() {
      let active_img = default_img;
      menu_icons_toggle(menu_icons, active_img);
    });
  });




  function menu_icons_toggle(menu_icons, active_img) {
    menu_icons.removeClass('active');
    active_img.addClass('active');
  }




})(jQuery)