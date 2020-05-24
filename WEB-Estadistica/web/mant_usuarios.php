<?php
include "../cnx/connection.php";

$sql_usuario = "SELECT u.id_sime,u.nombre_sime,u.apellido_sime,e.nombre_estable,u.correo_sime,u.estado_sime
                FROM usuarios_sime u INNER JOIN establecimiento e on u.estable_sime=e.codigo_estable";
$resul_usuario = mysqli_query($connection, $sql_usuario);


?>

<div>
    <div class="table-responsive">
        <table class="table table-hover table-condensed table-bordered table-sm" id="tabla-usuario">
            <thead style="background-color: #2C73FF; color:white; font-weight:bold;">
                <tr>
                    <td>Nombre</td>
                    <td>Establecimiento</td>
                    <td>Correo</td>
                    <td>Estado</td>
                    <td>Editar</td>
                    <td>Eliminar</td>
                </tr>
            </thead>
            <tfoot style="background-color: #AEB2B9; color:white; font-weight:bold;">
                <tr>
                    <td>Nombre</td>
                    <td>Establecimiento</td>
                    <td>Correo</td>
                    <td>Estado</td>
                    <td>Editar</td>
                    <td>Eliminar</td>
                </tr>
            </tfoot>
            <tbody>
                <?php
                while ($most_usuario = mysqli_fetch_array($resul_usuario)) {
                    if($most_usuario[5]==1){
                        $estado_usu="Habilitado";
                    }else{
                        $estado_usu="Deshabilitado";
                    }

                ?>
                    <tr>
                        <td><?php echo $most_usuario[1]." ".$most_usuario[2]; ?></td>
                        <td><?php echo $most_usuario[3]; ?></td>
                        <td><?php echo $most_usuario[4]; ?></td>
                        <td><?php echo $estado_usu; ?></td>
                        <td style="text-align: center;">
                            <span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editar_usuario" onclick="AgrFormEditarUsuario('<?php echo $most_usuario[0]; ?>')">
                                <span class="far fa-edit fa-lg"></span>
                            </span>
                        </td>
                        <td style="text-align: center;">
                            <span class="btn btn-danger btn-sm" onclick="PreguntarSioNoUsuario('<?php echo $most_usuario[0]; ?>')">
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
        $('#tabla-usuario').DataTable({
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