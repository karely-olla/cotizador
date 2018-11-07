<?php 

date_default_timezone_set('America/Monterrey');
// session_start();

require_once '../../config/conexion.php';

$sqlUpdEmp = "UPDATE cotizaciones SET hora_entrada = '".$_POST['hour_came']."', hora_salida='".$_POST['hour_out']."' 
                    WHERE id = '".$_POST['id_empresa']."' ";
        ejecutarConsulta($sqlUpdEmp);
    function insertDpto($dpto, $posicion)
    {
        $n = 0;
        $arregloNotas = array();
        $departamento = $dpto;
        foreach ($_POST['note_' . $departamento] as $nota) {
            $arregloNotas[$departamento][$n] = [
                'nota' => $nota
            ];
            $n++;
            if ($nota == "") {

            } else {
            }
        }
        $sqlDptos = "INSERT INTO `departamentos`(`id_empresa`, `departamento`,  `descripcion`, `notas`) 
                            VALUES ('".$_POST['id_empresa']."','" . $_POST['areas'][$posicion]."',
                            '".$_POST['description'][$posicion] . "','" . json_encode($arregloNotas) . "')";
        ejecutarConsulta($sqlDptos);
    }
    // var_dump($_POST);
    // die();

    for ($i=0; $i <count($_POST['areas']) ; $i++) { 
        switch ($_POST['areas'][$i]) {
            case 'reception':                
            case 'support':                
            case 'buy':                
            case 'mrs_keys':                
            case 'golf':                
            case 'garden':                            
            case 'sell':
                insertDpto($_POST['areas'][$i], $i);
            break;    
            case 'food':
                $sqlDptos = "INSERT INTO `departamentos`(`id_empresa`, `departamento`,  `descripcion`, `notas`) 
                        VALUES ('".$_POST['id_empresa']."','".$_POST['areas'][$i]."','','')";
                $id_departamento = retornarID($sqlDptos);
                for ($j=0; $j <count($_POST['id_servicio']) ; $j++) { 
                    $sql = "INSERT INTO `ayb`(`id_departamento`, `id_servicio`, `lugar`, `hora`, `menu`) VALUES 
                            ('$id_departamento', '".$_POST['id_servicio'][$j]."', '".$_POST['place'][$j]."', 
                             '".$_POST['hour'][$j]."', '".$_POST['menu'][$j]."')";
                    $result = ejecutarConsulta($sql);    
                }
                if($result){
                    $n =0;
                    $arregloNotas = array();
                    foreach ($_POST['note_food'] as $id => $value) {
                        // echo $id."<br>";
                        foreach ($value as $nota) {
                            $arregloNotas['notas'][] = [
                                'nota' => $nota
                            ];                
                            $n++;
                        }
                        if ($nota =="") {                            
                        }else{
                            $sqlUpd = "UPDATE `ayb` SET `notas`= '".json_encode($arregloNotas)."' WHERE id_servicio = '$id' ";
                            $result2 = ejecutarConsulta($sqlUpd);
                            $arregloNotas = array();
                        }
                    }
                    // echo"<pre>";
                    //     var_dump($arregloNotas);
                    // echo"</pre>";
                    // echo  "se inserto con exito <br>";
                }else {
                    // echo "no se inserto ni madres <br>";
                }
            break;
        }
    }

require '../../public/fpdf/fpdf.php';
class PDF extends FPDF
{
    function RoundedRect($x, $y, $w, $h, $r, $corners = '1234', $style = '')
    {
        $k = $this->k;
        $hp = $this->h;
        if ($style == 'F')
            $op = 'f';
        elseif ($style == 'FD' || $style == 'DF')
            $op = 'B';
        else
            $op = 'S';
        $MyArc = 4 / 3 * (sqrt(2) - 1);
        $this->_out(sprintf('%.2F %.2F m', ($x + $r) * $k, ($hp - $y) * $k));

        $xc = $x + $w - $r;
        $yc = $y + $r;
        $this->_out(sprintf('%.2F %.2F l', $xc * $k, ($hp - $y) * $k));
        if (strpos($corners, '2') === false)
            $this->_out(sprintf('%.2F %.2F l', ($x + $w) * $k, ($hp - $y) * $k));
        else
            $this->_Arc($xc + $r * $MyArc, $yc - $r, $xc + $r, $yc - $r * $MyArc, $xc + $r, $yc);

        $xc = $x + $w - $r;
        $yc = $y + $h - $r;
        $this->_out(sprintf('%.2F %.2F l', ($x + $w) * $k, ($hp - $yc) * $k));
        if (strpos($corners, '3') === false)
            $this->_out(sprintf('%.2F %.2F l', ($x + $w) * $k, ($hp - ($y + $h)) * $k));
        else
            $this->_Arc($xc + $r, $yc + $r * $MyArc, $xc + $r * $MyArc, $yc + $r, $xc, $yc + $r);

        $xc = $x + $r;
        $yc = $y + $h - $r;
        $this->_out(sprintf('%.2F %.2F l', $xc * $k, ($hp - ($y + $h)) * $k));
        if (strpos($corners, '4') === false)
            $this->_out(sprintf('%.2F %.2F l', ($x) * $k, ($hp - ($y + $h)) * $k));
        else
            $this->_Arc($xc - $r * $MyArc, $yc + $r, $xc - $r, $yc + $r * $MyArc, $xc - $r, $yc);

        $xc = $x + $r;
        $yc = $y + $r;
        $this->_out(sprintf('%.2F %.2F l', ($x) * $k, ($hp - $yc) * $k));
        if (strpos($corners, '1') === false) {
            $this->_out(sprintf('%.2F %.2F l', ($x) * $k, ($hp - $y) * $k));
            $this->_out(sprintf('%.2F %.2F l', ($x + $r) * $k, ($hp - $y) * $k));
        } else
            $this->_Arc($xc - $r, $yc - $r * $MyArc, $xc - $r * $MyArc, $yc - $r, $xc, $yc - $r);
        $this->_out($op);
    }

    function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
    {
        $h = $this->h;
        $this->_out(sprintf(
            '%.2F %.2F %.2F %.2F %.2F %.2F c ',
            $x1 * $this->k,
            ($h - $y1) * $this->k,
            $x2 * $this->k,
            ($h - $y2) * $this->k,
            $x3 * $this->k,
            ($h - $y3) * $this->k
        ));
    }
    function Header()
    {
        $this->SetMargins(20, 10, 0);
        $this->SetRightMargin(10);
        $this->SetFont('Arial', 'B', 15);
        $this->SetFillColor(110, 26, 82);
        $this->RoundedRect(0, 0, 100, 10, 8, '3', 'F');
        $this->RoundedRect(0, 9, 10, 170, 5, '33', 'F');
			// $this->SetFillColor(37,164,219);
        $this->SetDrawColor(255);
        $this->SetLineWidth(.5);
        $this->RoundedRect(0, 169, 10, 150, 5, '33', 'F');
        $this->Line(10, 160, 0, 175);
        $this->Image('../../public/images/logotipos/logo-rincon-blanco-horizontal.png', 120, 8, 85);
        $this->Ln(20);
			// $this->Cell(200,1, utf8_decode('Cotización N°1201879'),0,0,'R');
			// $this->Ln(8);
        $this->SetFont('Arial', 'B', 10);
			// $this->Cell(0,7, 'Cotizacion Rincon del Montero',0,0,'C');
        $this->Ln(4);
    }
    function Footer()
    {
        $this->SetY(-20);
        $this->SetFont('Arial', 'I', 7);
        $this->Cell(0, 5, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

    $token=$_POST['token'];
    $id=$_POST['id_empresa'];


    $pdf = new PDF('P','mm','letter');
    $pdf->AliasNbPages();
    // $pdf->SetMargins(10,10,10);
    $pdf->SetRightMargin(0);
    $pdf->AddPage();
    $sqlInner = "SELECT * FROM cotizaciones c  WHERE c.token ='$token' && id = '$id' ";
    $resIn = $con->prepare($sqlInner);
    $resIn->execute();

    $fh = $resIn->fetch(PDO::FETCH_OBJ);

    $sqlUser = "SELECT * FROM usuarios WHERE id ='$fh->id_usuario' ";
    $resUser = $con->prepare($sqlUser);
    $resUser->execute();
    $fus = $resUser->fetch(PDO::FETCH_OBJ);

    // $pdf->Cell(100,5,'id:            '.utf8_decode($fh->id_usuario),0,1,'L',0);
    $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    $pdf->Cell(100,5,'Grupo:            '.utf8_decode($fh->empresa),0,1,'L',0);
    $pdf->Cell(100,5,'Procedencia: '.utf8_decode($fh->municipio).', '.utf8_decode($fh->estado).'',0,1,'L',0);
    $pdf->Cell(100,5,'Llegada:         '.$dias[date('w', strtotime($fh->fecha_entrada))] . " " . date('d', strtotime($fh->fecha_entrada)) . " de " . $meses[date('n', strtotime($fh->fecha_entrada)) - 1] . " del " . date('Y', strtotime($fh->fecha_entrada))." ".$fh->hora_entrada,0,1,'L',0);
    $pdf->Cell(100,5,'Salida:            '.$dias[date('w', strtotime($fh->fecha_salida))] . " " . date('d', strtotime($fh->fecha_salida)) . " de " . $meses[date('n', strtotime($fh->fecha_salida)) - 1] . " del " . date('Y', strtotime($fh->fecha_salida))." ".$fh->hora_salida,0,1,'L',0);
    $pdf->Cell(100,5,'Coordinador: '.utf8_decode($fh->coordinador),0,1,'L',0);
    $pdf->Cell(100,5,'Telefono:        '.$fh->telefono,0,1,'L',0);
    $pdf->Cell(100,5,'Correo:           '.utf8_decode($fh->correo),0,1,'L',0);
    $pdf->Cell(100, 5,utf8_decode('N° Personas: '.$fh->huespedes), 0, 1, 'L', 0);

    $pdf->Ln(15);
    
    $sqlDptos = "SELECT * FROM departamentos WHERE id_empresa = '$id' ";
    $resultados = ejecutarConsulta($sqlDptos);

    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', 'B',14);
    while($f = $resultados->fetch(PDO::FETCH_OBJ)){
        switch ($f->departamento) {
            case 'reception':
                $pdf->Cell(0, 5,'Recepcion', 0, 1, 'L', 0);
                $pdf->SetFont('Arial', '', 10);
                $pdf->MultiCell(0,5,utf8_decode('Tienen reservadas '.$fh->total_rooms.' habitaciones de las cuales:'), 'J');
                // $habitaciones = json_decode($fh->hospedaje,true);
                if ($fh->hospedaje!="") {
                    $habitaciones = json_decode($fh->hospedaje,true);
                    foreach ($habitaciones as $h => $cantidad) {
                      $cant = ($cantidad['cantidad']=="") ? 0: $cantidad['cantidad'];
                      $pdf->Cell(50,5,$cant,1,0,'C',0);
                      $pdf->Cell(50,5,$h,1,1,'L',0);
                      }
                  }       
                  $pdf->Ln(5);
                  $pdf->SetFont('Arial', '', 10);
                  $pdf->MultiCell(0,5,utf8_decode('Estaran disponibles a partir de las 16:00 y con salida a las 14:00'), 'J');
                  $pdf->SetFont('Arial', '', 11);
                  $pdf->Cell(0, 5, 'Notas: ', 0, 1, 'L', 0);
                  $pdf->SetFont('Arial', '', 10);
                $notas=json_decode($f->notas, true);
                if ($notas != "") {
                    foreach ($notas as $key => $value) {
                        foreach ($value as $nta => $valor) {
                            foreach ($valor as $nt) {
                                $pdf->Cell(0, 5, '        ' . $nt, 0, 1, 'L', 0);
                            }
                        }
                    }
                }
                $pdf->Ln(5);
            break;
            
            case 'food':
                $sqlAyB = "SELECT ab.id, ab.id_departamento, ab.id_servicio, 
                                    ab.lugar, ab.hora, ab.menu, ab.notas, cd.dia, cd.servicio, cd.cantidad
                                FROM ayb as ab INNER JOIN cotizacion_dia as cd ON ab.id_servicio=cd.id
                            WHERE ab.id_departamento = '$f->id'";
                $food = ejecutarConsulta($sqlAyB);
                $filas = $food->rowCount();
                if ($filas > 0) {
                    $pdf->SetFont('Arial', 'B',14);
                    $pdf->Cell(0, 5, 'Alimentos y Bebidas:', 0, 1, 'L', 0);
                    $pdf->SetFont('Arial', 'B', 10);
                    while ($alimentos = $food->fetchAll(PDO::FETCH_OBJ)) {
                        $dias = array();
                        foreach ($alimentos as $fs) {
                            $dias[] = $fs->dia;
                        }
                        $dias = array_values(array_unique($dias));
                        $cont = 0;
                        if (count($dias) == 1) {
                            $pdf->SetTextColor(0, 0, 0);
                            $pdf->SetFont('Arial', 'B', 14);
                            $pdf->Cell(0, 5, $fs->servicio, 0, 1, 'L', 0);
                            $pdf->SetFont('Arial', 'B', 11);
                            $pdf->Cell(0, 5, 'Lugar: ' . $fs->lugar, 0, 1, 'L', 0);
                            $pdf->Cell(0, 5, 'Hora: ' . date('H:i a', strtotime($fs->hora)), 0, 1, 'L', 0);
                            $pdf->Cell(0, 5, 'Menu: ' . $fs->menu, 0, 1, 'L', 0);
                            $notas = json_decode($fs->notas, true);
                            $pdf->SetFont('Arial', 'B', 11);
                            $pdf->Cell(0, 5, 'Notas: ', 0, 1, 'L', 0);
                            $pdf->SetFont('Arial', 'B', 11);
                            foreach ($notas as $key => $value) {
                                foreach ($value as $nta => $valor) {
                                    foreach ($valor as $nt) {
                                        $pdf->Cell(0, 5, $nt, 0, 1, 'L', 0);
                                    }
                                }
                            }

                        } else {
                            foreach ($alimentos as $fs) :
                                $dia_actual = $fs->dia;
                            $pdf->SetFont('Arial', 'B', 12);
                            if ($dia_actual == $dias[$cont]) :
                                $pdf->SetTextColor(0, 0, 0);								    
                                        // $pdf->Ln(4);
                            $pdf->SetFillColor(196, 137, 169);
                            $pdf->Cell(0, 5, '           ' . $fs->dia . ':', 0, 1, 'L', 0);
                            $pdf->SetTextColor(0, 0, 0);

                            $cont++;
                            if ($cont == count($dias)) {
                                $cont = 0;
                            }
                            endif;
                            $pdf->SetTextColor(0, 0, 0);
                            $pdf->SetFont('Arial', 'B', 11);
                            $pdf->Cell(0, 5, '               ' . $fs->servicio, 0, 1, 'L', 0);
                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Cell(0, 5, '                     Lugar: ' . $fs->lugar, 0, 1, 'L', 0);
                            $pdf->Cell(0, 5, '                     Hora: ' . date('H:i a', strtotime($fs->hora)), 0, 1, 'L', 0);
                            $pdf->Cell(0, 5, '                     Menu: ' . $fs->menu, 0, 1, 'L', 0);
                            $notas = json_decode($fs->notas, true);
                            $pdf->SetFont('Arial', '', 11);
                            $pdf->Cell(0, 5, '                 Notas: ', 0, 1, 'L', 0);
                            $pdf->SetFont('Arial', '', 10);
                            if ($notas != "") {
                                foreach ($notas as $key => $value) {
                                    foreach ($value as $nta => $valor) {
                                        foreach ($valor as $nt) {
                                            $pdf->Cell(0, 5, '                        ' . $nt, 0, 1, 'L', 0);
                                        }
                                    }
                                }
                            }
                            $pdf->Ln(5);
                            endforeach;
                        }
                    }
                }
                $pdf->SetFont('Arial', 'B', 14);
            break;           
            case 'support':
                $pdf->Cell(0,5,'Mantenimiento',0,1,'L',0);
                $pdf->SetFont('Arial', '', 11);
                $pdf->Cell(0,5,$f->descripcion,0,1,'L',0);
                $pdf->SetFont('Arial', '', 11);
                            $pdf->Cell(0, 5, '  Notas: ', 0, 1, 'L', 0);
                            $pdf->SetFont('Arial', '', 11);
                $notas=json_decode($f->notas, true);
                if ($notas != "") {
                    foreach ($notas as $key => $value) {
                        foreach ($value as $nta => $valor) {
                            foreach ($valor as $nt) {
                                $pdf->Cell(0, 5, '        ' . $nt, 0, 1, 'L', 0);
                            }
                        }
                    }
                }
            break;                 
            case 'buy':
            $pdf->Cell(0,5,'Compras',0,1,'L',0);
            $pdf->SetFont('Arial', '', 11);
            $pdf->Cell(0,5,$f->descripcion,0,1,'L',0);
            $pdf->SetFont('Arial', '', 11);
                        $pdf->Cell(0, 5, '  Notas: ', 0, 1, 'L', 0);
                        $pdf->SetFont('Arial', '', 11);
            $notas=json_decode($f->notas, true);
            if ($notas != "") {
                foreach ($notas as $key => $value) {
                    foreach ($value as $nta => $valor) {
                        foreach ($valor as $nt) {
                            $pdf->Cell(0, 5, '        ' . $nt, 0, 1, 'L', 0);
                        }
                    }
                }
            }
            break;                 
            case 'mrs_keys':
            $pdf->Cell(0,5,'Ama de Llaves',0,1,'L',0);
            $pdf->SetFont('Arial', '', 11);
            $pdf->Cell(0,5,$f->descripcion,0,1,'L',0);
            $pdf->SetFont('Arial', '', 11);
                        $pdf->Cell(0, 5, '  Notas: ', 0, 1, 'L', 0);
                        $pdf->SetFont('Arial', '', 11);
            $notas=json_decode($f->notas, true);
            if ($notas != "") {
                foreach ($notas as $key => $value) {
                    foreach ($value as $nta => $valor) {
                        foreach ($valor as $nt) {
                            $pdf->Cell(0, 5, '        ' . $nt, 0, 1, 'L', 0);
                        }
                    }
                }
            }
            break;                 
            case 'golf':
            $pdf->Cell(0,5,'Campo de Golf',0,1,'L',0);
            $pdf->SetFont('Arial', '', 11);
            $pdf->Cell(0,5,$f->descripcion,0,1,'L',0);
            $pdf->SetFont('Arial', '', 11);
                        $pdf->Cell(0, 5, '  Notas: ', 0, 1, 'L', 0);
                        $pdf->SetFont('Arial', '', 11);
            $notas=json_decode($f->notas, true);
            if ($notas != "") {
                foreach ($notas as $key => $value) {
                    foreach ($value as $nta => $valor) {
                        foreach ($valor as $nt) {
                            $pdf->Cell(0, 5, '        ' . $nt, 0, 1, 'L', 0);
                        }
                    }
                }
            }
            break;                 
            case 'garden':
            $pdf->Cell(0,5,'Jardineria',0,1,'L',0);
                $pdf->SetFont('Arial', '', 11);
                $pdf->Cell(0,5,$f->descripcion,0,1,'L',0);
                $pdf->SetFont('Arial', '', 11);
                            $pdf->Cell(0, 5, '  Notas: ', 0, 1, 'L', 0);
                            $pdf->SetFont('Arial', '', 11);
                $notas=json_decode($f->notas, true);
                if ($notas != "") {
                    foreach ($notas as $key => $value) {
                        foreach ($value as $nta => $valor) {
                            foreach ($valor as $nt) {
                                $pdf->Cell(0, 5, '        ' . $nt, 0, 1, 'L', 0);
                            }
                        }
                    }
                }
            break;                             
            case 'sell':
            $pdf->Cell(0,5,'Ventas',0,1,'L',0);
                $pdf->SetFont('Arial', '', 11);
                $pdf->Cell(0,5,$f->descripcion,0,1,'L',0);
                $pdf->SetFont('Arial', '', 11);
                            $pdf->Cell(0, 5, '  Notas: ', 0, 1, 'L', 0);
                            $pdf->SetFont('Arial', '', 11);
                $notas=json_decode($f->notas, true);
                if ($notas != "") {
                    foreach ($notas as $key => $value) {
                        foreach ($value as $nta => $valor) {
                            foreach ($valor as $nt) {
                                $pdf->Cell(0, 5, '        ' . $nt, 0, 1, 'L', 0);
                            }
                        }
                    }
                }
            break;    
        } 
    }
    $pdf->AddPage();
    $pdf->Image('../../public/images/signature/'.$fus->firma, 97, 40, 40);
    $pdf->SetY(58);
    $pdf->Cell(0, 5,$fus->nombre.' '.$fus->apellidos, 0, 1, 'C', 0);
    $pdf->Cell(0, 5, 'Ejecutivo de Ventas', 0, 1, 'C', 0);
    $pdf->Ln(30);
    $pdf->Cell(0,5,''.utf8_decode($fh->coordinador),0,1,'C',0);
    $pdf->Cell(0, 5, 'Coordinador(a)', 0, 1, 'C', 0);
    $filenamePDF = "orden_c-rm-".$id."_".date('d-m-Y').".pdf";
    $archivo_ruta = '../../orden_servicio/'.$filenamePDF;      
    $pdf->Output($archivo_ruta,'F');

    
    if($result){
        $sql = "UPDATE cotizaciones SET `state` = 1, `orden` = '$filenamePDF' WHERE id=".$id." ";
        $upd = $con->prepare($sql);
        $upd->execute();
        $f = $upd->rowCount();
            if ($f>0) {
                $response=[
                    'exito'=>true,
                    'msg'=>'Orden Generada'
                ];
            }else{
                $response=[
                    'exito'=>false,
                    'msg'=>'No se Genero la orden'
                ];
            }				
    }else{
        $response=[
            'exito'=>false,
            'msg'=>'Hubo un error, intenta mas tarde'
        ];
    }
    echo json_encode($response);
?>