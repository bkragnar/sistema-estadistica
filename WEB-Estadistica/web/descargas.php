<?php
session_start();
if ($_GET['token'] != $_SESSION['token']['publico'] || empty($_SESSION['token']['privado']) || empty($_GET['token']) || empty($_GET['ruta'])) {
} else {
    $ruta = "../static/directorio_noges/" . $_GET['ruta'];
    $archivo = basename($ruta);

    header('Content-Description: File Transfer');
    header("Content-Disposition: attachment; filename=$archivo");
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($ruta));
    readfile($ruta);
}
