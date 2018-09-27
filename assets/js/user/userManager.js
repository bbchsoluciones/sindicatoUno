var registrosPorPagina = 4;
$(function () {
    if ($('body').hasClass('userManage')) {
        //mostrarTrabajadores();

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
    }else if ($('body').hasClass('imageApproval')) {
        listar_solicitudes_historial();
    }
});



function mostrarTrabajador(rut) {

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
    //activeUser(buttonId);
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
                    console.log(response);
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

function listar_solicitudes_historial() {
    var parametros = {
        "solicitudes_historial_user": 1
    };
    $.ajax({
        data: parametros,
        url: '../../../controller/TrabajadorC.php',
        type: 'GET',
        success: function (response) {
            try {
                var json = JSON.parse(response);
                console.log(json);
                if (json.mensaje) {
                    $(".mensaje").html(json.mensaje).fadeIn();
                }else if(json){
                    $(".request").append('<div class="image_approval border mx-auto position-relative mb-5">' +
                        '<div class="row contenedor">' +
                        '<div class="col-md-12">' +
                        '<div class="row m-0 p-0">' +
                        '<div class="col-md-4 p-4 m-0">' +
                        '<div class="avatar_container">' +
                        '<div class="avatar">' +
                        '<img class="cover_avatar img-thumbnail" src="' + json.url_foto_perfil + '">' +
                        '<label class="rut_flotante">foto rechazada</label>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '<div class="col-md-8 p-4 m-0"><textarea disabled name="observacion" class="form-control" id="comment" placeholder="Observaciones del administrador...">' + json.observacion + '</textarea></div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '<div class="action border">' +
                        '<div class="action-buttons">' +
                        '<button class="float-left btn rechazar" disabled>' +
                        '<h5 class="m-0"><i class="' + json.estado_foto_perfil + '"></i></h5>' +
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

$("input#rut_trabajador").rut({
    formatOn: 'keyup',
    ignoreControlKeys: false
});