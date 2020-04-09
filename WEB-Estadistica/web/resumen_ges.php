<?php
include "../cnx/connection.php";

$sql_min_max = $connection->query("SELECT min(DISTINCT(anio_eg_ges)),max(DISTINCT(anio_eg_ges))  FROM egresos_ges WHERE estable_eg_ges='105001' and codigo_tipo_ges_eg_ges=3");
$res_min_max = mysqli_fetch_array($sql_min_max);
$a_min = $res_min_max[0];
$a_max = $res_min_max[1];

$sql_anios = $connection->query("SELECT DISTINCT(anio_eg_ges) FROM egresos_ges WHERE estable_eg_ges='105001' and codigo_tipo_ges_eg_ges=3");

function restarMeses($MES, $ANIO)
{
    $fecha = date("d-m-Y", strtotime("01-$MES-$ANIO -12 month"));
    $varMes = substr($fecha, 3, 2);
    $varAnio = substr($fecha, -4);
    return array($varMes, $varAnio);
}
?>

<div class="mt-3">
    <div class="row container-fluid">
        <div class="row">
            <div class="container">
                <label>Seleccionar Año:</label><label class="ml-3" id="etiqueta-datalist"></label>
            </div>
            <div class="row container">
                <input id="datal" name="datal" type="range" list="lista-anios1" min="<?php echo $a_min ?>" max="<?php echo $a_max ?>" autocomplete="off">
                <datalist id="lista-anios1">
                    <?php
                    while ($res_anios = mysqli_fetch_array($sql_anios)) {
                        echo  '<option value="' . $res_anios[0] . '"></option>'; // Format for adding options 
                    }
                    ?>
                </datalist>
            </div>
        </div>
        <div class="row">
            <div class="container-fluid">
                <label>Seleccionar Mes:</label><label class="ml-3" id="etiqueta-mv"></label>
            </div>
            <div class="row container-fluid">
                <div id="meses-grafico"></div>
            </div>
        </div>
    </div>
</div>
<!------------------------------------------------------------------------------------------------->


<div id="grafico-pais"></div>
<div id="grafico-sscq"></div>

<script>
    $(document).ready(function() {
        recargarLista_meses_rg($('#datal').val());
        $('#datal').change(function() {
            recargarLista_meses_rg($('#datal').val());
        });

        document.querySelector('#etiqueta-datalist').innerText = $('#datal').val();

        $('#datal').change(function() {
            document.querySelector('#etiqueta-datalist').innerText = $('#datal').val();
        });

        

    });
</script>

<script>
    var xData = [
        [2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2013],
        [2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2013],
        [2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2013],
        [2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2013]
    ];

    var yData = [
        [74, 82, 80, 74, 73, 72, 74, 70, 70, 66, 66, 69],
        [45, 42, 50, 46, 36, 36, 34, 35, 32, 31, 31, 28],
        [13, 14, 20, 24, 20, 24, 24, 40, 35, 41, 43, 50],
        [18, 21, 18, 21, 16, 14, 13, 18, 17, 16, 19, 23]
    ];

    var colors = ['rgba(67,67,67,1)', 'rgba(115,115,115,1)', 'rgba(49,130,189, 1)',
        'rgba(189,189,189,1)'
    ];

    var labels = ['Television', 'Newspaper', 'Internet', 'Radio'];

    var data = [];

    for (var i = 0; i < xData.length; i++) {
        var result = {
            x: xData[i],
            y: yData[i],
            type: 'scatter',
            mode: 'lines',
            line: {
                color: colors[i],
                width: 4
            }
        };
        var result2 = {
            x: [xData[i][0], xData[i][11]],
            y: [yData[i][0], yData[i][11]],
            type: 'scatter',
            mode: 'markers',
            marker: {
                color: colors[i],
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
            zeroline: true, //
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
                text: 'Main Source for News',
                font: {
                    family: 'Arial',
                    size: 30,
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
                text: 'Source: Pew Research Center & Storytelling with data',
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
            text: labels[i] + ' ' + yData[i][0] + '%',
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
            y: yData[i][11],
            xanchor: 'left',
            yanchor: 'middle',
            text: yData[i][11] + '%',
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