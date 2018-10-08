<?php 


require_once '../config/conexion.php';
/**
* 
*/
class Extra
{
	
	function __construct()
	{
		
	}

	public function listar($id_empresa)
	{
		$sql = "SELECT * FROM extras WHERE id_empresa = ".$id_empresa." ";
		return ejecutarConsulta($sql);
	}

	public function store($id_empresa,$dia,$servicio,$costo)
	{
		$sql = "INSERT INTO extras (`id_empresa`,`dia`,`servicio`,`costo`) VALUES ('$id_empresa','$dia','$servicio','$costo') ";
		return ejecutarConsulta($sql);
	}

	public function edit($id)
	{
		$sql = "SELECT * FROM extras WHERE id = ".$id." ";
		return ejecutarConsulta($sql);	
	}

	public function update($dia,$servicio,$costo,$id)
	{
		$sql = "UPDATE extras SET `dia` = '$dia', `servicio`= '$servicio', `costo`='$costo' WHERE id = ".$id." ";
		return ejecutarConsulta($sql);
	}

	public function destroy($id)
	{
		$sql = "DELETE FROM extras WHERE id = ".$id." ";
		return ejecutarConsulta($sql);
	}
}



?>