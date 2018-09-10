<?php
include 'include/header.php';
?>
<div class="homeManage-page pr-0 position-relative">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Resumen</a>
        </li>
        <li class="breadcrumb-item active">Inicio</li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
    <div id="mensaje"></div>
    <div id="accordion" class="mb-3">
        <div class="card">
            <div class="card-header" id="headingCarousel">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseCarousel" aria-expanded="true"
                        aria-controls="collapseCarousel">
                        <i class="far fa-images pr-2"></i>
                        Carousel
                    </button>
                </h5>
            </div>

            <div id="collapseCarousel" class="collapse show" aria-labelledby="headingCarousel" data-parent="#accordion">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="add-imageC">
                                <button type="button" id="nueva" class="btn btn-success mb-2 p-0 w-100 d-flex justify-content-center rounded-0 align-items-center">
                                    <h1><i class="fa fa-plus pr-3"></i><i class="far fa-image"></i></h1>
                                </button>
                                <div class="carousel_list"></div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="overlay_data_trabajador">
                                <div class="loadData_container">
                                    <img src="../../../assets/images/load_data.gif" width="100">
                                </div>
                            </div>
                            <form action="" id="carousel_form" class="d-none">
                                <input type="text" val="" name="id_texto" class="d-none dataCarousel" id="id_texto">
                                <div class="mb-3 d-flex justify-content-center align-items-center bg-secondary">
                                    <img src="../../../assets/images/1280x720.png" class="image_carousel cover_mediano dataCarousel url_foto"
                                        alt="Responsive image">
                                </div>
                                <div class="form-group">
                                    <label>Subir imagen</label>
                                    <div class="input-group">
                                        <div class="custom-file" id="customFile">
                                            <input type="file" class="custom-file-input input_carousel dataCarousel"
                                                aria-describedby="" name="imagen">
                                            <label class="custom-file-label label_carousel" for="exampleInputFile">
                                                Seleccionar Archivo
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Título</label>
                                    <input type="text" class="form-control dataCarousel" id="" name="titulo_" val="">
                                </div>
                                <div class="form-group">
                                    <label>Descripción</label>
                                    <textarea class="form-control dataCarousel" placeholder="" name="descripcion_"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Url</label>
                                    <input type="text" class="form-control dataCarousel" id="" name="url_link" val="">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Alinear texto</label>
                                        <select id="alinear_texto" class="form-control dataCarousel" name="alineacion_texto">
                                            <option selected value="text-left">Izquierda</option>
                                            <option value="text-right">Derecha</option>
                                            <option value="text-center">Centro</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Animación texto</label>
                                        <select id="animacion_texto" class="form-control dataCarousel" name="animacion">
                                            <option value="fadeIn" selected>Desvanecimiento</option>
                                            <option value="bounceIn">Rebote</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mb-2">
                                    <label>Color Texto</label>
                                    <input id="color1" class="dataCarousel" value="" name="color_texto">
                                </div>
                                <button type="submit" class="btn btn-success" id="guardar-home">Guardar</button>
                                <button type="button" class="btn btn-danger" id="eliminar_home">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne"
                            aria-expanded="false" aria-controls="collapseOne">
                            <i class="fa fa-child pr-2"></i>
                            Texto Presentación
                        </button>
                    </h5>
                </div>

                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <form action="" id="presentacion_form">
                            <input type="text" val="" name="id_texto" class="d-none" id="id_textoP">
                            <div class="form-group">
                                <label>Título</label>
                                <input type="text" class="form-control dataPresentacion" id="titulo_presentacion" name="titulo_"
                                    val="">
                            </div>
                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea class="form-control dataPresentacion" placeholder="" id="descripcion_presentacion"
                                    name="descripcion_"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success" id="guardar-presentacion">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                            aria-expanded="false" aria-controls="collapseTwo">
                            <i class="fas fa-text-height pr-2"></i>
                            Titulo Destacado
                        </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                        <form action="" id="tituloD_form">
                            <input type="text" val="" name="id_texto" class="d-none" id="id_textoTD">
                            <div class="form-group">
                                <label>Título</label>
                                <input type="text" class="form-control dataTitulo" id="titulo_destacado" name="titulo_"
                                    val="">
                            </div>
                            <button type="submit" class="btn btn-success" id="guardar-tituloD">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree"
                            aria-expanded="false" aria-controls="collapseThree">
                            <i class="fa fa-id-card-alt pr-2"></i>
                            Tarjetas Destacadas
                        </button>
                    </h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card p-2 mb-3">
                                    <form action="" id="tarjeta_1">
                                        <input type="text" val="" name="id_texto" class="d-none dataTarjeta1" id="id_textoTar1">
                                        <div class="mb-3 d-flex justify-content-center align-items-center bg-secondary">
                                            <img src="../../../assets/images/1280x720.png" class="image_tar1 cover_mediano dataTarjeta1 url_foto"
                                                alt="Responsive image">
                                        </div>
                                        <div class="form-group">
                                            <label>Subir imagen</label>
                                            <div class="input-group">
                                                <div class="custom-file" id="customFile">
                                                    <input type="file" class="custom-file-input input_tar1 dataTarjeta1"
                                                        aria-describedby="" name="imagen">
                                                    <label class="custom-file-label label_tar1" for="exampleInputFile">
                                                        Seleccionar Archivo
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Título</label>
                                            <input type="text" class="form-control dataTarjeta1" id="" name="titulo_"
                                                val="">
                                        </div>
                                        <div class="form-group">
                                            <label>Descripción</label>
                                            <textarea class="form-control dataTarjeta1" placeholder="" name="descripcion_"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Url</label>
                                            <input type="text" class="form-control dataTarjeta1" id="" name="url_link"
                                                val="">
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Color Fondo</label>
                                                <input id="color2" class="dataTarjeta1" value="" name="color_fondo">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Color Texto</label>
                                                <input id="color3" class="dataTarjeta1" value="" name="color_texto">
                                            </div>
                                        </div>
                                        <hr class="mt-0" />
                                        <div class="d-flex justify-content-center align-items-center">
                                            <button type="submit" class="btn btn-primary w-100" id="guardar-tar1">Guardar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card p-2 mb-3">
                                    <form action="" id="tarjeta_2">
                                        <input type="text" val="" name="id_texto" class="d-none dataTarjeta2" id="id_textoTar2">
                                        <div class="mb-3 d-flex justify-content-center align-items-center bg-secondary">
                                            <img src="../../../assets/images/1280x720.png" class="image_tar2 cover_mediano dataTarjeta2 url_foto"
                                                alt="Responsive image">
                                        </div>
                                        <div class="form-group">
                                            <label>Subir imagen</label>
                                            <div class="input-group">
                                                <div class="custom-file" id="customFile">
                                                    <input type="file" class="custom-file-input input_tar2 dataTarjeta2"
                                                        aria-describedby="" name="imagen">
                                                    <label class="custom-file-label label_tar2" for="exampleInputFile">
                                                        Seleccionar Archivo
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Título</label>
                                            <input type="text" class="form-control dataTarjeta2" id="" name="titulo_"
                                                val="">
                                        </div>
                                        <div class="form-group">
                                            <label>Descripción</label>
                                            <textarea class="form-control dataTarjeta2" placeholder="" name="descripcion_"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Url</label>
                                            <input type="text" class="form-control dataTarjeta2" id="" name="url_link"
                                                val="">
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Color Fondo</label>
                                                <input id="color2" class="dataTarjeta2" value="" name="color_fondo">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Color Texto</label>
                                                <input id="color3" class="dataTarjeta2" value="" name="color_texto">
                                            </div>
                                        </div>
                                        <hr class="mt-0" />
                                        <div class="d-flex justify-content-center align-items-center">
                                            <button type="submit" class="btn btn-primary w-100" id="guardar-tar2">Guardar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card p-2 mb-3">
                                    <form action="" id="tarjeta_3">
                                        <input type="text" val="" name="id_texto" class="d-none dataTarjeta3" id="id_textoTar3">
                                        <div class="mb-3 d-flex justify-content-center align-items-center bg-secondary">
                                            <img src="../../../assets/images/1280x720.png" class="image_tar3 cover_mediano dataTarjeta3 url_foto"
                                                alt="Responsive image">
                                        </div>
                                        <div class="form-group">
                                            <label>Subir imagen</label>
                                            <div class="input-group">
                                                <div class="custom-file" id="customFile">
                                                    <input type="file" class="custom-file-input input_tar3 dataTarjeta3"
                                                        aria-describedby="" name="imagen">
                                                    <label class="custom-file-label label_tar3" for="exampleInputFile">
                                                        Seleccionar Archivo
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Título</label>
                                            <input type="text" class="form-control dataTarjeta3" id="" name="titulo_"
                                                val="">
                                        </div>
                                        <div class="form-group">
                                            <label>Descripción</label>
                                            <textarea class="form-control dataTarjeta3" placeholder="" name="descripcion_"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Url</label>
                                            <input type="text" class="form-control dataTarjeta3" id="" name="url_link"
                                                val="">
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Color Fondo</label>
                                                <input id="color2" class="dataTarjeta3" value="" name="color_fondo">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Color Texto</label>
                                                <input id="color3" class="dataTarjeta3" value="" name="color_texto">
                                            </div>
                                        </div>
                                        <hr class="mt-0" />
                                        <div class="d-flex justify-content-center align-items-center">
                                            <button type="submit" class="btn btn-primary w-100" id="guardar-tar3">Guardar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
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