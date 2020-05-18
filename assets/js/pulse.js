$(document).ready(function(){
  setInterval(function() {
    $('#pos').toggleClass("pulse infinite");
  }, 2000);


  // Script for setting dynamic height for login-wrapper.
  function qWidth(){
  var qWidth = $('.pos').height();
  $('.pos').css('width', qWidth + 'px');
  }

  // Run fillHeight on page load.
  qWidth();

  // Re-run fillHeight everytime the page browser height or
  // width is resized.
  $(window).resize(function() {
  qWidth();
  });
})
