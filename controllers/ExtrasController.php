<?php 

require_once '../modelos/Extra.php';
$extra = new Extra();
$data = Array();
switch ($_GET['op']) {
	case 'listar':
		$id_empresa = $_GET['id_empresa'];
		$rspta = $extra->listar($id_empresa);
		if (!$rspta) {
			echo json_encode([
					"success" => false,
					'msg'=> 'Algo va mal intenta mas tarde',
				]);
		}else{
			while ($reg = $rspta->fetch(PDO::FETCH_OBJ)) {
				$data[]=array(

					"0"=>$reg->id,
					"1"=>$reg->dia,
		 			"2"=>strtoupper($reg->servicio),
		 			"3"=>number_format($reg->costo,0,'.',','),
		 			"4"=>'<button type="button" class="btn btn-xs btn-warning" onclick="show_extra('.$reg->id.')"><i class="fa fa-pencil"></i></button> <button type="button" class="btn btn-xs btn-danger" onclick="delete_extra('.$reg->id.')"><i class="fa fa-trash"></i></button>'
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

	case 'guardar':
		$id_empresa = $_POST['id'];
		$dia = $_POST['dia'];
		$servicio = limpiarCadena($_POST['servicio']);
		$costo = limpiarCadena($_POST['costo']);
		$rspta = $extra->store($id_empresa,$dia,$servicio,$costo);
		if ($rspta) {
			$response = [
				'success' => true,
				'msg' => "Servicio Extra Registrado"
			];		
		}else{
			$response = [
				'success' => true,
				'msg' => "El servicio extra no se pudo registrar"
			];
		}
		echo json_encode($response);
	break;

	case 'edit':
		$id = $_POST['id'];
		$rspta = $extra->edit($id);
		$f = $rspta->fetch(PDO::FETCH_OBJ);
		echo json_encode($f);
	break;

	case 'update':
		$id = $_POST['id'];
		$dia = $_POST['dia'];
		$servicio = limpiarCadena($_POST['servicio']);
		$costo = limpiarCadena($_POST['costo']);
		$rspta = $extra->update($dia,$servicio,$costo,$id);
		if ($rspta) {
			$response = [
				'success' => true,
				'msg' => "Servicio Extra Actualizado"
			];		
		}else{
			$response = [
				'success' => true,
				'msg' => "El servicio extra no se pudo Actualizar"
			];
		}
		echo json_encode($response);	
	break;

	case 'delete':
		$id = $_POST['id'];
		$rspta = $extra->destroy($id);
		if ($rspta) {
			$response = [
				'success' => true,
				'msg' => "Servicio Extra Eliminado"
			];		
		}else{
			$response = [
				'success' => true,
				'msg' => "El servicio extra no se pudo Eliminar"
			];
		}
		echo json_encode($response);
	break;
}

?>