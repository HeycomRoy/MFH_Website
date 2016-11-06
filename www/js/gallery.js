$(document).ready(function () {

  // find the elements to be eased and hook the hover event
  $('div.jimgMenu ul li a').hover(function() {
    
    // if the element is currently being animated (to a easeOut)...
    if ($(this).is(':animated')) {
      $(this).stop().animate({width: "500px"}, {duration: 500, easing:"easeOutQuad"});
    } else {
      // ease in quickly
      $(this).stop().animate({width: "500px"}, {duration: 550, easing:"easeOutQuad"});
    }
  }, function () {
    // on hovering out, ease the element out
    if ($(this).is(':animated')) {
      $(this).stop().animate({width: "100px"}, {duration: 550, easing:"easeInOutQuad"})
    } else {
      // ease out slowly
      $(this).stop('animated:').animate({width: "100px"}, {duration: 500, easing:"easeInOutQuad"});
    }
  });
});