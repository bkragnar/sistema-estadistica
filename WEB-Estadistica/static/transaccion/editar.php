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

        $sql_egreso_le = "UPDATE egresos_le SET estable_eg=$estable_eg_up,cantidad_eg=$cantidad_eg_up,mes_eg=$mes_eg_up,anio_eg=$anio_eg_up,tipo_le_eg=$tipo_le_eg_up 
                        WHERE id_egreso='$id_egreso_up'";
        echo mysqli_query($connection, $sql_egreso_le);
        break;

    case "tipoges":
        $id_tipoges_up = $_POST['id_tipoges'];
        $codigo_tipoges_up = $_POST['codigo_tipoges_up'];
        $nombre_tipo_ges = $_POST['nombre_tipoges_up'];

        $sql_tipo_ges = "UPDATE tipo_ges SET codigo_tipo_ges=$codigo_tipoges_up,nombre_tipo_ges='$nombre_tipo_ges'
                            WHERE id_tipo_ges='$id_tipoges_up'";
        echo mysqli_query($connection, $sql_tipo_ges);
        break;

    case "casos-ges":
        $id_casos_ges = $_POST['id_casos_ges'];
        $estable_casos_ges = $_POST['estable_casos_ges_up'];
        $tipo_casos_ges = $_POST['tipo_casos_ges_up'];
        $mes_casos_ges = $_POST['mes_casos_ges_up'];
        $anio_casos_ges = $_POST['anio_casos_ges_up'];
        $cantidad_casos_ges = $_POST['cantidad_casos_ges_up'];

        $sql_casos_ges = "UPDATE egresos_ges SET estable_eg_ges=$estable_casos_ges,codigo_tipo_ges_eg_ges=$tipo_casos_ges,mes_eg_ges=$mes_casos_ges,anio_eg_ges=$anio_casos_ges,cantidad_eg_ges=$cantidad_casos_ges
                                WHERE id_eg_ges='$id_casos_ges'";
        echo mysqli_query($connection, $sql_casos_ges);
        break;

    case "red-siges":
        $id_red_siges = $_POST['id_red_siges'];
        $estable_red_siges = $_POST['estable_red_siges_up'];
        $nombre_red_siges = $_POST['nombre_red_siges_up'];
        $apellido_red_siges = $_POST['apellido_red_siges_up'];
        $mail_red_siges = $_POST['mail_red_siges_up'];
        $ruta_red_siges = $_POST['rutaminsal_red_siges_up'];
        $telefono_red_siges = $_POST['telefono_red_siges_up'];
        $comuna_red_siges = $_POST['comuna_red_siges_up'];

        $sql_red_siges = "UPDATE red_siges SET estable_red_siges=$estable_red_siges,nombre_red_siges='$nombre_red_siges',apellido_red_siges='$apellido_red_siges',mail_red_siges='$mail_red_siges',rutaminsal_red_siges='$ruta_red_siges',telefono_red_siges='$telefono_red_siges',comuna_red_siges=$comuna_red_siges
                        WHERE id_red_siges=$id_red_siges";
        echo mysqli_query($connection, $sql_red_siges);
        break;

    case "slider":
        $id_slider = $_POST['id_slider'];
        $titulo = $_POST['titulo_slider_up'];
        $descripcion = $_POST['descripcion_slider_up'];

        $sql_slider_up = "UPDATE slider_inicio SET titulo_slider='$titulo',descripcion_slider='$descripcion' 
                        WHERE id_slider=$id_slider";
        echo mysqli_query($connection, $sql_slider_up);
        break;

    case "usuario":
        $id_usu = $_POST['id_usuario'];
        $nombre_usu = $_POST['nombre_usuario_up'];
        $apellido_usu = $_POST['apellido_usuario_up'];
        $correo_usu = $_POST['email_usuario_up'];
        $usuario_usu = $_POST['usu_usuario_up'];
        $pass_usu = $_POST['pass_usuario_up'];
        $privilegio_usu = $_POST['privilegio_usuario_up'];
        $estable_usu = $_POST['estable_usuario_up'];
        if (isset($_POST['estado_usuario_up']) && $_POST['estado_usuario_up'] == 'on') {
            $estado_usu = 1;
        } else {
            $estado_usu = 0;
        }

        if (!empty($pass_usu)) {
            $sql_usuario_up = "UPDATE usuarios_sime SET nombre_sime='$nombre_usu',apellido_sime='$apellido_usu',correo_sime='$correo_usu',usuario_sime='$usuario_usu',contrasena_sime='$pass_usu',privilegio_sime=$privilegio_usu,estable_sime=$estable_usu ,estado_sime=$estado_usu
                            WHERE id_sime='$id_usu'";
            echo mysqli_query($connection, $sql_usuario_up);
        } else {
            $sql_usuario_up = "UPDATE usuarios_sime SET nombre_sime='$nombre_usu',apellido_sime='$apellido_usu',correo_sime='$correo_usu',usuario_sime='$usuario_usu',privilegio_sime=$privilegio_usu,estable_sime=$estable_usu,estado_sime=$estado_usu
                            WHERE id_sime='$id_usu'";
            echo mysqli_query($connection, $sql_usuario_up);
        }

        break;
}
