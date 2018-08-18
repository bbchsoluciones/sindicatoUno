// buscador de trabajadores
$("#hsearch").click(function () {
    buscarPadre();
});
$('#ihsearch').keydown(function (e) {
    var key = e.which;
    if (key == 13) {
        buscarPadre();
    }
});

function buscarPadre() {
    text = $('#ihsearch').val();
    limpiarCampos('div#contenedorH', "label");
    limpiarCampo('div#father', "img");
    limpiarCampos('div#contenedorH', "input");
    limpiarCampo('div.no-registros', "div");
    limpiarSeleccionado("#genero_hijo");
    $("#save-child")[0].reset();
    $('#sons').empty();
    $('.msj').empty();
    var action = "";
    var rut = "";
    if ($('body').hasClass("sonNew")) {
        action = "../../../controller/TrabajadorListarC.php";
        rut = 'run_trabajador';
    } else {
        action = "../../../controller/HijoTrabajadorListarC.php";
        rut = 'run';
    }
    if (text != "") {
        $.ajax({
            type: 'GET',
            url: action,
            data: rut + "=" + text,
            beforeSend: function () {
                $('.overlay').removeClass("d-none");
            },
            success: function (response) {
                try {
                    var json = JSON.parse(response);
            
                    if (json.clase == "danger" || response == "false") {
                        $('.overlay').addClass("d-none");
                        $('#contenedorH').addClass("d-none");
                        $('.no-registros').html('No hay coincidencias!');

                    } 
                    if (json.trabajador !== undefined && json.trabajador !== null) {
                        $('.overlay').addClass("d-none");
                        $('#contenedorH').removeClass("d-none");
                        perfilTrabajador(json.trabajador[0]);
                        
                    } 
                    if (json.hijos !== undefined && json.hijos !== null) {
                        $("#cantidad_hijos").text(json.cantidad_hijos[0]);
                        for(i=0;i<json.hijos[0].length;i++){
                            $("#sons").append('<button type="button" id="hijo'+i+'" class="btnS btn btn-outline-secondary rounded-0" onclick="mostrar_datos_hijo('+i+","+json.hijos[0][i].run_hijo+')"><i class="fa fa-user-edit"></i>'+$.formatRut(json.hijos[0][i].run_hijo)+" "+json.hijos[0][i].nombres_hijo+'</button>');
                            if(json.hijos[0][i].run_hijo==json.selected[0]){
                                activeSon(i);
                                mostrar_datos_hijo(i,json.hijos[0][i].run_hijo);
                            }else{
                                if(i==0){
                                    activeSon(i);
                                    mostrar_datos_hijo(i,json.hijos[0][i].run_hijo);
                                }
                            }
                            
                        }
                    }
                } catch (err) {
                    //alert(err);
                }
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
    $('.msj').empty();
    limpiarCampos('div#contenedorH', "input");
    limpiarSeleccionado("#genero_hijo");
    activeSon(buttonId);
    $("#mensaje").empty();
    $.ajax({
        type: 'GET',
        url: '../../../controller/HijoTrabajadorListarC.php',
        data: "run_hijo=" + rut,
        success: function (response) {
            try {
                var json = JSON.parse(response);
                json = json.hijo[0];
                Object.keys(json).forEach(function (indice) {
                    asignarMultiplesValoresHijo(json, indice);
                });

            } catch (err) {
                //alert(err)
            }
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
$("#guardarH").click(function (event) {
    $('.msj').empty();
    event.preventDefault();
    var form = $('#save-child')[0];
    form = new FormData(form);
    $("#guardarH").prop("disabled", true);
    $.ajax({
        type: "POST",
        url: "../../../controller/HijoTrabajadorRegistrarC.php",
        processData: false, // Important!
        contentType: false,
        cache: false,
        data: form,
        timeout: 600000,
        success: function (response) {
            $("#guardarH").prop("disabled", false);
            var json = JSON.parse(response);
            if (json['clase'] === "danger") {
                Object.keys(json).forEach(function (indice) {
                    validacion_camposH(json, indice);
                });
            } else {
                limpiarCampos('div#contenedorH', "input");
                limpiarSeleccionado("#genero_hijo");
                $('#contenedorH').addClass("d-none");
            }
            
            modalRegistroHijo(json);
            


        },
        error: function (e) {
            $("#guardarH").prop("disabled", false);

        }

    });
});
$("#updateH").click(function (event) {
    limpiarModalHijo();
    $('.msj').empty();
    event.preventDefault();
    var form = $('#save-child')[0];
    form = new FormData(form);
    $("#updateH").prop("disabled", true);
    $.ajax({
        type: "POST",
        url: "../../../controller/HijoTrabajadorModificarC.php",
        processData: false, // Important!
        contentType: false,
        cache: false,
        data: form,
        timeout: 600000,
        success: function (response) {
            $("#updateH").prop("disabled", false);
            var json = JSON.parse(response);
            if (json['clase'] === "danger") {
                Object.keys(json).forEach(function (indice) {
                    validacion_camposH(json, indice);
                });
            }
            
            
              modalRegistroHijo(json);


        },
        error: function (e) {
            $("#updateH").prop("disabled", false);

        }

    });
});
function modalEliminarHijo(){

    $("#titleConfirm").text("¿Realmente desea eliminar a "+$('#n_hijo').val()+"?");
	$("#cuerpoConfirm").html('Presione "Borrar" si esta seguro de eliminar a esta persona .');
	$("#cancelarConfirm").text("Cancelar");
	$("#cancelarConfirm").addClass("btn-success");
    $("#aceptarConfirm").text("Borrar");
    $("#aceptarConfirm").addClass("btn-danger");
	$("#aceptarConfirm").attr("onclick", "eliminarH('"+$('#rut_hi').val()+"')");
	$('#confirm').modal('show');
}

$("#eliminarH").click(function (event) {
    event.preventDefault();
    modalEliminarHijo();
});
function eliminarH(rut){
    $("#eliminarH").prop("disabled", true);
    $('.msj').empty();
    $('#mensaje').empty();
    $.ajax({
        type: 'GET',
        url: '../../../controller/HijoTrabajadorEliminarC.php',
        data: "run_hijo=" + rut,
        success: function (response) {
            try {
                var json = JSON.parse(response);
                modalRegistroHijo(json);
                buscarPadre();
                $("#eliminarH").prop("disabled", false);
            } catch (err) {
               
                $("#eliminarH").prop("disabled", false);
            }
        }
    });
}
function limpiarModalHijo(){
    $("#titleMsg").text("");
    $("#cuerpoMsg").html("");
    $("#aceptarMsg").text("");
    $("#aceptarMsg").addClass("btn-");
}
function modalRegistroHijo(json){
    $("#aceptarMsg").removeClass("btn-danger");
    $("#aceptarMsg").removeClass("btn-success");
    $("#titleMsg").text(json.titulo);
    $("#cuerpoMsg").html(json.mensaje);
    $("#aceptarMsg").text("Aceptar");
    $("#aceptarMsg").addClass("btn-" + json.clase);
    $('#msg').modal('show');
}