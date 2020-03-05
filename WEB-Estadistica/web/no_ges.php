<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card text-left">
                <div class="card-header">
                    COMGES Lista de Espera No GES
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs nav-justified">
                        <li class="nav-item">
                            <a id="cne" class="nav-link active" href="#">Consulta Nueva de Especialidad</a>
                        </li>
                        <li class="nav-item">
                            <a id="cneo" class="nav-link" href="#">Consulta Nueva de Especialidad Odontológica</a>
                        </li>
                        <li class="nav-item">
                            <a id="proced" class="nav-link" href="#">Consulta Nueva de Procedimientos</a>
                        </li>
                        <li class="nav-item">
                            <a id="iq" class="nav-link" href="#">Intervención Quirurgica <br>(incluye IQ Complejas)</a>
                        </li>
                    </ul>
                    <div id="contenido-no-ges"></div>
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
        $('#contenido-no-ges').load('web/cne.php');

        $('#cne').click(function(){
            $('#contenido-no-ges').empty();
            $('#contenido-no-ges').load('web/cne.php');
        });
        
        $('#cneo').click(function(){
            $('#contenido-no-ges').empty();
            $('#contenido-no-ges').load('.php');
        });
        
        $('#proced').click(function(){
            $('#contenido-no-ges').empty();
            $('#contenido-no-ges').load('.php');
        });
        
        $('#iq').click(function(){
            $('#contenido-no-ges').empty();
            $('#contenido-no-ges').load('.php');
        });
    });

    $('a.nav-link').click(function() {
        $('a.nav-link').removeClass("active");
        $(this).addClass("active");
    });
</script>