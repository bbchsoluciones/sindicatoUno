function preguntarEliminarMovimiento(folio) {

	/* Configuración Modal */
	$("#titleConfirm").text("¿Eliminar Movimiento " + folio + " ?");
	$("#cuerpoConfirm").html('Seleccione "Borrar" a continuación si está seguro de borrar el movimiento.');
	$("#cancelarConfirm").text("Cancelar");
	$("#cancelarConfirm").addClass("btn-success");
	$("#cancelarConfirm").attr("onclick", "borrar(false)");
	$("#aceptarConfirm").text("Borrar");
	$("#aceptarConfirm").addClass("btn-danger");
	$("#aceptarConfirm").attr("onclick", "borrar(true)");
	$('#confirm').modal('show');

}

function informarActualizarMovimientoTrue() {

	/* Configuración Modal */
	$("#titleMsg").text('Monto modificado');
	$("#cuerpoMsg").html('El monto del movimiento se ha modificado con éxito');
	$("#aceptarMsg").text("Aceptar");
	$("#aceptarMsg").addClass("btn-primary");
	$('#msg').modal('show');

}

function informarActualizarMovimientoFalse() {

	/* Configuración Modal */
	$("#titleMsg").text('Sin cambios');
	$("#cuerpoMsg").html('No se han registrado modificaciones');
	$("#aceptarMsg").text("Aceptar");
	$("#aceptarMsg").addClass("btn-primary");
	$('#msg').modal('show');

}

function registradoMovimiento() {

	/* Configuración Modal */
	$("#titleMsg").text('Registrado Éxitosamente');
	$("#cuerpoMsg").html('Movimiento registrado éxitosamente');
	$("#aceptarMsg").text("Aceptar");
	$("#aceptarMsg").addClass("btn-primary");
	$('#msg').modal('show');

}

function noRegistradoMovimiento() {

	/* Configuración Modal */
	$("#titleMsg").text('No registrado');
	$("#cuerpoMsg").html('Movimiento no registrado');
	$("#aceptarMsg").text("Aceptar");
	$("#aceptarMsg").addClass("btn-primary");
	$('#msg').modal('show');

}

function camposVacios() {

	/* Configuración Modal */
	$("#titleMsg").text('Campos Vacíos');
	$("#cuerpoMsg").html('Asegúrese de completar todos los datos solicitados');
	$("#aceptarMsg").text("Aceptar");
	$("#aceptarMsg").addClass("btn-primary");
	$('#msg').modal('show');

}

function graficoVacio(categoria, anio) {

	if (categoria === '' && anio === '') {
		/* Configuración Modal */
		$("#titleMsg").text('Seleccione una categoria');
		$("#cuerpoMsg").html('Por favor seleccione una categoria');
		$("#aceptarMsg").text("Aceptar");
		$("#aceptarMsg").addClass("btn-primary");
		$('#msg').modal('show');

	} else {

		/* Configuración Modal */
		$("#titleMsg").text('Sin resultados');
		$("#cuerpoMsg").html('No hay datos en la categoria: ' + categoria + ' del año ' + anio);
		$("#aceptarMsg").text("Aceptar");
		$("#aceptarMsg").addClass("btn-primary");
		$('#msg').modal('show');

	}
}

function modalConfirmarEliminar(nombre, funcion) {

	if (nombre == "noticia" || nombre == "imagen") {
		$("#titleConfirm").text("¿Realmente desea eliminar esta " + nombre + "?");
		$("#cuerpoConfirm").html('Presione "Borrar" si esta seguro de eliminar este registro.');
	} else {
		$("#titleConfirm").text("¿Realmente desea eliminar a " + nombre + "?");
		$("#cuerpoConfirm").html('Presione "Borrar" si esta seguro de eliminar a esta persona.');
	}
	$("#cancelarConfirm").text("Cancelar");
	$("#cancelarConfirm").addClass("btn-success");
	$("#aceptarConfirm").text("Borrar");
	$("#aceptarConfirm").addClass("btn-danger");
	$("#aceptarConfirm").attr("onclick", funcion);
	$('#confirm').modal('show');
}

function modalConfirmarEliminarImagenG(nombre, funcion) {

	$("#titleConfirm").text("¿Realmente desea eliminar " + nombre + "?");
	$("#cuerpoConfirm").html('Presione "Borrar" si esta seguro de eliminar este registro.');
	$("#cancelarConfirm").text("Cancelar");
	$("#cancelarConfirm").addClass("btn-success");
	$("#aceptarConfirm").text("Borrar");
	$("#aceptarConfirm").addClass("btn-danger");
	$("#aceptarConfirm").attr("onclick", funcion);
	$('#confirm').modal('show');
}

function modalInformacion(json) {
	$("#aceptarMsg").removeClass("btn-danger");
	$("#aceptarMsg").removeClass("btn-success");
	$("#aceptarMsg").removeClass("btn-warning");
	if (json.hasOwnProperty("tituloN")) {
		$("#titleMsg").text(json.tituloN);
	} else {
		$("#titleMsg").text(json.titulo);
	}
	$("#cuerpoMsg").html(json.mensaje);
	$("#aceptarMsg").text("Aceptar");
	$("#aceptarMsg").addClass("btn-" + json.clase);
	$('#msg').modal('show');
}

function modalActualizar(folio, tipo, categoria, nombre, monto) {
	/* $("#aceptarMsg").removeClass("btn-danger");
	$("#aceptarMsg").removeClass("btn-success");
	$("#aceptarMsg").removeClass("btn-warning");
    $("#titleMsg").text("json.titulo");
    $("#cuerpoMsg").html("json.mensaje");
    $("#aceptarMsg").text("Aceptar");
	$("#aceptarMsg").addClass("btn-" + "json.clase"); */
	$("#inputCenterTitle").text('Movimiento ' + folio);
	var cuerpo = '<div class="form-row">' +
		'<div class="form-group col-md-3 col-sm-12">' +
		'<label for="tipoMovModal">Tipo</label>' +
		'<input id="tipoMovModal" type="text" class="form-control" value="' + tipo + '" disabled>' +
		'</div>' +
		'<div class="form-group col-md-9 col-sm-12">' +
		'<label for="cateMovModal">Categoria</label>' +
		'<input id="cateMovModal" type="text" class="form-control" value="' + categoria + '" disabled>' +
		'</div>' +
		'<div class="form-group col-md-8 col-sm-12">' +
		'<label for="nomMovModal">Nombre</label>' +
		'<input id="nomMovModal" type="text" class="form-control" value="' + nombre + '" disabled>' +
		'</div>' +
		'<div class="form-group col-md-4 col-sm-12">' +
		'<label for="montoMovModal">Monto</label>' +
		'<input id="montoMovModal" type="text" class="form-control" value="' + monto + '" placeholder="' + monto + '">' +
		'</div>' +
		'</div>';
	$("#inputBody").html(cuerpo);
	$("#cancelar").text("Cancelar");
	$("#cancelar").addClass("btn-danger");
	$("#cancelar").attr("onclick", "actualizar(false, '', '')");
	$("#actualizar").text("Guardar");
	$("#actualizar").addClass("btn-success");
	$("#actualizar").attr("onclick", 'actualizar(true, ' + folio + ', $("#montoMovModal").val(), ' + monto + ')');
	$('#inputCenter').modal('show');
}