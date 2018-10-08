<?php 

require '../config/conexion.php';

/**
* 
*/
class Service
{
	
	function __construct()
	{
		
	}

	public function listar()
	{
		$sql = "SELECT * FROM servicios";
		return ejecutarConsulta($sql);
	}

	public function edit($id)
	{
		$sql = "SELECT * FROM servicios WHERE id = ".$id." ";
		return ejecutarConsulta($sql);
	}

	public function show($id)
	{
		$sql = "SELECT * FROM servicios WHERE id = '$id' ";
		return ejecutarConsulta($sql);
	}

	public function store($categoria,$subcategoria,$servicio,$precioIva,$precio,$tipo)
	{
		$sql = "INSERT INTO `servicios`(`categoria`,`subcategoria`, `nombre`, `precio`,`precio_iva`,`tipo`, `state`) 
				VALUES ('$categoria','$subcategoria','$servicio','$precioIva','$precio','$tipo','1') ";
		return ejecutarConsulta($sql);
	}

	public function update($categoria,$subcategoria,$servicio,$precioIva,$precio,$tipo,$id)
	{
		$sql = "UPDATE `servicios` SET `categoria`='$categoria', `subcategoria`='$subcategoria', `nombre`='$servicio', `precio`='$precioIva',`precio_iva`='$precio',`tipo`='$tipo', `state`='1' WHERE id = '$id' ";
		return ejecutarConsulta($sql);
	}

	public function destroy($id)
	{
		$sql = "DELETE FROM servicios WHERE id = '$id' ";
		return ejecutarConsulta($sql);
	}

	public function unavailable($state,$id)
	{
		$sql = "UPDATE servicios SET state='$state' WHERE id = '$id' ";
		return ejecutarConsulta($sql);
	}

	public function available($state,$id)
	{
		$sql = "UPDATE servicios SET state='$state' WHERE id = '$id' ";
		return ejecutarConsulta($sql);
	}

	public function listTemp($integrantes)
	{
		if ($integrantes>=40) {
			$sql = "SELECT * FROM servicios WHERE state = 1 order by id,categoria,nombre asc";
			return ejecutarConsulta($sql);
		}else{
			$sql = "SELECT * FROM servicios WHERE state = 1 && tipo='Normal' || state = 1 && tipo='' || state = 1 && tipo='null' order by id,categoria,nombre asc";
			return ejecutarConsulta($sql);
		}
	}

	// Muestra los servicios de la cotizacion ID
	public function showServices($id)
	{
		$sql = "SELECT se.categoria,se.subcategoria,se.tipo,cd.dia,cd.id_servicio,cd.servicio,cd.precio,cd.cantidad FROM cotizacion_dia cd INNER JOIN servicios se ON cd.id_servicio=se.id WHERE cd.id_empresa = ".$id." ";
		return ejecutarConsulta($sql);
	}
}


?>
