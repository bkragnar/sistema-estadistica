<style>
    .accordion {
        background-color: #eee;
        color: #444;
        cursor: pointer;
        padding: 18px;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        font-size: 15px;
        transition: 0.8s;
    }

    .muestra_dir_noges .active,
    .accordion:hover {
        background-color: #fff;
        color: #444;
    }

    .accordion:after {
        content: '\002B';
        color: #777;
        font-weight: bold;
        float: right;
        margin-left: 5px;
    }

    .muestra_dir_noges .active:after {
        content: "\2212";
    }

    .panel {
        padding: 0 18px;
        background-color: white;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.5s ease-out;
    }
</style>


<div class="muestra_dir_noges">
    <?php
    $carpeta = $_POST['carpeta']; //esta variable es recibida por ajax
    $directorio = '../static/directorio_noges/' . $carpeta; //aca va la ruta del directorio a explorar
    $ruta_descarga = '../static/directorio_noges/' . $carpeta;

    function tipo_archivo($ext)
    {
        switch ($ext) {
            case "doc":
            case "docx":
                $ext = "fas fa-file-word word";
                break;
            case "pptx":
            case "ppsx":
            case "pptm":
            case "ppt":
            case "pps":
                $ext = "fas fa-file-powerpoint ppt";
                break;
            case "xlsx":
            case "xls":
            case "xlsm":
                $ext = "fas fa-file-excel excel";
                break;
            case "pdf":
                $ext = "fas fa-file-pdf pdf";
                break;
            case "png":
            case "PNG":
            case "jpg":
            case "JPG":
            case "jpeg":
            case "JPEG":
                $ext = "fas fa-file-image imagen";
        }
        return $ext;
    }

    function dirToArray($dir)
    {
        $listDir = array();
        if ($handler = opendir($dir)) {
            while (($file = readdir($handler)) !== FALSE) {
                if ($file != "." && $file != ".." && $file != ".DS_Store") {
                    if (is_file($dir . "/" . $file)) {
                        $listDir[] = $file;
                    } elseif (is_dir($dir . "/" . $file)) {
                        $listDir[$file] = dirToArray($dir . "/" . $file);
                    }
                }
            }
            closedir($handler);
        }
        return $listDir;
    }

    $listDir = dirToArray($directorio);
    //ordeno el directorio por clave
    ksort($listDir);

    $cont_id_icono = 0;

    padre($listDir, $ruta_descarga, $carpeta);

    function padre($datos, $directorio,$anio)
    {
        $anio=str_replace("/","", $anio);
        global $cont_id_icono;
        foreach ($datos as $llave => $valores) {
            $ruta_archivo = "/" . $llave;
            if (is_array($valores)) {
    ?>
                <button class="accordion" onclick="cambia_Icono(<?php echo $cont_id_icono; ?>)"><i id="id<?php echo $cont_id_icono; ?>" class="fas fa-folder fa-3x mr-2 text-warning"></i><b><?php echo NombreCarpeta($llave); ?></b></button>
                <?php $cont_id_icono++; ?>
                <div class="panel"><?php echo hijo($valores, $ruta_archivo, $directorio, $anio) ?></div>
            <?php
            } else {
                $extension = end(explode(".", $valores));
                $icono = tipo_archivo($extension);
                $ruta_archivo_padre = $anio;
            ?>
                <div class="container">
                    <div class="row border-right border-left py-2">
                        <div class="col"><span class="<?php echo $icono; ?> fa-2x mr-2"></span><span><?php echo $valores ?></span></div>
                        <div class="col-2 text-center">
                            <a class="btn btn-success text-white btn-sm" onclick="funciondes('<?php echo $ruta_archivo_padre . '/' . $valores; ?>')" data-toggle="tooltip" data-placement="top" title="Descargar">
                                <span class="fas fa-download"></span></a>
                        </div>
                    </div>
                </div>
            <?php
            }
        }
    }

    function hijo($datos, $ruta_archivo2, $directorio, $anio)
    {
        global $cont_id_icono;
        foreach ($datos as $llave => $valores) {
            $ruta_hijo = $ruta_archivo2;
            if (is_array($valores)) {
                $ruta_hijo = $ruta_hijo . "/" . $llave
            ?>
                <button class="accordion" onclick="cambia_Icono(<?php echo $cont_id_icono; ?>)"><i id="id<?php echo $cont_id_icono; ?>" class="fas fa-folder fa-3x mr-2 text-warning"></i><?php echo NombreCarpeta($llave); ?></button>
                <?php $cont_id_icono++; ?>
                <div class="panel"><?php echo hijo($valores, $ruta_hijo, $directorio,$anio) ?></div>
            <?php
            } else {
                $extension = end(explode(".", $valores));
                $icono = tipo_archivo($extension);
            ?>
                <div class="container">
                    <div class="row border-right border-left py-2">
                        <div class="col"><span class="<?php echo $icono; ?> fa-2x mr-2"></span><span><?php echo $valores ?></span></div>
                        <div class="col-2 text-center">
                            <a class="btn btn-success text-white btn-sm" onclick="funciondes('<?php echo $anio.$ruta_hijo . '/' . $valores; ?>')" data-toggle="tooltip" data-placement="top" title="Descargar">
                                <span class="fas fa-download"></span></a>
                        </div>
                    </div>
                </div>
    <?php
            }
        }
    }

    function NombreCarpeta($nombre)
    {
        $posicion = strpos($nombre, '_');
        $nuevo_nombre = substr($nombre, $posicion + 1);
        return ($nuevo_nombre);
    }
    ?>
</div>


<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();

        //var acc = document.getElementsByClassName("accordion");
        var acc = $('.accordion');
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.maxHeight) {
                    panel.style.maxHeight = null;
                } else {
                    panel.style.maxHeight = panel.scrollHeight + "%";
                }
            });
        }
    });

    function funciondes(src) {
        var token = $('#token_publico_descarga').val();
        window.location.href = 'web/descargas.php?ruta=' + src + '&token=' + token;
    }

    //cambia el icono de la carpeta de cerrado a abierta
    function cambia_Icono(contador_icono) {
        var icono = $("#id" + contador_icono);
        if (icono.hasClass("fa-folder")) {
            icono.removeClass("fa-folder");
            icono.addClass("fa-folder-open");
        } else if (icono.hasClass("fa-folder-open")) {
            icono.removeClass("fa-folder-open");
            icono.addClass("fa-folder");
        }
    }
</script>