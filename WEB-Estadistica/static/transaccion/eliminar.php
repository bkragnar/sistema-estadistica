<?php
include "../../cnx/connection.php";

$seccion = $_POST['seccion'];

switch ($seccion) {
    case "provincia":
        $id_provincia = $_POST['id'];

        $sql_provincia = "DELETE FROM provincia WHERE id_provincia=$id_provincia";
        echo mysqli_query($connection, $sql_provincia);
        break;

    case "comuna":
        $id_comuna = $_POST['id'];

        $sql_comuna = "DELETE FROM comuna WHERE id_comuna=$id_comuna";
        echo mysqli_query($connection, $sql_comuna);
        break;

    case "tipo_estable":
        $id_tipo_estable = $_POST['id'];

        $sql_tipo_estable = "DELETE FROM tipo_estable WHERE id_tipo_estable=$id_tipo_estable";
        echo mysqli_query($connection, $sql_tipo_estable);
        break;

    case "establecimiento":
        $id_estable = $_POST['id'];

        $sql_estable = "DELETE FROM establecimiento WHERE id_estable=$id_estable";
        echo mysqli_query($connection, $sql_estable);
        break;

    case "tipo-le":
        $id_tipo_le = $_POST['id'];

        $sql_tipo_le = "DELETE FROM tipo_le WHERE id_tipo_le=$id_tipo_estable";
        echo mysqli_query($connection, $sql_tipo_le);
        break;

    case "linea-base":
        $id_lb = $_POST['id'];

        $sql_linea_base = "DELETE FROM linea_base_le WHERE id_lb='$id_lb'";
        echo mysqli_query($connection, $sql_linea_base);
        break;

    case "porcentaje-lb":
        $id_porc_lb = $_POST['id'];

        $sql_porcentaje_lb = "DELETE FROM porcentaje_lb WHERE id_porc_lb='$id_porc_lb'";
        echo mysqli_query($connection, $sql_porcentaje_lb);
        break;

    case "egreso-le":
        $id_egreso_le = $_POST['id'];

        $sql_egreso_le = "DELETE FROM egresos_le WHERE id_egreso='$id_egreso_le'";
        echo mysqli_query($connection, $sql_egreso_le);
        break;

    case "tipoges":
        $id_tipoges = $_POST['id'];

        $sql_tipo_ges = "DELETE FROM tipo_ges WHERE id_tipo_ges='$id_tipoges'";
        echo mysqli_query($connection, $sql_tipo_ges);
        break;

    case "casos-ges":
        $id_casos_ges = $_POST['id'];

        $sql_casos_ges = "DELETE FROM egresos_ges WHERE id_eg_ges='$id_casos_ges'";
        echo mysqli_query($connection, $sql_casos_ges);
        break;
}
