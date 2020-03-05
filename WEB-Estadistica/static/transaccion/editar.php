<?php 
    include "../../cnx/connection.php";

    $seccion = $_POST['seccion'];

    switch ($seccion){
        case "provincia":
            $id_provincia = $_POST['id_provincia'];
            $codigo_provincia = $_POST['codigo_provincia_up'];
            $nombre_provincia = $_POST['nombre_provincia_up'];

            $sql_provincia = "UPDATE provincia SET codigo_provincia='$codigo_provincia',nombre_provincia='$nombre_provincia'
                                WHERE id_provincia=$id_provincia";
            echo mysqli_query($connection,$sql_provincia);
        break;

        case "comuna":
            $id_comuna = $_POST['id_comuna'];
            $codigo_comuna = $_POST['codigo_comuna_up'];
            $nombre_comuna = $_POST['nombre_comuna_up'];
            $cod_provincia_comuna = $_POST['codigo_provincia_comuna_up'];

            $sql_comuna = "UPDATE comuna SET codigo_comuna='$codigo_comuna',nombre_comuna='$nombre_comuna',codigo_provincia='$cod_provincia_comuna'
                           WHERE id_comuna=$id_comuna";
            echo mysqli_query($connection,$sql_comuna);
        break;

        case "tipo_estable":
            $id_tipo_estable = $_POST['id_tipo_estable'];
            $codigo_tipo_estable = $_POST['codigo_tipo_estable_up'];
            $nombre_tipo_estable = $_POST['nombre_tipo_estable_up'];

            $sql_tipo_estable = "UPDATE tipo_estable SET codigo_tipo='$codigo_tipo_estable',nombre_tipo='$nombre_tipo_estable'
                            WHERE id_tipo_estable=$id_tipo_estable";
            echo mysqli_query($connection,$sql_tipo_estable);
        break;

        case "establecimiento":
            $id_estable = $_POST['id_estable'];
            $codigo_estable = $_POST['codigo_estable_up'];
            $nombre_estable = $_POST['nombre_estable_up'];
            $codigo_comuna_estable = $_POST['cod_comuna_estable_up'];
            $codigo_provincia_estable = $_POST['cod_provincia_estable_up'];
            $tipo_estable = $_POST['tipo_estable_up'];

            $sql_estable = "UPDATE establecimiento SET codigo_estable='$codigo_estable',nombre_estable='$nombre_estable',codigo_comuna='$codigo_comuna_estable',codigo_provincia='$codigo_provincia_estable',tipo_estable='$tipo_estable'
                            WHERE id_estable=$id_estable";
            echo mysqli_query($connection,$sql_estable);
        break;
        
        case "tipo-le":
            $id_tipo_le = $_POST['id_tipo_le'];
            $codigo_tipo_le =$_POST['codigo_tipo_le_up'];
            $nombre_tipo_le=$_POST['nombre_tipo_le_up'];

            $sql_tipo_le="UPDATE tipo_le SET codigo_tipo_le='$codigo_tipo_le',nombre_tipo_le='$nombre_tipo_le' WHERE id_tipo_le=$id_tipo_le";
            echo mysqli_query($connection,$sql_tipo_le);
        break;
    }
