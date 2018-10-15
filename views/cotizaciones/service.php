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
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title"></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Cerrar/Abrir">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
        	<div class="panel panel-warning">
    			  <div class="panel-heading">
                <h3 class="col-lg-8 col-md-8 col-sm-8 col-xs-12">Generar Cotizaciones (Servicios) <i class="fa fa-coffee"></i></h3>
                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="input-group input-search">
                  <input type="text" id="buscar" onkeyup="buscar(event,this.value,'Service')" placeholder="Buscar Grupos" class="form-control">
                  <div class="input-group-addon btn-group-search" onclick="buscar(event,document.getElementById('buscar').value,'Service')"><i class="fa fa-search"></i></div>
                  <ul class="c_quick-search__results" hidden>                     
                  </ul>
                </div>
              </div>
              <div class="clearfix"></div>
    			  </div>
    			  <div class="panel-body">
    		        <form method="POST" name="frm_servicios" id="frm_servicios" class="frm_cotizador">
                  <input type="hidden" name="tipo" value="Service">
                  <input type="hidden" name="clave" id="clave_grupo">
                    <div class="container" id="container">
                        <div class="amount_v">
                          <div class="amn">
                            $ <span>0</span>
                          </div>
                          <p>Monto</p>
                        </div>
                        <input type="hidden"  name="total" class="form-control amount" id="total_c" readonly>
                        <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                              <label>Empresa:</label> 
                              <input type="text" class="form-control" name="empresa"  placeholder="Nombre de la empresa" required />
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                              <label>Coordinador:</label> 
                              <input type="text" class="form-control" name="coordinador" placeholder="Coordinador de Grupo" required />
                            </div><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"></div>
                          </div>
                          <div class="form-group">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              <label for="">Estado:</label>
                              <select name="estado" class="form-control selectpicker" data-live-search="true" title="Elige el estado" id="jmr_contacto_estado" required></select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              <label for="">Municipio:</label>
                              <select name="municipio" class="form-control selectpicker" data-live-search="true" title="Elige el municipio" id="jmr_contacto_municipio" required></select>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                              <label>Telefono:</label>
                              <input type="text" onblur="validLengthPhone(this)" class="form-control"  min="0" onkeypress="return validPhone(event)" name="telefono" placeholder="Telefono" required />
                              <span id="helpPhone" class="help-block"></span>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                              <label>E mail:</label> 
                              <input type="email" class="form-control" onblur="validEmail(this.value,this)" name="email" placeholder="Direccion de Correo" required />
                              <span id="helpEmail" class="help-block"></span>
                            </div>
                          </div>                          
                        </div>
                        <div class="rooms">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 dates">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              <div class="form-group">
                                <label>Personas:</label>
                                <input type="number" name="n_int" id="n_int" onblur="validarInt(this.value)" onkeyup="validarInt(this.value)" min="10" max="400" class="form-control" placeholder="Numero de Personas" required>
                              </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              <div class="form-group">
                                <label>Dias:</label>
                                <input type="text" name="dias" onchange="calc_subtotal_one(this)" readonly id="dias" class="form-control" placeholder="Dias" required>
                              </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              <div class="form-group">
                                <label>Fecha de Entrada:</label>
                                <input type="date" name="date_start" id="date_start" onchange="verifyDate(this.value)" class="form-control" placeholder="Entrada" required>
                              </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              <div class="form-group">
                                <label>Fecha de Salida:</label>
                                <input type="date" name="date_end" disabled id="date_end" onchange="calcular(this.value)" class="form-control" placeholder="Salida" required>
                              </div>
                            </div>
                          </div>
                        </div>
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 days_try" id="days_try">
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <div class="text-center btn-reg" hidden>
                        <button type="submit" class="btn btn-warning">Registrar Cotizacion</button>
                    </div>
                </form>
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

<div class="modal fade tbl_servicios" id="servicios_table" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Servicios</h4>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
              <table class="table table-condensed table-hover table-striped" id="tbl_servicios">
                  <thead>
                    <tr>
                      <th>N°</th>
                      <th>Categoria</th>
                      <th>Servicio</th>
                      <th>Costo</th>
                      <th>Costo C/IVA</th>
                      <th>Estado</th>
                      <th>Tipo</th>
                      <th>Opciones</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
              </table>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php include '../layouts/footer.php'; ?>	
<script src="<?= link ?>js/frontjs/services.js"></script>