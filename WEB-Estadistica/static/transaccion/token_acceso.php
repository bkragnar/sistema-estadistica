<?php
//funcion para generar un token random
function token_acceso()
{
    $length = 32;
    $token = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $length); 
    return $token;
}
function token_captcha()
{
    $ranStr = substr( sha1( microtime() ),0,6);     
    return $ranStr;
}
//generamos un token diferente para cada variable
$token_privado = token_acceso();
$token_publico = token_acceso();
$token_sesion = token_acceso();
$token_captcha = token_captcha();
$acceso_user = token_acceso();
$acceso_pass = token_acceso();
//asignamos un array para los tokens
$token = 
[
    "privado" => "$token_privado",
    "publico" => "$token_publico",    
    "sesion" => "$token_sesion"    
];
//asignamos un arary para el captcha
$token_captcha = 
[   
    "token_captcha" => "$token_captcha"      
];
//asignamos un array para el nombre de los input del formulario
$input_acceso = 
[
    "usuario" => "$acceso_user",
    "password" => "$acceso_pass"
];
//generamos las sessiones para poder acceder a los datos por sesion
$_SESSION['token'] = $token;
$_SESSION['captcha'] = $token_captcha;
$_SESSION['acceso'] = $input_acceso;
?>