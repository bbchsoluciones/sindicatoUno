<?php 
  include('include/header.php');
?>

<div class="home-page">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="overlay-image"></div>
        <div class="first-slide slide" style=" background: url('../../assets/images/1920x1080-2.png') top center no-repeat"></div>
        <div class="container">
          <div class="carousel-caption text-left" data-animation="animated bounceInLeft">
            <h1 data-animation="animated bounceInLeft">
              <span>Example headline.</span>
            </h1>
            <p data-animation="animated bounceInUp" class="carousel-text">
              <span>
                Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id
                dolor id nibh ultricies vehicula ut id elit.
              </span>
            </p>
            <p data-animation="animated fadeInUp">
              <a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a>
            </p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div class="overlay-image"></div>
        <div class="first-slide slide" style=" background: url('../../assets/images/1920x1080-2.png') top center no-repeat"></div>
        <div class="container">
          <div class="carousel-caption" data-animation="animated bounceInLeft">
            <h1 data-animation="animated bounceInLeft">Another example headline.</h1>
            <p data-animation="animated bounceInUp">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.
              Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
            <p>
              <a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a>
            </p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div class="overlay-image"></div>
        <div class="first-slide slide" style=" background: url('../../assets/images/1920x1080-2.png') top center no-repeat"></div>
        <div class="container">
          <div class="carousel-caption text-right" data-animation="animated bounceInLeft">
            <h1 data-animation="animated bounceInLeft">One more for good measure.</h1>
            <p data-animation="animated bounceInUp">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.
              Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
            <p>
              <a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a>
            </p>
          </div>
        </div>
      </div>
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
      <h1>Find a quality and right headphones not easy</h1>
      <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores porro ad earum est voluptates consequatur quam.
        Qui id illo nisi dolores quidem maxime, ab, nobis consectetur, dolore placeat similique! Animi.A nesciunt, eius dolores
        magnam facere consectetur totam cupiditate, rem et quam commodi fugit rerum magni debitis sit quasi deleniti. Atque
        vel consectetur, mollitia repellendus voluptas corrupti odio accusantium architecto! Learn More...</p>
    </div>
  </div>

  <div class="home-text bg-info text-white">
    <div class="container">
      <h1 class="text-center p-5">We will help you to choose the best headphones!</h1>
    </div>
  </div>

  <div class="cards">
    <div class="container">

      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <img class="card-img-top" src="../../assets/images/1280x720.png" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title"><span>Nosotros</span></h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
            <a href="about.php" class="btn">
              <i class="fa fa-share-square"></i>
            </a>

          </div>
        </div>
        <div class="col-md-4 mt-md-0 mt-sm-2 mt-2">
          <div class="card">
            <img class="card-img-top" src="../../assets/images/1280x720.png" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title"><span>Galeria</span></h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
            <a href="gallery.php" class="btn">
              <i class="fa fa-share-square"></i>
            </a>
          </div>
        </div>
        <div class="col-md-4 mt-md-0 mt-sm-2 mt-2">
          <div class="card">
            <img class="card-img-top" src="../../assets/images/1280x720.png" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title"><span>Contacto</span></h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
            <a href="contact.php" class="btn">
              <i class="fa fa-share-square"></i>
            </a>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>
<?php 
  include('include/footer.php');
?>
