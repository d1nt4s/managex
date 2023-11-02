$('.switch-btn').click(function(){
  $(this).toggleClass('switch-on');
  if (document.getElementsByClassName('table timelog')[0].style.display == "block") {
    document.getElementsByClassName('table timelog')[0].style.display = "none";
    document.getElementsByClassName('table time_analyze')[0].style.display = "block";
  } else {
    document.getElementsByClassName('table time_analyze')[0].style.display = "none";
    document.getElementsByClassName('table timelog')[0].style.display = "block";
  }
});