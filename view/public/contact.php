<?php
     require_once('include/header.php');
?>

<div class="container margin-contact">
    <div class="row">
        <!-- aqui va la imagen 
                <img src="" class="img-fluid" alt="Responsive image">
                -->
    </div>
    <div class="row fondo-general">
        <div class="col-12 pr-0 pl-0 col-sm-12 pr-sm-0 pl-sm-0 col-md-6 pr-md-0 pl-md-0 col-lg-6 pr-lg-0 pl-lg-0 col-xl-6 pr-xl-0 pl-xl-0">
            <iframe class="mapa" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7920.164211849292!2d-70.65111839615314!3d-33.42275298918234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzPCsDI1JzI0LjEiUyA3MMKwMzknMDkuMiJX!5e0!3m2!1ses!2scl!4v1531175071021"
                frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 fondo-contact">

            <div class="container">
                <div class="row">
                    <div class="text-size-headers">Información de Contacto</div>
                </div>
                <div class="container p-1 text-size-content">
                    <div class="row mt-2 p-0 text-size-sub-headers">
                        Dirección
                    </div>
                    <div class="row mt-2">

                        <div class="col-auto p-0">
                            <i class="fas fa-map-marker-alt font-size-icon" style="color:red"></i>
                        </div>
                        <div class="col-8 text-content-contact">
                            Sergio Livingston 489, Independencia.
                        </div>
                    </div>
                    <div class="row mt-2 text-size-sub-headers">
                        Teléfono
                    </div>
                    <div class="row mt-2">

                        <div class="col-auto p-0">
                            <i class="fas fa-mobile-alt font-size-icon" style="color:green"></i>
                        </div>
                        <div class="col-8 text-content-contact">
                            +56912345123 / +56912312123
                        </div>
                    </div>
                    <div class="row mt-2 text-size-sub-headers">
                        Correo
                    </div>
                    <div class="row mt-2">

                        <div class="col-auto p-0">
                            <i class="far fa-envelope font-size-icon" style="color:black"></i>
                        </div>
                        <div class="col-8 text-content-contact">
                            info@sinabrinks.cl
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mt-md-3 mt-lg-3 mt-xl-3">
                <div class="row">
                    <div class="text-size-headers">Contáctanos</div>
                </div>
                <div class="row">
                    <div class="col-12 p-0">
                        <div id="alertContacto"></div>
                    </div>
                </div>
                <form id="contacto" role="form" action="" onsubmit="enviarCorreo();
                                                return false">
                    <div class="row mt-2 mt-sm-2 mt-md-2 mt-lg-2 mt-xl-2">
                        <div class="col-12 pl-0 pr-0 col-sm-12 pl-sm-0 pr-sm-0 col-md-12 pl-md-0 pr-md-0 col-lg-6 pl-lg-0 pr-lg-1 col-xl-6 pl-xl-0 pr-xl-1">
                            <div class="form-group">
                                <input id="name" name="name" type="text" class="form-control" placeholder="Nombre"
                                    value="" />
                                <span id="name_error" class="text-light"></span>

                            </div>
                        </div>
                        <div class="col-12 pl-0 pr-0 col-sm-12 pl-sm-0 pr-sm-0 col-md-12 pl-md-0 pr-md-0 col-lg-6 pl-lg-1 pr-lg-0 col-xl-6 pl-xl-1 pr-xl-0">
                            <div class="form-group">
                                <input id="email" name="email" type="text" class="form-control" placeholder="Email"
                                    value="" />
                                <span id="email_error" class="text-light"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 pl-0 pr-0 pl-sm-0 pr-sm-0 pl-md-0 pr-md-0 pl-lg-0 pr-lg-0 pl-xl-0 pr-xl-0">
                            <div class="form-group">
                                <select id="asunto" name="asunto" class="form-control">
                                    <option value="asunto" selected="">Asunto</option>
                                    <option value="integracion">Integración al Sindicato</option>
                                    <option value="reclamo">Reclamo</option>
                                    <option value="sugerencia">Sugerencia</option>
                                    <option value="felicitacion">Felicitaciones</option>
                                </select>
                                <span id="asunto_error" class="text-light"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 pl-0 pr-0 pl-sm-0 pr-sm-0 pl-md-0 pr-md-0 pl-lg-0 pr-lg-0 pl-xl-0 pr-xl-0">
                            <div class="form-group">
                                <textarea id="message" name="message" class="form-control" rows="5" cols="25"
                                    placeholder="Mensaje"></textarea>
                                <span id="message_error" class="text-light"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div id="loadContact" class="col-12 pl-0 pr-0 pl-sm-0 pr-sm-0 pl-md-0 pr-md-0 pl-lg-0 pr-lg-0 pl-xl-0 pr-xl-0 text-center mb-4 d-none">
                            <img src="../../assets/images/loading.gif" width="30">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 pl-0 pr-0 pl-sm-0 pr-sm-0 pl-md-0 pr-md-0 pl-lg-0 pr-lg-0 pl-xl-0 pr-xl-0">
                            <button name="submit" type="submit" class="btn btn-success pull-right btn-block" id="enviar">
                                Enviar
                            </button>
                        </div>
                    </div>
                    <span class="text-light"></span>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
     require_once('include/footer.php');
?>