<?php

try {
	$con = new PDO('mysql:host=localhost; dbname=cotizador; charset=utf8', 'root', '');
	// $con = new PDO('mysql:host=localhost; dbname=db_cotizador_rm; charset=utf8', 'root', '');
} catch (PDOException $e) {
	echo "ERROR ". $e->getMessage();
	die();
}
if (!function_exists('ejecutarConsulta'))
{
	function ejecutarConsulta($sql)
	{
		global $con;
		$query = $con->prepare($sql);
		$query->execute();
		return $query;
	}

	function ejecutarConsultaSimpleFila($sql)
	{
		global $con;
		$query = $con->query($sql);		
		$row = $query->fetch(PDO::FETCH_OBJ);
		return $row;
	}

	function retornarID($sql)
	{
		global $con;
		$query = $con->prepare($sql);
		$query->execute();	
		$id = $con->lastInsertId();
		return $id;			
	}

	function limpiarCadena($str)
	{	
		$str = ucwords(mb_strtolower($str, 'UTF-8'));
		$str_simple = str_replace("'", "", $str);
		$str_doble = str_replace('"', "",$str_simple);
		$str_final= htmlspecialchars($str_doble);
    	return trim( filter_var($str_final, FILTER_SANITIZE_STRING)  ); 
	}

	function validarEmail($email){
		$str_final= htmlspecialchars($email);
    	return trim(filter_var($str_final, FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_EMAIL));
	}
}

?>