<?php
include 'include/header.php';
?>
<div class="About1Manage-page pr-0 position-relative">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Resumen</a>
        </li>
        <li class="breadcrumb-item active">Quiénes Somos</li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                <button class="btn btn-link">
                    <i class="fa fa-users pr-2"></i>
                    Quiénes Somos
                </button>
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card p-2 mb-3">
                        <form action="" id="about_1">
                            <input type="text" val="" name="id_texto" class="d-none dataAbout1" id="id_texto">
                            <div class="mb-3 d-flex justify-content-center align-items-center bg-secondary">
                                <img src="../../../assets/images/500x500.png" class="image_about1 cover_mediano dataAbout1 url_foto"
                                    alt="Responsive image">
                            </div>
                            <div class="form-group">
                                <label>Subir imagen</label>
                                <div class="input-group">
                                    <div class="custom-file" id="customFile">
                                        <input type="file" class="custom-file-input input_about1 dataAbout1"
                                            aria-describedby="" name="imagen">
                                        <label class="custom-file-label label_about1" for="exampleInputFile">
                                            Seleccionar Archivo
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Título</label>
                                <input type="text" class="form-control dataAbout1" id="" name="titulo_" val="">
                            </div>
                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea class="form-control dataAbout1" placeholder="" name="descripcion_"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Alinear texto</label>
                                <select id="alinear_texto" class="form-control dataAbout1" name="alineacion_texto">
                                    <option selected value="order-md-0">Izquierda</option>
                                    <option value="order-md-2">Derecha</option>
                                </select>
                            </div>
                            <hr class="mt-0" />
                            <div class="d-flex justify-content-center align-items-center">
                                <button type="submit" class="btn btn-primary w-100" id="guardar-about1">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-2 mb-3">
                        <form action="" id="about_2">
                            <input type="text" val="" name="id_texto" class="d-none dataAbout2" id="id_texto">
                            <div class="mb-3 d-flex justify-content-center align-items-center bg-secondary">
                                <img src="../../../assets/images/500x500.png" class="image_about2 cover_mediano dataAbout2 url_foto"
                                    alt="Responsive image">
                            </div>
                            <div class="form-group">
                                <label>Subir imagen</label>
                                <div class="input-group">
                                    <div class="custom-file" id="customFile">
                                        <input type="file" class="custom-file-input input_about2 dataAbout2"
                                            aria-describedby="" name="imagen">
                                        <label class="custom-file-label label_about2" for="exampleInputFile">
                                            Seleccionar Archivo
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Título</label>
                                <input type="text" class="form-control dataAbout2" id="" name="titulo_" val="">
                            </div>
                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea class="form-control dataAbout2" placeholder="" name="descripcion_"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Alinear texto</label>
                                <select id="alinear_texto" class="form-control dataAbout2" name="alineacion_texto">
                                    <option selected value="order-md-0">Izquierda</option>
                                    <option value="order-md-2">Derecha</option>
                                </select>
                            </div>
                            <hr class="mt-0" />
                            <div class="d-flex justify-content-center align-items-center">
                                <button type="submit" class="btn btn-primary w-100" id="guardar-about2">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-2 mb-3">
                        <form action="" id="about_3">
                            <input type="text" val="" name="id_texto" class="d-none dataAbout3" id="id_texto">
                            <div class="mb-3 d-flex justify-content-center align-items-center bg-secondary">
                                <img src="../../../assets/images/500x500.png" class="image_about3 cover_mediano dataAbout3 url_foto"
                                    alt="Responsive image">
                            </div>
                            <div class="form-group">
                                <label>Subir imagen</label>
                                <div class="input-group">
                                    <div class="custom-file" id="customFile">
                                        <input type="file" class="custom-file-input input_about3 dataAbout3"
                                            aria-describedby="" name="imagen">
                                        <label class="custom-file-label label_about3" for="exampleInputFile">
                                            Seleccionar Archivo
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Título</label>
                                <input type="text" class="form-control dataAbout3" id="" name="titulo_" val="">
                            </div>
                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea class="form-control dataAbout3" placeholder="" name="descripcion_"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Alinear texto</label>
                                <select id="alinear_texto" class="form-control dataAbout3" name="alineacion_texto">
                                    <option selected value="order-md-0">Izquierda</option>
                                    <option value="order-md-2">Derecha</option>
                                </select>
                            </div>
                            <hr class="mt-0" />
                            <div class="d-flex justify-content-center align-items-center">
                                <button type="submit" class="btn btn-primary w-100" id="guardar-about3">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'include/footer.php';
?>