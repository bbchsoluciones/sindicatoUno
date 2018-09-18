<?php
include('include/header.php');
?>
<div class="userManage-page">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Resumen</a>
        </li>
        <li class="breadcrumb-item active">Usuario</li>
        <li class="breadcrumb-item active">Administrar Usuario</li>
    </ol>

    <div class="row mb-5">
        <div class="col-md-3 mb-5">
            <div class="btn-group-vertical">
                <div class="label">Ordenar
                    <i class="fa fa-sort text-secondary"></i>
                </div>
                <div class="btn-group buttons-users" role="group" aria-label="">
                    <button type="button" class="btn btn-secondary" onClick="ordenarTrabajadores('','','','true')">A-Z</button>
                    <button type="button" class="btn btn-secondary" onClick="ordenarTrabajadores('','','','false')">Z-A</button>
                </div>
            </div>
            <div class="btn-group-vertical">
                <div class="input-group">
                    <input type="text" class="form-control border-1 rounded-0 border-bottom-0" placeholder="Buscar trabajador..." aria-label="Search"
                        aria-describedby="basic-addon2" id="isearch">
                    <div class="input-group-append width">
                        <button class="btn btn-secondary rounded-0 border-bottom-0" type="button" id="bsearch">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="label">Lista de trabajadores
                <i class="fa fa-clipboard-list text-secondary"></i>
            </div>
            <div id="loading" class="d-none">
                <img src="../../../assets/images/loading.gif" width="25">
            </div>
            <div class="btn-group-vertical" id="listUsers"></div>
            <div class="pager">
                <nav aria-label="Page navigation example" class="my-2">
                    <ul class="pagination"></ul>
                </nav>
            </div>

        </div>



        <div class="col-md-9" id="allDataUser">
            <div class="overlay_data_trabajador d-none">
                <div class="loadData_container">
                    <img src="../../../assets/images/load_data.gif" width="100">
                </div>
            </div>
            <div class="info_user d-none animated fadeIn">
                <div id="mensaje"></div>
                <div class="form-group">
                    <div class="card container-image mb-3">
                        <div class="card-img-top"></div>
                        <div class="avatar_container">
                            <img src="../../../assets/images/500x500.png" alt="..." class="img-thumbnail rounded-circle dataUser" id="url_foto_perfil">
                        </div>
                        <div class="card-body"></div>
                    </div>

                </div>
                <form class="form-signin" method="post" id="save-form" autocomplete="off" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Subir Imagen</label>
                            <div class="input-group">
                                <div class="custom-file" id="customFile">
                                    <input type="file" class="custom-file-input dataUser" id="image" aria-describedby="" name="avatar">
                                    <label class="custom-file-label" for="exampleInputFile">
                                        Seleccionar Archivo
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEcivil">Tipo de Usuario </label>
                            <select id="tipo_usuario" class="form-control dataUser listaHTML" name="tipo_usuario">
                                <option value="0">Seleccionar una...</option>
                                <option value="1">Administrador</option>
                                <option value="2">Usuario</option>
                            </select>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputName4">Rut</label>
                            <input type="text" class="form-control dataUser disabled" readonly="true" id="rut" placeholder="Rut" name="run_trabajador"
                                value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Email</label>
                            <input type="email" class="form-control dataUser" id="email" placeholder="Email" name="email_trabajador" value="">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputName4">Nombres</label>
                            <input type="text" class="form-control dataUser" id="nombres" placeholder="Nombres" name="nombres_trabajador" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputLastName4">Apellidos</label>
                            <input type="text" class="form-control dataUser" id="apellidos" placeholder="Apellidos" name="apellidos_trabajador" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputLastName4">Cargo</label>
                        <select id="cargo" class="form-control dataUser" name="nombre_cargo">
                            <option value="0" selected>Seleccionar una...</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputLastName4">Subcargo</label>
                        <select id="subcargo" class="form-control subcargo-input dataUser" name="nombre_subcargo">
                            <option value="0" selected>Seleccionar una...</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputName4">Placa</label>
                        <input type="text" class="form-control dataUser" disabled id="placa" placeholder="Número de placa" name="placa_trabajador"
                            value="">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Contraseña</label>
                            <input type="password" class="form-control dataUser" id="pass" placeholder="Contraseña" name="contrasena_trabajador" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Verificar contraseña</label>
                            <input type="password" class="form-control dataUser" id="vpass" placeholder=Contraseña name="vcontrasena_trabajador" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Dirección</label>
                        <input type="text" class="form-control dataUser" id="direccion" placeholder="Dirección" name="direccion_trabajador" value="">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputState">Región</label>
                            <select id="region" class="form-control dataUser" name="nombre_region">
                                <option value="0" selected>Seleccionar una...</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputCity">Cuidad</label>
                            <select id="provincia" class="form-control dataUser" name="nombre_provincia">
                                <option value="0" selected>Seleccionar una...</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputComuna">Comuna</label>
                            <select id="comuna" class="form-control dataUser" name="nombre_comuna">
                                <option value="0" selected>Seleccionar una...</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputBorn4">Fecha de Nacimiento</label>
                            <input id="datepicker1" name="fec_nac_trabajador" class="dataUser" value="" />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputComuna">Género </label>
                            <select id="inputComuna" class="form-control dataUser listaHTML" name="genero_trabajador">
                                <option value="0" selected>Seleccionar una...</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEcivil">Estado civil </label>
                            <select id="estado_civil" class="form-control dataUser listaHTML" name="estado_civil_trabajador">
                                <option value="0" selected>Seleccionar una...</option>
                                <option value="Soltero(a)">Soltero(a)</option>
                                <option value="Casado(a)">Casado(a)</option>
                                <option value="Viudo(a)">Viudo(a)</option>
                                <option value="Viudo(a)">Divorciado(a)</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputEnterprise">Fecha ingreso Empresa</label>
                            <input id="datepicker2" name="fec_ing_emp_trabajador" class="dataUser" value="" />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputSindicato">Fecha ingreso Sindicato</label>
                            <input id="datepicker3" name="fec_ing_sin_trabajador" class="dataUser" value="" />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEcivil">Estado del usuario</label>
                            <select id="estado_cuenta" class="form-control dataUser listaHTML" name="estado_trabajador">
                                <option value="0">Inactivo</option>
                                <option value="1">Activo</option>
                                <option value="2">Pendiente</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Teléfono</label>
                            <input type="text" class="form-control dataUser" id="telefono" placeholder="Telefono" name="telefono_trabajador" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Celular</label>
                            <input type="text" class="form-control dataUser" id="celular" placeholder="Celular" name="celular_trabajador" value="">
                        </div>
                    </div>
                    <button class="btn btn-success" id="actualizar_trabajador">Guardar</button>
                    <button class="btn btn-danger" id="eliminar_trabajador">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
    <div id="accion" class="d-none"></div>
    <div id="objeto" class="d-none"></div>
</div>
<?php
include('include/footer.php');
?>