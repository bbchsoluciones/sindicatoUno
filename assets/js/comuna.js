$("#region").change(function () {
   mostrarProvincias(parseInt($(this).val()));
});
$("#provincia").change(function () {
    mostrarComunas(parseInt($(this).val()));
});
function mostrarRegiones(id_region, id_provincia, id_comuna) {
    $.ajax({
        url: '../../../controller/RegionC.php',
        type: 'GET',
        success: function (response) {
            try {
                var json = JSON.parse(response);  
                $('#region').empty(); //limpiar select
                $('#region').append(' <option selected>Seleccionar una...</option>'); //agregar option por defecto
                for (i = 0; i < json.region[0].length; i++) {
                    //console.log("BD: " + json.cargo[i].id_cargo, " PARAMETER: " + id_cargo);
                    if (json.region[0][i].id_region === id_region) {
                        $('#region').append('<option selected="selected" value="' + json.region[0][i].id_region + '">' + json.region[0][i].nombre_region + '</option>');
                    } else {
                        $('#region').append('<option value="' + json.region[0][i].id_region + '">' + json.region[0][i].nombre_region + '</option>');
                    }

                }
                if (id_comuna != "") {
                    mostrarProvincias(id_region, id_provincia, id_comuna);
                }
            } catch (err) {
                //alert(err);
            }

        }
    });

}
function mostrarProvincias(id_region, id_provincia, id_comuna) {
    $.ajax({
        url: '../../../controller/ProvinciaC.php',
        type: 'GET',
        data: "id_region=" + id_region,
        success: function (response) {
            try {
                var json = JSON.parse(response);
                $("#provincia").empty();
                $('#provincia').append(' <option selected>Seleccionar una...</option>');
                for (i = 0; i < json.provincia[0].length; i++) {
                    if (json.provincia[0][i].id_provincia === id_provincia) {
                        $('#provincia').append('<option selected="selected" value="' + json.provincia[0][i].id_provincia + '">' + json.provincia[0][i].nombre_provincia + '</option>');
                    } else {
                        $('#provincia').append('<option value="' + json.provincia[0][i].id_provincia + '">' + json.provincia[0][i].nombre_provincia + '</option>');
                    }

                }
                if (id_comuna != "") {
                    mostrarComunas(id_provincia, id_comuna);
                }
            } catch (err) {
                //alert(err);
                $('#provincia').html(' <option selected>Seleccionar una...</option>');
                $('#comuna').html(' <option selected>Seleccionar una...</option>');
            }

        }
       
    });
}
function mostrarComunas(id_provincia, id_comuna) {
    $.ajax({
        url: '../../../controller/ComunaC.php',
        type: 'GET',
        data: "id_provincia=" + id_provincia,
        success: function (response) {
            try {
                var json = JSON.parse(response);
                $("#comuna").empty();
                $('#comuna').append(' <option selected>Seleccionar una...</option>');
                for (i = 0; i < json.comuna[0].length; i++) {
                    if (json.comuna[0][i].id_comuna === id_comuna) {
                        $('#comuna').append('<option selected="selected" value="' + json.comuna[0][i].id_comuna + '">' + json.comuna[0][i].nombre_comuna + '</option>');
                    } else {
                        $('#comuna').append('<option value="' + json.comuna[0][i].id_comuna + '">' + json.comuna[0][i].nombre_comuna + '</option>');
                    }

                }
            } catch (err) {
                //alert(err);
                $('#comuna').html(' <option selected>Seleccionar una...</option>');
            }

        }
    });
}