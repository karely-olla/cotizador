<?php require '../layouts/auth.php'; ?>
<?php require '../layouts/header.php'; ?>
<?php require '../layouts/barra.php'; ?>
<?php require '../layouts/navegacion.php'; ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <!-- <h1>
        Blank page
        <small>it all starts here</small>
      </h1> -->
    </section>

    <!-- Main content -->
    <section class="content">
     <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Lista de Grupos</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Cerrar/Abrir">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
        	<div class="panel panel-default">
    			  <div class="panel-heading">
    			    <!-- <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#create">Agregar <i class="fa fa-plus"></i></button> -->
    			  </div>
    			  <div class="panel-body">
    	         	<div class="tbl_cots">
                  <table class="table table-condensed table-hover table-striped" id="tbl_groups">
                    <thead>
                      <tr>
                        <th>N°</th>
                        <th>Empresa/Grupo</th>
                        <th>Procedencia</th>
                        <th>Cotizaciones</th>
                        <th>Monto</th>
                        <th>Ingresado</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
                </div>
    			  </div>
    			</div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
</div>


<?php include '../layouts/footer.php'; ?>	
<script src="<?= link ?>js/backjs/group.js"></script>

