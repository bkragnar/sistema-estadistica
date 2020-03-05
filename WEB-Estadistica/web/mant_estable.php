<?php
include "../cnx/connection.php";

$sql_estable = "SELECT e.id_estable,e.codigo_estable,e.nombre_estable,c.nombre_comuna,p.nombre_provincia,t.nombre_tipo
                FROM establecimiento e inner join comuna c on e.codigo_comuna=c.codigo_comuna
                inner join provincia p on p.codigo_provincia=e.codigo_provincia inner join tipo_estable t on t.codigo_tipo=e.tipo_estable
                ORDER BY e.codigo_estable ASC";
$resul_estable = mysqli_query($connection, $sql_estable);
?>

<div>
    <div class="table-responsive">
        <table class="table table-hover table-condensed table-bordered table-sm" id="tabla-estable">
            <thead style="background-color: #2C73FF; color:white; font-weight:bold;">
                <tr>
                    <td>Código</td>
                    <td>Nombre</td>
                    <td>Comuna</td>
                    <td>Provincia</td>
                    <td>Tipo</td>
                    <td>Editar</td>
                    <td>Eliminar</td>
                </tr>
            </thead>
            <tfoot style="background-color: #AEB2B9; color:white; font-weight:bold;">
                <tr>
                    <td>Código</td>
                    <td>Nombre</td>
                    <td>Comuna</td>
                    <td>Provincia</td>
                    <td>Tipo</td>
                    <td>Editar</td>
                    <td>Eliminar</td>
                </tr>
            </tfoot>
            <tbody>
                <?php
                while ($most_estable = mysqli_fetch_array($resul_estable)) {
                ?>
                    <tr>
                        <td><?php echo $most_estable[1]; ?></td>
                        <td><?php echo $most_estable[2]; ?></td>
                        <td><?php echo $most_estable[3]; ?></td>
                        <td><?php echo $most_estable[4]; ?></td>
                        <td><?php echo $most_estable[5]; ?></td>
                        <td style="text-align: center;">
                            <span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editar_estable"
                            onclick="AgrFormEditarEstable('<?php echo $most_estable[0]; ?>')">
                                <span class="far fa-edit fa-lg"></span>
                            </span>
                        </td>
                        <td style="text-align: center;">
                            <span class="btn btn-danger btn-sm"
                            onclick="PreguntarSioNoEstable('<?php echo $most_estable[0]; ?>')">
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
        $('#tabla-estable').DataTable({
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