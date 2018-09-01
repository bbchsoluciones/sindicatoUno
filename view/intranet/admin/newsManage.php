<?php
include('include/header.php');
?>
<div class="newsManage-page pr-0 position-relative">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Resumen</a>
        </li>
        <li class="breadcrumb-item active">Noticias</li>
        <li class="breadcrumb-item active">Mostrar Noticias</li>
    </ol>

    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i> Noticias
        </div>
        <div class="card-body">
            <table class="table table-bordered display" id="tablaNoticias" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Imagen</th>
                        <th>Titulo</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                        <th>Por</th>
                        <th>Acción</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="overlay_newsE d-none">
        <div class="contenedor_newsE">
            <form action="" method="post" id="news-update-form" class="animated fadeIn" autocomplete="off" enctype="multipart/form-data">
                <button type="button" class="btn btn-primary" id="close_newsE"><i class="fa fa-times"></i></button>
                <div id="mensaje"></div>
                <div class="form-group">
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-5 text-center">
                                <i class="fa fa-newspaper pr-4"></i>Editar noticia</h1>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Imagen Cabecera</label>
                    <div class="input-group">
                        <div class="custom-file" id="customFile">
                            <input type="file" class="custom-file-input dataNews" id="image" aria-describedby="" name="url_foto_noticia">
                            <label class="custom-file-label text-dark" for="exampleInputFile">
                                Seleccionar Archivo
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <img src="../../../assets/images/1280x720.png" class="img-fluid cover_mediano" id="imagen_noticia" alt="Responsive image">
                </div>
                <div class="form-group">

                    <label>Titulo</label>
                    <input type="text" class="form-control dataNews" placeholder="Ejemplo: Celebración en..." id="titulo_noticia" name="titulo" val="">
                </div>

                <div class="form-group">
                    <label>Cuerpo de la noticia:</label>
                    <textarea class="form-control dataNews" placeholder="" name="cuerpo" id="cuerpo"></textarea>

                </div>
                <div class="form-group">
                    <span class="float-right">
                        <input data-toggle="toggle" data-width="100" data-on="Publicada" data-off="Borrador" data-onstyle="success" data-offstyle="danger"
                            type="checkbox" name="publicada" id="estado_noticia">
                    </span>
                </div>
                <input type="text" class="d-none" name="id_noticia" id="id_noticia"/>
                <button type="submit" class="btn btn-success" id="update_news">Guardar</button>
                <button type="button" class="btn btn-info" id="cancel_news">Cancelar</button>
            </form>
        </div>
    </div>


</div>

<?php
include('include/footer.php');
?>