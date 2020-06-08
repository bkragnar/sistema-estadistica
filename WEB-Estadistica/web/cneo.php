<?php
include "../cnx/connection.php";

?>

<div class="mt-3">
    <form id="form-select-cno">
        <div class="row">
            <div>
                <label for="" class="row ml-3">Seleccionar Año:</label>
                <select class="row ml-3" id="anio_eg_cno" name="anio_eg_cno">
                    <option value="0" disabled>Seleccione:</option>
                    <?php
                    $sql_anio_cno = $connection->query("SELECT distinct(anio_eg) FROM egresos_le WHERE tipo_le_eg=2");
                    while ($res_anio_cno = mysqli_fetch_array($sql_anio_cno)) {
                        echo '<option value="' . $res_anio_cno[0] . '">' . $res_anio_cno[0] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="ml-5">
                <label for="" class="row ml-2">Tipo Establecimiento:</label>
                <select class="row mx-2" id="tipo_estable_cno" name="tipo_estable_cno">
                    <option value="0" disabled>Seleccione:</option>
                    <?php
                    $sql_tipo_estable = $connection->query("SELECT * FROM tipo_estable");
                    while ($res_tipo_estable = mysqli_fetch_array($sql_tipo_estable)) {
                        echo '<option value="' . $res_tipo_estable[1] . '">' . $res_tipo_estable[2] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="ml-5" id="select-comuna-cno"></div>
            <div class="pl-5 mt-4">
                <button id="btn-cno" type="button" class="btn btn-primary btn-sm">Consultar</button>
            </div>
        </div>
    </form>

</div>

<div id="carga-cno-datos"></div>

<script>
    $(document).ready(function() {
        if ($('#tipo_estable_cno').val() == 1) {
            $('#select-comuna-cno').show();
            recargarLista_comuna(2);
        } else {
            $('#select-comuna-cno').hide();
        }
        $('#tipo_estable_cno').change(function() {
            if ($('#tipo_estable_cno').val() == 1) {
                $('#select-comuna-cno').show();
                recargarLista_comuna(2);
            } else {
                $('#select-comuna-cno').hide();
            }
        });

        $('#btn-cno').click(function() {
            if ($('#tipo_estable_cno').val() == 1) {
                if ($('#comuna_no_ges').val() != 0) {
                    datoscno = $('#form-select-cno').serialize();
                    Consultacno(datoscno);
                } else {
                    alertify.error("Debe seleccionar una comuna");
                }
            } else {
                datoscno = $('#form-select-cno').serialize();
                Consultacno(datoscno);
            }
        });
    });
</script>