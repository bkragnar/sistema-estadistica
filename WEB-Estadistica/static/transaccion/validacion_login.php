<?php
session_start();
sleep(1);
include "../../cnx/connection.php";
require_once("filtro_input.php");
//validamos captcha    
if (password_verify(cleanInput($_POST['text-captcha']), $_SESSION['captcha']['token_captcha'])) {
    //si pasa controlamos el token publico
    if ($_POST['token_acceso'] != $_SESSION['token']['publico']) {
        echo "Acceso Denegado";
    } else {
        //guardamos el token publico para luego enviarlo por url 
        $token_publico = $_SESSION['token']['publico'];
        //se reciben los input del form   
        $inputUser = cleanInput($_POST[($_SESSION['acceso']['usuario'])]);
        $inputPassword = cleanInput($_POST[($_SESSION['acceso']['password'])]);
        //validamos por el lado del servidor que los input no esten vacios
        //si  lo estan enviamos el siguiente mensaje
        if (!$inputUser) {
            echo "Acceso Denegado";
        } elseif (!$inputPassword) {
            echo "Acceso Denegado";
        }
        //si no estan vacios pasamos a la validacion de los datos ingresados
        else {
            //ip usuario
            $ipUser = getRealIP();

            //se busca el usuario en la bd
            $consulta = mysqli_query($connection, "SELECT usuario_sime,contrasena_sime,id_sime FROM usuarios_sime WHERE usuario_sime = '$inputUser'");
            if ($row = mysqli_fetch_assoc($consulta)) {
                //comparación de passwords
                if (password_verify($inputPassword, $row['contrasena_sime'])) {
                    $codigo_usuario = $row['id_sime'];
                    $fecha = date("Y-m-d H:i:s");
                    $token_sesion = $_SESSION['token']['sesion'];

                    //controlamos el token
                    $consulta_token = ("SELECT nombre_usser_log FROM usser_log WHERE nombre_usser_log = '$codigo_usuario'");
                    $query_token = mysqli_query($connection, $consulta_token);
                    if (!$row_token = mysqli_fetch_array($query_token)) {
                        mysqli_query($connection, "INSERT INTO usser_log (ip_usser_log,nombre_usser_log,fecha_usser_log,estado_usser_log,token_usser_log)VALUES('$ipUser','$codigo_usuario','$fecha',0,'$token_sesion')");
                        //si todo esta correcto creamos session y redireccionamos
                        $_SESSION['session_usuario_codigo'] = $codigo_usuario;
                        echo "<script>location.href='index.php?s=1&v=$token_publico'</script>";
                    } else {
                        mysqli_query($connection, "UPDATE usser_log SET fecha_usser_log = '$fecha', token_usser_log = '$token_sesion' WHERE nombre_usser_log = '$codigo_usuario'");
                        //si todo esta correcto creamos session y redireccionamos
                        $_SESSION['session_usuario_codigo'] = $codigo_usuario;
                        echo "<script>location.href='index.php?v=$token_publico'</script>";
                    }
                    //end control token


                } else {
                    //mensaje usuario no registrado
                    echo "Acceso Denegado";
                }
            } else {
                //mensaje pass equivocada
                echo "Acceso Denegado";
            }
        } //end else vacio


    } //end if token

} else { //else captcha
    echo "Acceso Denegado";
}





//ip
function getRealIP()
{
    if (isset($_SERVER["HTTP_CLIENT_IP"])) {
        return $_SERVER["HTTP_CLIENT_IP"];
    } elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
        return $_SERVER["HTTP_X_FORWARDED_FOR"];
    } elseif (isset($_SERVER["HTTP_X_FORWARDED"])) {
        return $_SERVER["HTTP_X_FORWARDED"];
    } elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])) {
        return $_SERVER["HTTP_FORWARDED_FOR"];
    } elseif (isset($_SERVER["HTTP_FORWARDED"])) {
        return $_SERVER["HTTP_FORWARDED"];
    } else {
        return $_SERVER["REMOTE_ADDR"];
    }
} //end function ip    
