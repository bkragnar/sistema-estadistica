<!-- CSS only -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js"></script>

<style>
    .accordion {
        background-color: #ccc;
        color: #fff;
        cursor: pointer;
        padding: 18px;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        font-size: 15px;
        transition: 0.8s;
    }

    .active,
    .accordion:hover {
        background-color: #eee;
        color: #444;
    }

    .accordion:after {
        content: '\002B';
        color: #777;
        font-weight: bold;
        float: right;
        margin-left: 5px;
    }

    .active:after {
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

<div class="container">
    <?php
    $carpeta = "/2020"; //esta variable es recibida por ajax 

    $directorio = '../static/directorio_noges' . $carpeta;

    $arreglo_archivos = scandir($directorio . "/1_Enero/1_15-01-2020");
    print_r($arreglo_archivos);
    echo "<br>";
    foreach ($arreglo_archivos as $llave => $file) {
        if (!is_dir($file) && $file != "." && $file != "..") {
            $del_ruta = $directorio . "/1_Enero/2_31-01-2020" . '/' . $file;
            echo "Se borrara " . $file . "<br>";
            if (unlink($del_ruta)) {
                echo $file . " Borrado con exito";
            } else {
                echo "no fue posible borrar";
            }
        }
    }

    function dirToArray($dir)
    {
        $listDir = array();
        if ($handler = opendir($dir)) {
            while (($file = readdir($handler)) !== FALSE) {
                if ($file != "." && $file != ".." && $file != ".DS_Store") {
                    if (is_file($dir . "/" . $file)) {
                        $listDir[] = $file;
                        /*si los elementos son directorios, guardo los elementos 
                en otro índice o dimensión, repitiendo hasta que hayan elementos*/
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
    padre($listDir, $directorio);

    function padre($datos, $directorio)
    {
        $cont_id_icono = 0;
        foreach ($datos as $llave => $valores) {
            $ruta_archivo = "/" . $llave;
            if (is_array($valores)) {
    ?>
                <button class="accordion" onclick="cambia_Icono(<?php echo $cont_id_icono; ?>)"><i id="id<?php echo $cont_id_icono; ?>" class="fas fa-folder fa-3x mr-2 text-warning"></i><?php echo NombreCcarpeta($llave); ?></button>
                <?php $cont_id_icono++; ?>
                <div class="panel"><?php echo hijo($valores, $ruta_archivo, $cont_id_icono, $directorio) ?></div>
            <?php
            } else {
                //echo $valores;
            ?>
                <div class="container">
                    <div class="row border-right border-left py-2">
                        <div class="col"><?php echo $valores ?></div>
                        <div class="col-2 text-center">
                            <a class="btn btn-success btn-sm" href="<?php echo $directorio . $ruta_archivo . "/" . $valores; ?>" download="<?php echo $directorio . $ruta_archivo . "/" . $valores; ?>" data-toggle="tooltip" data-placement="top" title="Descargar">
                                <span class="fas fa-download"></span></a>
                        </div>
                    </div>
                </div>
            <?php
            }
        }
    }

    function hijo($datos, $ruta_archivo2, $cont_id_icono, $directorio)
    {
        foreach ($datos as $llave => $valores) {
            $ruta_hijo = $ruta_archivo2;
            if (is_array($valores)) {
                $ruta_hijo = $ruta_hijo . "/" . $llave
            ?>
                <button class="accordion" onclick="cambia_Icono(<?php echo $cont_id_icono; ?>)"><i id="id<?php echo $cont_id_icono; ?>" class="fas fa-folder fa-3x mr-2 text-warning"></i><?php echo NombreCcarpeta($llave); ?></button>
                <?php $cont_id_icono++; ?>
                <div class="panel"><?php echo hijo($valores, $ruta_hijo, $cont_id_icono, $directorio) ?></div>
            <?php
            } else {
                //echo $valores." ... la ruta es: ".$ruta_hijo."/".$valores."<br>";
            ?>
                <div class="container">
                    <div class="row border-right border-left py-2">
                        <div class="col"><?php echo $valores ?></div>
                        <div class="col-2 text-center">
                            <a class="btn btn-success btn-sm" href="<?php echo $directorio . $ruta_hijo . "/" . $valores; ?>" download="<?php echo $directorio . $ruta_hijo . "/" . $valores; ?>" data-toggle="tooltip" data-placement="top" title="Descargar">
                                <span class="fas fa-download"></span></a>
                        </div>
                    </div>
                </div>
    <?php
            }
        }
    }

    function NombreCcarpeta($nombre)
    {
        $posicion = strpos($nombre, '_');
        $nuevo_nombre = substr($nombre, $posicion + 1);
        return ($nuevo_nombre);
    }

    //--------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------
    function dirToArray2($dir)
    {
        $listDir = array();
        if ($handler = opendir($dir)) {
            while (($file = readdir($handler)) !== FALSE) {
                if ($file != "." && $file != ".." && $file != ".DS_Store") {
                    if (is_file($dir . "/" . $file)) {
                        $listDir[$file] = $dir . $file;
                    }
                }
            }
            closedir($handler);
        }
        return $listDir;
    }
    $src = "../static/directorio_noges/2020/1_Enero/";
    //corta la ruta del archivo y solo deja la ruta del directorio padre 
    $posicion = strrpos($src, '/');
    $abrir_dir = substr($src, 0, $posicion + 1);
    //----------------------------------------------------------------------
    $archivos = dirToArray2($src);

    echo '<pre>';
    print_r($archivos);
    echo '</pre>';
    $valor_a_imprimir = $archivos["egreso_cneo_sigte_29-02-2020.xlsx"];
    echo $valor_a_imprimir;

    $ruta = $archivos["egreso_cneo_sigte_29-02-2020.xlsx"];
        //$archivo = basename($ruta);

        header("Content-type: application/octet-stream");
        header("Content-Type: application/force-download");
        header("Content-Disposition: attachment; filename=egreso_cneo_sigte_29-02-2020.xlsx");
        readfile($ruta);

    //--------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------


    ?>


</div>

<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();

        var acc = document.getElementsByClassName("accordion");
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


    //cambia el icono de la carpeta de cerrado a abierta
    function cambia_Icono(contador_icono) {
        var icono = $("#id" + contador_icono);
        if (icono.hasClass("fa-folder")) {
            icono.removeClass("fa-folder");
            icono.addClass("fa-folder-open");
        } else {
            icono.removeClass("fa-folder-open");
            icono.addClass("fa-folder");
        }
    }
</script>