<?php require '../layouts/auth.php'; ?>
<?php require '../layouts/header.php'; ?>
<?php require '../layouts/barra.php'; ?>
<?php require '../layouts/navegacion.php'; ?>
<?php require '../../config/conexion.php'; ?>
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
          <?php
            $token = $_GET['tkn'];
            $sqlInner = "SELECT * FROM cotizaciones c  WHERE c.token ='$token' && c.id= ".$_GET['id']." && id_usuario = ".$_SESSION['iduser']." ";
            $resIn = $con->prepare($sqlInner);
            $resIn->execute();
            $filas = $resIn->rowCount();
            if ($filas>0) {
              $cot = $resIn->fetch(PDO::FETCH_OBJ);
              if($cot->file==null){
          ?>
              <div class="jumbotron text-center">
                  <h2>ERROR</h2>
                  <h2>No has enviado aun la cotizacion no puedes confirmarla: ¡HAZ BIEN TU TRABAJO!</h2>
                </div>
                <div class="container text-center">
                  <img src="../../public/images/no-access.png" class="img-thumbnail center-block">
              </div>
          <?php } else { ?>
              <?php if($cot->orden!==null && $cot->orden!==""){?>
                  <div class="jumbotron text-center">
                      <h2>Excelente!</h2>
                      <h2>Ya haz generado la Orden de Servicio</h2>
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#view_pdf">Ver Orden</button>
                    </div>
                    <div class="modal fade view_pdf" id="view_pdf" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title"> <button type="button" onclick="enviar_correo_orden(<?=$cot->id?>)" class="btn btn-success">Enviar Correo</button></h4>
                              </div>
                              <div class="modal-body">
                                  <embed src="../../orden_servicio/<?=$cot->orden?>" id="show_pdf" width="100%" height="550px" type="">
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                              </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                      </div><!-- /.modal -->
              <?php }else{?>
                  <h1> Clave: C-RM-<?php echo $_GET['id']; ?></h1>
                  <form action="try_data.php" method="post" id="frm_order">
                    <div class="box box-info">
                      <div class="box-header with-border">
                          <h2 class="box-title">Generar Orden de Servicio <button type="submit" class="btn btn-primary">Generar</button>                       </h2>
                      </div>
                      <div class="box-body">
                        <input type="hidden" id="id_empresa" name="id_empresa" value="<?= $_GET['id'] ?>">
                        <input type="hidden" id="token" name="token" value="<?= $_GET['tkn'] ?>">
                        <div class="form-group col-lg-3">
                          <label for="">Hora de llegada:</label>
                          <input type="time" name="hour_came" class="form-control" required>
                        </div>
                        <div class="form-group col-lg-3">
                          <label for="">Hora de Salida:</label>
                          <input type="time" name="hour_out" class="form-control" required>
                        </div>
                        <div class="form-group col-lg-6">
                          <label for="" class="h3">Selecciona la areas involucradas:</label>
                          <label class="center-block" for="a_recepction"><input type="checkbox" name="areas[]" value="reception" id="a_recepction"> Recepcion</label>
                          <label class="center-block" for="a_food"><input type="checkbox" name="areas[]" value="food" id="a_food"> Alimentos y Bebidas</label>
                          <label class="center-block" for="a_support"><input type="checkbox" name="areas[]" value="support" id="a_support"> Mantenimiento</label>
                          <label class="center-block" for="a_buy"><input type="checkbox" name="areas[]" value="buy" id="a_buy"> Compras</label>
                          <label class="center-block" for="a_mrs_keys"><input type="checkbox" name="areas[]" value="mrs_keys" id="a_mrs_keys"> Ama de Llaves</label>
                          <label class="center-block" for="a_golf"><input type="checkbox" name="areas[]" value="golf" id="a_golf"> Campo de Golf</label>
                          <label class="center-block" for="a_garden"><input type="checkbox" name="areas[]" value="garden" id="a_garden"> Jardineria</label>
                          <label class="center-block" for="a_sell"><input type="checkbox" name="areas[]" value="sell" id="a_sell"> Ventas</label>
                          <button type="button" onclick="addAreas()" class="btn btn-primary">Capturar</button>  
                        </div>
                        <div class="clearfix"></div>
                      </div>
                    </div>
                                      
                    <div id="areas_selected" class="areas_selected">                
                    </div>                                
                  </form>
                  
              <?php } ?>  
          <?php } ?>                                  
          <?php } else { ?>
                <div class="jumbotron text-center">
                  <h2>ERROR</h2>
                  <h2>No cuentas con permisos para realizar esta orden de servicio</h2>
                </div>
                <div class="container text-center">
                  <img src="../../public/images/no-access.png" class="img-thumbnail center-block">
                </div>
          <?php }  ?>                               
        <?php     
              $sql = "SELECT * FROM ayb";
              $result = ejecutarConsulta($sql);
              while ($f = $result->fetch(PDO::FETCH_OBJ)) {
                  $arreglo = json_decode($f->notas, true);
                  
              }
          ?>    
    </section>
    <!-- /.content -->
</div>



<?php require '../layouts/footer.php'; ?>	
<script src="<?= link ?>js/frontjs/order.js"></script>

