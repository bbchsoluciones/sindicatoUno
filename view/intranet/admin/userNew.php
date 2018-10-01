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

        <div id="correo" class="row justify-content-center mb-5 d-none">
            <!-- <div class="col-lg-8 col-md-10 col-12">
                <div class="row justify-content-center mb-1">
                    <div class="col-auto">
                        <h3>Envío de contraseña</h3>
                    </div>
                </div>                
                <div>
                    <div class="form-row mb-1">
                        <div class="col-lg-3 col-md-4 col-sm-3 col-12">
                            <label for="rut">Rut</label>
                            <input type="text" class="form-control" id="rut" name="rut" placeholder="11.111.111-1" disabled>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                            <label for="nombres">Nombres</label>
                            <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Juan Carlos" disabled>
                        </div>
                        <div class="col-lg-5 col-md-4 col-sm-5 col-12">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Pérez González" disabled>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">
                            <label for="correoUser">Correo Electrónico</label>
                            <input type="email" class="form-control" id="correoUser" name="correoUser" placeholder="Ejemplo: sindicato@brinks.cl">
                        </div>        
                    </div>
                    <div class="form-row">
                        <div class="col-6">
                                <button id="btnNoEnviar" class="btn btn-block btn-danger">No Enviar</button>
                        </div>        
                        <div class="col-6">
                                <button id="btnEnviar" class="btn btn-block btn-success">Enviar Correo</button>
                        </div>        
                    </div>
                </div>
            </div> -->
        </div>
    
        <div id="form-registrar" class="row mb-5">
            <div class="col-md-12" id="usernew_container">
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
                                <input type="text" class="form-control dataUser" placeholder="Rut" id="rut_trabajador" name="run_trabajador" value="">
                            </div>

                            <div class="form-group">
                                <label for="nomb">Nombres</label>
                                <input type="text" class="form-control dataUser" placeholder="Nombres" name="nombres_trabajador" value="">
                            </div>
                            <div class="form-group">
                                <label for="ape">Apellidos</label>
                                <input type="text" class="form-control dataUser" placeholder="Apellidos" name="apellidos_trabajador" value="">
                            </div>

                            <div class="form-group">
                                <label for="contra">Contraseña</label>
                                <div class="input-group">
                                    <input type="password" id="password" class="form-control dataUser" placeholder="Contraseña" aria-label="" aria-describedby="basic-addon2"
                                        name="contrasena_trabajador" value="">
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
<!---->
<!-- <div class="userManage-page">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Usuario</li>
        <li class="breadcrumb-item active">Nuevo Usuario</li>
    </ol>
    <div class="row">
        <div class="col-12">
                <div id="form-registrar" class="row mb-5" id="usernew_wrap">
                    <div class="col-md-8" id="usernew_container">
                        
                    </div>
                </div>
        </div>
    </div>
</div> -->
<?php
include('include/footer.php');
?>