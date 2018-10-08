<?php require './layouts/auth.php'; ?>
<?php require './layouts/header.php'; ?>
<?php require './layouts/barra.php'; ?>
<?php require './layouts/navegacion.php'; ?>


<?php 

if (isset($_GET['months']) && !empty($_GET['months'])) {
	$mes_now = $_GET['months'];
}else{
	$months_e = array("January","February","March","April","May","June","July","August","September","October","November","December");
    $mes_actual = date('Y-m-d');
	$mes_now = $months_e[date('n', strtotime($mes_actual))-1];
}


?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <!-- <h1>
        Blank page
        <small>it all starts here</small>
      </h1> -->
    </section>

    <!-- Main content -->
    <section class="content">
       <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Estadisticas en contrucción <i class="fa fa-cogs"></i></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Cerrar/Abrir">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <ul class="nav nav-tabs" role="tablist">
              <li role="presentation"><a href="#cotizaciones" aria-controls="cotizaciones" role="tab" data-toggle="tab"><i class="fa fa-pie-chart"></i> Cotizaciones</a></li>
              <li role="presentation" class="active"><a href="#ejecutivos" aria-controls="ejecutivos" role="tab" data-toggle="tab"><i class="fa fa-users"></i> Ejecutivos</a></li>
              <li role="presentation" ><a href="#procedencia" aria-controls="procedencia" role="tab" data-toggle="tab"><i class="fa fa-bar-chart"></i> Procedencia</a></li>
          </ul>

            <!-- Tab panes -->
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane" id="cotizaciones">
                  <?php 
                      require_once '../config/conexion.php';
                      $sql_c = "SELECT DISTINCT state, (SELECT COUNT(state) FROM cotizaciones WHERE state =1) as confirmadas, (SELECT COUNT(state) FROM cotizaciones WHERE state =0) as pendientes, (SELECT COUNT(state) FROM cotizaciones WHERE state =2) as anuladas, (SELECT COUNT(state) FROM cotizaciones WHERE state =3) as vencidas FROM cotizaciones as c";
                        $result_cot = $con->prepare($sql_c);
                        $result_cot->execute();
                        $cotizaciones = '';
                        $totales_cuentas='';

                        while ($r = $result_cot->fetch(PDO::FETCH_OBJ)) { 
                          if ($r->state=='0') {
                            $name = 'Pendientes';
                            $num = $r->pendientes;
                          }elseif ($r->state=='1') {
                            $name = 'Confirmadas';
                            $num = $r->confirmadas;
                          }elseif ($r->state=='2') {
                            $name = 'Anuladas';
                            $num = $r->anuladas;
                          }elseif ($r->state=='3') {
                            $name = 'Vencidas';
                            $num = $r->vencidas;
                          }
                      //     sliced: true,
                      // selected: true
                          $cotizaciones=$cotizaciones."{ name: '".$name."', y: ".$num.', sliced: true, selected: true},';
                        } 
                         $cotizaciones=substr($cotizaciones, 0, -1);
                    ?>
                      <div id="container" style="min-width: 320px; height: 500px;">
                      </div>
              </div>
              <div role="tabpanel" class="tab-pane active" id="ejecutivos">
                <br>
                <div class="col-lg-12">
                	<div class="col-lg-3">
                		<form action="http://cotizador.rincondelmontero.com/views/index.php" id="frm_select_report" method="GET">
	                		<select name="months" id="months_names" onchange="showReport()" class="pull-right form-control selectpicker" title="Elige el mes para el reporte">
	                			
	                		</select>
                		</form>
                	</div>
                </div>
                <div class="row">
                    <?php
                      $users = "SELECT * FROM usuarios WHERE state =1 && rol <> 'admin'";
                      $result = $con->prepare($users);
                      $result->execute();
                      $months = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiember","Octubre","Noviembre","Diciembre");
                      
                      $mesesAll='';
                      while ($user = $result->fetch(PDO::FETCH_OBJ)) {
                          
                          $sql = "SELECT DISTINCT (SELECT nombre FROM usuarios WHERE id = c.id_usuario) as usuario, 
                          (SELECT COUNT(*) FROM cotizaciones as cc WHERE cc.id_usuario='$user->id' && cc.state=0 && MonthName(created_at)='$mes_now') as pendientes, 
                          (SELECT COUNT(*) FROM cotizaciones as cc WHERE cc.id_usuario='$user->id' && cc.state=1 && MonthName(created_at)='$mes_now') as confirmadas,
                          (SELECT COUNT(*) FROM cotizaciones as cc WHERE cc.id_usuario='$user->id' && cc.state=2 && MonthName(created_at)='$mes_now') as anuladas,
                          (SELECT COUNT(*) FROM cotizaciones as cc WHERE cc.id_usuario='$user->id' && cc.state=3 && MonthName(created_at)='$mes_now') as vencidas,  (SELECT SUM(monto) FROM cotizaciones as cc WHERE cc.id_usuario='$user->id' && cc.state=1 && MonthName(created_at)='$mes_now') as total, YEAR(created_at) as año FROM cotizaciones as c WHERE year(created_at) = year(curdate()) && id_usuario='$user->id' && MonthName(created_at) = '$mes_now' ";
                            $result_ejecutivo = $con->prepare($sql);
                            $result_ejecutivo->execute();
                            $cot_by_monts = '';
                            $meses[$user->nombre] = '';
                            $pendientes[$user->nombre] = '';
                            $confirmadas[$user->nombre] = '';
                            $anuladas[$user->nombre] = '';
                            $vencidas[$user->nombre] = '';
                            $amount_cots[$user->nombre]='';
                            while ($fp = $result_ejecutivo->fetch(PDO::FETCH_OBJ)) {                   
                              $meses[$user->nombre] = $meses[$user->nombre]."'".$months[date('n', strtotime($fp->mes))-1]."',";                   
                              $pendientes[$user->nombre] = $pendientes[$user->nombre].$fp->pendientes.',';
                              $confirmadas[$user->nombre] = $confirmadas[$user->nombre].$fp->confirmadas.',';
                              $anuladas[$user->nombre] = $anuladas[$user->nombre].$fp->anuladas.',';
                              $vencidas[$user->nombre] = $vencidas[$user->nombre].$fp->vencidas.',';
                              $amount_cots[$user->nombre]=$amount_cots[$user->nombre].$fp->total.',';
                            }
                            // $mesesAll .=$meses[$user->nombre] = substr($meses[$user->nombre],0,-1);
                            $mesesAll .=$pendientes[$user->nombre] = substr($pendientes[$user->nombre],0,-1);
                            $confirmadas[$user->nombre] = substr($confirmadas[$user->nombre],0,-1);
                            $anuladas[$user->nombre] = substr($anuladas[$user->nombre],0,-1);
                            $vencidas[$user->nombre] = substr($vencidas[$user->nombre],0,-1);
                            $amount_cots[$user->nombre] = substr($amount_cots[$user->nombre],0,-1);
                    ?>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <h3 class="title-cat"><?=$user->nombre?></h3>
                            <div id="monts_ejecutivo_<?=$user->nombre?>" style="min-width: 100%; height: 300px;"></div>
                          </div>
                          <script type="text/javascript">
                              Highcharts.setOptions({
                                  colors: ['#FF9800','#50B432', '#E22622', '#777777','#058DC7', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4']
                              });
                              Highcharts.chart('monts_ejecutivo_<?=$user->nombre?>', {
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
                                    text: 'Estadisticas'
                                },
                                subtitle: {
                                    // text: 'Source: WorldClimate.com'
                                },
                                xAxis: {
                                    categories: ['Cotizaciones' ],
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
                                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                        '<td style="padding:0"><b>{point.y:1f} </b></td></tr>',
                                    footerFormat: '</table>',
                                    useHTML: true
                                },
                                plotOptions: {
                                    column: {
                                        depth: 25,
                                        pointPadding: 0.2,
                                        borderWidth: 0,
                                        dataLabels: {
                                            enabled: true
                                        }
                                    }
                                },
                                series: [{
                                    name: 'cotizaciones',
                                    data: [<?=$pendientes[$user->nombre]?>]
                                }, 
                                {
                                    name: 'Confirmadas',
                                    data: [<?=$confirmadas[$user->nombre]?>]

                                }, 
                                {
                                    name: 'Anuladas',
                                    data: [<?=$anuladas[$user->nombre]?>]

                                }, 
                                {
                                    name: 'Vencidas',
                                    data: [<?=$vencidas[$user->nombre]?>]

                                },
                                {
                                    name: 'Monto Ingresado',
                                    data: [<?=$amount_cots[$user->nombre]?>]

                                }]
                              });
                          </script>
                    <?php 
                        }
                      // var_dump($mesesAll);
                    ?>                  
                </div>
              </div>   
              <div role="tabpanel" class="tab-pane" id="procedencia">
                  <?php 
                      $sqlProce = "SELECT DISTINCT concat(municipio,', ',estado) as procedencia, COUNT(concat(municipio,', ',estado)) as numero FROM `cotizaciones` GROUP BY concat(municipio,', ',estado)";
                        $result_proce = $con->prepare($sqlProce);
                        $result_proce->execute();
                        $cot_by_procedencia = '';

                        while ($fp = $result_proce->fetch(PDO::FETCH_OBJ)) { 
                          $cot_by_procedencia=$cot_by_procedencia."{ name: '".$fp->procedencia."', y: ".$fp->numero.', sliced: true, selected: true},';
                        } 
                         $cot_by_procedencia=substr($cot_by_procedencia, 0, -1);
                    ?>
                      <div id="procedencia_graph" style="min-width: 320px; height: 500px;">
                      </div>                      
              </div>             
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<?php include './layouts/footer.php'; ?>
<script type="text/javascript">
  function showReport(){
  	$("#frm_select_report").trigger('submit');
  }
  function getMonths(){
  		$.post('../controllers/CotizacionController.php?op=getMonths',  function(data) {
  			/*optional stuff to do after success */
  			console.log(data);
  			$("#months_names").html(data);
  			$("#months_names").selectpicker('refresh');
  		});
  }
  getMonths();

        

  Highcharts.setOptions({
      colors: ['#D32F2F','#50B432','#058DC7', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4',    '#FFE4C4',       '#0000FF',       '#8A2BE2',       '#A52A2A',       '#DEB887',       '#5F9EA0',       '#7FFF00',       '#D2691E',       '#FF7F50',       '#6495ED',       '#FFF8DC',       '#DC143C',       '#00FFFF',       '#00008B',       '#008B8B',       '#B8860B',       '#A9A9A9',       '#006400',       '#A9A9A9',       '#BDB76B',       '#8B008B',       '#556B2F',       '#FF8C00',       '#9932CC',       '#8B0000',       '#E9967A',       '#8FBC8F',       '#483D8B',       '#2F4F4F',       '#2F4F4F',       '#00CED1',       '#9400D3',       '#FF1493',       '#00BFFF',       '#696969',       '#696969',       '#1E90FF',       '#B22222',       '#FFFAF0',       '#228B22',       '#FF00FF',       '#DCDCDC',       '#F8F8FF',       '#FFD700',       '#DAA520',       '#808080',       '#008000',       '#ADFF2F',       '#808080',       '#F0FFF0',       '#FF69B4',       '#CD5C5C',       '#4B0082',       '#FFFFF0',       '#F0E68C',       '#E6E6FA',       '#FFF0F5',       '#7CFC00',       '#FFFACD',       '#ADD8E6',       '#F08080',       '#E0FFFF',       '#FAFAD2',       '#D3D3D3',       '#90EE90',       '#D3D3D3',       '#FFB6C1',       '#FFA07A',       '#20B2AA',       '#87CEFA',       '#778899',       '#778899',       '#B0C4DE',       '#FFFFE0',       '#00FF00',       '#32CD32',       '#FAF0E6',       '#FF00FF',       '#800000',       '#66CDAA',       '#0000CD',       '#BA55D3',       '#9370D8',       '#3CB371',       '#7B68EE',       '#00FA9A',       '#48D1CC',       '#C71585',       '#191970',       '#F5FFFA',       '#FFE4E1',       '#FFE4B5',       '#FFDEAD',       '#000080',       '#FDF5E6',       '#808000',       '#6B8E23',       '#FFA500',       '#FF4500',       '#DA70D6',       '#EEE8AA',       '#98FB98',       '#AFEEEE',       '#D87093',       '#FFEFD5',       '#FFDAB9',       '#CD853F',       '#FFC0CB',       '#DDA0DD',       '#B0E0E6',       '#800080',       '#FF0000',       '#BC8F8F',       '#4169E1',       '#8B4513',       '#FA8072',       '#F4A460',       '#2E8B57',       '#FFF5EE',       '#A0522D',       '#C0C0C0',       '#87CEEB',       '#6A5ACD',       '#708090',       '#708090',       '#FFFAFA',       '#00FF7F',       '#4682B4',       '#D2B48C',       '#008080',       '#D8BFD8',       '#FF6347',       '#40E0D0',       '#EE82EE',       '#F5DEB3',       '#FFFFFF',       '#F5F5F5',       '#FFFF00',       '#9ACD32']
  });
  Highcharts.chart('container', {
      chart: {
          plotBackgroundColor: null,
          plotBorderWidth: null,
          plotShadow: false,
          type: 'pie',
          options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
          }
      },
      title: {
          text: 'Cotizaciones'
      },
      tooltip: {
          pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
      },
      plotOptions: {
          pie: {
              depth:35,
              allowPointSelect: true,
              cursor: 'pointer',
              dataLabels: {
                  enabled: true,
                  format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                  style: {
                      color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                  }
              }
          }
      },
      series: [{
        name: 'Cotizaciones',
        colorByPoint: true,
         data: [<?=$cotizaciones?>],
           dataLabels: {
               enabled: true,
               rotation:0,
               color: '#333333',
               align: 'right',
               format: '{point.name}:{point.y:0f} <br> {point.percentage:.1f} %',  //one decimal
               y: 1,  //10 pixels down from the top
               style: {
                   fontSize: '15px',
                   fontFamily: 'Verdana, sans-serif'
               }
           }
       }]
  });

  Highcharts.chart('procedencia_graph', {
      chart: {
          plotBackgroundColor: null,
          plotBorderWidth: null,
          plotShadow: false,
          type: 'pie',
          options3d: {
            enabled: true,
            alpha: 45,
            beta: 0,
            depth:70
          }
      },
      title: {
          text: 'Cotizaciones por procedencia'
      },
      tooltip: {
          pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
      },
      plotOptions: {
          pie: {
              depth:55,
              allowPointSelect: true,
              cursor: 'pointer',
              dataLabels: {
                  enabled: true,
                  format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                  style: {
                      color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                  }
              }
          }
      },
      series: [{
        name: 'Procedencia',
        colorByPoint: true,
         data: [<?=$cot_by_procedencia?>],
           dataLabels: {
               enabled: true,
               rotation:0,
               color: '#333333',
               align: 'right',
               format: '{point.name}: <br> Cantidad:{point.y:0f} <br> Porcentaje:{point.percentage:.1f} %',  //one decimal
               y: 1,  //10 pixels down from the top
               style: {
                   fontSize: '15px',
                   fontFamily: 'Verdana, sans-serif'
               }
           }
       }]
  });

  Highcharts.setOptions({
      colors: ['#50B432','#ff0000','#FF9800','#058DC7', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4']
  });


</script>