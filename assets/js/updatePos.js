

function updatePos() {

  $.ajax({
    type:'POST',
    url: 'functions/updatePos.php',
    dataType: 'json',
    data: null,
    success:function(data) {

    }
  });
}
