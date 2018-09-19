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
function currentSlide(n) {
  $('body').addClass("no-scroll");
  $('.overlay-carousel').removeClass("d-none");
  showSlides(slideIndex = n);

}

function showSlides(n) {
  var i;
  var slides = $(".mySlides");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  if (n < 0) {
    slides[slides.length - 1].style.display = "block";
    slideIndex = slides.length - 1;
  } else if (n > slides.length - 1) {
    slides[0].style.display = "block";
    slideIndex = 0;
  } else if (n >= 0 && n < slides.length) {
    slides[n].style.display = "block";
  }

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
        var n = 0;
        for (var i = 0; i < json.galeria.length; i++) {
          if (parseInt(json.galeria[i].destacado) === 1) {
            n+=1;
            if (c === 0) {
              $(".topMain").append('<div class="card big" style="background: url(' + json.galeria[i].url_foto_galeria + ') top center">' +
                '<a class="cursor" onclick="currentSlide(' + c + ')">' +
                '<div class="overlay-card animated fadeIn" style="display:none">' +
                '<div class="container h-100">' +
                '<div class="row align-items-center h-100">' +
                '<div class="col-8 mx-auto">' +
                '<div class="text-center">' +
                '<i class="fa fa-search-plus animated zoomIn"></i>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</a>' +
                '</div>');
            } else {
              $(".topSecondary").append('<div class="col-md-6 sec_top">' +
                '<div class="card normal" style="background: url(' + json.galeria[i].url_foto_galeria + ') top center">' +
                '<a class="cursor" onclick="currentSlide(' + c + ')">' +
                '<div class="overlay-card animated fadeIn" style="display:none">' +
                '<div class="container h-100">' +
                '<div class="row align-items-center h-100">' +
                '<div class="col-8 mx-auto">' +
                '<div class="text-center">' +
                '<i class="fa fa-search-plus animated zoomIn"></i>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</a>' +
                '</div>' +
                '</div>');
            }
            
            $(".slidesContainer").append('<div class="mySlides animated fadeIn" id="slide_' + c + '">' +
              '<div class="numbertext">' + n + ' / ' + json.galeria.length + '</div>' +
              '<img src="' + json.galeria[i].url_foto_galeria + '">' +
              '</div>');
              c++;
              console.log(c)
          }
        }
        c--;
        for (var i = 0; i < json.galeria.length; i++) {
          if (parseInt(json.galeria[i].destacado) !== 1) {
            c+=1;
            n+=1;
            $(".galeria_normal").append('<div class="col-md-4 sec_top">' +
              '<div class="card normal" style="background: url(' + json.galeria[i].url_foto_galeria + ') top center">' +
              '<a class="cursor" onclick="currentSlide(' + c + ')">' +
              '<div class="overlay-card animated fadeIn" style="display:none">' +
              '<div class="container h-100">' +
              '<div class="row align-items-center h-100">' +
              '<div class="col-8 mx-auto">' +
              '<div class="text-center">' +
              '<i class="fa fa-search-plus animated zoomIn"></i>' +
              '</div>' +
              '</div>' +
              '</div>' +
              '</div>' +
              '</div>' +
              '</a>' +
              '</div>' +
              '</div>');
            $(".slidesContainer").append('<div class="mySlides animated fadeIn" id="slide_' + c + '">' +
              '<div class="numbertext">' + n + ' / ' + json.galeria.length + '</div>' +
              '<img src="' + json.galeria[i].url_foto_galeria + '">' +
              '</div>');
          }
        }

      } catch (err) {}

    }
  });
}