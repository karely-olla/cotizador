<?php
    session_start();
    $error = "";
    if (array_key_exists("Logout",$_GET)){
        // Si viene de la pagina sesionIniciada
        session_unset();
        setcookie("id","",time()-60*60);
        $_COOKIE["id"]=""; //ExtraRefresco
    }
   if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        include ("connection.php");

         $uni = $_POST['uni'];
         if ($_POST['uni'] === "") {
            $error .= "<p class='text-danger laed'>Aun No Seleccionas La Universidad</p>";
         }

         $email = $_POST['email'];
         $nombre = $_POST['nombre'];
         $tel = $_POST['tel'];
         $user = $_POST['user'];


        $cantidad = $_POST['cant'];
        $telefono = $_POST['tel'];
        $hotel = $_POST['hotel'];
        if ($_POST['hotel'] === "") {
            $error .= "<p class='text-danger laed'>Aun No Seleccionas El Hotel Reservado Previamente</p>";
        }

        $password = $_POST['password'];
        if ($password !== 'Utpreg17#') {
        	$error .= "<p class='text-danger laed'>La Contraseña No Es La Correcta Para Completar El Registro</p>";
        }
        if ($error!=""){
            $error = "<div class='text-danger laed'> Hubo Algun(os) Error(es) En El Formulario: ".$error."</div>";
        }
        else
        {
            if ($_POST['registro']=='1')
            {


         if (trim($_POST['email']) == '' || trim($_POST['nombre']) == '' ||  trim($_POST['tel'] )== '' || trim($_POST['user']) == '') {
             $error .= "<p class='text-danger laed'>El/Los Campo(s) Son Obligatorio(s)</p>";
         }else{
                // Vemos si la direccion de email está ya registrada o no
                $query = "SELECT id FROM universidades WHERE username='".mysqli_real_escape_string($enlace,filter_var(strtolower($_POST['user'])))."' LIMIT 1";
                $result = mysqli_query($enlace,$query);

                if (mysqli_num_rows($result)>0){
                    $error = "El Nombre De Usuario Ya Existe.";
                }else{

                $query = "SELECT id FROM universidades WHERE universidad='".mysqli_real_escape_string($enlace,$_POST['uni'])."' LIMIT 1";
                $result = mysqli_query($enlace,$query);

                if (mysqli_num_rows($result)>0){
                    $error = "Esta UT ya ha sido Registrada.";
                }
                else
                {
                    //'".mysqli_real_escape_string($enlace,filter_var(strtolower($_POST['contingentes'])))."',
                    //'".mysqli_real_escape_string($enlace,$_POST['password'])."',
                     if (!is_numeric($telefono)) {
					      $error .= "<p class='text-danger laed'>El Campo Del Telefono Solo Acepta Numeros</p>";

                     	  }else{
                     		 $password = $_POST['password'];
				         if ($password !== 'Utpreg17#') {
		                  		$error .= "<p class='text-danger laed'>La Contraseña No Es La Correcta Para Completar El Registro</p>";		                 
		                    
		                  }else{
		                  		  $query="INSERT INTO universidades (nombre,username,universidad,hotel,email,telefono,total_cont) VALUES(
		                    '".mysqli_real_escape_string($enlace,filter_var(strtolower($_POST['nombre'])))."',
		                    '".mysqli_real_escape_string($enlace,filter_var(strtolower($_POST['user'])))."',
		                    '".mysqli_real_escape_string($enlace,filter_var(strtolower($_POST['uni'])))."',
		                    '".mysqli_real_escape_string($enlace,filter_var(strtolower($_POST['hotel'])))."',
		                    '".mysqli_real_escape_string($enlace,filter_var(strtolower($_POST['email']), FILTER_VALIDATE_EMAIL))."',
		                    '".mysqli_real_escape_string($enlace,$_POST['tel'])."',
		                    '".$_POST['total']."')";

		                    for($i = 0; $i < count($_POST['dis']); ++$i)
		                    {
		                        $sql = "INSERT INTO deportes (participa_en, deporte)  values('$uni','".$_POST['dis'][$i]."')" ;
		                        mysqli_query($enlace,$sql);
		                    }
		                   
		                    for ($i=0; $i < count($_POST['cant']) ; $i++) { 
		                    	 if ($_POST['cant'] != '0' || $_POST['cant'] != '') {
		                    	
			                    $sql = "INSERT INTO cantidades (cantidad,deporte,ut) values('".$_POST['cant'][$i]."','".$_POST['dis'][$i]."','$uni')";
		                         mysqli_query($enlace,$sql);
		                        }
		                    }
                            for ($i=0; $i < count($_POST['cantv']) ; $i++) { 
                                $sql = "INSERT INTO vehiculos (cantidad,tipo,uts) values('".$_POST['cantv'][$i]."','".$_POST['carro'][$i]."','$uni')";
                                 mysqli_query($enlace,$sql);
                            }
		                  }
	                 }

                    if (!mysqli_query($enlace,$query)){
                        $error = "<p>No hemos podido completar el registro, por favor inténtalo de nuevo más tarde</p>";
                    }
                    else
                    {
                        $query="UPDATE universidades SET password='Utpreg17#' WHERE id=".mysqli_insert_id($enlace)." LIMIT 1";
                        if(mysqli_query($enlace,$query)){

                        	$sql = "select * from universidades where universidad ='".mysqli_real_escape_string($enlace,filter_var(strtolower($_POST['uni'])))."'";
                        	$result = mysqli_query($enlace,$sql);
                        	while ($f = mysqli_fetch_array($result)) {
                        		$uni = $f['universidad'];
                        		$encargado = $f['nombre'];
                      			$contin = $f['total_cont'];
                        	}
                        	
                        }

                        $_SESSION['id']=mysqli_insert_id($enlace);
                        
                        $error .= "<p class='text-success laed'>Felicidades EL Registro Se Completo Con EXITO</p><br>
                                    <h3>La Universidad Tecnologica de Parras te da la Bienvenida</h3>";

                        require 'PHPMailerAutoload.php';

                            $mail = new PHPMailer;

                            //$mail->SMTPDebug = 3;                               // Enable verbose debug output
                            $correo = "skrapt.g.p.o._@hotmail.com";
                            $correo2 = "jesus.edu2122@gmail.com";
                            $correo3 = "omedinae@gmail.com";
                            $correo4 = "adriana.vidal@utparras.edu.mx";
                            $correo5 = "claudia.chao@utparras.edu.mx";
                            $correo6 = "kolmos96@gmail.com";
                            $correo7 = "claudiachao69@hotmail.com";
                            $mensaje = "Hay un nuevo registro se registro: '$uni' El nombre del Encargado: $encargado El Total de su contingente es: $contin ";
                            	
                            $nombre = "Jesus Eduardo";
                            $nombre2 = "Oscar Medina";
                            $nombre3 = "Adrian Vidal Rectora";
                            $nombre4 = "Claudia Chao";
                            $nombre5 = "Karely Olmos";

                            $mail->isSMTP();                                      // Set mailer to use SMTP
                            $mail->Host = 'p3plcpnl0526.prod.phx3.secureserver.net';  // Specify main and backup SMTP servers
                            $mail->SMTPAuth = true;                               // Enable SMTP authentication
                            $mail->Username = 'webparras@p3plcpnl0526.prod.phx3.secureserver.net';                 // SMTP username
                            $mail->Password = 'Siteparras0816';                           // SMTP password
                            $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
                            $mail->Port = 465;                                    // TCP port to connect to

                            $mail->setFrom('webparras@p3plcpnl0526.prod.phx3.secureserver.net');
                            $mail->addAddress($correo, $nombre);
                             $mail->addAddress($correo2, $nombre);
                             $mail->addAddress($correo3, $nombre2);  
                         	$mail->addAddress($correo4, $nombre3);   
                         	$mail->addAddress($correo5, $nombre4);  
                            $mail->addAddress($correo6, $nombre5); 
                             $mail->addAddress($correo7, $nombre4);    

                            $mail->Subject = 'Nuevo Registro';
                            $mail->Body    = $mensaje;

                            if(!$mail->send()) {
                                echo 'Error, mensaje no enviado';
                                echo 'Error del mensaje: ' . $mail->ErrorInfo;
                            } else {
                                // $error .= "<p>Te Hemos Enviado Un Correo Con Tu Contraseña</p><br>
                                //         <p>El Correo puede estar en tu correo no deseado</p>";
                                
                            }

                        }
                    }
                }
	       }
        }
        else
        {
                // Comprobamos el inicio de sesion
$query = "SELECT * FROM universidades WHERE universidad='".mysqli_real_escape_string($enlace,filter_var(strtolower($_POST['uni'])))."' && username='".mysqli_real_escape_string($enlace,filter_var(strtolower($_POST['user'])))."'"; //no ponemos el password porque depende del id que todavia no lo se
                
                $result = mysqli_query($enlace,$query);
                $fila = mysqli_fetch_array($result);
                
                if (isset($fila))
                {
                    
                    $passwordHasheada = md5(md5($fila['id']).$_POST['password']);
                    if ($_POST['password'] == $fila['password'])
                    {
                        $_SESSION['id'] = $fila['id'];
                        // if ($_POST['permanecerIniciada']=='1'){
                        //     setcookie("id",$fila['id'],time()+60*60*24*365);
                        // }
                        // header("Location: ./regionales.php");
                    }
                    else
                    {
                        $error = "<p class='text-danger laed'>La contraseña es Incorrecta</p>";
                    }
                    
                }
                else
                {
                    $error = "<p class='text-danger laed'>El usuario o contraseña son Incorrecto</p>";
                }
            }

        }
        if ($_POST['recuperar']=='2'){
                    $query = "SELECT * FROM universidades WHERE email='".mysqli_real_escape_string($enlace,$_POST['email'])."' LIMIT 1";
                $result = mysqli_query($enlace,$query);

                if (mysqli_num_rows($result)>0){
                    while ($f = mysqli_fetch_array($result)) {
                        $email = $f['email'];
                        $password = $f['password'];
                        $nombre = $f['nombre'];
                    }


                        require 'PHPMailerAutoload.php';

                            $mail = new PHPMailer;

                            //$mail->SMTPDebug = 3;                               // Enable verbose debug output

                            $correo = $email;
                            $mensaje = "Esta es tu password de acceso '$password'";
                            $nombre = $nombre;
                            
                            $mail->isSMTP();                                      // Set mailer to use SMTP
                            $mail->Host = 'p3plcpnl0526.prod.phx3.secureserver.net';  // Specify main and backup SMTP servers
                            $mail->SMTPAuth = true;                               // Enable SMTP authentication
                            $mail->Username = 'webparras@p3plcpnl0526.prod.phx3.secureserver.net';                 // SMTP username
                            $mail->Password = 'Siteparras0816';                           // SMTP password
                            $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
                            $mail->Port = 465;                                    // TCP port to connect to

                            $mail->setFrom('webparras@p3plcpnl0526.prod.phx3.secureserver.net');
                            $mail->addAddress($correo, $nombre);     

                            $mail->Subject = 'Recuperacion de Acceso';
                            $mail->Body    = $mensaje;

                            if(!$mail->send()) {
                                echo 'Error, mensaje no enviado';
                                echo 'Error del mensaje: ' . $mail->ErrorInfo;
                            } else {
                                $error .= "<p>Te Hemos Enviado Un Correo Con Tu Contraseña</p><br>
                                        <p>El Correo puede estar en tu correo no deseado</p>";
                                
                            }
                } 
             }
             
    }
   
?>