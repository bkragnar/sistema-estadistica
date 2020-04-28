<?php
include "../cnx/connection.php";

$sql_doc_ges = "SELECT * FROM doc_ges ORDER BY fecha_doc_ges ASC";
$resul_doc_ges = mysqli_query($connection, $sql_doc_ges);


?>

<div>
    <div class="table-responsive">
        <table class="table table-hover table-condensed table-bordered table-sm" id="tabla-doc-ges">
            <thead style="background-color: #2C73FF; color:white; font-weight:bold;">
                <tr>
                    <td>Documento</td>
                    <td>Fecha</td>
                    <td>Eliminar</td>
                </tr>
            </thead>
            <tfoot style="background-color: #AEB2B9; color:white; font-weight:bold;">
                <tr>
                    <td>Documento</td>
                    <td>Fecha</td>
                    <td>Eliminar</td>
                </tr>
            </tfoot>
            <tbody>
                <?php
                while ($most_doc_ges = mysqli_fetch_array($resul_doc_ges)) {
                ?>
                    <tr>
                        <td><?php echo $most_doc_ges[1]; ?></td>
                        <td><?php echo $most_doc_ges[2]; ?></td>
                        <td style="text-align: center;">
                            <span class="btn btn-danger btn-sm" onclick="PreguntarSioNoDocGes('<?php echo $most_doc_ges[0]; ?>')">
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
        $('#tabla-doc-ges').DataTable({
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