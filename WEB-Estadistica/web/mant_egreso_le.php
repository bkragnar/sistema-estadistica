<?php
include "../cnx/connection.php";

$anio_filtro = $_POST['anio_filtro'];
$tipole_filtro = $_POST['tipole_filtro'];

$sql_egreso_le = "SELECT l.id_egreso,e.nombre_estable,l.cantidad_eg,l.mes_eg,l.anio_eg,t.nombre_tipo_le
                FROM egresos_le l INNER JOIN establecimiento e on l.estable_eg=e.codigo_estable INNER JOIN tipo_le t on t.codigo_tipo_le=l.tipo_le_eg
                WHERE l.anio_eg=$anio_filtro and tipo_le_eg=$tipole_filtro
                ORDER BY l.estable_eg,l.mes_eg ASC";
$resul_egreso_le = mysqli_query($connection, $sql_egreso_le);
?>

<div>
    <div class="table-responsive">
        <table class="table table-hover table-condensed table-bordered table-sm" id="tabla-egreso-le">
            <thead style="background-color: #2C73FF; color:white; font-weight:bold;">
                <tr>
                    <td>Establecimiento</td>
                    <td>Cantidad</td>
                    <td>Mes</td>
                    <td>Año</td>
                    <td>Tipo L.E</td>
                    <td>Editar</td>
                    <td>Eliminar</td>
                </tr>
            </thead>
            <tfoot style="background-color: #AEB2B9; color:white; font-weight:bold;">
                <tr>
                    <td>Establecimiento</td>
                    <td>Cantidad</td>
                    <td>Mes</td>
                    <td>Año</td>
                    <td>Tipo L.E</td>
                    <td>Editar</td>
                    <td>Eliminar</td>
                </tr>
            </tfoot>
            <tbody>
                <?php
                while ($most_egreso_le = mysqli_fetch_array($resul_egreso_le)) {
                    $var_mes = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
                    $mes = $var_mes[$most_egreso_le[3] - 1];
                ?>
                    <tr>
                        <td><?php echo $most_egreso_le[1]; ?></td>
                        <td class="text-center"><?php echo $most_egreso_le[2]; ?></td>
                        <td class="text-capitalize"><?php echo $mes; ?></td>
                        <td class="text-center"><?php echo $most_egreso_le[4]; ?></td>
                        <td><?php echo $most_egreso_le[5]; ?></td>
                        <td style="text-align: center;">
                            <span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editar_egreso_le" onclick="AgrFormEditarEgresoLE('<?php echo $most_egreso_le[0]; ?>')">
                                <span class="far fa-edit fa-lg"></span>
                            </span>
                        </td>
                        <td style="text-align: center;">
                            <span class="btn btn-danger btn-sm" onclick="PreguntarSioNoEgresoLE('<?php echo $most_egreso_le[0]; ?>')">
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
        $('#tabla-egreso-le').DataTable({
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