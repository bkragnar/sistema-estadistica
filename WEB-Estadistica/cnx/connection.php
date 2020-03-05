<?php

$connection = new MySQLi("localhost", "root","","estadisticas");

if (!$connection->set_charset("utf8")) {
        die("Error mostrando el conjunto de caracteres utf8");
}

		
?>
