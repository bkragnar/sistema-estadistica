<?php
include "../cnx/connection.php";
?>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card text-left">
                <div class="card-header">
                    Tipos GES
                </div>
                <div class="card-body">
                    <span class="btn btn-primary" data-toggle="modal" data-target="#agregar_tipoges">Agregar Nuevo
                        <span class="fas fa-plus-circle"></span>
                    </span>
                    <!--
                    <span class="btn btn-primary" data-toggle="modal" data-target="#masivo_tipoges">Carga Masiva
                        <span class="fas fa-upload"></span>
                    </span> -->
                    <hr>
                    <div id="carga_tipoges"></div>
                </div>
                <div class="card-footer text-muted">
                    Sub-Departamento de Estadísticas y Gestión de la Información
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar -->
<div class="modal fade" id="agregar_tipoges" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Comuna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frm-nuevo-tipoges">
                    <label for="">Código</label>
                    <input type="text" id="codigo_tipoges" name="codigo_tipoges" class="form-control input-sm">
                    <label for="">Nombre</label>
                    <input type="text" id="nombre_tipoges" name="nombre_tipoges" class="form-control input-sm">
                    <input type="text" hidden="" name="seccion" value="tipoges">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="agregar-nuevo-tipoges" class="btn btn-primary">Agregar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->


<!-- Modal Editar -->
<div class="modal fade" id="editar_tipoges" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Comuna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frm-editar-tipoges">
                    <input type="text" hidden="" id="id_tipoges" name="id_tipoges">
                    <label for="">Código</label>
                    <input type="text" id="codigo_tipoges_up" name="codigo_tipoges_up" class="form-control input-sm">
                    <label for="">Nombre</label>
                    <input type="text" id="nombre_tipoges_up" name="nombre_tipoges_up" class="form-control input-sm">
                    <input type="text" hidden="" name="seccion" value="tipoges">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="actualizar-tipoges" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->

<!-- Modal Carga Masiva -->
<!--
<div class="modal fade" id="masivo_tipoges" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Masivo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="form-masivo-tipoges">
                    <form action="" id="frm-carga-tipoges" enctype="multipart/form-data">
                        <label for="">Seleccionar Archivo: </label>
                        <input type="file" id="arch_tipoges" name="arch-tipoges" accept="">
                        <input type="text" hidden="" name="seccion" value="comuna">
                    </form>
                </div>
                <div id="spinner-tipoges">
                    <div class="spinner-grow text-info"></div> Insertando datos...
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="cargar-masivo-tipoges" class="btn btn-primary">Cargar</button>
            </div>
        </div>
    </div>
</div>
-->
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->

<script type="text/javascript">
    $(document).ready(function() {
        carga_tipoges();
    });
</script>