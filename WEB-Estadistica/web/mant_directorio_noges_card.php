<?php
function OrdenaDir()
{
    $ruta  = "../static/directorio_noges/";
    if (is_dir($ruta)) {
        $gestor = opendir($ruta);
        while (($archivo = readdir($gestor)) !== false) {
            $ruta_completa = $ruta . "/" . $archivo;
            if ($archivo != "." && $archivo != ".." && $archivo != ".DS_Store") {
                if (is_dir($ruta_completa)) {
                    $list_dir[] = $archivo;
                }
            }
        }
        closedir($gestor);
    }
    arsort($list_dir);
    return ($list_dir);
}

?>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card text-left">
                <div class="card-header">
                    Crear Directorio
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="row ml-3">
                                <span class="btn btn-primary" data-toggle="modal" data-target="#agregar_directorio_noges">Crear
                                    <span class="fas fa-folder-plus ml-1 text-white fa-lg"></span>
                                </span>
                                <span class="btn btn-primary ml-1" data-toggle="modal" data-target="#editar_directorio_noges">Editar
                                    <span class="far fa-folder ml-1 text-white fa-lg"></span>
                                </span>
                                <span class="btn btn-primary ml-1" data-toggle="modal" data-target="#eliminar_directorio_noges">Eliminar
                                    <span class="fas fa-folder-minus ml-1 text-white fa-lg"></span>
                                </span>
                            </div>
                            <div class="row ml-3 mt-4">
                                <span class="btn btn-light" data-toggle="modal" data-target="#modal_agregar_archivo_noges">Subir Archivo
                                    <span class="fas fa-file-upload ml-1 text-info fa-lg"></span>
                                </span>
                                <span class="btn btn-light ml-1" data-toggle="modal" data-target="#modal_eliminar_archivo_noges">Eliminar Archivo
                                    <span class="fas fa-trash-alt ml-1 text-danger fa-lg"></span>
                                </span>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="text-center">
                                <label>Seleccionar directorio: </label>
                                <select name="directorio_no_ges" id="directorio_no_ges" class="form-control input-sm">
                                    <?php
                                    $directorio = OrdenaDir();
                                    foreach ($directorio as $llave => $dato) {
                                        echo  "<option value=\"$dato\">$dato</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div id="carga_directorio_noges"></div>
                </div>
                <div class="card-footer text-muted">
                    Sub-Departamento de Estadísticas y Gestión de la Información
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar -->
<div class="modal fade" id="agregar_directorio_noges" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear Directorio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frm-nuevo-directorio_noges">
                    <label for="">Nombre Carpeta</label>
                    <input type="text" id="nombre_directorio_noges" name="nombre_directorio_noges" class="form-control input-sm">
                    <label for="">Seleccionar Ruta:</label>
                    <div id="select-directorio-noges"></div>
                    <hr>
                    <label>Ruta:</label><label id="referencia_ruta" name="referencia_ruta"></label>
                    <span id="volver_ruta_noges" class="float-right text-info" data-toggle="tooltip" data-placement="top" title="Volver un Nivel"><i class="fas fa-undo-alt fa-lg"></i></span>
                    <input type="text" hidden="" name="seccion" value="directorio_noges">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="agregar-nuevo-directorio-noges" class="btn btn-primary">Agregar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->

<!-- Modal Editar -->
<div class="modal fade" id="editar_directorio_noges" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Directorio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frm-editar-directorio_noges">
                    <label for="">Nuevo Nombre</label>
                    <input type="text" id="editar_nombre_directorio_noges" name="editar_nombre_directorio_noges" class="form-control input-sm">
                    <label for="">Seleccionar Directorio:</label>
                    <div id="select-editar-directorio-noges"></div>
                    <hr>
                    <label>Ruta:</label><label id="editar_referencia_ruta" name="editar_referencia_ruta"></label>
                    <span id="editar_volver_ruta_noges" class="float-right text-info" data-toggle="tooltip" data-placement="top" title="Volver un Nivel"><i class="fas fa-undo-alt fa-lg"></i></span>
                    <input type="text" hidden="" name="seccion" value="directorio_noges">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="editar-nuevo-directorio-noges" class="btn btn-primary">Editar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->

<!-- Modal Eliminar -->
<div class="modal fade" id="eliminar_directorio_noges" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar Directorio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frm-eliminar-directorio_noges">
                    <label for="">Seleccionar Carpeta:</label>
                    <div id="select-eliminar-directorio-noges"></div>
                    <hr>
                    <label>Ruta:</label><label id="eliminar_referencia_ruta" name="eliminar_referencia_ruta"></label>
                    <span id="eliminar_volver_ruta_noges" class="float-right text-info" data-toggle="tooltip" data-placement="top" title="Volver un Nivel"><i class="fas fa-undo-alt fa-lg"></i></span>
                    <input type="text" hidden="" name="seccion" value="directorio_noges">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="eliminar-directorio-noges" class="btn btn-primary">Eliminar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->

<!-- Modal Agregar-archivo -->
<div class="modal fade" id="modal_agregar_archivo_noges" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cargar Archivo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="static/transaccion/agregar.php" method="POST" enctype="multipart/form-data" id="frm-nuevo-archivo-noges">
                    <label>Seleccionar Directorio</label>
                    <div id="select-archivo-directorio-noges"></div>
                    <label for="">Seleccionar archivo de carga</label>
                    <input type="file" id="archivo_directorio_noges" name="archivo_directorio_noges" class="form-control input-sm">
                    <input type="text" hidden="" id="ref_ruta_arch" name="ref_ruta_arch">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <input type="submit" id="agregar-archivo-noges" class="btn btn-primary text-right"></input>
                    </div>
                    <hr>
                    <label>Ruta:</label><label id="referencia_ruta_archivo" name="referencia_ruta_archivo"></label>
                    <span id="volver_ruta_noges_archivo" class="float-right text-info" data-toggle="tooltip" data-placement="top" title="Volver un Nivel"><i class="fas fa-undo-alt fa-lg"></i></span>
                    <input type="text" hidden="" name="seccion" value="archivo-directorio_noges">
                </form>
                <div id="info-carga-archivo-noges">
                    <div class="progress">
                        <div id="barra-progreso-carga" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class='percent' id='percent'></div>
                    </div>
                    <div id="datos-porcentaje"></div>
                </div>
            </div>
            <!--
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" id="agregar-archivo-noges" class="btn btn-primary">Agregar</button>
            </div>
            -->
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->

<!-- Modal eliminar-archivo -->
<div class="modal fade" id="modal_eliminar_archivo_noges" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar Archivo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frm-eliminar-archivo-noges">
                    <label for="">Seleccionar directorio:</label>
                    <div id="select-elimina-ruta-dir"></div>
                    <label for="">Seleccionar archivo:</label>
                    <div id="select-elimina-archivo"></div>
                    <hr>
                    <label>Ruta:</label><label id="elimina_referencia_ruta_archivo" name="elimina_referencia_ruta_archivo"></label>
                    <span id="volver_elimina_referencia_ruta_noges" class="float-right text-info" data-toggle="tooltip" data-placement="top" title="Volver un Nivel"><i class="fas fa-undo-alt fa-lg"></i></span>
                    <input type="text" hidden="" name="seccion" value="archivo-directorio-noges">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="eliminar-archivo-directorio-noges" class="btn btn-primary">Eliminar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->


<script>
    $(document).ready(function() {
        directorio_noges();


        $('#frm-nuevo-archivo-noges').submit(function(event) {
            if ($('#archivo_directorio_noges').val()) {
                event.preventDefault();
                $(this).ajaxSubmit({
                    beforeSubmit: function() {
                        if ($("#archivo_directorio_noges").val() == "") {
                            alertify.error("Debe seleccionar un archivo para cargar");
                            return false;
                        }
                        $('#frm-nuevo-archivo-noges').hide();
                        $('#info-carga-archivo-noges').show();
                        $('#barra-progreso-carga').width('0%');
                    },
                    uploadProgress: function(event, position, total, percentageComplete) {
                        /*$('.progress-bar').animate({
                            width: '' + percentageComplete + '%'
                        });*/
                        $('#barra-progreso-carga').width(percentageComplete+'%');
                        $('#datos-porcentaje').html(percentageComplete + ' %  Completado');
                        $('#barra-progreso-carga').html(percentageComplete + '% cargado');
                        if(percentageComplete==100){
                            $('#datos-porcentaje').html('<div class="mt-2">Espere que el sistema indique la carga correcta de su archivo</div>');
                        }
                    },
                    success: function(r) {
                        setTimeout(function() {
                            $('#frm-nuevo-archivo-noges').show();
                            $('#info-carga-archivo-noges').hide();
                            if (r == 1) {
                                $('#frm-nuevo-archivo-noges')[0].reset();
                                mostrar_directorio();
                                alertify.success("Archivo cargado con exito");
                                document.getElementById('referencia_ruta_archivo').textContent = "";
                                carga_archivo_directorio_noges("");
                                guardaRutaArchivo("");
                                $('#barra-progreso-carga').width('0%');
                            } else if (r == 2) {
                                $('#frm-nuevo-archivo-noges')[0].reset();
                                mostrar_directorio();
                                alertify.warning("El archivo ya existe en este directorio");
                            } else if (r == 3) {
                                alertify.warning("Debe seleccionar un archivo");
                            } else {
                                alertify.error("No fue posible cargar el archivo");
                            }
                        }, 2000);
                    },
                    resetForm: true
                });
            } else {
                alertify.error("Debe seleccionar un archivo para cargar");
                return false;
            }
        });

    });
</script>