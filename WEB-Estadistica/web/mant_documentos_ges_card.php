<?php
include "../cnx/connection.php";
?>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card text-left">
                <div class="card-header">
                    Documentos GES
                </div>
                <div class="card-body">
                    <!--
                    <span class="btn btn-primary" data-toggle="modal" data-target="#agregar_doc_ges">Agregar Nuevo
                        <span class="fas fa-plus-circle"></span>
                    </span>
                    -->
                    <span class="btn btn-primary" data-toggle="modal" data-target="#masivo_doc_ges">Carga Nuevo
                        <span class="fas fa-upload"></span>
                    </span>
                    <hr>
                    <div id="carga_doc_ges"></div>
                </div>
                <div class="card-footer text-muted">
                    Sub-Departamento de Estadísticas y Gestión de la Información
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar -->
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->

<!-- Modal Carga Masiva -->
<div class="modal fade" id="masivo_doc_ges" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="form-masivo-doc-ges">
                    <form action="" id="frm-carga-doc-ges" enctype="multipart/form-data">
                        <label for="">Seleccionar Archivo: </label>
                        <input type="file" id="arch_doc_ges" name="arch_doc_ges" accept="">
                        <input type="text" hidden="" name="seccion" value="doc-ges">
                    </form>
                </div>
                <div id="spinner-doc-ges">
                    <div class="spinner-grow text-info"></div> Subiendo Archivo...
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="cargar-masivo-doc-ges" class="btn btn-primary">Cargar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->

<script type="text/javascript">
    $(document).ready(function() {
        carga_docges();
    });
</script>