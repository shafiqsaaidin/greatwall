$(document).ready(function(){
  var $scores = $("#progress");
  setInterval(function () {
    $scores.load("admin-main.php #progress");
  }, 10000);
});
