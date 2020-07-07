<?php

include "../../cnx/connection.php";

require_once "../librerias/excel/vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\IOFactory;


$seccion = $_POST["seccion"];

switch ($seccion) {

    case "comuna":
        sleep(2);
        $archivo = $_FILES["arch-comuna"]["name"];
        $archivo_ruta = $_FILES["arch-comuna"]["tmp_name"];
        //$archivo_guardado = "archivos_copiados/COPIA_" . $archivo;

        //if (copy($archivo_ruta, $archivo_guardado)) {
        //} else {
        //    //echo "Archivo no copiado";
        //}

        $objPHPExcel = IOFactory::load($archivo_ruta);
        $objPHPExcel->setActiveSheetIndex(0); //lee la hoja 1
        $num_filas_comuna = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow(); // obtiene la cantidad de filas de la hoja activa

        $carga = 0;
        for ($i = 2; $i <= $num_filas_comuna; $i++) { // $i=2 para que comience a leer desde la segunda posicion y saltar los encabezados
            $codigo_comuna = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
            $nombre_comuna = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
            $codigo_provincia = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();

            $sql_comuna = $connection->query("SELECT * FROM comuna WHERE codigo_comuna=$codigo_comuna");
            if (mysqli_num_rows($sql_comuna) > 0) {
                $sql_comuna_up = "UPDATE comuna SET codigo_comuna='$codigo_comuna',nombre_comuna='$nombre_comuna',codigo_provincia='$codigo_provincia' WHERE codigo_comuna='$codigo_comuna'";
                if ($result_comuna_up = mysqli_query($connection, $sql_comuna_up)) {
                    $carga = $carga + 1;
                }
            } else {
                $sql_carga_comuna = "INSERT INTO comuna (codigo_comuna,nombre_comuna,codigo_provincia)
                VALUES('$codigo_comuna','$nombre_comuna','$codigo_provincia')";
                if ($result_carga_comuna = mysqli_query($connection, $sql_carga_comuna)) {
                    $carga = $carga + 1;
                }
            }
        }
        /*--si todo salio bien $carga deberia tener valor 0 y devolvemos un true, de lo contrario false-*/
        if ($carga == $num_filas_comuna - 1) {
            echo 1; // valido
        } elseif ($carga > 0) {
            echo 2; // incompleto
        } elseif ($carga == 0) {
            echo 3; // rechazado
        }

        break;

    case "establecimiento":
        sleep(2);
        $archivo = $_FILES["arch-estable"]["name"];
        $archivo_ruta = $_FILES["arch-estable"]["tmp_name"];
        //$archivo_guardado = "archivos_copiados/COPIA_" . $archivo;
        //if (copy($archivo_ruta, $archivo_guardado)) {
        //} else {
        //    echo "Archivo no copiado";
        //}

        $objPHPExcel = IOFactory::load($archivo_ruta);
        $objPHPExcel->setActiveSheetIndex(0); //lee la hoja 1
        $num_filas_estable = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow(); // obtiene la cantidad de filas de la hoja activa

        $carga = 0;
        for ($i = 2; $i <= $num_filas_estable; $i++) { // $i=2 para que comience a leer desde la segunda posicion y saltar los encabezados
            $codigo_estable = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
            $nombre_estable = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
            $codigo_comuna = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
            $codigo_provincia = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();
            $tipo_estable = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();

            $sql_carga_estable = "INSERT INTO establecimiento (codigo_estable,nombre_estable,codigo_comuna,codigo_provincia,tipo_estable)
                                        VALUES('$codigo_estable','$nombre_estable','$codigo_comuna','$codigo_provincia','$tipo_estable')";
            if ($result_carga_estable = mysqli_query($connection, $sql_carga_estable)) {
                $carga = $carga + 1;
            }
        }
        if ($carga == $num_filas_estable - 1) {
            echo "valido";
        } else {
            echo "rechazado";
        }

        break;

    case "linea-base":
        sleep(2);
        $archivo = $_FILES["arch-linea-base"]["name"];
        $archivo_ruta = $_FILES["arch-linea-base"]["tmp_name"];

        $objPHPExcel = IOFactory::load($archivo_ruta);
        $objPHPExcel->setActiveSheetIndex(0); //lee la hoja 1
        $num_filas_linea_base = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow(); // obtiene la cantidad de filas de la hoja activa

        $carga = 0;
        for ($i = 2; $i <= $num_filas_linea_base; $i++) { // $i=2 para que comience a leer desde la segunda posicion y saltar los encabezados
            $codigo_estable_lb = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
            $cantidad_lb = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
            $anio_lb = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
            $tipole_lb = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();

            $id_lb = "lb_" . $codigo_estable_lb . "_" . $anio_lb . "_" . $tipole_lb;

            $sql_linea_base = $connection->query("SELECT * FROM linea_base_le WHERE id_lb='$id_lb'");
            if (mysqli_num_rows($sql_linea_base) > 0) {
                $sql_linea_base_up = "UPDATE linea_base_le SET codigo_estable_lb=$codigo_estable_lb, cantidad_lb=$cantidad_lb, anio_lb=$anio_lb, tipo_le_lb=$tipole_lb WHERE id_lb='$id_lb'";
                if (mysqli_query($connection, $sql_linea_base_up)) {
                    $carga = $carga + 1;
                }
            } else {
                $sql_linea_base_ins = "INSERT INTO linea_base_le (id_lb,codigo_estable_lb,cantidad_lb,anio_lb,tipo_le_lb) VALUES('$id_lb',$codigo_estable_lb,$cantidad_lb,$anio_lb,$tipole_lb)";
                if (mysqli_query($connection, $sql_linea_base_ins)) {
                    $carga = $carga + 1;
                }
            }
        }
        /*--si todo salio bien $carga deberia tener valor 0 y devolvemos un true, de lo contrario false-*/
        if ($carga == $num_filas_linea_base - 1) {
            echo 1; // valido
        } elseif ($carga > 0) {
            echo 2; // incompleto
        } elseif ($carga == 0) {
            echo 3; // rechazado
        }

        break;

    case "egreso-le":
        sleep(2);
        $archivo = $_FILES["arch_egreso_le"]["name"];
        $archivo_ruta = $_FILES["arch_egreso_le"]["tmp_name"];

        $objPHPExcel = IOFactory::load($archivo_ruta);
        $objPHPExcel->setActiveSheetIndex(0); //lee la hoja 1
        $num_filas_egreso_le = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow(); // obtiene la cantidad de filas de la hoja activa

        $carga = 0;
        for ($i = 2; $i <= $num_filas_egreso_le; $i++) { // $i=2 para que comience a leer desde la segunda posicion y saltar los encabezados
            $estable_eg = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
            $cantidad_eg = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
            $mes_eg = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
            $anio_eg = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();
            $tipo_le_eg = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();

            $id_eg = "Eg_" . $estable_eg . "_" . $mes_eg . "_" . $anio_eg . "_" . $tipo_le_eg;

            if (empty($cantidad_eg)) { //si el valor es vacio le asigno un 0
                $cantidad_eg = 0;
            }

            $sql_egreso_le = $connection->query("SELECT * FROM egresos_le WHERE id_egreso='$id_eg'");
            if (mysqli_num_rows($sql_egreso_le) > 0) {
                $sql_linea_base_up = "UPDATE egresos_le SET estable_eg=$estable_eg,cantidad_eg=$cantidad_eg,mes_eg=$mes_eg,anio_eg=$anio_eg,tipo_le_eg=$tipo_le_eg WHERE id_egreso='$id_eg'";
                if (mysqli_query($connection, $sql_linea_base_up)) {
                    $carga = $carga + 1;
                }
            } else {
                $sql_linea_base_ins = "INSERT INTO egresos_le (id_egreso,estable_eg,cantidad_eg,mes_eg,anio_eg,tipo_le_eg) VALUES ('$id_eg',$estable_eg,$cantidad_eg,$mes_eg,$anio_eg,$tipo_le_eg)";
                if (mysqli_query($connection, $sql_linea_base_ins)) {
                    $carga = $carga + 1;
                }
            }
        }
        /*--si todo salio bien $carga deberia tener valor 0 y devolvemos un true, de lo contrario false-*/
        if ($carga == $num_filas_egreso_le - 1) {
            echo 1; // valido
        } elseif ($carga > 0) {
            echo 2; // incompleto
        } elseif ($carga == 0) {
            echo 3; // rechazado
        }

        break;

    case "casos-ges":
        sleep(2);
        $archivo = $_FILES["arch_casos_ges"]["name"];
        $archivo_ruta = $_FILES["arch_casos_ges"]["tmp_name"];

        $objPHPExcel = IOFactory::load($archivo_ruta);
        $objPHPExcel->setActiveSheetIndex(0); //lee la hoja 1
        $num_filas_casos_ges = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow(); // obtiene la cantidad de filas de la hoja activa

        $carga = 0;
        for ($i = 2; $i <= $num_filas_casos_ges; $i++) { // $i=2 para que comience a leer desde la segunda posicion y saltar los encabezados
            $estable_casos_ges = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
            $tipo_casos_ges = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
            $mes_casos_ges = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
            $anio_anio_casos = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();
            $cantidad_casos_ges = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();

            $id_casos_ges = "Eg_" . $estable_casos_ges . "_" . $tipo_casos_ges . "_" . $mes_casos_ges . "_" . $anio_casos_ges;

            if (empty($cantidad_casos_ges)) { //si el valor es vacio le asigno un 0
                $cantidad_eg = 0;
            }

            $sql_casos_ges = $connection->query("SELECT * FROM egresos_ges WHERE id_eg_ges='$id_casos_ges'");
            if (mysqli_num_rows($sql_casos_ges) > 0) {
                $sql_casos_ges_up = "UPDATE egresos_ges SET estable_eg_ges=$estable_casos_ges,codigo_tipo_ges_eg_ges=$tipo_casos_ges,mes_eg_ges=$mes_casos_ges,anio_eg_ges=$anio_casos_ges,cantidad_eg_ges=$cantidad_casos_ges 
                                    WHERE id_eg_ges='$id_casos_ges'";
                if (mysqli_query($connection, $sql_casos_ges_up)) {
                    $carga = $carga + 1;
                }
            } else {
                $sql_casos_ges_ins = "INSERT INTO egresos_ges (id_eg_ges,estable_eg_ges,codigo_tipo_ges_eg_ges,mes_eg_ges,anio_eg_ges,cantidad_eg_ges)
                                    VALUES ('$id_casos_ges',$estable_casos_ges,$tipo_casos_ges,$mes_casos_ges,$anio_casos_ges,$cantidad_casos_ges)";
                if (mysqli_query($connection, $sql_casos_ges_ins)) {
                    $carga = $carga + 1;
                }
            }
        }
        /*--si todo salio bien $carga deberia tener valor 0 y devolvemos un true, de lo contrario false-*/
        if ($carga == $num_filas_casos_ges - 1) {
            echo 1; // valido
        } elseif ($carga > 0) {
            echo 2; // incompleto
        } elseif ($carga == 0) {
            echo 3; // rechazado
        }

        break;

    case "red-siges":
        sleep(2);
        $archivo = $_FILES["arch_red_siges"]["name"];
        $archivo_ruta = $_FILES["arch_red_siges"]["tmp_name"];

        $objPHPExcel = IOFactory::load($archivo_ruta);
        $objPHPExcel->setActiveSheetIndex(0); //lee la hoja 1
        $num_filas_red_siges = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow(); // obtiene la cantidad de filas de la hoja activa

        $carga = 0;
        for ($i = 2; $i <= $num_filas_red_siges; $i++) { // $i=2 para que comience a leer desde la segunda posicion y saltar los encabezados
            $establecimiento = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
            $nombre = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
            $apellido = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
            $mail = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();
            $ruta = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();
            $telefono = $objPHPExcel->getActiveSheet()->getCell('F' . $i)->getCalculatedValue();
            $comuna = $objPHPExcel->getActiveSheet()->getCell('G' . $i)->getCalculatedValue();

            $sql_red_siges = $connection->query("SELECT * FROM egresos_ges WHERE mail_red_siges='$mail'");
            if (mysqli_num_rows($sql_red_siges) > 0) {
                $most_id = mysqli_fetch_array($sql_red_siges);
                $id_red_siges = $most_id[0];
                $sql_red_siges_up = "UPDATE red_siges SET estable_red_siges=$establecimiento,nombre_red_siges='$nombre',apellido_red_siges='$apellido',mail_red_siges='$mail',rutaminsal_red_siges='$ruta',telefono_red_siges='$telefono',comuna_red_siges=$comuna
                WHERE id_red_siges=$id_red_siges";
                if (mysqli_query($connection, $sql_red_siges_up)) {
                    $carga = $carga + 1;
                }
            } else {
                $sql_red_siges_ins = "INSERT INTO red_siges (estable_red_siges,nombre_red_siges,apellido_red_siges,mail_red_siges,rutaminsal_red_siges,telefono_red_siges,comuna_red_siges) 
                                        VALUES($establecimiento,'$nombre','$apellido','$mail','$ruta','$telefono',$comuna)";
                if (mysqli_query($connection, $sql_red_siges_ins)) {
                    $carga = $carga + 1;
                }
            }
        }
        /*--si todo salio bien $carga deberia tener valor 0 y devolvemos un true, de lo contrario false-*/
        if ($carga == $num_filas_red_siges - 1) {
            echo 1; // valido
        } elseif ($carga > 0) {
            echo 2; // incompleto
        } elseif ($carga == 0) {
            echo 3; // rechazado
        }

        break;
}
