<?php

	session_start();
	
	require_once '../config/conexion.php';

	include 'plantilla_interna.php';
	$token=$_GET['k'];
	$sqlUser = "SELECT * FROM usuarios WHERE id =".$_SESSION['iduser']." ";
	$resU = $con->prepare($sqlUser);
	$resU->execute();
	$fu = $resU->fetch(PDO::FETCH_OBJ);

	$sqlInner = "SELECT * FROM cotizaciones c INNER JOIN cotizacion_dia cd ON c.id=cd.id_empresa WHERE c.token ='$token' ";
	$resIn = $con->prepare($sqlInner);
	$resIn->execute();	

	    $pdf = new PDF('P','mm','letter');
	    $pdf->AliasNbPages();
	    // $pdf->SetMargins(10,10,10);
	    $pdf->SetRightMargin(0);
	    $pdf->AddPage();

	    $pdf->SetTextColor(0,0,0);
	    $pdf->SetFont('Arial', 'B',10);
	    // $pdf->SetFillColor(192);
		// $pdf->RoundedRect(60, 30, 68, 46, 5, '13', 'DF');
	    
		$info='';
		$subtotal=0;
		$subtotal_servicio =0;
		$subtotal_hospedaje=0;
		$sql = "SELECT * FROM cotizaciones WHERE token = '$token' ";
		$res = $con->prepare($sql);
		$res->execute();
		$fh = $res->fetch(PDO::FETCH_OBJ);
	    $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
		$meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sept","Oct","Nov","Dic");
		$date_hoy =  date('Y-m-d');
		$dia_actual = "Parras de la Fuente, Coah. a ".$dias[date('w', strtotime($date_hoy))]." ".date('d', strtotime($date_hoy))." de ".$meses[date('n', strtotime($date_hoy))-1]. " del ".date('Y', strtotime($date_hoy));
	    $pdf->Cell(0,5,$dia_actual,0,1,'R',0);
	    
	    $pdf->Cell(0,5,'Grupo / Empresa:',0,1,'L',0);
	    $pdf->Cell(100,5,utf8_decode($fh->empresa),0,1,'L',0);
	    $pdf->Cell(100,5,'Telefono: '.$fh->telefono,0,1,'L',0);
	    $pdf->Cell(100,5,'Procedencia: '.utf8_decode($fh->municipio).', '.utf8_decode($fh->estado).'',0,1,'L',0);
	    $pdf->Cell(100,5,'Coordinador: '.utf8_decode($fh->coordinador),0,1,'L',0);
	    $pdf->Cell(100,5,'Correo: '.utf8_decode($fh->correo),0,1,'L',0);
	    $pdf->Ln(2);
	    $pdf->Cell(0,5,utf8_decode('Folio C-RM-'.$fh->id),0,1,'R',0);
	    if($fh->huespedes!=""){
		    $pdf->MultiCell(0,5,utf8_decode('Periodo Cotizado: '.$dias[date('w', strtotime($fh->fecha_entrada))]." ".date('d', strtotime($fh->fecha_entrada))." de ".$meses[date('n', strtotime($fh->fecha_entrada))-1]. " del ".date('Y', strtotime($fh->fecha_entrada))." - ".$dias[date('w', strtotime($fh->fecha_salida))]." ".date('d', strtotime($fh->fecha_salida))." de ".$meses[date('n', strtotime($fh->fecha_salida))-1]. " del ".date('Y', strtotime($fh->fecha_salida)).'
			Huespedes Aprox: '.$fh->huespedes), 'J');
		}else{
			$pdf->MultiCell(0,5,utf8_decode('Periodo Cotizado: '.$dias[date('w', strtotime($fh->fecha_entrada))]." ".date('d', strtotime($fh->fecha_entrada))." de ".$meses[date('n', strtotime($fh->fecha_entrada))-1]. " del ".date('Y', strtotime($fh->fecha_entrada))." - ".$dias[date('w', strtotime($fh->fecha_salida))]." ".date('d', strtotime($fh->fecha_salida))." de ".$meses[date('n', strtotime($fh->fecha_salida))-1]. " del ".date('Y', strtotime($fh->fecha_salida)) ), 'J');
		}
		$fecha_salida_formateada = $dias[date('w', strtotime($fh->fecha_salida))]." ".date('j', strtotime($fh->fecha_salida))." de ".$meses[date('n', strtotime($fh->fecha_salida))-1];

	    $fecha_salida_formateada = str_replace("á", "a", $fecha_salida_formateada);
	    $fecha_salida_formateada = str_replace("é", "e", $fecha_salida_formateada);

	    // $pdf->SetTextColor(252,20,80);
	    $pdf->SetFillColor(255,255,253);
	    $pdf->SetFont('Arial', 'B',13);
	    
	    
	    $sqlServs = "SELECT * FROM  cotizacion_dia cd  WHERE cd.id_empresa =".$fh->id." ";
		$resServs = $con->prepare($sqlServs);
		$resServs->execute();
		$filas_servs = $resServs->rowCount();
		if ($filas_servs>0) {
			$pdf->Cell(0,7,'Servicios',0,1,'C',1);
		    $pdf->Ln(4);
		    $pdf->SetFont('Arial', 'B',8);
		    $pdf->Cell(50,5,'Servicio',1,0,'C',1);
		    $pdf->Cell(50,5,'Precio U.',1,0,'C',1);
		    $pdf->Cell(50,5,'Cantidad',1,0,'C',1);
		    $pdf->Cell(30,5,'Subtotal',1,1,'C',1);
		    // $pdf->Ln(2);
		    $pdf->SetTextColor(0,0,0);
		    $pdf->SetFont('Arial', 'B',8);
			while($cot = $resIn->fetchAll(PDO::FETCH_OBJ)){
				$dias = array();
		          foreach ($cot as $f) {
		              $dias[] = $f->dia;
		          }
		          
		        $dias = array_values(array_unique($dias)); 
		        $cont=0; 
		        if (count($dias)==1) {
		        	$pdf->SetTextColor(0,0,0);
				    $pdf->SetFont('Arial', 'B',10);
		        	// $pdf->Ln(4);
		        	$pdf->SetFillColor(196, 137, 169);
		        	$pdf->Cell(180,5,$dias[0],1,1,'C',1);
		        	$pdf->SetTextColor(0,0,0);
		        	$pdf->SetFont('Arial', 'B',9);
												
		        	foreach ($cot as $f): 							        
							$pdf->SetTextColor(0,0,0);
						    $pdf->SetFont('Arial', 'B',9);
							$subtotal=($f->precio*$f->cantidad);
								$pdf->Cell(50,5,utf8_decode($f->servicio),1,0,'L',0);
								$pdf->Cell(50,5,$f->precio,1,0,'C',0);
								$pdf->Cell(50,5,$f->cantidad,1,0,'C',0);
								$pdf->Cell(30,5,number_format($f->precio*$f->cantidad,2,'.',','),1,1,'C',0);
							$subtotal_servicio=($f->precio*$f->cantidad)+$subtotal_servicio;
					endforeach;
		        }else{
			        foreach ($cot as $f): 
				        $dia_actual = $f->dia; 
				        if ($dia_actual == $dias[$cont]):
				        	$pdf->SetTextColor(0,0,0);
						    $pdf->SetFont('Arial', 'B',10);
				        	// $pdf->Ln(4);
				        	$pdf->SetFillColor(196, 137, 169);
				        	$pdf->Cell(180,5,$f->dia,1,1,'C',1);
				        	$pdf->SetTextColor(0,0,0);
				        	$pdf->SetFont('Arial', 'B',9);
							
							$cont++; 
					        if ($cont == count($dias)) {
					            $cont = 0;
					        } 
						endif;
						$pdf->SetTextColor(0,0,0);
					    $pdf->SetFont('Arial', 'B',9);
						$subtotal=($f->precio*$f->cantidad);
							$pdf->Cell(50,5,utf8_decode($f->servicio),1,0,'L',0);
							$pdf->Cell(50,5,$f->precio,1,0,'C',0);
							$pdf->Cell(50,5,$f->cantidad,1,0,'C',0);
							$pdf->Cell(30,5,number_format($f->precio*$f->cantidad,2,'.',','),1,1,'C',0);
						$subtotal_servicio=($f->precio*$f->cantidad)+$subtotal_servicio;
					endforeach;				      
		        }
			}
			// $pdf->Ln(2);
			$pdf->SetFont('Arial', 'B',8);
			$pdf->Cell(150,3.6,'Servicios:',1,0,'R',0);
			$pdf->Cell(30,3.6,number_format($subtotal_servicio,2,'.',','),1,1,'C',0);
			$pdf->Cell(150,3.6,'16% IVA:',1,0,'R',0);
			$pdf->Cell(30,3.6,number_format(round(($subtotal_servicio*16)/100),2,'.',','),1,1,'C',0);
			$pdf->Cell(150,3.6,'10% Serv:',1,0,'R',0);
			$pdf->Cell(30,3.6,number_format(round(($subtotal_servicio*10)/100),2,'.',','),1,1,'C',0);
			$pdf->Cell(150,3.6,'Subtotal:',1,0,'R',0);
			$pdf->Cell(30,3.6,number_format(round( ( ((($subtotal_servicio*16)/100)+$subtotal_servicio) ) + ( (($subtotal_servicio*10)/100) )  ),2,'.',','),1,1,'C',0);
			$pdf->Ln(2);	
		}	
			

			$pdf->SetFont('Arial', 'B',13);
		    if ($fh->hospedaje!="") {
		    	$habitaciones = json_decode($fh->hospedaje,true);
		    	if ($fh->tipo=="Special") {
		    		$pdf->Cell(0,5,'Hospedaje',0,1,'C',0);
		    		$pdf->Ln(2);
				    $pdf->SetFont('Arial', 'B',8);
				    $pdf->Cell(50,5,'Habitacion',1,0,'C',0);
				    $pdf->Cell(50,5,'Cantidad',1,0,'C',0);
				    $pdf->Cell(50,5,'Tarifa',1,0,'C',0);
				    $pdf->Cell(30,5,'Subtotal',1,1,'C',0);
		    		foreach ($habitaciones as $posicion => $value):
						foreach ($value as $dia => $valor) {
							// $info .= '<tr class="success"><td colspan="4">'.$dia.'</td></tr>';
							$pdf->SetTextColor(0,0,0);
						    $pdf->SetFont('Arial', 'B',10);
				        	// $pdf->Ln(4);
				        	$pdf->SetFillColor(196, 137, 169);
				        	$pdf->Cell(180,5,$dia,1,1,'C',1);
				        	$pdf->SetTextColor(0,0,0);
				        	$pdf->SetFont('Arial', 'B',9);
							foreach ($valor as $h => $valores) {
								$subtotal_h = $valores['cantidad']*$valores["tarifa"];
								$pdf->Cell(50,4.6,$h,1,0,'L',0);
								$pdf->Cell(50,4.6,$valores['cantidad'],1,0,'C',0);
								$pdf->Cell(50,4.6,number_format($valores["tarifa"],2,'.',','),1,0,'C',0);
								$pdf->Cell(30,4.6,number_format(($valores['cantidad']*$valores["tarifa"]),2,'.',','),1,1,'C',0);
								$subtotal_hospedaje = $subtotal_hospedaje + $subtotal_h;							
							}
						}
					endforeach;
					$pdf->SetFont('Arial', 'B',8);
					$pdf->Cell(150.3,3.6,'Hospedaje:',1,0,'R',0);
					$pdf->Cell(30,3.6,number_format(round($subtotal_hospedaje),2,'.',','),1,1,'C',0);
					$pdf->Cell(150.3,3.6,'16% IVA:',1,0,'R',0);
					$pdf->Cell(30,3.6,number_format(round(($subtotal_hospedaje*16)/100),2,'.',','),1,1,'C',0);
					$pdf->Cell(150.3,3.6,'3% ISH:',1,0,'R',0);
					$pdf->Cell(30,3.6,number_format(round(($subtotal_hospedaje*3)/100),2,'.',','),1,1,'C',0);
					$pdf->Cell(150.3,3.6,' Subtotal:',1,0,'R',0);
					$pdf->Cell(30,3.6,number_format(round( ( ((($subtotal_hospedaje*16)/100)+$subtotal_hospedaje) ) + ( (($subtotal_hospedaje*3)/100) )  ),2,'.',','),1,1,'C',0);
		    	}else{
				    $pdf->Cell(0,5,'Hospedaje',0,1,'C',0);
				    $pdf->Ln(2);
				    $pdf->SetFont('Arial', 'B',8);
				    $pdf->Cell(37.6,5,'Habitacion',1,0,'C',0);
				    $pdf->Cell(37.6,5,'Cantidad',1,0,'C',0);
				    $pdf->Cell(37.6,5,'Noches',1,0,'C',0);
				    $pdf->Cell(37.6,5,'Tarifa',1,0,'C',0);
				    $pdf->Cell(30,5,'Subtotal',1,1,'C',0);
				    $pdf->SetFont('Arial', 'B',9);
					foreach ($habitaciones as $h => $cantidad) {
						$cant = ($cantidad['cantidad']=="") ? 0: $cantidad['cantidad'];
						$subtotal_h = $cant*$cantidad["tarifa"];
						$pdf->Cell(37.6,3.6,$h,1,0,'L',0);
						$pdf->Cell(37.6,3.6,$cant,1,0,'C',0);
						$pdf->Cell(37.6,3.6,$fh->noches,1,0,'C',0);
						$pdf->Cell(37.6,3.6,number_format($cantidad["tarifa"],2,'.',','),1,0,'C',0);
						$pdf->Cell(30,3.6,number_format(($subtotal_h*$fh->noches),2,'.',','),1,1,'C',0);
						$subtotal_hospedaje = $subtotal_hospedaje+ ($subtotal_h*$fh->noches);
					}
					$pdf->SetFont('Arial', 'B',8);
					$pdf->Cell(150.3,3.6,'Hospedaje:',1,0,'R',0);
					$pdf->Cell(30,3.6,number_format(round($subtotal_hospedaje),2,'.',','),1,1,'C',0);
					$pdf->Cell(150.3,3.6,'16% IVA:',1,0,'R',0);
					$pdf->Cell(30,3.6,number_format(round(($subtotal_hospedaje*16)/100),2,'.',','),1,1,'C',0);
					$pdf->Cell(150.3,3.6,'3% ISH:',1,0,'R',0);
					$pdf->Cell(30,3.6,number_format(round(($subtotal_hospedaje*3)/100),2,'.',','),1,1,'C',0);
					$pdf->Cell(150.3,3.6,' Subtotal:',1,0,'R',0);
					$pdf->Cell(30,3.6,number_format(round( ( ((($subtotal_hospedaje*16)/100)+$subtotal_hospedaje) ) + ( (($subtotal_hospedaje*3)/100) )  ),2,'.',','),1,1,'C',0);
		    	}
		    }


		$sqlExtras = "SELECT * FROM extras WHERE id_empresa = '$fh->id' ";
		$resultExtras = $con->prepare($sqlExtras);
		$resultExtras->execute();
		$filasExtras = $resultExtras->rowCount();
	    $suma_extras = 0;
		if ($filasExtras>0) {
			
			$pdf->Ln(2);
			$pdf->SetFont('Arial', 'B',13);
		    $pdf->Cell(0,5,'Extras',0,1,'C',0);
		    $pdf->Ln(2);
		    $pdf->SetFont('Arial', 'B',8);
		    $pdf->Cell(60,5,'Dia de Consumo',1,0,'C',0);
		    $pdf->Cell(90.3,5,'Servicio',1,0,'C',0);
		    $pdf->Cell(30,5,'Costo',1,1,'C',0);
			while ($fe = $resultExtras->fetch(PDO::FETCH_OBJ)) {
				$suma_extras = $suma_extras + $fe->costo;
				$pdf->Cell(60,5,$fe->dia,1,0,'C',0);
			    $pdf->Cell(90.3,5,$fe->servicio,1,0,'C',0);
			    $pdf->Cell(30,5,$fe->costo,1,1,'C',0);
			}
		}
		$pdf->SetFont('Arial', 'B',9);
		$pdf->Cell(150.1,4.6,'Total:',1,0,'R',0);
		$pdf->Cell(30,4.6,number_format(round( ( ( ((($subtotal_hospedaje*16)/100)+$subtotal_hospedaje) ) + ( (($subtotal_hospedaje*3)/100) ) + ( ((($subtotal_servicio*16)/100)+$subtotal_servicio) ) + ( (($subtotal_servicio*10)/100) ) ) + $suma_extras  ),2,'.',','),1,1,'C',0);


		$pdf->Ln(5);
		$pdf->SetFont('Arial','B', 14);
		$pdf->Cell(0,7,utf8_decode($_SESSION['name']),0,1,'C',0);
		$pdf->SetFont('Arial','B', 10);
		$pdf->Cell(0,5,'Ejecutivo de Ventas',0,1,'C',0);
		$pdf->Ln(10);
		$pdf->Cell(100,5,'Tel. '.$fu->telefono,0,0,'L',0);
		$pdf->Cell(90,5,'Correo: '.utf8_decode($fu->correo),0,0,'R',0);

		$pdf->SetFont('Arial','I', 8);
		// $pdf->Cell(0,5,,0,0,'R',0);
		// $pdf->MultiCell(0,5,utf8_decode('Las habitaciones se entregan a las 4:00 P. M. y se desocupan a las 2:00 P. M. Los meseros después de las 11:00 P. M. ocasiona un cargo extra de $170.00 por hora, Anticipo del 50 % con la confirmación del evento y el 50% restante 10 días antes del evento, depositando a la cuenta de Bancomer No. 014 599 2656 a nombre del Rincón del Montero S. A.'), 'J');			
	    $pdf->Output('Cotizacion.pdf','I');


