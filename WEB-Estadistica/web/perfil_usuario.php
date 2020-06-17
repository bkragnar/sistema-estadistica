<?php
include "../cnx/connection.php";
session_start();
$usuariosime = $_SESSION['session_usuario_codigo'];

$sql_datos_usu = $connection->query("SELECT u.nombre_sime,u.apellido_sime, u.correo_sime,u.usuario_sime,e.nombre_estable,u.avatar_sime
                                    FROM usuarios_sime u INNER JOIN establecimiento e on u.estable_sime=e.codigo_estable
                                    WHERE u.id_sime='$usuariosime'");
while ($res_datos_usu = mysqli_fetch_array($sql_datos_usu)) {
    $nombre_usu = $res_datos_usu[0];
    $apellido_usu = $res_datos_usu[1];
    $correo_usu = $res_datos_usu[2];
    $usuario_usu = $res_datos_usu[3];
    $estable_usu = $res_datos_usu[4];
    $avatar_usu = $res_datos_usu[5];
}

?>


<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card text-left">
                <div class="card-header">
                    Perfil de Usuario
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4 p-0">
                            <div class="box-avatar-usu mx-auto">
                                <img id="img-muestra-avatar" class="rounded-circle" src="static/img_avatar/<?php echo $avatar_usu; ?>" alt="">
                            </div>
                            <div class="update-avatar-usu">
                                <form id="cambio-avatar" onsubmit="return false" action="">
                                    <input type="file" id="img-avatar-usu-up" name="img-avatar-usu-up" class="form-control form-control-sm">
                                    <button id="btn-up-avatar" class="btn btn-primary btn-block btn-sm mt-2">Actualizar imagen</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-sm-8 p-0">
                            <div class="ml-2">
                                <div class="datos-usu mt-3">
                                    <div>
                                        <label class="text-secondary" for="">Nombre:</label><label class="text-dark ml-2 font-weight-bolder" for=""><?php echo $nombre_usu . " " . $apellido_usu; ?></label>
                                    </div>
                                    <div>
                                        <label class="text-secondary" for="">Correo:</label><label class="text-dark ml-2 font-weight-bolder" for=""><?php echo $correo_usu; ?></label>
                                    </div>
                                    <div>
                                        <label class="text-secondary" for="">Usuario:</label><label class="text-dark ml-2 font-weight-bolder" for=""><?php echo $usuario_usu; ?></label>
                                    </div>
                                    <div>
                                        <label class="text-secondary" for="">Establecimiento:</label><label class="text-dark ml-2 font-weight-bolder" for=""><?php echo $estable_usu; ?></label>
                                    </div>
                                    <hr>
                                    <div>
                                        <h5 class="text-center text-info">Cambio de contraseña</h5>
                                    </div>
                                    <div>
                                        <form id="cambio-pass" onsubmit="return false" action="">
                                            <div class="row">
                                                <div class="col">
                                                    <div>
                                                        <label class="ml-4" for="">Contraseña Nueva</label>
                                                        <span class="row input-group">
                                                            <span id="" class="input-group-text  ml-4" onmousedown="revelapass(1)" onmouseup="ocultapass(1)"><i id="eye-clas1" class="fas fa-eye-slash text-primary"></i></span>
                                                            <input id="pass1" name="pass1" class="form-control input-sm" type="password" autocomplete="off"><i id="signo-pass1" class="far fa-check-square fa-lg ml-2"></i>
                                                    </div>
                                                    <div>
                                                        <label class="ml-4" for="">Repetir Contraseña</label>
                                                        <span class="row input-group">
                                                            <span id="" class="input-group-text  ml-4" onmousedown="revelapass(2)" onmouseup="ocultapass(2)"><i id="eye-clas2" class="fas fa-eye-slash text-primary"></i> </span>
                                                            <input id="pass2" name="pass2" class="form-control input-sm" type="password" autocomplete="off"><i id="signo-pass2" class="far fa-check-square fa-lg ml-2"></i>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <!--
                                                    <div class="mr-0 text-right">
                                                        <button class="btn btn-primary ">Actualiza contraseña</button>
                                                    </div>-->
                                                    <div class="d-flex align-items-end flex-column bd-highlight" style="height: 130px;">
                                                        <button id="btn_actualiza_pass" class="btn btn-primary mt-auto bd-highlight">Actualizar contraseña</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    Sub-Departamento de Estadísticas y Gestión de la Información
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#signo-pass1').hide();
        $('#signo-pass2').hide();

        //---------------------------------------------------------------
        //              pre-visualizador de imagenes antes de cargar
        $("#img-avatar-usu-up").change(function() {
            readURL(this);
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    // Asignamos el atributo src a la tag de imagen
                    $('#img-muestra-avatar').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        //---------------------------------------------------------------
        //---------------------------------------------------------------

        //---------------------------------------------------------------
        //          valida las claves que ingresa el usuario
        $('#pass1').keyup(function() {
            valida_pass_usu();
        });
        $('#pass2').keyup(function() {
            valida_pass_usu();
        });

        function valida_pass_usu() {
            var pas1 = $('#pass1').val();
            var pas2 = $('#pass2').val();

            if (pas1.length >= 6) {
                $('#signo-pass1').show();
                document.getElementById("signo-pass1").style.color = "green";
            } else {
                $('#signo-pass1').hide();
            }

            var signo2 = document.getElementById("signo-pass2");
            if (pas1 === pas2 && pas2.length >= 6) {
                $('#signo-pass2').show();
                document.getElementById("signo-pass2").style.color = "green";
            } else {
                $('#signo-pass2').hide();
            }
        }

        //---------------------------------------------------------------
        //          boton actualiza clave de usuario
        $('#btn_actualiza_pass').click(function() {
            if ($('#pass1').val() != "" && $('#pass2').val() != "" && $('#pass1').val().length >= 6 && $('#pass2').val().length >= 6) {
                if ($('#pass1').val() == $('#pass2').val()) {
                    var clave_nueva = $('#pass1').val();
                    //alertify.success("las claves coinciden");
                    $.post('static/transaccion/editar.php', {
                            "actualiza_pass": clave_nueva,
                            "usu_sime": '<?php echo $usuariosime; ?>',
                            "seccion": "cambio_clave"
                        },
                        function(res) {
                            if (res == 1) {
                                alertify.success("La contraseña fue actualizada con exito");
                                $('#cambio-pass')[0].reset(); //limpia el formulario
                                $.post('static/transaccion/email.php', {
                                    "nombre": '<?php echo $nombre_usu; ?>',
                                    "apellido": '<?php echo $apellido_usu; ?>',
                                    "correo": '<?php echo $correo_usu; ?>',
                                    "clave": clave_nueva,
                                    "usuario": '<?php echo $usuario_usu; ?>',
                                    "var_mail": "cambio_clave"
                                }, function(res2) {
                                    if (res2 == 1) {
                                        alertify.success("Se envió un email a su correo con la nueva contraseña");
                                    } else {
                                        alertify.error("No fue posible enviar el email a su correo");
                                    }
                                });
                            }
                        });
                } else {
                    alertify.warning("Las claves no coinciden");
                }
            } else {
                alertify.warning("La clave debe tener un minimo de 6 caracteres");
            }
        });
        //---------------------------------------------------------------
        //---------------------------------------------------------------

        //---------------------------------------------------------------
        //          boton actualiza avatar
        $('#btn-up-avatar').click(function() {
            var archivo_avatar = new FormData($("#cambio-avatar")[0]);
            archivo_avatar.append('usuario', '<?php echo $usuario_usu; ?>');
            archivo_avatar.append('seccion', 'actualizar_avatar');
            $.ajax({
                type: "POST",
                url: "static/transaccion/editar.php",
                data: archivo_avatar,
                cache: false,
                contentType: false,
                processData: false,
                success: function(r) {
                    alert(r);
                    if (r == 1) {
                        $("#img-avatar-usu-up").val(null); //limpia el formulario por id
                        alertify.success("Avatar actualizado con exito");
                    } else {
                        alertify.error("No fue posible actualizar el Avatar ");
                    }
                }
            });
        });
        //---------------------------------------------------------------
        //---------------------------------------------------------------
    });

    //--------------- funcion revela y oculta ----------------------
    function revelapass(eye) {
        if (eye == 1) {
            $('#eye-clas1').removeClass('fa-eye-slash');
            $('#eye-clas1').addClass('fa-eye');
            document.getElementById("pass1").type = "text";
        } else {
            $('#eye-clas2').removeClass('fa-eye-slash');
            $('#eye-clas2').addClass('fa-eye');
            document.getElementById("pass2").type = "text";
        }
    }

    function ocultapass(eye) {
        if (eye == 1) {
            $('#eye-clas1').removeClass('fa-eye');
            $('#eye-clas1').addClass('fa-eye-slash');
            document.getElementById("pass1").type = "password";
        } else {
            $('#eye-clas2').removeClass('fa-eye');
            $('#eye-clas2').addClass('fa-eye-slash');
            document.getElementById("pass2").type = "password";
        }
    }
</script>