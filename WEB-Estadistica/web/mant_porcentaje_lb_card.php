<?php
include "../cnx/connection.php";
?>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card text-left">
                <div class="card-header">
                    Porcentajes resolución COMGES
                </div>
                <div class="card-body">
                    <span class="btn btn-primary" data-toggle="modal" data-target="#agregar_porcentaje_lb">Agregar Nuevo
                        <span class="fas fa-plus-circle"></span>
                    </span>
                    <span class="btn btn-primary" data-toggle="modal" data-target="#masivo_porcentaje_lb">Carga Masiva
                        <span class="fas fa-upload"></span>
                    </span>
                    <hr>
                    <div id="carga_porcentaje_lb"></div>
                </div>
                <div class="card-footer text-muted">
                    Sub-Departamento de Estadísticas y Gestión de la Información
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar -->
<div class="modal fade" id="agregar_porcentaje_lb" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Porcentaje COMGES</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frm-nuevo-porcentaje-lb">
                    <label for="">Tipo Establecimiento</label>
                    <select id="tipo_estable_porcentaje_lb" name="tipo_estable_porcentaje_lb" class="form-control input-sm">
                        <option value="0" disabled>Seleccione:</option>
                        <?php
                        $sql_tipo = $connection->query("SELECT * FROM tipo_estable");
                        while ($res_tipo = mysqli_fetch_array($sql_tipo)) {
                            echo '<option value="' . $res_tipo[1] . '">' . $res_tipo[2] . '</option>';
                        }
                        ?>
                    </select>
                    <label for="">1º Corte</label>
                    <input type="text" id="primer_porcentaje_lb" name="primer_porcentaje_lb" class="form-control input-sm" placeholder="%">
                    <label for="">2º Corte</label>
                    <input type="text" id="segundo_porcentaje_lb" name="segundo_porcentaje_lb" class="form-control input-sm" placeholder="%">
                    <label for="">3º Corte</label>
                    <input type="text" id="tercer_porcentaje_lb" name="tercer_porcentaje_lb" class="form-control input-sm" placeholder="%">
                    <label for="">4º Corte</label>
                    <input type="text" id="cuarto_porcentaje_lb" name="cuarto_porcentaje_lb" class="form-control input-sm" placeholder="%">
                    <label for="">Año</label>
                    <input type="text" id="anio_porcentaje_lb" name="anio_porcentaje_lb" class="form-control input-sm">
                    <input type="text" hidden="" name="seccion" value="porcentaje-lb">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="agregar-porcentaje-lb" class="btn btn-primary">Agregar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->

<!-- Modal Editar -->
<div class="modal fade" id="editar_porcentaje_lb" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Porcentaje COMGES</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frm-editar-porcentaje-lb">
                    <input type="text" hidden="" id="id_porc_lb" name="id_porc_lb">
                    <label for="">Tipo Establecimiento</label>
                    <select id="tipo_estable_porcentaje_lb_up" name="tipo_estable_porcentaje_lb_up" class="form-control input-sm">
                        <option value="0" disabled>Seleccione:</option>
                        <?php
                        $sql_tipo = $connection->query("SELECT * FROM tipo_estable");
                        while ($res_tipo = mysqli_fetch_array($sql_tipo)) {
                            echo '<option value="' . $res_tipo[1] . '">' . $res_tipo[2] . '</option>';
                        }
                        ?>
                    </select>
                    <label for="">1º Corte</label>
                    <input type="text" id="primer_porcentaje_lb_up" name="primer_porcentaje_lb_up" class="form-control input-sm">
                    <label for="">2º Corte</label>
                    <input type="text" id="segundo_porcentaje_lb_up" name="segundo_porcentaje_lb_up" class="form-control input-sm">
                    <label for="">3º Corte</label>
                    <input type="text" id="tercer_porcentaje_lb_up" name="tercer_porcentaje_lb_up" class="form-control input-sm">
                    <label for="">4º Corte</label>
                    <input type="text" id="cuarto_porcentaje_lb_up" name="cuarto_porcentaje_lb_up" class="form-control input-sm">
                    <label for="">Año</label>
                    <input type="text" id="anio_porcentaje_lb_up" name="anio_porcentaje_lb_up" class="form-control input-sm">
                    <input type="text" hidden="" name="seccion" value="porcentaje-lb">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="editar-porcentaje-lb" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->

<!-- Modal Carga Masiva -->
<div class="modal fade" id="masivo_porcentaje_lb" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Masivo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="form-masivo-porcentaje-lb">
                    <form action="" id="frm-carga-porcentaje-lb" enctype="multipart/form-data">
                        <label for="">Seleccionar Archivo:</label>
                        <input type="file" id="arch_porcentaje_lb" name="arch-porcentaje-lb">
                        <input type="text" hidden="" name="seccion" value="porcentaje-lb">
                    </form>
                </div>
                <div id="spinner-porcentaje-lb">
                    <div class="spinner-grow text-info"></div> Insertando datos...
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="cargar-masivo-porcentaje-lb" class="btn btn-primary">Cargar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->

<script type="text/javascript">
    $(document).ready(function() {
        mant_porcentaje_lb();

        $('#spinner-porcentaje-lb').hide();

        $('#agregar-porcentaje-lb').click(function() {
            datos_porcentaje_lb = $('#frm-nuevo-porcentaje-lb').serialize();
            AgregarDatosPorcentajeLB(datos_porcentaje_lb);
        });

        $('#editar-porcentaje-lb').click(function() {
            editar_porcentaje_lb = $('#frm-editar-porcentaje-lb').serialize();
            EditarPorcentajeLB(editar_porcentaje_lb);
        });

        $('#cargar-masivo-porcentaje-lb').click(function() {
            MasivoDatosPorcentajeLB();
        });
    });
</script>