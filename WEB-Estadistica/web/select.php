<?php
include "../cnx/connection.php";

$seleccion=$_POST['seleccion'];

switch($seleccion){
    case "comuna":
        $sql_comuna = $connection->query("SELECT * FROM comuna ORDER BY codigo_comuna ASC");
        $cadena="<label for='' class='row ml-2'>Comuna:</label>
        <select class='row mx-2' id='comuna_no_ges' name='comuna_no_ges'>";
        $cadena=$cadena.'<option value="0" >Seleccione</option>';

        while ($res_comuna = mysqli_fetch_array($sql_comuna)) {
            $cadena=$cadena.'<option value='. $res_comuna[1] . '>' . $res_comuna[2] . '</option>';
        }
        echo $cadena."</select>";
    break;
}
