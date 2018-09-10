<?php
include 'include/header.php';
?>
<div class="About1Manage-page pr-0 position-relative">
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
                    Galería
                </button>
            </h5>
        </div>
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data" id="js-upload-form">
                <h5 class="mb-3">Escoge imagenes desde tu dispositivo</h5>
                <div class="form-group">
                    <div class="input-group">
                        <div class="custom-file" id="customFile">
                            <input type="file" class="custom-file-input input_upload" aria-describedby="" name="files[]"
                                id="js-upload-files" multiple>
                            <label class="custom-file-label label_upload" for="exampleInputFile">
                                Seleccionar Archivos
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-row rounded p-2 img-preview"></div>
                <div class="d-flex justify-content-center align-items-center">
                    <button type="submit" class="btn btn-primary" id="js-upload-submit">Subir Archivos</button>
                </div>
            </form>


            <!-- Drop Zone -->
            <h5>O arrastra y suelta archivos abajo</h5>
            <div class="upload-drop-zone" id="drop-zone">
                Arrastra y suelta archivos aquí
            </div>

            <!-- Progress Bar -->
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                    style="width: 60%;">
                    <span class="sr-only">60% Complete</span>
                </div>
            </div>

            <!-- Upload Finished -->
            <div class="js-upload-finished my-3">
                <h5>Archivos subidos</h5>
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-success"><span class="badge alert-success pull-right">Success</span>image-01.jpg</a>
                    <a href="#" class="list-group-item list-group-item-success"><span class="badge alert-success pull-right">Success</span>image-02.jpg</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'include/footer.php';
?>