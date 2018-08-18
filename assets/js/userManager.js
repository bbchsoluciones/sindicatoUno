// mostrar listado trabajadores
var registrosPorPagina = 4;
$(function(){
    if($('body').hasClass('userManage')){
      mostrarTrabajadores();
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
        url: '../../../controller/TrabajadorListarC.php', //archivo que recibe la peticion
        type: 'GET', //método de envio
        beforeSend: function () {
            $('#loading').removeClass("d-none");
        },
        success: function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
            $('#loading').addClass("d-none");
            //debug
            //$("#allDataUser").children().remove();
            //$("#allDataUser").append('<div>'+response+'</div>"');
            try {
                var json = JSON.parse(response);
                paginador(json.cantidad_total[0], pagina, registrosPorPagina);
                for (i = 0; i < json.trabajador[0].length; i++) {
                    $('#listUsers').append('<button type="button" class="btn btn-secondary" id="worker' + i + '" onclick="mostrarTrabajador(' + i + ',' + json.trabajador[0][i].run_trabajador + ')">' + $.formatRut(json.trabajador[0][i].run_trabajador) + " " + json.trabajador[0][i].nombres_trabajador + '<i class="fa fa-edit text-secondary"></i></button>');
                    if (i === 0) {
                        mostrarTrabajador(i, json.trabajador[0][i].run_trabajador);
                    }
                }

            } catch (err) {
                //alert(err);
                $('#listUsers').html('<div class="message">No hay usuarios registrados!</div>');
            }

        }
    });
}
// fin mostrar trabajadores

// boton activo
function activeUser(buttonId) {
    $(".btn").removeClass("active");
    var id = "worker" + buttonId;
    $("#" + id).addClass("active");
}
// fin boton activo

// informacion trabajador
function mostrarTrabajador(buttonId, rut) {
    $("#save-form")[0].reset();
    $('.msj').empty();
    activeUser(buttonId);
    limpiarCampos("div#allDataUser","input");
    limpiarCampos("div#allDataUser","select");
    limpiarCampos("div#allDataUser","img");
    $("#mensaje").empty();
    $.ajax({
        type: 'GET',
        url: '../../../controller/TrabajadorListarC.php',
        data: "run_trabajador=" + rut,
        contentType: 'application/json; charset=utf-8',
        success: function (response) {
            try {
                var json = JSON.parse(response);
                json = json.trabajador[0];
                if (json.id_sub_cargo != "") {
                    mostrarCargos(json.id_cargo, json.id_sub_cargo);;
                } else {
                    mostrarCargos();
                }
                if (json.id_comuna != "") {
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
        }
    });
}
// fin informacion trabajador

// asignarMultiplesValores
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
                //$(this).attr("src", "../../../assets/images/500x500.png");
            }
        }
    });
}
// fin asignarMultiplesValores

// filtro trabajadores (ASC, DESC)
function ordenarTrabajadores(pagina, accion, objeto, bool) {
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
    $('#listUsers').empty();
    $.ajax({
        type: 'GET',
        url: '../../../controller/TrabajadorListarC.php',
        data: parametros,
        beforeSend: function () {
            $('#loading').removeClass("d-none");
        },
        success: function (response) {
            $('#loading').addClass("d-none");
            try {
                var json = JSON.parse(response);
                paginador(json.cantidad_total[0], pagina, registrosPorPagina);
                for (i = 0; i < json.trabajador[0].length; i++) {
                    $('#listUsers').append('<button type="button" class="btn btn-secondary" id="worker' + i + '" onclick="mostrarTrabajador(' + i + ',' + json.trabajador[0][i].run_trabajador + ')">' + $.formatRut(json.trabajador[0][i].run_trabajador) + " " + json.trabajador[0][i].nombres_trabajador + '<i class="fa fa-edit text-secondary"></i></button>');
                    if (i === 0) {
                        mostrarTrabajador(i, json.trabajador[0][i].run_trabajador);
                    }
                }
            } catch (err) {
                // alert(err)
                $('#listUsers').html('<div class="message">No hay coincidencias!</div>');
            }
        }
    });

}
// FIN filtro trabajadores


// buscador de trabajadores
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
        $('#listUsers').empty();
        $.ajax({
            type: 'GET',
            url: '../../../controller/TrabajadorListarC.php',
            data: parametros,
            success: function (response) {
                try {
                    
                    var json = JSON.parse(response);
                    paginador(json.cantidad_total[0], pagina, registrosPorPagina);
                    for (i = 0; i < json.trabajador[0].length; i++) {
                        $('#listUsers').append('<button type="button" class="btn btn-secondary" id="worker' + i + '" onclick="mostrarTrabajador(' + i + ',' + json.trabajador[0][i].run_trabajador + ')">' + $.formatRut(json.trabajador[0][i].run_trabajador) + " " + json.trabajador[0][i].nombres_trabajador + '<i class="fa fa-edit text-secondary"></i></button>');
                        if (i === 0) {
                            mostrarTrabajador(i, json.trabajador[0][i].run_trabajador);
                        }
                    }
                } catch (err) {
                    // alert(err)
                    $('#listUsers').html('<div class="message">No hay coincidencias!</div>');
                }
            }
        });
    } else {
        mostrarTrabajadores();
    }
}

$(document).ready(function () {
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
});

function validacion_campos(array, indice) {
    $(".dataUser").each(function () {
        if ($(this).attr("name") === indice) {
            if ($(this).parent().hasClass("form-group")) {
                $(this).parent().append(" <small class='msj text-danger'>"+array[indice]+"</small>");
            } else {
                $(this).parent().parent().append(" <small class='msj text-danger'>"+array[indice]+"</small>");
            }
        }
    });
}
function modalEliminarUser(){

    $("#titleConfirm").text("¿Realmente desea eliminar a "+$('#nombres').val()+"?");
	$("#cuerpoConfirm").html('Presione "Borrar" si esta seguro de eliminar a este usuario.');
	$("#cancelarConfirm").text("Cancelar");
	$("#cancelarConfirm").addClass("btn-success");
    $("#aceptarConfirm").text("Borrar");
    $("#aceptarConfirm").addClass("btn-danger");
	$("#aceptarConfirm").attr("onclick", "eliminarT('"+$('#rut').val()+"')");
	$('#confirm').modal('show');
}

$("#eliminar").click(function (event) {
    event.preventDefault();
    modalEliminarUser();
});

function eliminarT(rut){
    $("#eliminar").prop("disabled", true);
    $('.msj').empty();
    $('#mensaje').empty();
    $.ajax({
        type: 'GET',
        url: '../../../controller/TrabajadorEliminarC.php',
        data: "run_trabajador=" + rut,
        success: function (response) {
            try {
                var json = JSON.parse(response);
                $('html, body').animate({scrollTop: 0}, 0);
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

$("#guardar").click(function (event) {
    event.preventDefault();
    $('.msj').empty();
    $('#mensaje').empty();
    var form = $('#save-form')[0];
    form = new FormData(form);
    $("#guardar").prop("disabled", true);
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "../../../controller/TrabajadorModificarC.php",
        processData: false, // Important!
        contentType: false,
        cache: false,
        data: form,
        timeout: 600000,
        success: function (response) {
            $("#guardar").prop("disabled", false);
            var json = JSON.parse(response);
            $('html, body').animate({scrollTop: 0}, 0);
            $("#mensaje2").html('<div class="alert alert-' + json['clase'] + '" role="alert">' +
                '<strong>' + json['titulo'] + '</strong> ' + json['mensaje'] + '' +
                '</div>').fadeIn().delay(3000).fadeOut();
            if (json['clase'] === "danger") {
                Object.keys(json).forEach(function (indice) {
                    validacion_campos(json, indice);
                });
            }

        },
        error: function (e) {
            $("#guardar").prop("disabled", false);

        }

    });



});
function modalRegistroTrabajador(json){
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
$("#registrar").click(function (event) {
    event.preventDefault();
    $('.msj').empty();
    $('#mensaje').empty();
    var form = $('#register_form')[0];
    form = new FormData(form);
    $("#registrar").prop("disabled", true);
    $.ajax({
        type: "POST",
        url: "../../../controller/TrabajadorRegistrarC.php",
        processData: false, // Important!
        contentType: false,
        cache: false,
        data: form,
        timeout: 600000,
        success: function (response) {
            $("#registrar").prop("disabled", false);
            var json = JSON.parse(response);
            modalRegistroHijo(json);
            if (json['clase'] === "danger") {
                
                Object.keys(json).forEach(function (indice) {
                    validacion_campos(json, indice);
                });
            }else{
                limpiarCampos("#usernew_container","input");
                limpiarSeleccionado("#tipo_usuario");
            }

        },
        error: function (e) {
            $("#registrar").prop("disabled", false);
        }

    });



});