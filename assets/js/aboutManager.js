$(function () {
    if ($('body').hasClass('aboutManage')) {
        detalle_about();

        $(".input_about1").change(function () {
            changeText($(this), "about1");
        });
        $(".input_about2").change(function () {
            changeText($(this), "about2");
        });
        $(".input_about3").change(function () {
            changeText($(this), "about3");
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

function detalle_about() {
    var parametros = {
        "categoria_principal": "about",
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
                    asignarMultiplesValores("About1", json.principal[0][0], nombreColumna);
                });
                Object.keys(json.principal[0][1]).forEach(function (nombreColumna) {
                    asignarMultiplesValores("About2", json.principal[0][1], nombreColumna);
                });
                Object.keys(json.principal[0][2]).forEach(function (nombreColumna) {
                    asignarMultiplesValores("About3", json.principal[0][2], nombreColumna);
                });
            } catch (err) {
                //
            }

        }
    });
}


function asignarMultiplesValores(contenedor, array, nombreColumna) {
    $(".data" + contenedor).each(function () {
        if ($(this).is("input") || $(this).is("textarea")) {
            if ($(this).attr("name") === nombreColumna) {
                $(this).val(array[nombreColumna]);
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

$("#guardar-about1").click(function (e) {
    e.preventDefault();
    guardar_about(1);

});
$("#guardar-about2").click(function (e) {
    e.preventDefault();
    guardar_about(2);

});
$("#guardar-about3").click(function (e) {
    e.preventDefault();
    guardar_about(3);

});

function guardar_about(id) {

    limpiarCampo(".msj", "small");
    var form = $('#about_'+id)[0];
    form = new FormData(form);
    form.append("actualizar_about", 1);
    $("#guardar-about"+id).prop("disabled", true);
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
                $("#guardar-about"+id).prop("disabled", false);
                var json = JSON.parse(response);
                if (json['clase'] == "danger") {
                    Object.keys(json).forEach(function (indice) {
                        validar_camposAbout("About"+id, json, indice);
                    });
                } else {
                    detalle_about();
                }
                modalInformacion(json);


            } catch (err) {
                //alert(err);
            }

        },
        error: function (e) {
            $("#guardar-about"+id).prop("disabled", false);

        }

    });
}
function validar_camposAbout(contenedor, array, indice) {
    $(".data" + contenedor).each(function () {
        if ($(this).attr("name") === indice) {
            $(this).closest(".form-group").append(" <small class='msj text-danger'>" + array[indice] + "</small>");
        }

    });
}