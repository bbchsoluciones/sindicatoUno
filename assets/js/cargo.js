function mostrarCargos(id_cargo, id_sub_cargo) {
    $.ajax({
        url: '../../../controller/CargoTrabajadorC.php',
        type: 'GET',
        success: function (response) {
            try {
                var json = JSON.parse(response);
                for (i = 0; i < json.cargo[0].length; i++) {
                    //console.log("BD: " + json.cargo[i].id_cargo, " PARAMETER: " + id_cargo);
                    if (json.cargo[0][i].id_cargo === id_cargo) {
                        $('#cargo').append('<option selected="selected" value="' + json.cargo[0][i].id_cargo + '">' + json.cargo[0][i].nombre_cargo + '</option>');
                    } else {
                        $('#cargo').append('<option value="' + json.cargo[0][i].id_cargo + '">' + json.cargo[0][i].nombre_cargo + '</option>');
                    }

                }
                //console.log("CARGO: "+ id_cargo, " sub: "+id_sub_cargo);
                if (id_sub_cargo != "") {
                    mostrarSubCargos(id_cargo, id_sub_cargo);
                }
            } catch (err) {
                //alert(err);
                $('#cargo').html(' <option selected>Seleccionar una...</option>');
                $('#subcargo').html(' <option selected>Seleccionar una...</option>');
            }

        }
    });
}

$("#cargo").change(function () {

    limpiarCampo("select#subcargo","select");

    if(parseInt($(this).val())===3){
        $("#placa").prop("disabled",false);
    }else{
        limpiarCampo("input#placa","input");
        $("#placa").prop("disabled",true);
    }
    mostrarSubCargos(parseInt($(this).val()));
});


function mostrarSubCargos(id_cargo, id_sub_cargo) {
    $.ajax({
        url: '../../../controller/SubCargoTrabajadorC.php',
        type: 'GET',
        data: "id_cargo=" + id_cargo,
        success: function (response) {
            try {
                var json = JSON.parse(response);
                for (i = 0; i < json.subcargo[0].length; i++) {
                    if (json.subcargo[0][i].id_sub_cargo === id_sub_cargo) {
                        $('#subcargo').append('<option selected="selected" value="' + json.subcargo[0][i].id_sub_cargo + '">' + json.subcargo[0][i].nombre_subcargo + '</option>');
                    } else {
                        $('#subcargo').append('<option value="' + json.subcargo[0][i].id_sub_cargo + '">' + json.subcargo[0][i].nombre_subcargo + '</option>');
                    }
                    
                }
            } catch (err) {
                //alert(err);
                $('#subcargo').html(' <option selected>Seleccionar una...</option>');
            }
            
            if(id_cargo==="3"){
                $("#placa").prop("disabled", false);
            }

        }
    });
}