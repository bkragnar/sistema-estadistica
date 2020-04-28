<?php
include "../cnx/connection.php";

$anio = $_POST['anio'];


//-------------------------------------------------------------------------------------------------------------------------
//     garantias cumplidas
//-------------------------------------------------------------------------------------------------------------------------
$mtz_cumplidas = [];
$sql_cumplidas = $connection->query("SELECT e.nombre_estable,g.mes_eg_ges,g.cantidad_eg_ges
                                FROM egresos_ges g INNER JOIN establecimiento e on g.estable_eg_ges=e.codigo_estable
                                WHERE g.anio_eg_ges=$anio and g.codigo_tipo_ges_eg_ges=2
                                ORDER BY g.estable_eg_ges, g.mes_eg_ges");
while ($res_cumplidas = mysqli_fetch_array($sql_cumplidas)) {
    array_push($mtz_cumplidas, [$res_cumplidas[0], $res_cumplidas[1], $res_cumplidas[2]]);
}

$array_cumplidas_dato = [];
$array_cumplidas_estable = [];
$aux = 0;
$puntero_y = 1;

for ($i = 0; $i < count($mtz_cumplidas); $i++) {
    if (in_array($mtz_cumplidas[$i][0], $array_cumplidas_estable)) {
        $array_cumplidas_dato[$aux][$puntero_y] = ($mtz_cumplidas[$i][2] * 100);
        $puntero_y++;
    } else {
        $array_cumplidas_estable[] = $mtz_cumplidas[$i][0];
        $array_cumplidas_dato[$aux][0] = ($mtz_cumplidas[$i][2] * 100);
    }
    if (in_array($mtz_cumplidas[$i + 1][0], $array_cumplidas_estable)) {
    } else {
        $aux++;
        $puntero_y = 1;
    }
}

$cumplidas_datos = json_encode($array_cumplidas_dato);
$cumplidas_estable = json_encode($array_cumplidas_estable);

//-------------------------------------------------------------------------------------------------------------------------
//      casos creados
//-------------------------------------------------------------------------------------------------------------------------

$mtz_creados = [];
$sql_creados = $connection->query("SELECT e.nombre_estable,g.mes_eg_ges,g.cantidad_eg_ges
                                FROM egresos_ges g INNER JOIN establecimiento e on g.estable_eg_ges=e.codigo_estable
                                WHERE g.anio_eg_ges=$anio and g.codigo_tipo_ges_eg_ges=1
                                ORDER BY g.estable_eg_ges, g.mes_eg_ges");
while ($res_creados = mysqli_fetch_array($sql_creados)) {
    array_push($mtz_creados, [$res_creados[0], $res_creados[1], number_format($res_creados[2], 0, ",", ".")]);
}

$array_creados_dato = [];
$array_creados_estable = [];
$aux = 0;
$puntero_y = 1;

for ($i = 0; $i < count($mtz_creados); $i++) {
    if (in_array($mtz_creados[$i][0], $array_creados_estable)) {
        $array_creados_dato[$aux][$puntero_y] = $mtz_creados[$i][2];
        $puntero_y++;
    } else {
        $array_creados_estable[] = $mtz_creados[$i][0];
        $array_creados_dato[$aux][0] = $mtz_creados[$i][2];
    }
    if (in_array($mtz_creados[$i + 1][0], $array_creados_estable)) {
    } else {
        $aux++;
        $puntero_y = 1;
    }
}

$creados_datos = json_encode($array_creados_dato);
$creados_estable = json_encode($array_creados_estable);


//-------------------------------------------------------------------------------------------------------------------------
//      garantias vigentes
//-------------------------------------------------------------------------------------------------------------------------

$mtz_vigentes = [];
$sql_vigentes = $connection->query("SELECT e.nombre_estable,g.mes_eg_ges,g.cantidad_eg_ges
                                FROM egresos_ges g INNER JOIN establecimiento e on g.estable_eg_ges=e.codigo_estable
                                WHERE g.anio_eg_ges=$anio and g.codigo_tipo_ges_eg_ges=4
                                ORDER BY g.estable_eg_ges, g.mes_eg_ges");
while ($res_vigentes = mysqli_fetch_array($sql_vigentes)) {
    array_push($mtz_vigentes, [$res_vigentes[0], $res_vigentes[1], number_format($res_vigentes[2], 0, ",", ".")]);
}

$array_vigentes_dato = [];
$array_vigentes_estable = [];
$aux = 0;
$puntero_y = 1;

for ($i = 0; $i < count($mtz_vigentes); $i++) {
    if (in_array($mtz_vigentes[$i][0], $array_vigentes_estable)) {
        $array_vigentes_dato[$aux][$puntero_y] = $mtz_vigentes[$i][2];
        $puntero_y++;
    } else {
        $array_vigentes_estable[] = $mtz_vigentes[$i][0];
        $array_vigentes_dato[$aux][0] = $mtz_vigentes[$i][2];
    }
    if (in_array($mtz_vigentes[$i + 1][0], $array_vigentes_estable)) {
    } else {
        $aux++;
        $puntero_y = 1;
    }
}

$vigentes_datos = json_encode($array_vigentes_dato);
$vigentes_estable = json_encode($array_vigentes_estable);

//-------------------------------------------------------------------------------------------------------------------------
//      garantias exceptuadas
//-------------------------------------------------------------------------------------------------------------------------

$mtz_exceptuadas = [];
$sql_exceptuadas = $connection->query("SELECT t.nombre_tipo_ges,g.mes_eg_ges,g.cantidad_eg_ges
                                    FROM egresos_ges g INNER JOIN tipo_ges t on t.codigo_tipo_ges=g.codigo_tipo_ges_eg_ges
                                    WHERE g.anio_eg_ges=$anio and g.codigo_tipo_ges_eg_ges BETWEEN 5 and 6
                                    ORDER BY t.codigo_tipo_ges, g.mes_eg_ges");
while ($res_exceptuadas = mysqli_fetch_array($sql_exceptuadas)) {
    array_push($mtz_exceptuadas, [$res_exceptuadas[0], $res_exceptuadas[1], $res_exceptuadas[2]]);
}

$array_exceptuadas_dato = [];
$array_exceptuadas_estable = [];
$aux = 0;
$puntero_y = 1;

for ($i = 0; $i < count($mtz_exceptuadas); $i++) {
    if (in_array($mtz_exceptuadas[$i][0], $array_exceptuadas_estable)) {
        $array_exceptuadas_dato[$aux][$puntero_y] = $mtz_exceptuadas[$i][2];
        $puntero_y++;
    } else {
        $array_exceptuadas_estable[] = $mtz_exceptuadas[$i][0];
        $array_exceptuadas_dato[$aux][0] = $mtz_exceptuadas[$i][2];
    }
    if (in_array($mtz_exceptuadas[$i + 1][0], $array_exceptuadas_estable)) {
    } else {
        $aux++;
        $puntero_y = 1;
    }
}

$exceptuadas_datos = json_encode($array_exceptuadas_dato);
$exceptuadas_estable = json_encode($array_exceptuadas_estable);

?>

<div id="grafico-cumplidas"></div>
<div id="grafico-creados"></div>
<div id="grafico-vigentes"></div>
<div id="grafico-exceptuadas"></div>

<!-- ------------------------------------------------------------------------------------------------------------------- -->
<!--                                                    CUMPLIDAS                                                        -->
<!-- ------------------------------------------------------------------------------------------------------------------- -->
<script>
    function crearcadenaLineal(json) {
        var parsed = JSON.parse(json);
        var arr = [];
        for (var x in parsed) {
            arr.push(parsed[x]);
        }
        return arr;
    }

    datosY = crearcadenaLineal('<?php echo $cumplidas_datos ?>');
    nom_est = crearcadenaLineal('<?php echo $cumplidas_estable ?>');

    var arrayData = [];
    for (var i = 0; i < '<?php echo count($array_cumplidas_estable) ?>'; i++) {

        window["trace" + i] = {
            x: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            y: datosY[i],
            type: 'bar',
            name: nom_est[i],
            text: datosY[i].map(String),
            textposition: 'auto',
        };

        arrayData.push(window["trace" + i]);
    }

    var layout = {
        title: 'Garantias Cumplidas',
        barmode: 'group',
        font: {
            family: 'Raleway, sans-serif'
        },
        xaxis: {
            tickangle: 45,
            title: 'Meses'
        },
        yaxis: {
            title: '% cumplimiento'
        },
        barmode: 'group',
        bargap: 0.15,
        bargroupgap: 0.1
    };

    Plotly.newPlot('grafico-cumplidas', arrayData, layout, {}, {
        showSendToCloud: true
    });
</script>
<!-- ------------------------------------------------------------------------------------------------------------------- -->
<!--                                               CASOS CREADOS                                                         -->
<!-- ------------------------------------------------------------------------------------------------------------------- -->
<script>
    datosY = crearcadenaLineal('<?php echo $creados_datos ?>');
    nom_est = crearcadenaLineal('<?php echo $creados_estable ?>');

    var arrayData = [];
    for (var i = 0; i < '<?php echo count($array_creados_estable) ?>'; i++) {

        window["trace" + i] = {
            x: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            y: datosY[i],
            type: 'bar',
            name: nom_est[i],
            text: datosY[i].map(String),
            textposition: 'auto',
        };

        arrayData.push(window["trace" + i]);
    }

    var layout = {
        title: 'Casos Creados',
        barmode: 'group',
        font: {
            family: 'Raleway, sans-serif'
        },
        xaxis: {
            tickangle: 45,
            title: 'Meses'
        },
        yaxis: {
            title: 'Cantidad'
        },
        barmode: 'group',
        bargap: 0.15,
        bargroupgap: 0.1
    };

    Plotly.newPlot('grafico-creados', arrayData, layout, {}, {
        showSendToCloud: true
    });
</script>
<!-- ------------------------------------------------------------------------------------------------------------------- -->
<!--                                                    VIGENTES                                                         -->
<!-- ------------------------------------------------------------------------------------------------------------------- -->
<script>
    datosY = crearcadenaLineal('<?php echo $vigentes_datos ?>');
    nom_est = crearcadenaLineal('<?php echo $vigentes_estable ?>');

    var arrayData = [];
    for (var i = 0; i < '<?php echo count($array_vigentes_estable) ?>'; i++) {

        window["trace" + i] = {
            x: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            y: datosY[i],
            type: 'bar',
            name: nom_est[i],
            text: datosY[i].map(String),
            textposition: 'auto',
        };

        arrayData.push(window["trace" + i]);
    }

    var layout = {
        title: 'Garantias Vigentes',
        barmode: 'group',
        font: {
            family: 'Raleway, sans-serif'
        },
        xaxis: {
            tickangle: 45,
            title: 'Meses'
        },
        yaxis: {
            title: 'Cantidad Garantias'
        },
        barmode: 'group',
        bargap: 0.15,
        bargroupgap: 0.1
    };

    Plotly.newPlot('grafico-vigentes', arrayData, layout, {}, {
        showSendToCloud: true
    });
</script>
<!-- ------------------------------------------------------------------------------------------------------------------- -->
<!--                                                  EXCEPTUADAS                                                        -->
<!-- ------------------------------------------------------------------------------------------------------------------- -->
<script>
    datosY = crearcadenaLineal('<?php echo $exceptuadas_datos ?>');
    nom_est = crearcadenaLineal('<?php echo $exceptuadas_estable ?>');

    var arrayData = [];
    for (var i = 0; i < '<?php echo count($array_exceptuadas_estable) ?>'; i++) {

        window["trace" + i] = {
            x: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            y: datosY[i],
            type: 'bar',
            name: nom_est[i],
            text: datosY[i].map(String),
            textposition: 'auto',
        };

        arrayData.push(window["trace" + i]);
    }

    var layout = {
        title: 'Garantias Exceptuadas',
        barmode: 'stack',
        font: {
            family: 'Raleway, sans-serif'
        },
        xaxis: {
            tickangle: 45,
            title: 'Meses'
        },
        yaxis: {
            title: 'Cantidad Garantias'
        }
    };

    Plotly.newPlot('grafico-exceptuadas', arrayData, layout);
</script>