<?php require '../layouts/auth.php'; ?>
<?php require '../layouts/header.php'; ?>
<?php require '../layouts/barra.php'; ?>
<?php require '../layouts/navegacion.php'; ?>

<?php require_once '../../config/conexion.php';?>
<?php
  $sql = "SELECT *, (SELECT COUNT(*) FROM cotizaciones WHERE id_usuario=u.id && state = 1) as confirmadas, 
      (SELECT COUNT(*) FROM cotizaciones WHERE id_usuario=u.id && state = 0) as pendientes, (SELECT COUNT(*) FROM cotizaciones WHERE id_usuario=u.id && state = 2) as anuladas, (SELECT COUNT(*) FROM cotizaciones WHERE id_usuario=u.id && state = 3) as vencidas
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
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Perfil</h3>
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
                          <img src="<?=link?>images/avatars/<?=$datos->foto?>" class="img-circle">
                          <h4 class="card-title m-t-10"><?=$datos->nombre." ".$datos->apellidos?></h4>
                          <h6 class="card-subtitle">Rol: <?=$datos->rol?></h6>
                          <div>
                              <hr> 
                          </div>
                          <h5 class="center-block">cotizaciones</h5>
                          <div class="row text-center justify-content-md-center">
                              <div class="col-lg-6 col-md-6 col-xs-6 text-danger">                                              
                                  <?=$datos->anuladas?>
                                  <p>Anuladas <i class="fa fa-times"></i></p>                                 
                              </div>
                              <div class="col-lg-6 col-md-6 col-xs-6 text-muted">                                              
                                  <?=$datos->vencidas?>
                                  <p>Vencidas <i class="fa fa-calendar-times-o"></i></p>                                 
                              </div>
                              <div class="col-lg-6 col-md-6 col-xs-6 text-warning">                                              
                                  <?=$datos->pendientes?>
                                  <p>Pendientes <i class="fa fa-clock-o"></i></p>                                 
                              </div>
                              <div class="col-lg-6 col-md-6 col-xs-6 text-success">                               
                                  <?=$datos->confirmadas?>
                                  <p>Confirmadas <i class="fa fa-check"></i></p>                                  
                              </div>
                          </div>
                      </center>
                  </div>
                  <div class="card-body"> 
                      <small class="text-muted">Direccion de Correo</small>
                      <h5><?=$datos->correo?></h5> 
                      <small class="text-muted">Celular</small>
                      <h5><?=$datos->telefono?></h5>
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
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Estadisticas</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                          title="Cerrar/Abrir">
                    <i class="fa fa-minus"></i></button>
                </div>
              </div>
              <div class="box-body">
                  <select name="perMonth" id="perMonth" onchange="show_PerMonth(this.value)" class="form-control selectpicker" title="Elige el mes"></select>
                  <h3 class="not_found text-center"></h3>
                  <div class="show_estadistics">                    
                  </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
              </div>
              <!-- /.box-footer-->
            </div>
        </div>
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
</div>



<?php include '../layouts/footer.php'; ?>	
<script src="<?= link; ?>js/backjs/profile.js"></script>
