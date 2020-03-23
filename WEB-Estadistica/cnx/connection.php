<?php

$connection = new MySQLi("127.0.0.1", "root","leonidas9781","estadistica");

if (!$connection->set_charset("utf8")) {
        die("Error mostrando el conjunto de caracteres utf8");
}

		
?>
