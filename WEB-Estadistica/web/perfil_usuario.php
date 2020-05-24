<?php
include "../cnx/connection.php";
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
                                <img id="img-muestra-avatar" class="rounded-circle" src="" alt="">
                            </div>
                            <div class="update-avatar-usu">
                                <form action="">
                                    <input type="file" id="img-avatar-usu-up" name="img-avatar-usu-up" class="form-control form-control-sm">
                                    <button class="btn btn-primary btn-block btn-sm mt-2">Actualizar imagen</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-sm-8 p-0">
                            <div class="ml-2">
                                <div class="datos-usu mt-3">
                                    <div>
                                        <label class="text-secondary" for="">Nombre:</label><label class="text-dark ml-2 font-weight-bolder" for="">oscar santander videla</label>
                                    </div>
                                    <div>
                                        <label class="text-secondary" for="">Correo:</label><label class="text-dark ml-2 font-weight-bolder" for="">oscar santander videla</label>
                                    </div>
                                    <div>
                                        <label class="text-secondary" for="">Usuario:</label><label class="text-dark ml-2 font-weight-bolder" for="">oscar santander videla</label>
                                    </div>
                                    <div>
                                        <label class="text-secondary" for="">Establecimiento:</label><label class="text-dark ml-2 font-weight-bolder" for="">oscar santander videla</label>
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
                                                        <span class="row">
                                                            <span id="" class="input-group-text  ml-4" onmousedown="revelapass(1)" onmouseup="ocultapass(1)"><i id="eye-clas1" class="fas fa-eye-slash text-primary"></i></span>
                                                            <input id="pass1" name="pass1" type="password"><i id="signo-pass1" class="far fa-check-square fa-lg ml-2"></i>
                                                    </div>
                                                    <div>
                                                        <label class="ml-4" for="">Repetir Contraseña</label>
                                                        <span class="row">
                                                            <span id="" class="input-group-text  ml-4" onmousedown="revelapass(2)" onmouseup="ocultapass(2)"><i id="eye-clas2" class="fas fa-eye-slash text-primary"></i> </span>
                                                            <input id="pass2" name="pass2" type="password"><i id="signo-pass2" class="far fa-check-square fa-lg ml-2"></i>
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
                    alertify.success("las claves coinciden");
                } else {
                    alertify.warning("Las claves no coinciden");
                }
            } else {
                alertify.warning("La clave debe tener un minimo de 6 caracteres");
            }
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