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
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Generar Orden de Servicio</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Cerrar/Abrir">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <h1>Clave: <?php echo $_GET['clave']; ?></h1>
          <form method="post" id="frm_order">
            <div class="form-group col-lg-3">
              <label for="">Hora de llegada:</label>
              <input type="time" class="form-control" required>
            </div>
            <div class="form-group col-lg-3">
              <label for="">Hora de Salida:</label>
              <input type="time" class="form-control" required>
            </div>
            <div class="form-group col-lg-6">
              <label for="" class="h3">Selecciona la areas involucradas:</label>
              <label class="center-block" for="recepction"><input type="checkbox" name="areas[]" value="reception" id="recepction"> Recepcion</label>
              <label class="center-block" for="food"><input type="checkbox" name="areas[]" value="food" id="food"> Alimentos y Bebidas</label>
              <label class="center-block" for="support"><input type="checkbox" name="areas[]" value="support" id="support"> Mantenimiento</label>
              <label class="center-block" for="buy"><input type="checkbox" name="areas[]" value="buy" id="buy"> Compras</label>
              <label class="center-block" for="mrs_keys"><input type="checkbox" name="areas[]" value="mrs_keys" id="mrs_keys"> Ama de Llaves</label>
              <label class="center-block" for="golf"><input type="checkbox" name="areas[]" value="golf" id="golf"> Campo de Golf</label>
              <label class="center-block" for="garden"><input type="checkbox" name="areas[]" value="garden" id="garden"> Jardineria</label>
              <label class="center-block" for="sell"><input type="checkbox" name="areas[]" value="sell" id="sell"> Ventas</label>
              <button type="button" onclick="addAreas()" class="btn btn-primary">Capturar</button>  
            </div>
            <div id="areas_selected">
              
            </div>
          </form>            
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



<?php require '../layouts/footer.php'; ?>	
<script src="<?= link ?>js/frontjs/order.js"></script>

