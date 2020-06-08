<?php
include "../cnx/connection.php";

$seleccion = $_POST['seleccion'];

switch ($seleccion) {
    case "comuna":
        $sql_comuna = $connection->query("SELECT * FROM comuna ORDER BY codigo_comuna ASC");
        $cadena = "<label for='' class='row ml-2'>Comuna:</label>
        <select class='row mx-2' id='comuna_no_ges' name='comuna_no_ges'>";
        $cadena = $cadena . '<option value="0" >Seleccione</option>';

        while ($res_comuna = mysqli_fetch_array($sql_comuna)) {
            $cadena = $cadena . '<option value=' . $res_comuna[1] . '>' . $res_comuna[2] . '</option>';
        }
        echo $cadena . "</select>";
        break;

    case "comuna-rs": //red siges
        $estable_rs = $_POST['estable'];
        $sql_comuna = $connection->query("SELECT c.codigo_comuna,c.nombre_comuna FROM comuna c INNER JOIN establecimiento e on c.codigo_comuna=e.codigo_comuna WHERE e.codigo_estable=$estable_rs");
        $cadena = "<label for='' class='row ml-2'>Comuna:</label>
            <select class='form-control input-sm' id='comuna_red_siges' name='comuna_red_siges'>";
        //$cadena = $cadena . '<option value="0" >Seleccione</option>';

        while ($res_comuna = mysqli_fetch_array($sql_comuna)) {
            $cadena = $cadena . '<option value=' . $res_comuna[0] . '>' . $res_comuna[1] . '</option>';
        }
        echo $cadena . "</select>";
        break;

    case "comuna-rs-up": //red siges
        $estable_rs = $_POST['estable'];
        $sql_comuna = $connection->query("SELECT c.codigo_comuna,c.nombre_comuna FROM comuna c INNER JOIN establecimiento e on c.codigo_comuna=e.codigo_comuna WHERE e.codigo_estable=$estable_rs");
        $cadena = "<label for='' class='row ml-2'>Comuna:</label>
                <select class='form-control input-sm' id='comuna_red_siges_up' name='comuna_red_siges_up'>";
        //$cadena = $cadena . '<option value="0" >Seleccione</option>';

        while ($res_comuna = mysqli_fetch_array($sql_comuna)) {
            $cadena = $cadena . '<option value=' . $res_comuna[0] . '>' . $res_comuna[1] . '</option>';
        }
        echo $cadena . "</select>";
        break;


    case "meses-rg":
        $anio_res_ges = $_POST['anio'];

        $sql_meses_rg = $connection->query("SELECT min(DISTINCT(mes_eg_ges)),max(DISTINCT(mes_eg_ges))  FROM egresos_ges WHERE estable_eg_ges='105001' and codigo_tipo_ges_eg_ges=3 and anio_eg_ges=$anio_res_ges");
        $res_mes_minmax = mysqli_fetch_array($sql_meses_rg);
        $m_min = $res_mes_minmax[0];
        $m_max = $res_mes_minmax[1];

        $sql_meses = $connection->query("SELECT DISTINCT(mes_eg_ges)  FROM egresos_ges WHERE estable_eg_ges='105001' and codigo_tipo_ges_eg_ges=3 and anio_eg_ges=$anio_res_ges");

        $cadena = "<input id='meses-vencidas' name='meses-vencidas' class='form-control-range' type='range' min='$m_min' max='$m_max' value='$m_max' list='lista-meses' step='1' autocomplete='off' onclick='etiquetaMes()'>
                <datalist id='lista-meses'>";
        $cantidad = mysqli_num_rows($sql_meses);

        $aux = 1;
        while ($res_meses = mysqli_fetch_array($sql_meses)) {
            if ($aux == 1) {
                $cadena = $cadena .  '<option value=' . $res_meses[0] . ' label=' . $res_meses[0] . '></option>';
            } elseif ($aux == $cantidad) {
                $cadena = $cadena .  '<option value=' . $res_meses[0] . ' label=' . $res_meses[0] . '></option>';
            } else {
                $cadena = $cadena .  '<option value=' . $res_meses[0] . '></option>';
            }
            $aux++;
        }
        echo $cadena . "</datalist>" . '<script> etiquetaMes(); </script>';

        break;
}
