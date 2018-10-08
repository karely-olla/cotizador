<?php 

session_start();

date_default_timezone_set('America/Monterrey');
$dominio = '/';
require_once '../modelos/Especial.php';

$especial = new Especial();

$data = Array();

switch ($_GET['op']) {
	case 'listar':
		$tipo = 'Special';
		$rspta = $especial->listar($tipo);
		if (!$rspta) {
			echo json_encode([
					"success" => false,
					'msg'=> 'Algo va mal intenta mas tarde',
				]);
		}else{
			$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
			$meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sept","Oct","Nov","Dic");
			while ($reg = $rspta->fetch(PDO::FETCH_OBJ)) {
				if ($reg->state==1) {
					$estado= '<p class="label label-primary">Confirmada</p>';
					$opciones='<button type="button" class="btn btn-xs btn-warning"  onclick="edit('.$reg->id.')"><i class="fa fa-pencil"></i></button> <button type="button" class="btn btn-xs btn-info"  onclick="info_cot('.$reg->id.')"><i class="fa fa-search"></i></button> <a href="'.$dominio.'reportes/reporte.php?k='.$reg->token.'" target="_blank"  class="btn btn-xs btn-danger"><i class="fa fa-file-pdf-o"></i></a> <button type="button" class="btn btn-xs btn-danger" onclick="delete_cot('.$reg->id.')"><i class="fa fa-trash"></i></button>';					
					$botonOrden = '<button type="button" class="btn btn-xs btn-success" onclick="view_ord(\''.$reg->orden.'\')"><i class="fa fa-copy"></i></button>';
					$onoff = '<div class="onoffswitch">
							    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="coast_'.$reg->id.'" checked>
							    <label class="onoffswitch-label" for="coast_'.$reg->id.'" data-st="'.$reg->state.'" onclick="anular('.$reg->id.')">
							        <span class="onoffswitch-inner"></span>
							        <span class="onoffswitch-switch"></span>
							    </label>
							</div>';
				}else if($reg->state==2){
					$estado= '<p class="label label-danger">Anulada</p>';
					$opciones='<button type="button" class="btn btn-xs btn-warning"  onclick="edit('.$reg->id.')"><i class="fa fa-pencil"></i></button> <button type="button" class="btn btn-xs btn-info"  onclick="info_cot('.$reg->id.')"><i class="fa fa-search"></i></button> <a href="'.$dominio.'reportes/reporte.php?k='.$reg->token.'" target="_blank"  class="btn btn-xs btn-danger"><i class="fa fa-file-pdf-o"></i></a> <button type="button" class="btn btn-xs btn-danger" onclick="delete_cot('.$reg->id.')"><i class="fa fa-trash"></i></button>';						
					$botonOrden = '<button type="button" disabled class="btn btn-xs btn-success"><i class="fa fa-copy"></i></button>';
					$onoff = '<div class="onoffswitch">
							    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="coast_'.$reg->id.'">
							    <label class="onoffswitch-label" for="coast_'.$reg->id.'" data-st="'.$reg->state.'" onclick="confirmar('.$reg->id.')">
							        <span class="onoffswitch-inner"></span>
							        <span class="onoffswitch-switch"></span>
							    </label>
							</div>';
				}else if($reg->state==3){
					$estado= '<p class="label label-default">Vencida</p>';
					$opciones='<button type="button" class="btn btn-xs btn-warning" disabled onclick="edit('.$reg->id.')"><i class="fa fa-pencil"></i></button> <button type="button" class="btn btn-xs btn-info" disabled onclick="info_cot('.$reg->id.')"><i class="fa fa-search"></i></button> <a href="'.$dominio.'reportes/reporte.php?k='.$reg->token.'" target="_blank" disabled class="disabled btn btn-xs btn-danger" ><i class="fa fa-file-pdf-o"></i></a> <button type="button" class="btn btn-xs btn-danger" onclick="delete_cot('.$reg->id.')"><i class="fa fa-trash"></i></button>';
					$botonOrden = '<button type="button" disabled class="btn btn-xs btn-success"><i class="fa fa-copy"></i></button>';
					$onoff = '<p class="label label-default">Expiro</p>';
				}else{
					$estado= '<p class="label label-warning">Pendiente</p>';
					$opciones='<button type="button" class="btn btn-xs btn-warning"  onclick="edit('.$reg->id.')"><i class="fa fa-pencil"></i></button> <button type="button" class="btn btn-xs btn-info"  onclick="info_cot('.$reg->id.')"><i class="fa fa-search"></i></button> <a href="'.$dominio.'reportes/reporte.php?k='.$reg->token.'" target="_blank"  class="btn btn-xs btn-danger"><i class="fa fa-file-pdf-o"></i></a> <button type="button" class="btn btn-xs btn-danger" onclick="delete_cot('.$reg->id.')"><i class="fa fa-trash"></i></button>';					
					$botonOrden = '<button type="button" disabled class="btn btn-xs btn-success"><i class="fa fa-copy"></i></button>';
					$onoff = '<div class="onoffswitch">
							    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="coast_'.$reg->id.'">
							    <label class="onoffswitch-label" for="coast_'.$reg->id.'" data-st="'.$reg->state.'" onclick="confirmar('.$reg->id.')">
							        <span class="onoffswitch-inner"></span>
							        <span class="onoffswitch-switch"></span>
							    </label>
							</div>';
				}
				$data[]=array(

					"0"=>$reg->id,
					"1"=>'C-RM-'.$reg->id,
					"2"=>$reg->usuario,
		 			"3"=>strtoupper($reg->empresa),
		 			"4"=>$reg->correo,
		 			"5"=>number_format($reg->monto,0,'.',','),
		 			"6"=>$dias[date('w', strtotime($reg->fecha_entrada))]." ".date('d', strtotime($reg->fecha_entrada))." de ".$meses[date('n', strtotime($reg->fecha_entrada))-1]. " del ".date('Y', strtotime($reg->fecha_entrada)),
		 			"7"=>$estado,
		 			"8"=>$opciones,
		 			"9"=>$botonOrden,
					"10"=>$onoff
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

	case 'info':
		$id = $_POST['id'];
		$id_user = $_SESSION['iduser'];
		$rspta = $especial->show($id,$id_user);
		if ($rspta) {
			$info='';
			$subtotal=0;
			$monto_total =0;
			$fh = $rspta['cotizaciones']->fetch(PDO::FETCH_OBJ);
			$datos_cotizacion =[
				'folio'=>'C-RM-'.$fh->id,
				'clave'=>$fh->clave,
				'id_user'=>$id_user,
				'token'=>$fh->token,
				'coordinador'=>$fh->coordinador,
				'procedencia'=>$fh->municipio.', '.$fh->estado,
				'telefono'=>$fh->telefono,
				'noches'=>$fh->noches,
				'dias'=>$fh->dias,
				'estado'=>$fh->state
			];

			$hospedaje = json_decode($fh->hospedaje,true);
			$total_extras=0;
			if ($rspta['extras'] !='') {
				while ($f = $rspta['extras']->fetch(PDO::FETCH_OBJ)) {
					$total_extras = $total_extras + $f->costo;
				}
			}
			if ($fh->hospedaje !='') {
				if ($rspta['servicios']->rowCount()>0) {
					$info.='<div class="row">';					
						$info.='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-service">';
							$info .= '<h2 class="title-cat">Servicios</h2>';
							$info .= '<table class="table table-condensed">
								<thead>
									<tr>
										<th>Servicio</th>
										<th>Precio</th>
										<th>Cantidad</th>
										<th>Subtotal</th>
									</tr>
								</thead>
								<tbody>';
							while($cot = $rspta['servicios']->fetchAll(PDO::FETCH_OBJ)){
								$dias = array();
						          foreach ($cot as $f) {
						              $dias[] = $f->dia;
						          }
						          
						        $dias = array_values(array_unique($dias)); 
						        $cont=0;
						        if (count($dias)==1) {
						        	$info .= '<tr class="success"><td colspan="4">'.$dias[0].'</td></tr>';
							        foreach ($cot as $f): 
										$subtotal=( round(((($f->precio*16)/100)+$f->precio)) * $f->cantidad);
											$info.='<tr>
												      <td>'.$f->servicio.'</td>
													  <td>'.round(((($f->precio*16)/100)+$f->precio)).'</td>
													  <td>'.$f->cantidad.'</td>
													  <td><b>'.number_format($subtotal,2,'.',',').'</b></td>';
										$info .= '</tr>';
										$monto_total=($f->precio*$f->cantidad)+$monto_total;
									endforeach;
						        }else{
						        	foreach ($cot as $f): 

								        $dia_actual = $f->dia; 
								        if ($dia_actual == $dias[$cont]):
											$info .= '<tr class="success"><td colspan="4">'.$f->dia.'</td></tr>';
											// $info.=$hos;
											$cont++; 
									        if ($cont == count($dias)) {
									            $cont = 0;
									        } 
										endif;
										$subtotal=( round(((($f->precio*16)/100)+$f->precio)) * $f->cantidad);
											$info.='<tr>
												      <td>'.$f->servicio.'</td>
													  <td>'.round(((($f->precio*16)/100)+$f->precio)).'</td>
													  <td>'.$f->cantidad.'</td>
													  <td><b>'.number_format($subtotal,2,'.',',').'</b></td>';
										$info .= '</tr>';
										$monto_total=($f->precio*$f->cantidad)+$monto_total;
									endforeach;
						        } 
							}
							$info .='<tr>
						    			<td colspan="3" class="text-right">Servicios:</td>
						    			<td><b>'.number_format($monto_total,2,'.',',').'</b></td>
							    	</tr>
									<tr>
						    			<td colspan="3" class="text-right">16% IVA:</td>
						    			<td><b>'.number_format(round(($monto_total*16)/100),2,'.',',').'</b></td>
							    	</tr>
									<tr>
						    			<td colspan="3" class="text-right">10% Serv:</td>
						    			<td><b>'.number_format(round(($monto_total*10)/100),2,'.',',').'</b></td>
							    	</tr>
							    	<tr>
						    			<td colspan="3" class="text-right">Subtotal:</td>
						    			<td><b>'.number_format(round( ( ((($monto_total*16)/100)+$monto_total) ) + ( (($monto_total*10)/100) )  ),2,'.',',').'</b></td>
							    	</tr>';
							    	
							$info .= '</tbody>
							</table>';							
						$info.='</div>';

						$total =0;
					    $info.='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">';
					    	$info .= '<h2 class="title-cat">Hospedaje</h2>';
							    $info .= '<table class="table table-condensed">
									<thead>
										<tr>
											<th>Habitacion</th>
											<th>Cantidad</th>
											<th>Tarifa</th>
											<th>Subtotal</th>
										</tr>
									</thead>
									<tbody>';										
										foreach ($hospedaje as $posicion => $value):
											foreach ($value as $dia => $valor) {
												$info .= '<tr class="success"><td colspan="4">'.$dia.'</td></tr>';
												foreach ($valor as $h => $valores) {
													$info .= '<tr>
																<td>'.$h.'</td>
																<td>'.$valores['cantidad'].'</td>
																<td>'.$valores['tarifa'].'</td>	
																<td> 
																	<b>'.number_format(($valores['cantidad']*$valores["tarifa"]),2,'.',',').'</b>
																</td>								
															</tr>';	
													$total=($valores['cantidad']*$valores['tarifa'])+$total;
												}
											}
										endforeach;
								   $info .='<tr>
								    			<td colspan="3" class="text-right">Hospedaje:</td>
								    			<td><b>'.number_format($total,2,'.',',').'</b></td>
									    	</tr>
									    	<tr>
								    			<td colspan="3" class="text-right">16% IVA:</td>
								    			<td><b>'.number_format(round(($total*16)/100),2,'.',',').'</b></td>
									    	</tr>
									    	<tr>
								    			<td colspan="3" class="text-right">3% ISH:</td>
								    			<td><b>'.number_format(round(($total*3)/100),2,'.',',').'</b></td>
									    	</tr>
									    	<tr>
								    			<td colspan="3" class="text-right">Subtotal:</td>
								    			<td><b>'.number_format(round( ( ((($total*16)/100)+$total) ) + ( (($total*3)/100) )  ),2,'.',',').'</b></td>
									    	</tr>';
								$info .= '</tbody>
								</table>';
								$info .= '<hr>
							     <h2>Total: <b>$'.number_format(round( ( ( ((($total*16)/100)+$total) ) + ( (($total*3)/100) ) + ( ((($monto_total*16)/100)+$monto_total) ) + ( (($monto_total*10)/100) ) ) + $total_extras  ),2,'.',',').'</b></h2>';				     
					    $info.='</div>';
					$info.='</div>';					
				}
			}
			$response=[
				'success'=>true,
				'datos'=>$datos_cotizacion,
				'info' => $info
			];
		}else{
			$response=[
				'success'=>false,  
				'msg'=> 'No tienes permisos para ver la información de esta cotizacion'
			];
		}
		echo json_encode($response);	
	break;


	case 'store':
		if (!isset($_SESSION['iduser']) || empty($_SESSION['iduser'])) {
			$response=['success'=>false,'msg'=>'expired'];
		}else{
			$habitaciones = $_POST['habitaciones'];
			$i=0;
			$arregloHospedaje=array();
			foreach ($habitaciones as $dia => $value) {
				foreach ($value as $tipo => $valor) {
					foreach ($valor as $tarifa => $val) {
						foreach ($val as $cantidad) {
							switch ($tipo) {
								case 'n_hs':
									$tipo = 'habitacion sencilla';
									$arregloHospedaje[$i][$dia][$tipo]=[							
										'cantidad'=>$cantidad,
										'tarifa'=>$tarifa				
									];
								break;
								
								case 'n_hd':
									$tipo = 'habitacion doble';
									$arregloHospedaje[$i][$dia][$tipo]=[							
										'cantidad'=>$cantidad,
										'tarifa'=>$tarifa				
									];
								break;

								case 'n_ht':
									$tipo = 'habitacion triple';
									$arregloHospedaje[$i][$dia][$tipo]=[							
										'cantidad'=>$cantidad,
										'tarifa'=>$tarifa				
									];
								break;

								case 'n_hc':
									$tipo = 'habitacion cuadruple';
									$arregloHospedaje[$i][$dia][$tipo]=[							
										'cantidad'=>$cantidad,
										'tarifa'=>$tarifa				
									];			
								break;			
							}
						}
					}
				}
				$i++;
			}
			$hospedaje = json_encode($arregloHospedaje);
			$idusuario=$_SESSION['iduser'];
			$empresa=limpiarCadena($_POST['empresa']);
			$estado=limpiarCadena($_POST['estado']);
			$municipio=limpiarCadena($_POST['municipio']);
			$email=validarEmail($_POST['email']);
			$telefono=limpiarCadena($_POST['telefono']);
			$coordinador=limpiarCadena($_POST['coordinador']);
			$date_start=$_POST['date_start'];
			$date_end=$_POST['date_end'];
			$noches=$_POST['noches'];
			$dias=$_POST['dias'];
			$total=$_POST['total'];
			$token = bin2hex(openssl_random_pseudo_bytes(128));
			$clave = (!empty($_POST['clave'])) ? $_POST['clave'] : uniqid('CG_');
			$tipo = $_POST['tipo'];
			$now =  date('Y-m-d H:i:s');
			$venc = strtotime($now."+ 30 days");
			$vigencia = date("Y-m-d H:i:s",$venc);
			if (!isset($_POST['servicios'])) {
				$response=[
					'success'=>false,  
					'msg'=> 'La cotizacion no esta completa debe tener servicios aregados'
				];
			}else{
				$rspta = $especial->store($idusuario,$empresa,$estado,$municipio,$email,$telefono,
						$coordinador,$date_start,$date_end,$hospedaje,$noches,$dias,$total,$token,$clave,$tipo,$vigencia,$now,$_POST['servicios']);

				if ($rspta) {
					$response=[
						'success'=>true,  
						'msg'=> 'Cotizacion registrada',
						'idcot'=> $rspta
					];
				}else{
					$response=[
						'success'=>false,  
						'msg'=> 'Algo va mal intenta mas tarde'
					];
				}
			}
		}
		echo json_encode($response);
	break;	

	case 'edit':
		$id = $_POST['id'];
		$id_user = $_SESSION['iduser'];
		$rspta = $especial->edit($id,$id_user);
		if ($rspta) {
			$fc = $rspta['q']->fetch(PDO::FETCH_OBJ);
			if ($fc->hospedaje!="") {				
				$habitaciones = json_decode($fc->hospedaje,true);
				$hospedaje=array();
			    foreach ($habitaciones as $posicion => $value) {
					foreach ($value as $dia => $valor) {
						foreach ($valor as $h => $valores) {
							$hospedaje[$dia][$h]['cantidad']=$valores['cantidad'];
							$hospedaje[$dia][$h]['tarifa']=$valores['tarifa'];				
						}
					}
				}
			}else{
				$hospedaje=[];
			}
			$datos = [
				'folio'=>'C-RM-'.$fc->id,
				'clave'=>$fc->clave,
				'empresa' => $fc->empresa,
				'estado' => $fc->estado,
				'municipio' => $fc->municipio,
				'telefono' => $fc->telefono,
				'correo' => $fc->correo,
				'coordinador' => $fc->coordinador,
				'fecha_entrada' => $fc->fecha_entrada,
				'fecha_salida' => $fc->fecha_salida,
				'noches' => $fc->noches,
				'dias' => $fc->dias,
				'huespedes' => $fc->huespedes,
				'monto' => $fc->monto,
			];
			$response = [
				'success'=>true,  
				'datos' => $datos,
				'hospedaje' => $hospedaje
			];
			echo json_encode($response);
		}else{
			$response=[
					'success'=>false,  
					'msg'=> 'No tienes permisos para editar esta cotizacion'
			];
			echo json_encode($response);
		}	
	break;

	case 'update':
		$habitaciones = $_POST['habitaciones'];
		$i=0;
		$arregloHospedaje=array();
		foreach ($habitaciones as $dia => $value) {
			foreach ($value as $tipo => $valor) {
				foreach ($valor as $tarifa => $val) {
					foreach ($val as $cantidad) {
						switch ($tipo) {
							case 'n_hs':
								$tipo = 'habitacion sencilla';
								$arregloHospedaje[$i][$dia][$tipo]=[							
									'cantidad'=>$cantidad,
									'tarifa'=>$tarifa				
								];
							break;
							
							case 'n_hd':
								$tipo = 'habitacion doble';
								$arregloHospedaje[$i][$dia][$tipo]=[							
									'cantidad'=>$cantidad,
									'tarifa'=>$tarifa				
								];
							break;

							case 'n_ht':
								$tipo = 'habitacion triple';
								$arregloHospedaje[$i][$dia][$tipo]=[							
									'cantidad'=>$cantidad,
									'tarifa'=>$tarifa				
								];
							break;

							case 'n_hc':
								$tipo = 'habitacion cuadruple';
								$arregloHospedaje[$i][$dia][$tipo]=[							
									'cantidad'=>$cantidad,
									'tarifa'=>$tarifa				
								];			
							break;			
						}
					}
				}
			}
			$i++;
		}
		$hospedaje = json_encode($arregloHospedaje);
		$id = $_POST['id'];
		$empresa=limpiarCadena($_POST['empresa']);
		$estado=limpiarCadena($_POST['estado']);
		$municipio=limpiarCadena($_POST['municipio']);
		$email=validarEmail($_POST['email']);
		$telefono=limpiarCadena($_POST['telefono']);
		$coordinador=limpiarCadena($_POST['coordinador']);
		$date_start=$_POST['date_start'];
		$date_end=$_POST['date_end'];
		$noches=$_POST['noches'];
		$dias=$_POST['dias'];
		$total=$_POST['total'];
		$now =  date('Y-m-d H:i:s');
		if (!isset($_POST['servicios'])) {
			$response=[
				'success'=>false,  
				'msg'=> 'La cotizacion no esta completa debe tener servicios aregados'
			];
		}else{
			$rspta = $especial->update($id,$empresa,$estado,$municipio,$email,$telefono,
					$coordinador,$date_start,$date_end,$hospedaje,$noches,$dias,$total,$now,$_POST['servicios']);

			if ($rspta) {
				$response=[
					'success'=>true,  
					'msg'=> 'Cotizacion registrada',
					'idcot'=> $rspta
				];
			}else{
				$response=[
					'success'=>false,  
					'msg'=> 'Algo va mal intenta mas tarde'
				];
			}
		}
		echo json_encode($response);	
	break;
	
}




?>