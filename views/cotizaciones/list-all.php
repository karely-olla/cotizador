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
    <section class="content">      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Lista de Cotizaciones</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Cerrar/Abrir">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
        	<div class="panel panel-default">
    			  <div class="panel-heading">
    			  </div>
    			  <div class="panel-body">                
    	         	<div class="tbl_cots">
                  <table class="table table-condensed table-hover table-striped" id="tbl_cots_all">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Folio</th>
                        <th>Ejecutivo</th>
                        <th>Empresa/Grupo</th>
                        <th>Monto</th>
                        <th>Vencimiento</th>
                        <th>Estado</th>
                        <th>Opciones</th>
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

<!-- Modal para mostrar la Orden de servicio -->
<div class="modal fade" id="orden_view" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Orden de Servicio</h4>
        </div>
        <div class="modal-body">
          <embed src="" type="" id="pdf_orden" width="100%" height="650px">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<?php require '../layouts/footer.php'; ?>	
<script src="<?= link ?>js/backjs/list-all.js"></script>

