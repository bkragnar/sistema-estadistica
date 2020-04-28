<?php
include "../cnx/connection.php";

$sql_red_siges = "SELECT r.id_red_siges, e.nombre_estable, c.nombre_comuna, r.nombre_red_siges, r.apellido_red_siges, r.mail_red_siges, r.rutaminsal_red_siges, r.telefono_red_siges,e.codigo_estable
                FROM establecimiento e INNER JOIN red_siges r on e.codigo_estable=r.estable_red_siges
                INNER JOIN comuna c on c.codigo_comuna=r.comuna_red_siges";
$resul_red_siges = mysqli_query($connection, $sql_red_siges);
?>

<div>
    <div class="table-responsive">
        <table class="table table-hover table-condensed table-bordered table-sm" id="tabla-red-siges">
            <thead style="background-color: #2C73FF; color:white; font-weight:bold;">
                <tr>
                    <td>Establecimiento</td>
                    <td>Comuna</td>
                    <td>Nombre</td>
                    <td>Apellido</td>
                    <td class="text-center">Mail</td>
                    <td>Ruta Minsal</td>
                    <td>Telefono</td>
                    <td>Editar</td>
                    <td>Eliminar</td>
                </tr>
            </thead>
            <tfoot style="background-color: #AEB2B9; color:white; font-weight:bold;">
                <tr>
                    <td>Establecimiento</td>
                    <td>Comuna</td>
                    <td>Nombre</td>
                    <td>Apellido</td>
                    <td class="text-center">Mail</td>
                    <td>Ruta Minsal</td>
                    <td>Telefono</td>
                    <td>Editar</td>
                    <td>Eliminar</td>
                </tr>
            </tfoot>
            <tbody>
                <?php
                while ($most_red_siges = mysqli_fetch_array($resul_red_siges)) {
                ?>
                    <tr>
                        <td><?php echo $most_red_siges[1]; ?></td>
                        <td><?php echo $most_red_siges[2]; ?></td>
                        <td ><?php echo $most_red_siges[3]; ?></td>
                        <td ><?php echo $most_red_siges[4]; ?></td>
                        <td ><?php echo $most_red_siges[5]; ?></td>
                        <td ><?php echo $most_red_siges[6]; ?></td>
                        <td ><?php echo $most_red_siges[7]; ?></td>
                        <td style="text-align: center;">
                            <span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editar_red_siges" onclick="AgrFormEditarRedSiges('<?php echo $most_red_siges[0]; ?>');recargarLista_comunaRedSigesUP('<?php echo $most_red_siges[8]; ?>');">
                                <span class="far fa-edit fa-lg"></span>
                            </span>
                        </td>
                        <td style="text-align: center;">
                            <span class="btn btn-danger btn-sm" onclick="PreguntarSioNoRedSiges('<?php echo $most_red_siges[0]; ?>')">
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
        $('#tabla-red-siges').DataTable({
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