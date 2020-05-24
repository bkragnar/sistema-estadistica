<?php
session_start();
require_once("../../cnx/connection.php");

$codigo_usuario = $_SESSION['session_usuario_codigo'];

$consulta = ("SELECT ip_usser_log,token_usser_log FROM usser_log WHERE nombre_usser_log='$codigo_usuario'");
$query = mysqli_query($connection, $consulta);
while ($row = mysqli_fetch_array($query)) {
	if ($row['token_usser_log'] != $_SESSION['token']['sesion']) {
		echo "<script>location.href='static/transaccion/exit.php'</script>";
	}
}
