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
    $pdf = new PDF('P','mm','letter');
    $pdf->AliasNbPages();
    // $pdf->SetMargins(10,10,10);
    $pdf->SetRightMargin(0);
    $pdf->AddPage();

    $sqlDptos = "SELECT * FROM departamentos WHERE id_empresa = 105 ";
    $resultados = ejecutarConsulta($sqlDptos);

    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', 'B',14);
    while($f = $resultados->fetch(PDO::FETCH_OBJ)){
        switch ($f->departamento) {
            case 'reception':                
            case 'support':                
            case 'buy':                
            case 'mrs_keys':                
            case 'golf':                
            case 'garden':                            
            case 'sell':
                $pdf->Cell(0,5,$f->departamento,0,1,'L',0);
            break;    
            case 'food':
                $sqlAyB = "SELECT ab.id, ab.id_departamento, ab.id_servicio, 
                                ab.lugar, ab.hora, ab.menu, ab.notas, cd.dia, cd.servicio, cd.cantidad
                             FROM ayb as ab INNER JOIN cotizacion_dia as cd ON ab.id_servicio=cd.id
                         WHERE ab.id_departamento = '$f->id' ORDER BY ab.hora,cd.dia ASC";
                $food = ejecutarConsulta($sqlAyB);
                $filas = $food->rowCount();
                if ($filas>0) {
                $pdf->Cell(0,5,$f->departamento,0,1,'L',0);
                $pdf->SetFont('Arial', 'B',10);
                while($alimentos = $food->fetchAll(PDO::FETCH_OBJ)){
                    $dias = array();
                    foreach ($alimentos as $fs) {
                        $dias[] = $fs->dia;
                    }                      
                    $dias = array_values(array_unique($dias)); 
                    $cont=0; 
                    if (count($dias)==1) {
                            $pdf->SetTextColor(0,0,0);							    
                            // $pdf->Ln(4);
                            $pdf->SetFillColor(196, 137, 169);
                            $pdf->Cell(180,5,$dias[0],1,1,'C',1);
                            $pdf->SetTextColor(0,0,0);
                            $pdf->SetFont('Arial', 'B',14);
                            $pdf->Cell(0,5,$fs->servicio,0,1,'L',0);
                            $pdf->SetFont('Arial', 'B',11);
                            $pdf->Cell(0,5,$fs->lugar,0,1,'L',0);
                            $pdf->Cell(0,5,date('H:i a', strtotime($fs->hora)),0,1,'L',0);
                            $pdf->Cell(0,5,$fs->menu,0,1,'L',0);
                            $notas = json_decode($fs->notas,true);
                            foreach ($notas as $key => $value) {
                                foreach ($value as $nta => $valor) {
                                    foreach ($valor as $nt) {
                                            $pdf->Cell(0,5,$nt,0,1,'L',0);
                                    }                               
                                }
                            }  
                            
                    }else{
                        foreach ($alimentos as $fs): 
                            $dia_actual = $fs->dia; 
                            if ($dia_actual == $dias[$cont]):
                                $pdf->SetTextColor(0,0,0);								    
                                // $pdf->Ln(4);
                                $pdf->SetFillColor(196, 137, 169);
                                $pdf->Cell(180,5,$fs->dia,1,1,'C',1);
                                $pdf->SetTextColor(0,0,0);
                                                                
                                $cont++; 
                                if ($cont == count($dias)) {
                                    $cont = 0;
                                } 
                            endif;								
                            $pdf->SetTextColor(0,0,0);
                            $pdf->SetFont('Arial', 'B',14);
                            $pdf->Cell(0,5,$fs->servicio,0,1,'L',0);
                            $pdf->SetFont('Arial', 'B',11);							    
                            $pdf->Cell(0,5,'Lugar: '.$fs->lugar,0,1,'L',0);
                            $pdf->Cell(0,5,'Hora: '.date('H:i a', strtotime($fs->hora)),0,1,'L',0);
                            $pdf->Cell(0,5,'Menu: '.$fs->menu,0,1,'L',0);
                            $notas = json_decode($fs->notas,true);
                            $pdf->SetFont('Arial', 'B',14);	
                            $pdf->Cell(0,5,'Notas: ',0,1,'L',0);
                            $pdf->SetFont('Arial', 'B',11);	                            
                            foreach ($notas as $key => $value) {
                                foreach ($value as $nta => $valor) {
                                    foreach ($valor as $nt) {
                                        $pdf->Cell(0,5,$nt,0,1,'L',0);
                                    }                               
                                }
                            }
                        endforeach;				      
                    }
                }
                    // while ($fs = $food->fetch(PDO::FETCH_OBJ)) {
                        
                    //     $pdf->Cell(0,5,$fs->lugar,0,1,'L',0);
                    //     $pdf->Cell(0,5,date('H:i a', strtotime($fs->hora)),0,1,'L',0);
                    //     $pdf->Cell(0,5,$fs->menu,0,1,'L',0);
                    //     $notas = json_decode($fs->notas,true);
                    //     foreach ($notas as $key => $value) {
                    //         foreach ($value as $nta => $valor) {
                    //            foreach ($valor as $nt) {
                    //                 $pdf->Cell(0,5,$nt,0,1,'L',0);
                    //            }                               
                    //         }
                    //     }
                    // }                
                }
                $pdf->SetFont('Arial', 'B',14);
            break;
        }
        
    }

    $pdf->Output('Orden-Servicio.pdf','I');

    
?>