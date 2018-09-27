</div>
<!-- /.container-fluid -->

<!-- Sticky Footer -->
<footer class="sticky-footer">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Copyright © Your Website 2018</span>
    </div>
  </div>
</footer>

</div>
<!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>


<?php include 'modal_logout.php';?>
<?php include 'modal_confirm_top.php';?>
<?php include 'modal_msg_top.php';?>



<!-- Bootstrap core JavaScript-->
<script src="../../../assets/vendor/jquery/jquery-3.3.1.min.js"></script>

<script src="../../../assets/vendor/gijgo/js/gijgo.min.js"></script>
<script src="../../../assets/vendor/gijgo/js/messages.es-es.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="../../../assets/js/sb-admin.js"></script>
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
<script src="../../../assets/vendor/bootstrap-notify-master/bootstrap-notify.min.js"></script>
<?php if ($pageName[0] == "index"): ?>
  <script src="../../../assets/vendor/datatables/jquery.dataTables.js"></script>
  <script src="../../../assets/vendor/datatables/dataTables.bootstrap4.js"></script>
  <script src="../../../assets/vendor/datatables/dataTables.bootstrap4.js"></script>
  <!-- <script src="../../../assets/js/user/barChartIndex.js"></script> -->
  <script src="../../../assets/js/row.js"></script>
  <script src="../../../assets/vendor/chart/Chart.bundle.js"></script>
  <script src="../../../assets/vendor/chart/Chart.bundle.min.js"></script>
  <script src="../../../assets/vendor/chart/Chart.js"></script>
  <script src="../../../assets/vendor/chart/Chart.min.js"></script>
  <script src="../../../assets/js/user/indexManager.js"></script>
  <script src="../../../assets/js/numberFormat.js"></script>
<?php elseif ($pageName[0] == "userManage"): ?>
  <script src="../../../assets/js/jquery.rut.min.js"></script>
  <script src="../../../assets/js/user/userManager.js"></script>
  <script src="../../../assets/js/paginador.js"></script>
  <script src="../../../assets/js/cargo.js"></script>
  <script src="../../../assets/js/comuna.js"></script>
  <script src="../../../assets/js/dataPicker.js"></script>
  <script src="../../../assets/js/modal.js"></script>
<?php elseif ($pageName[0] == "sonNew"): ?>
  <script src="../../../assets/js/jquery.rut.min.js"></script>
  <script src="../../../assets/js/user/sonManager.js"></script>
  <script src="../../../assets/js/dataPicker.js"></script>
  <script src="../../../assets/js/modal.js"></script>
<?php elseif ($pageName[0] == "sonManage"): ?>
  <script src="../../../assets/js/jquery.rut.min.js"></script>
  <script src="../../../assets/js/user/sonManager.js"></script>
  <script src="../../../assets/js/dataPicker.js"></script>
  <script src="../../../assets/js/modal.js"></script>
<?php elseif ($pageName[0] == "moveManage"): ?>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
  <script src="../../../assets/js/numberFormat.js"></script>
  <script src="../../../assets/js/user/moveManager.js"></script>
<?php elseif ($pageName[0] == "barChartEntry"): ?>
  <script src="../../../assets/vendor/chart/Chart.bundle.js"></script>
  <script src="../../../assets/vendor/chart/Chart.bundle.min.js"></script>
  <script src="../../../assets/vendor/chart/Chart.js"></script>
  <script src="../../../assets/vendor/chart/Chart.min.js"></script>
  <script src="../../../assets/js/user/moveManager.js"></script>
  <script src="../../../assets/vendor/FileSaver/FileSaver.js"></script>
<?php elseif ($pageName[0] == "barChartExit"): ?>
  <script src="../../../assets/vendor/chart/Chart.bundle.js"></script>
  <script src="../../../assets/vendor/chart/Chart.bundle.min.js"></script>
  <script src="../../../assets/vendor/chart/Chart.js"></script>
  <script src="../../../assets/vendor/chart/Chart.min.js"></script>
  <script src="../../../assets/js/user/moveManager.js"></script>
  <script src="../../../assets/vendor/FileSaver/FileSaver.js"></script>
  <?php elseif ($pageName[0] == "imageApproval"): ?>
  <script src="../../../assets/js/user/userManager.js"></script>
<?php endif;?>
<script src="../../../assets/js/general.js"></script>
<script>

var pusher = new Pusher('007aa358a604a98ed413', {
    cluster: 'us2',
    forceTLS: true
});
var channel = pusher.subscribe('user_'+<?php echo $_SESSION['run_trabajador']; ?>);
channel.bind('my-event', function (data) {
    listar_notificaciones();
    $.notify({
        icon: data.image,
        title: data.title,
        message: data.message,
        url: data.url
    },{
        type: 'minimalist',
        delay: 5000,
        icon_type: 'image',
        template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
            '<img data-notify="icon" class="rounded-circle float-left">' +
            '<span data-notify="title">{1}</span>' +
            '<span data-notify="message">{2}</span>' +
        '</div>'
    });
});
$(function () {
    listar_notificaciones();
});

function listar_notificaciones() {
    limpiarCampo("#notificaciones");
    limpiarCampo("#contador_notificaciones");
    var parametros = {
        "notificaciones_user": 1
    };
    $.ajax({
        data: parametros,
        url: '../../../controller/NotificacionesC.php',
        type: 'GET',
        success: function (response) {
            try {
                var json = JSON.parse(response);
                var separador = null;
                var noti = null;
                if (json.mensaje) {
                    $("#notificaciones").html('<div class="px-3 descripcion animated fadeIn">' + json.mensaje + '</div>');
                }
                if (json.length > 0) {
                    $(".fa-bell").addClass("animated swing");
                    $("#contador_notificaciones").addClass("animated swing").html(json.length);
                }

                for (var i = 0; i < json.length; i++) {
                    if (i < 4) {
                        if (i < 3 && i < json.length-1) {
                            separador = '<div class="dropdown-divider"></div>';
                        } else {
                            separador = "";
                        }
                        $("#notificaciones").append('<a class="dropdown-item notificacion_items" href="imageApproval.php">' +
                            '<span class=""><img class="rounded-circle" src="' + json[i].url_foto_perfil + '"/></span>' +
                            '<span class="pl-3 pr-1"> ' +
                            '<div class="descripcion">' + json[i].descripcion + '</div>' +
                            '<div class="fecha">' + json[i].fecha + '</div>' +
                            '</span>' +
                            '</a>' + separador);
                    }
                }

                if(json.length>4){
                    if((json.length-4)===0){
                        noti='Notificación';
                    }else{
                        noti="Notificaciones";
                    }
                    $("#notificaciones").append('<div class="dropdown-divider"></div>'+
                        '<a class="dropdown-item notificacion_items" href="imageApproval.php">' +
                        '<span class="text-success">+'+((json.length)-4)+'</span>' +
                        '<span class="pl-3 pr-1"> ' +
                        '<div class="descripcion">'+noti+'</div>' +
                        '</span>' +
                        '</a>');
                }

            } catch (err) {
                //
            }

        }
    });
}
</script>




<!-- Custom scripts for all pages-->



















</body>

</html>