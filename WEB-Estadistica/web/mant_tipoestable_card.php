

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card text-left">
                <div class="card-header">
                    Tipo de Establecimiento
                </div>
                <div class="card-body">
                    <span class="btn btn-primary" data-toggle="modal" data-target="#agregar_tipoestable">Agregar Nuevo
                        <span class="fas fa-plus-circle"></span>
                    </span>
                    <span class="btn btn-primary" data-toggle="modal" data-target="#masivo_tipoestable">Carga Masiva
                        <span class="fas fa-upload" ></span>
                    </span>
                    <hr>
                    <div id="carga_tipoestable"></div>
                </div>
                <div class="card-footer text-muted">
                    Sub-Departamento de Estadísticas y Gestión de la Información
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar -->
<div class="modal fade" id="agregar_tipoestable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Tipo de Establecimiento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frm-nuevo-tipo-estable">
                    <label for="">Código</label>
                    <input type="text" id="codigo_tipo_estable" name="codigo_tipo_estable" class="form-control input-sm">
                    <label for="">Nombre</label>
                    <input type="text" id="nombre_tipo_estable" name="nombre_tipo_estable" class="form-control input-sm">
                    <input type="text" hidden="" name="seccion" value="tipo_estable">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="agregar-nuevo-tipo_estable" class="btn btn-primary">Agregar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->


<!-- Modal Editar -->
<div class="modal fade" id="editar_tipoestable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Tipo Establecimiento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frm-editar-tipo-estable">
                    <input type="text" hidden="" id="id_tipo_estable" name="id_tipo_estable">
                    <label for="">Código</label>
                    <input type="text" id="codigo_tipo_estable_up" name="codigo_tipo_estable_up" class="form-control input-sm">
                    <label for="">Nombre</label>
                    <input type="text" id="nombre_tipo_estable_up" name="nombre_tipo_estable_up" class="form-control input-sm">
                    <input type="text" hidden="" name="seccion" value="tipo_estable">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="actualizar-tipo-estable" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->

<script type="text/javascript">
    $(document).ready(function() {
        $("#carga_tipoestable").load("web/mant_tipoestable.php");

        $("#agregar-nuevo-tipo_estable").click(function(){
            datos_tipoestable=$("#frm-nuevo-tipo-estable").serialize();
            AgregarDatosTipoEstable(datos_tipoestable);
        });

        $("#actualizar-tipo-estable").click(function(){
            datos_tipoestable_up=$("#frm-editar-tipo-estable").serialize();
            EditarTipoEstable(datos_tipoestable_up);
        });
    });
</script>