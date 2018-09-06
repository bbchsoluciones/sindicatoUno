<?php 
  include('include/header.php');
  include('../../controller/PrincipalC.php');
  $count = 0;
?>

<div class="home-page">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <?php for($i=0;$i<count($principal['carousel']);$i++): ?>
      <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" class="<?php echo $var = ($i === 0 ? 'active' : ''); ?>"></li>
      <?php endfor; ?>
    </ol>
    <div class="carousel-inner">
      <?php for($i=0;$i<count($principal['carousel']);$i++):
    ?>
      <div class="carousel-item <?php echo $var = ($i === 0 ? 'active' : ''); ?>">
        <div class="overlay-image"></div>
        <div class="first-slide slide" style=" background: url(<?php echo $principal['carousel'][$i]['url_foto']; ?>) top center no-repeat"></div>
        <div class="container">
          <div class="carousel-caption  <?php echo $principal['carousel'][$i]['alineacion_texto']; ?>" style="color:<?php echo $principal['carousel'][$i]['color_texto']; ?>">
            <h1 data-animation="animated fadeInLeft">
              <span>Example headline.</span>
            </h1>
            <p data-animation="animated  <?php echo $principal['carousel'][$i]['animacion']; ?>" class="carousel-text">
              <span>
                Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget
                metus. Nullam id
                dolor id nibh ultricies vehicula ut id elit.
              </span>
            </p>
            <p data-animation="animated fadeInUp">
              <a class="btn btn-lg btn-primary" href="<?php echo $principal['carousel'][$i]['url_link']; ?>" target="_blank" role="button">Ver más</a>
            </p>
          </div>
        </div>
      </div>
      <?php endfor; ?>
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  <div class="home-text">
    <div class="container">
      <h1>
        <?php echo $principal['presentacion'][0]['titulo_']; ?>
      </h1>
      <p class="text-justify">
        <?php echo $principal['presentacion'][0]['descripcion_']; ?>
      </p>
    </div>
  </div>

  <div class="home-text bg-info text-white">
    <div class="container">
      <h1 class="text-center p-5">
        <?php echo $principal['destacado'][0]['titulo_']; ?>
      </h1>
    </div>
  </div>

  <div class="cards">
    <div class="container">

      <div class="row">
        <?php foreach($principal['tarjeta'] as $tarjeta): ?>
        <div class="col-md-4">
          <div class="card">
            <img class="card-img-top" src="<?php echo $tarjeta['url_foto']; ?>" alt="Card image cap">
            <div class="card-body" style="background-color:<?php echo $tarjeta['color_fondo']; ?> ; color: <?php echo $tarjeta['color_texto']; ?> ; ">
              <h5 class="card-title"><span>
                  <?php echo $tarjeta['titulo_']; ?></span></h5>
              <p class="card-text">
                <?php echo $tarjeta['descripcion_']; ?>
              </p>
            </div>
            <a href="<?php echo $tarjeta['url_link']; ?>" class="btn">
              <i class="fa fa-share-square"></i>
            </a>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
<?php 
  include('include/footer.php');
?>