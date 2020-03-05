<?php
    include "../cnx/connection.php";
?>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card text-left">
                <div class="card-header">
                    Comunas
                </div>
                <div class="card-body">
                    <span class="btn btn-primary" data-toggle="modal" data-target="#agregar_comuna">Agregar Nueva
                        <span class="fas fa-plus-circle"></span>
                    </span>
                    <span class="btn btn-primary" data-toggle="modal" data-target="#masivo_comuna">Carga Masiva
                        <span class="fas fa-upload" ></span>
                    </span>
                    <hr>
                    <div id="carga_comuna"></div>
                </div>
                <div class="card-footer text-muted">
                    Sub-Departamento de Estadísticas y Gestión de la Información
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar -->
<div class="modal fade" id="agregar_comuna" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Comuna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frm-nueva-comuna">
                    <label for="">Código</label>
                    <input type="text" id="codigo_comuna" name="codigo_comuna" class="form-control input-sm">
                    <label for="">Nombre</label>
                    <input type="text" id="nombre_comuna" name="nombre_comuna" class="form-control input-sm">
                    <label for="">Provincia</label>
                    <select id="codigo_provincia_comuna" name="codigo_provincia_comuna" class="form-control input-sm">
                        <option value="0" disabled>Seleccione:</option>
                        <?php
                        $sql_provincia = $connection->query("SELECT * FROM provincia");
                        while ($res_provincia = mysqli_fetch_array($sql_provincia)) {
                            echo '<option value="' . $res_provincia[1] . '">' . $res_provincia[2] . '</option>';
                        }
                        ?>
                    </select>
                    <input type="text" hidden="" name="seccion" value="comuna">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="agregar-nueva-comuna" class="btn btn-primary">Agregar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->


<!-- Modal Editar -->
<div class="modal fade" id="editar_comuna" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Comuna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frm-editar-comuna">
                    <input type="text" hidden="" id="id_comuna" name="id_comuna">
                    <label for="">Código</label>
                    <input type="text" id="codigo_comuna_up" name="codigo_comuna_up" class="form-control input-sm">
                    <label for="">Nombre</label>
                    <input type="text" id="nombre_comuna_up" name="nombre_comuna_up" class="form-control input-sm">
                    <label for="">Provincia</label>
                    <select id="codigo_provincia_comuna_up" name="codigo_provincia_comuna_up" class="form-control input-sm">
                        <option value="0" disabled>Seleccione:</option>
                        <?php
                        $sql_provincia = $connection->query("SELECT * FROM provincia");
                        while ($res_provincia = mysqli_fetch_array($sql_provincia)) {
                            echo '<option value="' . $res_provincia[1] . '">' . $res_provincia[2] . '</option>';
                        }
                        ?>
                    </select>
                    <input type="text" hidden="" name="seccion" value="comuna">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="actualizar-comuna" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->

<!-- Modal Carga Masiva -->
<div class="modal fade" id="masivo_comuna" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Masivo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frm-carga-comuna" enctype="multipart/form-data">
                    <label for="">Seleccionar Archivo: </label>
                    <input type="file" name="arch-comuna" accept="">
                    <input type="text" hidden="" name="seccion" value="comuna">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="cargar-masivo-comuna" class="btn btn-primary">Cargar</button>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->

<script type="text/javascript">
    $(document).ready(function() {
        $("#carga_comuna").load("web/mant_comuna.php");

        $("#agregar-nueva-comuna").click(function(){
            datos_comuna=$("#frm-nueva-comuna").serialize();
            AgregarDatosComuna(datos_comuna);
        });

        $("#actualizar-comuna").click(function(){
            datos_comuna_up=$("#frm-editar-comuna").serialize();
            EditarComuna(datos_comuna_up);
        });

        $('#cargar-masivo-comuna').click(function() {
            MasivoDatosComuna();
        });

    });
</script>