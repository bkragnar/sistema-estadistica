

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

    .active,
    .accordion:hover {
        background-color: #ccc;
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
    $directorio = '../static/directorio_noges' . $carpeta; //aca va la ruta del directorio a explorar

    /*
    // primera funcion para recorrer el arbol de directorio y mostrarlo como acorden 
    */

    obtener_estructura_directorios($directorio);
    /**
     * Funcion que muestra la estructura de carpetas a partir de la ruta dada.
     */

    function obtener_estructura_directorios($ruta)
    {
        $cont_id_boton = 0;
        $cont_id_icono = 0;
        // Se comprueba que realmente sea la ruta de un directorio
        if (is_dir($ruta)) {
            // Abre un gestor de directorios para la ruta indicada
            $gestor = opendir($ruta);
            //echo "<ul>";
            // Recorre todos los elementos del directorio
            while (($archivo = readdir($gestor)) !== false) {
                $ruta_completa = $ruta . "/" . $archivo;
                // Se muestran todos los archivos y carpetas excepto "." y ".."
                if ($archivo != "." && $archivo != ".." && $archivo != ".DS_Store") {
                    // Si es un directorio se recorre recursivamente
                    if (is_dir($ruta_completa)) {
    ?>
                        <button id="id_boton<?php echo $cont_id_boton;?>" class="accordion" onclick="cambia_Icono(<?php echo $cont_id_boton; ?>,<?php echo $cont_id_icono; ?>)"><i id="id<?php echo $cont_id_icono; ?>" class="carpeta fas fa-folder fa-3x mr-2 text-warning"></i><?php echo $archivo ?></button>
                        <?php $cont_id_boton++;
                        $cont_id_icono++; ?>
                        <div class="panel"><?php obtener_hijo($ruta_completa, $cont_id_boton, $cont_id_icono) ?></div>
                    <?php
                    } else {
                        echo $archivo . " la ruta del archivo es:" . $ruta_completa;
                    }
                }
            }
            // Cierra el gestor de directorios
            closedir($gestor);
            //echo "</ul>";
        } else {
            echo "No es una ruta de directorio valida<br/>";
        }
    }

    function obtener_hijo($ruta, $cont_id_boton, $cont_id_icono)
    {

        // Se comprueba que realmente sea la ruta de un directorio
        if (is_dir($ruta)) {
            // Abre un gestor de directorios para la ruta indicada
            $gestor = opendir($ruta);
            //echo "<ul>";
            // Recorre todos los elementos del directorio
            while (($archivo = readdir($gestor)) !== false) {

                $ruta_completa = $ruta . "/" . $archivo;
                // Se muestran todos los archivos y carpetas excepto "." y ".."
                if ($archivo != "." && $archivo != ".." && $archivo != ".DS_Store") {
                    // Si es un directorio se recorre recursivamente
                    if (is_dir($ruta_completa)) {
                    ?>
                        <button id="id_boton<?php echo $cont_id_boton; ?>" class="accordion" onclick="cambia_Icono(<?php echo $cont_id_boton; ?>,<?php echo $cont_id_icono; ?>)"><i id="id<?php echo $cont_id_icono; ?>" class="fas fa-folder fa-3x mr-2 text-warning"></i><?php echo $archivo ?></button>
                        <?php $cont_id_boton++;
                        $cont_id_icono++; ?>

                        <div class="panel"><?php obtener_hijo($ruta_completa, $cont_id_boton, $cont_id_icono) ?></div>

                    <?php
                    } else {
                        //echo $archivo . " la ruta del archivo es:" . $ruta_completa;
                    ?>
                        <div class="container">
                            <div class="row border-right border-left py-2">
                                <div class="col"><?php echo $archivo ?></div>
                                <div class="col-2 text-center">
                                    <a class="btn btn-success btn-sm" href="<?php echo $ruta_completa; ?>" download="<?php echo $ruta_completa; ?>">
                                        <span class="fas fa-download"></span></a>
                                </div>
                            </div>
                        </div>

    <?php
                    }
                }
            }
            // Cierra el gestor de directorios
            closedir($gestor);
            //echo "</ul>";
        } else {
            echo "No es una ruta de directorio valida<br/>";
        }
    }




    ?>

</div>

<script>
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

    function cambia_Icono(contador_boton, contador_icono) {

        var icono = $("#id" + contador_icono);
        if(icono.hasClass("fa-folder")){
            icono.removeClass("fa-folder");
            icono.addClass("fa-folder-open");
        }else{
            icono.removeClass("fa-folder-open");
            icono.addClass("fa-folder");
        }
    }
</script>