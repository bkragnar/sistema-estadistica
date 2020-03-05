<?php
    include "../cnx/connection.php";
?>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card text-left">
                <div class="card-header">
                    Establecimientos
                </div>
                <div class="card-body">
                    <span class="btn btn-primary" data-toggle="modal" data-target="#agregar_estable">Agregar Nuevo
                        <span class="fas fa-plus-circle"></span>
                    </span>
                    <span class="btn btn-primary" data-toggle="modal" data-target="#masivo_estable">Carga Masiva
                        <span class="fas fa-upload"></span>
                    </span>
                    <hr>
                    <div id="carga_estable"></div>
                </div>
                <div class="card-footer text-muted">
                    Sub-Departamento de Estadísticas y Gestión de la Información
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar -->
<div class="modal fade" id="agregar_estable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Establecimiento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frm-nuevo-estable">
                    <label for="">Código</label>
                    <input type="text" id="codigo_estable" name="codigo_estable" class="form-control input-sm">
                    <label for="">Nombre</label>
                    <input type="text" id="nombre_estable" name="nombre_estable" class="form-control input-sm">
                    <label for="">Comuna</label>
                    <select id="cod_comuna_estable" name="cod_comuna_estable" class="form-control input-sm">
                        <option value="0" disabled>Seleccione:</option>
                        <?php
                        $sql_comuna = $connection->query("SELECT * FROM comuna");
                        while ($res_comuna = mysqli_fetch_array($sql_comuna)) {
                            echo '<option value="' . $res_comuna[1] . '">' . $res_comuna[2] . '</option>';
                        }
                        ?>
                    </select>
                    <label for="">Provincia</label>
                    <select id="cod_provincia_estable" name="cod_provincia_estable" class="form-control input-sm">
                        <option value="0" disabled>Seleccione:</option>
                        <?php
                        $sql_provincia = $connection->query("SELECT * FROM provincia");
                        while ($res_provincia = mysqli_fetch_array($sql_provincia)) {
                            echo '<option value="' . $res_provincia[1] . '">' . $res_provincia[2] . '</option>';
                        }
                        ?>
                    </select>
                    <label for="">Tipo</label>
                    <select id="tipo_estable" name="tipo_estable" class="form-control input-sm">
                        <option value="0" disabled>Seleccione:</option>
                        <?php
                        $sql_tipo = $connection->query("SELECT * FROM tipo_estable");
                        while ($res_tipo = mysqli_fetch_array($sql_tipo)) {
                            echo '<option value="' . $res_tipo[1] . '">' . $res_tipo[2] . '</option>';
                        }
                        ?>
                    </select>
                    <input type="text" hidden="" name="seccion" value="establecimiento">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="agregar-nuevo-estable" class="btn btn-primary">Agregar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->

<!-- Modal Editar -->
<div class="modal fade" id="editar_estable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Establecimiento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frm-editar-estable">
                    <input type="text" hidden="" id="id_estable" name="id_estable">
                    <label for="">Código</label>
                    <input type="text" id="codigo_estable_up" name="codigo_estable_up" class="form-control input-sm">
                    <label for="">Nombre</label>
                    <input type="text" id="nombre_estable_up" name="nombre_estable_up" class="form-control input-sm">
                    <label for="">Comuna</label>
                    <select id="cod_comuna_estable_up" name="cod_comuna_estable_up" class="form-control input-sm">
                        <option value="0" disabled>Seleccione:</option>
                        <?php
                        $sql_comuna = $connection->query("SELECT * FROM comuna");
                        while ($res_comuna = mysqli_fetch_array($sql_comuna)) {
                            echo '<option value="' . $res_comuna[1] . '">' . $res_comuna[2] . '</option>';
                        }
                        ?>
                    </select>
                    <label for="">Provincia</label>
                    <select id="cod_provincia_estable_up" name="cod_provincia_estable_up" class="form-control input-sm">
                        <option value="0" disabled>Seleccione:</option>
                        <?php
                        $sql_provincia = $connection->query("SELECT * FROM provincia");
                        while ($res_provincia = mysqli_fetch_array($sql_provincia)) {
                            echo '<option value="' . $res_provincia[1] . '">' . $res_provincia[2] . '</option>';
                        }
                        ?>
                    </select>
                    <label for="">Tipo</label>
                    <select id="tipo_estable_up" name="tipo_estable_up" class="form-control input-sm">
                        <option value="0" disabled>Seleccione:</option>
                        <?php
                        $sql_tipo = $connection->query("SELECT * FROM tipo_estable");
                        while ($res_tipo = mysqli_fetch_array($sql_tipo)) {
                            echo '<option value="' . $res_tipo[1] . '">' . $res_tipo[2] . '</option>';
                        }
                        ?>
                    </select>
                    <input type="text" hidden="" name="seccion" value="establecimiento">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="editar-estable" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->

<!-- Modal Carga Masiva -->
<div class="modal fade" id="masivo_estable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Masivo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frm-carga-estable" enctype="multipart/form-data">
                    <label for=""></label>
                    <input type="file" name="arch-estable">
                    <input type="text" hidden="" name="seccion" value="establecimiento">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="cargar-masivo-estable" class="btn btn-primary">Cargar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->

<script type="text/javascript">
    $(document).ready(function() {
        $("#carga_estable").load("web/mant_estable.php");

        $('#agregar-nuevo-estable').click(function() {
            datos_estable = $('#frm-nuevo-estable').serialize();
            AgregarDatosEstable(datos_estable);
        });

        $('#editar-estable').click(function() {
            datos_estable = $('#frm-editar-estable').serialize();
            EditarEstable(datos_estable);
        });

        $('#cargar-masivo-estable').click(function() {
            MasivoDatosEstable();
        });
    });
</script>