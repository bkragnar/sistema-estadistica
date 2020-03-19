<!-- hacer llamado por ajax y enviar variable -->
<?php
include "../cnx/connection.php";

$cne_tipo_estable = $_POST['tipo_estable_cne'];
$cne_anio = $_POST['anio_eg_cne'];

$sql_porcentajes = $connection->query("SELECT * FROM porcentaje_lb WHERE tipo_estable_porc_lb=$cne_tipo_estable and anio_corte_porc_lb=$cne_anio");

?>
<div class="table-responsive mt-3">
    <table class="table table-hover table-condensed table-bordered table-sm">
        <thead style="background-color: #2C73FF; color:white; font-weight:bold;">
            <tr>
                <td class="align-middle text-center" rowspan="2">Establecimiento</td>
                <td class="align-middle text-center" rowspan="2">Linea Base</td>
                <td class="align-middle text-center" rowspan="2">% Cumplimiento</td>
                <?php
                while ($res_porcentaje = mysqli_fetch_array($sql_porcentajes)) {
                ?>
                    <td class="text-center"><?php echo $res_porcentaje[2] . "%"; ?></td>
                    <td class="text-center"><?php echo $res_porcentaje[3] . "%"; ?></td>
                    <td class="text-center"><?php echo $res_porcentaje[4] . "%"; ?></td>
                    <td class="text-center"><?php echo $res_porcentaje[5] . "%"; ?></td>
                <?php
                }
                ?>
            </tr>
            <tr>
                <td class="text-center">Marzo</td>
                <td class="text-center">Junio</td>
                <td class="text-center">Septiembre</td>
                <td class="text-center">Diciembre</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql_egreso_cne = $connection->query("SELECT e.nombre_estable, l.cantidad_lb
                                                FROM establecimiento e INNER JOIN linea_base_le l on e.codigo_estable=l.codigo_estable_lb
                                                WHERE e.tipo_estable=$cne_tipo_estable and l.anio_lb=$cne_anio
                                                ORDER BY e.codigo_estable");

            $sql_datos_cne = $connection->query("SELECT e.nombre_estable,l.cantidad_lb,eg.estable_eg,eg.cantidad_eg,eg.mes_eg
                                                FROM egresos_le eg INNER JOIN establecimiento e on eg.estable_eg=e.codigo_estable INNER JOIN tipo_estable t on t.codigo_tipo=e.tipo_estable INNER JOIN linea_base_le l on e.codigo_estable=l.codigo_estable_lb
                                                WHERE eg.anio_eg=$cne_anio and eg.tipo_le_eg=1 and t.codigo_tipo=$cne_tipo_estable
                                                ORDER BY eg.estable_eg,eg.mes_eg ASC");

            //consulta por el mes maximo ingresado del año seleccionado
            $sql_mes_max = $connection->query("SELECT max(eg.mes_eg) FROM egresos_le eg INNER JOIN establecimiento e on eg.estable_eg=e.codigo_estable INNER JOIN tipo_estable t on t.codigo_tipo=e.tipo_estable 
                                                WHERE eg.anio_eg=$cne_anio and t.codigo_tipo=$cne_tipo_estable");
            while ($res_mes_max = mysqli_fetch_array($sql_mes_max)) {
                $mes_max = $res_mes_max[0];
            }

            $matriz_datos = [];
            while ($res_datos_cne = mysqli_fetch_array($sql_datos_cne)) {
                array_push($matriz_datos, [$res_datos_cne[0], $res_datos_cne[1], $res_datos_cne[3], $res_datos_cne[4]]);
            }

            $matriz_ordenada = [];
            for ($y = 0; $y < count($matriz_datos); $mes_max) {
                $aux = $y;
                $var = 0;
                for ($x = 1; $x <= $mes_max; $x++) {
                    if (in_array($matriz_datos[$aux][0], $matriz_ordenada[$var][0])) {
                        //si el establecimiento existe en la matriz ordenada
                    } else {
                        //si el establecimiento no existe en la matriz ordenada
                        $matriz_ordenada[$var][0]=$matriz_datos[$aux][0];
                        $matriz_ordenada[$var][1]=$matriz_datos[$aux][1];
                    }
                }
            }


            /*
            echo ('<pre>');
            //var_dump($matriz_datos);
            print_r($matriz_datos);
            echo ('</pre>');
            */
            ?>
            <tr>
                <td class="text-left"><?php //echo $most_cne[0]; 
                                        ?></td>
                <td class="text-left"><?php //echo $most_cne[1]; 
                                        ?></td>
                <td class="text-left"><?php //echo $most_cne[2]; 
                                        ?></td>
                <td class="text-center"><?php //echo $most_cne[3]; 
                                        ?></td>
                <td class="text-center"><?php //echo $most_cne[4]; 
                                        ?></td>
                <td class="text-center"><?php //echo $most_cne[5]; 
                                        ?></td>
                <td class="text-center"><?php //echo $most_cne[6]; 
                                        ?></td>
            </tr>
            <?php

            ?>
        </tbody>
    </table>
</div>