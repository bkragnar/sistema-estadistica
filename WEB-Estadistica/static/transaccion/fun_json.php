<?php
include "../../cnx/connection.php";
include_once "obtenDatos.php";
$obj = new obtdatos();

$seccion = $_POST['seccion'];

switch ($seccion) {

    case "provincia":
        echo json_encode($obj->obtprovincia($_POST['id_provincia']));
        break;

    case "comuna":
        echo json_encode($obj->obtcomuna($_POST['id_comuna']));
        break;

    case "tipo_estable":
        echo json_encode($obj->obttipoestable($_POST['id_tipo_estable']));
        break;

    case "establecimiento":
        echo json_encode($obj->obtestable($_POST['id_estable']));
        break;

    case "tipo-le":
        echo json_encode($obj->obttipole($_POST['id_tipo_le']));
        break;

    case "linea-base":
        echo json_encode($obj->obtlb($_POST['id_lb']));
        break;

    case "porcentaje-lb":
        echo json_encode($obj->obtporc_lb($_POST['id_porc']));
        break;

    case "egreso-le":
        echo json_encode($obj->obtegresole($_POST['id_egreso']));
        break;

    case "tipoges":
        echo json_encode($obj->obttipoges($_POST['id_tipo_ges']));
        break;

    case "casos-ges":
        echo json_encode($obj->obtcasosges($_POST['id_casos_ges']));
        break;
}
