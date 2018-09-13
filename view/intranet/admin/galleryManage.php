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
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                <button class="btn btn-link">
                    <i class="fa fa-images pr-2"></i>
                    Listado
                </button>
            </h5>
        </div>
        <div class="card-body">
            <div class="row m-0">
                <div class="col-md-4 p-0">
                    <div class="card normal" style="background: url('../../../assets/images/1280x720.png') top center no-repeat">
                        <a href="#">
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
                                <div class="title text-center animated fadeInUp">
                                    Imagen 1
                                </div>
                            </div>
                        </a>
                        <div class="destacado cursor">
                            <i class="far fa-star p-2"></i>
                            <input id="destacado" type="text" class="d-none" value="">
                        </div>

                        <div class="del-img cursor">
                            <i class="fa fa-trash p-2"></i>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php
include 'include/footer.php';
?>