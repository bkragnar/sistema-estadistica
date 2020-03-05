<?php 
    include "../../cnx/connection.php";

    $seccion = $_POST['seccion'];

    switch ($seccion){
        case "provincia":
            $codigo_provincia = $_POST['codigo_provincia'];
            $nombre_provincia = $_POST['nombre_provincia'];

            $sql_provincia = "INSERT INTO provincia (codigo_provincia,nombre_provincia)
                            VALUES ('$codigo_provincia','$nombre_provincia')";
            echo mysqli_query($connection,$sql_provincia);
        break;

        case "comuna":
            $codigo_comuna = $_POST['codigo_comuna'];
            $nombre_comuna = $_POST['nombre_comuna'];
            $cod_provincia_comuna = $_POST['codigo_provincia_comuna'];

            $sql_comuna = "INSERT INTO comuna(codigo_comuna,nombre_comuna,codigo_provincia)
                            VALUES('$codigo_comuna','$nombre_comuna','$cod_provincia_comuna')";
            echo mysqli_query($connection,$sql_comuna);
        break;

        case "tipo_estable":
            $codigo_tipo_estable = $_POST['codigo_tipo_estable'];
            $nombre_tipo_estable = $_POST['nombre_tipo_estable'];

            $sql_tipo_estable = "INSERT INTO tipo_estable (codigo_tipo,nombre_tipo)
                            VALUES('$codigo_tipo_estable','$nombre_tipo_estable')";
            echo mysqli_query($connection,$sql_tipo_estable);
        break;

        case "establecimiento":
            $codigo_estable = $_POST['codigo_estable'];
            $nombre_estable = $_POST['nombre_estable'];
            $codigo_comuna_estable = $_POST['cod_comuna_estable'];
            $codigo_provincia_estable = $_POST['cod_provincia_estable'];
            $tipo_estable = $_POST['tipo_estable'];

            $sql_estable = "INSERT INTO establecimiento (codigo_estable,nombre_estable,codigo_comuna,codigo_provincia,tipo_estable)
                            VALUES('$codigo_estable','$nombre_estable','$codigo_comuna_estable','$codigo_provincia_estable','$tipo_estable')";
            echo mysqli_query($connection,$sql_estable);
        break;

        case "tipo-le":
            $codigo_tipo_le=$_POST['codigo_tipo_le'];
            $nombre_tipo_le=$_POST['nombre_tipo_le'];

            $sql_tipo_le="INSERT INTO tipo_le (codigo_tipo_le,nombre_tipo_le) VALUES('$codigo_tipo_le','$nombre_tipo_le')";
            echo mysqli_query($connection,$sql_tipo_le);
        break;
        
    }

?>