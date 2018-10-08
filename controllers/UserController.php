<?php 

session_start();

date_default_timezone_set('America/Monterrey');
$dominio='/cotizador/';
require_once '../modelos/User.php';
$user = new User();

$data=array();
switch ($_GET['op']) {
	case 'listar':
		$rspta = $user->listar();
		if (!$rspta) {
			echo json_encode([
					"success" => false,
					'msg'=> 'Algo va mal intenta mas tarde',
				]);
		}else{
			while ($reg = $rspta->fetch(PDO::FETCH_OBJ)) {
				$data[]=array(
					"0"=>$reg->id,
		 			"1"=>$reg->nombre,
		 			"2"=>'<img src="'.$dominio.'public/images/avatars/'.$reg->foto.'" class="img-rounded" width="60px" height="60px">',
		 			"3"=>$reg->correo,
		 			"4"=>$reg->telefono,
		 			"5"=>$reg->usuario.' | '.$reg->contrasena,
		 			"6"=>($reg->state==1)?'<p class="label label-primary">Habilitado</p>':
		 				'<p class="label label-danger">Deshabilitado</p>',
		 			"7"=>($reg->state==1)?'<button type="button" class="btn btn-xs btn-warning" onclick="edit('.$reg->id.')"><i class="fa fa-pencil"></i></button> <button type="button" class="btn btn-xs btn-danger" onclick="eliminar('.$reg->id.')"><i class="fa fa-trash"></i></button>':
		 				'<button type="button" class="btn btn-xs btn-warning" onclick="edit('.$reg->id.')"><i class="fa fa-pencil"></i></button> <button type="button" class="btn btn-xs btn-danger" onclick="eliminar('.$reg->id.')"><i class="fa fa-trash"></i></button>',
					"8"=>($reg->state==1)?'<div class="onoffswitch">
							    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="coast_'.$reg->id.'" checked>
							    <label class="onoffswitch-label" for="coast_'.$reg->id.'" data-st="'.$reg->state.'" onclick="onoff_user('.$reg->state.', '.$reg->id.')">
							        <span class="onoffswitch-inner"></span>
							        <span class="onoffswitch-switch"></span>
							    </label>
							</div>':'<div class="onoffswitch">
							    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="coast_'.$reg->id.'">
							    <label class="onoffswitch-label" for="coast_'.$reg->id.'" data-st="'.$reg->state.'" onclick="onoff_user('.$reg->state.', '.$reg->id.')">
							        <span class="onoffswitch-inner"></span>
							        <span class="onoffswitch-switch"></span>
							    </label>
							</div>'
				);
			}
			$results = array(
					"sEcho"=>1, 
					"iTotalRecords"=>count($data), 
					"iTotalDisplayRecords"=>count($data), 
					"aaData"=>$data
			);
			echo json_encode($results);
		}
	break;

	case 'create':

		$nombre=limpiarCadena($_POST['nombre']);
		$apellido=limpiarCadena($_POST['apellido']);
		$correo=validarEmail($_POST['correo']);
		$telefono=limpiarCadena($_POST['telefono']);
		$usuario=$_POST['usuario'];
		$token = bin2hex(openssl_random_pseudo_bytes(128));
		$rol=$_POST['rol'];
		$rspta = $user->store($nombre,$apellido,$correo,$telefono,$usuario,$_FILES['imagen'],$token,$rol);	
		if ($rspta) {
			$response=[
				'success'=>true,
				'msg'=> 'Usuario Registrado',
				'token' =>$token
			];
	 	}else{
	 		$response=[
				'success'=>false,  
				'msg'=> 'Algo va mal, no se pudo registrar al usuario'
			];
	 	}
	 	echo json_encode($response);
	break;
	
	case 'edit':
		$id = $_POST['id'];
		$rspta = $user->edit($id);
		$datos = $rspta->fetch(PDO::FETCH_OBJ);
		echo json_encode($datos);
	break;

	case 'update':
		$nombre=limpiarCadena($_POST['nombre']);
		$apellido=limpiarCadena($_POST['apellido']);
		$correo=validarEmail($_POST['correo']);
		$telefono=limpiarCadena($_POST['telefono']);
		$usuario=$_POST['usuario'];
		$rol=$_POST['rol'];
		$id = $_POST['id'];
		$rspta = $user->update($nombre,$apellido,$correo,$telefono,$usuario,$_FILES['imagen'],$rol,$id);
		if ($rspta) {
			$response=[
				'success'=>true,
				'msg'=> 'Usuario Actualizado',
			];
	 	}else{
	 		$response=[
				'success'=>false,  
				'msg'=> 'Algo va mal intenta mas tarde'
			];
	 	}
	 	echo json_encode($response);
	break;

	case 'deshabilitar':
		$id = $_POST['id'];
		$rspta = $user->unavailable($id);
		if ($rspta) {
			$response=[
				'success'=>true,
				'msg'=> 'Usuario Deshabilitado',
			];
	 	}else{
	 		$response=[
				'success'=>false,  
				'msg'=> 'Algo va mal intenta mas tarde'
			];
	 	}
	 	echo json_encode($response);
	break;

	case 'habilitar':
		$id = $_POST['id'];
		$rspta = $user->available($id);
		if ($rspta) {
			$response=[
				'success'=>true,
				'msg'=> 'Usuario Habilitado',
			];
	 	}else{
	 		$response=[
				'success'=>false,  
				'msg'=> 'Algo va mal intenta mas tarde'
			];
	 	}
	 	echo json_encode($response);
	break;

	case 'delete':
		$id = $_POST['id'];
		$rspta = $user->destroy($id);
		if ($rspta) {
			$response=[
				'success'=>true,
				'msg'=> 'Usuario Eliminado',
			];
	 	}else{
	 		$response=[
				'success'=>false,  
				'msg'=> 'Algo va mal intenta mas tarde'
			];
	 	}
	 	echo json_encode($response);
	break;

	case 'login':
		$us = $_POST['usuario'];
		$password = $_POST['password'];
		$rspta = $user->login($us,$password);
		if ($rspta['success']) {
			$fetch=$rspta['q']->fetch(PDO::FETCH_OBJ);
			$_SESSION['user']=$fetch->usuario;
			$_SESSION['foto'] = $fetch->foto;
			$_SESSION['email'] = $fetch->correo;
			$_SESSION['name']=$fetch->nombre.' '.$fetch->apellidos;
			$_SESSION['iduser']=$fetch->id;
			$_SESSION['rol']=$fetch->rol;
			$response['exito'] = true;
		}else{
			$response['exito'] = false;
			$response['msg'] = $rspta['msg'];
		}

		echo json_encode($response);
	break;

	case 'reset-password':
	   $rspta =$user->getTokenUser($_POST['email']);
	   if ($rspta['success']) {
	   	   $d_user = $rspta['q']->fetch(PDO::FETCH_OBJ);

	   	   require '../views/mail/PHPMailerAutoload.php';
		   $mail = new PHPMailer;

		   //$mail->SMTPDebug = 3;                               // Enable verbose debug output
		   $correo = $d_user->correo;
		   $correo2 = "jesus.edu2122@gmail.com";
		   $correo3 = "karely.olmos@rincondelmontero.com";
		   $remitente = 'cotizaciones@cotizador.com';
		   $nombre = 'Rincon del Montero';

		   $mail->IsSMTP();     
		   $mail->SMTPDebug  = 0;                     // Set mailer to use SMTP
		   $mail->Host = 'cotizador.rincondelmontero.com';  // Specify main and backup SMTP servers
		   $mail->SMTPAuth = true;                               // Enable SMTP authentication
		   $mail->Username = 'cotizaciones@rincondelmontero.com';                 // SMTP username
		   $mail->Password = 'RMC2018*';                           // SMTP password
		   $mail->Port = 465;                                    // TCP port to connect to
		   $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted

		   $mail->SetFrom($remitente, $nombre);
		   $mail->addAddress($correo2);
		   $mail->addAddress($correo);
		   $mail->addAddress($correo3);
		   // // $mail->addAddress($correo4);
		   // $archivo = 'Cotizacion_RM.pdf';
		   // $mail->AddAttachment($archivo_ruta,$archivo);
		   // $mail->addAddress($correo);

		   $mail->IsHTML(true);
		   $mail->Subject = utf8_decode('Restablecer contraseña');
		   $cuerpo='
		        <!DOCTYPE html>
		        <html lang="es">
		        <head>
		          <meta charset="UTF-8">
		          <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		          <style type="text/css">
		              *,body{
		                font-family: Open Sans, sans-serif;
		              }
		              .container{
		                  width: 100%;
		                  max-width: 1500px;
		                  height: 420px;
		                  margin: 20px auto;
		                  padding-top:20px;
		                  background: #EDECE6;
		              }
		              .logo{
		                  width: 100%;
		                  display: block;
		                  margin: 0px auto;
		                  border-bottom:2px solid #EDECE6;
		              }
		              .logo img{
		                  width: 100%;
		                  max-width: 300px;
		                  display: block;
		                  margin: 5px auto;
		                  display: block;
		              }
		              .cabecera{
		              	  width:100%;
		              	  max-width:550px;
		              	  margin:0 auto;
		                  background: #fff;
		                  height: auto;
		                  padding: 10px 35px;
		                  border-top:4px solid #6E1A52;
		                  position: relative;
		              }
		              .embed_img{
		                  width: 100%;
		                  position: absolute;
		                  bottom: -180px;
		                  left: 0;
		                  text-align: center;
		              }
		              .embed_img img{
		                  width: 100%;
		                  max-width: 400px;
		                  height: 250px;
		                  margin: 0 auto;
		                  display: block;
		                  box-shadow: 1px 0px 10px 4px rgba(0,0,0,.6);
		              }
		              p{
		                  width: 100%;
		                  margin: 20px auto;
		                  color: #7F6F7A;
		                  font-size: 16px;
		              }
		              a{
		              	font-size: 16px;
		              	color:#7AB0E9;
		              	cursor:pointer;
		              }
		              a:-webkit-any-link {
						 color: -webkit-link;
						 cursor: pointer;
						 text-decoration: underline;
					   }
		          </style>
		          </head>
		        <body>
		            <div class="container">
		                  <div class="cabecera">
		                      <div class="logo">
		                          <img src="http://cotizador.rincondelmontero.com/images/logotipos/logo-rincon-blanco-horizontal.png" alt="Logotipo" class="logotipo">
		                      </div>
		                      '.utf8_decode('<p>Hola '.$d_user->nombre.' '.$d_user->apellidos.':</p>

							  <p>Hemos recibido una solicitud de restablecimiento de contraseña de tu cuenta.</p>

							  <p>Haz clic en el botón que aparece a continuación para cambiar tu contraseña.</p>
		                      <br>
		                      <a href="http://localhost/cotizador_servidor/views/reset-password.php?authuser='.$d_user->state.'&k='.$d_user->token.'" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable" style="">Cambia Tu Contraseña </a>').'
		                  </div>  
		            </div>
		        </body>
		        </html> ';

		   $mail->Body = $cuerpo; 
		   // Definimos AltBody por si el destinatario (quien recive) del correo no admite email con formato html, es decir recibirá este mensaje si el servidor de correo al que enviamos el mensaje no puede admitir html
		   $mail->AltBody = $cuerpo;

		   if(!$mail->send()) {
		      $datos['success'] = false;
		      $datos['msg'] = "<p>EL correo de confirmacion no se pudo enviar intenta nuevamente</p>";
		   } else {
		      $datos['success'] = true;
		      $datos['msg'] = "<p>Te hemos enviado un correo a tu cuenta verificalo y cambia tu contraseña</p>";
		       
		   }
	   }else{
	   	   $datos['success']=false;
	   	   $datos['msg']=$rspta['msg'];
	   }

	   echo json_encode($datos);	
	break;

	case 'reset-password-update':
		$token = $_POST['token_user'];
		$rspta = $user->verifyToken($token);
		if ($rspta['success']) {
			$pass_new = $_POST['pass_new_reset'];
			$token_new = bin2hex(openssl_random_pseudo_bytes(128));
			$u = $rspta['q']->fetch(PDO::FETCH_OBJ);
			$rsptaUPD = $user->updPassReset($pass_new,$token_new,$u->id);
			if ($rsptaUPD['success']) {
				$response=[
					'success'=>true,  
					'msg'=> "Tu contraseña se ha cambiado con exito te redireccionaremos al inicio de sesion"
				];
			}else{
				$response=[
					'success'=>false,  
					'msg'=> "No hemos podido restablecer tu contraseña intenta mas tarde"
				];
			}	
		}else{
	 		$response=[
				'success'=>false,  
				'msg'=> $rspta['msg']
			];
	 	}
		echo json_encode($response);
	break;


}

?>