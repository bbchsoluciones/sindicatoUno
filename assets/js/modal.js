function preguntarEliminarMovimiento(folio){

    /* Configuración Modal */
	$("#titleConfirm").text("¿Realmente desea eliminar este movimiento?");
	$("#cuerpoConfirm").html('Seleccione "Borrar" a continuación si está seguro de borrar el movimiento.');
	$("#cancelarConfirm").text("Cancelar");
	$("#cancelarConfirm").addClass("btn-success");
    $("#aceptarConfirm").text("Borrar");
    $("#aceptarConfirm").addClass("btn-danger");
	$("#aceptarConfirm").attr("onclick", "deleteMovimiento("+folio+")");
	$('#confirm').modal('show');

}

function informarActualizarMovimientoTrue(){

    /* Configuración Modal */
	$("#titleMsg").text('Monto modificado');
	$("#cuerpoMsg").html('El monto del movimiento se ha modificado con éxito');
	$("#aceptarMsg").text("Aceptar");
	$("#aceptarMsg").addClass("btn-primary");
	$('#msg').modal('show');

}

function informarActualizarMovimientoFalse(){

	/* Configuración Modal */
	$("#titleMsg").text('Sin cambios');
	$("#cuerpoMsg").html('No se han registrado modificaciones');
	$("#aceptarMsg").text("Aceptar");
	$("#aceptarMsg").addClass("btn-primary");
	$('#msg').modal('show');

}

function registradoMovimiento(){

	/* Configuración Modal */
	$("#titleMsg").text('Registrado Éxitosamente');
	$("#cuerpoMsg").html('Movimiento registrado éxitosamente');
	$("#aceptarMsg").text("Aceptar");
	$("#aceptarMsg").addClass("btn-primary");
	$('#msg').modal('show');

}

function noRegistradoMovimiento(){

	/* Configuración Modal */
	$("#titleMsg").text('No registrado');
	$("#cuerpoMsg").html('Movimiento no registrado');
	$("#aceptarMsg").text("Aceptar");
	$("#aceptarMsg").addClass("btn-primary");
	$('#msg').modal('show');

}

function camposVacios(){

	/* Configuración Modal */
	$("#titleMsg").text('Campos Vacíos');
	$("#cuerpoMsg").html('Asegúrese de completar todos los datos solicitados');
	$("#aceptarMsg").text("Aceptar");
	$("#aceptarMsg").addClass("btn-primary");
	$('#msg').modal('show');

}

function graficoVacio(categoria,anio){

	if(categoria==='' && anio===''){
		/* Configuración Modal */
$("#titleMsg").text('Seleccione una categoria');
$("#cuerpoMsg").html('Por favor seleccione una categoria');
$("#aceptarMsg").text("Aceptar");
$("#aceptarMsg").addClass("btn-primary");
$('#msg').modal('show');

	}else{

		/* Configuración Modal */
$("#titleMsg").text('Sin resultados');
$("#cuerpoMsg").html('No hay datos en la categoria: '+categoria+' del año '+anio);
$("#aceptarMsg").text("Aceptar");
$("#aceptarMsg").addClass("btn-primary");
$('#msg').modal('show');

	}



}