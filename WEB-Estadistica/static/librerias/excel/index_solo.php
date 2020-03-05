<?php 
require_once("vendor/autoload.php"); 
require_once("../../../config/connection_ssc_formulario_bp.php");

$formcod = $_GET['formcod'];
//guardar registro de la generacion del documento
//mysqli_query($connection_ssc_formulario_bp,"INSERT INTO formulario_control VALUES('','a','d','excel')");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

$spreadsheet = new Spreadsheet();

//Specify the properties for this document
$spreadsheet->getProperties()
    ->setTitle('Formulario Buenas Prácticas - Servicio Salud Coquimbo')
    ->setSubject('Formulario Buenas Prácticas')
    ->setDescription('Formulario de Postulación Programa de Apoyo a Buenas Prácticas de Promoción de Salud en Atención Primaria')
    ->setCreator('Servicio de Salud Coquimbo')
    ->setLastModifiedBy('Servicio de Salud Coquimbo');

    $spreadsheet->setActiveSheetIndex(0)
    ->setTitle("Formulario BP")
    ->setCellValue('A1', 'Cód. Formulario') 
    ->setCellValue('B1', 'Nombre')
    ->setCellValue('C1', 'Establecimiento')
    ->setCellValue('D1', 'Comuna')
    ->setCellValue('E1', 'Servicio de Salud')
    ->setCellValue('F1', 'Gestión Local de Determinantes Sociales de la Salud')
    ->setCellValue('G1', 'Intersectorialidad')
    ->setCellValue('H1', 'Estrategias de Acción Comunitaria con enfoque psicosocial')
    ->setCellValue('I1', 'Comunicación Social para la Salud')
    ->setCellValue('J1', 'Gestión, acceso a prestaciones de prevención, rehabilitación o cuidados paliativos')
    ->setCellValue('K1', 'Población Objetivo')
    ->setCellValue('L1', 'Población Beneficiaria')
    ->setCellValue('M1', 'Porcentaje de Cobertura')
    ->setCellValue('N1', 'Inicio tiempo de Desarrollo')
    ->setCellValue('O1', 'Años');

    /*
    $spreadsheet->getActiveSheet()->getStyle('A1')
    ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
    */

    //ajustar columnas
    foreach(range('A','O') as $columnID) {
        $spreadsheet->getActiveSheet()->getColumnDimension($columnID)
            ->setAutoSize(true);
    }

    $num = 1;
    $consulta=("SELECT * FROM formulario_step_1 WHERE form_codigo LIKE '%$formcod%' ");
    $query=mysqli_query($connection_ssc_formulario_bp,$consulta);
        while($row=mysqli_fetch_array($query))
            {
                $res_a_6 = ($row[7] != 1) ? "NO":"SI";
                $res_a_7 = ($row[8] != 1) ? "NO":"SI";
                $res_a_8 = ($row[9] != 1) ? "NO":"SI";
                $res_a_9 = ($row[10] != 1) ? "NO":"SI";
                $res_a_10 = ($row[11] != 1) ? "NO":"SI";
                
                $a = ++$num;    
                //cod form
                $cod = $row[1];

                $consulta_2=("SELECT * FROM formulario_step_2 WHERE form_codigo LIKE '%$cod%'");
                $query_2=mysqli_query($connection_ssc_formulario_bp,$consulta_2);
                    while($row_2=mysqli_fetch_array($query_2))
                        {
                            $spreadsheet->getActiveSheet()
                            ->setCellValue("A$a", "$row[1]");
            
                            $spreadsheet->getActiveSheet()
                            ->setCellValue("B$a", "$row[2]");
            
                            $spreadsheet->getActiveSheet()
                            ->setCellValue("C$a", "$row[3]");
            
                            $spreadsheet->getActiveSheet()
                            ->setCellValue("D$a", "$row[4]");
            
                            $spreadsheet->getActiveSheet()
                            ->setCellValue("E$a", "$row[5]");
            
                            $spreadsheet->getActiveSheet()
                            ->setCellValue("F$a", "$res_a_6");
            
                            $spreadsheet->getActiveSheet()
                            ->setCellValue("G$a", "$res_a_7");
            
                            $spreadsheet->getActiveSheet()
                            ->setCellValue("H$a", "$res_a_8");
            
                            $spreadsheet->getActiveSheet()
                            ->setCellValue("I$a", "$res_a_9");
            
                            $spreadsheet->getActiveSheet()
                            ->setCellValue("J$a", "$res_a_10");
            
                            $spreadsheet->getActiveSheet()
                            ->setCellValue("K$a", "$row[13]");
            
                            $spreadsheet->getActiveSheet()
                            ->setCellValue("L$a", "$row[14]");
            
                            $spreadsheet->getActiveSheet()
                            ->setCellValue("M$a", "$row[15]");
            
                            $spreadsheet->getActiveSheet()
                            ->setCellValue("N$a", "$row_2[4]");
            
                            $spreadsheet->getActiveSheet()
                            ->setCellValue("O$a", "$row_2[5]");
                        }               
                    }
                    mysqli_close($connection_ssc_formulario_bp);  

//guardar
//$writer = IOFactory::createWriter($spreadsheet, "Xlsx"); //Xls is also possible
//$writer->load("aa.xlsx");

//solo abrir
$nombreDelDocumento = "FORMULARIO_BUENAS_PRACTICAS_$formcod.xlsx";
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $nombreDelDocumento . '"');
header('Cache-Control: max-age=0');
 
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
exit;