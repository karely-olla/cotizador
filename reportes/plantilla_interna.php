<?php
	
	require '../public/fpdf/fpdf.php';
	
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
			$this->Image('../public/images/logotipos/logo-rincon-blanco-horizontal.png', 120, 8, 85 );
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
// 			$this->MultiCell(0,3,utf8_decode('Las habitaciones se entregan a las 4:00 P. M. y se desocupan a las 2:00 P. M. 
// Los meseros después de las 11:00 P. M. ocasiona un cargo extra de $170.00 por hora. 
// Anticipo del 50 % con la confirmación del evento y el 50% restante 10 días antes del evento, depositando a la cuenta de Bancomer No. 014 599 2656 a nombre del Rincón del Montero S. A.'), 'J');
			$this->Cell(0,5, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}	

	}
?>