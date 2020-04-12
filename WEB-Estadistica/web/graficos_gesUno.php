<?php
include "../cnx/connection.php";
$mes_vencidas = $_POST['mes'];
$anio_vencidas = $_POST['anio'];

function restarMeses($MES, $ANIO)
{
    if ($MES < 10) {
        $MES = "0" . $MES;
    }
    $fecha = date("d-m-Y", strtotime("01-$MES-$ANIO -12 month"));
    $varMes = substr($fecha, 3, 2);
    $varAnio = substr($fecha, -4);
    return array($varMes, $varAnio);
}
$mes_vencidas;
$anio_vencidas;

$fecha_inicial = restarMeses($mes_vencidas, $anio_vencidas);
$mes_inicial = $fecha_inicial[0];
$anio_inicial = $fecha_inicial[1];

$mtz_pais = [];
$sql_vencidas_pais = $connection->query("SELECT e.nombre_estable, g.mes_eg_ges, g.anio_eg_ges,g.cantidad_eg_ges
                                    FROM egresos_ges g INNER JOIN establecimiento e on g.estable_eg_ges=e.codigo_estable
                                    WHERE CAST(CONCAT(g.anio_eg_ges,'-',g.mes_eg_ges,'-01') as date) BETWEEN CAST('$anio_inicial-$mes_inicial-01' as DATE) and CAST('$anio_vencidas-$mes_vencidas-01' as DATE)
                                    and g.codigo_tipo_ges_eg_ges=3 and g.estable_eg_ges=105001
                                    ORDER BY g.anio_eg_ges,g.mes_eg_ges ASC");
while ($res_vencidas_pais = mysqli_fetch_array($sql_vencidas_pais)) {
    array_push($mtz_pais, [$res_vencidas_pais[0], $res_vencidas_pais[1], $res_vencidas_pais[2], number_format($res_vencidas_pais[3], 0, ",", ".")]);
}

$fecha_p = [];
$dato_p = [];
for ($x = 0; $x <= (count($mtz_pais) - 1); $x++) {
    $fecha_p[] = $mtz_pais[$x][1] . '-' . $mtz_pais[$x][2];
    $dato_p[] = $mtz_pais[$x][3];
}
$fecha_XP = json_encode($fecha_p);
$dato_YP = json_encode($dato_p);

//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------
$mtz_servicio = [];
$sql_vencidas_servicio = $connection->query("SELECT e.nombre_estable, g.mes_eg_ges, g.anio_eg_ges,g.cantidad_eg_ges
                                    FROM egresos_ges g INNER JOIN establecimiento e on g.estable_eg_ges=e.codigo_estable
                                    WHERE CAST(CONCAT(g.anio_eg_ges,'-',g.mes_eg_ges,'-01') as date) BETWEEN CAST('$anio_inicial-$mes_inicial-01' as DATE) and CAST('$anio_vencidas-$mes_vencidas-01' as DATE)
                                    and g.codigo_tipo_ges_eg_ges=3 and g.estable_eg_ges=105010
                                    ORDER BY g.anio_eg_ges,g.mes_eg_ges ASC");
while ($res_vencidas_servicio = mysqli_fetch_array($sql_vencidas_servicio)) {
    array_push($mtz_servicio, [$res_vencidas_servicio[0], $res_vencidas_servicio[1], $res_vencidas_servicio[2], $res_vencidas_servicio[3]]);
}

$fecha_s = [];
$dato_s = [];
for ($x = 0; $x <= (count($mtz_servicio) - 1); $x++) {
    $fecha_s[] = $mtz_servicio[$x][1] . '-' . $mtz_servicio[$x][2];
    $dato_s[] = $mtz_servicio[$x][3];
}

$fecha_XS = json_encode($fecha_s);
$dato_YS = json_encode($dato_s);

?>


<div id="grafico-pais"></div>
<div id="grafico-sscq"></div>

<script>
    function crearcadenaLineal(json) {
        var parsed = JSON.parse(json);
        var arr = [];
        for (var x in parsed) {
            arr.push(parsed[x]);
        }
        return arr;
    }
    fecha_pais = crearcadenaLineal('<?php echo $fecha_XP; ?>');
    valores_pais = crearcadenaLineal('<?php echo $dato_YP; ?>');

    var xData = [fecha_pais];

    var yData = [valores_pais];

    //var colors = 'rgba(6,93,245,1)';

    var labels = 'Pais';

    var data = [];
    var eti_final = ('<?php echo count($dato_p); ?>') - 1;

    for (var i = 0; i < xData.length; i++) {
        var result = {
            x: xData[i],
            y: yData[i],
            type: 'scatter',
            mode: 'lines',
            line: {
                color: 'rgba(6,93,245,1)',
                width: 4
            }
        };
        var result2 = {
            x: [xData[i][0], xData[i][eti_final]], //[xData.length - 1]],
            y: [yData[i][0], yData[i][eti_final]], //[yData.length - 1]],
            type: 'scatter',
            mode: 'markers',
            marker: {
                color: 'rgba(6,93,245,1)',
                size: 12
            }
        };
        data.push(result, result2);
    }

    var layout = {
        showlegend: false,
        /*
          height: 600,
          width: 600,*/
        xaxis: {
            showline: true,
            showgrid: true, //
            showticklabels: true,
            linecolor: '', //rgb(204,204,204)
            linewidth: 1,
            autotick: false,
            ticks: 'outside',
            tickcolor: 'rgb(204,204,204)',
            tickwidth: 2, //2
            ticklen: 5,
            tickfont: {
                family: 'Arial',
                size: 12,
                color: 'rgb(82, 82, 82)'
            }
        },
        yaxis: {
            showgrid: true, //
            zeroline: false, //
            showline: true, //
            showticklabels: true //
        },
        autosize: true,
        /* era false aca
         margin: {
           autoexpand: false,
           l: 100,
           r: 20,
           t: 100
         }*/
        annotations: [{
                xref: 'paper',
                yref: 'paper',
                x: 0.0,
                y: 1.05,
                xanchor: 'left',
                yanchor: 'bottom',
                text: 'Evolución de GO Retrasadas cortes oficiales País',
                font: {
                    family: 'Arial',
                    size: 24,
                    color: 'rgb(37,37,37)'
                },
                showarrow: false
            },
            {
                xref: 'paper',
                yref: 'paper',
                x: 0.5,
                y: -0.1,
                xanchor: 'center',
                yanchor: 'top',
                text: 'Fechas: evolucion de mes y año',
                showarrow: false,
                font: {
                    family: 'Arial',
                    size: 12,
                    color: 'rgb(150,150,150)'
                }
            }
        ]
    };

    for (var i = 0; i < xData.length; i++) {
        var result = {
            xref: 'paper',
            x: 0.05,
            y: yData[i][0],
            xanchor: 'right',
            yanchor: 'middle',
            text: labels + ' ' + yData[i][0], // + '%',
            showarrow: false,
            font: {
                family: 'Arial',
                size: 16,
                color: 'black'
            }
        };
        var result2 = {
            xref: 'paper',
            x: 0.95,
            y: yData[i][eti_final],
            xanchor: 'left',
            yanchor: 'middle',
            text: yData[i][eti_final], // + '%',
            font: {
                family: 'Arial',
                size: 16,
                color: 'black'
            },
            showarrow: false
        };

        layout.annotations.push(result, result2);
    }

    Plotly.newPlot('grafico-pais', data, layout);
</script>

<script>
    fecha_servicio = crearcadenaLineal('<?php echo $fecha_XS; ?>');
    valores_servicio = crearcadenaLineal('<?php echo $dato_YS; ?>');

    var xData = [fecha_servicio];

    var yData = [valores_servicio];

    //var colors = 'rgba(6,93,245,1)';

    var labels = 'SSCQ';

    var data = [];
    var eti_final_s = ('<?php echo count($dato_s); ?>') - 1;

    for (var i = 0; i < xData.length; i++) {
        var result = {
            x: xData[i],
            y: yData[i],
            type: 'scatter',
            mode: 'lines',
            line: {
                color: 'rgba(245,180,6,1)',
                width: 4
            }
        };
        var result2 = {
            x: [xData[i][0], xData[i][eti_final_s]], //[xData.length - 1]],
            y: [yData[i][0], yData[i][eti_final_s]], //[yData.length - 1]],
            type: 'scatter',
            mode: 'markers',
            marker: {
                color: 'rgba(245,136,6,1)',
                size: 12
            }
        };
        data.push(result, result2);
    }

    var layout = {
        showlegend: false,
        /*
          height: 600,
          width: 600,*/
        xaxis: {
            showline: true,
            showgrid: true, //
            showticklabels: true,
            linecolor: '', //rgb(204,204,204)
            linewidth: 1,
            autotick: false,
            ticks: 'outside',
            tickcolor: 'rgb(204,204,204)',
            tickwidth: 2, //2
            ticklen: 5,
            tickfont: {
                family: 'Arial',
                size: 12,
                color: 'rgb(82, 82, 82)'
            }
        },
        yaxis: {
            showgrid: true, //
            zeroline: false, //
            showline: true, //
            showticklabels: true //
        },
        autosize: true,
        /* era false aca
         margin: {
           autoexpand: false,
           l: 100,
           r: 20,
           t: 100
         }*/
        annotations: [{
                xref: 'paper',
                yref: 'paper',
                x: 0.0,
                y: 1.05,
                xanchor: 'left',
                yanchor: 'bottom',
                text: 'Evolución de GO Retrasadas cortes oficiales Servicio de Salud Coquimbo',
                font: {
                    family: 'Arial',
                    size: 24,
                    color: 'rgb(37,37,37)'
                },
                showarrow: false
            },
            {
                xref: 'paper',
                yref: 'paper',
                x: 0.5,
                y: -0.1,
                xanchor: 'center',
                yanchor: 'top',
                text: 'Fechas: evolucion de mes y año',
                showarrow: false,
                font: {
                    family: 'Arial',
                    size: 12,
                    color: 'rgb(150,150,150)'
                }
            }
        ]
    };

    for (var i = 0; i < xData.length; i++) {
        var result = {
            xref: 'paper',
            x: 0.05,
            y: yData[i][0],
            xanchor: 'right',
            yanchor: 'middle',
            text: labels + ' ' + yData[i][0], // + '%',
            showarrow: false,
            font: {
                family: 'Arial',
                size: 16,
                color: 'black'
            }
        };
        var result2 = {
            xref: 'paper',
            x: 0.95,
            y: yData[i][eti_final_s],
            xanchor: 'left',
            yanchor: 'middle',
            text: yData[i][eti_final_s], // + '%',
            font: {
                family: 'Arial',
                size: 16,
                color: 'black'
            },
            showarrow: false
        };

        layout.annotations.push(result, result2);
    }

    Plotly.newPlot('grafico-sscq', data, layout);
</script>