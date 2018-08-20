var registrosPorPagina = 4;
$(function () {
    if ($('body').hasClass('userManage')) {
        mostrarTrabajadores();

        $(document).on('change', '.custom-file :file', function () {
            var input = $(this),
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
        });
        $('.custom-file :file').on('fileselect', function (event, label) {
            var text = $('.custom-file-label'),
                log = label;
            if (text.length) {
                text.text(log);
            } else {
                if (log) alert(log);
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
        $("#image").change(function () {
            readURL(this);
        });
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
                console.log(response);
                var json = JSON.parse(response);
                $("#accion").text(json.accion.valor);
                $("#objeto").text(json.objeto.valor);
                paginador(json.cantidad_total[0], pagina, registrosPorPagina);
                for (i = 0; i < json.trabajador[0].length; i++) {
                    $('#listUsers').append('<button type="button" class="btn btn-secondary" id="worker' + i + '" onclick="mostrarTrabajador(' + i + ',' + json.trabajador[0][i].run_trabajador + ')">' + $.formatRut(json.trabajador[0][i].run_trabajador) + " " + json.trabajador[0][i].nombres_trabajador + '<i class="fa fa-edit text-secondary"></i></button>');
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
    limpiarCampo("#mensaje","div");
    limpiarCampos("#allDataUser", "select", ".listaHTML");
    limpiarCampos("#allDataUser", "input", ".disabled");
    limpiarCampos("#allDataUser", "small");
    limpiarSeleccionados("#allDataUser");

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
                    $('#listUsers').append('<button type="button" class="btn btn-secondary" id="worker' + i + '" onclick="mostrarTrabajador(' + i + ',' + json.trabajador[0][i].run_trabajador + ')">' + $.formatRut(json.trabajador[0][i].run_trabajador) + " " + json.trabajador[0][i].nombres_trabajador + '<i class="fa fa-edit text-secondary"></i></button>');
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
                        $('#listUsers').append('<button type="button" class="btn btn-secondary" id="worker' + i + '" onclick="mostrarTrabajador(' + i + ',' + json.trabajador[0][i].run_trabajador + ')">' + $.formatRut(json.trabajador[0][i].run_trabajador) + " " + json.trabajador[0][i].nombres_trabajador + '<i class="fa fa-edit text-secondary"></i></button>');
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

$("#registrar").click(function (event) {
    event.preventDefault();
    limpiarCampos(".msj","span");
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
            console.log(response);
            $("#registrar").prop("disabled", false);
            var json = JSON.parse(response);
            modalRegistroHijo(json);
            if (json['clase'] === "danger") {

                Object.keys(json).forEach(function (indice) {
                    validacion_campos(json, indice);
                });
            } else {
                limpiarCampos("#usernew_container", "input");
                limpiarSeleccionado("#tipo_usuario");
            }

        },
        error: function (e) {
            $("#registrar").prop("disabled", false);
        }

    });
});

function validacion_campos(array, indice) {
    $(".dataUser").each(function () {
        if ($(this).attr("name") === indice) {
            if ($(this).parent().hasClass("form-group")) {
                $(this).parent().append(" <small class='msj text-danger'>" + array[indice] + "</small>");
            } else {
                $(this).parent().parent().append(" <small class='msj text-danger'>" + array[indice] + "</small>");
            }
        }
    });
}

function modalEliminarUser() {

    $("#titleConfirm").text("¿Realmente desea eliminar a " + $('#nombres').val() + "?");
    $("#cuerpoConfirm").html('Presione "Borrar" si esta seguro de eliminar a este usuario.');
    $("#cancelarConfirm").text("Cancelar");
    $("#cancelarConfirm").addClass("btn-success");
    $("#aceptarConfirm").text("Borrar");
    $("#aceptarConfirm").addClass("btn-danger");
    $("#aceptarConfirm").attr("onclick", "eliminarT('" + $('#rut').val() + "')");
    $('#confirm').modal('show');
}

$("#eliminar").click(function (event) {
    event.preventDefault();
    modalEliminarUser();
});

function eliminarT(rut) {
    $("#eliminar").prop("disabled", true);
    limpiarCampos(".msj","span");
    $('#mensaje').empty();
    $.ajax({
        type: 'GET',
        url: '../../../controller/TrabajadorEliminarC.php',
        data: "run_trabajador=" + rut,
        success: function (response) {
            try {
                var json = JSON.parse(response);
                $('html, body').animate({
                    scrollTop: 0
                }, 0);
                mostrarTrabajador();
                mostrarTrabajadores();
                $("#mensaje1").html('<div class="alert alert-' + json['clase'] + '" role="alert">' +
                    '<strong>' + json['titulo'] + '</strong> ' + json['mensaje'] + '' +
                    '</div>').fadeIn().delay(3000).fadeOut();
                $("#eliminar").prop("disabled", false);
            } catch (err) {

                $("#eliminar").prop("disabled", false);
            }
        }
    });
}

$("#actualizar").click(function (event) {
    event.preventDefault();
    limpiarCampos(".msj","span");
    $('#mensaje').empty();
    var form = $('#save-form')[0];
    form = new FormData(form);
    form.append("actualizar", 1);
    $("#actualizar").prop("disabled", true);
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
            $("#actualizar").prop("disabled", false);
            console.log(response);
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

        },
        error: function (e) {
            $("#actualizar").prop("disabled", false);

        }

    });



});

function modalRegistroTrabajador(json) {
    $("#aceptarMsg").removeClass("btn-danger");
    $("#aceptarMsg").removeClass("btn-success");
    $("#titleMsg").text(json.titulo);
    $("#cuerpoMsg").html(json.mensaje);
    $("#aceptarMsg").text("Aceptar");
    $("#aceptarMsg").addClass("btn-" + json.clase);
    $('#msg').modal('show');
}
$("input#rut_trabajador").rut({
    formatOn: 'keyup',
    ignoreControlKeys: false
});
