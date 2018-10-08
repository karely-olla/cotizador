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
          <h3 class="box-title">Lista de Cotizaciones de Servicios</h3>

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
                  <table class="table table-condensed table-hover table-striped" id="tbl_cots_servs">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Folio</th>
                        <th>Ejecutivo</th>
                        <th>Empresa/Grupo</th>
                        <th>Correo</th>
                        <th>Monto</th>
                        <th>Fecha Entrada</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                        <th>Orden</th>
                        <th>On/Off</th>
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
<div class="modal fade cotizacion_info" id="cotizacion_info" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Cotizacion</h4>
        </div>
        <div class="modal-body">
          <ul class="list-group">
            <li class="list-group-item">
              <span class="badge label label-warning" id="name_coord"></span>
              Coordinador:
            </li>
            <li class="list-group-item">
              <span class="badge label label-warning" id="from"></span>
              Procedencia:
            </li>
            <li class="list-group-item">
              <span class="badge label label-warning" id="phone"></span>
              Telefono:
            </li>
            <li class="list-group-item">
              <span class="badge label label-warning" id="nights"></span>
              Noches:
            </li>
            <li class="list-group-item">
              <span class="badge label label-warning" id="days"></span>
              Dias:
            </li>
            <li class="list-group-item">
              <span class="pull-right"><a id="btn_reporte_interno" target="_blank" class="btn btn-danger btn-xs">Ver Reporte</a></span>
              Reporte Interno:
            </li>
            <li class="list-group-item">
              <span class="pull-right"><a id="btn_enviar_cotizacion"  class="btn btn-primary btn-xs">Enviar Cotizacion</a></span>
              Enviar:
            </li>
          </ul>
          <div class="template_info" id="template_info">
            
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <form method="POST" id="frm_add_extras">
                <h3 class="title-cat">Agregar Servicios o Productos Extras</h3>
                <input type="hidden" name="id" id="id">
                <div class="form-group">
                  <label for="">Elige el dia</label>
                  <select name="dia" id="dia" class="form-control selectpicker" data-live-search="true" title="Elige el dia" required></select>
                </div>
                <div class="form-group">
                  <label for="">Servicio o Producto:</label>
                  <input type="text" name="servicio" class="form-control" required placeholder="Servicio o Producto">
                </div>
                <div class="form-group">
                  <label for="">Costo:</label>
                  <input type="number" name="costo" min="0" class="form-control" required placeholder="Costo">
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Agregar</button>
            </form>
          </div>
          <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 extras_services">
            <h3 class="title-cat">Extras</h3>
             <table class="table table-condensed table-hover table-striped" id="tbl_extras">
                <thead>
                  <tr>
                    <th>N°</th>
                    <th>Dia de Consumo</th>
                    <th>Servicio</th>
                    <th>Costo</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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

<div class="modal fade" id="create" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form method="POST" id="frm_create">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Nuevo servicio</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Categoria</label>
            <select name="categoria" class="form-control" id="categoria" required>
              <option>Selecciona</option>
              <option value="Alimentos">Alimentos</option>
              <option value="Servicios">Servicios</option>
              <option value="Precios Generles">Precios Generles</option>
            </select>
          </div>
          <div class="form-group">
            <label>Servicio</label>
            <input type="text" name="servicio" class="form-control" placeholder="Servicio" required>
          </div>
          <div class="form-group">
            <label>Precio</label>
            <input type="number" name="precio" class="form-control"  required>
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

<div class="modal fade" id="edit" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <form method="POST" id="frm_edit_cotizacion">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          <div class="template_edit" id="template_edit">
            <input type="hidden" name="tipo" value="Service">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 formulario" id="formulario">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="amount_v">
                      <div class="amn">
                        $ <span>0</span>
                      </div>
                      <p>Monto</p>
                    </div>
                  </div>
                  <input type="hidden" class="form-control"  name="id" id="id_fila">
                  <input type="hidden"  name="total" class="form-control amount" id="total_c">
              
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                      <label>Empresa:</label> 
                      <input type="text" class="form-control" name="empresa" id="empresa"  placeholder="Nombre de la empresa" required />
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                      <label>Coordinador:</label> 
                      <input type="text" class="form-control" name="coordinador" id="coordinador" placeholder="Coordinador de Grupo" required />
                    </div>
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
                      <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono" required />
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                      <label>E mail:</label> 
                      <input type="email" class="form-control" onblur="validEmail(this.value,this)" name="email" id="email" placeholder="Direccion de Correo" required />
                      <span id="helpEmail" class="help-block"></span>
                    </div>
                  </div>
                  <div class="rooms">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 dates">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <div class="form-group">
                              <label>Personas:</label>
                              <input type="number" name="n_int" id="n_int" onblur="validarInt(this.value)" onkeyup="validarInt(this.value)" min="10" max="400" class="form-control" placeholder="Numero de Personas" required>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                          <div class="form-group">
                            <label>Fecha de Entrada:</label>
                            <input type="date" name="date_start" id="date_start" onchange="verifyDate(this.value)" class="form-control" placeholder="Entrada" required>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                          <div class="form-group">
                            <label>Fecha de Salida:</label>
                            <input type="date" name="date_end" id="date_end" onchange="calcular(this.value)" class="form-control" placeholder="Salida" required>
                          </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                          <div class="form-group nights">
                            <label>Noches:</label>
                            <input type="text" name="noches" readonly id="noches" class="form-control" placeholder="Noches" required>
                          </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                          <div class="form-group">
                            <label>Dias:</label>
                            <input type="text" name="dias" readonly id="dias" class="form-control" placeholder="Dias" required>
                          </div>
                        </div>
                      </div>
                  </div>               
              </div>       
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 days_try" id="days_try">    
              </div>
              <div class="clearfix"></div>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Actualizar <i class="fa fa-save"></i></button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div><!-- /.modal-content -->
    </form>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- tabla para ver los servicios y agregarlos -->
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

<!-- Extras -->
<div class="modal fade" id="modal_edit_extras" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
     <form method="POST" id="frm_upd_extras"> 
      <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <h4 class="modal-title">Editar Extras</h4>
         </div>
         <div class="modal-body">
             <input type="hidden" name="id" id="id">
            <div class="form-group">
              <label for="">Elige el dia</label>
              <select name="dia" id="dia" class="form-control selectpicker" data-live-search="true" title="Elige el dia" required></select>
            </div>
            <div class="form-group">
              <label for="">Servicio o Producto:</label>
              <input type="text" name="servicio" id="servicio" class="form-control" required placeholder="Servicio o Producto">
            </div>
            <div class="form-group">
              <label for="">Costo:</label>
              <input type="number" name="costo" id="costo" min="0" class="form-control" required placeholder="Costo">
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

<!-- Confirmacion -->
<div class="modal fade modal_confirm_cot" id="modal_confirm_cot" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
     <form method="POST" id="frm_confirm_cot"> 
      <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <h4 class="modal-title">Confirmar cotizacion</h4>
         </div>
         <div class="modal-body">
            <input type="hidden" name="id" id="id">
            <div class="form-group">
              <label for="">Sube la Orden de Servicio</label>
              <label for="orden" class="file-label btn btn-primary btn-block">
                Elige el archivo
                <input type="file" id="orden" onchange="mostrarFilename(this)" name="orden"  required>
              </label>
              <div class="name_file text-center"></div>
            </div>
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


<?php include '../layouts/footer.php'; ?>	
<script src="<?= link ?>js/frontjs/services.js"></script>
<script src="<?= link ?>js/backjs/extra.js"></script>
<script src="<?= link ?>js/backjs/cotizacion-service.js"></script>

