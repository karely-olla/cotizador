<?php 

session_start();

date_default_timezone_set('America/Monterrey');

require_once '../modelos/Profile.php';
$profile = new Profile();

$data=array();
switch ($_GET['op']) {
	case 'updImage':
		$rspta = $profile->editImage($_FILES['imagen'],$_SESSION['iduser']);
		if ($rspta['success']) {
			$_SESSION['foto'] = $rspta['foto'];
			$response=['success'=>true,'foto'=>$rspta['foto']];		
		}else{
			$response=['success'=>false,'msg'=>'No se pudo actualizar tu foto intenta mas tarde'];
		}	
		echo json_encode($response);
	break;

	case 'updPass':
		$pass = $_POST['pass_actual'];
		$pass_new = $_POST['pass_new'];
		$rspta = $profile->updPass($pass,$pass_new,$_SESSION['iduser']);
		if ($rspta['success']) {
			$response=['success'=>true,'msg'=>'Se actualizo tu contraseña con exito'];
		}else{
			$response=['success'=>false,'msg'=>$rspta['msg']];
		}
		// die(json_encode($_POST));
		echo json_encode($response);
	break;

	case 'stadistics':
		$iduser = $_SESSION['iduser'];
        $months_e = array("January","February","March","April","May","June","July","August","Septembre","October","November","December");
        if (isset($_POST['month']) && !empty($_POST['month'])) {
        	$mes_now = $_POST['month'];
        }else{
	        $mes_actual = date('Y-m-d');
	        $mes_now = $months_e[date('n', strtotime($mes_actual))-1];
        }
        $months = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciciembre");
        $sqlMonts = "SELECT COUNT(*) as num_cots, 
                    (SELECT COUNT(*) FROM cotizaciones as cc WHERE cc.id_usuario='$iduser' && cc.state=0 && MonthName(created_at)='$mes_now') as pendientes, 
                    (SELECT COUNT(*) FROM cotizaciones as cc WHERE cc.id_usuario='$iduser' && cc.state=1 && MonthName(created_at)='$mes_now') as confirmadas,
                    (SELECT COUNT(*) FROM cotizaciones as cc WHERE cc.id_usuario='$iduser' && cc.state=2 && MonthName(created_at)='$mes_now') as anuladas,
                    (SELECT COUNT(*) FROM cotizaciones as cc WHERE cc.id_usuario='$iduser' && cc.state=3 && MonthName(created_at)='$mes_now') as vencidas,  
                    (SELECT SUM(monto) FROM cotizaciones as cc WHERE cc.id_usuario='$iduser') as total, YEAR(created_at) as año FROM cotizaciones as c WHERE year(created_at) = year(curdate()) && id_usuario='$iduser' && MonthName(created_at) = '$mes_now'";
          $result_monts = $con->prepare($sqlMonts);
          $result_monts->execute();	
          $filas = $result_monts->rowCount();
            if ($filas>0) {
	          $cot_by_monts = '';
	          $meses = '';
	          $count_cots = '';
	          $pendientes='';                                                  
	          $confirmadas ='';
	          $anuladas='';
	          $vencidas='';
	          $amount_cots='';
	          while ($fp = $result_monts->fetch(PDO::FETCH_OBJ)) {                   
	            $meses = $meses."'".$months[date('n', strtotime($fp->mes))-1]."',";
	            $count_cots = $count_cots.$fp->num_cots.',';
	            $pendientes = $pendientes.$fp->pendientes.',';
	            $confirmadas = $confirmadas.$fp->confirmadas.',';
	            $anuladas = $anuladas.$fp->anuladas.',';
	            $vencidas = $vencidas.$fp->vencidas.',';
	            $amount_cots=$amount_cots.$fp->total.',';
	          }
	          $meses = substr($meses,0,-1);
	          $count_cots = substr($count_cots,0,-1);
	          $pendientes = substr($pendientes,0,-1);
	          $confirmadas = substr($confirmadas,0,-1);
	          $anuladas = substr($anuladas,0,-1);
	          $vencidas = substr($vencidas,0,-1);
	          $amount_cots = substr($amount_cots,0,-1);
	          $chart = "<div id=\"monts_graph\" style=\"width: 100%; height: 300px;\">
	                    </div>
                    <script>
                      Highcharts.chart('monts_graph', {
			                chart: {
			                    type: 'column',
			                    options3d: {
			                        enabled: true,
			                        alpha: 5,
			                        beta: 25,
			                        depth: 80,
			                        viewDistance: 85
			                    }
			                },
			                title: {
			                    text: 'Cotizaciones por Mes'
			                },
			                subtitle: {
			                    // text: 'Source: WorldClimate.com'
			                },
			                xAxis: {
			                    categories: ['cotizaciones'],
			                    labels: {
			                        skew3d: true,
			                        style: {
			                            fontSize: '16px'
			                        }
			                    },
			                    crosshair: true
			                },
			                yAxis: {
			                    allowDecimals: false,
			                    min: 0,
			                    title: {
			                        text: ''
			                    }
			                },
			                tooltip: {
			                    headerFormat: '<span style=\"font-size:10px\">{point.key}</span><table>',
			                    pointFormat: '<tr><td style=\"color:{series.color};padding:0\">{series.name}: </td>' +
			                        '<td style=\"padding:0\"><b>{point.y:1f} </b></td></tr>',
			                    footerFormat: '</table>',
			                    useHTML: true
			                },
			                plotOptions: {
			                    column: {
			                        depth: 35,
			                        pointPadding: 0.2,
			                        borderWidth: 0,
			                        dataLabels: {
			                            enabled: true
			                        }
			                    }
			                },
			                series: [{
			                    name: 'N° Cotizaciones',
			                    data: [".$count_cots."]

			                },
			                {
			                    name: 'Pendientes',
			                    data: [".$pendientes."]

			                },
			                {
			                    name: 'Confirmadas',
			                    data: [".$confirmadas."]

			                },
			                {
			                    name: 'Anuladas',
			                    data: [".$anuladas."]

			                },
			                {
			                    name: 'Vencidas',
			                    data: [".$vencidas."]

			                }, 
			                {
			                    name: 'Monto Generado',
			                    data: [".$amount_cots."]

			                }]
		              });
		            </script>";
	          $response = [
	          	'success'=>true,
	          	'chart'=>$chart,        	
	          ];

	        }else{
	        	$response=['success'=>false,'msg'=>'No has generado cotizaciones en este Mes'];
	        }

	        echo json_encode($response);
	break;
}

?>