<?php

class obtdatos
{

    public function obtprovincia($id_provincia)
    {
        include "../../cnx/connection.php";

        $sql_provincia = "SELECT * FROM provincia WHERE id_provincia='$id_provincia'";
        $res_provincia = mysqli_query($connection, $sql_provincia);
        $ver_provincia = mysqli_fetch_array($res_provincia);
        $datos_provincia = array(
            'id_provincia' => $ver_provincia[0],
            'codigo_provincia' => $ver_provincia[1],
            'nombre_provincia' => $ver_provincia[2]
        );
        return $datos_provincia;
    }

    public function obtcomuna($id_comuna)
    {
        include "../../cnx/connection.php";

        $sql_comuna = "SELECT * FROM comuna WHERE id_comuna='$id_comuna'";
        $res_comuna = mysqli_query($connection, $sql_comuna);
        $ver_comuna = mysqli_fetch_array($res_comuna);
        $datos_comuna = array(
            'id_comuna' => $ver_comuna[0],
            'codigo_comuna' => $ver_comuna[1],
            'nombre_comuna' => $ver_comuna[2],
            'codigo_provincia' => $ver_comuna[3]
        );
        return $datos_comuna;
    }

    public function obttipoestable($id_tipo_estable)
    {
        include "../../cnx/connection.php";

        $sql_tipo_estable = "SELECT * FROM tipo_estable WHERE id_tipo_estable='$id_tipo_estable'";
        $res_tipo_estable = mysqli_query($connection, $sql_tipo_estable);
        $ver_tipo_estable = mysqli_fetch_array($res_tipo_estable);
        $datos_tipo_estable = array(
            'id_tipo_estable' => $ver_tipo_estable[0],
            'codigo_tipo' => $ver_tipo_estable[1],
            'nombre_tipo' => $ver_tipo_estable[2]
        );
        return $datos_tipo_estable;
    }

    public function obtestable($id_estable)
    {
        include "../../cnx/connection.php";

        $sql_estable = "SELECT * FROM establecimiento WHERE id_estable='$id_estable'";
        $res_estable = mysqli_query($connection, $sql_estable);
        $ver_estable = mysqli_fetch_array($res_estable);
        $datos_estable = array(
            'id_estable' => $ver_estable[0],
            'codigo_estable' => $ver_estable[1],
            'nombre_estable' => $ver_estable[2],
            'codigo_comuna' => $ver_estable[3],
            'codigo_provincia' => $ver_estable[4],
            'tipo_estable' => $ver_estable[5]
        );
        return $datos_estable;
    }

    public function obttipole($id_tipo_le)
    {
        include "../../cnx/connection.php";

        $sql_tipo_le = "SELECT * FROM tipo_le WHERE id_tipo_le='$id_tipo_le'";
        $res_tipo_le = mysqli_query($connection, $sql_tipo_le);
        $ver_tipo_le = mysqli_fetch_array($res_tipo_le);
        $datos_tipo_le = array(
            'id_tipo_le' => $ver_tipo_le[0],
            'codigo_tipo_le' => $ver_tipo_le[1],
            'nombre_tipo_le' => $ver_tipo_le[2]
        );
        return $datos_tipo_le;
    }

    public function obtlb($id_lb)
    {
        include "../../cnx/connection.php";

        $sql_linea_base = "SELECT * FROM linea_base_le WHERE id_lb='$id_lb'";
        $res_linea_base = mysqli_query($connection, $sql_linea_base);
        $ver_linea_base = mysqli_fetch_array($res_linea_base);
        $datos_linea_base = array(
            'id_lb' => $ver_linea_base[0],
            'codigo_estable_lb' => $ver_linea_base[1],
            'cantidad_lb' => $ver_linea_base[2],
            'anio_lb' => $ver_linea_base[3]
        );
        return $datos_linea_base;
    }

    public function obtporc_lb($id_porc_lb)
    {
        include "../../cnx/connection.php";

        $sql_porcentaje_lb = "SELECT * FROM porcentaje_lb WHERE id_porc_lb='$id_porc_lb'";
        $res_porcentaje_lb = mysqli_query($connection, $sql_porcentaje_lb);
        $ver_porcentaje_lb = mysqli_fetch_array($res_porcentaje_lb);
        $datos_porcentaje_lb = array(
            'id_porc' => $ver_porcentaje_lb[0],
            'tipo_estable_porc' => $ver_porcentaje_lb[1],
            'primer_porc' => $ver_porcentaje_lb[2],
            'segundo_porc' => $ver_porcentaje_lb[3],
            'tercer_porc' => $ver_porcentaje_lb[4],
            'cuarto_porc' => $ver_porcentaje_lb[5],
            'anio_porc' => $ver_porcentaje_lb[6]
        );
        return $datos_porcentaje_lb;
    }

    public function obtegresole($id_egreso)
    {
        include "../../cnx/connection.php";

        $sql_egreso_le = "SELECT * FROM egresos_le WHERE id_egreso='$id_egreso'";
        $res_egreso_le = mysqli_query($connection, $sql_egreso_le);
        $ver_egreso_le = mysqli_fetch_array($res_egreso_le);
        $datos_egreso_le = array(
            'id_eg' => $ver_egreso_le[0],
            'estable_eg' => $ver_egreso_le[1],
            'cantidad_eg' => $ver_egreso_le[2],
            'mes_eg' => $ver_egreso_le[3],
            'anio_eg' => $ver_egreso_le[4],
            'tipo_le_eg' => $ver_egreso_le[5]
        );
        return $datos_egreso_le;

    }

    public function obttipoges($id_tipoges)
    {
        include "../../cnx/connection.php";

        $sql_tipoges = "SELECT * FROM tipo_ges WHERE id_tipo_ges='$id_tipoges'";
        $res_tipoges = mysqli_query($connection, $sql_tipoges);
        $ver_tipoges = mysqli_fetch_array($res_tipoges);
        $datos_tipoges = array(
            'id_tipoges' => $ver_tipoges[0],
            'codigo_tipoges' => $ver_tipoges[1],
            'nombre_tipoges' => $ver_tipoges[2]
        );
        return $datos_tipoges;

    }

    public function obtcasosges($id_casos_ges)
    {
        include "../../cnx/connection.php";

        $sql_casos_ges = "SELECT * FROM egresos_ges WHERE id_eg_ges='$id_casos_ges'";
        $res_casos_ges = mysqli_query($connection, $sql_casos_ges);
        $ver_casos_ges = mysqli_fetch_array($res_casos_ges);
        $datos_casos_ges = array(
            'id_casos_ges' => $ver_casos_ges[0],
            'estable_casos_ges' => $ver_casos_ges[1],
            'tipo_casos_ges' => $ver_casos_ges[2],
            'mes_casos_ges' => $ver_casos_ges[3],
            'anio_casos_ges' => $ver_casos_ges[4],
            'cantidad_casos_ges' => $ver_casos_ges[5]
        );
        return $datos_casos_ges;

    }

}
