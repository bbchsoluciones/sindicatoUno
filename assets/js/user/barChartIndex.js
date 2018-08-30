$(function () {
    if ($('body').hasClass('index')) {
        
        graficoMiembros();
    }
});

function graficoMiembros(){

    $.ajax({
        url: '../../../controller/TrabajadorIndexC.php',
        success: function (response) {
            try {
                var json = JSON.parse(response);
                //console.log(json)
                var ctx = document.getElementById('graficoMovIndex').getContext('2d');
                var chart = new Chart(ctx, {
                    // The type of chart we want to create
                    type: 'doughnut',

                    // The data for our dataset
                    data: {
                        labels: ["Ingresos", "Egresos"],
                        datasets: [{
                            backgroundColor: ['rgba(18, 161, 8, 0.65)','rgba(255, 20, 20, 0.82)'],
                            borderColor: ['black','black'],
                            data: [json.data[0][0].hombres, json.data[0][0].mujeres],
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

    
                
    

    /* $.ajax({
        url: '../../../controller/MovimientoGraficoIngresoC.php',
        type: 'POST',
        data: parametros,
        success: function (response) {
            try {
                
               var json = JSON.parse(response);

            } catch (err) {
                graficoVacio(categoria,anio);
                $('#contenedorGraficoIngreso').html('<div class="col-12 text-center">Sin resultados</div>');
            }

        }
       
    }); */

}//graficoMiembros()