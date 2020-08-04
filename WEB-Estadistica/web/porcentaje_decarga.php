<?php
$fileName = $_FILES["archivo_directorio_noges"]["name"]; // The file name
$fileTmpLoc = $_FILES["archivo_directorio_noges"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["archivo_directorio_noges"]["type"]; // The type of file it is
$fileSize = $_FILES["archivo_directorio_noges"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["archivo_directorio_noges"]["error"]; // 0 for false... and 1 for true
if (!$fileTmpLoc) { // if file not chosen
    echo "ERROR: Please browse for a file before clicking the upload button.";
    exit();
}
?>