<?php
include "../cnx/connection.php";
?>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card text-left">
                <div class="card-header">
                    Egresos Lista de Espera COMGES
                </div>
                <div class="card-body">
                    <span class="btn btn-primary" data-toggle="modal" data-target="#agregar_egreso_le">Agregar Nuevo
                        <span class="fas fa-plus-circle"></span>
                    </span>
                    <span class="btn btn-primary" data-toggle="modal" data-target="#masivo_egreso_le">Carga Masiva
                        <span class="fas fa-upload"></span>
                    </span>
                    <hr>
                    <div id="carga_egreso_le"></div>
                </div>
                <div class="card-footer text-muted">
                    Sub-Departamento de Estadísticas y Gestión de la Información
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar -->
<div class="modal fade" id="agregar_egreso_le" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Egreso COMGES</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frm-nuevo-egreso-le">
                    <label for="">Tipo Establecimiento</label>
                    <select id="estable_egreso_le" name="estable_egreso_le" class="form-control input-sm">
                        <option value="0" disabled>Seleccione:</option>
                        <?php
                        $sql_estable_lb = $connection->query("SELECT * FROM establecimiento ORDER BY codigo_estable ASC");
                        while ($res_estable_lb = mysqli_fetch_array($sql_estable_lb)) {
                            echo '<option value="' . $res_estable_lb[1] . '">' . $res_estable_lb[2] . '</option>';
                        }
                        ?>
                    </select>
                    <label for="">Cantidad</label>
                    <input type="number" id="cantidad_egreso_le" min="0" name="cantidad_egreso_le" class="form-control input-sm">
                    <label for="">Mes</label>
                    <select id="mes_egreso_le" name="mes_egreso_le" class="form-control input-sm">
                        <option value="1">Enero</option>
                        <option value="2">Febrero</option>
                        <option value="3">Marzo</option>
                        <option value="4">Abril</option>
                        <option value="5">Mayo</option>
                        <option value="6">Junio</option>
                        <option value="7">Julio</option>
                        <option value="8">Agosto</option>
                        <option value="9">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>
                    <label for="">Año</label>
                    <input type="number" id="anio_egreso_le" name="anio_egreso_le" min="2000" value="2000" class="form-control input-sm">
                    <label for="">Tipo L.E</label>
                    <select id="tipo_le_egreso_le" name="tipo_le_egreso_le" class="form-control input-sm">
                        <option value="0" disabled>Seleccione:</option>
                        <?php
                        $sql_tipo_le = $connection->query("SELECT * FROM tipo_le ORDER BY codigo_tipo_le ASC");
                        while ($res_tipo_le = mysqli_fetch_array($sql_tipo_le)) {
                            echo '<option value="' . $res_tipo_le[1] . '">' . $res_tipo_le[2] . '</option>';
                        }
                        ?>
                    </select>
                    <input type="text" hidden="" name="seccion" value="egreso-le">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="agregar-egreso-le" class="btn btn-primary">Agregar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->

<!-- Modal Editar -->
<div class="modal fade" id="editar_egreso_le" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Egreso COMGES</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frm-editar-egreso-le">
                    <input type="text" hidden="" id="id_egreso_le" name="id_egreso_le">
                    <label for="">Tipo Establecimiento</label>
                    <select id="estable_egreso_le_up" name="estable_egreso_le_up" class="form-control input-sm">
                        <option value="0" disabled>Seleccione:</option>
                        <?php
                        $sql_estable_le = $connection->query("SELECT * FROM establecimiento ORDER BY codigo_estable ASC");
                        while ($res_estable_le = mysqli_fetch_array($sql_estable_le)) {
                            echo '<option value="' . $res_estable_le[1] . '">' . $res_estable_le[2] . '</option>';
                        }
                        ?>
                    </select>
                    <label for="">Cantidad</label>
                    <input type="text" id="cantidad_egreso_le_up" name="cantidad_egreso_le_up" class="form-control input-sm">
                    <label for="">Mes</label>
                    <select id="mes_egreso_le_up" name="mes_egreso_le_up" class="form-control input-sm">
                        <option value="1">Enero</option>
                        <option value="2">Febrero</option>
                        <option value="3">Marzo</option>
                        <option value="4">Abril</option>
                        <option value="5">Mayo</option>
                        <option value="6">Junio</option>
                        <option value="7">Julio</option>
                        <option value="8">Agosto</option>
                        <option value="9">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>
                    <label for="">Año</label>
                    <input type="text" id="anio_egreso_le_up" name="anio_egreso_le_up" class="form-control input-sm">
                    <label for="">Tipo L.E</label>
                    <select id="tipo_le_egreso_le_up" name="tipo_le_egreso_le_up" class="form-control input-sm">
                        <option value="0" disabled>Seleccione:</option>
                        <?php
                        $sql_tipo_le = $connection->query("SELECT * FROM tipo_le ORDER BY codigo_tipo_le ASC");
                        while ($res_tipo_le = mysqli_fetch_array($sql_tipo_le)) {
                            echo '<option value="' . $res_tipo_le[1] . '">' . $res_tipo_le[2] . '</option>';
                        }
                        ?>
                    </select>
                    <input type="text" hidden="" name="seccion" value="egreso-le">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="editar-egreso-le" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->

<!-- Modal Carga Masiva -->
<div class="modal fade" id="masivo_egreso_le" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Masivo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="form-masivo-egreso-le">
                    <form action="" id="frm-carga-egreso-le" enctype="multipart/form-data">
                        <label for="">Seleccionar Archivo:</label>
                        <input type="file" id="arch_egreso_le" name="arch_egreso_le">
                        <input type="text" hidden="" name="seccion" value="egreso-le">
                    </form>
                </div>
                <div id="spinner-egreso-le">
                    <div class="spinner-grow text-info"></div> Insertando datos...
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="cargar-masivo-egreso-le" class="btn btn-primary">Cargar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->

<script type="text/javascript">
    $(document).ready(function() {
        mant_egreso_le();

        $('#spinner-egreso-le').hide();

        $('#agregar-egreso-le').click(function() {
            datos_egreso_le = $('#frm-nuevo-egreso-le').serialize();
            AgregarDatosEgresoLE(datos_egreso_le);
        });

        $('#editar-egreso-le').click(function() {
            editar_egreso_le = $('#frm-editar-egreso-le').serialize();
            EditarEgresoLE(editar_egreso_le);
        });

        $('#cargar-masivo-egreso-le').click(function() {
            MasivoDatosEgresoLE();
        });

    });
</script>