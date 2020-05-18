$(document).ready(function(){
  function closeNotice() {
    $('.top-notice').addClass('hidden');
  };
  setInterval(function(){ closeNotice(); }, 10000);
  $( "#close-notice" ).click(function() {
    closeNotice();
  });
})
