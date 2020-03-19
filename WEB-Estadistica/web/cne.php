<?php
include "../cnx/connection.php";

?>

<div class="mt-3">
    <form id="form-select-cne">
        <div class="row">
            <div>
                <label for="" class="row ml-3">Seleccionar Año:</label>
                <select class="row ml-3" id="anio_eg_cne" name="anio_eg_cne">
                    <option value="0" disabled>Seleccione:</option>
                    <?php
                    $sql_anio_cne = $connection->query("SELECT distinct(anio_eg) FROM egresos_le WHERE tipo_le_eg=1");
                    while ($res_anio_cne = mysqli_fetch_array($sql_anio_cne)) {
                        echo '<option value="' . $res_anio_cne[0] . '">' . $res_anio_cne[0] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="ml-5">
                <label for="" class="row ml-2">Tipo Establecimiento:</label>
                <select class="row mx-2" id="tipo_estable_cne" name="tipo_estable_cne">
                    <option value="0" disabled>Seleccione:</option>
                    <?php
                    $sql_tipo_estable = $connection->query("SELECT * FROM tipo_estable");
                    while ($res_tipo_estable = mysqli_fetch_array($sql_tipo_estable)) {
                        echo '<option value="' . $res_tipo_estable[1] . '">' . $res_tipo_estable[2] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="pl-5 mt-4">
                <button id="btn-cne" type="button" class="btn btn-primary btn-sm">Consultar</button>
            </div>
        </div>
    </form>

</div>

<div id="carga-cne-datos"></div>

<script>
    $(document).ready(function() {

        $('#btn-cne').click(function() {
            datosCNE = $('#form-select-cne').serialize();
            ConsultaCNE(datosCNE);
        });
    });
</script>