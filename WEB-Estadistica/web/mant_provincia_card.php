<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card text-left">
                <div class="card-header">
                    Provincia
                </div>
                <div class="card-body">
                    <span class="btn btn-primary" data-toggle="modal" data-target="#agregar_provincia">Agregar Nueva
                        <span class="fas fa-plus-circle"></span>
                    </span>
                    <span class="btn btn-primary" data-toggle="modal" data-target="#masivo_provincia">Carga Masiva
                        <span class="fas fa-upload" ></span>
                    </span>
                    <hr>
                    <div id="carga_provincia"></div>
                </div>
                <div class="card-footer text-muted">
                    Sub-Departamento de Estadísticas y Gestión de la Información
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar -->
<div class="modal fade" id="agregar_provincia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Provincia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frm-nueva-provincia">
                    <label for="">Código</label>
                    <input type="text" id="codigo_provincia" name="codigo_provincia" class="form-control input-sm">
                    <label for="">Nombre</label>
                    <input type="text" id="nombre_provincia" name="nombre_provincia" class="form-control input-sm">
                    <input type="text" hidden="" name="seccion" value="provincia">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="agregar-nueva-provincia" class="btn btn-primary">Agregar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->


<!-- Modal Editar -->
<div class="modal fade" id="editar_provincia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Provincia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frm-editar-provincia">
                    <input type="text" hidden="" id="id_provincia" name="id_provincia">
                    <label for="">Código</label>
                    <input type="text" id="codigo_provincia_up" name="codigo_provincia_up" class="form-control input-sm">
                    <label for="">Nombre</label>
                    <input type="text" id="nombre_provincia_up" name="nombre_provincia_up" class="form-control input-sm">
                    <input type="text" hidden="" name="seccion" value="provincia">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="actualizar-provincia" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->

<script type="text/javascript">
    $(document).ready(function() {
        $("#carga_provincia").load("web/mant_provincia.php");

        $("#agregar-nueva-provincia").click(function(){
            datos_provincia=$("#frm-nueva-provincia").serialize();
            AgregarDatosProvincia(datos_provincia);
        });

        $("#actualizar-provincia").click(function(){
            datos_provincia_up=$("#frm-editar-provincia").serialize();
            EditarProvincia(datos_provincia_up);
        });
    });
</script>