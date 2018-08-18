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
                var ctx = document.getElementById('graficoMiembros').getContext('2d');
                var chart = new Chart(ctx, {
                    // The type of chart we want to create
                    type: 'pie',

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