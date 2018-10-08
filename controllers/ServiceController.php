<?php 

require_once '../modelos/Servicio.php';

$service = new Service();

$data = Array();
switch ($_GET['op']) {
	case 'listar':
		$rspta = $service->listar();
		if (!$rspta) {
			echo json_encode([
					"success" => false,
					'msg'=> 'Algo va mal intenta mas tarde',
				]);
		}else{
			while ($reg = $rspta->fetch(PDO::FETCH_OBJ)) {
				$data[]=array(

					"0"=>$reg->id,
		 			"1"=>$reg->categoria,
		 			"2"=>$reg->nombre,
		 			"3"=>$reg->precio,
		 			"4"=>$reg->precio_iva,
		 			"5"=>($reg->tipo!='Buffet')?'<p class="label label-default">Normal</p>':
		 				'<p class="label label-success">Buffet</p>',
		 			"6"=>($reg->state==1)?'<p class="label label-primary">Habilitado</p>':
		 				'<p class="label label-danger">Deshabilitado</p>',
		 			"7"=>($reg->state==1)?'<button type="button" class="btn btn-xs btn-warning" onclick="edit('.$reg->id.')"><i class="fa fa-pencil"></i></button> <button type="button" class="btn btn-xs btn-danger" onclick="eliminar('.$reg->id.')"><i class="fa fa-trash"></i></button>':
		 				'<button type="button" class="btn btn-xs btn-warning" onclick="edit('.$reg->id.')"><i class="fa fa-pencil"></i></button> <button type="button" class="btn btn-xs btn-danger" onclick="eliminar('.$reg->id.')"><i class="fa fa-trash"></i></button>',
					"8"=>($reg->state==1)?'<div class="onoffswitch">
							    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="serv_'.$reg->id.'" checked>
							    <label class="onoffswitch-label" for="serv_'.$reg->id.'"  onclick="onoff_serv('.$reg->state.', '.$reg->id.')">
							        <span class="onoffswitch-inner"></span>
							        <span class="onoffswitch-switch"></span>
							    </label>
							</div>':'<div class="onoffswitch">
							    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="coast_'.$reg->id.'">
							    <label class="onoffswitch-label" for="coast_'.$reg->id.'"  onclick="onoff_serv('.$reg->state.', '.$reg->id.')">
							        <span class="onoffswitch-inner"></span>
							        <span class="onoffswitch-switch"></span>
							    </label>
							</div>'
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
	case 'edit':
		$id =$_POST['id'];
		$rspta = $service->edit($id);
		$servicio = $rspta->fetch(PDO::FETCH_OBJ);
		echo json_encode($servicio);
	break;

	case 'guardar':
		$categoria = limpiarCadena($_POST['categoria']);
		$subcategoria = limpiarCadena($_POST['subcategoria']);
		$servicio = limpiarCadena($_POST['servicio']);
		$precio = limpiarCadena($_POST['precio']);
		$tipo = (isset($_POST['tag']))?limpiarCadena($_POST['tag']):"";
		$precio_iva = ($precio/1.26);
		$precioIva = number_format($precio_iva,2,'.','');
		// $precioIva = $precio-$precio_iva;
		$rspta = $service->store($categoria,$subcategoria,$servicio,$precioIva,$precio,$tipo);
		if ($rspta) {
			$response=[
				'success'=>true,
				'msg'=> 'Servicio agregado'
			];
		}else{
			$response=[
				'success'=>false,
				'msg'=> 'Algo va mal intenta mas tarde'
			];
		}
		echo json_encode($response);
	break;

	case 'update':
		$id =$_POST['id'];
		$categoria = limpiarCadena($_POST['categoria']);
		$subcategoria = limpiarCadena($_POST['subcategoria']);
		$servicio = limpiarCadena($_POST['servicio']);
		$precio = limpiarCadena($_POST['precio']);
		$tipo = (isset($_POST['tag']))?limpiarCadena($_POST['tag']):"";
		$precio_iva = ($precio/1.26);
		$precioIva = number_format($precio_iva,2,'.','');
		$rspta = $service->update($categoria,$subcategoria,$servicio,$precioIva,$precio,$tipo,$id);
		if ($rspta) {
			$response=[
				'success'=>true,
				'msg'=> 'Servicio actualizado'
			];
		}else{
			$response=[
				'success'=>false,
				'msg'=> 'Algo va mal intenta mas tarde'
			];
		}
		echo json_encode($response);	
	break;

	case 'delete':
		$id =$_POST['id'];
		$rspta = $service->destroy($id);
		if ($rspta) {
			$response=[
				'success'=>true,
				'msg'=> 'Servicio Eliminado'
			];
		}else{
			$response=[
				'success'=>false,
				'msg'=> 'Algo va mal intenta mas tarde'
			];
		}
		echo json_encode($response);
	break;

	case 'deshabilitar':
		$id =$_POST['id'];
		$state = $_POST['state'];
		$rspta = $service->unavailable($state,$id);
		if ($rspta) {
			$response=[
				'success'=>true,
				'msg'=> 'Servicio Deshabilitado'
			];
		}else{
			$response=[
				'success'=>false,
				'msg'=> 'Algo va mal intenta mas tarde'
			];
		}
		echo json_encode($response);	
	break;
	case 'habilitar':
		$id =$_POST['id'];
		$state = $_POST['state'];
		$rspta = $service->available($state,$id);
		if ($rspta) {
			$response=[
				'success'=>true,
				'msg'=> 'Servicio Habilitado'
			];
		}else{
			$response=[
				'success'=>false,
				'msg'=> 'Algo va mal intenta mas tarde'
			];
		}
		echo json_encode($response);	
	break;

	case 'template':
		$template = '';
		$integrantes = $_GET['integrantes'];
		$rspta = $service->listTemp($integrantes);
		if (!$rspta) {
			die("Error");
		}else{
			while ($reg = $rspta->fetch(PDO::FETCH_OBJ)) {
				$data[]=array(

					"0"=>$reg->id,
		 			"1"=>$reg->subcategoria,
		 			"2"=>$reg->nombre,
		 			"3"=>$reg->precio,
		 			"4"=>$reg->precio_iva,
		 			"5"=>($reg->tipo!='Buffet')?'<p class="label label-default">Normal</p>':
		 				'<p class="label label-success">Buffet</p>',
		 			"6"=>($reg->state==1)?'<p class="label label-primary">Habilitado</p>':
		 				'<p class="label label-danger">Deshabilitado</p>',
		 			"7"=>($reg->state==1)?'<button type="button" class="btn btn-sm btn-success" onclick="agregar_servicio('.$reg->id.')"><i class="fa fa-check"></i></button>':
		 				'<button type="button" class="btn btn-sm btn-warning" disabled onclick="agregar_servicio('.$reg->id.')"><i class="fa fa-pencil"></i></button>'
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

	// Funcion para agregar el servicio a los dias de la cotizacion
	case 'servicio':
		$id= $_GET['id'];	
		$rspta = $service->show($id);
		if ($rspta) {
			$servicio = $rspta->fetch(PDO::FETCH_OBJ);
			echo json_encode($servicio);
		}else{
			$response=[
				'success'=>false,
				'msg'=> 'Algo va mal intenta mas tarde'
			];
			echo json_encode($response);
		}
	break;
	
	// Muestra los servicios de la cotizacion con el ID
	case 'show-servicios':
		$id = $_POST['id'];
		$rspta = $service->showServices($id);
		$datos_servs=[];
		$i=0;
		while ($filas = $rspta->fetch(PDO::FETCH_OBJ)) {
			$datos_servs[$i]['categoria'] = $filas->categoria;
			$datos_servs[$i]['dia'] = $filas->dia;
			$datos_servs[$i]['id'] = $filas->id_servicio;
			$datos_servs[$i]['servicio'] = $filas->servicio;
			$datos_servs[$i]['precio'] = $filas->precio;
			$datos_servs[$i]['cantidad'] = $filas->cantidad;
			$datos_servs[$i]['servicio'] = $filas->servicio;
			$datos_servs[$i]['tipo'] = $filas->tipo;
			$i++;
		}
		$response = [
			'success'=>true,  
			'datos' => $datos_servs
		];
		echo json_encode($response);
	break;
}




?>