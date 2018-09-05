function addRowMovimiento(nombreTabla, folio, tipo, categoria, nombre, desc, monto, fecha, por) {
    var t = $(nombreTabla).DataTable({
        destroy: true,
        responsive: true,
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
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
        }
    });

    var idMonto="montoRow"+folio;
    var idBtnSave="btnSave"+folio;
    var idBtnEdit="btnEdit"+folio;
    var idBtnDelete="btnDelete"+folio;
	
    t.row.add([
        folio,
        tipo,      
        categoria,
        nombre,
        desc,
        monto,
        /* '<input id="'+idMonto+'" class="form-control" type="number" id="monto" name="'+idMonto+'" value="'+monto+'" disabled>', */
        fecha.substr(0, 10),
        por,
        /* '<div class="d-flex flex-row">'+
        '<button id="'+idBtnEdit+'" name="'+idBtnEdit+'" onClick="habilitar('+folio+')" class="btn btn-dark"><i class="fas fa-pen-alt"></i></button>'+              
        '<button id="'+idBtnSave+'" name="'+idBtnSave+'" onClick="updateMovimiento('+folio+')" class="btn btn-success ml-1 mr-1" disabled><i class="fas fa-save"></i></button>'+
        '<button id="'+idBtnDelete+'" name="'+idBtnDelete+'" onClick="preguntarEliminarMovimiento('+folio+')" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>'+  
        //'<button id="'+idBtnDelete+'" name="'+idBtnDelete+'" onClick="deleteMovimiento(' + folio + ')" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>'+  
        '</div>' */
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


function clearTable(nombreTabla) {
    var t = $(nombreTabla).DataTable();

    t
            .clear()
            .draw();
}//clearTable()