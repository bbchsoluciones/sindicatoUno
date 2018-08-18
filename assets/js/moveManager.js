$(function () {
    if ($('body').hasClass('moveNew')) {
        mostrarTipoMovimiento();        
        
        limpiarCampo("#tipo_movimiento", "select");
    }else if ($('body').hasClass('moveManage')) {
        selectMovimiento();
        mostrarFondo();
    }
});

var monto_anterior;

$("#tipo_movimiento").change(function () {
    limpiarCampo("#categoriaTM", "select");
    limpiarCampo("#nombreTM", "select");
    if ($.isNumeric($(this).val())) {
        mostrarCategoriaMovimiento($(this).val());
    }

});
$("#categoriaTM").change(function () {
    limpiarCampo("#nombreTM", "select");
    if ($.isNumeric($(this).val())) {
        mostrarNombreMovimiento($(this).val());
    }
});
function mostrarTipoMovimiento() {
    $.ajax({
        url: '../../../controller/TipoMovimientoC.php',
        type: 'GET',
        success: function (response) {
            try {
                var json = JSON.parse(response);
                for (i = 0; i < json.tipo_movimiento[0].length; i++) {
                    $('#tipo_movimiento').append('<option value="' + json.tipo_movimiento[0][i].id_tipo_movimiento + '">' + json.tipo_movimiento[0][i].tipo_movimiento + '</option>');

                }

            } catch (err) {
                //alert(err);
            }

        }
    });

}
function mostrarCategoriaMovimiento(id_tipo) {
    console.log(id_tipo);
    $.ajax({
        url: '../../../controller/CategoriaMovimientoC.php',
        type: 'GET',
        data: "id_tm=" + id_tipo,
        success: function (response) {
            try {
                //$(".breadcrumb").children().remove();
                //$(".breadcrumb").append('<div>'+response+'</div>"');
                var json = JSON.parse(response);
                for (i = 0; i < json.categoriaTM[0].length; i++) {
                    $('#categoriaTM').append('<option value="' + json.categoriaTM[0][i].id_categoria_movimiento + '">' + json.categoriaTM[0][i].categoria_movimiento + '</option>');
                }
            } catch (err) {
                alert(err);
                $('#categoriaTM').html(' <option selected>Seleccionar una...</option>');
                $('#nombreTM').html(' <option selected>Seleccionar una...</option>');
            }

        }

    });
}
function mostrarNombreMovimiento(id_categoria_movimiento) {
    $.ajax({
        url: '../../../controller/NombreMovimientoC.php',
        type: 'GET',
        data: "id_categoriatm=" + id_categoria_movimiento,
        success: function (response) {
            try {
                //$(".breadcrumb").children().remove();
                //$(".breadcrumb").append('<div>'+response+'</div>"');
                var json = JSON.parse(response);
                $("#nombreTM").empty();
                $('#nombreTM').append(' <option selected>Seleccionar una...</option>');
                for (i = 0; i < json.nombreTM[0].length; i++) {
                    $('#nombreTM').append('<option value="' + json.nombreTM[0][i].id_nombre_movimiento + '">' + json.nombreTM[0][i].nombre_movimiento + '</option>');
                }
            } catch (err) {
                //alert(err);
                $('#nombreTM').html(' <option selected>Seleccionar una...</option>');
            }

        }
    });
}
function mostrarFondo() {

    $.ajax({
        url: '../../../controller/FondoC.php',
        type: 'POST',
        success: function (response) {
            try {

                var json = JSON.parse(response);
                console.log(json);
                //alert('Saldo: '+json.monto[0][0].monto_fondo);
                $('#montoIngresos').html("$"+numberFormat(json.monto[0][0].ingreso));
                $('#montoEgresos').html("$"+numberFormat(json.monto[0][0].egreso));
                $('#saldoMovimiento').html("$"+numberFormat(json.monto[0][0].fondo));

            } catch (err) {
                alert(err);
            }

        }

    });

}
function insertMovimiento() {
    
    var monto = $("#monto").val();
    var id_nom = $("#nombreTM").val();
    var fecha = $("#datepickerMov").val();

    if (monto==="0" || monto===""){
        camposVacios();
    }else{

        var parametros = {
            "monto": monto,
            "id_nom": id_nom,
            "run": 193412130,
            "fecha":fecha
        };
        
        $.ajax({
            url: '../../../controller/MovimientoC.php',
            type: 'POST',
            data: parametros,
            success: function (response) {
                try {               
                   
                   if(response=="true"){
                       registradoMovimiento();
                       
    
                   }else{
                       noRegistradoMovimiento();
                   }
    
                } catch (err) {
                    alert(err);
                }
    
            }
           
        });
    }
}
function selectMovimiento() {

    var parametros = {
        "ajax": 'true',
        "func": 'selectMov'
    };

    $.ajax({
        url: '../../../controller/MovimientoC.php',
        type: 'POST',
        data: parametros,
        success: function (response) {

            clearTable('#tableMov');
            try {
                var json = JSON.parse(response);
                console.log('JSON: '+json);


                for (i = 0; i < json.data.length; i++) {
                    addRowMovimiento(
                        "#tableMov",
                        json.data[i].id_movimiento,
                        json.data[i].tipo_movimiento,
                        json.data[i].categoria_movimiento,
                        json.data[i].nombre_movimiento,
                        json.data[i].monto_movimiento,
                        json.data[i].fecha_movimiento,
                        json.data[i].nombres_trabajador
                    );
                }
            }
            catch (err) {
                $("#cuerpoTabla").empty();
            }

        }
    });

}
function deleteMovimiento(id_mov) {
    var parametros = {
        "ajax": 'true',
        "func": 'deleteMov',
        "id_mov": id_mov
    };
    
    $.ajax({
        url: '../../../controller/MovimientoEliminarC.php',
        type: 'GET',
        data: parametros,
        success: function (response) {
            try {
               //$(".breadcrumb").children().remove();
               //$(".breadcrumb").append('<div>'+response+'</div>"');
               
               if(response=="true"){
                   //alert('SI eliminado');
                   selectMovimiento();
                   mostrarFondo();
               }else{
                    alert('NO eliminado');
               }

            } catch (err) {
                alert(err);
            }

        }
       
    });
  

}
function updateMovimiento(folio) {



    var idMonto="#montoRow"+folio;
    var monto_nuevo = $(idMonto).val();

    if(monto_anterior==monto_nuevo){

        informarActualizarMovimientoFalse();
        deshabilitar(folio);

    }else{

        //alert('folio: '+folio+' nuevo monto: '+monto);
    deshabilitar(folio);

    var parametros = {
        "id_mov": folio,
        "monto_nuevo": monto_nuevo
    };
    
     $.ajax({
        url: '../../../controller/MovimientoActualizarC.php',
        type: 'POST',
        data: parametros,
        success: function (response) {
            try {
               
               if(response=="true"){
                    informarActualizarMovimientoTrue();
                   //alert('Modificado');
                   selectMovimiento();
                   mostrarFondo();
               }else{
                    alert('NO Modificado');
               }

            } catch (err) {
                alert(err);
            }

        }
       
    });  


    }// cierra else

    
  

}
function habilitar(folio){


    var idMonto="#montoRow"+folio;
    var idBtnSave="#btnSave"+folio;
    var idBtnEdit="#btnEdit"+folio;
    var idBtnDelete="#btnDelete"+folio;

    monto_anterior = $(idMonto).val();

    $(idMonto).prop('disabled', false);
    $(idMonto).focus();
    $(idBtnSave).prop('disabled', false);
    $(idBtnEdit).prop('disabled', true);
    $(idBtnDelete).prop('disabled', true);
    
}
function deshabilitar(folio){

    var idMonto="#montoRow"+folio;
    var idBtnSave="#btnSave"+folio;
    var idBtnEdit="#btnEdit"+folio;
    var idBtnDelete="#btnDelete"+folio;

    $(idMonto).prop('disabled', true);
    $(idBtnSave).prop('disabled', true);
    $(idBtnEdit).prop('disabled', false);
    $(idBtnDelete).prop('disabled', false);
    


} 