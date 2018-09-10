$(function () {
    if ($('body').hasClass('index')) {
        mostrarFondo();
        mostrarCantidadMov();
        
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
                    alert(err);
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
                    alert(err);
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
                    alert(err);
                }

            }, 800);       
            

        }

    });

}



