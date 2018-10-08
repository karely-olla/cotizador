<?php 

require_once '../config/conexion.php';


/**
* 
*/
class Especial
{
	
	function __construct()
	{
		
	}
	public function listar($tipo)
	{
		$sql = "SELECT *, (SELECT nombre FROM usuarios WHERE id=c.id_usuario) as usuario FROM cotizaciones as c WHERE tipo = '$tipo' order by c.id asc ";
		return ejecutarConsulta($sql);
	}

	public function show($id,$id_user)
	{
		$sql = "SELECT * FROM cotizaciones c  WHERE c.id =".$id." && id_usuario = ".$id_user." ";
		$auth = ejecutarConsulta($sql);
		$filas = $auth->rowCount();
		if ($filas>0) {
			$sqlServs = "SELECT * FROM  cotizacion_dia cd  WHERE cd.id_empresa =".$id." ";
			$servicios = ejecutarConsulta($sqlServs);

			$sqlCots = "SELECT * FROM cotizaciones WHERE id = ".$id."";
			$cotizaciones = ejecutarConsulta($sqlCots);
			$sqlExtras = "SELECT * FROM `extras` WHERE id_empresa = ".$id." ";
			$extras = ejecutarConsulta($sqlExtras);
			$filasExts = $extras->rowCount();
			if ($filasExts>0) {
				return ['servicios' => $servicios, 
						'cotizaciones' => $cotizaciones,
						'extras' => ejecutarConsulta($sqlExtras)
					];
			}else{
				return ['servicios' => $servicios,
					 'cotizaciones' => $cotizaciones,
					 	'extras' => ''
					];
			}
		}else{
			return false;
		}		
	}

	public function store($idusuario,$empresa,$estado,$municipio,$email,$telefono,
					$coordinador,$date_start,$date_end,$hospedaje,$noches,$dias,$total,$token,$clave,$tipo,$vigencia,$now,$servicios)
	{
		$sqlClave = "SELECT clave FROM `grupos` WHERE clave = '$clave' ";
		$clv = ejecutarConsulta($sqlClave);
		$filasClvs = $clv->rowCount();
		if ($filasClvs>0) {
			$sql="INSERT INTO `cotizaciones`(`id_usuario`,`empresa`, `estado`, `municipio`, `correo`, `telefono`, `coordinador`, `fecha_entrada`, `fecha_salida`,`hospedaje`,  `noches`, `dias`, `monto`,`token`, `clave`,`tipo`, `vencimiento`, `created_at`, `updated_at`,`state`) 
			VALUES ('$idusuario','$empresa','$estado','$municipio','$email','$telefono','$coordinador','$date_start','$date_end','$hospedaje','$noches','$dias','$total','$token','$clave','$tipo','$vigencia','$now','$now','0')";
			$idcot =retornarID($sql);
			// $idcot = $con->lastInsertId();
			foreach($servicios as $dia => $value)
			{
		 		foreach($value as $idservicio =>$tipo)
		 		{
			 		foreach ($tipo as $cantidad) {
			 			if ($cantidad!="" && $cantidad>0) {
				 			$sqlSelect = "SELECT * FROM servicios WHERE id = '$idservicio' && state = 1 ";
				 			$resSelect = ejecutarConsulta($sqlSelect);
				 			$fs = $resSelect->fetch(PDO::FETCH_OBJ);
				 			$sqlDia = "INSERT INTO `cotizacion_dia`(`id_empresa`, `dia`, `id_servicio`, `servicio`, `precio`, `cantidad`, `state`)
				 			 VALUES ('$idcot','$dia','$fs->id','$fs->nombre','$fs->precio','$cantidad','1')";
				 			$resDia = ejecutarConsulta($sqlDia);		 				
			 			}

			 		}
		 		}
			}
		 	if ($resDia) {
				return true;
		 	}else{
		 		return false;
		 	}
		}else{
			$grupo_repeat = $empresa.' '.$estado.' '.$municipio;
			$sqlRepeat="SELECT * FROM `cotizaciones` WHERE CONCAT(empresa,' ',estado,' ',municipio) = '$grupo_repeat' ";
			$repeatGroup = ejecutarConsulta($sqlRepeat);
			$filaRepeat = $repeatGroup->rowCount();
			$row = $repeatGroup->fetch(PDO::FETCH_OBJ);
			if ($filaRepeat>0) {
				$sql="INSERT INTO `cotizaciones`(`id_usuario`,`empresa`, `estado`, `municipio`, `correo`, `telefono`, `coordinador`, `fecha_entrada`, `fecha_salida`,`hospedaje`,  `noches`, `dias`, `monto`,`token`, `clave`,`tipo`, `vencimiento`, `created_at`, `updated_at`,`state`) 
				VALUES ('$idusuario','$empresa','$estado','$municipio','$email','$telefono','$coordinador','$date_start','$date_end','$hospedaje','$noches','$dias','$total','$token','$row->clave','$tipo','$vigencia','$now','$now','0')";
				$idcot =retornarID($sql);
				// $idcot = $con->lastInsertId();
				foreach($servicios as $dia => $value)
				{
			 		foreach($value as $idservicio =>$tipo)
			 		{
				 		foreach ($tipo as $cantidad) {
				 			if ($cantidad!="" && $cantidad>0) {
					 			$sqlSelect = "SELECT * FROM servicios WHERE id = '$idservicio' && state = 1 ";
					 			$resSelect = ejecutarConsulta($sqlSelect);
					 			$fs = $resSelect->fetch(PDO::FETCH_OBJ);
					 			$sqlDia = "INSERT INTO `cotizacion_dia`(`id_empresa`, `dia`, `id_servicio`, `servicio`, `precio`, `cantidad`, `state`)
					 			 VALUES ('$idcot','$dia','$fs->id','$fs->nombre','$fs->precio','$cantidad','1')";
					 			$resDia = ejecutarConsulta($sqlDia);		 				
				 			}

				 		}
			 		}
				}
			 	if ($resDia) {
					return true;
			 	}else{
			 		return false;
			 	}
			}else{
				$sql = "INSERT INTO `grupos` (`clave`,`num_cotizaciones`,`ingresos`,`state`) VALUES ('$clave',0,0.00,1) ";
				$grupos = ejecutarConsulta($sql);
				if ($grupos) {
					$sql="INSERT INTO `cotizaciones`(`id_usuario`,`empresa`, `estado`, `municipio`, `correo`, `telefono`, `coordinador`, `fecha_entrada`, `fecha_salida`,`hospedaje`,  `noches`, `dias`, `monto`,`token`, `clave`,`tipo`, `vencimiento`, `created_at`, `updated_at`,`state`) 
					VALUES ('$idusuario','$empresa','$estado','$municipio','$email','$telefono','$coordinador','$date_start','$date_end','$hospedaje','$noches','$dias','$total','$token','$clave','$tipo','$vigencia','$now','$now','0')";
					$idcot =retornarID($sql);
					// $idcot = $con->lastInsertId();
					foreach($servicios as $dia => $value)
					{
				 		foreach($value as $idservicio =>$tipo)
				 		{
					 		foreach ($tipo as $cantidad) {
					 			if ($cantidad!="" && $cantidad>0) {
						 			$sqlSelect = "SELECT * FROM servicios WHERE id = '$idservicio' && state = 1 ";
						 			$resSelect = ejecutarConsulta($sqlSelect);
						 			$fs = $resSelect->fetch(PDO::FETCH_OBJ);
						 			$sqlDia = "INSERT INTO `cotizacion_dia`(`id_empresa`, `dia`, `id_servicio`, `servicio`, `precio`, `cantidad`, `state`)
						 			 VALUES ('$idcot','$dia','$fs->id','$fs->nombre','$fs->precio','$cantidad','1')";
						 			$resDia = ejecutarConsulta($sqlDia);		 				
					 			}

					 		}
				 		}
					}
				 	if ($resDia) {
						return true;
				 	}else{
				 		return false;
				 	}
				}else{
					return false;
				}
			}
		}
	}

	public function edit($id,$id_user)
	{

		$sql = "SELECT * FROM cotizaciones c  WHERE c.id =".$id." && id_usuario = ".$id_user." ";
		$auth = ejecutarConsulta($sql);
		$filas = $auth->rowCount();
		if ($filas>0) {
			$sql = "SELECT * FROM cotizaciones WHERE id = ".$id." ";
			return ['q' => ejecutarConsulta($sql)];
		}else{
			return false;
		}
	}

	public function update($id,$empresa,$estado,$municipio,$email,$telefono,
					$coordinador,$date_start,$date_end,$hospedaje,$noches,$dias,$total,$now,$servicios)
	{
		if (!empty($servicios) || $servicios!="") {
			$sql="UPDATE `cotizaciones` SET `empresa`='$empresa',`estado`='$estado',`municipio`='$municipio',`correo`='$email',`telefono`='$telefono',`coordinador`='$coordinador',`fecha_entrada`='$date_start',`fecha_salida`='$date_end',`hospedaje`='$hospedaje',`noches`='$noches', `dias`='$dias', `monto`='$total',`updated_at`='$now' WHERE id = '$id' ";
			$cotizacion = ejecutarConsulta($sql);
			if ($cotizacion) {
				$sqlDelServs = "DELETE FROM cotizacion_dia WHERE id_empresa = ".$id." ";
				$delServicios = ejecutarConsulta($sqlDelServs);
				if ($delServicios) {
					foreach($servicios as $dia => $value)
					{
				 		foreach($value as $idservicio =>$tipo)
				 		{
					 		foreach ($tipo as $cantidad) {
					 			if ($cantidad!="" && $cantidad>0) {
						 			$sqlSelect = "SELECT * FROM servicios WHERE id = '$idservicio' && state = 1 ";
						 			$resSelect = ejecutarConsulta($sqlSelect);
						 			$fs = $resSelect->fetch(PDO::FETCH_OBJ);
						 			$sqlDia = "INSERT INTO `cotizacion_dia`(`id_empresa`, `dia`, `id_servicio`, `servicio`, `precio`, `cantidad`, `state`)
						 			 VALUES ('$id','$dia','$fs->id','$fs->nombre','$fs->precio','$cantidad','1')";
						 			$resDia = ejecutarConsulta($sqlDia);		 				
					 			}

					 		}
				 		}
					}
				 	if ($resDia) {
						return ['success'=>true];
				 	}else{
				 		return ['success'=>false,'msg'=>'No se actualizaron los servicios, intenta de nuevo'];
				 	}
				}else{
					return ['success'=>false,'msg'=>'No se pudieron eliminar los sericios'];
				}
			}else{
				return ['success'=>false,'msg'=>'No se pudo actualizar la cotizacion'];
			}
		}else{
			$sql="UPDATE `cotizaciones` SET `empresa`='$empresa',`estado`='$estado',`municipio`='$municipio',`correo`='$email',`telefono`='$telefono',`coordinador`='$coordinador',`fecha_entrada`='$date_start',`fecha_salida`='$date_end',`hospedaje`='$hospedaje',`noches`='$noches',  `dias`='$dias', `monto`='$total',`updated_at`='$now' WHERE id = '$id' ";
			$cotizacion = ejecutarConsulta($sql);
			if ($cotizacion) {
				$sqlServ = "SELECT * FROM `cotizacion_dia` WHERE id_empresa = ".$id." ";
				$filas = ejecutarConsulta($sql);
				if ($filas->rowCount()>0) {
					$sqlDelServs = "DELETE FROM cotizacion_dia WHERE id_empresa = ".$id." ";
					$delServicios = ejecutarConsulta($sqlDelServs);
					return ['success'=>true];
				}else{
					return ['success'=>true];
				}
			}else{
				return ['success'=>false,'msg'=>'No se pudo actualizar la cotizacion'];
			}
		}
				
	}
}




?>