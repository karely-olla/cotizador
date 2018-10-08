<?php 

require_once '../config/conexion.php';

/**
* 
*/
class Grupo
{
	
	function __construct()
	{
			
	}

	public function listar()
	{
		$sql = "SELECT g.id,c.empresa, CONCAT(c.municipio,',',c.estado) as procedencia, (SELECT SUM(monto) as total FROM cotizaciones WHERE clave = g.clave && state = 1) as total_ingresado, g.num_cotizaciones,g.ingresos FROM `grupos` as g INNER JOIN cotizaciones as c ON g.clave=c.clave GROUP BY g.id,g.clave,c.empresa,c.municipio,c.estado ORDER BY g.clave";
		return ejecutarConsulta($sql);
	}
}

// ONLY_FULL_GROUP_BY

?>