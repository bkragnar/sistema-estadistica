<?php
include "../cnx/connection.php";

$sql_min_max = $connection->query("SELECT min(DISTINCT(anio_eg_ges)),max(DISTINCT(anio_eg_ges))  FROM egresos_ges WHERE estable_eg_ges='105001' and codigo_tipo_ges_eg_ges=3");
$res_min_max = mysqli_fetch_array($sql_min_max);
$a_min = $res_min_max[0];
$a_max = $res_min_max[1];

$sql_anios = $connection->query("SELECT DISTINCT(anio_eg_ges) FROM egresos_ges WHERE estable_eg_ges='105001' and codigo_tipo_ges_eg_ges=3");

?>

<div class="mt-3">
    <div class="row ml-3 container-fluid">
        <div class="row  justify-content-center">
            <div class="col">
                <div class="row">
                    <label>Seleccionar Año:</label><label class="ml-3" id="etiqueta-datalist"></label>
                </div>
                <div class="row ml-2">
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
        </div>
        <div class="row ml-3 justify-content-center">
            <div class="col">
                <div class="row ml-1">
                    <label>Seleccionar Mes:</label><label class="ml-3" id="etiqueta-mv"></label>
                </div>
                <div class="row ml-2">
                    <div id="meses-grafico"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="graficos-vencidas"></div>
<!------------------------------------------------------------------------------------------------->

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