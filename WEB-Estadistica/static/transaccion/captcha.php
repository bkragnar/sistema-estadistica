<?php
    session_start();
    if(isset($_SESSION['captcha']['token_captcha']))
    {
        unset($_SESSION['captcha']['token_captcha']);
        //Se genera un string y se acorta a seis caracteres 
        $ranStr = substr( sha1( microtime() ),0,6); 
        //Se almacena el valor en una variable de sesión 
        //$hola = $ranStr;
        $_SESSION['captcha']['token_captcha'] = password_hash($ranStr, PASSWORD_DEFAULT);
        //Se crea la imagen (esta debe existir) 
        //$imagen = imagecreatefromjpeg( "ssc_usuarios/views/include/img/captcha.jpg" ); 
        $imagen = imagecreatefromjpeg( "../img_fija/captcha.jpg" ); 

        // la funcion imagecolorallocate ( $imagen , rojo , verde , azul ) genera un color  
        $colortext = imagecolorallocate($imagen,255, 87, 51); 
        imagestring($imagen, 5, 30, 8, $ranStr, $colortext); 
        header( "Content-type: image/jpeg" );
        //Se crea la imagen 
        $captcha = imagejpeg($imagen); 
    }else{
        unset($_SESSION['captcha']['token_captcha']);
        //Se genera un string y se acorta a seis caracteres 
        $ranStr = substr( sha1( microtime() ),0,6); 
        //Se almacena el valor en una variable de sesión 
        //$hola = $ranStr;
        $_SESSION['captcha']['token_captcha'] = password_hash($ranStr, PASSWORD_DEFAULT);
        //Se crea la imagen (esta debe existir) 
        //$imagen = imagecreatefromjpeg( "ssc_usuarios/views/include/img/captcha.jpg" ); 
        $imagen = imagecreatefromjpeg( "../img_fija/captcha.jpg" ); 

        // la funcion imagecolorallocate ( $imagen , rojo , verde , azul ) genera un color  
        $colortext = imagecolorallocate($imagen, 255, 87, 51); 
        imagestring($imagen, 5, 30, 8, $ranStr, $colortext); 
        header( "Content-type: image/jpeg" );
        //Se crea la imagen 
        $captcha = imagejpeg($imagen); 
    }     
?>