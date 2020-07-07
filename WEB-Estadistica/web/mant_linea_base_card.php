<?php
include "../cnx/connection.php";
?>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card text-left">
                <div class="card-header">
                    Linea Base - Lista de Espera
                </div>
                <div class="card-body">
                    <span class="btn btn-primary" data-toggle="modal" data-target="#agregar_linea-base">Agregar Nuevo
                        <span class="fas fa-plus-circle"></span>
                    </span>
                    <span class="btn btn-primary" data-toggle="modal" data-target="#masivo_linea-base">Carga Masiva
                        <span class="fas fa-upload"></span>
                    </span>
                    <hr>
                    <div id="carga_linea-base"></div>
                </div>
                <div class="card-footer text-muted">
                    Sub-Departamento de Estadísticas y Gestión de la Información
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar -->
<div class="modal fade" id="agregar_linea-base" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Linea Base</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frm-nuevo-lines-base">
                    <label for="">Establecimiento</label>
                    <select id="estable_linea_base" name="estable_linea_base" class="form-control input-sm">
                        <option value="0" disabled>Seleccione:</option>
                        <?php
                        $sql_estable_lb = $connection->query("SELECT * FROM establecimiento ORDER BY codigo_estable ASC");
                        while ($res_estable_lb = mysqli_fetch_array($sql_estable_lb)) {
                            echo '<option value="' . $res_estable_lb[1] . '">' . $res_estable_lb[2] . '</option>';
                        }
                        ?>
                    </select>
                    <label for="">Cantidad</label>
                    <input type="text" id="cantidad_linea_base" name="cantidad_linea_base" class="form-control input-sm">
                    <label for="">Año</label>
                    <input type="text" id="anio_linea_base" name="anio_linea_base" class="form-control input-sm">
                    <label for="">Tipo Lista de Espera</label>
                    <select id="tipo_le_linea_base" name="tipo_le_linea_base" class="form-control input-sm">
                        <option value="0" disabled>Seleccione:</option>
                        <?php
                        $sql_tipole_lb = $connection->query("SELECT * FROM tipo_le ORDER BY codigo_tipo_le ASC");
                        while ($res_tipole_lb = mysqli_fetch_array($sql_tipole_lb)) {
                            echo '<option value="' . $res_tipole_lb[1] . '">' . $res_tipole_lb[2] . '</option>';
                        }
                        ?>
                    </select>
                    <input type="text" hidden="" name="seccion" value="linea-base">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="agregar-linea-base" class="btn btn-primary">Agregar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->

<!-- Modal Editar -->
<div class="modal fade" id="editar_linea-base" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Linea Base</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frm-editar-lines-base">
                    <input type="text" hidden="" id="id_linea_base" name="id_linea_base">
                    <label for="">Establecimiento</label>
                    <select id="estable_linea_base_up" name="estable_linea_base_up" class="form-control input-sm">
                        <option value="0" disabled>Seleccione:</option>
                        <?php
                        $sql_estable_lb_up = $connection->query("SELECT * FROM establecimiento ORDER BY codigo_estable ASC");
                        while ($res_estable_lb_up = mysqli_fetch_array($sql_estable_lb_up)) {
                            echo '<option value="' . $res_estable_lb_up[1] . '">' . $res_estable_lb_up[2] . '</option>';
                        }
                        ?>
                    </select>
                    <label for="">Cantidad</label>
                    <input type="text" id="cantidad_linea_base_up" name="cantidad_linea_base_up" class="form-control input-sm">
                    <label for="">Año</label>
                    <input type="text" id="anio_linea_base_up" name="anio_linea_base_up" class="form-control input-sm">
                    <label for="">Tipo Lista de Espera</label>
                    <select id="tipo_le_linea_base_up" name="tipo_le_linea_base_up" class="form-control input-sm">
                        <option value="0" disabled>Seleccione:</option>
                        <?php
                        $sql_tipole_lb = $connection->query("SELECT * FROM tipo_le ORDER BY codigo_tipo_le ASC");
                        while ($res_tipole_lb = mysqli_fetch_array($sql_tipole_lb)) {
                            echo '<option value="' . $res_tipole_lb[1] . '">' . $res_tipole_lb[2] . '</option>';
                        }
                        ?>
                    </select>
                    <input type="text" hidden="" name="seccion" value="linea-base">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="editar-linea-base" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->

<!-- Modal Carga Masiva -->
<div class="modal fade" id="masivo_linea-base" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Masivo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="form-masivo-lb">
                    <form action="" id="frm-carga-linea-base" enctype="multipart/form-data">
                        <label for="">Seleccionar Archivo:</label>
                        <input type="file" id="arch_lb" name="arch-linea-base">
                        <input type="text" hidden="" name="seccion" value="linea-base">
                    </form>
                </div>
                <div id="spinner-lb"><div class="spinner-grow text-info"></div> Insertando datos...</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="cargar-masivo-linea-base" class="btn btn-primary">Cargar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->

<script type="text/javascript">
    $(document).ready(function() {
        mant_linea_base();

        $('#spinner-lb').hide();

        $('#agregar-linea-base').click(function() {
            datos_linea_base = $('#frm-nuevo-lines-base').serialize();
            AgregarDatosLineaBase(datos_linea_base);
        });

        $('#editar-linea-base').click(function() {
            editar_linea_base = $('#frm-editar-lines-base').serialize();
            EditarLineaBase(editar_linea_base);
        });

        $('#cargar-masivo-linea-base').click(function() {
            MasivoDatosLineaBase();
        });
    });
</script>