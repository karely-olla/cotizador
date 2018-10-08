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
          <h3 class="box-title">Lista de Alimentos</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Cerrar/Abrir">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
        	<div class="panel panel-default">
    			  <div class="panel-heading">
    			    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#create">Agregar <i class="fa fa-plus"></i></button>
    			  </div>
    			  <div class="panel-body">
    		         	<table class="table table-condensed table-hover table-striped" id="tbl_eats">
    		         		<thead>
    		         			<tr>
    		         				<th>N°</th>
    		         				<th>Categoria</th>
                        <th>Nombre</th>
    		         				<th>Precio</th>
                        <th>Precio C/IVA</th>
                        <th>Tag</th>
    		         				<th>Estado</th>
    		         				<th>Opciones</th>
    		         				<th>On/Off</th>
    		         			</tr>
    		         		</thead>
    		         		<tbody></tbody>
    		         	</table>
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
<div class="modal fade" id="create" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form method="POST" id="frm_create" class="frm_create">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Nuevo servicio</h4>
        </div>
        <div class="modal-body">
          <div class="form-group cats">
            <label>Categoria:</label>
            <div class="radio">
              <input type="radio" name="categoria" onchange="category(this.value)" id="alimentos" value="Alimentos" required>
              <label for="alimentos">Alimentos</label>
              <input type="radio" name="categoria" onchange="category(this.value)" id="servicios" value="Servicios" required>
              <label for="servicios">Servicios</label>
              <input type="radio" name="categoria" onchange="category(this.value)" id="precios-generales" value="Precios Generles" required>
              <label for="precios-generales">Precios Generles</label>
            </div>
          </div>
          <div class="form-group">
            <label>Subcategoria:</label>
            <input type="text" name="subcategoria" id="subcategoria" class="form-control" placeholder="Subcategoria" required>
          </div>
          <div class="form-group">
            <label>Servicio:</label>
            <input type="text" name="servicio" class="form-control" placeholder="Servicio" required>
          </div>
          <div class="form-group">
            <label>Precio Con/IVA:</label>
            <input type="text" name="precio" min="0" maxlength="7" class="form-control"  required>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </div><!-- /.modal-content -->
    </form>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Edit -->
<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form method="POST" id="frm_edit">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Editar servicio</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="id_servicio">
          <div class="form-group cats">
            <label>Categoria:</label>
            <div class="radio">
              <input type="radio" name="categoria" onchange="category_edit(this.value)" id="alimentos-edit" value="Alimentos" required>
              <label for="alimentos-edit">Alimentos</label>
              <input type="radio" name="categoria" onchange="category_edit(this.value)" id="servicios-edit" value="Servicios" required>
              <label for="servicios-edit">Servicios</label>
              <input type="radio" name="categoria" onchange="category_edit(this.value)" id="precios-generales-edit" value="Precios Generales" required>
              <label for="precios-generales-edit">Precios Generales</label>
            </div>
          </div>
          <div class="form-group">
            <label>Subcategoria:</label>
            <input type="text" name="subcategoria" id="subcategoria" class="form-control" placeholder="Subcategoria" required>
          </div>
          <div class="form-group">
            <label>Servicio</label>
            <input type="text" name="servicio" id="servicio" class="form-control" placeholder="Servicio" required>
          </div>
          <div class="form-group">
            <label>Precio C/IVA</label>
            <input type="text" name="precio" min="0 maxlength="7" id="precio" class="form-control"  required>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </div><!-- /.modal-content -->
    </form>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<?php include '../layouts/footer.php'; ?>	
<script src="<?= link ?>js/backjs/servicio.js"></script>