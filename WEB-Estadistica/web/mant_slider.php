<?php
include "../cnx/connection.php";

$sql_slider = "SELECT * FROM slider_inicio";
$resul_slider = mysqli_query($connection, $sql_slider);


?>

<div>
    <div class="table-responsive">
        <table class="table table-hover table-condensed table-bordered table-sm" id="tabla-slider-img">
            <thead style="background-color: #2C73FF; color:white; font-weight:bold;">
                <tr>
                    <td class="text-center">Imagen</td>
                    <td class="text-center">Título</td>
                    <td class="text-center">Descripción</td>
                    <td class="text-center">Editar</td>
                    <td class="text-center">Eliminar</td>
                </tr>
            </thead>
            <tfoot style="background-color: #AEB2B9; color:white; font-weight:bold;">
                <tr>
                    <td class="text-center">Imagen</td>
                    <td class="text-center">Título</td>
                    <td class="text-center">Descripción</td>
                    <td class="text-center">Editar</td>
                    <td class="text-center">Eliminar</td>
                </tr>
            </tfoot>
            <tbody>
                <?php
                while ($most_slider = mysqli_fetch_array($resul_slider)) {

                ?>
                    <tr>
                        <td><?php echo $most_slider[1]; ?></td>
                        <td><?php echo $most_slider[2]; ?></td>
                        <td><?php echo $most_slider[3]; ?></td>
                        <td style="text-align: center;">
                            <span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editar_slider" onclick="AgrFormEditarSlider('<?php echo $most_slider[0]; ?>');">
                                <span class="far fa-edit fa-lg"></span>
                            </span>
                        </td>
                        <td style="text-align: center;">
                            <span class="btn btn-danger btn-sm" onclick="PreguntarSioNoSlider('<?php echo $most_slider[0]; ?>')">
                                <span class="far fa-trash-alt fa-lg"></span>
                            </span>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tabla-slider-img').DataTable({
            "language": {
                "decimal": ".",
                "emptyTable": "No hay datos para mostrar",
                "info": "del _START_ al _END_ (_TOTAL_ total)",
                "infoEmpty": "del 0 al 0 (0 total)",
                "infoFiltered": "(filtrado de todas las _MAX_ entradas)",
                "infoPostFix": "",
                "thousands": "'",
                "lengthMenu": "Mostrar _MENU_ entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "No hay resultados",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "aria": {
                    "sortAscending": ": ordenar de manera Ascendente",
                    "sortDescending": ": ordenar de manera Descendente ",
                }
            }
        });
    });
</script>