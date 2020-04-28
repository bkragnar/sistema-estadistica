<?php
include "../cnx/connection.php";
?>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card text-left">
                <div class="card-header">
                    Red SIGES
                </div>
                <div class="card-body">
                    <span class="btn btn-primary" data-toggle="modal" data-target="#agregar_red_siges">Agregar Nuevo
                        <span class="fas fa-plus-circle"></span>
                    </span>
                    <span class="btn btn-primary" data-toggle="modal" data-target="#masivo_red_siges">Carga Masiva
                        <span class="fas fa-upload"></span>
                    </span>
                    <hr>
                    <div id="carga_red_siges"></div>
                </div>
                <div class="card-footer text-muted">
                    Sub-Departamento de Estadísticas y Gestión de la Información
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar -->
<div class="modal fade" id="agregar_red_siges" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Red Siges</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frm-nuevo-red-siges">
                    <label for="">Establecimiento</label>
                    <select id="estable_red_siges" name="estable_red_siges" class="form-control input-sm">
                        <option value="0" disabled>Seleccione:</option>
                        <?php
                        $sql_estable_cg = $connection->query("SELECT * FROM establecimiento");
                        while ($res_estable_cg = mysqli_fetch_array($sql_estable_cg)) {
                            echo '<option value="' . $res_estable_cg[1] . '">' . $res_estable_cg[2] . '</option>';
                        }
                        ?>
                    </select>
                    <div id="input-comuna"></div>
                    <label for="">Nombres</label>
                    <input type="text" id="nombre_red_siges" name="nombre_red_siges" class="form-control input-sm">
                    <label for="">Apellidos</label>
                    <input type="text" id="apellido_red_siges" name="apellido_red_siges" class="form-control input-sm">
                    <label for="">Mail</label>
                    <input type="email" id="mail_red_siges" name="mail_red_siges" class="form-control input-sm">
                    <label for="">Ruta Minsal</label>
                    <input type="text" id="rutaminsal_red_siges" name="rutaminsal_red_siges" class="form-control input-sm" placeholder="513387">
                    <label for="">Telefono</label>
                    <input type="text" id="telefono_red_siges" name="telefono_red_siges" class="form-control input-sm" placeholder="512-222222 o 9-12345678">
                    <input type="text" hidden="" name="seccion" value="red-siges">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="agregar-nuevo-red-siges" class="btn btn-primary">Agregar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->


<!-- Modal Editar -->
<div class="modal fade" id="editar_red_siges" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Red Siges</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frm-editar-red-siges">
                    <input type="text" hidden="" id="id_red_siges" name="id_red_siges">
                    <label for="">Establecimiento</label>
                    <select id="estable_red_siges_up" name="estable_red_siges_up" class="form-control input-sm">
                        <option value="0" disabled>Seleccione:</option>
                        <?php
                        $sql_estable_cg = $connection->query("SELECT * FROM establecimiento");
                        while ($res_estable_cg = mysqli_fetch_array($sql_estable_cg)) {
                            echo '<option value="' . $res_estable_cg[1] . '">' . $res_estable_cg[2] . '</option>';
                        }
                        ?>
                    </select>
                    <div id="input-comuna-up"></div>
                    <label for="">Nombres</label>
                    <input type="text" id="nombre_red_siges_up" name="nombre_red_siges_up" class="form-control input-sm">
                    <label for="">Apellidos</label>
                    <input type="text" id="apellido_red_siges_up" name="apellido_red_siges_up" class="form-control input-sm">
                    <label for="">Mail</label>
                    <input type="email" id="mail_red_siges_up" name="mail_red_siges_up" class="form-control input-sm">
                    <label for="">Ruta Minsal</label>
                    <input type="text" id="rutaminsal_red_siges_up" name="rutaminsal_red_siges_up" class="form-control input-sm" placeholder="513387">
                    <label for="">Telefono</label>
                    <input type="text" id="telefono_red_siges_up" name="telefono_red_siges_up" class="form-control input-sm" placeholder="512-222222 o 9-12345678">
                    <input type="text" hidden="" name="seccion" value="red-siges">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="actualizar-red-siges" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->

<!-- Modal Carga Masiva -->
<div class="modal fade" id="masivo_red_siges" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Masivo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="form-masivo-red-siges">
                    <form action="" id="frm-carga-red-siges" enctype="multipart/form-data">
                        <label for="">Seleccionar Archivo: </label>
                        <input type="file" id="arch_red_siges" name="arch-red-siges" accept="">
                        <input type="text" hidden="" name="seccion" value="red-siges">
                    </form>
                </div>
                <div id="spinner-red-siges">
                    <div class="spinner-grow text-info"></div> Insertando datos...
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="cargar-masivo-red-siges" class="btn btn-primary">Cargar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->

<script type="text/javascript">
    $(document).ready(function() {
        carga_red_siges();
    });
</script>