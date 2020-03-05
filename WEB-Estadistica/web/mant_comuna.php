<?php
include "../cnx/connection.php";

$sql_comuna = " SELECT c.id_comuna,c.codigo_comuna,c.nombre_comuna,p.nombre_provincia
                FROM comuna c inner join provincia p on c.codigo_provincia=p.codigo_provincia
                ORDER BY codigo_comuna ASC";
$resul_comuna = mysqli_query($connection, $sql_comuna);
?>

<div>
    <div class="table-responsive">
        <table class="table table-hover table-condensed table-bordered table-sm" id="tabla-comuna">
            <thead style="background-color: #2C73FF; color:white; font-weight:bold;">
                <tr>
                    <td>Código</td>
                    <td>Nombre</td>
                    <td>Provincia</td>
                    <td>Editar</td>
                    <td>Eliminar</td>
                </tr>
            </thead>
            <tfoot style="background-color: #AEB2B9; color:white; font-weight:bold;">
                <tr>
                    <td>Código</td>
                    <td>Nombre</td>
                    <td>Provincia</td>
                    <td>Editar</td>
                    <td>Eliminar</td>
                </tr>
            </tfoot>
            <tbody>
                <?php
                while ($most_comuna = mysqli_fetch_array($resul_comuna)) {
                ?>
                    <tr>
                        <td><?php echo $most_comuna[1]; ?></td>
                        <td><?php echo $most_comuna[2]; ?></td>
                        <td><?php echo $most_comuna[3]; ?></td>
                        <td style="text-align: center;">
                            <span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editar_comuna"
                            onclick="AgrFormEditarComuna('<?php echo $most_comuna[0]; ?>')">
                                <span class="far fa-edit fa-lg"></span>
                            </span>
                        </td>
                        <td style="text-align: center;">
                            <span class="btn btn-danger btn-sm"
                            onclick="PreguntarSioNoComuna('<?php echo $most_comuna[0]; ?>')">
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
        $('#tabla-comuna').DataTable({
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