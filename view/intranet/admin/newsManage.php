<?php
include('include/header.php');
?>
<div class="register-page pr-0">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Resumen</a>
        </li>
        <li class="breadcrumb-item active">Noticias</li>
        <li class="breadcrumb-item active">Mostrar Noticias</li>
    </ol>


        <div class="row">
            <!--tabla -->
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        Noticias</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered display" id="tableNot" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Img</th>
                                        <th>Titulo</th>
                                        <th>Estado</th>
                                        <th>Fecha</th>
                                        <th>Por</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Img</th>
                                        <th>Titulo</th>
                                        <th>Estado</th>
                                        <th>Fecha</th>
                                        <th>Por</th>
                                        <th>Acción</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>

<?php
include('include/footer.php');
?>