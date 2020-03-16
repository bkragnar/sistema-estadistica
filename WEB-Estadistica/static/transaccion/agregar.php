<?php 
    include "../../cnx/connection.php";

    $seccion = $_POST['seccion'];

    switch ($seccion){
        case "provincia":
            $codigo_provincia = $_POST['codigo_provincia'];
            $nombre_provincia = $_POST['nombre_provincia'];

            $sql_provincia = "INSERT INTO provincia (codigo_provincia,nombre_provincia)
                            VALUES ('$codigo_provincia','$nombre_provincia')";
            echo mysqli_query($connection,$sql_provincia);
        break;

        case "comuna":
            $codigo_comuna = $_POST['codigo_comuna'];
            $nombre_comuna = $_POST['nombre_comuna'];
            $cod_provincia_comuna = $_POST['codigo_provincia_comuna'];

            $sql_comuna = "INSERT INTO comuna(codigo_comuna,nombre_comuna,codigo_provincia)
                            VALUES('$codigo_comuna','$nombre_comuna','$cod_provincia_comuna')";
            echo mysqli_query($connection,$sql_comuna);
        break;

        case "tipo_estable":
            $codigo_tipo_estable = $_POST['codigo_tipo_estable'];
            $nombre_tipo_estable = $_POST['nombre_tipo_estable'];

            $sql_tipo_estable = "INSERT INTO tipo_estable (codigo_tipo,nombre_tipo)
                            VALUES('$codigo_tipo_estable','$nombre_tipo_estable')";
            echo mysqli_query($connection,$sql_tipo_estable);
        break;

        case "establecimiento":
            $codigo_estable = $_POST['codigo_estable'];
            $nombre_estable = $_POST['nombre_estable'];
            $codigo_comuna_estable = $_POST['cod_comuna_estable'];
            $codigo_provincia_estable = $_POST['cod_provincia_estable'];
            $tipo_estable = $_POST['tipo_estable'];

            $sql_estable = "INSERT INTO establecimiento (codigo_estable,nombre_estable,codigo_comuna,codigo_provincia,tipo_estable)
                            VALUES('$codigo_estable','$nombre_estable','$codigo_comuna_estable','$codigo_provincia_estable','$tipo_estable')";
            echo mysqli_query($connection,$sql_estable);
        break;

        case "tipo-le":
            $codigo_tipo_le=$_POST['codigo_tipo_le'];
            $nombre_tipo_le=$_POST['nombre_tipo_le'];

            $sql_tipo_le="INSERT INTO tipo_le (codigo_tipo_le,nombre_tipo_le) VALUES('$codigo_tipo_le','$nombre_tipo_le')";
            echo mysqli_query($connection,$sql_tipo_le);
        break;

        case "linea-base":
            $codigo_estable_lb = $_POST['estable_linea_base'];
            $cantidad_lb = $_POST['cantidad_linea_base'];
            $anio_lb = $_POST['anio_linea_base'];
            $id_lb = "lb_".$codigo_estable_lb."_".$anio_lb;

            $sql_linea_base="INSERT INTO linea_base_le (id_lb,codigo_estable_lb,cantidad_lb,anio_lb) VALUES('$id_lb',$codigo_estable_lb,$cantidad_lb,$anio_lb)";
            echo mysqli_query($connection,$sql_linea_base);
        break;

        case "porcentaje-lb":
            $tipo_estable_porc_lb = $_POST['tipo_estable_porcentaje_lb'];
            $primer_corte = $_POST['primer_porcentaje_lb'];
            $segundo_corte = $_POST['segundo_porcentaje_lb'];
            $tercer_corte = $_POST['tercer_porcentaje_lb'];
            $cuarto_corte = $_POST['cuarto_porcentaje_lb'];
            $anio_porc_lb = $_POST['anio_porcentaje_lb'];

            $id_porc_lb ="prc"."_".$tipo_estable_porc_lb."_".$anio_porc_lb;

            $sql_porcentaje_lb="INSERT INTO porcentaje_lb (id_porc_lb,tipo_estable_porc_lb,pri_corte_porc_lb,seg_corte_porc_lb,ter_corte_porc_lb,cto_corte_porc_lb,anio_corte_porc_lb) 
                            VALUES('$id_porc_lb',$tipo_estable_porc_lb,$primer_corte,$segundo_corte,$tercer_corte,$cuarto_corte,$anio_porc_lb)";
            echo mysqli_query($connection,$sql_porcentaje_lb);
        break;

        case "egreso-le":
            $estable_eg = $_POST['estable_egreso_le'];
            $cantidad_eg = $_POST['cantidad_egreso_le'];
            $mes_eg = $_POST['mes_egreso_le'];
            $anio_eg = $_POST['anio_egreso_le'];
            $tipo_le_eg = $_POST['tipo_le_egreso_le'];

            $id_egreso ="Eg_".$estable_eg."_".$mes_eg."_".$anio_eg;

            $sql_egreso_le ="INSERT INTO egresos_le (id_egreso,estable_eg,cantidad_eg,mes_eg,anio_eg,tipo_le_eg) 
                            VALUES ('$id_egreso',$estable_eg,$cantidad_eg,$mes_eg,$anio_eg,$tipo_le_eg)";
            echo mysqli_query($connection,$sql_egreso_le);

        break;
        
    }

?>