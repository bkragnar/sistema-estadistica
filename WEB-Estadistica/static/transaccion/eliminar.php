<?php 
    include "../../cnx/connection.php";

    $seccion = $_POST['seccion'];

    switch ($seccion){
        case "provincia":
            $id_provincia = $_POST['id'];

            $sql_provincia = "DELETE FROM provincia WHERE id_provincia=$id_provincia";
            echo mysqli_query($connection,$sql_provincia);
        break;

        case "comuna":
            $id_comuna = $_POST['id'];

            $sql_comuna = "DELETE FROM comuna WHERE id_comuna=$id_comuna";
            echo mysqli_query($connection,$sql_comuna);
        break;

        case "tipo_estable":
            $id_tipo_estable = $_POST['id'];

            $sql_tipo_estable = "DELETE FROM tipo_estable WHERE id_tipo_estable=$id_tipo_estable";
            echo mysqli_query($connection,$sql_tipo_estable);
        break;

        case "establecimiento":
            $id_estable = $_POST['id'];

            $sql_estable = "DELETE FROM establecimiento WHERE id_estable=$id_estable";
            echo mysqli_query($connection,$sql_estable);
        break;

        case "tipo-le":
            $id_tipo_le=$_POST['id'];

            $sql_tipo_le="DELETE FROM tipo_le WHERE id_tipo_le=$id_tipo_estable";
            echo mysqli_query($connection,$sql_tipo_le);
        break;
        
    }

?>