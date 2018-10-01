<?php
  include('include/header.php');
  include('../../controller/PrincipalC.php');
  ?>
<div class="container padding-about">
  <!-- Three columns of text below the carousel -->
  <h3 class="text-secondary pb-5"><i class="fa fa-users pr-3"></i>Quiénes Somos</h3>
  <div class="row justify-content-center">
    <div class="col-lg-3 text-center">
      <img class="rounded-circle" src="https://www.diariojuridico.com/wp-content/uploads/2014/10/daniel-rueda-silva-fotocarnet2.jpg" alt="Generic
          placeholder image" width="140" height="140">
      <h2 class="mt-3">Presidente</h2>
      <p class="m-0">Luis Mardones</p>
      <p class="m-0">luis.mardones@sinabrinks.cl</p>
      <p class="m-0">+56932253858</p>
      
      <hr class="featurette-divider">
    </div>
  </div>
  <div class="row mt-5">
    <!-- /.col-lg-4 -->
    <div class="col-lg-3 text-center">
      <img class="rounded-circle" src="http://3.bp.blogspot.com/-aAsPE0P5i3s/TuPMIjbC4JI/AAAAAAAAAEM/ZAcSRyvlRnU/s1600/para_curriculum.jpg" alt="Generic
          placeholder image" width="140" height="140">
      <h2 class="mt-3">Tesorero</h2>
      <p class="m-0">Ricardo Torres</p>
      <p class="m-0">ricardo.torres@sinabrinks.cl</p>
      <p class="m-0">+56932253857</p>
      
      <hr class="featurette-divider">
    </div>
    <!-- /.col-lg-4 -->
     <!-- /.col-lg-4 -->
     <div class="col-lg-3 text-center">
      <img class="rounded-circle" src="https://www.diariojuridico.com/wp-content/uploads/2014/10/daniel-rueda-silva-fotocarnet2.jpg" alt="Generic
          placeholder image" width="140" height="140">
      <h2 class="mt-3">Secretario</h2>
      <p class="m-0">Misael Rojas</p>
      <p class="m-0">misael.rojas@sinabrinks.cl</p>
      <p class="m-0">+56932253855</p>
      
      <hr class="featurette-divider">
    </div>
    <!-- /.col-lg-4 -->    
      <div class="col-lg-3 text-center">
          <img class="rounded-circle" src="https://www.diariojuridico.com/wp-content/uploads/2014/10/daniel-rueda-silva-fotocarnet2.jpg" alt="Generic
              placeholder image" width="140" height="140">
          <h2 class="mt-3">Director</h2>
          <p class="m-0">Dorys Villar</p>
          <p class="m-0">dorys.villar@sinabrinks.cl</p>
          <p class="m-0">+56932253856</p>
          
          <hr class="featurette-divider">
        </div>
        <!-- /.col-lg-4 -->
        <div class="col-lg-3 text-center">
            <img class="rounded-circle" src="http://3.bp.blogspot.com/-aAsPE0P5i3s/TuPMIjbC4JI/AAAAAAAAAEM/ZAcSRyvlRnU/s1600/para_curriculum.jpg" alt="Generic
                placeholder image" width="140" height="140">
            <h2 class="mt-3">Director</h2>
            <p class="m-0">Carlos Soto</p>
            <p class="m-0">carlos.soto@sinabrinks.cl</p>
            <p class="m-0">+56932253859</p>
            
            <hr class="featurette-divider">
          </div>
          <!-- /.col-lg-4 -->
  </div>
  <!-- /.row -->
  <?php for($i=0;$i<count($principal['nosotros']);$i++): ?>
  <div class="row featurette mt-3">
    <div class="col-md-7 align-self-center <?php echo $principal['nosotros'][$i]['alineacion_texto'] ?>">
      <h2 class="featurette-heading"><?php echo $principal['nosotros'][$i]['titulo_'] ?></h2>
      <p class="lead"><?php echo $principal['nosotros'][$i]['descripcion_'] ?></p>
    </div>
    <div class="col-md-5">
      <img class="featurette-image img-fluid mx-auto" src="<?php echo $principal['nosotros'][$i]['url_foto'] ?>" alt="Generic placeholder image">
    </div>
  </div>
  <hr class="featurette-divider">
<?php endFor; ?>
</div>
<?php
    include('include/footer.php');
?>