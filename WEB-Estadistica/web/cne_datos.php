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
                <td class="text-center"><?php echo $res_porcentaje[2]; ?></td>
                <td class="text-center"><?php echo $res_porcentaje[3]; ?></td>
                <td class="text-center"><?php echo $res_porcentaje[4]; ?></td>
                <td class="text-center"><?php echo $res_porcentaje[5]; ?></td>
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
                                                      FROM establecimiento e INNER JOIN linea_base_lb l on e.codigo_estable=l.codigo_estable_lb
                                                      WHERE e.tipo_estable=$cne_tipo_estable and l.anio_lb=$cne_anio
                                                      ORDER BY e.codigo_estable");
            ?>
            <tr>
                <td class="text-left"><?php //echo $most_cne[0]; ?></td>
                <td class="text-left"><?php //echo $most_cne[1]; ?></td>
                <td class="text-left"><?php //echo $most_cne[2]; ?></td>
                <td class="text-center"><?php //echo $most_cne[3]; ?></td>
                <td class="text-center"><?php //echo $most_cne[4]; ?></td>
                <td class="text-center"><?php //echo $most_cne[5]; ?></td>
                <td class="text-center"><?php //echo $most_cne[6]; ?></td>
            </tr>
            <?php
            
            ?>
        </tbody>
    </table>
</div>