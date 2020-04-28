<?php
include "../cnx/connection.php";

$sql_doc_ges = "SELECT * FROM doc_ges ORDER BY fecha_doc_ges ASC";
$resul_doc_ges = mysqli_query($connection, $sql_doc_ges);

function tipo_archivo($ext)
{
    switch ($ext) {
        case "doc":
        case "docx":
            $ext = "fas fa-file-word word";
            break;
        case "pptx":
        case "ppsx":
        case "pptm":
        case "ppt":
        case "pps":
            $ext = "fas fa-file-powerpoint ppt";
            break;
        case "xlsx":
        case "xls":
        case "xlsm":
            $ext = "fas fa-file-excel excel";
            break;
        case "pdf":
            $ext = "fas fa-file-pdf pdf";
            break;
    }
    return $ext;
}

?>
<div class="mt-5">
    <h3 class="text-info text-center">Descarga de Documentos</h3>
</div>
<div class="mt-3">
    <div class="table-responsive">
        <table class="table table-hover table-condensed table-bordered table-sm" id="tabla-doc-ges">
            <thead style="background-color: #2C73FF; color:white; font-weight:bold;">
                <tr>
                    <td>Tipo</td>
                    <td>Documento</td>
                    <td>Fecha</td>
                    <td>Descarga</td>
                </tr>
            </thead>
            <tfoot style="background-color: #AEB2B9; color:white; font-weight:bold;">
                <tr>
                    <td>Tipo</td>
                    <td>Documento</td>
                    <td>Fecha</td>
                    <td>Descarga</td>
                </tr>
            </tfoot>
            <tbody>
                <?php
                while ($most_doc_ges = mysqli_fetch_array($resul_doc_ges)) {
                    $extension = end(explode(".", $most_doc_ges[1]));
                    $icono = tipo_archivo($extension);

                ?>
                    <tr>
                        <td style="text-align: center;">
                            <span class="<?php echo $icono; ?> fa-2x"></span>
                        </td>
                        <td><span class="<?php echo $icono; ?> fa-2x"></span> <?php echo $most_doc_ges[1]; ?></td>
                        <td><?php echo $most_doc_ges[2]; ?></td>
                        <td style="text-align: center;">
                            <span class="btn btn-success btn-sm">
                                <span class="fas fa-download"></span>
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