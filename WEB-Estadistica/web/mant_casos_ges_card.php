<?php
include "../cnx/connection.php";
?>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card text-left">
                <div class="card-header">
                    Casos GES
                </div>
                <div class="card-body">
                    <span class="btn btn-primary" data-toggle="modal" data-target="#agregar_casos_ges">Agregar Nuevo
                        <span class="fas fa-plus-circle"></span>
                    </span>
                    <span class="btn btn-primary" data-toggle="modal" data-target="#masivo_casos_ges">Carga Masiva
                        <span class="fas fa-upload"></span>
                    </span>
                    <div class="float-right">
                        <label class="mb-0">Tipo GES:</label>
                        <select id="tipo_ges_filtro" name="tipo_ges_filtro" class="form-control input-sm">
                            <option value="0" disabled>Seleccione:</option>
                            <?php
                            $sql_tipo_ges_filtro = $connection->query("SELECT distinct(t.codigo_tipo_ges), t.nombre_tipo_ges FROM tipo_ges t INNER JOIN egresos_ges e on t.codigo_tipo_ges=e.codigo_tipo_ges_eg_ges ORDER BY t.codigo_tipo_ges ASC");
                            while ($res_tipo_ges_filtro = mysqli_fetch_array($sql_tipo_ges_filtro)) {
                                echo '<option value="' . $res_tipo_ges_filtro[0] . '">' . $res_tipo_ges_filtro[1] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="float-right mr-2">
                        <label class="mb-0">Año:</label>
                        <select id="anio_ges_filtro" name="anio_ges_filtro" class="form-control input-sm">
                            <option value="0" disabled>Seleccione:</option>
                            <?php
                            $sql_anio_le_filtro = $connection->query("SELECT distinct(anio_eg_ges) FROM egresos_ges ORDER BY anio_eg_ges ASC");
                            while ($res_anio_le_filtro = mysqli_fetch_array($sql_anio_le_filtro)) {
                                echo '<option value="' . $res_anio_le_filtro[0] . '">' . $res_anio_le_filtro[0] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <br>
                    <br>
                    <hr>
                    <div id="carga_casos_ges"></div>
                </div>
                <div class="card-footer text-muted">
                    Sub-Departamento de Estadísticas y Gestión de la Información
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar -->
<div class="modal fade" id="agregar_casos_ges" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Caso GES</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frm-nuevo-casos-ges">
                    <label for="">Establecimiento</label>
                    <select id="estable_casos_ges" name="estable_casos_ges" class="form-control input-sm">
                        <option value="0" disabled>Seleccione:</option>
                        <?php
                        $sql_estable_cg = $connection->query("SELECT * FROM establecimiento");
                        while ($res_estable_cg = mysqli_fetch_array($sql_estable_cg)) {
                            echo '<option value="' . $res_estable_cg[1] . '">' . $res_estable_cg[2] . '</option>';
                        }
                        ?>
                    </select>
                    <label for="">Tipo GES</label>
                    <select id="tipo_casos_ges" name="tipo_casos_ges" class="form-control input-sm">
                        <option value="0" disabled>Seleccione:</option>
                        <?php
                        $sql_tipo_cg = $connection->query("SELECT * FROM tipo_ges");
                        while ($res_tipo_cg = mysqli_fetch_array($sql_tipo_cg)) {
                            echo '<option value="' . $res_tipo_cg[1] . '">' . $res_tipo_cg[2] . '</option>';
                        }
                        ?>
                    </select>
                    <label for="">Mes</label>
                    <select id="mes_casos_ges" name="mes_casos_ges" class="form-control input-sm">
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
                    <input type="number" id="anio_casos_ges" name="anio_casos_ges" min="2000" value="2000" class="form-control input-sm">
                    <label for="">Cantidad</label>
                    <input type="number" id="cantidad_casos_ges" min="0" name="cantidad_casos_ges" class="form-control input-sm">
                    <input type="text" hidden="" name="seccion" value="casos-ges">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="agregar-nuevo-casos-ges" class="btn btn-primary">Agregar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->


<!-- Modal Editar -->
<div class="modal fade" id="editar_casos_ges" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Caso GES</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frm-editar-casos-ges">
                    <input type="text" hidden="" id="id_casos_ges" name="id_casos_ges">
                    <label for="">Establecimiento</label>
                    <select id="estable_casos_ges_up" name="estable_casos_ges_up" class="form-control input-sm">
                        <option value="0" disabled>Seleccione:</option>
                        <?php
                        $sql_estable_cg = $connection->query("SELECT * FROM establecimiento");
                        while ($res_estable_cg = mysqli_fetch_array($sql_estable_cg)) {
                            echo '<option value="' . $res_estable_cg[1] . '">' . $res_estable_cg[2] . '</option>';
                        }
                        ?>
                    </select>
                    <label for="">Tipo GES</label>
                    <select id="tipo_casos_ges_up" name="tipo_casos_ges_up" class="form-control input-sm">
                        <option value="0" disabled>Seleccione:</option>
                        <?php
                        $sql_tipo_cg = $connection->query("SELECT * FROM tipo_ges");
                        while ($res_tipo_cg = mysqli_fetch_array($sql_tipo_cg)) {
                            echo '<option value="' . $res_tipo_cg[1] . '">' . $res_tipo_cg[2] . '</option>';
                        }
                        ?>
                    </select>
                    <label for="">Mes</label>
                    <select id="mes_casos_ges_up" name="mes_casos_ges_up" class="form-control input-sm">
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
                    <input type="number" id="anio_casos_ges_up" name="anio_casos_ges_up" min="2000" value="2000" class="form-control input-sm">
                    <label for="">Cantidad</label>
                    <input type="number" id="cantidad_casos_ges_up" min="0" name="cantidad_casos_ges_up" class="form-control input-sm">
                    <input type="text" hidden="" name="seccion" value="casos-ges">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="actualizar-casos-ges" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->

<!-- Modal Carga Masiva -->
<div class="modal fade" id="masivo_casos_ges" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Masivo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="form-masivo-casos-ges">
                    <form action="" id="frm-carga-casos-ges" enctype="multipart/form-data">
                        <label for="">Seleccionar Archivo: </label>
                        <input type="file" id="arch_casos_ges" name="arch-casos-ges" accept="">
                        <input type="text" hidden="" name="seccion" value="casos-ges">
                    </form>
                </div>
                <div id="spinner-casos-ges">
                    <div class="spinner-grow text-info"></div> Insertando datos...
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="cargar-masivo-casos-ges" class="btn btn-primary">Cargar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->

<script type="text/javascript">
    $(document).ready(function() {
        carga_casos_ges();
    });
</script>