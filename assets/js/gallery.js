$(function () {
$(".overlay-close").click(function () {
  $('.overlay-carousel').addClass("d-none");
  $('body').removeClass("no-scroll");
});
var slideIndex = 1;
mostrar_galeria();
});
// Next/previous controls
function plusSlides(n) {
  slideIndex += n;
  showSlides(slideIndex);
}

// Thumbnail image controls    
function currentSlide(n,id) {
  $('body').addClass("no-scroll");
  $('.overlay-carousel').removeClass("d-none");
  showSlides(slideIndex = n,id);
  
}

function mostrar_galeria() {
  var parametros = {
      "listado_publico": "1"
  };
  $.ajax({
      data: parametros,
      url: '../../controller/GaleriaC.php',
      type: 'GET',
      success: function (response) {
          try {
              var json = JSON.parse(response);
              console.log(json);
              var c = 0;
            

          } catch (err) {}

      }
  });
}