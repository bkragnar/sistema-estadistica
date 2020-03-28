<?php
include "../cnx/connection.php";

$anio = $_POST['anio_eg_cne'];
$tipo_estable = $_POST['tipo_estable_cne'];
$comuna = $_POST['comuna_no_ges'];

$sql_porcentajes = $connection->query("SELECT * FROM porcentaje_lb WHERE tipo_estable_porc_lb=$tipo_estable");
$res_porcentaje = mysqli_fetch_array($sql_porcentajes);


$sql_mes_max = $connection->query("SELECT max(mes_eg) FROM egresos_le");
$res_mes_max = mysqli_fetch_array($sql_mes_max);
$mes_max = $res_mes_max[0];


if ($tipo_estable==1) {
    $sql_comuna = $connection->query("SELECT nombre_comuna FROM comuna WHERE codigo_comuna=$comuna");
    $res_comuna = mysqli_fetch_array($sql_comuna);
    $nom_comuna = $res_comuna[0];

    $sql_datos = $connection->query("SELECT e.nombre_estable,l.cantidad_lb,eg.mes_eg,eg.cantidad_eg
                FROM establecimiento e INNER JOIN tipo_estable t ON e.tipo_estable=t.codigo_tipo 
                INNER JOIN linea_base_le l ON l.codigo_estable_lb=e.codigo_estable INNER JOIN egresos_le eg 
                ON eg.estable_eg=e.codigo_estable and eg.anio_eg=l.anio_lb
                WHERE eg.anio_eg=$anio AND t.codigo_tipo=$tipo_estable and e.codigo_comuna=$comuna
                ORDER BY e.codigo_estable,eg.mes_eg");
    if (mysqli_num_rows($sql_datos) == 0) {
        echo '<script>alertify.warning("No se registran datos");</script>';
    } else {
        $matriz_datos = [];
        while ($res_datos = mysqli_fetch_array($sql_datos)) {
            array_push($matriz_datos, [$res_datos[0], $res_datos[1], $res_datos[2], $res_datos[3]]);
        }


        $mtz_ordenada = [];
        $mtz_muestra = [];
        $i = 0;
        $sum = 0;
        $porc = 0;
        $suma_cmp = 0;
        $lbtotal = 0;

        for ($x = 0; $x <= (count($matriz_datos) - 1); $x = $x + $mes_max) {
            $aux = $x;
            for ($y = 1; $y <= $mes_max; $y++) {
                if (in_array($matriz_datos[$aux][0], $mtz_ordenada[$i][0])) {
                    if ($matriz_datos[$aux][2] == $y) {
                        $mtz_ordenada[$i][$y + 1] = $matriz_datos[$aux][3];
                        $suma_cmp = $suma_cmp + $matriz_datos[$aux][3];
                    } else {
                        $mtz_ordenada[$i][$y + 1] = 0;
                    }
                } else {
                    $mtz_ordenada[$i][0] = $matriz_datos[$aux][0]; //nombre del establecimiento
                    $mtz_ordenada[$i][1] = $matriz_datos[$aux][1]; //asigna el valor de linea base correspondiente al establecimiento
                    if ($matriz_datos[$aux][2] == $y) {            //pregunta si el mes de la matriz es igual al recorrido
                        $mtz_ordenada[$i][$y + 1] = $matriz_datos[$aux][3];
                        $suma_cmp = $suma_cmp + $matriz_datos[$aux][3];
                    } else {
                        $mtz_ordenada[$i][$y + 1] = 0;
                    }
                }

                if (in_array($matriz_datos[$aux][0], $mtz_muestra[$i][0])) {
                    switch ($matriz_datos[$aux][2]) {
                        case 1:
                        case 2:
                        case 3:
                            $sum = $sum + $matriz_datos[$aux][3];
                            $mtz_muestra[$i][3] = $sum;
                            break;
                        case 4:
                        case 5:
                        case 6:
                            $sum = $sum + $matriz_datos[$aux][3];
                            $mtz_muestra[$i][4] = $sum;
                            break;
                        case 7:
                        case 8:
                        case 9:
                            $sum = $sum + $matriz_datos[$aux][3];
                            $mtz_muestra[$i][5] = $sum;
                            break;
                        case 10:
                        case 11:
                        case 12:
                            $sum = $sum + $matriz_datos[$aux][3];
                            $mtz_muestra[$i][6] = $sum;
                            break;
                    }
                } else {
                    $mtz_muestra[$i][0] = $matriz_datos[$aux][0];
                    $mtz_muestra[$i][1] = $matriz_datos[$aux][1];
                    switch ($matriz_datos[$aux][2]) {
                        case 1:
                        case 2:
                        case 3:
                            $sum = $sum + $matriz_datos[$aux][3];
                            $mtz_muestra[$i][3] = $sum;
                            break;
                        case 4:
                        case 5:
                        case 6:
                            $sum = $sum + $matriz_datos[$aux][3];
                            $mtz_muestra[$i][4] = $sum;
                            break;
                        case 7:
                        case 8:
                        case 9:
                            $sum = $sum + $matriz_datos[$aux][3];
                            $mtz_muestra[$i][5] = $sum;
                            break;
                        case 10:
                        case 11:
                        case 12:
                            $sum = $sum + $matriz_datos[$aux][3];
                            $mtz_muestra[$i][6] = $sum;
                            break;
                    }
                }
                $mtz_muestra[$i][2] = number_format(($sum / $mtz_muestra[$i][1]) * 100, 2, ",", ".");
                $aux++;
            }
            $i++;
            $sum = 0;
        }

        $tm = 0;
        $tj = 0;
        $ts = 0;
        $td = 0;
        for ($x = 0; $x < count($mtz_muestra); $x++) {
            $lbtotal = $lbtotal + $mtz_muestra[$x][1];
            $tm = $tm + $mtz_muestra[$x][3];
            $tj = $tj + $mtz_muestra[$x][4];
            $ts = $ts + $mtz_muestra[$x][5];
            $td = $td + $mtz_muestra[$x][6];
        }
        $porc_comuna = 0;
        $var_temp = $tm + $tj + $ts + $td;
        $porc_comuna = number_format((($var_temp) / $lbtotal) * 100, 2, ",", ".");
        array_push($mtz_muestra, [$nom_comuna, $lbtotal, $porc_comuna, $tm, $tj, $ts, $td]);

?>

        <div>
            <div class="table-responsive mt-3">
                <table class="table table-hover table-condensed table-bordered table-sm" id="tabla-cne-datos">
                    <thead style="background-color: #2C73FF; color:white; font-weight:bold;">
                        <tr>
                            <td rowspan="2" class="text-center align-middle">Establecimiento</td>
                            <td rowspan="2" class="text-center align-middle">Linea Base</td>
                            <td rowspan="2" class="text-center align-middle">% Cumplimiento</td>
                            <td class="text-center"><?php echo $res_porcentaje[2] . "%"; ?></td>
                            <td class="text-center"><?php echo $res_porcentaje[3] . "%"; ?></td>
                            <td class="text-center"><?php echo $res_porcentaje[4] . "%"; ?></td>
                            <td class="text-center"><?php echo $res_porcentaje[5] . "%"; ?></td>
                        </tr>
                        <tr>
                            <td class="text-center">Marzo</td>
                            <td class="text-center">Junio</td>
                            <td class="text-center">Septiembre</td>
                            <td class="text-center">Diciembre</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            for ($m = 0; $m < count($mtz_muestra); $m++) {
                                if ($m == (count($mtz_muestra) - 1)) {
                                    $fondo = "bg-success text-light";
                                } else {
                                    $fondo = "";
                                }
                            ?>
                                <td class=" <?php echo $fondo; ?>"><?php echo $mtz_muestra[$m][0]; ?></td>
                                <td class="text-center <?php echo $fondo; ?>"><?php echo number_format($mtz_muestra[$m][1], 0, '', '.'); ?></td>
                                <td class="text-center <?php echo $fondo; ?>"><?php echo $mtz_muestra[$m][2] . "%"; ?></td>
                                <td class="text-center <?php echo $fondo; ?>"><?php echo number_format($mtz_muestra[$m][3], 0, '', '.'); ?></td>
                                <td class="text-center <?php echo $fondo; ?>"><?php echo number_format($mtz_muestra[$m][4], 0, '', '.'); ?></td>
                                <td class="text-center <?php echo $fondo; ?>"><?php echo number_format($mtz_muestra[$m][5], 0, '', '.'); ?></td>
                                <td class="text-center <?php echo $fondo; ?>"><?php echo number_format($mtz_muestra[$m][6], 0, '', '.'); ?></td>
                        </tr>
                    <?php
                            }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php

        for ($i = 0; $i < count($mtz_ordenada); $i++) {
            for ($x = 0; $x < 12; $x++) {
                $valores[$i][$x] = $mtz_ordenada[$i][$x + 2];
            }
            $nombres[] = $mtz_ordenada[$i][0];
        }
    } //cierra el if si hay datos o no
} else {
    $sql_datos = $connection->query("SELECT e.nombre_estable,l.cantidad_lb,eg.mes_eg,eg.cantidad_eg
                FROM establecimiento e INNER JOIN tipo_estable t ON e.tipo_estable=t.codigo_tipo 
                INNER JOIN linea_base_le l ON l.codigo_estable_lb=e.codigo_estable INNER JOIN egresos_le eg 
                ON eg.estable_eg=e.codigo_estable and eg.anio_eg=l.anio_lb
                WHERE eg.anio_eg=$anio AND t.codigo_tipo=$tipo_estable
                ORDER BY e.codigo_estable,eg.mes_eg");
    $matriz_datos = [];
    while ($res_datos = mysqli_fetch_array($sql_datos)) {
        array_push($matriz_datos, [$res_datos[0], $res_datos[1], $res_datos[2], $res_datos[3]]);
    }

    $mtz_ordenada = [];
    $mtz_muestra = [];
    $i = 0;
    $sum = 0;
    $porc = 0;
    $suma_cmp = 0;
    for ($x = 0; $x <= (count($matriz_datos) - 1); $x = $x + $mes_max) {
        $aux = $x;
        for ($y = 1; $y <= $mes_max; $y++) {

            if (in_array($matriz_datos[$aux][0], $mtz_ordenada[$i][0])) {
                if ($matriz_datos[$aux][2] == $y) {
                    $mtz_ordenada[$i][$y + 1] = $matriz_datos[$aux][3];
                    $suma_cmp = $suma_cmp + $matriz_datos[$aux][3];
                } else {
                    $mtz_ordenada[$i][$y + 1] = 0;
                }
            } else {
                $mtz_ordenada[$i][0] = $matriz_datos[$aux][0]; //nombre del establecimiento
                $mtz_ordenada[$i][1] = $matriz_datos[$aux][1]; //asigna el valor de linea base correspondiente al establecimiento
                if ($matriz_datos[$aux][2] == $y) {            //pregunta si el mes de la matriz es igual al recorrido
                    $mtz_ordenada[$i][$y + 1] = $matriz_datos[$aux][3];
                    $suma_cmp = $suma_cmp + $matriz_datos[$aux][3];
                } else {
                    $mtz_ordenada[$i][$y + 1] = 0;
                }
            }

            if (in_array($matriz_datos[$aux][0], $mtz_muestra[$i][0])) {
                switch ($matriz_datos[$aux][2]) {
                    case 1:
                    case 2:
                    case 3:
                        $sum = $sum + $matriz_datos[$aux][3];
                        $mtz_muestra[$i][3] = $sum;
                        break;
                    case 4:
                    case 5:
                    case 6:
                        $sum = $sum + $matriz_datos[$aux][3];
                        $mtz_muestra[$i][4] = $sum;
                        break;
                    case 7:
                    case 8:
                    case 9:
                        $sum = $sum + $matriz_datos[$aux][3];
                        $mtz_muestra[$i][5] = $sum;
                        break;
                    case 10:
                    case 11:
                    case 12:
                        $sum = $sum + $matriz_datos[$aux][3];
                        $mtz_muestra[$i][6] = $sum;
                        break;
                }
            } else {
                $mtz_muestra[$i][0] = $matriz_datos[$aux][0];
                $mtz_muestra[$i][1] = $matriz_datos[$aux][1];
                switch ($matriz_datos[$aux][2]) {
                    case 1:
                    case 2:
                    case 3:
                        $sum = $sum + $matriz_datos[$aux][3];
                        $mtz_muestra[$i][3] = $sum;
                        break;
                    case 4:
                    case 5:
                    case 6:
                        $sum = $sum + $matriz_datos[$aux][3];
                        $mtz_muestra[$i][4] = $sum;
                        break;
                    case 7:
                    case 8:
                    case 9:
                        $sum = $sum + $matriz_datos[$aux][3];
                        $mtz_muestra[$i][5] = $sum;
                        break;
                    case 10:
                    case 11:
                    case 12:
                        $sum = $sum + $matriz_datos[$aux][3];
                        $mtz_muestra[$i][6] = $sum;
                        break;
                }
            }
            $mtz_muestra[$i][2] = number_format(($sum / $mtz_muestra[$i][1]) * 100, 2, ",", ".");
            $aux++;
        }
        $i++;
        $sum = 0;
    }
    /*
echo '<pre>';
print_r($mtz_ordenada);
echo '</pre>';
*/
    ?>

    <div>
        <div class="table-responsive mt-3">
            <table class="table table-hover table-condensed table-bordered table-sm" id="tabla-cne-datos">
                <thead style="background-color: #2C73FF; color:white; font-weight:bold;">
                    <tr>
                        <td rowspan="2" class="text-center align-middle">Establecimiento</td>
                        <td rowspan="2" class="text-center align-middle">Linea Base</td>
                        <td rowspan="2" class="text-center align-middle">% Cumplimiento</td>
                        <td class="text-center"><?php echo $res_porcentaje[2] . "%"; ?></td>
                        <td class="text-center"><?php echo $res_porcentaje[3] . "%"; ?></td>
                        <td class="text-center"><?php echo $res_porcentaje[4] . "%"; ?></td>
                        <td class="text-center"><?php echo $res_porcentaje[5] . "%"; ?></td>
                    </tr>
                    <tr>
                        <td class="text-center">Marzo</td>
                        <td class="text-center">Junio</td>
                        <td class="text-center">Septiembre</td>
                        <td class="text-center">Diciembre</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        for ($m = 0; $m < count($mtz_muestra); $m++) {
                        ?>
                            <td><?php echo $mtz_muestra[$m][0]; ?></td>
                            <td class="text-center"><?php echo number_format($mtz_muestra[$m][1], 0, '', '.'); ?></td>
                            <td class="text-center"><?php echo $mtz_muestra[$m][2] . "%"; ?></td>
                            <td class="text-center"><?php echo number_format($mtz_muestra[$m][3], 0, '', '.'); ?></td>
                            <td class="text-center"><?php echo number_format($mtz_muestra[$m][4], 0, '', '.'); ?></td>
                            <td class="text-center"><?php echo number_format($mtz_muestra[$m][5], 0, '', '.'); ?></td>
                            <td class="text-center"><?php echo number_format($mtz_muestra[$m][6], 0, '', '.'); ?></td>
                    </tr>
                <?php
                        }
                ?>
                </tbody>
            </table>
        </div>
    </div>

<?php

    for ($i = 0; $i < count($mtz_ordenada); $i++) {
        for ($x = 0; $x < 12; $x++) {
            $valores[$i][$x] = $mtz_ordenada[$i][$x + 2];
        }
        $nombres[] = $mtz_ordenada[$i][0];
    }
} //cierra el if (si se ha sellecionado establecimientos de menor complejidad (comuna))
?>


<div id="grafico"></div>

<script>
    $(document).ready(function() {
        var mtz1 = '<?php echo json_encode($valores); ?>';
        var mtz2 = '<?php echo json_encode($nombres); ?>';
        cargar_grafico(mtz1, mtz2);
    });
</script>