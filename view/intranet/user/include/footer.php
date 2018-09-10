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


<?php include('modal_logout.php');?>
<?php include('modal_confirm_top.php');?>
<?php include('modal_msg_top.php');?>



<!-- Bootstrap core JavaScript-->
<script src="../../../assets/vendor/jquery/jquery-3.3.1.min.js"></script>

<script src="../../../assets/vendor/gijgo/js/gijgo.min.js"></script>
<script src="../../../assets/vendor/gijgo/js/messages.es-es.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="../../../assets/js/sb-admin.min.js"></script>
<?php     if ($pageName[0]=="index"): ?>
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
<?php elseif ($pageName[0]=="userManage"): ?>
  <script src="../../../assets/js/jquery.rut.min.js"></script>
  <script src="../../../assets/js/user/userManager.js"></script>
  <script src="../../../assets/js/paginador.js"></script>
  <script src="../../../assets/js/cargo.js"></script>
  <script src="../../../assets/js/comuna.js"></script>
  <script src="../../../assets/js/dataPicker.js"></script>
  <script src="../../../assets/js/modal.js"></script>
<?php elseif ($pageName[0]=="sonNew"): ?>
  <script src="../../../assets/js/jquery.rut.min.js"></script>
  <script src="../../../assets/js/user/sonManager.js"></script>
  <script src="../../../assets/js/dataPicker.js"></script>
  <script src="../../../assets/js/modal.js"></script>
<?php elseif ($pageName[0]=="sonManage"): ?>
  <script src="../../../assets/js/jquery.rut.min.js"></script>
  <script src="../../../assets/js/user/sonManager.js"></script>
  <script src="../../../assets/js/dataPicker.js"></script>
  <script src="../../../assets/js/modal.js"></script>
<?php elseif ($pageName[0]=="moveManage"): ?>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
  <script src="../../../assets/js/numberFormat.js"></script>
  <script src="../../../assets/js/user/moveManager.js"></script>
<?php elseif ($pageName[0]=="barChartEntry"): ?>
  <script src="../../../assets/vendor/chart/Chart.bundle.js"></script>
  <script src="../../../assets/vendor/chart/Chart.bundle.min.js"></script>
  <script src="../../../assets/vendor/chart/Chart.js"></script> 
  <script src="../../../assets/vendor/chart/Chart.min.js"></script>
  <script src="../../../assets/js/user/moveManager.js"></script>
  <script src="../../../assets/vendor/FileSaver/FileSaver.js"></script>  
<?php elseif ($pageName[0]=="barChartExit"): ?>
  <script src="../../../assets/vendor/chart/Chart.bundle.js"></script>
  <script src="../../../assets/vendor/chart/Chart.bundle.min.js"></script>
  <script src="../../../assets/vendor/chart/Chart.js"></script>
  <script src="../../../assets/vendor/chart/Chart.min.js"></script>
  <script src="../../../assets/js/user/moveManager.js"></script>
  <script src="../../../assets/vendor/FileSaver/FileSaver.js"></script>
<?php  endif; ?>
<script src="../../../assets/js/general.js"></script>



                

<!-- Custom scripts for all pages-->



















</body>

</html>