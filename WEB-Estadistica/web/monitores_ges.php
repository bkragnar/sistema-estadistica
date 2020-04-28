<?php
include "../cnx/connection.php";

$sql_monitores_siges = "SELECT r.id_red_siges, e.nombre_estable, c.nombre_comuna, r.nombre_red_siges, r.apellido_red_siges, r.mail_red_siges, r.rutaminsal_red_siges, r.telefono_red_siges
                FROM establecimiento e INNER JOIN red_siges r on e.codigo_estable=r.estable_red_siges
                INNER JOIN comuna c on c.codigo_comuna=r.comuna_red_siges";
$resul_monitores_siges = mysqli_query($connection, $sql_monitores_siges);
?>
<div class="mt-5 text-center text-info">
    <h3>Monitores GES Servicio de Salud Coquimbo</h3>
</div>
<div class="mt-3">
    <div class="table-responsive">
        <table class="table table-hover table-condensed table-bordered table-sm" id="tabla-monitores">
            <thead style="background-color: #2C73FF; color:white; font-weight:bold;">
                <tr>
                    <td>Establecimiento</td>
                    <td>Comuna</td>
                    <td>Nombre</td>
                    <td>Apellido</td>
                    <td class="text-center">Mail</td>
                    <td>Ruta Minsal</td>
                    <td>Telefono</td>
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
                </tr>
            </tfoot>
            <tbody>
                <?php
                while ($most_monitores_siges = mysqli_fetch_array($resul_monitores_siges)) {
                ?>
                    <tr>
                        <td><?php echo $most_monitores_siges[1]; ?></td>
                        <td><?php echo $most_monitores_siges[2]; ?></td>
                        <td ><?php echo $most_monitores_siges[3]; ?></td>
                        <td ><?php echo $most_monitores_siges[4]; ?></td>
                        <td ><a href="mailto:<?php echo $most_monitores_siges[5]; ?>"><?php echo $most_monitores_siges[5]; ?></a></td>
                        <td ><?php echo $most_monitores_siges[6]; ?></td>
                        <td ><?php echo $most_monitores_siges[7]; ?></td>
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
        $('#tabla-monitores').DataTable({
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