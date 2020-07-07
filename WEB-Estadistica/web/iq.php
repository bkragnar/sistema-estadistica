<?php
include "../cnx/connection.php";

?>

<div class="mt-3">
    <form id="form-select-iq">
        <div class="row">
            <div>
                <label for="" class="row ml-3">Seleccionar Año:</label>
                <select class="row ml-3" id="anio_eg_iq" name="anio_eg_iq">
                    <option value="0" disabled>Seleccione:</option>
                    <?php
                    $sql_anio_iq = $connection->query("SELECT distinct(anio_eg) FROM egresos_le WHERE tipo_le_eg=4");
                    while ($res_anio_iq = mysqli_fetch_array($sql_anio_iq)) {
                        echo '<option value="' . $res_anio_iq[0] . '">' . $res_anio_iq[0] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="ml-5">
                <label for="" class="row ml-2">Tipo Establecimiento:</label>
                <select class="row mx-2" id="tipo_estable_iq" name="tipo_estable_iq">
                    <option value="0" disabled>Seleccione:</option>
                    <?php
                    $sql_tipo_estable = $connection->query("SELECT * FROM tipo_estable");
                    while ($res_tipo_estable = mysqli_fetch_array($sql_tipo_estable)) {
                        echo '<option value="' . $res_tipo_estable[1] . '">' . $res_tipo_estable[2] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="ml-5" id="select-comuna-iq"></div>
            <div class="pl-5 mt-4">
                <button id="btn-iq" type="button" class="btn btn-primary btn-sm">Consultar</button>
            </div>
        </div>
    </form>

</div>

<div id="carga-iq-datos"></div>

<script>
    $(document).ready(function() {
        if ($('#tipo_estable_iq').val() == 1) {
            $('#select-comuna-iq').show();
            recargarLista_comuna(4);
        } else {
            $('#select-comuna-iq').hide();
        }
        $('#tipo_estable_iq').change(function() {
            if ($('#tipo_estable_iq').val() == 1) {
                $('#select-comuna-iq').show();
                recargarLista_comuna(4);
            } else {
                $('#select-comuna-iq').hide();
            }
        });

        $('#btn-iq').click(function() {
            if ($('#tipo_estable_iq').val() == 1) {
                if ($('#comuna_no_ges').val() != 0) {
                    datosiq = $('#form-select-iq').serialize();
                    ConsultaIQ(datosiq);
                } else {
                    alertify.error("Debe seleccionar una comuna");
                }
            } else {
                datosiq = $('#form-select-iq').serialize();
                ConsultaIQ(datosiq);
            }
        });
    });
</script>