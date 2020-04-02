<?php
include "../cnx/connection.php";

$sql_casos_ges = "SELECT eg.id_eg_ges,e.nombre_estable,t.nombre_tipo_ges,mes_eg_ges,anio_eg_ges,cantidad_eg_ges
                FROM establecimiento e INNER JOIN egresos_ges eg on e.codigo_estable=eg.estable_eg_ges INNER JOIN
                tipo_ges t on t.codigo_tipo_ges=eg.codigo_tipo_ges_eg_ges
                ORDER BY e.codigo_estable ASC";
$resul_casos_ges = mysqli_query($connection, $sql_casos_ges);
?>

<div>
    <div class="table-responsive">
        <table class="table table-hover table-condensed table-bordered table-sm" id="tabla-casos-ges">
            <thead style="background-color: #2C73FF; color:white; font-weight:bold;">
                <tr>
                    <td>Establecimiento</td>
                    <td>Tipo</td>
                    <td>Mes</td>
                    <td>Año</td>
                    <td>Cantidad</td>
                    <td>Editar</td>
                    <td>Eliminar</td>
                </tr>
            </thead>
            <tfoot style="background-color: #AEB2B9; color:white; font-weight:bold;">
                <tr>
                    <td>Establecimiento</td>
                    <td>Tipo</td>
                    <td>Mes</td>
                    <td>Año</td>
                    <td>Cantidad</td>
                    <td>Editar</td>
                    <td>Eliminar</td>
                </tr>
            </tfoot>
            <tbody>
                <?php
                while ($most_casos_ges = mysqli_fetch_array($resul_casos_ges)) {
                    $var_mes = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
                    $mes = $var_mes[$most_casos_ges[3] - 1];// [3]-1 xq el array comienza en 0
                ?>
                    <tr>
                        <td><?php echo $most_casos_ges[1]; ?></td>
                        <td><?php echo $most_casos_ges[2]; ?></td>
                        <td class="text-center"><?php echo $mes; ?></td>
                        <td class="text-center"><?php echo $most_casos_ges[4]; ?></td>
                        <td class="text-center"><?php echo $most_casos_ges[5]; ?></td>
                        <td style="text-align: center;">
                            <span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editar_casos_ges" onclick="AgrFormEditarCasosGes('<?php echo $most_casos_ges[0]; ?>')">
                                <span class="far fa-edit fa-lg"></span>
                            </span>
                        </td>
                        <td style="text-align: center;">
                            <span class="btn btn-danger btn-sm" onclick="PreguntarSioNoCasosGes('<?php echo $most_casos_ges[0]; ?>')">
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
        $('#tabla-casos-ges').DataTable({
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