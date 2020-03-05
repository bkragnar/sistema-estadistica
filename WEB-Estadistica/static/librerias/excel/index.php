<?php 
require_once ("vendor/autoload.php"); 
require_once ("../../../config/connection.php");
require_once ("../../../config/connection_ubicacion.php");
require_once ("../../../config/connection_usuarios.php");

//guardar registro de la generacion del documento
//mysqli_query($connection_ssc_formulario_bp,"INSERT INTO formulario_control VALUES('','a','d','excel')");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

$spreadsheet = new Spreadsheet();

    //Specify the properties for this document
    $spreadsheet->getProperties()
    ->setTitle('Proyectos - Servicio Salud Coquimbo')
    ->setSubject('Listado Proyectos')
    ->setDescription('Listado Proyectos')
    ->setCreator('Servicio de Salud Coquimbo')
    ->setLastModifiedBy('Servicio de Salud Coquimbo');

    $spreadsheet->setActiveSheetIndex(0)
    ->setTitle("Proyectos")
    ->setCellValue('A1', 'Código')
    ->setCellValue('B1', 'Tipo Proyecto')
    ->setCellValue('C1', 'Nombre Proyecto')
    ->setCellValue('D1', 'Provincia')
    ->setCellValue('E1', 'Comuna')
    ->setCellValue('F1', 'Clasificación')
    ->setCellValue('G1', 'Etapa')
    ->setCellValue('H1', 'Tipo')
    ->setCellValue('I1', 'Fecha Postulación')
    ->setCellValue('J1', 'Monto de Financiamiento')
    ->setCellValue('K1', 'Funcionario Responsable');
    /*
    $spreadsheet->getActiveSheet()->getStyle('A1')
    ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
    */
    //ajustar columnas
    foreach(range('A','K') as $columnID) {
        $spreadsheet->getActiveSheet()->getColumnDimension($columnID)
            ->setAutoSize(true);
    }
    
    $num = 1;
    
    switch($_POST['input_proyecto'])
    {
        //todos
        case "0":
    
            $input_nombre_proyecto = $_POST['input_nombre_proyecto'];
            $input_codigo = $_POST['input_codigo'];
            $input_proyecto = $_POST['input_proyecto'];
            $input_etapa_proyecto = $_POST['input_etapa_proyecto'];
            $input_tipo_proyecto = $_POST['input_tipo_proyecto'];
    
            if(!$input_nombre_proyecto)
            {
                $sqlconsulta = " ";
            }else{
                $sqlconsulta = " WHERE articulo_nombre_proyecto LIKE '%$input_nombre_proyecto%' ";
            }
    
            if(!$input_codigo)
            {
                $sqlconsulta .= " ";
            }elseif((!$input_codigo) && (!$input_nombre_proyecto))
            {
                $sqlconsulta .= " ";
            }elseif((!empty($input_nombre_proyecto)))
            {
                $sqlconsulta .= " AND articulo_codigo LIKE '%$input_codigo%' ";
            }else
            {
                $sqlconsulta .= " WHERE articulo_codigo  LIKE '%$input_codigo%' ";
            }
    
            if($input_tipo_proyecto == "0")
            {
                $sqlconsulta .= " ";
            }else
            {
                $sqlconsulta .= " AND articulo_tipo_proyecto = $input_tipo_proyecto";
            }
    
            if($input_etapa_proyecto == "0")
            {
                $sqlconsulta .= " ";
            }elseif(!$input_tipo_proyecto){
                $sqlconsulta .= " AND articulo_tipo_etapa = $input_etapa_proyecto";
            }else{
                $sqlconsulta .= " AND articulo_tipo_etapa = $input_etapa_proyecto";
            }
            //echo $sqlconsulta;
            
           
            $consulta=("SELECT * FROM articulo $sqlconsulta");
            $query=mysqli_query($connection,$consulta);
                while($row=mysqli_fetch_array($query))
                {                    
                    $a = ++$num;
                    $articulo_codigo = $row[1];
                    $articulo_codigo_informacion = $row[3];
                    $articulo_codigo_usuario = $row[13];
                        $consulta_info=("SELECT informacion_codigo,informacion_provincia,informacion_comuna FROM articulo_informacion WHERE informacion_codigo LIKE '%$articulo_codigo_informacion%'");
                        $query_info=mysqli_query($connection,$consulta_info);
                            while($row_info=mysqli_fetch_array($query_info))
                            { 
                                $articulo_provincia = $row_info[1];
                                $articulo_comuna = $row_info[2];
                                
                                //formulario monto financiamiento
                                $buscar_form_monto_financiamiento = "4.- MONTO DE FINANCIAMIENTO";
                                $consulta_formulario=("SELECT form_codigo,form_pregunta,form_respuesta FROM articulo_form WHERE form_codigo LIKE '%$articulo_codigo%' AND form_pregunta LIKE '%$buscar_form_monto_financiamiento%'");
                                $query_formulario=mysqli_query($connection,$consulta_formulario);
                                    while($row_formulario=mysqli_fetch_array($query_formulario))
                                    { 
                                        $articulo_formulario_monto_financiamiento = $row_formulario[2];
                                    }

                                //formulario funcionario_responsble
                                $buscar_form_funcionario_responsable = "7.- FUNCIONARIO RESPONSABLE";
                                $consulta_formulario_fr=("SELECT form_codigo,form_pregunta,form_respuesta FROM articulo_form WHERE form_codigo LIKE '%$articulo_codigo%' AND form_pregunta LIKE '%$buscar_form_funcionario_responsable%'");
                                $query_formulario_fr=mysqli_query($connection,$consulta_formulario_fr);
                                    while($row_formulario_fr=mysqli_fetch_array($query_formulario_fr))
                                    { 
                                        $articulo_formulario_funcionario_responsable = $row_formulario_fr[2];
                                    }

                                $consulta_ubicacion_p=("SELECT * FROM ubicacion_provincias WHERE provincias_codigo = $articulo_provincia");
                                $query_ubicacion_p=mysqli_query($connection_ub,$consulta_ubicacion_p);
                                    while($row_ubicacion_p=mysqli_fetch_array($query_ubicacion_p))
                                    { 
                                        $articulo_nombre_provincia = $row_ubicacion_p[2];
                                    }
                                    
                                $consulta_ubicacion_c=("SELECT * FROM ubicacion_comunas WHERE comunas_codigo = $articulo_comuna");
                                $query_ubicacion_c=mysqli_query($connection_ub,$consulta_ubicacion_c);
                                    while($row_ubicacion_c=mysqli_fetch_array($query_ubicacion_c))
                                    { 
                                        $articulo_nombre_comuna = $row_ubicacion_c[2];
                                    }
                                
                                $consulta_usuarios=("SELECT usuario_codigo,usuario_nombre,usuario_apellido_p,usuario_apellido_m FROM usuarios WHERE usuario_codigo LIKE '%$articulo_codigo_usuario%'");
                                $query_usuarios=mysqli_query($connection_usuarios,$consulta_usuarios);
                                    while($row_usuarios=mysqli_fetch_array($query_usuarios))
                                    { 
                                        $articulo_nombre_usuario = $row_usuarios[1]." ".$row_usuarios[2]." ".$row_usuarios[3];
                                    }

                                //codigo 
                                $spreadsheet->getActiveSheet()
                                ->setCellValue("A$a", "$row[1]");
                                //tipo proyecto
                                $spreadsheet->getActiveSheet()
                                ->setCellValue("B$a", "$row[2]");
                                //nombre proyecto
                                $spreadsheet->getActiveSheet()
                                ->setCellValue("C$a", "$row[14]");
                                //provincia
                                $spreadsheet->getActiveSheet()
                                ->setCellValue("D$a", "$articulo_nombre_provincia");
                                //comuna
                                $spreadsheet->getActiveSheet()
                                ->setCellValue("E$a", "$articulo_nombre_comuna");
                                //clasificacion
                                $spreadsheet->getActiveSheet()
                                ->setCellValue("F$a", "$row[6]");
                                //etapa
                                $spreadsheet->getActiveSheet()
                                ->setCellValue("G$a", "$row[9]");
                                //tipo
                                $spreadsheet->getActiveSheet()
                                ->setCellValue("H$a", "$row[10]");
                                //fecha postulacion
                                $spreadsheet->getActiveSheet()
                                ->setCellValue("I$a", "$row[8]");
                                //progreso
                                $spreadsheet->getActiveSheet()
                                ->setCellValue("J$a", "$articulo_formulario_monto_financiamiento");
                                //postulado por
                                $spreadsheet->getActiveSheet()
                                ->setCellValue("K$a", "$articulo_formulario_funcionario_responsable");
                                
                            }  
                }
        break;
        case "PSR":
        case "CESFAM":
        case "SAR":
        case "CECOSF":
            
            $input_nombre_proyecto = $_POST['input_nombre_proyecto'];
            $input_codigo = $_POST['input_codigo'];
            $input_proyecto = $_POST['input_proyecto'];
            $input_etapa_proyecto = $_POST['input_etapa_proyecto'];
            $input_tipo_proyecto = $_POST['input_tipo_proyecto'];
    
            if(!$input_nombre_proyecto)
            {
                $sqlconsulta = " ";
            }else{
                $sqlconsulta = " AND articulo_nombre_proyecto LIKE '%$input_nombre_proyecto%' ";
            }
    
            if(!$input_codigo)
            {
                $sqlconsulta .= " ";
            }elseif((!$input_codigo) && (!$input_nombre_proyecto))
            {
                $sqlconsulta .= " ";
            }elseif((!empty($input_codigo)))
            {
                $sqlconsulta .= " AND articulo_codigo LIKE '%$input_codigo%' ";
            }
    
            if($input_tipo_proyecto == "0")
            {
                $sqlconsulta .= " ";
            }else
            {
                $sqlconsulta .= " AND articulo_tipo_proyecto = $input_tipo_proyecto";
            }
    
            if($input_etapa_proyecto == "0")
            {
                $sqlconsulta .= " ";
            }elseif(!$input_tipo_proyecto){
                $sqlconsulta .= " AND articulo_tipo_etapa = $input_etapa_proyecto";
            }else{
                $sqlconsulta .= " AND articulo_tipo_etapa = $input_etapa_proyecto";
            }
            
            $consulta=("SELECT * FROM articulo WHERE articulo_siglas LIKE '%$input_proyecto%' $sqlconsulta");
            $query=mysqli_query($connection,$consulta);
                while($row=mysqli_fetch_array($query))
                {
                    $a = ++$num;
                    $articulo_codigo = $row[1];
                    $articulo_codigo_informacion = $row[3];
                    $articulo_codigo_usuario = $row[13];
                    $consulta_info=("SELECT informacion_codigo,informacion_provincia,informacion_comuna FROM articulo_informacion WHERE informacion_codigo LIKE '%$row[3]%'");
                        $query_info=mysqli_query($connection,$consulta_info);
                            while($row_info=mysqli_fetch_array($query_info))
                            { 
                                $articulo_provincia = $row_info[1];
                                $articulo_comuna = $row_info[2];

                                //formulario monto financiamiento
                                $buscar_form_monto_financiamiento = "4.- MONTO DE FINANCIAMIENTO";
                                $consulta_formulario=("SELECT form_codigo,form_pregunta,form_respuesta FROM articulo_form WHERE form_codigo LIKE '%$articulo_codigo%' AND form_pregunta LIKE '%$buscar_form_monto_financiamiento%'");
                                $query_formulario=mysqli_query($connection,$consulta_formulario);
                                    while($row_formulario=mysqli_fetch_array($query_formulario))
                                    { 
                                        $articulo_formulario_monto_financiamiento = $row_formulario[2];
                                    }

                                //formulario funcionario_responsble
                                $buscar_form_funcionario_responsable = "7.- FUNCIONARIO RESPONSABLE";
                                $consulta_formulario_fr=("SELECT form_codigo,form_pregunta,form_respuesta FROM articulo_form WHERE form_codigo LIKE '%$articulo_codigo%' AND form_pregunta LIKE '%$buscar_form_funcionario_responsable%'");
                                $query_formulario_fr=mysqli_query($connection,$consulta_formulario_fr);
                                    while($row_formulario_fr=mysqli_fetch_array($query_formulario_fr))
                                    { 
                                        $articulo_formulario_funcionario_responsable = $row_formulario_fr[2];
                                    }

                                $consulta_ubicacion_p=("SELECT * FROM ubicacion_provincias WHERE provincias_codigo = $articulo_provincia");
                                $query_ubicacion_p=mysqli_query($connection_ub,$consulta_ubicacion_p);
                                    while($row_ubicacion_p=mysqli_fetch_array($query_ubicacion_p))
                                    { 
                                        $articulo_nombre_provincia = $row_ubicacion_p[2];
                                    }
                                    
                                $consulta_ubicacion_c=("SELECT * FROM ubicacion_comunas WHERE comunas_codigo = $articulo_comuna");
                                $query_ubicacion_c=mysqli_query($connection_ub,$consulta_ubicacion_c);
                                    while($row_ubicacion_c=mysqli_fetch_array($query_ubicacion_c))
                                    { 
                                        $articulo_nombre_comuna = $row_ubicacion_c[2];
                                    }

                                $consulta_usuarios=("SELECT usuario_codigo,usuario_nombre,usuario_apellido_p,usuario_apellido_m FROM usuarios WHERE usuario_codigo LIKE '%$articulo_codigo_usuario%'");
                                $query_usuarios=mysqli_query($connection_usuarios,$consulta_usuarios);
                                    while($row_usuarios=mysqli_fetch_array($query_usuarios))
                                    { 
                                        $articulo_nombre_usuario = $row_usuarios[1]." ".$row_usuarios[2]." ".$row_usuarios[3];
                                    }
    
                                    //codigo 
                                    $spreadsheet->getActiveSheet()
                                    ->setCellValue("A$a", "$row[1]");
                                    //tipo proyecto
                                    $spreadsheet->getActiveSheet()
                                    ->setCellValue("B$a", "$row[2]");
                                    //nombre proyecto
                                    $spreadsheet->getActiveSheet()
                                    ->setCellValue("C$a", "$row[14]");
                                    //provincia
                                    $spreadsheet->getActiveSheet()
                                    ->setCellValue("D$a", "$articulo_nombre_provincia");
                                    //comuna
                                    $spreadsheet->getActiveSheet()
                                    ->setCellValue("E$a", "$articulo_nombre_comuna");
                                    //clasificacion
                                    $spreadsheet->getActiveSheet()
                                    ->setCellValue("F$a", "$row[6]");
                                    //etapa
                                    $spreadsheet->getActiveSheet()
                                    ->setCellValue("G$a", "$row[9]");
                                    //tipo
                                    $spreadsheet->getActiveSheet()
                                    ->setCellValue("H$a", "$row[10]");
                                    //fecha postulacion
                                    $spreadsheet->getActiveSheet()
                                    ->setCellValue("I$a", "$row[8]");
                                    //progreso
                                    $spreadsheet->getActiveSheet()
                                    ->setCellValue("J$a", "$articulo_formulario_monto_financiamiento");
                                    //postulado por
                                    $spreadsheet->getActiveSheet()
                                    ->setCellValue("K$a", "$articulo_formulario_funcionario_responsable");
                            }  
                }
        break;
        case "CAEM":
        case "CREM":
        case "CRV":
        case "CDI":
        case "IDI":
        case "GORE":
                
            $input_nombre_proyecto = $_POST['input_nombre_proyecto'];
            $input_codigo = $_POST['input_codigo'];
            $input_proyecto = $_POST['input_proyecto'];
                
            if(!$input_nombre_proyecto)
            {
                $sqlconsulta = " ";
            }else{
                $sqlconsulta = " AND articulo_nombre_proyecto LIKE '%$input_nombre_proyecto%' ";
            }
    
            if(!$input_codigo)
            {
                $sqlconsulta .= " ";
            }elseif((!$input_codigo) && (!$input_nombre_proyecto))
            {
                $sqlconsulta .= " ";
            }elseif((!empty($input_codigo)))
            {
                $sqlconsulta .= " AND articulo_codigo LIKE '%$input_codigo%' ";
            }
                
            $consulta=("SELECT * FROM articulo WHERE articulo_siglas LIKE '%$input_proyecto%' $sqlconsulta");
            $query=mysqli_query($connection,$consulta);
                while($row=mysqli_fetch_array($query))
                {
                    $a = ++$num;
                    $articulo_codigo = $row[1];
                    $articulo_codigo_informacion = $row[3];
                    $articulo_codigo_usuario = $row[13];
                    $consulta_info=("SELECT informacion_codigo,informacion_provincia,informacion_comuna FROM articulo_informacion WHERE informacion_codigo LIKE '%$row[3]%'");
                        $query_info=mysqli_query($connection,$consulta_info);
                            while($row_info=mysqli_fetch_array($query_info))
                            { 
                                $articulo_provincia = $row_info[1];
                                $articulo_comuna = $row_info[2];

                                //formulario monto financiamiento
                                $buscar_form_monto_financiamiento = "4.- MONTO DE FINANCIAMIENTO";
                                $consulta_formulario=("SELECT form_codigo,form_pregunta,form_respuesta FROM articulo_form WHERE form_codigo LIKE '%$articulo_codigo%' AND form_pregunta LIKE '%$buscar_form_monto_financiamiento%'");
                                $query_formulario=mysqli_query($connection,$consulta_formulario);
                                    while($row_formulario=mysqli_fetch_array($query_formulario))
                                    { 
                                        $articulo_formulario_monto_financiamiento = $row_formulario[2];
                                    }

                                //formulario funcionario_responsble
                                $buscar_form_funcionario_responsable = "7.- FUNCIONARIO RESPONSABLE";
                                $consulta_formulario_fr=("SELECT form_codigo,form_pregunta,form_respuesta FROM articulo_form WHERE form_codigo LIKE '%$articulo_codigo%' AND form_pregunta LIKE '%$buscar_form_funcionario_responsable%'");
                                $query_formulario_fr=mysqli_query($connection,$consulta_formulario_fr);
                                    while($row_formulario_fr=mysqli_fetch_array($query_formulario_fr))
                                    { 
                                        $articulo_formulario_funcionario_responsable = $row_formulario_fr[2];
                                    }


                                $consulta_ubicacion_p=("SELECT * FROM ubicacion_provincias WHERE provincias_codigo = $articulo_provincia");
                                $query_ubicacion_p=mysqli_query($connection_ub,$consulta_ubicacion_p);
                                    while($row_ubicacion_p=mysqli_fetch_array($query_ubicacion_p))
                                    { 
                                        $articulo_nombre_provincia = $row_ubicacion_p[2];
                                    }
                                    
                                $consulta_ubicacion_c=("SELECT * FROM ubicacion_comunas WHERE comunas_codigo = $articulo_comuna");
                                $query_ubicacion_c=mysqli_query($connection_ub,$consulta_ubicacion_c);
                                    while($row_ubicacion_c=mysqli_fetch_array($query_ubicacion_c))
                                    { 
                                        $articulo_nombre_comuna = $row_ubicacion_c[2];
                                    }

                                $consulta_usuarios=("SELECT usuario_codigo,usuario_nombre,usuario_apellido_p,usuario_apellido_m FROM usuarios WHERE usuario_codigo LIKE '%$articulo_codigo_usuario%'");
                                $query_usuarios=mysqli_query($connection_usuarios,$consulta_usuarios);
                                    while($row_usuarios=mysqli_fetch_array($query_usuarios))
                                    { 
                                        $articulo_nombre_usuario = $row_usuarios[1]." ".$row_usuarios[2]." ".$row_usuarios[3];
                                    }
    
                                    //codigo 
                                    $spreadsheet->getActiveSheet()
                                    ->setCellValue("A$a", "$row[1]");
                                    //tipo proyecto
                                    $spreadsheet->getActiveSheet()
                                    ->setCellValue("B$a", "$row[2]");
                                    //nombre proyecto
                                    $spreadsheet->getActiveSheet()
                                    ->setCellValue("C$a", "$row[14]");
                                    //provincia
                                    $spreadsheet->getActiveSheet()
                                    ->setCellValue("D$a", "$articulo_nombre_provincia");
                                    //comuna
                                    $spreadsheet->getActiveSheet()
                                    ->setCellValue("E$a", "$articulo_nombre_comuna");
                                    //clasificacion
                                    $spreadsheet->getActiveSheet()
                                    ->setCellValue("F$a", "$row[6]");
                                    //etapa
                                    $spreadsheet->getActiveSheet()
                                    ->setCellValue("G$a", "$row[9]");
                                    //tipo
                                    $spreadsheet->getActiveSheet()
                                    ->setCellValue("H$a", "$row[10]");
                                    //fecha postulacion
                                    $spreadsheet->getActiveSheet()
                                    ->setCellValue("I$a", "$row[8]");
                                    //progreso
                                    $spreadsheet->getActiveSheet()
                                    ->setCellValue("J$a", "$articulo_formulario_monto_financiamiento");
                                    //postulado por
                                    $spreadsheet->getActiveSheet()
                                    ->setCellValue("K$a", "$articulo_formulario_funcionario_responsable");
                            }  
                }
        break;
    }
            
//guardar
//$writer = IOFactory::createWriter($spreadsheet, "Xlsx"); //Xls is also possible
//$writer->load("aa.xlsx");

//solo abrir
$nombreDelDocumento = "Resultado_consulta_proyectos.xlsx";
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $nombreDelDocumento . '"');
header('Cache-Control: max-age=0');
 
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
exit;