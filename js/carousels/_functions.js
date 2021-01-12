function toggle_videos(slider, currentSlide) {

  var all_videos = slider.find("video");
  var active_video = slider.find('[data-slick-index=' + currentSlide + ']').find("video");

  if (all_videos.length > 0) {
    all_videos[0].pause();
    all_videos[0].currentTime = 0;
  }

  if (active_video.length > 0) {
    active_video[0].play();
  }

}