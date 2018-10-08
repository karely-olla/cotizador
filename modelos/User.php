<?php 

require_once '../config/conexion.php';

/**
* 
*/
class User
{
	
	function __construct()
	{
		
	}

	public function listar(){
		$sql = "SELECT * FROM usuarios";
		return ejecutarConsulta($sql);
	}

	public function generaPass($rm='RM')
	{
	    $cadena = "RinconDelMonterobcd1234567890";
	    $cadena = strtoupper($cadena);
	    $longitudCadena=strlen($cadena);
	    $pass = "";
	    $longitudPass=6;
	    for($i=1 ; $i<=$longitudPass ; $i++){
	        $pos=rand(0,$longitudCadena-1);
	        //formando la contraseña en cada iteraccion del bucle, añadiendo a la cadena $pass la letra correspondiente a la posicion $pos en la cadena de caracteres definida.
	        $pass .= substr($cadena,$pos,1);
	    }
	    return $rm.$pass;
	}
	public function moveFile($nombre,$apellido,$filename,$db_filname='')
	{
		$destino = "../public/images/avatars/";
		$ext = new SplFileInfo($filename['name']);
		$time = date('i-s');
		$name_imagen = $nombre."_".$apellido."_".$time.".".$ext->getExtension();
		if ($db_filname!="") {
			$is_file = file_exists($destino.$db_filname);
			if ($is_file) {
				if(unlink($destino.$db_filname))
				{
					$moveUploaded = move_uploaded_file($filename['tmp_name'], $destino.$name_imagen);
					if ($moveUploaded) {
						return $name_imagen;
					}else{
						return false;
					}
				}
			}else{
				$moveUploaded = move_uploaded_file($filename['tmp_name'], $destino.$name_imagen);
				if ($moveUploaded) {
					return $name_imagen;
				}else{
					return false;
				}
			}
		}else{
			$is_file = file_exists($destino.$name_imagen);
			if ($is_file) {
				if(unlink($destino.$name_imagen))
				{
					$moveUploaded = move_uploaded_file($filename['tmp_name'], $destino.$name_imagen);
					if ($moveUploaded) {
						return $name_imagen;
					}else{
						return false;
					}
				}
			}else{
				$moveUploaded = move_uploaded_file($filename['tmp_name'], $destino.$name_imagen);
				if ($moveUploaded) {
					return $name_imagen;
				}else{
					return false;
				}
			}
		}		
	}
	public function store($nombre,$apellido,$correo,$telefono,$usuario,$imagen,$token,$rol)
	{
		$pass= $this->generaPass('RM');
		$opciones = [
		    'cost' => 12
		];
		$passcrypt= password_hash($pass, PASSWORD_BCRYPT, $opciones);

		$moved = $this->moveFile($nombre,$apellido,$imagen);
		if ($moved) {
			$sql="INSERT INTO `usuarios`(`nombre`, `apellidos`, `correo`, `telefono`, `foto`, `usuario`, `password`, `contrasena`, `token`, `rol`, `state`) 
			VALUES ('$nombre', '$apellido', '$correo', '$telefono', '$moved', '$usuario', '$passcrypt', '$pass', '$token', '$rol', '1')";
			return ejecutarConsulta($sql);
		}else{
			return false;
		}
	}

	public function edit($id)
	{
		$sql = "SELECT * FROM usuarios WHERE id = ".$id." ";
		return ejecutarConsulta($sql);
	}

	public function update($nombre,$apellido,$correo,$telefono,$usuario,$imagen,$rol,$id)
	{
		if (isset($imagen) && !empty($imagen['name'])) {
			$sql = "SELECT foto FROM usuarios WHERE id = '$id' ";
			$result = ejecutarConsulta($sql);
			$f = $result->fetch(PDO::FETCH_OBJ);
			$db_filname = $f->foto;
			$moved = $this->moveFile($nombre,$apellido,$imagen,$db_filname);
			if ($moved) {
				$sql = "UPDATE usuarios SET nombre='$nombre', apellidos='$apellido', correo='$correo', telefono='$telefono',
					foto='$moved', usuario='$usuario', rol='$rol'	WHERE id = ".$id." ";
				return ejecutarConsulta($sql);
			}else{
				return false;
			}
			
		}else{
			$sql = "UPDATE usuarios SET nombre='$nombre', apellidos='$apellido', correo='$correo', telefono='$telefono', usuario='$usuario', rol='$rol'	WHERE id = ".$id." ";
			return ejecutarConsulta($sql);
		}

	}

	public function unavailable($id)
	{
		$sql = "UPDATE usuarios SET state = '0' WHERE id = ".$id." ";
		return ejecutarConsulta($sql);
	}

	public function available($id)
	{
		$sql = "UPDATE usuarios SET state = '1' WHERE id = ".$id." ";
		return ejecutarConsulta($sql);
	}

	public function destroy($id)
	{
		$sql = "SELECT foto FROM usuarios WHERE id = '$id' ";
		$result = ejecutarConsulta($sql);
		$f = $result->fetch(PDO::FETCH_OBJ);
		$db_filname = $f->foto;
		$destino = "../public/images/avatars/";
		if(unlink($destino.$db_filname))
		{
			$sql = "DELETE FROM usuarios WHERE id = ".$id." ";
			return ejecutarConsulta($sql);
		}else{
			return false;
		}
	}

	public function login($login, $pass)
	{
		$sql = "SELECT * FROM usuarios WHERE usuario = '$login' && state = 1 ";
		$q = ejecutarConsulta($sql);
		$fila = $q->rowCount();
		if ($fila>0) {
			$f = $q->fetch(PDO::FETCH_OBJ);
			if (password_verify($pass,$f->password)) {
				return ['success'=>true, 'q'=>ejecutarConsulta($sql)];
			}else{
				return ['success' => false, 'msg' => 'Las credenciales no son correctas'];
			}
		}else{
			return ['success' => false, 'msg' => 'El usuario no esta dado de alta en el sistema'];
		}
	}

	public function getTokenUser($email)
	{
		$sql = "SELECT * FROM usuarios WHERE correo = '$email' && state=1";
		$q = ejecutarConsulta($sql);
		$fila = $q->rowCount();
		if ($fila>0) {
			return ['success'=>true, 'q'=>ejecutarConsulta($sql)];
		}else{
			return ['success' => false, 'msg' => 'No estas registrado en el sistema con una cuenta valida'];
		}
	}

	public function verifyToken($token)
	{
		$sql = "SELECT * FROM usuarios WHERE token = '$token'";
		$q = ejecutarConsulta($sql);
		$fila = $q->rowCount();
		if ($fila>0) {
			return ['success'=>true, 'q'=>ejecutarConsulta($sql)];
		}else{
			return ['success' => false, 'msg' => 'El identificador ha expirado intenta con uno nuevo'];
		}
	}

	public function updPassReset($pass_new,$token_new,$id)
	{
		$opciones = [
			'cost' => 12
		];
		$passcrypt= password_hash($pass_new, PASSWORD_BCRYPT, $opciones);
		$sql="UPDATE `usuarios` SET `password`='$passcrypt', `contrasena`='$pass_new', `token`='$token_new' WHERE id = '$id' ";
		$updpassReset = ejecutarConsulta($sql);
		if ($updpassReset) {
			return ['success'=>true, 'q'=>ejecutarConsulta($sql)];			
		}else{
			return ['success'=>false];
		}
	}
}


?>