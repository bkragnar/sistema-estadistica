<?php
include "../cnx/connection.php";

$sql_linea_base = "SELECT l.id_lb,e.nombre_estable,l.cantidad_lb,l.anio_lb,t.nombre_tipo_le
                FROM establecimiento e INNER JOIN linea_base_le l ON e.codigo_estable=l.codigo_estable_lb
                INNER JOIN tipo_le t ON l.tipo_le_lb=t.codigo_tipo_le
                ORDER BY l.codigo_estable_lb";
$resul_linea_base = mysqli_query($connection, $sql_linea_base);
?>

<div>
    <div class="table-responsive">
        <table class="table table-hover table-condensed table-bordered table-sm" id="tabla-lina-base">
            <thead style="background-color: #2C73FF; color:white; font-weight:bold;">
                <tr>
                    <td>Establecimiento</td>
                    <td>Cantidad</td>
                    <td>Año</td>
                    <td>Tipo</td>
                    <td>Editar</td>
                    <td>Eliminar</td>
                </tr>
            </thead>
            <tfoot style="background-color: #AEB2B9; color:white; font-weight:bold;">
                <tr>
                    <td>Establecimiento</td>
                    <td>Cantidad</td>
                    <td>Año</td>
                    <td>Tipo</td>
                    <td>Editar</td>
                    <td>Eliminar</td>
                </tr>
            </tfoot>
            <tbody>
                <?php
                while ($most_linea_base = mysqli_fetch_array($resul_linea_base)) {
                ?>
                    <tr>
                        <td><?php echo $most_linea_base[1]; ?></td>
                        <td><?php echo $most_linea_base[2]; ?></td>
                        <td><?php echo $most_linea_base[3]; ?></td>
                        <td><?php echo $most_linea_base[4]; ?></td>
                        <td style="text-align: center;">
                            <span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editar_linea-base" onclick="AgrFormEditarLineaBase('<?php echo $most_linea_base[0]; ?>')">
                                <span class="far fa-edit fa-lg"></span>
                            </span>
                        </td>
                        <td style="text-align: center;">
                            <span class="btn btn-danger btn-sm" onclick="PreguntarSioNoLineaBase('<?php echo $most_linea_base[0]; ?>')">
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
        $('#tabla-lina-base').DataTable({
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