<?php
include 'include/header.php';
?>
    <div class="register-page">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Resumen</a>
            </li>
            <li class="breadcrumb-item active">Noticias</li>
            <li class="breadcrumb-item active">Crear noticia</li>
        </ol>
        <div class="container p-5">
            <div class="row mb-5">
                <div class="col-md-12" id="usernew_container">
                    <form action="" method="post" id="news-form" autocomplete="off" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="jumbotron jumbotron-fluid">
                                <div class="container">
                                    <h1 class="display-4 text-center">
                                        <i class="fa fa-newspaper pr-4"></i>Crear noticia</h1>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Imagen Cabecera</label>
                            <div class="input-group">
                                <div class="custom-file" id="customFile">
                                    <input type="file" class="custom-file-input dataNews" id="image" aria-describedby="" name="url_foto_noticia">
                                    <label class="custom-file-label" for="exampleInputFile">
                                        Seleccionar Archivo
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <img src="../../../assets/images/1280x720.png" class="img-fluid cover" alt="Responsive image">
                        </div>
                        <div class="form-group">

                            <label>Titulo</label>
                            <input type="text" class="form-control dataNews" placeholder="Ejemplo: Celebración en..." id="" name="titulo" val="">
                        </div>

                        <div class="form-group">
                            <label>Cuerpo de la noticia:</label>
                            <textarea class="form-control dataNews" placeholder="" name="cuerpo" id="cuerpo"></textarea>

                        </div>
                        <div class="form-group">
                            <span class="float-right">
                                <input  data-toggle="toggle" data-on="Publicada" data-off="Borrador" data-onstyle="success" data-offstyle="danger"
                                    type="checkbox" name="publicada" id="estado">
                            </span>
                        </div>
                        <button type="submit" class="btn btn-success" id="crear">Crear Noticia</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
include 'include/footer.php';
?>