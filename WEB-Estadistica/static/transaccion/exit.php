<?php
    session_start();
    //Removemos sesión.
    session_unset();
    //Destruimos sesión.
    session_destroy();              
    //Redirigimos pagina.
    header("Location: ../../index.php");
?>