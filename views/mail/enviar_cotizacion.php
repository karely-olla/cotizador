<?php 

date_default_timezone_set('America/Monterrey');
// session_start();

require_once '../../config/conexion.php';
require '../../public/fpdf/fpdf.php';

  class PDF extends FPDF
  {
    function RoundedRect($x, $y, $w, $h, $r, $corners = '1234', $style = '')
      {
          $k = $this->k;
          $hp = $this->h;
          if($style=='F')
              $op='f';
          elseif($style=='FD' || $style=='DF')
              $op='B';
          else
              $op='S';
          $MyArc = 4/3 * (sqrt(2) - 1);
          $this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));

          $xc = $x+$w-$r;
          $yc = $y+$r;
          $this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k ));
          if (strpos($corners, '2')===false)
              $this->_out(sprintf('%.2F %.2F l', ($x+$w)*$k,($hp-$y)*$k ));
          else
              $this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);

          $xc = $x+$w-$r;
          $yc = $y+$h-$r;
          $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
          if (strpos($corners, '3')===false)
              $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-($y+$h))*$k));
          else
              $this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);

          $xc = $x+$r;
          $yc = $y+$h-$r;
          $this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
          if (strpos($corners, '4')===false)
              $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-($y+$h))*$k));
          else
              $this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);

          $xc = $x+$r ;
          $yc = $y+$r;
          $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$yc)*$k ));
          if (strpos($corners, '1')===false)
          {
              $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$y)*$k ));
              $this->_out(sprintf('%.2F %.2F l',($x+$r)*$k,($hp-$y)*$k ));
          }
          else
              $this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
          $this->_out($op);
      }

      function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
      {
          $h = $this->h;
          $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
              $x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
      }
    function Header()
    {
      $this->SetMargins(20,10,0);
      $this->SetRightMargin(10);
      $this->SetFont('Arial','B',15);
      $this->SetFillColor(110, 26, 82);
      $this->RoundedRect(0, 0, 100, 10, 8, '3', 'F');
      $this->RoundedRect(0, 9, 10, 170, 5, '33', 'F');
      // $this->SetFillColor(37,164,219);
      $this->SetDrawColor(255);
      $this->SetLineWidth(.5);
      $this->RoundedRect(0, 169, 10, 150, 5, '33', 'F');
      $this->Line(10, 160,0, 175);
      $this->Image('../../public/images/logotipos/logo-rincon-blanco-horizontal.png', 120, 8, 85 );
      $this->Ln(20);
      // $this->Cell(200,1, utf8_decode('Cotización N°1201879'),0,0,'R');
      // $this->Ln(8);
      $this->SetFont('Arial','B',10);
      // $this->Cell(0,7, 'Cotizacion Rincon del Montero',0,0,'C');
      $this->Ln(4);
    }
    function Footer()
    {
      $this->SetY(-20);
      $this->SetFont('Arial','I', 7);
      $this->Cell(0,5, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
    } 

}


  $token=$_POST['k'];
  $sqlUser = "SELECT * FROM usuarios WHERE id =".$_POST['iduser']." ";
  $resU = $con->prepare($sqlUser);
  $resU->execute();
  $fu = $resU->fetch(PDO::FETCH_OBJ);

  $sqlInner = "SELECT * FROM cotizaciones c INNER JOIN cotizacion_dia cd ON c.id=cd.id_empresa WHERE c.token ='$token' && id_usuario = ".$_POST['iduser']." ";
  $resIn = $con->prepare($sqlInner);
  $resIn->execute();
  $filas = $resIn->rowCount();

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
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    $date_hoy =  date('Y-m-d');
    $dia_actual = "Parras de la Fuente, Coah. a ".$dias[date('w', strtotime($date_hoy))]." ".date('d', strtotime($date_hoy))." de ".$meses[date('n', strtotime($date_hoy))-1]. " del ".date('Y', strtotime($date_hoy));
      $pdf->Cell(0,5,$dia_actual,0,1,'R',0);

      $pdf->Cell(100,5,utf8_decode($fh->empresa),0,1,'L',0);
      $pdf->Cell(100,5,'Telefono: '.$fh->telefono,0,1,'L',0);
      $pdf->Cell(100,5,'Procedencia: '.utf8_decode($fh->municipio).', '.utf8_decode($fh->estado).'',0,1,'L',0);
      $pdf->Cell(100,5,'Coordinador: '.utf8_decode($fh->coordinador),0,1,'L',0);
      $pdf->Cell(100,5,'Correo: '.utf8_decode($fh->correo),0,1,'L',0);
      $pdf->Ln(2);
      $pdf->Cell(0,5,utf8_decode('N° C-RM-'.$fh->id),0,1,'R',0);
      if($fh->huespedes!=""){
          $pdf->MultiCell(0,5,utf8_decode('Por medio de la presente reciban un cordial saludo de quienes formamos parte de este su Hotel Rincón del Montero Resort & Golf, agradeciendo su preferencia nos permitimos poner a su consideración la siguiente cotización para su evento:
        Periodo Cotizado: '.$dias[date('w', strtotime($fh->fecha_entrada))]." ".date('d', strtotime($fh->fecha_entrada))." de ".$meses[date('n', strtotime($fh->fecha_entrada))-1]. " del ".date('Y', strtotime($fh->fecha_entrada))." - ".$dias[date('w', strtotime($fh->fecha_salida))]." ".date('d', strtotime($fh->fecha_salida))." de ".$meses[date('n', strtotime($fh->fecha_salida))-1]. " del ".date('Y', strtotime($fh->fecha_salida)).'
        Huespedes Aprox: '.$fh->huespedes), 'J');
      }else{
        $pdf->MultiCell(0,5,utf8_decode('Por medio de la presente reciban un cordial saludo de quienes formamos parte de este su Hotel Rincón del Montero Resort & Golf, agradeciendo su preferencia nos permitimos poner a su consideración la siguiente cotización para su evento:
        Periodo Cotizado: '.$dias[date('w', strtotime($fh->fecha_entrada))]." ".date('d', strtotime($fh->fecha_entrada))." de ".$meses[date('n', strtotime($fh->fecha_entrada))-1]. " del ".date('Y', strtotime($fh->fecha_entrada))." - ".$dias[date('w', strtotime($fh->fecha_salida))]." ".date('d', strtotime($fh->fecha_salida))." de ".$meses[date('n', strtotime($fh->fecha_salida))-1]. " del ".date('Y', strtotime($fh->fecha_salida)) ), 'J');
      }

      $fecha_salida_formateada = $dias[date('w', strtotime($fh->fecha_salida))]." ".date('j', strtotime($fh->fecha_salida))." de ".$meses[date('n', strtotime($fh->fecha_salida))-1];

      $fecha_salida_formateada = str_replace("á", "a", $fecha_salida_formateada);
      $fecha_salida_formateada = str_replace("é", "e", $fecha_salida_formateada);
      // $pdf->Cell(0,7,'Fecha de Salida Formateada: '.$fecha_salida_formateada,0,1,'C',0);

      // $pdf->SetTextColor(252,20,80);
      $pdf->SetFillColor(255,255,253);
      $pdf->SetFont('Arial', 'B',13);
        
        $subtotal_hospedaje=0;
        $subtotal_servicio=0;
        $arregloHospedaje=[];
        if ($fh->tipo=="Special") {
          $sqlServs = "SELECT * FROM  cotizacion_dia cd  WHERE cd.id_empresa =".$fh->id." ";
          $resServs = $con->prepare($sqlServs);
          $resServs->execute();         
          $pdf->Cell(0,7,'Servicios',0,1,'C',1);
            $pdf->Ln(2);
            $pdf->SetFont('Arial', 'B',8);
            $pdf->Cell(50,5,'Servicio',1,0,'C',1);
            $pdf->Cell(50,5,'Precio U.',1,0,'C',1);
            $pdf->Cell(50,5,'Cantidad',1,0,'C',1);
            $pdf->Cell(30,5,'Subtotal',1,1,'C',1);
            // $pdf->Ln(2);
            $pdf->SetTextColor(0,0,0);            
          while($cot = $resServs->fetchAll(PDO::FETCH_OBJ)){
            $dias = array();
                  foreach ($cot as $f) {
                      $dias[] = $f->dia;
                  }
                  
                $dias = array_values(array_unique($dias)); 
                $cont=0; 
                if (count($dias)==1) {
                    $pdf->SetTextColor(0,0,0);                  
                    // $pdf->Ln(4);
                    $pdf->SetFillColor(196, 137, 169);
                    $pdf->Cell(180,5,$dias[0],1,1,'C',1);
                    $pdf->SetTextColor(0,0,0);
                                  
                    foreach ($cot as $f):                       
                        $pdf->SetTextColor(0,0,0);                      
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
                          // $pdf->Ln(4);
                          $pdf->SetFillColor(196, 137, 169);
                          $pdf->Cell(180,5,$f->dia,1,1,'C',1);
                          $pdf->SetTextColor(0,0,0);
                                          
                          $cont++; 
                              if ($cont == count($dias)) {
                                  $cont = 0;
                              } 
                        endif;                
                      $pdf->SetTextColor(0,0,0);                  
                      $subtotal=($f->precio*$f->cantidad);
                        $pdf->Cell(50,5,utf8_decode($f->servicio),1,0,'L',0);
                        $pdf->Cell(50,5,$f->precio,1,0,'C',0);
                        $pdf->Cell(50,5,$f->cantidad,1,0,'C',0);
                        $pdf->Cell(30,5,number_format($f->precio*$f->cantidad,2,'.',','),1,1,'C',0);
                      $subtotal_servicio=($f->precio*$f->cantidad)+$subtotal_servicio;
                  endforeach;             
                }
          }         
            $pdf->SetFont('Arial', 'B',13);
            $pdf->Cell(0,5,'Hospedaje',0,1,'C',0);
            $pdf->Ln(2);
            $pdf->SetFont('Arial', 'B',8);
            $pdf->Cell(50,7,'Habitacion',1,0,'C',0);
            $pdf->Cell(50,7,'Cantidad',1,0,'C',0);
            $pdf->Cell(50,7,'Tarifa',1,0,'C',0);
            $pdf->Cell(30,7,'Subtotal',1,1,'C',0);
            $habitaciones = json_decode($fh->hospedaje,true);
            foreach ($habitaciones as $posicion => $value):
              foreach ($value as $dia => $valor) {
                // $info .= '<tr class="success"><td colspan="4">'.$dia.'</td></tr>';
                $pdf->SetTextColor(0,0,0);                
                    // $pdf->Ln(4);
                    $pdf->SetFillColor(196, 137, 169);
                    $pdf->Cell(180,5,$dia,1,1,'C',1);
                    $pdf->SetTextColor(0,0,0);                  
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

          $pdf->Cell(150,5,'Subtotal:',1,0,'R',0);
          $pdf->Cell(30,5,number_format(round($subtotal_servicio + $subtotal_hospedaje),2,'.',','),1,1,'C',0);
          $pdf->Cell(150,5,'16% IVA:',1,0,'R',0);
          $pdf->Cell(30,5,number_format(round((($subtotal_servicio + $subtotal_hospedaje)*16)/100),2,'.',','),1,1,'C',0);
          $pdf->Cell(150,5,'10% Serv:',1,0,'R',0);
          $pdf->Cell(30,5,number_format(round(($subtotal_servicio*10)/100),2,'.',','),1,1,'C',0);
          $pdf->Cell(150,5,'3% ISH:',1,0,'R',0);
          $pdf->Cell(30,5,number_format(round(($subtotal_hospedaje*3)/100),2,'.',','),1,1,'C',0);
          $pdf->setTextColor(0,121,107);
          $pdf->Cell(150,5,'Total:',1,0,'R',0);
          $pdf->Cell(30,5,number_format(round( ( ( ((($subtotal_hospedaje*16)/100)+$subtotal_hospedaje) ) + ( (($subtotal_hospedaje*3)/100) ) + ( ((($subtotal_servicio*16)/100)+$subtotal_servicio) ) + ( (($subtotal_servicio*10)/100) ))  ),2,'.',','),1,1,'C',0);
          $pdf->setTextColor(0,0,0);
        }else{
          $sqlServs = "SELECT * FROM  cotizacion_dia cd  WHERE cd.id_empresa =".$fh->id." ";
          $resServs = $con->prepare($sqlServs);
          $resServs->execute();
          $filas_servs = $resServs->rowCount();
          if ($filas_servs>0 && $fh->hospedaje!="") {
                $pdf->Cell(0,7,'Servicios y Hospedaje',0,1,'C',1);
                $pdf->Ln(2);
                $pdf->SetFont('Arial', 'B',8);                  
                $pdf->Cell(50,5,'Servicio',1,0,'C',1);
                $pdf->Cell(50,5,'Precio U.',1,0,'C',1);
                $pdf->Cell(50,5,'Cantidad',1,0,'C',1);
                $pdf->Cell(30,5,'Subtotal',1,1,'C',1);
                // $pdf->Ln(2);
                $pdf->SetTextColor(0,0,0);                  
                while($cot = $resServs->fetchAll(PDO::FETCH_OBJ)){
                  $dias = array();
                        foreach ($cot as $f) {
                            $dias[] = $f->dia;
                        }
                        
                      $dias = array_values(array_unique($dias)); 
                      $cont=0; 
                      if (count($dias)==1) {
                          $pdf->SetTextColor(0,0,0);                        
                          // $pdf->Ln(4);
                          $pdf->SetFillColor(196, 137, 169);
                          $pdf->Cell(180,5,$dias[0],1,1,'C',1);
                          $pdf->SetTextColor(0,0,0);
                      if ($fh->hospedaje!="") {
                        $habitaciones = json_decode($fh->hospedaje,true);
                        foreach ($habitaciones as $h => $cantidad) {
                          $cant = ($cantidad['cantidad']=="") ? 0: $cantidad['cantidad'];
                          $subtotal_h = $cant*$cantidad["tarifa"];
                          $pdf->Cell(50,5,$h,1,0,'L',0);
                            $pdf->Cell(50,5,number_format($cantidad["tarifa"],2,'.',','),1,0,'C',0);
                            $pdf->Cell(50,5,$cant,1,0,'C',0);
                            $pdf->Cell(30,5,number_format(($subtotal_h),2,'.',','),1,1,'C',0);
                            $arregloHospedaje[$cont]= $subtotal_hospedaje=$subtotal_hospedaje+($subtotal_h*$fh->noches);
                        }
                      }               
                          foreach ($cot as $f):                       
                              $pdf->SetTextColor(0,0,0);
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
                                // $pdf->Ln(4);
                                $pdf->SetFillColor(196, 137, 169);
                                $pdf->Cell(180,5,$f->dia,1,1,'C',1);
                                $pdf->SetTextColor(0,0,0);
                                if ($f->dia == $fecha_salida_formateada) {

                                }else{
                                  if ($fh->hospedaje!="") {
                                    $habitaciones = json_decode($fh->hospedaje,true);
                                    foreach ($habitaciones as $h => $cantidad) {
                                      $cant = ($cantidad['cantidad']=="") ? 0: $cantidad['cantidad'];
                                      $subtotal_h = $cant*$cantidad["tarifa"];
                                      $pdf->Cell(50,5,$h,1,0,'L',0);
                                        $pdf->Cell(50,5,number_format($cantidad["tarifa"],2,'.',','),1,0,'C',0);
                                        $pdf->Cell(50,5,$cant,1,0,'C',0);
                                        $pdf->Cell(30,5,number_format(($subtotal_h),2,'.',','),1,1,'C',0);
                                        $arregloHospedaje[$cont]= $subtotal_hospedaje=$subtotal_hospedaje+($subtotal_h*$fh->noches);
                                    }
                                  }
                                }
                                $cont++; 
                                if ($cont == count($dias)) {
                                    $cont = 0;
                                } 
                            endif;
                        $pdf->SetTextColor(0,0,0);
                        $subtotal=($f->precio*$f->cantidad);
                          $pdf->Cell(50,5,utf8_decode($f->servicio),1,0,'L',0);
                          $pdf->Cell(50,5,$f->precio,1,0,'C',0);
                          $pdf->Cell(50,5,$f->cantidad,1,0,'C',0);
                          $pdf->Cell(30,5,number_format($f->precio*$f->cantidad,2,'.',','),1,1,'C',0);
                        $subtotal_servicio=($f->precio*$f->cantidad)+$subtotal_servicio;
                        endforeach;             
                      }
                }
                if ($fh->hospedaje!="") {
                  $pdf->Cell(150,5,'Subtotal:',1,0,'R',0);
                  $pdf->Cell(30,5,number_format(round($subtotal_servicio + $arregloHospedaje[0]),2,'.',','),1,1,'C',0);
                  $pdf->Cell(150,5,'16% IVA:',1,0,'R',0);
                  $pdf->Cell(30,5,number_format(round((($subtotal_servicio + $arregloHospedaje[0])*16)/100),2,'.',','),1,1,'C',0);
                  $pdf->Cell(150,5,'10% Serv:',1,0,'R',0);
                  $pdf->Cell(30,5,number_format(round(($subtotal_servicio*10)/100),2,'.',','),1,1,'C',0);
                  $pdf->Cell(150,5,'3% ISH:',1,0,'R',0);
                  $pdf->Cell(30,5,number_format(round(($arregloHospedaje[0]*3)/100),2,'.',','),1,1,'C',0);
                  $pdf->setTextColor(0,121,107);
                  $pdf->Cell(150,5,'Total:',1,0,'R',0);
                  $pdf->Cell(30,5,number_format(round( ( ( ((($arregloHospedaje[0]*16)/100)+$arregloHospedaje[0]) ) + ( (($arregloHospedaje[0]*3)/100) ) + ( ((($subtotal_servicio*16)/100)+$subtotal_servicio) ) + ( (($subtotal_servicio*10)/100) ))  ),2,'.',','),1,1,'C',0);
                }else{
                  $pdf->Cell(150,5,'Subtotal:',1,0,'R',0);
                  $pdf->Cell(30,5,number_format(round($subtotal_servicio),2,'.',','),1,1,'C',0);
                  $pdf->Cell(150,5,'16% IVA:',1,0,'R',0);
                  $pdf->Cell(30,5,number_format(round((($subtotal_servicio)*16)/100),2,'.',','),1,1,'C',0);
                  $pdf->Cell(150,5,'10% Serv:',1,0,'R',0);
                  $pdf->Cell(30,5,number_format(round(($subtotal_servicio*10)/100),2,'.',','),1,1,'C',0);
                  $pdf->setTextColor(0,121,107);
                  $pdf->Cell(150,5,'Total:',1,0,'R',0);
                  $pdf->Cell(30,5,number_format(round( ( ((($subtotal_servicio*16)/100)+$subtotal_servicio) ) + ( (($subtotal_servicio*10)/100) )  ),2,'.',','),1,1,'C',0);
                }
                $pdf->setTextColor(0,0,0);
          }else if($filas_servs>0 && $fh->hospedaje==""){
                $pdf->Cell(0,7,'Servicios',0,1,'C',1);
                  $pdf->Ln(2);
                  $pdf->SetFont('Arial', 'B',8);                  
                  $pdf->Cell(50,5,'Servicio',1,0,'C',1);
                  $pdf->Cell(50,5,'Precio U.',1,0,'C',1);
                  $pdf->Cell(50,5,'Cantidad',1,0,'C',1);
                  $pdf->Cell(30,5,'Subtotal',1,1,'C',1);
                  // $pdf->Ln(2);
                  $pdf->SetTextColor(0,0,0);
                while($cot = $resServs->fetchAll(PDO::FETCH_OBJ)){
                  $dias = array();
                        foreach ($cot as $f) {
                            $dias[] = $f->dia;
                        }
                        
                      $dias = array_values(array_unique($dias)); 
                      $cont=0; 
                      if (count($dias)==1) {
                          $pdf->SetTextColor(0,0,0);
                          // $pdf->Ln(4);
                          $pdf->SetFillColor(196, 137, 169);
                          $pdf->Cell(180,5,$dias[0],1,1,'C',1);
                          $pdf->SetTextColor(0,0,0);          
                          foreach ($cot as $f):                       
                              $pdf->SetTextColor(0,0,0);
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
                                    // $pdf->Ln(4);
                                    $pdf->SetFillColor(196, 137, 169);
                                    $pdf->Cell(180,5,$f->dia,1,1,'C',1);
                                    $pdf->SetTextColor(0,0,0);                    
                                $cont++; 
                                    if ($cont == count($dias)) {
                                        $cont = 0;
                                    } 
                              endif;
                          $pdf->SetTextColor(0,0,0);
                          $subtotal=($f->precio*$f->cantidad);
                            $pdf->Cell(50,5,utf8_decode($f->servicio),1,0,'L',0);
                            $pdf->Cell(50,5,$f->precio,1,0,'C',0);
                            $pdf->Cell(50,5,$f->cantidad,1,0,'C',0);
                            $pdf->Cell(30,5,number_format($f->precio*$f->cantidad,2,'.',','),1,1,'C',0);
                          $subtotal_servicio=($f->precio*$f->cantidad)+$subtotal_servicio;
                        endforeach;             
                      }
                } 
                  $pdf->Cell(150,5,'Subtotal:',1,0,'R',0);
                  $pdf->Cell(30,5,number_format(round($subtotal_servicio),2,'.',','),1,1,'C',0);
                  $pdf->Cell(150,5,'16% IVA:',1,0,'R',0);
                  $pdf->Cell(30,5,number_format(round((($subtotal_servicio)*16)/100),2,'.',','),1,1,'C',0);
                  $pdf->Cell(150,5,'10% Serv:',1,0,'R',0);
                  $pdf->Cell(30,5,number_format(round(($subtotal_servicio*10)/100),2,'.',','),1,1,'C',0);
                  $pdf->setTextColor(0,121,107);
                  $pdf->Cell(150,5,'Total:',1,0,'R',0);
                  $pdf->Cell(30,5,number_format(round( ( ((($subtotal_servicio*16)/100)+$subtotal_servicio) ) + ( (($subtotal_servicio*10)/100) )  ),2,'.',','),1,1,'C',0);              
                  $pdf->setTextColor(0,0,0);
          }else{
                $pdf->Cell(0,7,'Hospedaje',0,1,'C',1);
                $pdf->Ln(2);
                $pdf->SetFont('Arial', 'B',8);                  
                $pdf->Cell(60,5,'Servicio',1,0,'C',1);
                $pdf->Cell(30,5,'Precio U.',1,0,'C',1);
                $pdf->Cell(30,5,'Cantidad',1,0,'C',1);
                $pdf->Cell(30,5,'Noches',1,0,'C',1);
                $pdf->Cell(30,5,'Subtotal',1,1,'C',1);
                // $pdf->Ln(2);
                $pdf->SetTextColor(0,0,0);
                $habitaciones = json_decode($fh->hospedaje,true);
                foreach ($habitaciones as $h => $cantidad) {
                  $cant = ($cantidad['cantidad']=="") ? 0: $cantidad['cantidad'];
                  $subtotal_h = $cant*$cantidad["tarifa"];
                  $pdf->Cell(60,5,$h,1,0,'L',0);
                  $pdf->Cell(30,5,number_format($cantidad["tarifa"],2,'.',','),1,0,'C',0);
                  $pdf->Cell(30,5,$cant,1,0,'C',0);
                  $pdf->Cell(30,5,$fh->noches,1,0,'C',0);
                  $pdf->Cell(30,5,number_format(($subtotal_h*$fh->noches),2,'.',','),1,1,'C',0);
                  $subtotal_hospedaje=$subtotal_hospedaje+($subtotal_h*$fh->noches);
                }
                $pdf->Cell(150,5,'Subtotal:',1,0,'R',0);
                $pdf->Cell(30,5,number_format(round($subtotal_hospedaje),2,'.',','),1,1,'C',0);
                $pdf->Cell(150,5,'16% IVA:',1,0,'R',0);
                $pdf->Cell(30,5,number_format(round((($subtotal_hospedaje)*16)/100),2,'.',','),1,1,'C',0);
                // $pdf->Cell(150,5,'10% Serv:',1,0,'R',0);
                // $pdf->Cell(30,5,number_format(round(($subtotal_servicio*10)/100),2,'.',','),1,1,'C',0);
                $pdf->Cell(150,5,'3% ISH:',1,0,'R',0);
                $pdf->Cell(30,5,number_format(round(($subtotal_hospedaje*3)/100),2,'.',','),1,1,'C',0);
                $pdf->setTextColor(0,121,107);
                $pdf->Cell(150,5,'Total:',1,0,'R',0);
                $pdf->Cell(30,5,number_format(round( ( ( ((($subtotal_hospedaje*16)/100)+$subtotal_hospedaje) ) + ( (($subtotal_hospedaje*3)/100) )  )   ),2,'.',','),1,1,'C',0);
                $pdf->setTextColor(0,0,0);
            }           
        }
        $pdf->setTextColor(0,0,0);

        $pdf->AddPage();
        $pdf->SetFont('Arial','B', 12);
        $pdf->cell(0,5,'Servicios Adicionales',0,1,'C',0);
        $pdf->SetFont('Arial','B', 9);
        $pdf->Ln(2);
        $pdf->MultiCell(0,5,utf8_decode('
                 DESCORCHE
                      Botella de Vino $200.00
                      Botella Nacional $400.00
                      Botella Importada $550.00
                      Carton de Cerveza $200.00
                  Green fee $ 650.00 por persona
                  Cortesía en canchas de tenis y amplios jardines'), 'J');
        $pdf->SetFont('Arial','B', 11);
        $pdf->Ln(10);
        $pdf->cell(0,5,'Servicios Adicionales Externos',0,1,'C',0);
        $pdf->SetFont('Arial','B', 9);
        $pdf->MultiCell(0,5,utf8_decode('
                  SERVICIOS ADICIONALES EXTERNOS
                      - CALLEJONEADA $7,300.00 (50 personas)
                      Recorre la historia de parras, por sus calles y callejones a traves de la musica, acompañados por banda 
                      tradicional o conjunto norteño, vinos y licores de la region. 
                      Duracion 2 Horas

                  - REPRESENTACION DE LA MOLIENDA $7,000.00 (por evento)
                      Vive la tradicion centenaria del pisado de la uva con la participacion 
                      de danza de matachines, venidimiadoras y Dios Baco.
                       Duracion 40 Minutos

                   - RUTA DE VINICOLAS ARTESANALES $450.00 (por persona)
                      Recorrido por Hacienda del Marquez (Viñedo y Bodega, degustacion, tabla de quesos y una copa de vino) y 
                      Recorrido por Las Pudencianas (Viñedo y Bodega y una copa de vino )
                       Duracion 3 Horas

                  - RECORRIDO POR VIÑEDO RIVERO GONZALEZ Y CATA $450.00 (por persona)
                      Recorrido por el viñedo, bodega, sala de embotellado y cava. Degustacion de 3 vinos con sus productos 
                      Gourmet.
                      Duracion 1 Hora 30 Minutos

                  - RECORRIDO POR VIÑEDO DON LEO Y CATA $550.00 (por persona)
                      Recorrido por viñedo, cava y bodega. Cata de 3 vinos con charcuteria. 
                      Duracion de 1 Hora 30 Minutos

                  - RECORRIDO POR CASA MADERO 
                  		Recorrido en Calandria $500.00 (3 personas)
                  		Recorrido en Caballo $300.00 (por persona)
                  		Duracion 30 - 40 Minutos


                  - LAS PUDENCIANAS $1095.00 (por personas)
                      Experiencia "Vino Creacion" 
                      Mesa basica de botanas, experiencia organoleptica para crear ensamble de vino, una botella con 
                      etiqueta personalizada de 750 ml del vino creado
                      Duracion 30 - 40 Minutos

                  - TOUR A CABALLO VISITANDO PETROGLIFOS $715.00 (por persona)
                 	  Lugares a Visitar: Ejido molino viejo y Petrograbados
                      Los paseos se realizan en compañia de un guia, al tranco natural del caballo, el grupo cuenta
                      con una camioneta de apoyo. 
                      Este paseo se realiza a partir de 4 personas
                      Duracion 3 Horas

                  - TOUR A CABALLO CONOCIENDO LOS RINCONCITOS DE PARRAS $715.00 (por persona)
                 	  Lugares a Visitar: Callejones, huertas y nogaleras
                      Los paseos se realizan en compañia de un guia, al tranco natural del caballo, el grupo cuenta
                      con una camioneta de apoyo. 
                      Este paseo se realiza a partir de 4 personas
                      Duracion 3 Horas

                  - TOUR Wine & Horse $975.00 (por persona)
                 	  Vive la experiencia de caballos, vinos y algo mas
                 	  Lugares a Visitar: Huertas y nogaleras, Arroyo el Moron, Arco monumental, 
                 	  Vinicola Las Pudencianas, Visita a viñedos, Visita al hijo del arbol de la noche triste, 
                 	  degustacion de 2 copas de vino, historia de la vitivinicola
                 	  El regreso de la vitivinícola al Hotel Rincon del Montero será en vehículo. 
                      Los paseos se realizan en compañia de un guia, al tranco natural del caballo, el grupo cuenta
                      con una camioneta de apoyo. 
                      Este paseo se realiza a partir de 4 personas
                      Duracion 3 Horas

                  - PASEO A CABALLO POR HACIENDA LOS TORREONES $390.00 (por persona)
                      El paseo se realiza en compañia de un guia. Lugares a visitar: 
                      Arquito de la calle bravo, Acueducto de la loma, Callejon de las Hadas, Arroyo el Moron, 
                      Vestigios de Hacienda los Torreones, Callejones y huertas. 
                      Duracion 2 Horas'), 'J'); 

      $pdf->Ln(10);
      $pdf->AddPage();
      $pdf->SetFont('Arial','B', 14);
      $pdf->Cell(0,7,utf8_decode($fu->nombre.' '.$fu->apellidos),0,1,'C',0);
      $pdf->SetFont('Arial','B', 10);
      $pdf->Cell(0,5,'Ejecutivo de Ventas',0,1,'C',0);
      $pdf->Ln(10);
      $pdf->Image('../../public/images/logotipos/1.png', 16.5, 56, 3.6 );
      $pdf->Cell(100,5,'(842)422-05-40 ext. 1',0,0,'L',0);
      $pdf->Image('../../public/images/logotipos/3.png', 141, 56, 3.6 );
      $pdf->Cell(90,5,$fu->correo,0,0,'R',0);
      $pdf->Ln(5);
      $pdf->Image('../../public/images/logotipos/0.png', 16.5, 61.9, 3.6 );
      $pdf->Cell(100,5,$fu->telefono,0,0,'L',0);
      $pdf->Image('../../public/images/logotipos/2.png', 157.5, 61.9, 3.6 );
      $pdf->Cell(90,5,'www.rincondelmontero.com',0,1,'R',0);

      $pdf->Ln(5);
      $pdf->Cell(0,5,'Politicas',0,1,'L',0);
      $pdf->SetFont('Arial','I', 7);
      $pdf->MultiCell(0,5,utf8_decode(' Check In 4:00 P. M., Check Out 2:00 P. M. 
  Los meseros después de las 11:00 P. M. ocasiona un cargo extra de $170.00 por hora. 
  Anticipo del 50 % con la confirmación del evento y el 50% restante 10 días antes del evento.
  Se requiere de una tarjeta de credito valida al momento de realizar la reservacion para garantizarla. Se aceptan todas las tarjetas
  En caso de no llegar al hotel se cobrara la primer noche de hospedaje con impuestos incluidos como penalizacion de No Show
  No se aceptan mascotas'), 'J'); 
      $pdf->Ln(5);
      $pdf->SetFont('Arial', 'B',9);
      $pdf->Cell(100,5,'Datos Bancarios: Banco Bancomer',0,0,'L',0);
      $pdf->Cell(90,5,'Datos Fiscales:',0,1,'R',0);
      $pdf->Cell(100,5,' Banco Bancomer',0,0,'L',0);
      $pdf->Cell(90,5,'Rincon del Montero S.A. de C.V.',0,1,'R',0);
      $pdf->Cell(100,5,'Numero de Cuenta: 0145 99 2656',0,0,'L',0);
      $pdf->Cell(90,5,'RFC: RMO631125FU3',0,1,'R',0);
      $pdf->Cell(100,5,'Clabe interbancaria: 012060001459926568',0,0,'L',0);
      $pdf->Cell(90,5,'Calle: Paseo del Campestre #389',0,1,'R',0);
      $pdf->Cell(100,5,'Rincon del Montero S.A. de C.V.',0,0,'L',0);
      $pdf->Cell(90,5,'Colonia: Fracc. Campestre la Rosita',0,1,'R',0);
      $pdf->Cell(190,5,'Codigo Postal: 27250',0,1,'R',0);
      $pdf->Cell(190,5,'Torreon Coahuila',0,0,'R',0);

    $filenamePDF = $fu->nombre.'_C-RM-'.$fh->id.'.pdf';
    $archivo_ruta = '../../pdf_cotizaciones/'.$filenamePDF;      
    $pdf->Output($archivo_ruta,'F');

    $sqlSaveFile = "UPDATE cotizaciones SET file='$filenamePDF' WHERE id = '$fh->id' ";
    $resultSave=$con->prepare($sqlSaveFile);
    $resultSave->execute();

$datos = array();

require 'PHPMailerAutoload.php';

   $mail = new PHPMailer;

   //$mail->SMTPDebug = 3;                               // Enable verbose debug output
   $correo = $fh->correo;
   $correo2 = "jesus.edu2122@gmail.com";
   $correo3 = "karely.olmos@rincondelmontero.com";
   $remitente = 'cotizaciones@cotizador.com';
   $nombre = 'Cotizaciones RM';

   $mail->IsSMTP();     
   $mail->SMTPDebug  = 0;                     // Set mailer to use SMTP
   $mail->Host = 'cotizador.rincondelmontero.com';  // Specify main and backup SMTP servers
   $mail->SMTPAuth = true;                               // Enable SMTP authentication
   $mail->Username = 'cotizaciones@rincondelmontero.com';                 // SMTP username
   $mail->Password = 'RMC2018*';                           // SMTP password
   $mail->Port = 465;                                    // TCP port to connect to
   $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted

   $mail->SetFrom($remitente, $nombre);
	// $mail->addAddress($correo2);
   $mail->addAddress($correo);
   $mail->addAddress($correo3);
   // $mail->addAddress($correo4);
   $archivo = 'Cotizacion_RM.pdf';
   $mail->AddAttachment($archivo_ruta,$archivo);
   // $mail->addAddress($correo);

   $mail->IsHTML(true);
   $mail->Subject = utf8_decode('Cotizacion Rincon del Montero');
   $cuerpo='
        <!DOCTYPE html>
        <html lang="es">
        <head>
          <meta charset="UTF-8">
          <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
          <style type="text/css">
              *,body{
                font-family: Open Sans, sans-serif;
              }
              .container{
                  width: 100%;
                  max-width: 800px;
                  height: 420px;
                  margin: 20px auto;
                  background: #EDECE6;
              }
              .logo{
                  width: 100%;
                  max-width: 300px;
                  display: block;
                  margin: 0 auto;
              }
              .logo img{
                  width: 100%;
                  display: block;
              }
              .cabecera{
                  background: #6E1A52;
                  height: 200px;
                  padding: 10px;
                  position: relative;
              }
              .embed_img{
                  width: 100%;
                  position: absolute;
                  bottom: -180px;
                  left: 0;
                  text-align: center;
              }
              .embed_img img{
                  width: 100%;
                  max-width: 400px;
                  height: 250px;
                  margin: 0 auto;
                  display: block;
                  box-shadow: 1px 0px 10px 4px rgba(0,0,0,.6);
              }
              .text{
                  width: 100%;
                  max-width: 600px;
                  margin: 10px auto;
                  color: #fff;
                  font-size: 15px;
                  text-align: center;
              }
          </style>
          </head>
        <body>
            <div class="container">
                  <div class="cabecera">
                      <div class="logo">
                          <img src="http://cotizador.rincondelmontero.com/images/logotipos/logo-rincon-blanco-horizontal.png" alt="Logotipo" class="logotipo">
                      </div>
                      <p class="text">
                          '.utf8_decode('Por medio de la presente reciban un cordial saludo de quienes formamos parte de este su Hotel Rincón del Montero Resort & Golf, agradeciendo su preferencia nos permitimos poner a su consideración la siguiente cotización para su evento:').'
                      </p>
                      <div class="embed_img">
                          <img src="http://cotizador.rincondelmontero.com/images/017_hotel_jardin_interior.jpg">
                      </div>
                  </div>  
            </div>
        </body>
        </html> ';

   $mail->Body = $cuerpo; 
   // Definimos AltBody por si el destinatario (quien recive) del correo no admite email con formato html, es decir recibirá este mensaje si el servidor de correo al que enviamos el mensaje no puede admitir html
   $mail->AltBody = $cuerpo;

   if(!$mail->send()) {
      $datos['success'] = false;
      $datos['msg'] = "<p>EL correo no se pudo enviar</p>";
   } else {
      $datos['success'] = true;
      $datos['msg'] = "<p>EL correo se Envio Exitosamente</p>";
       
   }

echo json_encode($datos);

?>