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
          <h3 class="box-title">Lista de Usuarios</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Cerrar/Abrir">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
        	<div class="panel panel-default">
    			  <div class="panel-heading">
    			    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#create">Registrar <i class="fa fa-users"></i></button>
    			  </div>
    			  <div class="panel-body">
    		         	<table class="table table-condensed table-hover table-striped" id="tbl_users">
    		         		<thead>
    		         			<tr>
    		         				<th>N°</th>
    		         				<th>Nombre</th>
                        <th>Foto</th>
    		         				<th>Correo</th>
                        <th>Telefono</th>
                        <th>Usuario</th>
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
    <form method="POST" id="frm_create" class="frm_create" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Nuevo servicio</h4>
        </div>
        <div class="modal-body">
          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <label>Nombre:</label>
            <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
          </div>
          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <label>Apellido:</label>
            <input type="text" name="apellido" class="form-control" placeholder="Apellidos" required>
          </div>
          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <label>Correo:</label>
            <input type="email" name="correo" class="form-control" placeholder="Correo" required>
          </div>
          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <label>Telefono:</label>
            <input type="text" name="telefono" class="form-control" placeholder="Telefono" required>
          </div>
          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <label>Usuario:</label>
            <input type="text" name="usuario" class="form-control" placeholder="Usuario" required>
          </div>
          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <label>Asignar Rol:</label>
            <select name="rol" id=""  class="form-control selectpicker" data-live-search="true" title="Elige un rol" required>
              <option value="usuario">Usuario</option>
              <option value="vendedor">Vendedor</option>
              <option value="admin">Administrador</option>
            </select>
          </div>  
          <div class="form-group input-file col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <label class="btn btn-warning" for="imagen">
              Avatar del usuario
              <input type="file" name="imagen" onchange="mostrarImagen('frm_create',event)" id="imagen" class="form-control" required>
            </label>
            <div class="show_prev_img">
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="form-group">
              <div class="progress" hidden>
                <div id="barra_estado" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="">
                  <span></span>
                </div>
              </div>
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
    <form method="POST" id="frm_edit" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Editar Usuario</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="id_usuario">
          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <label>Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" required>
          </div>
          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <label>Apellido:</label>
            <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Apellidos" required>
          </div>
          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <label>Correo:</label>
            <input type="email" name="correo" id="correo" class="form-control" placeholder="Correo" required>
          </div>
          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <label>Telefono:</label>
            <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Telefono" required>
          </div>
          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <label>Usuario:</label>
            <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuario" required>
          </div>
          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <label>Contraseña:</label>
            <input type="text" name="contraseña" id="contraseña" readonly class="form-control" >
          </div>
          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <label>Asignar Rol:</label>
            <select name="rol" id="rol"  class="form-control selectpicker" data-live-search="true" title="Elige un rol" required>
              <option value="usuario">Usuario</option>
              <option value="vendedor">Vendedor</option>
              <option value="admin">Administrador</option>
            </select>
          </div>
          <div class="form-group input-file col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <label class="btn btn-warning" for="imagen">
              Avatar del usuario
              <input type="file" name="imagen" onchange="mostrarImagen('frm_edit',event)" id="imagen" class="form-control">
            </label>
            <div class="show_prev_img">
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="form-group">
              <div class="progress" hidden>
                <div id="barra_estado" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="">
                  <span></span>
                </div>
              </div>
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

<?php require '../layouts/footer.php'; ?> 
<script src="<?= link; ?>js/backjs/user.js"></script>
