<?php
include "../cnx/connection.php";


?>
<div class="mt-3">
    <div class="row">
        <div>
            <label for="" class="row ml-3">Seleccionar Año:</label>
            <select class="row ml-3">
                <option value="0" disabled>Seleccione:</option>
                <?php
                //$sql_anio_cne = $connection->query("SELECT distinct(anio_eg) FROM egreso_le");
                //while ($res_provincia = mysqli_fetch_array($sql_provincia)) {
                //    echo '<option value="' . $res_provincia[1] . '">' . $res_provincia[2] . '</option>';
                //}
                ?>
            </select>
        </div>
        <div class="ml-5">
            <label for="" class="row ml-2">Tipo Establecimiento:</label>
            <select class="row ml-2">
                <option value="0" disabled>Seleccione:</option>
                <?php
                $sql_tipo_estable = $connection->query("SELECT * FROM tipo_estable");
                while ($res_tipo_estable = mysqli_fetch_array($sql_tipo_estable)) {
                    echo '<option value="' . $res_tipo_estable[1] . '">' . $res_tipo_estable[2] . '</option>';
                }
                ?>
            </select>
        </div>
    </div>
</div>
<div class="table-responsive mt-3">
    <table class="table table-hover table-condensed table-bordered table-sm">
        <thead style="background-color: #2C73FF; color:white; font-weight:bold;">
            <tr>
                <td class="align-middle text-center" rowspan="2">Establecimiento</td>
                <td class="align-middle text-center" rowspan="2">Linea Base</td>
                <td class="align-middle text-center" rowspan="2">% Cumplimiento</td>
                <td class="text-center"><?php  ?></td><!-- php -->
                <td class="text-center"><?php  ?></td><!-- php -->
                <td class="text-center"><?php  ?></td><!-- php -->
                <td class="text-center"><?php  ?></td><!-- php -->
            </tr>
            <tr>
                <td class="text-center">Marzo</td>
                <td class="text-center">Junio</td>
                <td class="text-center py-0">Septiembre</td>
                <td class="text-center">Diciembre</td>
            </tr>
        </thead>
        <tbody>
            <?php
            //$sql_cne = "SELECT * FROM tipo_estable ORDER BY codigo_tipo ASC";
            //$resul_cne = mysqli_query($connection, $sql_cne);
            //while ($most_cne = mysqli_fetch_array($resul_cne)) {
            ?>
            <tr>
                <td><?php //echo $most_cne[0]; ?></td>
                <td><?php //echo $most_cne[1]; ?></td>
                <td><?php //echo $most_cne[2]; ?></td>
                <td class="text-center"><?php //echo $most_cne[3]; ?></td>
                <td class="text-center"><?php //echo $most_cne[4]; ?></td>
                <td class="text-center"><?php //echo $most_cne[5]; ?></td>
                <td class="text-center"><?php //echo $most_cne[6]; ?></td>
            </tr>
            <?php
            //}
            ?>
        </tbody>
    </table>
</div>