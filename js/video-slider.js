(function($) {

  // Object fit for IE / Edge
  objectFitVideos(document.querySelectorAll('.video-slider .video'));

  var isIE11 = !!window.MSInputMethodContext && !!document.documentMode;

  var video_duration = 5000;
  var i = 0;
  var max = $('.video-slider .slide').length;

  if (isIE11) {
    console.log("IE");
    setTimeout(function() {
      // Slider loop
      video_slider(i, max);
      var vid_loop = setInterval(function() {
        i = set_count(i, max);
        video_slider(i, max);
      }, video_duration);

      // Progress Bars loop
      progress_bars(i);
      var circles_loop = setInterval(function() {
        progress_bars(i);
      }, video_duration);
    }, 1000);
  } else {
    // Slider loop
    video_slider(i, max);
    var vid_loop = setInterval(function() {
      i = set_count(i, max);
      video_slider(i, max);
    }, video_duration);

    // Progress Bars loop
    progress_bars(i);
    var circles_loop = setInterval(function() {
      progress_bars(i);
    }, video_duration);
  }



  // Prev and Next buttons
  $('.video-slider .nav-btn').on("click", function() {
    clearInterval(vid_loop);
    clearInterval(circles_loop);

    i = $('.video-slider .nav-btn').index(this);

    video_slider(i, max);

    progress_bars(i);
  });




  function animate_progress_bar(i) {

    // Toggle active
    $('.video-slider .nav .js-active-toggle.active').removeClass("active");
    $('#progress-bar-' + i).closest(".video-slider .nav-item").addClass("active").find(".js-active-toggle").addClass("active");

    var line = new ProgressBar.Circle("#progress-bar-" + i, {
      strokeWidth: 3,
      easing: 'linear',
      duration: video_duration,
      color: '#85CDCA',
      trailColor: 'transparent',
      trailWidth: 1,
    });

    line.animate(1.0); // Number from 0.0 to 1.0
  }




  function progress_bars(i) {
    // Remove previous circles
    $('.video-slider .nav svg').remove();

    animate_progress_bar(i);

  }




  function set_count(i, max) {

    // Forward progression loop
    if (i + 1 == max) {
      i = 0;
    } else {
      i++;
    }

    return i;
  }




  function video_slider(i, max) {

    var curr_item = $('.video-slider .slide').eq(i)
    var $curr_item = $(curr_item);

    $('.video-slider .slide.active').removeClass("active");
    $('.video-slider .slide .js-active-toggle.active').removeClass("active");

    $curr_item.addClass("active");
    $curr_item.find(".js-active-toggle").addClass("active");

    $('.video-slider .video').each(function() {
      $(this)[0].pause();
      $(this)[0].currentTime = 0;
    });

    $curr_item.find("video")[0].play();
  }

})(jQuery)
