$(function () {
    if ($('body').hasClass('homeManage')) {
        listar_carousel();
        detalle_presentacion();
        detalle_titulo();
        detalle_tarjetas();
        $("#color1, #color2, #color3").spectrum({
            showPaletteOnly: true,
            togglePaletteOnly: true,
            color: 'blanchedalmond',
            palette: [
                ["#000", "#444", "#666", "#999", "#ccc", "#eee", "#f3f3f3", "#fff"],
                ["#f00", "#f90", "#ff0", "#0f0", "#0ff", "#00f", "#90f", "#f0f"],
                ["#f4cccc", "#fce5cd", "#fff2cc", "#d9ead3", "#d0e0e3", "#cfe2f3", "#d9d2e9", "#ead1dc"],
                ["#ea9999", "#f9cb9c", "#ffe599", "#b6d7a8", "#a2c4c9", "#9fc5e8", "#b4a7d6", "#d5a6bd"],
                ["#e06666", "#f6b26b", "#ffd966", "#93c47d", "#76a5af", "#6fa8dc", "#8e7cc3", "#c27ba0"],
                ["#c00", "#e69138", "#f1c232", "#6aa84f", "#45818e", "#3d85c6", "#674ea7", "#a64d79"],
                ["#900", "#b45f06", "#bf9000", "#38761d", "#134f5c", "#0b5394", "#351c75", "#741b47"],
                ["#600", "#783f04", "#7f6000", "#274e13", "#0c343d", "#073763", "#20124d", "#4c1130"]
            ]
        });

        $(".input_carousel").change(function () {
            changeText($(this), "carousel");
        });
        $(".input_tar1").change(function () {
            changeText($(this), "tar1");
        });
        $(".input_tar2").change(function () {
            changeText($(this), "tar2");
        });
        $(".input_tar3").change(function () {
            changeText($(this), "tar3");
        });

        function changeText(input, name) {
            var label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            if ($('.label_' + name).length) {
                $('.label_' + name).text(label);
                readURL(input[0], name);
            }
        }

        function readURL(input, name) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.image_' + name).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

    }
});

function listar_carousel() {
    $(".carousel_list").empty();
    var parametros = {
        "categoria_principal": "carousel",
        "listado": 1
    };
    $.ajax({
        data: parametros,
        url: '../../../controller/PrincipalC.php',
        type: 'GET',
        success: function (response) {
            try {
                var json = JSON.parse(response);
                var numero;
                for (i = 0; i < json.principal[0].length; i++) {
                    numero = i + 1;
                    $(".carousel_list").append(' <div class="carousel_container cursor mb-1" onclick="detalle_carousel(' + i + ',' + json.principal[0][i].id_texto + ')"' +
                        ' style="background:url(' + json.principal[0][i].url_foto + ');background-size:cover;background-position:center;">' +
                        '<div class="text" id="carousel' + i + '"><h4 class="text-light">#' + numero + '<i class="pl-2 fa fa-power-off"><i></h4></div>' +
                        '</div>');
                    if (i === 0) {
                        detalle_carousel(i, json.principal[0][i].id_texto);
                    }
                }

            } catch (err) {
                //
                $(".carousel_list").empty();
            }

        }
    });
}

function detalle_tarjetas() {
    var parametros = {
        "categoria_principal": "tarjeta",
        "listado": 1
    };
    $.ajax({
        data: parametros,
        url: '../../../controller/PrincipalC.php',
        type: 'GET',
        success: function (response) {
            try {
                var json = JSON.parse(response);
                Object.keys(json.principal[0][0]).forEach(function (nombreColumna) {
                    asignarMultiplesValores("Tarjeta1", json.principal[0][0], nombreColumna);
                });
                Object.keys(json.principal[0][1]).forEach(function (nombreColumna) {
                    asignarMultiplesValores("Tarjeta2", json.principal[0][1], nombreColumna);
                });
                Object.keys(json.principal[0][2]).forEach(function (nombreColumna) {
                    asignarMultiplesValores("Tarjeta3", json.principal[0][2], nombreColumna);
                });
            } catch (err) {
                //
            }

        }
    });
}

function detalle_carousel(buttonId, id) {

    $('#carousel_form').addClass("d-none");
    limpiarCarousel("Carousel");

    var parametros = {
        "id_texto": id,
        "detalle": 1,
    };
    activeCarousel(buttonId);
    $.ajax({
        type: 'GET',
        url: '../../../controller/PrincipalC.php',
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
                    $('#carousel_form').removeClass("d-none");
                    var json = JSON.parse(response);
                    json = json.principal[0];
                    Object.keys(json).forEach(function (nombreColumna) {
                        asignarMultiplesValores("Carousel", json, nombreColumna);
                    });
                } catch (err) {
                    //alert(err)
                }
            }, 500);
        }
    });
}

function detalle_presentacion() {

    limpiarFormulario("#presentacion_form");

    var parametros = {
        "id_texto": 1,
        "detalle": 1,
    };
    $.ajax({
        type: 'GET',
        url: '../../../controller/PrincipalC.php',
        data: parametros,
        contentType: 'application/json; charset=utf-8',
        timeout: 3000,
        success: function (response) {
            try {
                var json = JSON.parse(response);
                json = json.principal[0];
                $("#titulo_presentacion").val(json.titulo_);
                $("#descripcion_presentacion").val(json.descripcion_);
                $("#id_textoP").val(json.id_texto);
            } catch (err) {
                //alert(err)
            }
        }
    });
}

function detalle_titulo() {

    limpiarFormulario("#tituloD_form");

    var parametros = {
        "id_texto": 2,
        "detalle": 1,
    };
    $.ajax({
        type: 'GET',
        url: '../../../controller/PrincipalC.php',
        data: parametros,
        contentType: 'application/json; charset=utf-8',
        timeout: 3000,
        success: function (response) {
            try {
                var json = JSON.parse(response);
                json = json.principal[0];
                $("#titulo_destacado").val(json.titulo_);
                $("#id_textoTD").val(json.id_texto);
            } catch (err) {
                //alert(err)
            }
        }
    });
}

function asignarMultiplesValores(contenedor, array, nombreColumna) {
    $(".data" + contenedor).each(function () {
        if ($(this).is("input") || $(this).is("textarea")) {
            if ($(this).attr("name") === nombreColumna) {
                $(this).val(array[nombreColumna]);
                $(this).spectrum("set", array[nombreColumna]);
            }

        } else if ($(this).is("select")) {
            if ($(this).attr("name") === nombreColumna) {
                var option = $(this).children("option");
                $(option).each(function (i) {
                    if ($(this).val() == array[nombreColumna]) {
                        $(this).attr("selected", "selected");
                        $(this).parent().val($(this).val());

                    }
                });

            }

        } else if ($(this).is("img")) {
            if (array[nombreColumna].length != 0 && $(this).hasClass(nombreColumna)) {
                $(this).attr("src", array[nombreColumna]);
            } else if (array[nombreColumna].length == 0 && $(this).hasClass(nombreColumna)) {
                $(this).attr("src", "../../../assets/images/1920x1080.png");
            }
        }
    });
}

function activeCarousel(buttonId) {
    $(".text").removeClass("active");
    $(".text").find("i").css("color", "#ffff");
    var id = "carousel" + buttonId;
    $("#" + id).addClass("active");
    $("#" + id).find("i").css("color", "#39FF14");
}

function limpiarCarousel(contenedor) {
    $(".data" + contenedor + "[name='color_texto']").spectrum("set", "#ffffff");
    limpiarFormulario("#carousel_form");
    limpiarCampo(".dataCarousel", "img");
    limpiarCampo("#mensaje", "div");
    limpiarCampos("#carousel_form", "input");
    limpiarCampos("#carousel_form", "small");
    limpiarSeleccionados("#carousel_form");
    limpiarCampo(".custom-file-label", "label");
}


$("#nueva").click(function (e) {
    e.preventDefault();
    limpiarCarousel("Carousel");

});
$("#guardar-home").click(function (e) {
    e.preventDefault();
    var accion;
    if ($("#id_texto").val() == "") {
        accion = "crear_carousel";
    } else {
        accion = "actualizar_carousel";
    }
    limpiarCampo(".msj", "small");
    limpiarCampo("#mensaje", "#mensaje");
    var form = $('#carousel_form')[0];
    form = new FormData(form);
    form.append(accion, 1);
    $("#guardar-home").prop("disabled", true);
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "../../../controller/PrincipalC.php",
        processData: false, // Important!
        contentType: false,
        cache: false,
        data: form,
        timeout: 600000,
        success: function (response) {
            try {
                $("#guardar-home").prop("disabled", false);
                $('html, body').animate({
                    scrollTop: 0
                }, 0);
                var json = JSON.parse(response);
                if (json['clase'] == "danger") {
                    Object.keys(json).forEach(function (indice) {
                        validar_camposHome("Carousel", json, indice);
                    });
                } else {
                    limpiarCarousel();
                    listar_carousel();
                }
                modalInformacion(json);


            } catch (err) {
                //alert(err);
            }

        },
        error: function (e) {
            $("#guardar-home").prop("disabled", false);

        }

    });

});

$("#guardar-tar1").click(function (e) {
    e.preventDefault();
    guardar_tarjeta(1);

});
$("#guardar-tar2").click(function (e) {
    e.preventDefault();
    guardar_tarjeta(2);

});
$("#guardar-tar3").click(function (e) {
    e.preventDefault();
    guardar_tarjeta(3);

});

function guardar_tarjeta(id) {

    limpiarCampo(".msj", "small");
    var form = $('#tarjeta_'+id)[0];
    form = new FormData(form);
    $("#guardar-tar"+id).prop("disabled", true);
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "../../../controller/PrincipalC.php",
        processData: false, // Important!
        contentType: false,
        cache: false,
        data: form,
        timeout: 600000,
        success: function (response) {
            try {
                console.log(response);
                $("#guardar-tar"+id).prop("disabled", false);
                var json = JSON.parse(response);
                if (json['clase'] == "danger") {
                    Object.keys(json).forEach(function (indice) {
                        validar_camposHome("Tarjeta"+id, json, indice);
                    });
                } else {
                    detalle_tarjetas();
                }
                modalInformacion(json);


            } catch (err) {
                //alert(err);
            }

        },
        error: function (e) {
            $("#guardar-tar"+id).prop("disabled", false);

        }

    });
}

$("#guardar-presentacion").click(function (e) {
    e.preventDefault();
    limpiarCampo(".msj", "small");
    var form = $('#presentacion_form')[0];
    form = new FormData(form);
    form.append("actualizar_presentacion", 1);
    $("#guardar-presentacion").prop("disabled", true);
    $.ajax({
        type: "POST",
        url: "../../../controller/PrincipalC.php",
        processData: false, // Important!
        contentType: false,
        cache: false,
        data: form,
        timeout: 600000,
        success: function (response) {
            try {
                $("#guardar-presentacion").prop("disabled", false);
                var json = JSON.parse(response);
                if (json['clase'] == "danger") {
                    Object.keys(json).forEach(function (indice) {
                        validar_camposHome("Presentacion", json, indice);
                    });
                } else {
                    detalle_presentacion();
                }
                modalInformacion(json);


            } catch (err) {
                //alert(err);
            }

        },
        error: function (e) {
            $("#guardar-presentacion").prop("disabled", false);

        }

    });

});

$("#guardar-tituloD").click(function (e) {
    e.preventDefault();
    limpiarCampo(".msj", "small");
    var form = $('#tituloD_form')[0];
    form = new FormData(form);
    form.append("actualizar_titulo", 1);
    $("#guardar-tituloD").prop("disabled", true);
    $.ajax({
        type: "POST",
        url: "../../../controller/PrincipalC.php",
        processData: false, // Important!
        contentType: false,
        cache: false,
        data: form,
        timeout: 600000,
        success: function (response) {
            try {
                $("#guardar-tituloD").prop("disabled", false);
                var json = JSON.parse(response);
                if (json['clase'] == "danger") {
                    Object.keys(json).forEach(function (indice) {
                        validar_camposHome("Titulo", json, indice);
                    });
                } else {
                    detalle_titulo();
                }
                modalInformacion(json);


            } catch (err) {
                //alert(err);
            }

        },
        error: function (e) {
            $("#guardar-tituloD").prop("disabled", false);

        }

    });

});


$("#eliminar_home").click(function (e) {
    var nombre = "imagen";
    var funcion = "eliminarCarousel('" + $("#id_texto").val() + "')";
    modalConfirmarEliminar(nombre, funcion);
});

function eliminarCarousel(id) {
    $("#eliminar_home").prop("disabled", true);
    var parametros = {
        "id_texto": id,
        "eliminar_carousel": 1
    }
    $.ajax({
        type: 'GET',
        url: '../../../controller/PrincipalC.php',
        data: parametros,
        success: function (response) {
            try {
                console.log(response)
                var json = JSON.parse(response);
                if (json.clase == "success") {
                    limpiarCarousel();
                    listar_carousel();
                }
                modalInformacion(json);

                $("#eliminar_home").prop("disabled", false);
            } catch (err) {

                $("#eliminar_home").prop("disabled", false);
            }
        }
    });
}

function validar_camposHome(contenedor, array, indice) {
    $(".data" + contenedor).each(function () {
        if ($(this).attr("name") === indice) {
            $(this).closest(".form-group").append(" <small class='msj text-danger'>" + array[indice] + "</small>");
        }

    });
}