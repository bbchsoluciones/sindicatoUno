<?php
include 'include/header.php';
?>
<div class="son-update-page">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Resumen</a>
        </li>
        <li class="breadcrumb-item active">Usuario</li>
        <li class="breadcrumb-item active">Hijo</li>
        <li class="breadcrumb-item active">Administrar</li>
    </ol>
    <div class="container">
        <div class="text-center title">Ingresar rut trabajador(a) o hijo(a): </div>
        <div class="buscar-padre">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Ejemplo: 10924201-k" aria-label="Search" aria-describedby="basic-addon2"
                    id="buscar_hijo_input">
                <div class="input-group-append width">
                    <button class="btn btn-secondary" type="button" id="buscar_hijo_button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="text-center no-registros"></div>
        <div class="row my-5" id="contenedor_padre">
            <div class="col-md-5 animated fadeIn">
                <div class="container position-relative">
                    <div class="overlay_data_trabajador d-none">
                        <div class="loadData_container">
                            <img src="../../../assets/images/load_data.gif" width="50">
                        </div>
                    </div>
                </div>
                <div class="info_trabajador d-none">
                    <div class="alert alert-warning" role="alert">
                        Información del trabajador(a)
                    </div>
                    <div class="profile_2 rounded-0 row">
                            <div class="col-4 img-container pr-0">
                                <img src="../../../assets/images/500x500.png" alt="..." class="img-thumbnail cover" id="url_foto">
                            </div>
                            <div class="col-8 pl-0">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><strong>Rut:</strong>
                                        <label id="rut_t"></label>
                                    </li>
                                    <li class="list-group-item"><strong>Nombres:</strong>
                                        <label id="nombres_t"></label>
                                    </li>
                                    <li class="list-group-item"><strong>Hijos(as):</strong>
                                        <label class="text-success pl-2" id="cantidad_hijos"></label>
                                    </li>
                                </ul>
                            </div>
                    </div>
                    <div class="btn-group-vertical w-100 mt-3" id="sons"></div>
                </div>
            </div>
            <div class="col-md-7 animated fadeIn">
                <div class="container position-relative">
                    <div class="overlay_data_hijo d-none">
                        <div class="loadData_container">
                            <img src="../../../assets/images/load_data.gif" width="50">
                        </div>
                    </div>
                </div>
                <div class="info_hijo d-none">
                    <form method="POST" id="formulario_modificar_hijo">
                        <div class="form-group ">
                            <div class="alert alert-info" role="alert">
                                Información del hijo(a)
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="rut">Rut</label>
                            <input type="text" class="form-control dataSon" disabled placeholder="Ejemplo: 19000004-4" name="run_hijo" value="" id="rut_hijo">
                        </div>
                        <div class="form-group">
                            <label for="nomb">Nombres</label>
                            <input type="text" class="form-control dataSon" placeholder="Ejemplo: Juan Francisco" id="n_hijo" name="nombres_hijo" value="">
                        </div>
                        <div class="form-group ">
                            <label for="ape">Apellidos</label>
                            <input type="text" class="form-control dataSon" placeholder="Ejemplo: Sánchez Cabrera" name="apellidos_hijo" value="">
                        </div>
                        <div class="form-group">
                            <label for="inputComuna">Género </label>
                            <select id="genero_hijo" class="form-control dataSon" name="genero_hijo">
                                <option selected>Seleccionar una...</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nacimiento_h">Fecha de Nacimiento</label>
                            <input id="datepicker4" name="fec_nac_hijo" value="" class="dataSon" placeholder="Ejemplo: 24/02/1990" />
                        </div>
                        <input id="rut_hi" val="" name="run_hijo" class="d-none dataSon disabled">
                        <button type="submit" class="btn btn-success" id="updateH">Actualizar</button>
                        <button class="btn btn-danger" id="eliminarH">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'include/footer.php';
?>