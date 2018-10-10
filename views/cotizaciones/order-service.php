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
          <h1>Clave: <?php echo $_GET['id']; ?></h1>
          <form action="try_data.php" method="post" id="frm_order">
            <input type="hidden" id="id_empresa" name="id_empresa" value="<?=$_GET['id']?>">
            <div class="form-group col-lg-3">
              <label for="">Hora de llegada:</label>
              <input type="time" name="hour_came" class="form-control" required>
            </div>
            <div class="form-group col-lg-3">
              <label for="">Hora de Salida:</label>
              <input type="time" name="hour_exit" class="form-control" required>
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

            <button type="submit" class="btn btn-primary">Enviar</button>
          </form>   
        <?php     
          try {
            $con = new PDO('mysql:host=localhost; dbname=cotizador; charset=utf8', 'root', '');
                // $con = new PDO('mysql:host=localhost; dbname=db_cotizador_rm; charset=utf8', 'root', '');
              } catch (PDOException $e) {
                  echo "ERROR " . $e->getMessage();
                  die();
              }
              if (!function_exists('ejecutarConsulta')) {
                  function ejecutarConsulta($sql)
                  {
                      global $con;
                      $query = $con->prepare($sql);
                      $query->execute();
                      return $query;
                  }

                  function ejecutarConsultaSimpleFila($sql)
                  {
                      global $con;
                      $query = $con->query($sql);
                      $row = $query->fetch(PDO::FETCH_OBJ);
                      return $row;
                  }

                  function retornarID($sql)
                  {
                      global $con;
                      $query = $con->prepare($sql);
                      $query->execute();
                      $id = $con->lastInsertId();
                      return $id;
                  }

                  function limpiarCadena($str)
                  {
                      $str = ucwords(mb_strtolower($str, 'UTF-8'));
                      $str_simple = str_replace("'", "", $str);
                      $str_doble = str_replace('"', "", $str_simple);
                      $str_final = htmlspecialchars($str_doble);
                      return trim(filter_var($str_final, FILTER_SANITIZE_STRING));
                  }

                  function validarEmail($email)
                  {
                      $str_final = htmlspecialchars($email);
                      return trim(filter_var($str_final, FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_EMAIL));
                  }
              }

              $sql = "SELECT * FROM ayb";
              $result = ejecutarConsulta($sql);
              while ($f = $result->fetch(PDO::FETCH_OBJ)) {
                  $arreglo = json_decode($f->notas, true);
                  var_dump( $arreglo);
              }
?>
    
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

