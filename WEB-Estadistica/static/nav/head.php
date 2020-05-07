<nav class="navbar navbar-expand-md navbar-dark bg-dark py-0 shadow-sm">
  <div class="container">
    <a href="#" class="navbar-brand font-weight-bold" id="menu-inicio">Inicio</a>

    <button type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler">
      <span class="navbar-toggler-icon"></span>
    </button>


    <div id="navbarContent" class="collapse navbar-collapse">
      <ul class="navbar-nav mr-auto">

        <!-- nav dropdown -->
        <li class="nav-item dropdown">

          <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle">Indicadores</a>
          <ul class="dropdown-menu">

            <li><a href="#" class="dropdown-item">IAAPS</a></li>
            <li><a href="#" class="dropdown-item">Metas Sanitarias</a></li>

          </ul>
        </li>

        <!-- nav dropdown -->
        <li class="nav-item dropdown">

          <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle">Listas de Espera</a>
          <ul class="dropdown-menu">

            <li><a href="#" class="dropdown-item" id="menu-rep-ges">GES</a></li>
            <li><a href="#" class="dropdown-item" id="menu-rep-no-ges">No GES</a></li>

          </ul>
        </li>

        <!-- nav dropdown -->
        <li class="nav-item dropdown">

          <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle">Mantenedores</a>
          <ul class="dropdown-menu">

            <!-- lvl 1 dropdown -->
            <li class="dropdown-submenu">
              <a href="#" role="button" data-toggle="dropdown" class="dropdown-item dropdown-toggle">Estaticos</a>
              <ul class="dropdown-menu">
                <li><a href="#" class="dropdown-item" id="menu-mant-provincia">Provincia</a></li>
                <li><a href="#" class="dropdown-item" id="menu-mant-comuna">Comuna</a></li>
                <li><a href="#" class="dropdown-item" id="menu-mant-tipo-estable">Tipo Establecimiento</a></li>
                <li><a href="#" class="dropdown-item" id="menu-mant-estable">Establecimiento</a></li>
                <li><a href="#" class="dropdown-item" id="menu-mant-tipo-le">Tipo L.E.</a></li>
                <li><a href="#" class="dropdown-item" id="menu-mant-linea-base">Linea Base L.E.</a></li>
                <li><a href="#" class="dropdown-item" id="menu-mant-porcentaje-lb">Porcentaje COMGES</a></li>
                <li><a href="#" class="dropdown-item" id="menu-mant-tipoges">Tipo GES</a></li>

                <!-- lvl 2 dropdown -->
                <!--
                <li class="dropdown-submenu">
                  <a href="#" role="button" data-toggle="dropdown" class="dropdown-item dropdown-toggle">level 2</a>
                  <ul class="dropdown-menu">
                    <li><a href="#" class="dropdown-item">level 3</a></li>
                    -->
                <!-- lvl 3 dropdown -->
                <!--
                    <li class="dropdown-submenu">
                      <a href="#" role="button" data-toggle="dropdown" class="dropdown-item dropdown-toggle">level 3</a>
                      <ul class="dropdown-menu">
                        <li><a href="#" class="dropdown-item">level 4</a></li>
                      </ul>
                    </li>

                  </ul>
                </li>

                <li><a href="#" class="dropdown-item">level 2</a></li>
                <li><a href="#" class="dropdown-item">level 2</a></li>
                -->
              </ul>
            </li>

            <li class="dropdown-submenu">
              <a href="#" role="button" data-toggle="dropdown" class="dropdown-item dropdown-toggle">Dinamicos</a>
              <ul class="dropdown-menu">
                <li><a href="#" class="dropdown-item" id="menu-mant-egreso-le">Egresos L.E</a></li>
                <li><a href="#" class="dropdown-item" id="menu-mant-casos-ges">Casos GES</a></li>
                <li><a href="#" class="dropdown-item" id="menu-mant-red-siges">Red Siges</a></li>
                <li><a href="#" class="dropdown-item" id="menu-mant-doc-ges">Documentos GES</a></li>
                <li><a href="#" class="dropdown-item" id="menu-mant-slider">Slider</a></li>
              </ul>
            </li>
            <!--
            <li><a href="#" class="dropdown-item">Some other action</a></li>

            <li class="dropdown-submenu">
              <a href="#" role="button" data-toggle="dropdown" class="dropdown-item dropdown-toggle">level 1</a>
              <ul class="dropdown-menu">

                <li class="dropdown-submenu">
                  <a href="#" role="button" data-toggle="dropdown" class="dropdown-item dropdown-toggle">level 2</a>
                  <ul class="dropdown-menu">
                    <li><a href="#" class="dropdown-item">level 3</a></li>
                    <li><a href="#" class="dropdown-item">level 3</a></li>
                  </ul>
                </li>

                <li class="dropdown-submenu">
                  <a href="#" role="button" data-toggle="dropdown" class="dropdown-item dropdown-toggle">level 2</a>
                  <ul class="dropdown-menu">
                    <li><a href="#" class="dropdown-item">level 3</a></li>
                    <li><a href="#" class="dropdown-item">level 3</a></li>
                  </ul>
                </li>

                <li><a href="#" class="dropdown-item">level 2</a></li>

                <li class="dropdown-submenu">
                  <a href="#" role="button" data-toggle="dropdown" class="dropdown-item dropdown-toggle">level 2</a>
                  <ul class="dropdown-menu">
                    <li><a href="#" class="dropdown-item">level 3</a></li>
                    <li><a href="#" class="dropdown-item">level 3</a></li>
                  </ul>
                </li>

                <li><a href="#" class="dropdown-item">level 2</a></li>
              </ul>
            </li>
            -->
          </ul>
        </li>

        <li class="nav-item"><a href="#" class="nav-link" id="menu-conocenos">Conocenos</a></li>
        <!--
        <li class="nav-item"><a href="#" class="nav-link">Services</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Contact</a></li>
-->
      </ul>
      <!-- derecha -->
      <span class="navbar-text">
        <button class="btn btn-secondary" data-toggle="modal" data-target="#modalAcceso"><i class="fas fa-users"></i> Acceso</button>
      </span>
    </div>
  </div>
</nav>

<!-- Modal Acceso -->
<div class="modal fade" id="modalAcceso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-muted" id="exampleModalLabel">Ingreso a S.I.M.E</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="POST" id="form-login-user">
          <div class="input-group">
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-user fa-lg"></i></span>
              <input type="text" id="log-user" name="log-user" class="form-control input-sm" placeholder="Usuario" required>
            </div>
          </div>
          <div class="input-group pt-3">
            <div class="input-group">
              <span id="pasw" class="input-group-text" onmousedown="revela()" onmouseup="oculta()"><i id="eye-pass" class="fas fa-eye-slash fa-sm"></i></span>
              <input type="password" id="clave-user" name="clave-user" class="form-control input-sm" placeholder="Contraseña" required>
            </div>
          </div>
          <div class="input-group pt-3">
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-keyboard"></i></i></span>
              <input type="text" id="captcha" name="captcha" class="form-control input-sm text-center" required>
            </div>
          </div>
          <div class="pt-3">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
          </div>
        </form>

      </div>
      <div class="modal-footer text-info">
        Sub-Departamento de Estadísticas y Gestión de la Información
        <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button> -->
      </div>
    </div>
  </div>
</div>