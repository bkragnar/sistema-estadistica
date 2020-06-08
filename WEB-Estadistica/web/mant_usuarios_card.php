<?php
include "../cnx/connection.php";
?>
<link rel="stylesheet" href="static/css/bootstrap4-toggle.min.css">
<script src="static/js/bootstrap4-toggle.min.js"></script>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card text-left">
                <div class="card-header">
                    Usuarios
                </div>
                <div class="card-body">
                    <span class="btn btn-primary" data-toggle="modal" data-target="#agregar_usuario">Agregar Nuevo
                        <span class="fas fa-plus-circle"></span>
                    </span>
                    <hr>
                    <div id="carga_usuario"></div>
                </div>
                <div class="card-footer text-muted">
                    Sub-Departamento de Estadísticas y Gestión de la Información
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar -->
<div class="modal fade" id="agregar_usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frm-nuevo-usuario">
                    <label for="">Nombre</label>
                    <input type="text" id="nombre_usuario" name="nombre_usuario" class="form-control input-sm">
                    <label for="">Apellido</label>
                    <input type="text" id="apellido_usuario" name="apellido_usuario" class="form-control input-sm">
                    <label for="">Correo</label>
                    <input type="email" id="email_usuario" name="email_usuario" style="text-transform:lowercase;" onkeyup="javascript:this.value=this.value.toLowerCase();" class="form-control input-sm">
                    <label for="">Usuario</label>
                    <input type="text" id="usu_usuario" name="usu_usuario" class="form-control input-sm" readonly>
                    <label for="">Contraseña</label>
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="col-6">
                            <input type="text" id="pass_usuario" name="pass_usuario" class="form-control input-sm" readonly>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-success" onclick="generar('nuevo')"><i class="fas fa-cogs"></i> Generar</button>
                        </div>
                    </div>
                    <label for="">Establecimiento</label>
                    <select id="estable_usuario" name="estable_usuario" class="form-control input-sm">
                        <option value="0" disabled>Seleccione:</option>
                        <?php
                        $sql_tipo = $connection->query("SELECT * FROM establecimiento");
                        while ($res_tipo = mysqli_fetch_array($sql_tipo)) {
                            echo '<option value="' . $res_tipo[1] . '">' . $res_tipo[2] . '</option>';
                        }
                        ?>
                    </select>
                    <label for="">Privilegio</label>
                    <select id="privilegio_usuario" name="privilegio_usuario" class="form-control input-sm">
                        <option value=0 disabled>Seleccione:</option>
                        <option value=1>Usuario</option>
                        <option value=2>Mantenedor</option>
                        <option value=3>Administrador</option>
                    </select>
                    <label for="">Estado</label>
                    <input type="checkbox" id="estado_usuario" name="estado_usuario" checked data-toggle="toggle" data-on="Habilitado" data-off="deshabilitado" data-onstyle="success" data-offstyle="danger" data-width="100%">
                    <input type="text" hidden="" name="seccion" value="usuario">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="agregar-nuevo-usuario" class="btn btn-primary">Agregar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->

<!-- Modal Editar -->
<div class="modal fade" id="editar_usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frm-editar-usuario">
                <label for="">Nombre</label>
                    <input type="text" hidden="" id="id_usuario" name="id_usuario">
                    <input type="text" id="nombre_usuario_up" name="nombre_usuario_up" class="form-control input-sm">
                    <label for="">Apellido</label>
                    <input type="text" id="apellido_usuario_up" name="apellido_usuario_up" class="form-control input-sm">
                    <label for="">Correo</label>
                    <input type="email" id="email_usuario_up" name="email_usuario_up" style="text-transform:lowercase;" onkeyup="javascript:this.value=this.value.toLowerCase();" class="form-control input-sm">
                    <label for="">Usuario</label>
                    <input type="text" id="usu_usuario_up" name="usu_usuario_up" class="form-control input-sm" readonly>
                    <label for="">Contraseña</label>
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="col-6">
                            <input type="text" id="pass_usuario_up" name="pass_usuario_up" class="form-control input-sm" readonly>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-success" onclick="generar('edicion')"><i class="fas fa-cogs"></i> Generar</button>
                        </div>
                    </div>
                    <label for="">Establecimiento</label>
                    <select id="estable_usuario_up" name="estable_usuario_up" class="form-control input-sm">
                        <option value="0" disabled>Seleccione:</option>
                        <?php
                        $sql_tipo = $connection->query("SELECT * FROM establecimiento");
                        while ($res_tipo = mysqli_fetch_array($sql_tipo)) {
                            echo '<option value="' . $res_tipo[1] . '">' . $res_tipo[2] . '</option>';
                        }
                        ?>
                    </select>
                    <label for="">Privilegio</label>
                    <select id="privilegio_usuario_up" name="privilegio_usuario_up" class="form-control input-sm">
                        <option value="0" disabled>Seleccione:</option>
                        <option value="1">Usuario</option>
                        <option value="2">Mantenedor</option>
                        <option value="3">Administrador</option>
                    </select>
                    <label for="">Estado</label>
                    <input type="checkbox" id="estado_usuario_up" name="estado_usuario_up" checked data-toggle="toggle" data-on="Habilitado" data-off="deshabilitado" data-onstyle="success" data-offstyle="danger" data-width="100%">
                    <input type="text" hidden="" name="seccion" value="usuario">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="editar-usuario" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->

<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->

<script type="text/javascript">
    $(document).ready(function() {
        cargar_usuario();
    });
</script>