<?php
include('include/header.php');
?>
<div class="userManage-page">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.php">Resumen</a>
        </li>
        <li class="breadcrumb-item active">Usuario</li>
        <li class="breadcrumb-item active">Registrar</li>
    </ol>

    <div id="alertCorreo"></div>
    <div id="load"></div>

    <div id="form-registrar" class="row padding-register">
        <div class="col-12" id="usernew_container">
            <form action="" method="POST" id="register_form">
                <div class="form-group">
                    <div class="jumbotron jumbotron-fluid">
                            <div class="text-title-register text-center"><i class="fa fa-address-card pr-1"></i>Registrar
                                trabajador</div>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="rut">Rut</label>
                    <input type="text" class="form-control dataUser" placeholder="Rut" id="rut_trabajador" name="run_trabajador"
                        value="">
                </div>

                <div class="form-group">
                    <label for="nomb">Nombres</label>
                    <input type="text" class="form-control dataUser" placeholder="Nombres" name="nombres_trabajador"
                        value="">
                </div>
                <div class="form-group">
                    <label for="ape">Apellidos</label>
                    <input type="text" class="form-control dataUser" placeholder="Apellidos" name="apellidos_trabajador"
                        value="">
                </div>

                <div class="form-group">
                    <label for="contra">Contraseña</label>
                    <div class="input-group">
                        <input type="password" id="password" class="form-control dataUser" placeholder="Contraseña"
                            aria-label="" aria-describedby="basic-addon2" name="contrasena_trabajador" value="">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="genPass">Generar</button>
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control dataUser" placeholder="Email (Opcional)" name="email" value="">
                </div>

                <div class="form-group ">
                    <label>Tipo de Usuario </label>
                    <select id="tipo_usuario" class="form-control dataUser" name="tipo_usuario">
                        <option value="0" selected>Seleccionar una...</option>
                        <option value="1">Administrador</option>
                        <option value="2">Usuario</option>
                    </select>
                </div>

                <div id="loadRegistrar" class="form-group text-center d-none">
                    <img src="../../../assets/images/loading.gif" width="35">
                </div>

                <button type="submit" class="btn btn-success" id="registrar">Crear Usuario</button>
            </form>
        </div>
    </div>
</div>
<?php
include('include/footer.php');
?>