<?php
include "../../cnx/connection.php";

$seccion = $_POST['seccion'];

switch ($seccion) {
    case "provincia":
        $id_provincia = $_POST['id_provincia'];
        $codigo_provincia = $_POST['codigo_provincia_up'];
        $nombre_provincia = $_POST['nombre_provincia_up'];

        $sql_provincia = "UPDATE provincia SET codigo_provincia='$codigo_provincia',nombre_provincia='$nombre_provincia'
                                WHERE id_provincia=$id_provincia";
        echo mysqli_query($connection, $sql_provincia);
        break;

    case "comuna":
        $id_comuna = $_POST['id_comuna'];
        $codigo_comuna = $_POST['codigo_comuna_up'];
        $nombre_comuna = $_POST['nombre_comuna_up'];
        $cod_provincia_comuna = $_POST['codigo_provincia_comuna_up'];

        $sql_comuna = "UPDATE comuna SET codigo_comuna='$codigo_comuna',nombre_comuna='$nombre_comuna',codigo_provincia='$cod_provincia_comuna'
                           WHERE id_comuna=$id_comuna";
        echo mysqli_query($connection, $sql_comuna);
        break;

    case "tipo_estable":
        $id_tipo_estable = $_POST['id_tipo_estable'];
        $codigo_tipo_estable = $_POST['codigo_tipo_estable_up'];
        $nombre_tipo_estable = $_POST['nombre_tipo_estable_up'];

        $sql_tipo_estable = "UPDATE tipo_estable SET codigo_tipo='$codigo_tipo_estable',nombre_tipo='$nombre_tipo_estable'
                            WHERE id_tipo_estable=$id_tipo_estable";
        echo mysqli_query($connection, $sql_tipo_estable);
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
        echo mysqli_query($connection, $sql_estable);
        break;

    case "tipo-le":
        $id_tipo_le = $_POST['id_tipo_le'];
        $codigo_tipo_le = $_POST['codigo_tipo_le_up'];
        $nombre_tipo_le = $_POST['nombre_tipo_le_up'];

        $sql_tipo_le = "UPDATE tipo_le SET codigo_tipo_le='$codigo_tipo_le',nombre_tipo_le='$nombre_tipo_le' WHERE id_tipo_le=$id_tipo_le";
        echo mysqli_query($connection, $sql_tipo_le);
        break;

    case "linea-base":
        $id_lb = $_POST['id_linea_base'];
        $codigo_estable_lb = $_POST['estable_linea_base_up'];
        $cantidad_lb = $_POST['cantidad_linea_base_up'];
        $anio_lb = $_POST['anio_linea_base_up'];

        $sql_linea_base_up = "UPDATE linea_base_le SET codigo_estable_lb=$codigo_estable_lb, cantidad_lb=$cantidad_lb, anio_lb=$anio_lb WHERE id_lb='$id_lb'";
        echo mysqli_query($connection, $sql_linea_base_up);
        break;

    case "porcentaje-lb":
        $id_porc_lb_up = $_POST['id_porc_lb'];
        $tipo_estable_porc_lb_up = $_POST['tipo_estable_porcentaje_lb_up'];
        $primer_corte_up = $_POST['primer_porcentaje_lb_up'];
        $segundo_corte_up = $_POST['segundo_porcentaje_lb_up'];
        $tercer_corte_up = $_POST['tercer_porcentaje_lb_up'];
        $cuarto_corte_up = $_POST['cuarto_porcentaje_lb_up'];
        $anio_porc_lb_up = $_POST['anio_porcentaje_lb_up'];

        $sql_porcentaje_lb_up = "UPDATE porcentaje_lb SET tipo_estable_porc_lb=$tipo_estable_porc_lb_up,pri_corte_porc_lb=$primer_corte_up,seg_corte_porc_lb=$segundo_corte_up,ter_corte_porc_lb=$tercer_corte_up,cto_corte_porc_lb=$cuarto_corte_up,anio_corte_porc_lb=$anio_porc_lb_up
                                WHERE id_porc_lb='$id_porc_lb_up'";
        echo mysqli_query($connection, $sql_porcentaje_lb_up);
        break;

    case "egreso-le":
        $id_egreso_up = $_POST['id_egreso_le'];
        $estable_eg_up = $_POST['estable_egreso_le_up'];
        $cantidad_eg_up = $_POST['cantidad_egreso_le_up'];
        $mes_eg_up = $_POST['mes_egreso_le_up'];
        $anio_eg_up = $_POST['anio_egreso_le_up'];
        $tipo_le_eg_up = $_POST['tipo_le_egreso_le_up'];

        $sql_egreso_le ="UPDATE egresos_le SET estable_eg=$estable_eg_up,cantidad_eg=$cantidad_eg_up,mes_eg=$mes_eg_up,anio_eg=$anio_eg_up,tipo_le_eg=$tipo_le_eg_up 
                        WHERE id_egreso='$id_egreso_up'";
        echo mysqli_query($connection,$sql_egreso_le);
        break;
}
