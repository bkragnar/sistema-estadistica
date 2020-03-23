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

            $id_lb = "lb" . "_" . $codigo_estable_lb . "_" . $anio_lb;

            $sql_linea_base = $connection->query("SELECT * FROM linea_base_le WHERE id_lb='$id_lb'");
            if (mysqli_num_rows($sql_linea_base) > 0) {
                $sql_linea_base_up = "UPDATE linea_base_le SET codigo_estable_lb=$codigo_estable_lb, cantidad_lb=$cantidad_lb, anio_lb=$anio_lb WHERE id_lb='$id_lb'";
                if (mysqli_query($connection, $sql_linea_base_up)) {
                    $carga = $carga + 1;
                }
            } else {
                $sql_linea_base_ins = "INSERT INTO linea_base_le (id_lb,codigo_estable_lb,cantidad_lb,anio_lb) VALUES('$id_lb',$codigo_estable_lb,$cantidad_lb,$anio_lb)";
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

            $id_eg = "Eg_" . $estable_eg . "_" . $mes_eg . "_" . $anio_eg;

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
}
