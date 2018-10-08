<?php 

require_once '../config/conexion.php';
class Profile
{

	function __construct()
	{

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

	public function editImage($imagen,$id)
	{
		if (isset($imagen)) {
			$sql = "SELECT * FROM usuarios WHERE id = '$id' ";
			$result = ejecutarConsulta($sql);
			$f = $result->fetch(PDO::FETCH_OBJ);
			$db_filname = $f->foto;
			$moved = $this->moveFile($f->nombre,$f->apellidos,$imagen,$db_filname);
			if ($moved) {
				$sql = "UPDATE usuarios SET foto='$moved' WHERE id = ".$id." ";
				$exec = ejecutarConsulta($sql);
				if ($exec) {
					return ['success'=>true,'foto'=>$moved];
				}else{
					return false;
				}
			}else{
				return false;
			}			
		}
	}

	public function verifyPass($pass,$id)
	{
		$sql = "SELECT * FROM usuarios WHERE id= '$id' ";
		$q = ejecutarConsulta($sql);
		$fila = $q->rowCount();
		$f = $q->fetch(PDO::FETCH_OBJ);
		if (password_verify($pass,$f->password)) {
			return true;
		}else{
			return false;
		}
	}

	public function updPass($pass,$pass_new,$id)
	{
		if ($this->verifyPass($pass,$id)) {
			$opciones = [
			    'cost' => 12
			];
			$passcrypt= password_hash($pass_new, PASSWORD_BCRYPT, $opciones);
			$sql="UPDATE `usuarios` SET `password`='$passcrypt', `contrasena`='$pass_new' WHERE id = '$id' ";
			return ['success'=>true, 'q'=>ejecutarConsulta($sql)];
		}else{
			return ['success'=>false, 'msg'=>'La contraseña actual no coincide con nuestros registros'];
		}
	}


}




?>