<?php
include "../cnx/connection.php";
?>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card text-left">
                <div class="card-header">
                    Visor de imagenes - Slider
                </div>
                <div class="card-body">
                    <span class="btn btn-primary" data-toggle="modal" data-target="#agregar_slider">Agregar Nuevo
                        <span class="fas fa-plus-circle"></span>
                    </span>
                    <hr>
                    <div id="carga_slider"></div>
                </div>
                <div class="card-footer text-muted">
                    Sub-Departamento de Estadísticas y Gestión de la Información
                </div>
            </div>
        </div>
    </div>
</div>

<!-------------------------------------------------------------------------------------------------------------------------------->
<!-- Modal Agregar -->
<div class="modal fade" id="agregar_slider" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nueva Imagen informativa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="form-masivo-slider">
                    <form action="" id="frm-nuevo-slider" enctype="multipart/form-data">
                        <label class="row ml-1" for="">Seleccionar imagen: </label>
                        <input class="row ml-2" type="file" id="arch_slider" name="arch_slider" accept=".png, .jpeg, .JPEG, .jpg, .JPG, .gif">
                        <label for="">Título</label>
                        <input type="text" name="titulo_slider" id="titulo_slider" class="form-control input-sm">
                        <label for="">Descripción</label>
                        <textarea name="descripcion_slider" id="descripcion_slider" cols="30" rows="10" class="form-control input-sm"></textarea>
                        <input type="text" hidden="" name="seccion" value="slider">
                    </form>
                </div>
                <div id="spinner-slider">
                    <div class="spinner-grow text-info"></div> Insertando datos...
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="agregar-nuevo-slider" class="btn btn-primary">Agregar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->


<!-- Modal Editar -->
<div class="modal fade" id="editar_slider" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Red Siges</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frm-editar-slider" enctype="multipart/form-data">
                    <input type="text" hidden="" id="id_slider" name="id_slider">
                    <label for="">Título</label>
                    <input type="text" name="titulo_slider_up" id="titulo_slider_up" class="form-control input-sm">
                    <label for="">Descripción</label>
                    <textarea name="descripcion_slider_up" id="descripcion_slider_up" cols="30" rows="10" class="form-control input-sm"></textarea>
                    <input type="text" hidden="" name="seccion" value="slider">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="actualizar-slider" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->

<script type="text/javascript">
    $(document).ready(function() {
        carga_slider();
    });
</script>