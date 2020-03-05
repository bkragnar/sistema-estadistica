<?php
include "../../cnx/connection.php";

require_once "../librerias/excel/vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\IOFactory;

$seccion = $_POST["seccion"];

switch ($seccion) {

    case "comuna":

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

            $sql_carga_comuna = "INSERT INTO comuna (codigo_comuna,nombre_comuna,codigo_provincia)
                                        VALUES('$codigo_comuna','$nombre_comuna','$codigo_provincia')";
            /*--si result_carga_comuna es vacio ++1 de lo contrario ++0--*/
            if ($result_carga_comuna = mysqli_query($connection, $sql_carga_comuna)) {
                $carga = $carga + 1;
            }
        }
        /*--si todo salio bien $carga deberia tener valor 0 y devolvemos un true, de lo contrario false-*/
        if ($carga == $num_filas_comuna - 1) {
            echo "valido";
        } else {
            echo "rechazado";
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
}
