<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card text-left">
                <div class="card-header">
                    Informes de Garantías Explícitas en Salud (GES)
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs nav-justified">
                        <li class="nav-item" id="resumen">
                            <a class="nav-link active" href="#">Resumen GES</a>
                        </li>
                        <li class="nav-item" id="monitores-ges">
                            <a class="nav-link" href="#">Monitores</a>
                        </li>
                        <li class="nav-item" id="documentos-ges">
                            <a class="nav-link" href="#">Documentos</a>
                        </li>
                    </ul>
                    <div id="contenido-informe-ges"></div>
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
        carga_informes_ges();
    });
</script>