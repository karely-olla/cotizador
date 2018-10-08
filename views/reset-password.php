<?php require 'layouts/header.php'; ?>

<body>
<?php if (isset($_GET['k'])):  
        $token = $_GET['k'];
      endif;
?>
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
				<small>Registra tu Contraseña</small>
			</div>
			<div class="card_right">
				<form id="frm_resetpass_upd" method="POST" class="frm_sign">
					<h3>Crea una nueva contraseña</h3>
          <input type="hidden" name="token_user" value="<?=$token?>">
					<div class="form-group">
						<input type="password" class="email" id="pass_new_reset" name="pass_new_reset" placeholder="Nueva Contraseña" required>
            <span class="help-block" id="helpPass"></span>
					</div>
				    
			    <div class="form-group">
			    	<input type="password" class="pwd" id="pass_new_confirm"  placeholder="Confirmar Contraseña" required>
            <span class="help-block" id="helpPassConfirm"></span>
			    </div>
			    <div class="form-group">
			    	<button type="submit" class="btn_sign">Cambiar</button>
			    	<a href="http://localhost/cotizador_servidor/views/login.php">
              <small class="forgot_pass">
                Cancelar accion
              </small>
            </a>
			    </div>
				</form>
			</div>
		</div>
	</div>	
</div>

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