<?php
include('include/header.php');
?>
<div class="register-page">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Usuario</li>
        <li class="breadcrumb-item active">Nuevo Usuario</li>
    </ol>
    <div class="container p-5">
        <div class="row mb-5">
            <div class="col-md-4">
                <img src="../../../assets/images/registerSide3.png" style="width: 100%">
            </div>
            <div class="col-md-8" id="usernew_container">
                <form action="" method="POST" id="register_form">
                    <div class="form-group">
                        <div class="jumbotron jumbotron-fluid">
                            <div class="container">
                                <h1 class="display-4 text-center"><i class="fa fa-address-card pr-4"></i>Registrar trabajador</h1>
                            </div>
                        </div>
                    </div>

                    

                    <div class="form-group ">
                        <label for="rut">Rut</label>
                        <input type="text" class="form-control dataUser" placeholder="Rut" id="rut_trabajador" name="run_trabajador">
                    </div>
                    <div class="form-group">
                        <label for="contra">Contraseña</label>
                        <div class="input-group">
                            <input type="text" id="password" class="form-control dataUser" placeholder="Contraseña" aria-label="" aria-describedby="basic-addon2"
                                name="contrasena_trabajador">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="genPass">Generar</button>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="nomb">Nombres</label>
                        <input type="text" class="form-control dataUser" placeholder="Nombres" name="nombres_trabajador">
                    </div>
                    <div class="form-group "
                        <label for="ape">Apellidos</label>
                        <input type="text" class="form-control dataUser" placeholder="Apellidos" name="apellidos_trabajador">
                    </div>
                    <div class="form-group ">
                        <label>Tipo de Usuario </label>
                        <select id="tipo_usuario" class="form-control dataUser" name="tipo_usuario">
                            <option selected>Seleccionar uno...</option>
                            <option value="1">Administrador</option>
                            <option value="2">Usuario</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success" id="registrar">Crear Usuario</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include('include/footer.php');
?>