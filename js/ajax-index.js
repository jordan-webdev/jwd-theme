(function($) {
  /* ********** *CATEGORY SELECT + DESCRIPTION ******************* */

  //Update the hrefs for filter links (if any) for the first time
  updateFilterHrefs(true);

  // Ajax load content on link click
  $('body').on('click', '.js-ajax-link, .js-ajax-link-wrap a', function(e) {

    if ($(this).parent('li').hasClass('not-clickable')) {
      return false;
    }

    var clickedLink = $(this);
    var slug = $(this).attr('data-slug');
    var href = $(this).attr('href');
    href = href.replace(" ", "%20");
    var target = $('.js-ajax-content-container');
    var singleSlug = $(this).attr('data-single-slug');

    // Prevent clicking until load
    $('.drop-down--filters__sub-item, .drop-down__all').addClass('not-clickable');

    // Results
    target.fadeTo(300, 0.3, function() {
      // Show Ajax loader
      $('.two-column-item__ajax-loader').addClass('active');
      target.load(href + ' .js-ajax-results', function(data) {
        // Hide Ajax loader
        $('.two-column-item__ajax-loader').removeClass('active');
        //var newURL = singleSlug ? '/new_era/blog/' + slug + '/' + singleSlug:  '/new_era/blog/' + slug + '/';
        var getUrl = window.location;
        var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
        //var newURL = href.replace(baseUrl, '');
        var newURL = href.replace('https://dolcedev.com', '');
        window.history.replaceState({}, '', newURL);

        // Colour toggle the selected link for filters (if any)
        clickedLink.prev('.js-filter-box').toggleClass('is-active');

        //Remove the colour toggle for all if all was not selected, or remove it from every other one if all was selected
        if (!(clickedLink.hasClass('js-filter-link-all') || clickedLink.hasClass('js-pagination-link'))) {
          $('.js-filter-box-all.is-active').removeClass('is-active');
        } else {
          $('.js-filter-box.is-active').not('.js-filter-box-all').removeClass('is-active');
        }

        //Update the hrefs for filter links (if any)
        updateFilterHrefs(false);

        //Give phones some extra time to load
        let mq = window.matchMedia("(max-width: 450px)");
        if (mq.matches) {
          target.fadeTo(300, 1, function() {
            scroll_to_results();
          });
        } else {
          target.fadeTo(300, 1, function() {
            scroll_to_results();
          });
        }

        // Allow clicking again
        $('.drop-down--filters__sub-item.not-clickable, .drop-down__all.not-clickable').removeClass('not-clickable');

        if (typeof a2a !== "undefined") {
          a2a.init('page');
        }

        // Load in JetPack lazy images
        $('.js-ajax-results img').each(function() {
          $(this).prop('src', $(this).data('lazy-src'));
        });

        // Add height to the image loaded with AJAX, to accomodate for Safari issue with AJAX-loaded images that have srcset
        setTimeout(function() {
          add_height_to_thumbnail();
        }, 50);
        
        // Add link text that has not been place inside of links properly
        $('.js-ajax-results a:empty').html($(this).data("link-text"));

        // Create a trigger for use in other scripts
        $(document).trigger('ajax-index-complete');
        
        // Trigger JetPack Lazy Load
        $(document.body).trigger('post-load');

      }); // End load
    });


    // Add height to the image loaded with AJAX, to accomodate for Safari issue with AJAX-loaded images that have srcset
    $(window).on('resize', function() {
      add_height_to_thumbnail();
    });

    //Pagination
    var paginationTarget = $('.ajax-pagination');
    paginationTarget.fadeTo(300, 0.3, function() {
      paginationTarget.load(href + ' .js-ajax-pagination', function() {
        paginationTarget.fadeTo(300, 1);
      });
    });


    //Document title
    $('title').load(href + ' title', function(data) {
      document.title = $(this).text();
    });

    return false;
  }); // End link/button click

  // Color highlighting
  $('body').on('click', '.js-category-selector-link', function() {
    $('.js-category-selector-link.active').removeClass('active');
    $(this).addClass('active');
  });

  //Categories dropdown
  var mq = window.matchMedia("(max-width: 1086px)");
  if (mq.matches) {
    $('#categories-wrapper').slideUp(1);
    $('.js-categories-wrapper-toggle, .js-category-selector-link').on('click', function() {
      $('#categories-wrapper').slideToggle();
      $('.js-categories-wrapper-toggle').toggleClass('active');
    });
  }

  function add_height_to_thumbnail() {
    var images = [$('.js-blog-single-thumb')];
    $.each(images, function() {
      $(this).each(function(i, v) {
        var width = $(v).attr('width');
        var height = $(v).attr('height');
        var ratio = height / width;
        var actual_width = $(v).width();
        var new_height = actual_width * ratio;
        $(v).height(new_height);
      });
    });

  }

  function scroll_to_results() {
    //Scroll page
    var el_to_scroll = $('#js-ajax-scroll-to');
    $('html,body').animate({
      scrollTop: (el_to_scroll.offset().top - 150)
    }, 'slow');
  }

  function updateFilterHrefs(firstLoad) {

    $('.js-filter-link').each(function() {
      var value = $(this).attr('data-filter-value').replace(" ", "%20");
      var key = $(this).attr('data-filter-key');
      var currentHref = window.location.href;
      var delimiter = currentHref.indexOf('?') > -1 ? "&" : "?";

      if (firstLoad) {
        var updatedHref = currentHref.split("?")[0];
        updatedHref = updatedHref + "?" + key + "=" + value;
        $(this).attr('href', updatedHref);
      } else {
        var updatedHref = currentHref + delimiter + key + "=" + value;
        updatedHref = updatedHref.replace(/\/page\/[0-9]\//g, "");
        updatedHref = updatedHref.replace(/%5B[0-9]%5D/g, "[]");
        $(this).attr('href', updatedHref);
      }
    }).promise().done(function() {
      //Remove the key and value of active filters from their hrefs, so that they get deselected on click
      $('.js-filter-box.is-active').next('.js-filter-link').each(function() {
        var key = $(this).attr('data-filter-key');
        var value = $(this).attr('data-filter-value');
        var value2 = value.replace(" ", "%20");
        var value3 = value.replace(" ", "+");
        var href = $(this).attr('href');
        updatedHref = href.replaceAll("&" + key + "=" + value, "").replaceAll("&" + key + "=" + value2, "").replaceAll("&" + key + "=" + value3, "");
        updatedHref = updatedHref.replaceAll(key + "=" + value, "").replaceAll(key + "=" + value2, "").replaceAll(key + "=" + value3, "");
        $(this).attr('href', updatedHref)
      });
    });

    //Removing any improperly encoded entities and duplicates from the pagination links
    tidyPaginationLinks();
  }

  function tidyPaginationLinks() {
    $('a.page-numbers').each(function() {
      var href = $(this).attr('href');
      var hrefBeforeGETQueries = href.split("?")[0];
      var GETQueriesString = href.split("?")[1];
      GETQueriesString = GETQueriesString ? GETQueriesString : href;
      GETQueriesString = GETQueriesString.replace(/#038;/g, "&");
      var GETQueriesArray = GETQueriesString.split("&");
      //console.log(GETQueriesArray);
      var uniqueGETQueriesArray = array_unique(GETQueriesArray);
      //console.log(uniqueGETQueriesArray);
      var updatedHref = hrefBeforeGETQueries + "?";

      var finalIteration = Object.keys(uniqueGETQueriesArray).length - 1;
      $.each(uniqueGETQueriesArray, function(index, value) {
        updatedHref = index == finalIteration ? updatedHref + value : updatedHref + value + "&";
      })
      //var updatedHref = href.replace(/#038;/g, "&");
      updatedHref = updatedHref.replace(/%5B[0-9]%5D/g, "[]");
      $(this).attr('href', updatedHref);

    })
  }

})(jQuery)
