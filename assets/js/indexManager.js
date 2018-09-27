$(function () {
    if ($('body').hasClass('index')) {
        mostrarFondo();
        mostrarCantidadMov();
        selectDatosTrabajador();
        selectMovimiento();
        graficoMiembros();
        
    }
});

function mostrarFondo() {

    $.ajax({
        url: '../../../controller/FondoC.php',
        type: 'POST',
        success: function (response) {
            setTimeout(function () {
                $('#loadFondo').addClass("d-none");
                $('#cardFondo').removeClass("d-none");
                try {
                    var json = JSON.parse(response);
                    $('#montoIngresos').html("$"+numberFormat(json.monto[0][0].ingreso));
                    $('#montoEgresos').html("$"+numberFormat(json.monto[0][0].egreso));
                    $('#saldoMovimiento').html("$"+numberFormat(json.monto[0][0].fondo));    
                } catch (err) {
                    alert('mostrarFondo(): '+err);
                }
            }, 800); 
        }

    });

}
function mostrarCantidadMov() {

    var parametros = {
        "ajax": 'true',
        "mostrarCantidadMov": 'mostrarCantidadMov'
    };

    $.ajax({
        url: '../../../controller/MovimientoC.php',
        type: 'POST',
        data: parametros,
        success: function (response) {
            setTimeout(function () {
                $('#loadMovimientos').addClass("d-none");
                $('#cardMovimientos').removeClass("d-none");
                try {

                    var json = JSON.parse(response);
                    //console.log('HOLA'+json);
                    //alert('Saldo: '+json.monto[0][0].monto_fondo);
                    $('#cantIngresos').html(numberFormat(json.data[0].total_ingresos)+' Ingresos');
                    $('#cantEgresos').html(numberFormat(json.data[0].total_egresos)+' Egresos');
                    $('#cantMov').html(numberFormat(json.data[0].total_mov)+' Movimientos');

                } catch (err) {
                    alert('mostrarCantidadMov(): '+err);
                }

            }, 800); 
            

        }

    });

}
function mostrarDatosTrabajador(run) {
    var parametros = {
        "ajax": 'true',
        "mostrarDatosTrabajador": 'mostrarDatosTrabajador',
        "run_trabajador": run
    };

    $.ajax({
        url: '../../../controller/TrabajadorC.php',
        type: 'POST',
        data: parametros,
        success: function (response) {     
            setTimeout(function () {
                $('#loadBienvenida').addClass("d-none");
                $('#cardBienvenida').removeClass("d-none");
                $('#loadDatos').addClass("d-none");
                $('#cardDatos').removeClass("d-none");
                try {      
                    var json = JSON.parse(response);
                    //console.log(json);
                    var nombres=json.data.nombres_trabajador;
                    var primerNombre=nombres.split(' ');

                    $('#saludoTra').html('Hola '+primerNombre[0]+'!');
                    $('#nombresTra').val(json.data.nombres_trabajador);
                    $('#apellidosTra').val(json.data.apellidos_trabajador);
                    $('#miembroDesdeTra').val(json.data.fec_ing_sin_trabajador);
                    $('#puestoTra').val(json.data.nombre_subcargo);
                    $('#areaTra').val(json.data.nombre_cargo);
                    $('#direccionTra').val(json.data.direccion_trabajador);
                    $('#celularTra').val(json.data.celular_trabajador);
                    $('#correoTra').val(json.data.email_trabajador);

                } catch (err) {
                    alert('mostrarDatosTrabajador(): '+err);
                }

            }, 800);       
            

        }

    });

}

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
            setTimeout(function () {
                try {

                    var json = JSON.parse(response);
                    console.log(json);
                    //alert('Saldo: '+json.monto[0][0].monto_fondo);
                    $('#loadMiembros').addClass("d-none");
                    $('#bodyMiembros').removeClass("d-none");
                    $('#bodyMiembros').removeClass("d-none");
                    $('#btnMiembros').removeClass("d-none");
                    $('#miembrosIndex').html(json.data[0][0].total+" Miembros");
                    $('#activosIndex').html(json.data[0][0].activos+" Activos");
                    $('#pendientesIndex').html(json.data[0][0].pendientes+" Pendientes");
                    $('#inactivosIndex').html(json.data[0][0].inactivos+" Inactivos");
    
                } catch (err) {
                    alert('selectDatosTrabajador(): '+err);
                }
            }, 800);   
            

        }

    });

}
function selectMovimiento() {

    var parametros = {
        "ajax": 'true',
        "func": 'selectMov'
    };

    table = $('#tableMov').DataTable( {
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Ver _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "No hay movimientos registrados",
            "sInfo":           "_START_ / _END_ (_TOTAL_ registros)",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        "ajax": {
            "url": "../../../controller/MovimientoC.php",
            "type": "POST",
            "data": parametros
        },
        "columns": [
            { "data": "id_movimiento"},
            { "data": "tipo_movimiento" },
            { "data": "categoria_movimiento"},
            { "data": "nombre_movimiento" },
            { "data": "descripcion_movimiento"},
            { "data": "monto_movimiento" },
            { "data": "fecha_movimiento" }
            
        ],
        "order": [[ 6, "desc" ]]
    } );


}
function graficoMiembros(){

    $.ajax({
        url: '../../../controller/TrabajadorIndexC.php',
        success: function (response) {
            try {
                var json = JSON.parse(response);
                //console.log(json)
                var ctx = document.getElementById('graficoMiembros').getContext('2d');
                var chart = new Chart(ctx, {
                    // The type of chart we want to create
                    type: 'doughnut',

                    // The data for our dataset
                    data: {
                        labels: ["Hombres", "Mujeres", "Otro"],
                        datasets: [{
                            backgroundColor: ['rgba(51, 81, 235, 0.85)','rgba(235, 51, 170, 0.85)','rgba(235, 183, 51, 0.85)'],
                            borderColor: ['rgba(51, 81, 235, 0.85)','rgba(235, 51, 170, 0.85)','rgba(235, 183, 51, 0.85)'],
                            data: [json.data[0][0].hombres, json.data[0][0].mujeres, json.data[0][0].otros],
                        }]
                    },

                    // Configuration options go here
                    options: {
                        legend: {
                        display: true,
                        position:'bottom'
                        }
                    }
                });          

            } catch (err) {
                alert(err);
            }

        }
       
    });

}//graficoMiembros()