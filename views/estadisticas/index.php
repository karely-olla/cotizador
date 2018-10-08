<?php require '../layouts/auth.php'; ?>
<?php require '../layouts/header.php'; ?>
<?php require '../layouts/barra.php'; ?>
<?php require '../layouts/navegacion.php'; ?>

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
              <li role="presentation" class="active"><a href="#cotizaciones" aria-controls="cotizaciones" role="tab" data-toggle="tab"><i class="fa fa-pie-chart"></i> Cotizaciones</a></li>
              <li role="presentation" ><a href="#ejecutivos" aria-controls="ejecutivos" role="tab" data-toggle="tab"><i class="fa fa-users"></i> Ejecutivos</a></li>
              <li role="presentation" ><a href="#procedencia" aria-controls="procedencia" role="tab" data-toggle="tab"><i class="fa fa-bar-chart"></i> Procedencia</a></li>
          </ul>

            <!-- Tab panes -->
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="cotizaciones">
                  <?php 
                      require_once '../../config/conexion.php';
                      $sql_c = "SELECT DISTINCT state, (SELECT COUNT(state) FROM cotizaciones WHERE state =1) as confirmadas, (SELECT COUNT(state) FROM cotizaciones WHERE state =0) as sin_confirmar FROM cotizaciones as c";
                        $result_cot = $con->prepare($sql_c);
                        $result_cot->execute();
                        $cotizaciones = '';
                        $totales_cuentas='';

                        while ($r = $result_cot->fetch(PDO::FETCH_OBJ)) { 
                          if ($r->state=='1') {
                            $name = 'Confirmadas';
                            $num = $r->confirmadas;
                          }elseif ($r->state=='0') {
                            $name = 'No Confirmadas';
                            $num = $r->sin_confirmar;
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
              <div role="tabpanel" class="tab-pane" id="ejecutivos">
                <br>
                <?php 
                  $months = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciciembre");
                  // Silvia
                  $sql = "SELECT (SELECT nombre FROM usuarios WHERE id = c.id_usuario) as usuario, COUNT(*) as num_cots, MonthName(created_at) as mes, SUM(monto) as total, YEAR(created_at) as año FROM cotizaciones as c WHERE year(created_at) = year(curdate()) && state=1 && id_usuario=2 GROUP BY MonthName(created_at)";
                  $result_ejecutivo_silvia = $con->prepare($sql);
                  $result_ejecutivo_silvia->execute();
                  $cot_by_monts = '';
                  $meses_silvia = '';
                  $count_cots_silvia = '';
                  $amount_cots_silvia='';
                  while ($fp = $result_ejecutivo_silvia->fetch(PDO::FETCH_OBJ)) {                   
                    $meses_silvia = $meses_silvia."'".$months[date('n', strtotime($fp->mes))-1]."',";                   
                    $count_cots_silvia = $count_cots_silvia.$fp->num_cots.',';
                    $amount_cots_silvia=$amount_cots_silvia.$fp->total.',';
                  }
                  $meses_silvia = substr($meses_silvia,0,-1);
                  $count_cots_silvia = substr($count_cots_silvia,0,-1);
                  $amount_cots_silvia = substr($amount_cots_silvia,0,-1);
                  // Nayeli
                  $sqlNayeli = "SELECT (SELECT nombre FROM usuarios WHERE id = c.id_usuario) as usuario, COUNT(*) as num_cots, MonthName(created_at) as mes, SUM(monto) as total, YEAR(created_at) as año FROM cotizaciones as c WHERE year(created_at) = year(curdate()) && state=1 && id_usuario=4 GROUP BY MonthName(created_at)";
                  $result_ejecutivo_nayeli = $con->prepare($sqlNayeli);
                  $result_ejecutivo_nayeli->execute();
                  $cot_by_monts = '';
                  $meses_nayeli = '';
                  $count_cots_nayeli = '';
                  $amount_cots_nayeli='';
                  while ($fk = $result_ejecutivo_nayeli->fetch(PDO::FETCH_OBJ)) {                   
                    $meses_nayeli = $meses_nayeli."'".$months[date('n', strtotime($fk->mes))-1]."',";                   
                    $count_cots_nayeli = $count_cots_nayeli.$fk->num_cots.',';
                    $amount_cots_nayeli=$amount_cots_nayeli.$fk->total.',';
                  }
                  $meses_nayeli = substr($meses_nayeli,0,-1);
                  $count_cots_nayeli = substr($count_cots_nayeli,0,-1);
                  $amount_cots_nayeli = substr($amount_cots_nayeli,0,-1);
                  // Evelyn
                  $sqlEvelyn = "SELECT (SELECT nombre FROM usuarios WHERE id = c.id_usuario) as usuario, COUNT(*) as num_cots, MonthName(created_at) as mes, SUM(monto) as total, YEAR(created_at) as año FROM cotizaciones as c WHERE year(created_at) = year(curdate()) && state=1 && id_usuario=3 GROUP BY MonthName(created_at)";
                  $result_ejecutivo_evelyn = $con->prepare($sqlEvelyn);
                  $result_ejecutivo_evelyn->execute();
                  $cot_by_monts = '';
                  $meses_evelyn = '';
                  $count_cots_evelyn = '';
                  $amount_cots_evelyn='';
                  while ($fk = $result_ejecutivo_evelyn->fetch(PDO::FETCH_OBJ)) {                   
                    $meses_evelyn = $meses_evelyn."'".$months[date('n', strtotime($fk->mes))-1]."',";                   
                    $count_cots_evelyn = $count_cots_evelyn.$fk->num_cots.',';
                    $amount_cots_evelyn=$amount_cots_evelyn.$fk->total.',';
                  }
                  $meses_evelyn = substr($meses_evelyn,0,-1);
                  $count_cots_evelyn = substr($count_cots_evelyn,0,-1);
                  $amount_cots_evelyn = substr($amount_cots_evelyn,0,-1);
                  // Ignacio
                  $sqlIgnacio = "SELECT (SELECT nombre FROM usuarios WHERE id = c.id_usuario) as usuario, COUNT(*) as num_cots, MonthName(created_at) as mes, SUM(monto) as total, YEAR(created_at) as año FROM cotizaciones as c WHERE year(created_at) = year(curdate()) && state=1 && id_usuario=1 GROUP BY MonthName(created_at)";
                  $result_ejecutivo_ignacio = $con->prepare($sqlIgnacio);
                  $result_ejecutivo_ignacio->execute();
                  $cot_by_monts = '';
                  $meses_ignacio = '';
                  $count_cots_ignacio = '';
                  $amount_cots_ignacio='';
                  while ($fk = $result_ejecutivo_ignacio->fetch(PDO::FETCH_OBJ)) {                   
                    $meses_ignacio = $meses_ignacio."'".$months[date('n', strtotime($fk->mes))-1]."',";                   
                    $count_cots_ignacio = $count_cots_ignacio.$fk->num_cots.',';
                    $amount_cots_ignacio=$amount_cots_ignacio.$fk->total.',';
                  }
                  $meses_ignacio = substr($meses_ignacio,0,-1);
                  $count_cots_ignacio = substr($count_cots_ignacio,0,-1);
                  $amount_cots_ignacio = substr($amount_cots_ignacio,0,-1);
                ?>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <h3 class="title-cat">Silvia</h3>
                    <div id="monts_ejecutivo_silvia" style="min-width: 100%; height: 300px;"></div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <h3 class="title-cat">Nayeli</h3>
                    <div id="monts_ejecutivo_nayeli" style="min-width: 100%; height: 300px;"></div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <h3 class="title-cat">Evelyn</h3>
                    <div id="monts_ejecutivo_evelyn" style="min-width: 100%; height: 300px;"></div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <h3 class="title-cat">Ignacio</h3>
                    <div id="monts_ejecutivo_ignacio" style="min-width: 100%; height: 300px;"></div>
                  </div>
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
<?php include '../layouts/footer.php'; ?>
<script type="text/javascript">
  Highcharts.setOptions({
      colors: ['#50B432','#ff0000','#058DC7', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4']
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
      colors: ['#50B432','#FF9800','#058DC7', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4']
  });


// -----------------------Estadisticas por Ejecutivo-----------------------
  // SILVIA
  Highcharts.chart('monts_ejecutivo_silvia', {
    chart: {
        type: 'column',
        options3d: {
            enabled: true,
            alpha: 10,
            beta: 25,
            depth: 70
        }
    },
    title: {
        text: 'Cotizaciones por Mes'
    },
    subtitle: {
        // text: 'Source: WorldClimate.com'
    },
    xAxis: {
        categories: [<?=$meses_silvia?> ],
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
        name: 'N° Cotizaciones',
        data: [<?=$count_cots_silvia?>]

    }, 
    {
        name: 'Monto',
        data: [<?=$amount_cots_silvia?>]

    }]
  });

   // NAYELI
  Highcharts.chart('monts_ejecutivo_nayeli', {
    chart: {
        type: 'column',
        options3d: {
            enabled: true,
            alpha: 10,
            beta: 25,
            depth: 70
        }
    },
    title: {
        text: 'Cotizaciones por Mes'
    },
    subtitle: {
        // text: 'Source: WorldClimate.com'
    },
    xAxis: {
        categories: [<?=$meses_nayeli?> ],
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
        name: 'N° Cotizaciones',
        data: [<?=$count_cots_nayeli?>]

    }, 
    {
        name: 'Monto',
        data: [<?=$amount_cots_nayeli?>]

    }]
  });

  // EVELYN
  Highcharts.chart('monts_ejecutivo_evelyn', {
    chart: {
        type: 'column',
        options3d: {
            enabled: true,
            alpha: 10,
            beta: 25,
            depth: 70
        }
    },
    title: {
        text: 'Cotizaciones por Mes'
    },
    subtitle: {
        // text: 'Source: WorldClimate.com'
    },
    xAxis: {
        categories: [<?=$meses_evelyn?> ],
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
        name: 'N° Cotizaciones',
        data: [<?=$count_cots_evelyn?>]

    }, 
    {
        name: 'Monto',
        data: [<?=$amount_cots_evelyn?>]

    }]
  });

  // IGNACIO
  Highcharts.chart('monts_ejecutivo_ignacio', {
    chart: {
        type: 'column',
        options3d: {
            enabled: true,
            alpha: 10,
            beta: 25,
            depth: 70
        }
    },
    title: {
        text: 'Cotizaciones por Mes'
    },
    subtitle: {
        // text: 'Source: WorldClimate.com'
    },
    xAxis: {
        categories: [<?=$meses_ignacio?> ],
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
        name: 'N° Cotizaciones',
        data: [<?=$count_cots_ignacio?>]

    }, 
    {
        name: 'Monto',
        data: [<?=$amount_cots_ignacio?>]

    }]
  });

</script>