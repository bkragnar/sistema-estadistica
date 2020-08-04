<link rel="stylesheet" href="style.css">

<!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

<!-- JS, Popper.js, and jQuery -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js"></script>

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

    //obtener_estructura_directorios($directorio);
    /**
     * Funcion que muestra la estructura de carpetas a partir de la ruta dada.
     */
/*
    function obtener_estructura_directorios($ruta)
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
                        echo "<button class=\"accordion\"><i class=\"fas fa-folder-open fa-3x mr-2 text-warning\"></i>$archivo</button>";
                        //echo "<li>" . $archivo . "</li>";
                        //echo"<div class=\"panel\"><button class=\"accordion\"><i class=\"fas fa-folder-open fa-3x mr-2 text-warning\"></i>$archivo</button></div>";
                        obtener_estructura_directorios($ruta_completa);
                    } else {
                        echo "<div class=\"panel\"><p>$archivo</p></div>";
                        //echo "<li>" . $archivo . "</li>";
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
    */

    echo "<br>";
    echo "<br>";
    echo "<br>";

    /*escanea un directorio completo, sea archivo o carpeta*/
/*
    $directorio = $ruta;
    $ficheros  = scandir($directorio);
    $contador = 0;
    while ($contador < count($ficheros)) {
        if ($ficheros[$contador] != "." && $ficheros[$contador] != ".." && $ficheros[$contador] != ".DS_Store") {
            $cadena .=  "<option value=\"$ficheros[$contador]\">$ficheros[$contador]</option>";
        }
        $contador++;
    }
*/

    /*
    // segunda funcion para recorrer el arbol de directorio y mostrarlo como acorden 
    */

    //función para obtener el nombre de las carpetas y los archivos en array multidimensional
    function dirToArray($dir)
    {
        //creo un array
        $listDir = array();
        //abro los directorios contenidos en $dir
        if ($handler = opendir($dir)) {
            //leo todos los elementos contenidos 
            while (($file = readdir($handler)) !== FALSE) {
                //verifico que hayan elementos
                if ($file != "." && $file != ".." && $file != ".DS_Store") {
                    /*si los elementos son archivos, guardo los elementos 
                en algún indice (dimensión) del array*/
                    if (is_file($dir . "/" . $file)) {
                        $listDir[] = $file;
                        echo "<div class=\"panel\"><p>$file</p></div>";
                        /*si los elementos son directorios, guardo los elementos 
                en otro índice o dimensión, repitiendo hasta que hayan elementos*/
                    } elseif (is_dir($dir . "/" . $file)) {
                        $listDir[$file] = dirToArray($dir . "/" . $file);
                        if (is_dir($dir)) {
                            echo "<button class=\"accordion\"><i class=\"fas fa-folder-open fa-3x mr-2 text-warning\"></i>$file</button>";
                        }
                        echo "<div class=\"panel\"><button class=\"accordion\"><i class=\"fas fa-folder-open fa-3x mr-2 text-warning\"></i>$file</button></div>";
                    }
                }
            }
            closedir($handler);
        }
        return $listDir;
    }

    $dir = $directorio;
    $listDir = dirToArray($dir);

    /*
    // tercera funcion para recorrer el arbol de directorio en base al arreglo dirtoarray
    */
    echo "<br>";
    echo "<br>";
    echo "<br>";
    
   
    //recorro($listDir);

    //aca imprime el arreglo perfecto como debe mostrar en el acordeon
    ksort($listDir);
    echo '<pre>';
    echo print_r($listDir);
    echo '</pre>';

    echo "funcion padre";
    padre($listDir);
    /*
    foreach ($listDir as $listDir => $detalles) {
        //codigo-oscar
        /*
        if (is_array($detalles)) {
            echo "<button class=\"accordion\"><i class=\"fas fa-folder-open fa-3x mr-2 text-warning\"></i>$listDir</button>";
            internos($detalles);
        } else {
            echo "<p>$detalles</p>";
        }

        
        if (!is_array($listDir)) {
           // echo "<h1> $listDir </h1>";
            echo "<button class=\"accordion\"><i class=\"fas fa-folder-open fa-3x mr-2 text-warning\"></i>$listDir</button>";
        }
        foreach ($detalles as $indice => $valor) {
           // echo "<p> $indice:$valor </p>";
          
        if (is_array($valor)) {
            echo "<div class=\"panel\"><p><button class=\"accordion\"><i class=\"fas fa-folder-open fa-3x mr-2 text-warning\"></i>$indice</button></p></div>";
        } else {
            echo "<div class=\"panel\"><p>$valor</p></div>";
        }
        
        }
    }
*/

    function padre($datos)
    {
        foreach ($datos as $llave => $valores) {
            if (is_array($valores)) {
                $ruta_archivo="/".$llave;
    ?>
                <button class="accordion"><i class="fas fa-folder-open fa-3x mr-2 text-warning"></i><?php echo $llave ?></button>
                <div class="panel"><?php echo hijo2($valores,$ruta_archivo) ?></div>
            <?php
            } else {
                echo $valores;
            }
        }
    }

    function hijo2($datos,$ruta_archivo2)
    {
        foreach ($datos as $llave => $valores) {
            $ruta_hijo=$ruta_archivo2;
            if (is_array($valores)) {
                $ruta_hijo=$ruta_hijo."/".$llave
            ?>
                <button class="accordion"><i class="fas fa-folder-open fa-3x mr-2 text-warning"></i><?php echo $llave ?></button>
                <div class="panel"><?php echo hijo2($valores,$ruta_hijo) ?></div>
    <?php
            } else {
                echo $valores." ... la ruta es: ".$ruta_hijo."/".$valores."<br>";
            }
        }
    }



    function recorro($matriz)
    {
        foreach ($matriz as $key => $value) {
            if (is_array($value)) {
                //si es un array sigo recorriendo
                echo 'key:' . $key;
                echo '<br>';
                recorro($value);
            } else {
                //si es un elemento lo muestro
                echo $key . ': ' . $value;
                echo '<br>';
            }
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
</script>