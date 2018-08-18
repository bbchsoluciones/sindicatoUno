/* Demo Scripts for Bootstrap Carousel and Animate.css article
* on SitePoint by Maria Antonietta Perna
*/


(function($) {
    //Function to animate slider captions
    function doAnimations(elems) {
      //Cache the animationend event in a variable
      var animEndEv = "webkitAnimationEnd animationend";
  
      elems.each(function() {
        var $this = $(this),
          $animationType = $this.data("animation");
        $this.addClass($animationType).one(animEndEv, function() {
          $this.removeClass($animationType);
        });
      });
    }
  
    //Variables on page load
    var $myCarousel = $("#myCarousel"),
      $firstAnimatingElems = $myCarousel
        .find(".carousel-item:first")
        .find("[data-animation ^= 'animated']");
  
    //Initialize carousel
    $myCarousel.carousel();
  
    //Animate captions in first slide on page load
    doAnimations($firstAnimatingElems);
  
    //Other slides to be animated on carousel slide event
    $myCarousel.on("slide.bs.carousel", function(e) {
      var $animatingElems = $(e.relatedTarget).find(
        "[data-animation ^= 'animated']"
      );
      doAnimations($animatingElems);
    });

    var scrollTop = window.pageYOffset

    $(window).on("scroll resize", function() {
      scrollTop = window.pageYOffset;
    });
    $(".slide").each(function() {
     
      var parallaxImage = $(this);
      var parallaxOffset = parallaxImage.offset().top;
      var yPos;
      var coords;
  
      $(window).on("scroll resize", function() {
        yPos = -(parallaxOffset - scrollTop) / 2;
        coords = '50% ' + yPos + 'px';
  
        parallaxImage.css({
          backgroundPosition: coords
        });
      });
    });
  })(jQuery);