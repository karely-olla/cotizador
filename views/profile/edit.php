<?php require '../layouts/auth.php'; ?>
<?php require '../layouts/header.php'; ?>
<?php require '../layouts/barra.php'; ?>
<?php require '../layouts/navegacion.php'; ?>

<?php require_once '../../config/conexion.php';?>
<?php
  $sql = "SELECT *, (SELECT COUNT(*) FROM cotizaciones WHERE id_usuario=u.id && state = 1) as confirmadas, 
      (SELECT COUNT(*) FROM cotizaciones WHERE id_usuario=u.id && state = 0) as pendientes
      FROM usuarios as u WHERE u.id = '".$_SESSION['iduser']."' ";
  $result = $con->prepare($sql);
  $result->execute();
  $datos = $result->fetch(PDO::FETCH_OBJ);
?>
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
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Fotografia</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Cerrar/Abrir">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                  <div class="card-body">
                      <center class="m-t-30">
                      <div class="user-image">
                          <img src="<?=link?>/img/loading.gif" id="loading" class=" hidden center-block">
                        <?php if ($datos->foto!="sin foto"): ?>
                          <img src="<?=link?>images/avatars/<?=$datos->foto?>" id="img_profile" class="img-circle">        
                        <?php else: ?> 
                            <i class="fa fa-user-circle" style="width: 100%; font-size: 100px; text-align: center;"></i>
                        <?php endif; ?> 
                      </div>
                          <h4 class="card-title m-t-10"><?=$datos->nombre." ".$datos->apellidos?></h4>
                          <h6 class="card-subtitle">Añade una foto tuya al perfil.</h6>
                          <div>
                              <hr> 
                          </div>                         
                      </center>
                      <form id="frm_edit_img" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                          <label class="text-left">Cambiar imagen</label>
                          <label for="imagen_upd" class="btn btn-block btn-default">
                            <i class="fa fa-image"></i> Selecciona una imagen
                            <input type="file" id="imagen_upd" onchange="mostrarFilename(this)" class="form-control" name="imagen" required>
                          </label>
                          <div class="name_file text-center"></div>
                        </div>
                        <div class="form-group text-center">
                          <button type="submit" class="btn btn-danger">Guardar</button>
                        </div>
                      </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
            </div>
            <!-- /.box-footer-->
          </div><!-- .box -->
        </div>
        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Cuenta</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Cerrar/Abrir">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="text-center">Edita la configuración de tu cuenta y cambia la contraseña aquí.</h4>
                    <div>
                        <hr> 
                    </div>
                    <form id="frm_edit_pass" method="POST">
                      <div class="form-group">
                        <label class="text-left">Contraseña</label>
                        <input type="password" class="form-control" name="pass_actual" placeholder="Escribe la contraseña actual" required>
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control" name="pass_new" id="pass_new" placeholder="Escribe la contraseña nueva" required>
                        <span class="help-block" id="helpPass"></span>
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control" name="pass_new" id="pass_new_confirm" placeholder="Escribe la contraseña otra vez" required>
                        <span class="help-block" id="helpPassConfirm"></span>
                      </div>
                      <div class="form-group text-center">
                        <button type="submit" class="btn btn-danger">Cambiar contraseña</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
            </div>
            <!-- /.box-footer-->
          </div><!-- .box -->
        </div>
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
</div>



<?php include '../layouts/footer.php'; ?>	
<script src="<?= link ?>js/backjs/profile.js"></script>
