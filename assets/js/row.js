function addRowMovimiento(nombreTabla, folio, tipo, categoria, nombre, monto, fecha, por) {
    var t = $(nombreTabla).DataTable();

    var idMonto="montoRow"+folio;
    var idBtnSave="btnSave"+folio;
    var idBtnEdit="btnEdit"+folio;
    var idBtnDelete="btnDelete"+folio;
	
    t.row.add([
        folio,
        tipo,      
        categoria,
        nombre,
        '<input id="'+idMonto+'" class="form-control" type="number" id="monto" name="'+idMonto+'" value="'+monto+'" disabled>',
        fecha,
        por,
        '<div class="d-flex flex-row">'+
        '<button id="'+idBtnEdit+'" name="'+idBtnEdit+'" onClick="habilitar('+folio+')" class="btn btn-dark"><i class="fas fa-pen-alt"></i></button>'+              
        '<button id="'+idBtnSave+'" name="'+idBtnSave+'" onClick="updateMovimiento('+folio+')" class="btn btn-success ml-1 mr-1" disabled><i class="fas fa-save"></i></button>'+
        '<button id="'+idBtnDelete+'" name="'+idBtnDelete+'" onClick="preguntarEliminarMovimiento('+folio+')" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>'+  
        //'<button id="'+idBtnDelete+'" name="'+idBtnDelete+'" onClick="deleteMovimiento(' + folio + ')" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>'+  
        '</div>'
    ]).draw(false).order( [ 5, 'desc' ] );
}//addRowMovimiento()

function addRowMovimientoIndex(nombreTabla, folio, tipo, categoria, nombre, monto, fecha, por) {
    var t = $(nombreTabla).DataTable();
	
    t.row.add([
        folio,
        tipo,      
        categoria,
        nombre,
        monto,
        fecha,
        por
    ]).draw(false).order( [ 5, 'desc' ] );
}//addRowMovimientoIndex()

function addRowNoticia(nombreTabla, id, img, titulo, estado, fecha, por) {
    var t = $(nombreTabla).DataTable();

    /* var idMonto="montoRow"+folio;
    var idBtnSave="btnSave"+folio;
    var idBtnEdit="btnEdit"+folio;
    var idBtnDelete="btnDelete"+folio; */
	
    t.row.add([
        id,
        '<div class="row justify-content-center"><img class="cover_miniatura" src="'+img+'"></img></div>',      
        titulo,
        estado,
        //'<input id="'+idMonto+'" class="form-control" type="number" id="monto" name="'+idMonto+'" value="'+monto+'" disabled>',
        fecha,
        por,
        ''
        /* ,
        '<div class="d-flex flex-row">'+
        '<button id="'+idBtnEdit+'" name="'+idBtnEdit+'" onClick="habilitar('+folio+')" class="btn btn-dark"><i class="fas fa-pen-alt"></i></button>'+              
        '<button id="'+idBtnSave+'" name="'+idBtnSave+'" onClick="updateMovimiento('+folio+')" class="btn btn-success ml-1 mr-1" disabled><i class="fas fa-save"></i></button>'+
        '<button id="'+idBtnDelete+'" name="'+idBtnDelete+'" onClick="preguntarEliminarMovimiento('+folio+')" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>'+  
        //'<button id="'+idBtnDelete+'" name="'+idBtnDelete+'" onClick="deleteMovimiento(' + folio + ')" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>'+  
        '</div>' */
    ]).draw(false).order( [ 5, 'desc' ] );
}//addRowMovimiento()

function clearTable(nombreTabla) {
    var t = $(nombreTabla).DataTable();

    t
            .clear()
            .draw();
}//clearTable()