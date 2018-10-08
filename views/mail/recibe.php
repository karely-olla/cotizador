<?php 

date_default_timezone_set('America/Monterrey');

require '../../fpdf/fpdf.php';
  
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
      $this->SetFillColor(74,194,88);
      $this->RoundedRect(0, 0, 100, 10, 8, '3', 'F');
      $this->RoundedRect(0, 9, 10, 170, 5, '33', 'F');
      // $this->SetFillColor(37,164,219);
      $this->SetDrawColor(255);
      $this->SetLineWidth(.5);
      $this->RoundedRect(0, 169, 10, 150, 5, '33', 'F');
      $this->Line(10, 160,0, 175);
      $this->Image('../../images/logotipos/logo-rincon-blanco-horizontal.png', 120, 8, 85 );
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
      $this->MultiCell(0,3,utf8_decode('Las habitaciones se entregan a las 4:00 P. M. y se desocupan a las 2:00 P. M. 
Los meseros después de las 11:00 P. M. ocasiona un cargo extra de $170.00 por hora. 
Anticipo del 50 % con la confirmación del evento y el 50% restante 10 días antes del evento, depositando a la cuenta de Bancomer No. 014 599 2656 a nombre del Rincón del Montero S. A.'), 'J');
      $this->Cell(0,5, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
    } 

}


$pdf = new PDF('P','mm','letter');
$pdf->AliasNbPages();
// $pdf->SetMargins(10,10,10);
$pdf->SetRightMargin(0);
$pdf->AddPage();

$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', 'B',15);
$pdf->Ln(5);
$archivo_ruta ='../../pdf_cotizaciones/C-RM-1_Cotizacion_silvia.pdf';

$pdf->Output($archivo_ruta,'F');

$datos = array();

require 'PHPMailerAutoload.php';

   $mail = new PHPMailer;

   //$mail->SMTPDebug = 3;                               // Enable verbose debug output
   $correo2 = "jesus.edu2122@gmail.com";
   $correo = "kry_ol@hotmail.com";
   $correo3 = "karely.olmos@rincondelmontero.com";
   $remitente = 'cotizaciones@rincondelmontero.com';
   $nombre = 'Cotizador - RM';

   $mail->IsSMTP();     
   $mail->SMTPDebug  = 0;                     // Set mailer to use SMTP
   $mail->Host = 'cotizador.rincondelmontero.com';  // Specify main and backup SMTP servers
   $mail->SMTPAuth = true;                               // Enable SMTP authentication
   $mail->Username = 'cotizaciones@rincondelmontero.com';                 // SMTP username
   $mail->Password = 'RMC2018*';                           // SMTP password
   $mail->Port = 465;                                    // TCP port to connect to
   $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted

   $mail->SetFrom($remitente, $nombre);
   $mail->addAddress($correo2);
   $mail->addAddress($correo);
   $mail->addAddress($correo3);
   $archivo = 'Cotizacion_RM.pdf';
   $mail->AddAttachment($archivo_ruta,$archivo);
   // $mail->addAddress($correo);

   $mail->IsHTML(true);
   $mail->Subject = utf8_decode('Cotizacion RM');
   $cuerpo='
        <!DOCTYPE html>
        <html lang="es">
        <head>
           <meta charset="UTF-8">
           <title>Document</title>
           <style>
              .conten{
                 width: 100%;
                 max-width: 800px;
                 margin: 0 auto;
                 text-align: center;
              }
              .conten h2,
              .conten h5{
                 width: 100%;
                 text-align: center;
                 font-size: 25px;
                 margin: 5px 0px;
              }
              .conten h5{
                 font-size: 20px;
              }
              .conten ul{
                 width: 100%;
                 max-width: 350px;
                 margin: auto;
                 list-style: none;
                 width: 100%;
                 text-align: left;
                 font-size: 18px;
              }
           </style>
        </head>
        <body>
           <div class="conten">
              <img src="http://utparras.edu.mx/images/object1164517127.png" width="162px" heigth="127px">
              <h2>Asunto: </h2>
              <h5>Datos del ññññ áéíóú remitente:</h5>
              <ul>
                 <li><strong>Nombre:</strong> eduardo facio</li>
                 <li><strong>Correo:</strong> jeusq@gmail.com</li>
                 <li><strong>Telefono:</strong> 876576567</li>
              </ul>
              <h5>Mensaje:</h5>
              <h5>mensaje aqui va el chido</h5>
           </div>
        </body>
        </html> ';

   $mail->Body = $cuerpo; 
   // Definimos AltBody por si el destinatario (quien recive) del correo no admite email con formato html, es decir recibirá este mensaje si el servidor de correo al que enviamos el mensaje no puede admitir html
   $mail->AltBody = $cuerpo;

   if(!$mail->send()) {
       $datos['exito'] = false;
        $datos['m'] = "<p>EL correo no se envio</p>";
   } else {
       $datos['exito'] = true;
        $datos['m'] = "<p>EL correo se Envio Exitosamente</p>";
       
   }

echo json_encode($datos);

?>