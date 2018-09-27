var registrosPorPagina = 4;
$(function () {
    if ($('body').hasClass('userManage')) {
        mostrarTrabajadores();

        $(document).on('change', '.custom-file :file', function () {
            var label = $(this).val().replace(/\\/g, '/').replace(/.*\//, '');
            if ($('.custom-file-label').length) {
                $('.custom-file-label').text(label);
                readURL(this);
            }
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.img-thumbnail').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    } else if ($('body').hasClass('imageApproval')) {
        listar_solicitudes();
    } else if ($('body').hasClass('imageApprovalHistory')) {
        listar_solicitudes_historial();
    }
});

function mostrarTrabajadores(pagina) {
    $('#listUsers').empty();
    if (pagina === null || pagina === undefined || pagina === "") {
        pagina = 1;
    }
    var parametros = {
        "accion": "todo",
        "objeto": "none",
        "pagina": pagina,
        "r_pagina": registrosPorPagina
    };
    $.ajax({
        data: parametros,
        url: '../../../controller/TrabajadorC.php',
        type: 'GET',
        beforeSend: function () {
            $('#loading').removeClass("d-none");
        },
        success: function (response) {
            $('#loading').addClass("d-none");
            try {
                var json = JSON.parse(response);
                $("#accion").text(json.accion.valor);
                $("#objeto").text(json.objeto.valor);
                paginador(json.cantidad_total[0], pagina, registrosPorPagina);
                for (i = 0; i < json.trabajador[0].length; i++) {
                    $('#listUsers').append('<button type="button" class="btn btn-secondary" id="worker' + i + '" onclick="mostrarTrabajador(' + i + ",'" + json.trabajador[0][i].run_trabajador + "'" + ')">' + $.formatRut(json.trabajador[0][i].run_trabajador) + " " + json.trabajador[0][i].nombres_trabajador + '<i class="fa fa-edit text-secondary"></i></button>');
                    if (i === 0) {
                        mostrarTrabajador(i, json.trabajador[0][i].run_trabajador);
                    }
                }
            } catch (err) {
                $('#listUsers').html('<div class="message">No hay usuarios registrados!</div>');
            }

        }
    });
}

function activeUser(buttonId) {
    $(".btn").removeClass("active");
    var id = "worker" + buttonId;
    $("#" + id).addClass("active");
}

function mostrarTrabajador(buttonId, rut) {

    $('.info_user').addClass("d-none");
    limpiarFormulario("#save-form");
    limpiarCampo("#mensaje", "div");
    limpiarCampos("#allDataUser", "select", ".listaHTML");
    limpiarCampos("#allDataUser", "input", ".disabled");
    limpiarCampos("#allDataUser", "small");
    limpiarSeleccionados("#allDataUser");
    limpiarCampo(".custom-file-label", "label");

    var parametros = {
        "run_trabajador": rut,
        "detalle": 1,
    };
    activeUser(buttonId);
    $.ajax({
        type: 'GET',
        url: '../../../controller/TrabajadorC.php',
        data: parametros,
        contentType: 'application/json; charset=utf-8',
        timeout: 3000,
        beforeSend: function () {
            $('.overlay_data_trabajador').removeClass("d-none");
        },
        success: function (response) {
            setTimeout(function () {
                try {
                    $('.overlay_data_trabajador').addClass("d-none");
                    $('.info_user').removeClass("d-none");
                    var json = JSON.parse(response);
                    json = json.trabajador[0];
                    if (json.id_sub_cargo !== "") {
                        mostrarCargos(json.id_cargo, json.id_sub_cargo);;
                    } else {
                        mostrarCargos();
                    }
                    if (json.id_comuna !== "") {
                        mostrarRegiones(json.id_region, json.id_provincia, json.id_comuna);
                    } else {
                        mostrarRegiones();
                    }

                    Object.keys(json).forEach(function (nombreColumna) {
                        asignarMultiplesValores(json, nombreColumna);
                    });

                } catch (err) {
                    //alert(err)
                }
            }, 500);
        }
    });
}

function asignarMultiplesValores(array, nombreColumna) {
    $(".dataUser").each(function () {
        if ($(this).is("input")) {
            if ($(this).attr("name") === nombreColumna) {
                if ($(this).attr("name") === nombreColumna && $(this).attr("name") === "run_trabajador") {
                    $(this).val($.formatRut(array[nombreColumna]));
                } else {
                    $(this).val(array[nombreColumna]);
                }
            }

        } else if ($(this).is("select")) {
            if ($(this).attr("name") === nombreColumna) {
                var option = $(this).children("option");
                $(option).each(function (i) {
                    if ($(this).html() === array[nombreColumna]) {
                        $(this).attr("selected", "selected");
                        $(this).parent().val($(this).val());

                    }
                });

            }

        } else if ($(this).is("img")) {
            if (array[nombreColumna].length != 0 && $(this).attr("id") == nombreColumna) {
                $(this).attr("src", array[nombreColumna]);
            } else if (array[nombreColumna].length == 0 && $(this).attr("id") == nombreColumna) {
                $(this).attr("src", "../../../assets/images/500x500.png");
            }
        }
    });
}

function ordenarTrabajadores(pagina, accion, objeto, bool) {

    limpiarCampo("#listUsers", "div");

    if (pagina === null || pagina === undefined || pagina === "") {
        pagina = 1;
    }
    if (accion === null || accion === undefined || accion === "") {
        accion = "filtrar";
    }
    if (objeto === null || objeto === undefined || objeto === "") {
        objeto = bool;
    }

    var parametros = {
        "accion": accion,
        "objeto": objeto,
        "pagina": pagina,
        "r_pagina": registrosPorPagina
    };
    $.ajax({
        type: 'GET',
        url: '../../../controller/TrabajadorC.php',
        data: parametros,
        beforeSend: function () {
            $('#loading').removeClass("d-none");
        },
        success: function (response) {
            $('#loading').addClass("d-none");
            try {
                var json = JSON.parse(response);
                $("#accion").text(json.accion.valor);
                $("#objeto").text(json.objeto.valor);
                paginador(json.cantidad_total[0], pagina, registrosPorPagina);
                for (i = 0; i < json.trabajador[0].length; i++) {
                    $('#listUsers').append('<button type="button" class="btn btn-secondary" id="worker' + i + '" onclick="mostrarTrabajador(' + i + ",'" + json.trabajador[0][i].run_trabajador + "'" + ')">' + $.formatRut(json.trabajador[0][i].run_trabajador) + " " + json.trabajador[0][i].nombres_trabajador + '<i class="fa fa-edit text-secondary"></i></button>');
                    if (i === 0) {
                        mostrarTrabajador(i, json.trabajador[0][i].run_trabajador);
                    }
                }
            } catch (err) {
                $('#listUsers').html('<div class="message">No hay coincidencias!</div>');
            }
        }
    });

}
$("#bsearch").click(function () {
    buscarTrabajador();
});
$('#isearch').keydown(function (e) {
    var key = e.which;
    if (key == 13) {
        buscarTrabajador();
    }
});

function buscarTrabajador(pagina, accion, objeto) {

    var text = $('#isearch').val();
    if (pagina === null || pagina === undefined || pagina === "") {
        pagina = 1;
    }
    if (accion === null || accion === undefined || accion === "") {
        accion = "buscar";
    }
    if (objeto === null || objeto === undefined || objeto === "") {
        objeto = text;
    }
    var parametros = {
        "accion": accion,
        "objeto": objeto,
        "pagina": pagina,
        "r_pagina": registrosPorPagina
    };
    if (text != "") {
        limpiarCampo("#listUsers", "div");
        $.ajax({
            type: 'GET',
            url: '../../../controller/TrabajadorC.php',
            data: parametros,
            success: function (response) {
                try {

                    var json = JSON.parse(response);
                    $("#accion").text(json.accion.valor);
                    $("#objeto").text(json.objeto.valor);
                    paginador(json.cantidad_total[0], pagina, registrosPorPagina);
                    for (i = 0; i < json.trabajador[0].length; i++) {
                        $('#listUsers').append('<button type="button" class="btn btn-secondary" id="worker' + i + '" onclick="mostrarTrabajador(' + i + ",'" + json.trabajador[0][i].run_trabajador + "'" + ')">' + $.formatRut(json.trabajador[0][i].run_trabajador) + " " + json.trabajador[0][i].nombres_trabajador + '<i class="fa fa-edit text-secondary"></i></button>');
                        if (i === 0) {
                            mostrarTrabajador(i, json.trabajador[0][i].run_trabajador);
                        }
                    }
                } catch (err) {
                    $('#listUsers').html('<div class="message">No hay coincidencias!</div>');
                }
            }
        });
    } else {
        mostrarTrabajadores();
    }
}


function validacion_campos(array, indice) {
    $(".dataUser").each(function () {
        if ($(this).attr("name") === indice) {
            $(this).closest(".form-group").append(" <small class='msj text-danger'>" + array[indice] + "</small>");
        }

    });
}


$("#registrar").click(function (event) {
    event.preventDefault();
    limpiarCampo(".msj", "small");
    var form = $('#register_form')[0];
    form = new FormData(form);
    form.append("registrar", 1);
    $("#registrar").prop("disabled", true);
    $.ajax({
        type: "POST",
        url: "../../../controller/TrabajadorC.php",
        processData: false, // Important!
        contentType: false,
        cache: false,
        data: form,
        timeout: 600000,
        success: function (response) {
            $("#registrar").prop("disabled", false);
            var json = JSON.parse(response);
            modalInformacion(json)
            if (json['clase'] === "danger") {

                Object.keys(json).forEach(function (indice) {
                    validacion_campos(json, indice);
                });
            } else {

                $('#form-registrar').addClass('d-none');
                $('#correo').removeClass('d-none');
                $('#correo').html('<div class="col-lg-8 col-md-10 col-12">' +
                    '<div class="row justify-content-center mb-1">' +
                    '<div class="col-auto">' +
                    '<h3>Envío de contraseña</h3>' +
                    '</div>' +
                    '</div>' +
                    '<div>' +
                    '<div class="form-row mb-1">' +
                    '<div class="col-lg-3 col-md-4 col-sm-3 col-12">' +
                    '<label for="rut">Rut</label>' +
                    '<input type="text" class="form-control" id="rut" name="rut" value="' + $("input[name=run_trabajador]").val() + '" placeholder="11.111.111-1" disabled>' +
                    '</div>' +
                    '<div class="col-lg-4 col-md-4 col-sm-4 col-12">' +
                    '<label for="nombres">Nombres</label>' +
                    '<input type="text" class="form-control" id="nombres" name="nombres" value="' + $("input[name=nombres_trabajador]").val() + '" placeholder="Juan Carlos" disabled>' +
                    '</div>' +
                    '<div class="col-lg-5 col-md-4 col-sm-5 col-12">' +
                    '<label for="apellidos">Apellidos</label>' +
                    '<input type="text" class="form-control" id="apellidos" name="apellidos" value="' + $("input[name=apellidos_trabajador]").val() + '" placeholder="Pérez González" disabled>' +
                    '</div>' +
                    '</div>' +
                    '<div class="form-row mb-3">' +
                    '<div class="col">' +
                    '<label for="correoUser">Correo Electrónico</label>' +
                    '<input type="email" class="form-control" id="correoUser" name="correoUser" placeholder="Ejemplo:' + 'sindicato@brinks.cl">' +
                    '</div>' +
                    '</div>' +
                    '<div class="form-row">' +
                    '<div class="col-6">' +
                    '<button id="btnNoEnviar" onclick="noEnviarCorreo()" class="btn btn-block btn-danger">No Enviar</button>' +
                    '</div>' +
                    '<div class="col-6">' +
                    '<button id="btnEnviar" onclick="enviarCorreo()" class="btn btn-block btn-success">Enviar Correo</button>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>');

                /* limpiarCampos("#usernew_container", "input");
                    limpiarSeleccionado("#tipo_usuario"); */

            }

        },
        error: function (e) {
            $("#registrar").prop("disabled", false);
        }

    });
});

function noEnviarCorreo() {
    limpiarCampos("#usernew_container", "input");
    limpiarSeleccionado("#tipo_usuario");
    $('#correo').empty();
    $('#correo').addClass('d-none');
    $('#form-registrar').removeClass('d-none');
}

function mover(elemento) {
    $('html,body').animate({
        scrollTop: $(elemento).offset().top
    }, 0);
}

function enviarCorreo() {

    if ($.trim($('#correoUser').val()) == '') {
        //correo vacio
        alertCorreo("vacio");
        mover('body');
        //correo vacio

    } else {
        var nombres = $('#nombres').val();
        var primerNombre = nombres.split(' ');
        var apellidos = $('#apellidos').val();
        var primerApellido = apellidos.split(' ');
        // atributos
        var destinatario = $('#correoUser').val();
        var nombre = primerNombre[0] + ' ' + primerApellido[0];
        var rut = $('#rut').val();
        var pass = $('#password').val();
        //limpiar
        limpiarCampos("#usernew_container", "input");
        limpiarSeleccionado("#tipo_usuario");

        $('#correo').addClass('d-none');
        $('#load').html('<div id="loadMovimientos" class="row justify-content-center">' +
            '<div class="loadData_container">' +
            '<img src="../../../assets/images/loading.gif" width="50">' +
            '</div>' +

            '</div>');

        var parametros = {
            "destinatario": destinatario,
            "nombre": nombre,
            "rut": rut,
            "pass": pass
        };

        $.ajax({
            type: 'POST',
            url: '../../../controller/TrabajadorC.php',
            data: parametros,
            success: function (response) {

                console.log(response);
                if (response === "true") {
                    $('#load').empty();
                    $('#correo').empty();
                    $('#form-registrar').removeClass('d-none');
                    alertCorreo(true);
                    mover('body');
                } else {
                    $('#load').empty();
                    $('#correo').removeClass('d-none');
                    alertCorreo(false);
                    mover('body');

                }

            }
        });

    }



}

$("#actualizar_trabajador").click(function (event) {
    event.preventDefault();
    limpiarCampo(".msj", "small");
    limpiarCampo("#mensaje", "div");
    var form = $('#save-form')[0];
    form = new FormData(form);
    form.append("actualizar", 1);
    $("#actualizar_trabajador").prop("disabled", true);
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "../../../controller/TrabajadorC.php",
        processData: false, // Important!
        contentType: false,
        cache: false,
        data: form,
        timeout: 600000,
        success: function (response) {
            console.log(response);
            $("#actualizar_trabajador").prop("disabled", false);
            var json = JSON.parse(response);
            $('html, body').animate({
                scrollTop: 0
            }, 0);
            $("#mensaje").html('<div class="alert alert-' + json['clase'] + '" role="alert">' +
                '<strong>' + json['titulo'] + '</strong> ' + json['mensaje'] + '' +
                '</div>').fadeIn().delay(3000).fadeOut();
            if (json['clase'] === "danger") {
                Object.keys(json).forEach(function (indice) {
                    validacion_campos(json, indice);
                });
            }
            limpiarCampo("#pass", "input");
            limpiarCampo("#vpass", "input");
            limpiarCampo(".custom-file-label","label");
        },
        error: function (e) {
            $("#actualizar_trabajador").prop("disabled", false);

        }

    });

});
$("#eliminar_trabajador").click(function (event) {
    event.preventDefault();
    var nombres = $("#nombres").val();
    var funcion = "eliminarTrabajador('" + $("#rut").val() + "')";
    modalConfirmarEliminar(nombres, funcion);
});

function eliminarTrabajador(rut) {
    $("#eliminar_trabajador").prop("disabled", true);
    limpiarCampo(".msj", "small");
    limpiarCampo("#mensaje", "div");
    var parametros = {
        "run_trabajador": rut,
        "eliminar": 1
    };
    $.ajax({
        type: 'GET',
        url: '../../../controller/TrabajadorC.php',
        data: parametros,
        success: function (response) {
            try {
                var json = JSON.parse(response);
                $('html, body').animate({
                    scrollTop: 0
                }, 0);
                mostrarTrabajador();
                mostrarTrabajadores();
                modalInformacion(json)
                $("#eliminar_trabajador").prop("disabled", false);
            } catch (err) {

                $("#eliminar_trabajador").prop("disabled", false);
            }
        }
    });
}

$("input#rut_trabajador").rut({
    formatOn: 'keyup',
    ignoreControlKeys: false
});

function listar_solicitudes() {
    limpiarCampo(".request", "div");
    limpiarCampo(".mensaje", "h6");
    var parametros = {
        "solicitudes_pendientes": 1
    };
    $.ajax({
        data: parametros,
        url: '../../../controller/TrabajadorC.php',
        type: 'GET',
        success: function (response) {
            try {
                var json = JSON.parse(response);
                if (json.mensaje) {
                    $(".mensaje").html(json.mensaje).fadeIn();
                }
                for (var i = 0; i < json.length; i++) {
                    $(".request").append('<form id="form_foto_' + i + '">' +
                        '<div class="image_approval border mx-auto position-relative mb-5">' +
                        '<div class="name d-none">' + json[i].nombres_trabajador + '</div>' +
                        '<input type="text" class="d-none" name="id_foto_perfil" value="' + json[i].id_foto_perfil + '">' +
                        '<div class="row contenedor">' +
                        '<div class="col-md-12">' +
                        '<div class="row m-0 p-0">' +
                        '<div class="col-md-4 pr-0 pl-4 py-4 m-0">' +
                        '<div class="avatar_container">' +
                        '<div class="avatar">' +
                        '<img class="cover_avatar img-thumbnail" src="' + json[i].url_foto_perfil + '">' +
                        '<label class="rut_flotante">' + $.formatRut(json[i].run_trabajador) + '</label>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '<div class="col-md-8 p-4 m-0"><textarea name="observacion" class="form-control" id="comment" placeholder="Observaciones (Opcional)"></textarea></div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '<div class="action border">' +
                        '<div class="action-buttons">' +
                        '<button class="float-left btn aprobar" type="submit">' +
                        '<h5 class="m-0"><i class="fa fa-check"></i></h5>' +
                        '</button>' +
                        '<button class="float-left btn rechazar" type="submit">' +
                        '<h5 class="m-0"><i class="fas fa-times"></i></h5>' +
                        '</button>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</form>');
                }

                activarBoton();
            } catch (err) {
                //
            }

        }
    });
}

function listar_solicitudes_historial() {
    var parametros = {
        "solicitudes_historial": 1
    };
    $.ajax({
        data: parametros,
        url: '../../../controller/TrabajadorC.php',
        type: 'GET',
        success: function (response) {
            try {
                var json = JSON.parse(response);
                if (json.mensaje) {
                    $(".mensaje").html(json.mensaje).fadeIn();
                }
                for (var i = 0; i < json.length; i++) {
                    $(".request").append('<div class="image_approval border mx-auto position-relative mb-5">' +
                        '<input type="text" class="d-none" name="id_foto_perfil" value="' + json[i].id_foto_perfil + '">' +
                        '<div class="row contenedor">' +
                        '<div class="col-md-12">' +
                        '<div class="row m-0 p-0">' +
                        '<div class="col-md-4 p-4 m-0">' +
                        '<div class="avatar_container">' +
                        '<div class="avatar">' +
                        '<img class="cover_avatar img-thumbnail" src="' + json[i].url_foto_perfil + '">' +
                        '<label class="rut_flotante">' + $.formatRut(json[i].run_trabajador) + '</label>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '<div class="col-md-8 p-4 m-0"><textarea disabled name="observacion" class="form-control" id="comment" placeholder="Observaciones (Opcional)">' + json[i].observacion + '</textarea></div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '<div class="action border">' +
                        '<div class="action-buttons">' +
                        '<button class="float-left btn rechazar" disabled>' +
                        '<h5 class="m-0"><i class="' + json[i].estado_foto_perfil + '"></i></h5>' +
                        '</button>' +
                        '</div>' +
                        '</div>' +
                        '</div>');
                }

            } catch (err) {
                //
            }

        }
    });
}

function activarBoton() {
    $(".aprobar").click(function (e) {
        e.preventDefault();
        var nombres = $(this).closest("form").find("div.name").text();
        var accion = "aprobar";
        var form = JSON.stringify($(this).closest("form").attr("id"));
        var estado = "'aprobada'";
        var funcion = "cambiar_solicitud(" + form + ',' + estado + ")";
        modarlConfirmarCambio(nombres, accion, funcion);
    });
    $(".rechazar").click(function (e) {
        e.preventDefault();
        var nombres = $(this).closest("form").find("div.name").text();
        var accion = "rechazar";
        var form = JSON.stringify($(this).closest("form").attr("id"));
        var estado = "'rechazada'";
        var funcion = "cambiar_solicitud(" + form + ',' + estado + ")";
        modarlConfirmarCambio(nombres, accion, funcion);
    });
}

function cambiar_solicitud(form_id, estado) {
    var form = $('#' + form_id)[0];
    form = new FormData(form);
    form.append("actualizar_estado", 1);
    form.append("estado", estado);
    $("#" + form_id).find("button").prop("disabled", true);
    $.ajax({
        type: "POST",
        url: '../../../controller/TrabajadorC.php',
        processData: false, // Important!
        contentType: false,
        cache: false,
        data: form,
        timeout: 600000,
        success: function (response) {
            try {
                $("#" + form_id).find("button").prop("disabled", false);
                $("#" + form_id).delay(300).fadeOut();
                var json = JSON.parse(response);
                if (json.mensaje) {
                    $(".mensaje").html(json.mensaje).delay(500).fadeOut();
                }
                setTimeout(function(){
                    listar_solicitudes();
                    listar_notificaciones();
                },800);

            } catch (err) {
                alert(err);
            }

        },
        error: function (e) {
            $("#" + form_id).find("button").prop("disabled", false);

        }

    });
}