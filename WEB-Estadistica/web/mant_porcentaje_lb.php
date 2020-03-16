<?php
include "../cnx/connection.php";

$sql_linea_base = "SELECT p.id_porc_lb,e.nombre_tipo,p.pri_corte_porc_lb,p.seg_corte_porc_lb,p.ter_corte_porc_lb,p.cto_corte_porc_lb,p.anio_corte_porc_lb
                FROM tipo_estable e INNER JOIN porcentaje_lb p ON e.codigo_tipo=p.tipo_estable_porc_lb
                ORDER BY p.tipo_estable_porc_lb,p.anio_corte_porc_lb ASC";
$resul_linea_base = mysqli_query($connection, $sql_linea_base);
?>

<div>
    <div class="table-responsive">
        <table class="table table-hover table-condensed table-bordered table-sm" id="tabla-porcentaje-lb">
            <thead style="background-color: #2C73FF; color:white; font-weight:bold;">
                <tr>
                    <td>Tipo</td>
                    <td>1º Corte</td>
                    <td>2º Corte</td>
                    <td>3º Corte</td>
                    <td>4º Corte</td>
                    <td>Año</td>
                    <td>Editar</td>
                    <td>Eliminar</td>
                </tr>
            </thead>
            <tfoot style="background-color: #AEB2B9; color:white; font-weight:bold;">
                <tr>
                    <td>Tipo</td>
                    <td>1º Corte</td>
                    <td>2º Corte</td>
                    <td>3º Corte</td>
                    <td>4º Corte</td>
                    <td>Año</td>
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
                        <td class="text-center"><?php echo $most_linea_base[2]."%"; ?></td>
                        <td class="text-center"><?php echo $most_linea_base[3]."%"; ?></td>
                        <td class="text-center"><?php echo $most_linea_base[4]."%"; ?></td>
                        <td class="text-center"><?php echo $most_linea_base[5]."%"; ?></td>
                        <td class="text-center"><?php echo $most_linea_base[6]; ?></td>
                        <td style="text-align: center;">
                            <span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editar_porcentaje_lb" onclick="AgrFormEditarPorcentajeLB('<?php echo $most_linea_base[0]; ?>')">
                                <span class="far fa-edit fa-lg"></span>
                            </span>
                        </td>
                        <td style="text-align: center;">
                            <span class="btn btn-danger btn-sm" onclick="PreguntarSioNoPorcentajeLB('<?php echo $most_linea_base[0]; ?>')">
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
        $('#tabla-porcentaje-lb').DataTable({
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