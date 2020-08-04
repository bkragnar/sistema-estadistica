<?php
function OrdenaDir()
{
    $ruta  = "../static/directorio_noges/";
    if (is_dir($ruta)) {
        $gestor = opendir($ruta);
        while (($archivo = readdir($gestor)) !== false) {
            $ruta_completa = $ruta . "/" . $archivo;
            if ($archivo != "." && $archivo != ".." && $archivo != ".DS_Store") {
                if (is_dir($ruta_completa)) {
                    $list_dir[] = $archivo;
                }
            }
        }
        closedir($gestor);
    }
    arsort($list_dir);
    return ($list_dir);
}

?>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card text-left">
                <div class="card-header">
                    Documentos NO GES
                </div>
                <div class="card-body">
                    <div class="col-3">
                        <div class="text-center">
                            <label>Seleccionar directorio: </label>
                            <select name="mostrar_directorio_no_ges" id="mostrar_directorio_no_ges" class="form-control input-sm">
                                <?php
                                $directorio = OrdenaDir();
                                foreach ($directorio as $llave => $dato) {
                                    echo  "<option value=\"$dato\">$dato</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div id="contenido_archivos"></div>
                </div>
                <div class="card-footer text-muted">
                    Sub-Departamento de Estadísticas y Gestión de la Información
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        cargar_archivos_noges($('#mostrar_directorio_no_ges').val());

        $('#mostrar_directorio_no_ges').on("change",function(){
            cargar_archivos_noges($(this).val());
        });

        function cargar_archivos_noges(dato) {
            $.ajax({
                type: "POST",
                url: "web/directorio_noges.php",
                data: "carpeta="+dato,
                success: function(r) {
                    $('#contenido_archivos').html(r);
                }
            });
        }


    });
</script>