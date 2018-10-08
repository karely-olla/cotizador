<?php 

require_once '../modelos/Grupo.php';

$grupo = new Grupo();
$data = Array();
switch ($_GET['op']) {
	case 'listar':
		$rspta = $grupo->listar();
		if (!$rspta) {
			echo json_encode([
					"success" => false,
					'msg'=> 'Algo va mal intenta mas tarde',
				]);
		}else{
			while ($reg = $rspta->fetch(PDO::FETCH_OBJ)) {
				$data[]=array(

					"0"=>$reg->id,
					"1"=>$reg->empresa,
		 			"2"=>$reg->procedencia,
		 			"3"=>$reg->num_cotizaciones,
		 			"4"=>number_format($reg->ingresos,2,'.',','),
		 			"5"=>($reg->total_ingresado!="")?'<p class="label label-success">'.number_format($reg->total_ingresado,2,'.',',').'</p>':'<p class="label label-danger">'.number_format(0,2,'.',',').'</p>'
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
	
	default:
		# code...
		break;
}

?>