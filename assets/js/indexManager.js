$(function () {
    if ($('body').hasClass('index')) {
        selectMovimientoIndex();
        selectDatosTrabajador();
        
    }
});

function selectMovimientoIndex() {
    //alert('mostrarMovimientos.js');
  $.ajax({
      url: '../../../controller/MovimientoMostrarC.php',
      type: 'GET',
      success: function (response) {

        clearTable('#tableIndex');
        try {
            var json = JSON.parse(response);
            //alert(json.data[0].id_movimiento);
            
            
            for (i = 0; i < json.data.length; i++) {
                addRowMovimientoIndex(
                    "#tableIndex",
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

function selectDatosTrabajador() {
    //alert('mostrarMovimientos.js');
    $.ajax({
        url: '../../../controller/TrabajadorIndexC.php',
        type: 'POST',
        success: function (response) {
            try {

                var json = JSON.parse(response);
                console.log(json);
                //alert('Saldo: '+json.monto[0][0].monto_fondo);
                $('#miembrosIndex').html(json.data[0][0].total+" Miembros");
                $('#activosIndex').html(json.data[0][0].activos+" Activos");
                $('#pendientesIndex').html(json.data[0][0].pendientes+" Pendientes");
                $('#inactivosIndex').html(json.data[0][0].inactivos+" Inactivos");

            } catch (err) {
                alert(err);
            }

        }

    });

}
