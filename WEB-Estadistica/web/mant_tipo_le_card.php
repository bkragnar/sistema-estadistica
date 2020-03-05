<?php
    include "../cnx/connection.php";
?>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card text-left">
                <div class="card-header">
                    Tipo Lista de Espera
                </div>
                <div class="card-body">
                    <span class="btn btn-primary" data-toggle="modal" data-target="#agregar_tipo_le">Agregar Nuevo
                        <span class="fas fa-plus-circle"></span>
                    </span>
                    <span class="btn btn-primary" data-toggle="modal" data-target="#masivo_tipo_le">Carga Masiva
                        <span class="fas fa-upload" ></span>
                    </span>
                    <hr>
                    <div id="carga_tipo_le"></div>
                </div>
                <div class="card-footer text-muted">
                    Sub-Departamento de Estadísticas y Gestión de la Información
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar -->
<div class="modal fade" id="agregar_tipo_le" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Comuna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frm-nuevo-tipo-le">
                    <label for="">Código</label>
                    <input type="text" id="codigo_tipo_le" name="codigo_tipo_le" class="form-control input-sm">
                    <label for="">Nombre</label>
                    <input type="text" id="nombre_tipo_le" name="nombre_tipo_le" class="form-control input-sm">
                    <input type="text" hidden="" name="seccion" value="tipo-le">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="agregar-nuevo-tipo-le" class="btn btn-primary">Agregar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->


<!-- Modal Editar -->
<div class="modal fade" id="editar_tipo_le" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Tipo Lista de Espera</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frm-editar-tipo-le">
                    <input type="text" hidden="" id="id_tipo_le" name="id_tipo_le">
                    <label for="">Código</label>
                    <input type="text" id="codigo_tipo_le_up" name="codigo_tipo_le_up" class="form-control input-sm">
                    <label for="">Nombre</label>
                    <input type="text" id="nombre_tipo_le_up" name="nombre_tipo_le_up" class="form-control input-sm">
                    <input type="text" hidden="" name="seccion" value="tipo-le">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="actualizar-tipo-le" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->

<!-- Modal Carga Masiva -->
<div class="modal fade" id="masivo_tipo_le" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Masivo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frm-carga-tipo-le" enctype="multipart/form-data">
                    <label for="">Seleccionar Archivo: </label>
                    <input type="file" name="arch-tipo-le">
                    <input type="text" hidden="" name="seccion" value="tipo-le">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="cargar-masivo-tipo-le" class="btn btn-primary">Cargar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->

<script type="text/javascript">
    $(document).ready(function() {
        $("#carga_tipo_le").load("web/mant_tipo_le.php");

        $("#agregar-nuevo-tipo-le").click(function(){
            datos_tipole=$("#frm-nuevo-tipo-le").serialize();
            AgregarDatosTipoLe(datos_tipole);
        });

        $("#actualizar-tipo-le").click(function(){
            datos_tipole_up=$("#frm-editar-tipo-le").serialize();
            EditarTipoLe(datos_tipole_up);
        });

        $('#cargar-masivo-tipo-le').click(function() {
            MasivoDatosTipoLe();
        });

    });
</script>