<!DOCTYPE html>
<html lang="es">

<head>
    <title>Estadística | Servicio de Salud Coquimbo | Ministerio de Salud</title>
    <?php
    include_once "static/resumen_script.php";
    ?>
</head>

<body>

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
            <div id="contenido-index"></div>
            <!--###end contenido###-->
        </div>
    </section>
    <footer class="container-fluid navbar-dark bg-dark">
        <?php include_once("static/nav/footer.php"); ?>
    </footer>

</body>

</html>