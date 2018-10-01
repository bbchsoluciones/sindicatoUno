<?php
 require_once('include/header.php');
?>
<div class="gallery">
  <div class="container">
    <h3 class="text-secondary"><i class="fa fa-images pr-3"></i>Galería</h3>
    <div class="no_registros d-flex justify-content-center"></div>
    <div class="row m-0">
      <div class="col-md-6 topMain"></div>
      <div class="col-md-6 p-0">
        <div class="row m-0 topSecondary"></div>
      </div>
    </div>
    <div class="row m-0 galeria_normal"></div>
  </div>

  <div class="overlay-carousel d-none">
    <div class="overlay-container-carousel">
      <div class="container">
        <div class="slidesContainer"></div>
        <div class="overlay-close cursor">
          <i class="fa fa-times"></i>
        </div>
      </div>
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
  </div>
</div>
</div>

<?php
 require_once('include/footer.php');
?>