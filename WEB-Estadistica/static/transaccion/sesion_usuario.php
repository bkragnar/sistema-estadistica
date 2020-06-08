<?php

include "cnx/connection.php";

session_start();
$user = $_SESSION['session_usuario_codigo'];

$sql_sesion_usuario =$connection->query( "SELECT privilegio_sime FROM usuarios_sime WHERE id_sime='$user'");
$res_sesion_usuario= mysqli_fetch_array($sql_sesion_usuario);
$privilegio = $res_sesion_usuario[0];

?>

