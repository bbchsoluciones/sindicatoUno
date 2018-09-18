<?php
include 'include/header.php';
include '../../controller/GaleriaC.php';
?>
<div class="gallery">


  <div class="container">
    <div class="gallery-header">
      <div class="container h-100">
        <div class="row align-items-center h-100">
          <div class="col-8 mx-auto">
            <h4 class="text-center">Destacadas</h4>
            <p class="text-justify">Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de
              texto. Lorem Ipsum ha sido el texto
              de relleno estándar de las industrias desde el año 1500, cuando un impresor
            </p>

          </div>
        </div>
      </div>
    </div>
    <div class="row m-0">
      <?php if (!empty($galeriaTOP[0]['id_foto_galeria'])): ?>
      <div class="col-md-6 p-0">
        <div class="card big" style="background: url('<?php echo $galeriaTOP[0]['url_foto_galeria']; ?>') top center">
          <a class="cursor" onclick="currentSlide(0,1)">
            <div class="overlay-card animated fadeIn" style="display:none">
              <div class="container h-100">
                <div class="row align-items-center h-100">
                  <div class="col-8 mx-auto">
                    <div class="text-center">
                      <i class="fa fa-search-plus animated zoomIn"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
      <?php endif;?>
      <div class="col-md-6 p-0">
        <div class="row m-0">
          <?php for ($i = 1; $i < count($galeriaTOP); $i++): ?>
          <div class="col-md-6 p-0">
            <div class="card normal" style="background: url('<?php echo $galeriaTOP[$i]['url_foto_galeria']; ?>') top center">
              <a class="cursor" onclick="currentSlide(<?php echo $i; ?>,1)">
                <div class="overlay-card animated fadeIn" style="display:none">
                  <div class="container h-100">
                    <div class="row align-items-center h-100">
                      <div class="col-8 mx-auto">
                        <div class="text-center">
                          <i class="fa fa-search-plus animated zoomIn"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <?php endfor;?>
        </div>
      </div>
    </div>
    <div class="gallery-header">
      <div class="container h-100">
        <div class="row align-items-center h-100">
          <div class="col-8 mx-auto">
            <h4 class="text-center">Últimas</h4>
            <p class="text-justify">Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de
              texto. Lorem Ipsum ha sido el texto
              de relleno estándar de las industrias desde el año 1500, cuando un impresor
            </p>

          </div>
        </div>
      </div>
    </div>
    <div class="row m-0">
      <?php for ($i = 0; $i < count($galeriaNOTOP); $i++): ?>
      <div class="col-md-4 p-0">
        <div class="card normal" style="background: url('<?php echo $galeriaNOTOP[$i]['url_foto_galeria']; ?>') top center">
          <a class="cursor" onclick="currentSlide(<?php echo $i; ?>,2)">
            <div class="overlay-card animated fadeIn" style="display:none">
              <div class="container h-100">
                <div class="row align-items-center h-100">
                  <div class="col-8 mx-auto">
                    <div class="text-center">
                      <i class="fa fa-search-plus animated zoomIn"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
      <?php endfor;?>
    </div>
  </div>

  <div class="overlay-carousel d-none animated fadeIn">
    <div class="overlay-container-carousel">

      <div class="container">
        <div class="slidesContainer">
          <?php $c=0; ?>
          <?php for ($i = 0; $i < count($galeri); $i++): $c+=1; ?>
          <div class="mySlides1 animated fadeIn" id="slide_ <?php echo $i; ?>">
            <div class="numbertext">
              <?php echo $c."/".count($galeriaTOP); ?>
            </div>
            <img src="<?php echo $galeriaTOP[$i]['url_foto_galeria']; ?>">
          </div>
          <?php endfor; ?>
          <div class="arrows">
            <div class="left-arrow">
              <span class="prev cursor" onclick="plusSlides(-1)">
                <i class="fa fa-chevron-left"></i>
              </span>
            </div>
            <div class="right-arrow">
              <span class="next cursor" onclick="plusSlides(1)">
                <i class="fa fa-chevron-right"></i>
              </span>
            </div>
          </div>
        </div>
        <div class="overlay-close cursor">
          <i class="fa fa-times"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include 'include/footer.php';
?>