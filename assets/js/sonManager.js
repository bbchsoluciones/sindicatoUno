// buscador de trabajadores
$(function () {
    if ($('body').hasClass('sonManage')) {

    } else if ($('body').hasClass('sonNew')) {


    }
});
$("#buscar_padre_button").click(function () {
    buscarPadre();
});
$('#buscar_padre_input').keydown(function (e) {
    var key = e.which;
    if (key == 13) {
        buscarPadre();
    }
});

function buscarPadre() {
    text = $('#buscar_padre_input').val();
    limpiarCampos('.info_trabajador', "label");
    limpiarCampo('#contenedor_padre', "img");
    limpiarCampos('#formulario_agregar_hijo', "input");
    limpiarSeleccionado("#genero_hijo");
    limpiarFormulario("#formulario_agregar_hijo");
    //errores
    limpiarCampo(".msj", "small");
    limpiarCampo('.no-registros', "div");
    //clear class
    $('.info_trabajador').addClass("d-none");
    $('.info_hijo').addClass("d-none");
    $('.no-registros').removeClass("py-3");

    if (text != "") {
        var parametros = {
            "run_trabajador": text,
            "detalle": 1

        }
        $.ajax({
            type: 'GET',
            url: "../../../controller/TrabajadorC.php",
            data: parametros,
            beforeSend: function () {
                $(".overlay_data_trabajador").addClass("py-5");
                $(".overlay_data_trabajador").removeClass("d-none");
            },
            success: function (response) {
                setTimeout(function () {
                    try {
                        $(".overlay_data_trabajador").removeClass("py-5");
                        $(".overlay_data_trabajador").addClass("d-none");
                        var json = JSON.parse(response);

                        if (json.clase == "danger") {
                            $('.no-registros').html(json.mensaje).addClass("py-3");

                        } else if (json.trabajador !== undefined && json.trabajador !== null) {
                            perfilTrabajador(json.trabajador[0]);
                            $('.info_trabajador').removeClass("d-none");
                            $('.info_hijo').removeClass("d-none");
                        }
                    } catch (err) {
                        $(".overlay_data_trabajador").removeClass("py-5");
                        $(".overlay_data_trabajador").addClass("d-none");
                        //alert(err);
                    }
                }, 500);
            }
        });
    } else {
        //
    }
}

$("#buscar_hijo_button").click(function () {
    buscarHijo();
});
$('#buscar_hijo_input').keydown(function (e) {
    var key = e.which;
    if (key == 13) {
        buscarHijo();
    }
});

function buscarHijo(rut) {
    if(rut!==""){
        text = rut;
    }
    text = $('#buscar_hijo_input').val();
    limpiarCampos('.info_trabajador', "label");
    limpiarCampo('#contenedor_padre', "img");
    limpiarCampos('#formulario_modificar_hijo', "input");
    limpiarCampo('#sons');
    limpiarSeleccionado("#genero_hijo");
    limpiarFormulario("#formulario_modificar_hijo");
    //errores
    limpiarCampo(".msj", "small");
    limpiarCampo('.no-registros', "div");
    //clear class
    $('.info_trabajador').addClass("d-none");
    $('.info_hijo').addClass("d-none");
    $('.no-registros').removeClass("py-3");

    if (text != "") {
        var parametros = {
            "run": text,
            "detalle": 1

        }
        $.ajax({
            type: 'GET',
            url: "../../../controller/HijoC.php",
            data: parametros,
            beforeSend: function () {
                $(".overlay_data_trabajador").addClass("py-5");
                $(".overlay_data_trabajador").removeClass("d-none");
            },
            success: function (response) {
                setTimeout(function () {
                    try {
                        $(".overlay_data_trabajador").removeClass("py-5");
                        $(".overlay_data_trabajador").addClass("d-none");
                        var json = JSON.parse(response);

                        if (json.clase == "danger") {
                            $('.no-registros').html(json.titulo).addClass("py-3");

                        } else {

                            if (json.trabajador !== undefined && json.trabajador !== null && json.hijos !== undefined && json.hijos !== null) {
                                perfilTrabajador(json.trabajador[0]);
                                $("#cantidad_hijos").text(json.cantidad_hijos[0]);
                                for (i = 0; i < json.hijos[0].length; i++) {
                                    $("#sons").append('<button type="button" id="hijo' + i + '" class="btnS btn btn-outline-secondary rounded-0" onclick="mostrar_datos_hijo(' + i + ",'" + json.hijos[0][i].run_hijo + "'" + ')"><i class="fa fa-user-edit"></i>' + $.formatRut(json.hijos[0][i].run_hijo) + " " + json.hijos[0][i].nombres_hijo + '</button>');
                                    if (json.hijos[0][i].run_hijo == json.selected[0]) {
                                        activeSon(i);
                                        mostrar_datos_hijo(i, json.hijos[0][i].run_hijo);
                                    } else {
                                        if (i == 0) {
                                            activeSon(i);
                                            mostrar_datos_hijo(i, json.hijos[0][i].run_hijo);
                                        }
                                    }

                                }
                                $('.info_trabajador').removeClass("d-none");
                            }

                        }
                    } catch (err) {
                        $('.overlay_data_trabajador').addClass("d-none");
                        //alert(err);
                    }
                }, 500);
            }
        });
    } else {
        //
    }
}

function activeSon(buttonId) {
    $(".btnS").removeClass("active");
    var id = "hijo" + buttonId;
    $("#" + id).addClass("active");
}

function mostrar_datos_hijo(buttonId, rut) {
    limpiarSeleccionado("#genero_hijo");
    limpiarCampo(".msj", "small");
    limpiarCampo('.no-registros', "div");
    $('.info_hijo').addClass("d-none");
    activeSon(buttonId);
    var parametros = {
        "run_hijo": rut,
        "mostrar": 1
    }
    $.ajax({
        type: 'GET',
        url: '../../../controller/HijoC.php',
        data: parametros,
        beforeSend: function () {
            $('.overlay_data_hijo').removeClass("d-none");
        },
        success: function (response) {
            setTimeout(function () {
                try {
                    $('.overlay_data_hijo').addClass("d-none");
                    var json = JSON.parse(response);
                    json = json.hijo[0];
                    Object.keys(json).forEach(function (indice) {
                        asignarMultiplesValoresHijo(json, indice);
                    });
                    $('.info_hijo').removeClass("d-none");

                } catch (err) {
                    $('.overlay_data_hijo').addClass("d-none");
                    //alert(err)
                }
            }, 500);
        }
    });
}

function asignarMultiplesValoresHijo(array, indice) {
    $(".dataSon").each(function () {
        if ($(this).is("input")) {
            if ($(this).attr("name") === indice) {
                if ($(this).attr("name") === indice && $(this).attr("name") === "run_hijo") {
                    $(this).val($.formatRut(array[indice]));
                } else {
                    $(this).val(array[indice]);
                }
            }

        } else if ($(this).is("select")) {
            if ($(this).attr("name") === indice) {
                var option = $(this).children("option");
                $(option).each(function (i) {
                    if ($(this).html() === array[indice]) {
                        $(this).attr("selected", "selected");
                        $(this).parent().val($(this).val());

                    }
                });

            }

        }
    });
}

function perfilTrabajador(json) {

    $("#url_foto").attr("src", json.url_foto_perfil);
    $("#rut_t").text($.formatRut(json.run_trabajador));
    $("#rut_tra").val(json.run_trabajador);
    $("#nombres_t").text(json.nombres_trabajador);
    $("#apellidos_t").text(json.apellidos_trabajador);
    $("#cargo_t").text(json.nombre_cargo);

}

function validacion_camposH(array, indice) {
    $(".dataSon").each(function () {
        if ($(this).attr("name") === indice) {
            if ($(this).parent().hasClass("form-group")) {
                $(this).parent().append(" <small class='msj text-danger'>" + array[indice] + "</small>");
            } else {
                $(this).parent().parent().append(" <small class='msj text-danger'>" + array[indice] + "</small>");
            }
        }
    });
}
$("input#rut_hijo").rut({
    formatOn: 'keyup',
    ignoreControlKeys: false
});
$("#registrar_hijo").click(function (event) {
    limpiarCampo(".msj", "small");
    event.preventDefault();
    var form = $('#formulario_agregar_hijo')[0];
    form = new FormData(form);
    form.append("registrar_hijo", 1);
    $("#registrar_hijo").prop("disabled", true);
    $.ajax({
        type: "POST",
        url: "../../../controller/HijoC.php",
        processData: false, // Important!
        contentType: false,
        cache: false,
        data: form,
        timeout: 600000,
        success: function (response) {
            $("#registrar_hijo").prop("disabled", false);
            var json = JSON.parse(response);
            if (json['clase'] === "danger") {
                Object.keys(json).forEach(function (indice) {
                    validacion_camposH(json, indice);
                });
            } else {
                limpiarCampos('#formulario_agregar_hijo', "input");
                limpiarSeleccionado("#genero_hijo");
                
            }
            modalInformacion(json);
        },
        error: function (e) {
            $("#registrar_hijo").prop("disabled", false);

        }

    });
});
$("#updateH").click(function (event) {
    console.log("rut "+ $("#rut_tra").val());
    limpiarCampo(".msj", "small");
    event.preventDefault();
    var form = $('#formulario_modificar_hijo')[0];
    form = new FormData(form);
    form.append("actualizar_hijo", 1);
    $("#updateH").prop("disabled", true);
    $.ajax({
        type: "POST",
        url: "../../../controller/HijoC.php",
        processData: false, // Important!
        contentType: false,
        cache: false,
        data: form,
        timeout: 600000,
        success: function (response) {
            console.log(response)
            $("#updateH").prop("disabled", false);
            var json = JSON.parse(response);
            if (json['clase'] === "danger") {
                Object.keys(json).forEach(function (indice) {
                    validacion_camposH(json, indice);
                });
            }
            modalInformacion(json);

        },
        error: function (e) {
            $("#updateH").prop("disabled", false);

        }

    });
});


$("#eliminarH").click(function (event) {
    event.preventDefault();
    var nombre = $("#n_hijo").val();
    var funcion = "eliminarH('" + $("#rut_hi").val() + "')";
    modalConfirmarEliminar(nombre, funcion);
});

function eliminarH(rut) {
    $("#eliminarH").prop("disabled", true);
    limpiarCampo(".msj", "small");
    $('#mensaje').empty();
    var parametros = {
        "run_hijo": rut,
        "eliminar_hijo": 1
    }
    $.ajax({
        type: 'GET',
        url: '../../../controller/HijoC.php',
        data: parametros,
        success: function (response) {
            try {
                var json = JSON.parse(response);
                modalInformacion(json);
                buscarHijo($("#rut_t").text());
                $("#eliminarH").prop("disabled", false);
            } catch (err) {

                $("#eliminarH").prop("disabled", false);
            }
        }
    });
}
