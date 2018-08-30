function addRowMovimiento(nombreTabla, folio, tipo, categoria, nombre, desc, monto, fecha) {
    var t = $(nombreTabla).DataTable();
	
    t.row.add([
        folio,
        tipo,      
        categoria,
        nombre,
        desc,
        monto,
        fecha.substr(0, 10)
    ]).draw(false).order( [ 6, 'desc' ] );
}//addRowMovimiento()


function clearTable(nombreTabla) {
    var t = $(nombreTabla).DataTable();

    t
            .clear()
            .draw();
}//clearTable()