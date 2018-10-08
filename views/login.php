<?php require 'layouts/header.php'; ?>
<body>
<div id="loader-wrapper">
  <div id="loader"></div>
  <div class="loader-section section-left"></div>
  <div class="loader-section section-right"></div>
</div>

<div class="wrap_login">
	<div class="form_log">
		<div class="sign_in">
			<div class="card_left">
				<img src="<?=link?>images/logotipos/logo-rincon-blanco-horizontal.png">
				<h3>Cotizador RM</h3>
				<small>Registra tus cotizaciones</small>
			</div>
			<div class="card_right">
				<form id="frm_sign" method="POST" class="frm_sign">
					<h3>Iniciar Sesion</h3>
					<div class="form-group">
						<input type="text" class="email" name="usuario" placeholder="Usuario" required>
					</div>
				    
				    <div class="form-group">
				    	<input type="password" class="pwd" name="password" placeholder="Contraseña" required>
				    </div>
				    <div class="form-group">
				    	<button type="submit" class="btn_sign">Iniciar</button>
				    	<small class="forgot_pass" data-toggle="modal" data-target="#forgot_pass">¿Olvidaste tu contraseña?</small>
				    </div>
				</form>
			</div>
		</div>
	</div>	
</div>

<div class="modal fade" id="forgot_pass" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <form method="POST" id="frm_pass" class="frm_pass">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Recuperar Contraseña</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Correo:</label>
            <input type="email" name="email" class="form-control" placeholder="Introduce tu cuenta de correo" required>
          </div>    
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
      </div><!-- /.modal-content -->
    </form>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




  <script src="<?php echo link; ?>js/jquery-3.3.1.min.js"></script>
  <script src="<?php echo link; ?>js/bootstrap.min.js"></script>
  <script src="<?php echo link; ?>js/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo link; ?>js/datatables/dataTables.bootstrap.js"></script>
  <!--botones DataTables--> 
  <script src="<?php echo link; ?>js/datatables/dataTables.buttons.min.js"></script>
  <script src="<?php echo link; ?>js/datatables/buttons.bootstrap.min.js"></script>
  <!--Libreria para exportar Excel-->
  <script src="<?php echo link; ?>js/datatables/jszip.min.js"></script>
  <!--Librerias para exportar PDF-->
  <script src="<?php echo link; ?>js/datatables/pdfmake.min.js"></script>
  <script src="<?php echo link; ?>js/datatables/vfs_fonts.js"></script>
  <!--Librerias para botones de exportación-->
  <script src="<?php echo link; ?>js/datatables/buttons.html5.min.js"></script>

  <script src="<?php echo link; ?>js/bootstrap-select.min.js"></script>
  <!-- AdminLTE -->
  <script src="<?php echo link; ?>js/adminLTE/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="<?php echo link; ?>js/adminLTE/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo link; ?>js/adminLTE/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo link; ?>js/adminLTE/demo.js"></script>
  <script src="<?php echo link; ?>js/moment-locale.min.js"></script>
  <script src="<?php echo link; ?>js/jquery.animateNumber.min.js"></script>
  <script src="<?php echo link; ?>js/sweetalert2.all.js"></script>
  <script src="<?php echo link; ?>bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
  <script src="<?php echo link; ?>js/lang.js"></script>
  <!-- <script src="<?php //echo link; ?>js/main.js"></script> -->
  <script src="<?php echo link; ?>js/backjs/user.js"></script>
  <script>
    $(document).ready(function () {
      $('.sidebar-menu').tree()
    })
    $(window).on('load', function () {
      setTimeout(function () {
        $('body').addClass('loaded');
      }, 500);
    });
  </script>
</body>
</html>