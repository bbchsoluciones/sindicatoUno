<?php
include 'include/header.php';
?>
<div class="gallery pr-0 position-relative">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Resumen</a>
        </li>
        <li class="breadcrumb-item active">Galería</li>
        <li class="breadcrumb-item active">Administrar</li>
    </ol>

    <div class="overlay_data_trabajador d-none">
        <div class="loadData_container">
            <img src="../../../assets/images/load_data.gif" width="100">
        </div>
    </div>
    <div class="row m-0" id="list-images"></div>
    <div class="overlay-carousel d-none">
    <div class="overlay-container-carousel">
      <div class="container">
        <div class="slidesContainer"></div>
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