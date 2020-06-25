<?php
include "../cnx/connection.php";

$sql_img_slider = $connection->query("SELECT * FROM slider_inicio");
$cantidad_img = mysqli_num_rows($sql_img_slider);

?>
<style>
    .carousel-caption{
        right: 0%;
        left: 0%;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card text-left">
                <div class="card-header">
                    Información
                </div>
                <div class="card-body px-0">
                    <div id="demo" class="carousel slide" data-ride="carousel">
                        <ul class="carousel-indicators">
                            <?php
                            for ($i = 0; $i < $cantidad_img; $i++) {
                                if ($i == 0) {
                                    echo "<li data-target='#demo' data-slide-to='$i' class='active'></li>";
                                } else {
                                    echo "<li data-target='#demo' data-slide-to='$i'></li>";
                                }
                            }

                            ?>
                        </ul>
                        <div class="carousel-inner">
                            <?php
                            $aux = 0;
                            while ($res_slider = mysqli_fetch_array($sql_img_slider)) {
                                if ($aux == 0) {
                                    $mclase = "active";
                                } else {
                                    $mclase = "";
                                }
                            ?>
                                <div class="carousel-item <?php echo $mclase ?>">
                                    <img src="static/img_slider/<?php echo $res_slider[1] ?>" >
                                    <div class="carousel-caption fondo-slider-inicio">
                                        <h3><?php echo $res_slider[2] ?></h3>
                                        <p><?php echo $res_slider[3] ?></p>
                                    </div>
                                </div>
                            <?php
                                $aux++;
                            }
                            ?>
                        </div>
                        <a class="carousel-control-prev" href="#demo" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#demo" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    Sub-Departamento de Estadísticas y Gestión de la Información
                </div>
            </div>
        </div>
    </div>
</div>