<?php
include 'include/header.php';
?>
<div class="register-page pr-0">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.php">Resumen</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="userManage.php">Perfil</a>
        </li>
        <li class="breadcrumb-item active">Registrar Hijos</li>
    </ol>

    <div class="row" id="contenedor_padre">
        <div class="container position-relative">
            <div class="overlay_data_trabajador d-none">
                <div class="loadData_container">
                    <img src="../../../assets/images/load_data.gif" width="50">
                </div>
            </div>
        </div>
        <div class="col-md-5 animated fadeIn info_trabajador d-none mb-4">
            <div class="alert alert-warning" role="alert">
                Información del trabajador(a)
            </div>
            <div class="card profile" style="width: 100%">
                <div class="card container-image">
                    <div class="card-img-top"></div>
                    <div class="object-fill">
                        <img src="../../../assets/images/500x500.png" alt="..." class="img-thumbnail cover rounded-circle"
                            id="url_foto">
                    </div>
                    <div class="card-body"></div>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Rut:
                        <label id="rut_t"></label>
                    </li>
                    <li class="list-group-item">Nombres:
                        <label id="nombres_t"></label>
                    </li>
                    <li class="list-group-item">Apellidos:
                        <label id="apellidos_t"></label>
                    </li>
                    <li class="list-group-item">Cargo:
                        <label id="cargo_t"></label>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-7 animated fadeIn info_hijo d-none mb-5">
            <form action="" method="POST" id="formulario_agregar_hijo">
                <div class="form-group ">
                    <div class="alert alert-info" role="alert">
                        Información del hijo(a)
                    </div>
                </div>
                <div class="form-group ">
                    <label for="rut">Rut</label>
                    <input type="text" class="form-control dataSon" placeholder="Ejemplo: 19000004-4" name="run_hijo" value=""
                        id="rut_hijo">
                </div>
                <div class="form-group">
                    <label for="nomb">Nombres</label>
                    <input type="text" class="form-control dataSon" placeholder="Ejemplo: Juan Francisco" id="n_hijo" name="nombres_hijo"
                        value="">
                </div>
                <div class="form-group ">
                    <label for="ape">Apellidos</label>
                    <input type="text" class="form-control dataSon" placeholder="Ejemplo: Sánchez Cabrera" name="apellidos_hijo"
                        value="">
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
                <button type="submit" class="btn btn-success" id="registrar_hijo">Registrar</button>
            </form>
        </div>
    </div>

</div>
    <?php
include 'include/footer.php';
?>