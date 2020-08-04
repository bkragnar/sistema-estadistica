<?php
session_start();

if (!isset($_SESSION)) {
    session_start();
}
//controlamos el token que viene por get del inicio de sesion
if (!empty($_GET['v'])) {
    if ($_GET['v'] != $_SESSION['token']['publico'] || empty($_SESSION['token']['privado']) || empty($_GET['v'])) {
        echo "<script>location.href='static/transaccion/exit.php'</script>";
    } else {
        $token_publico = $_SESSION['token']['publico'];
        $token_privado = $_SESSION['token']['privado'];
        $token_sesion = $_SESSION['token']['sesion'];
        include_once "static/transaccion/sesion_usuario.php";
        
?>

<?php
    }
} else {
    include_once "static/transaccion/token_acceso.php";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Estadística | Servicio de Salud Coquimbo | Ministerio de Salud</title>
    <?php include_once "static/resumen_script.php"; ?>
    <div id="control"></div>
    <script src="static/js/token_control.js"></script>
</head>

<body>
    <?php echo "<input type=\"hidden\" id=\"token_publico_descarga\" value=\"$token_publico\">"; ?>
    <header>
        <div class="header-container">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3">
                        <img src="static/img_fija/logo_dssc.png" alt="Servicio de Salud Coquimbo" class="img-fluid header-logo">

                    </div>
                    <div class="col-9">
                        <!-- 9 -->

                        <h1 class="header-title"></h1>
                        <div class="head-sime">
                            <img src="static/img_fija/SIME.gif" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once("static/nav/head.php"); ?>
    </header>
    <section>
        <div class="container">
            <!--###contenido###-->
            <div id="contenido-index" class="py-5"></div>
            <!--###end contenido###-->
        </div>
    </section>
    <footer class="container-fluid navbar-dark bg-dark">
        <?php include_once("static/nav/footer.php"); ?>
    </footer>
    <script>
        $(document).ready(function() {
            var primer_ingreso = '<?php echo $_GET['s'] ?>';
            if (primer_ingreso == 1) {
                alertify.warning("Debe cambiar su Contraseña");
                cambio_clave();
            }
        });
    </script>
</body>

</html>