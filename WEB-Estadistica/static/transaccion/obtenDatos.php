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
}
