<?php
/*
ini_set('post_max_size','100M');  // Tamaño máximo de datos enviados por método POST.
ini_set('upload_max_filesize','100M');   // Tamaño máximo para subir archivos al servidor.
ini_set('max_execution_time','1000');  // Tiempo máximo de ejecución de éste script en segundos.
ini_set('max_input_time','1000'); //Tiempo máximo en segundos que el script puede usar para analizar los datos input, sean post,get o archivos.
ini_set("memory_limit" , "50M") ; //Tamaño máximo que el script puede usar de la memoria, mientras se ejecuta.
set_time_limit(0); // Tiempo máximo en segundos, que puede el script estar ejecutándose. El cero, da tiempo ilimitado.
*/
include "../../cnx/connection.php";

$seccion = $_POST['seccion'];

switch ($seccion) {
    case "provincia":
        $codigo_provincia = $_POST['codigo_provincia'];
        $nombre_provincia = $_POST['nombre_provincia'];

        $sql_provincia = "INSERT INTO provincia (codigo_provincia,nombre_provincia)
                            VALUES ('$codigo_provincia','$nombre_provincia')";
        echo mysqli_query($connection, $sql_provincia);
        break;

    case "comuna":
        $codigo_comuna = $_POST['codigo_comuna'];
        $nombre_comuna = $_POST['nombre_comuna'];
        $cod_provincia_comuna = $_POST['codigo_provincia_comuna'];

        $sql_comuna = "INSERT INTO comuna(codigo_comuna,nombre_comuna,codigo_provincia)
                            VALUES('$codigo_comuna','$nombre_comuna','$cod_provincia_comuna')";
        echo mysqli_query($connection, $sql_comuna);
        break;

    case "tipo_estable":
        $codigo_tipo_estable = $_POST['codigo_tipo_estable'];
        $nombre_tipo_estable = $_POST['nombre_tipo_estable'];

        $sql_tipo_estable = "INSERT INTO tipo_estable (codigo_tipo,nombre_tipo)
                            VALUES('$codigo_tipo_estable','$nombre_tipo_estable')";
        echo mysqli_query($connection, $sql_tipo_estable);
        break;

    case "establecimiento":
        $codigo_estable = $_POST['codigo_estable'];
        $nombre_estable = $_POST['nombre_estable'];
        $codigo_comuna_estable = $_POST['cod_comuna_estable'];
        $codigo_provincia_estable = $_POST['cod_provincia_estable'];
        $tipo_estable = $_POST['tipo_estable'];

        $sql_estable = "INSERT INTO establecimiento (codigo_estable,nombre_estable,codigo_comuna,codigo_provincia,tipo_estable)
                            VALUES('$codigo_estable','$nombre_estable','$codigo_comuna_estable','$codigo_provincia_estable','$tipo_estable')";
        echo mysqli_query($connection, $sql_estable);
        break;

    case "tipo-le":
        $codigo_tipo_le = $_POST['codigo_tipo_le'];
        $nombre_tipo_le = $_POST['nombre_tipo_le'];

        $sql_tipo_le = "INSERT INTO tipo_le (codigo_tipo_le,nombre_tipo_le) VALUES('$codigo_tipo_le','$nombre_tipo_le')";
        echo mysqli_query($connection, $sql_tipo_le);
        break;

    case "linea-base":
        $codigo_estable_lb = $_POST['estable_linea_base'];
        $cantidad_lb = $_POST['cantidad_linea_base'];
        $anio_lb = $_POST['anio_linea_base'];
        $tipo_le_lb = $_POST['tipo_le_linea_base'];
        $id_lb = "lb_" . $codigo_estable_lb . "_" . $anio_lb;

        $sql_linea_base = "INSERT INTO linea_base_le (id_lb,codigo_estable_lb,cantidad_lb,anio_lb,tipo_le_lb) VALUES('$id_lb',$codigo_estable_lb,$cantidad_lb,$anio_lb,$tipo_le_lb)";
        echo mysqli_query($connection, $sql_linea_base);
        break;

    case "porcentaje-lb":
        $tipo_estable_porc_lb = $_POST['tipo_estable_porcentaje_lb'];
        $primer_corte = $_POST['primer_porcentaje_lb'];
        $segundo_corte = $_POST['segundo_porcentaje_lb'];
        $tercer_corte = $_POST['tercer_porcentaje_lb'];
        $cuarto_corte = $_POST['cuarto_porcentaje_lb'];
        $anio_porc_lb = $_POST['anio_porcentaje_lb'];

        $id_porc_lb = "prc" . "_" . $tipo_estable_porc_lb . "_" . $anio_porc_lb;

        $sql_porcentaje_lb = "INSERT INTO porcentaje_lb (id_porc_lb,tipo_estable_porc_lb,pri_corte_porc_lb,seg_corte_porc_lb,ter_corte_porc_lb,cto_corte_porc_lb,anio_corte_porc_lb) 
                            VALUES('$id_porc_lb',$tipo_estable_porc_lb,$primer_corte,$segundo_corte,$tercer_corte,$cuarto_corte,$anio_porc_lb)";
        echo mysqli_query($connection, $sql_porcentaje_lb);
        break;

    case "egreso-le":
        $estable_eg = $_POST['estable_egreso_le'];
        $cantidad_eg = $_POST['cantidad_egreso_le'];
        $mes_eg = $_POST['mes_egreso_le'];
        $anio_eg = $_POST['anio_egreso_le'];
        $tipo_le_eg = $_POST['tipo_le_egreso_le'];

        $id_egreso = "Eg_" . $estable_eg . "_" . $mes_eg . "_" . $anio_eg . "_" . $tipo_le_eg;

        $sql_egreso_le = "INSERT INTO egresos_le (id_egreso,estable_eg,cantidad_eg,mes_eg,anio_eg,tipo_le_eg) 
                            VALUES ('$id_egreso',$estable_eg,$cantidad_eg,$mes_eg,$anio_eg,$tipo_le_eg)";
        echo mysqli_query($connection, $sql_egreso_le);

        break;

    case "tipoges":
        $codigo_tipoges = $_POST['codigo_tipoges'];
        $nombre_tipoges = $_POST['nombre_tipoges'];

        $sql_tipo_ges = "INSERT INTO tipo_ges (codigo_tipo_ges,nombre_tipo_ges)
                            VALUES ($codigo_tipoges,'$nombre_tipoges')";
        echo mysqli_query($connection, $sql_tipo_ges);

        break;

    case "casos-ges":
        $estable_casos_ges = $_POST['estable_casos_ges'];
        $tipo_casos_ges = $_POST['tipo_casos_ges'];
        $mes_casos_ges = $_POST['mes_casos_ges'];
        $anio_casos_ges = $_POST['anio_casos_ges'];
        $cantidad_casos_ges = $_POST['cantidad_casos_ges'];

        $id_casos_ges = "Eg_" . $estable_casos_ges . "_" . $tipo_casos_ges . "_" . $mes_casos_ges . "_" . $anio_casos_ges;

        $sql_casos_ges = "INSERT INTO egresos_ges (id_eg_ges,estable_eg_ges,codigo_tipo_ges_eg_ges,mes_eg_ges,anio_eg_ges,cantidad_eg_ges)
                            VALUES ('$id_casos_ges',$estable_casos_ges,$tipo_casos_ges,$mes_casos_ges,$anio_casos_ges,$cantidad_casos_ges)";
        echo mysqli_query($connection, $sql_casos_ges);

        break;

    case "red-siges":
        $establecimiento = $_POST['estable_red_siges'];
        $nombre = $_POST['nombre_red_siges'];
        $apellido = $_POST['apellido_red_siges'];
        $mail = $_POST['mail_red_siges'];
        $ruta = $_POST['rutaminsal_red_siges'];
        $telefono = $_POST['telefono_red_siges'];
        $comuna = $_POST['comuna_red_siges'];

        $sql_red_siges = "INSERT INTO red_siges (estable_red_siges,nombre_red_siges,apellido_red_siges,mail_red_siges,rutaminsal_red_siges,telefono_red_siges,comuna_red_siges) 
                            VALUES($establecimiento,'$nombre','$apellido','$mail','$ruta','$telefono',$comuna)";
        echo mysqli_query($connection, $sql_red_siges);
        break;

    case "doc-ges":
        $nombre = $_FILES['arch_doc_ges']['name'];
        $ruta = $_FILES['arch_doc_ges']['tmp_name'];
        $fecha_actual = date('Y-m-d');

        if (file_exists('../doc_ges/' . $nombre)) {
            echo 2;
        } else {
            if (move_uploaded_file($ruta, '../doc_ges/' . $nombre)) {
                $sql_doc_ges = "INSERT INTO doc_ges (nombre_doc_ges,fecha_doc_ges) VALUES('$nombre','$fecha_actual')";
                echo mysqli_query($connection, $sql_doc_ges);
            } else {
                echo 0;
            }
        }
        break;

    case "slider":
        sleep(2);
        $img_slider = $_FILES['arch_slider']['name'];
        $ruta_slider = $_FILES['arch_slider']['tmp_name'];
        $titulo = $_POST['titulo_slider'];
        $descripcion = $_POST['descripcion_slider'];

        if (file_exists('../img_slider/' . $img_slider)) {
            echo 2;
        } else {
            if (move_uploaded_file($ruta_slider, '../img_slider/' . $img_slider)) {
                $sql_slider = "INSERT INTO slider_inicio (nombre_slider,titulo_slider,descripcion_slider) VALUES('$img_slider','$titulo','$descripcion')";
                echo mysqli_query($connection, $sql_slider);
            } else {
                echo 0;
            }
        }
        break;
    case "usuario":
        $nombre_usu = $_POST['nombre_usuario'];
        $apellido_usu = $_POST['apellido_usuario'];
        $correo_usu = $_POST['email_usuario'];
        $usuario_usu = $_POST['usu_usuario'];
        $pass_usu = $_POST['pass_usuario'];
        $privilegio_usu = $_POST['privilegio_usuario'];
        $estable_usu = $_POST['estable_usuario'];
        $fecha_usu = date("Y-m-d");
        if (isset($_POST['estado_usuario']) && $_POST['estado_usuario'] == 'on') {
            $estado_usu = 1;
        } else {
            $estado_usu = 0;
        }

        $pass_usu_encriptada = password_hash($_POST['pass_usuario'], PASSWORD_DEFAULT);

        $sql_usuario_usu = $connection->query("SELECT id_sime
                                               FROM usuarios_sime
                                               ORDER BY convert(substring(id_sime, 4), UNSIGNED INTEGER) DESC, 
                                               substring(id_sime, 1, 3) LIMIT 1");
        $res_num_usu = mysqli_fetch_array($sql_usuario_usu);
        $ultimo_usu = $res_num_usu[0];
        $varnum = substr($ultimo_usu, 3);
        $varnum = $varnum + 1;
        $id_usu = "USU" . $varnum;

        $sql_usuario = "INSERT INTO usuarios_sime(id_sime,nombre_sime,apellido_sime,correo_sime,usuario_sime,contrasena_sime,privilegio_sime,estable_sime,fecha_creacion_sime,estado_sime,avatar_sime)
                            VALUES('$id_usu','$nombre_usu','$apellido_usu','$correo_usu','$usuario_usu','$pass_usu_encriptada',$privilegio_usu,$estable_usu,'$fecha_usu',$estado_usu,'')";
        echo mysqli_query($connection, $sql_usuario);
        break;

    case "directorio_noges":
        $nombre_carpeta = htmlspecialchars($_POST['nombre_directorio_noges']);
        $ruta_carpeta = htmlspecialchars($_POST['referencia_ruta_noges']);

        $dir_nuevo = "../directorio_noges" . $ruta_carpeta . "/" . $nombre_carpeta;

        if (!is_dir($dir_nuevo)) {
            $crear = mkdir($dir_nuevo, 0777, true);
            if ($crear) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
        break;
    case "archivo-directorio_noges":
        $nombre_archivo = $_FILES['archivo_directorio_noges']['name'];
        $ruta_tmp_archivo = $_FILES['archivo_directorio_noges']['tmp_name'];
        //$ruta_carpeta = htmlspecialchars($_POST['referencia_ruta_archivo']);
        $ruta_carpeta = $_POST['ref_ruta_arch'];
        $raiz = "../directorio_noges";
        $ruta_completa = $raiz . $ruta_carpeta;
        
        if ($nombre_archivo != "") {
            if (file_exists($ruta_completa . '/' . $nombre_archivo)) {
                echo 2;
            } else {
                if (move_uploaded_file($ruta_tmp_archivo, $ruta_completa . '/' . $nombre_archivo)) {
                    echo 1;
                } else {
                    echo 0;
                }
            }
        } else {
            echo 3;
        }
        break;
}
