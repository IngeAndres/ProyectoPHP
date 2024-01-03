<ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
        <a class="nav-link collapsed" href="dashboard.php">
            <i class="fas fa-home"></i>
            <span>Inicio</span>
        </a>
        <a class="nav-link collapsed" href="servicio.php">
            <i class="fas fa-briefcase"></i>
            <span>Servicios</span>
        </a>
    <li>
        <form id="logoutForm2" action="" method="post">
            <a class="nav-link collapsed" href="#" onclick="document.getElementById('logoutForm2').submit();">
                <i class="fas fa-sign-out-alt"></i>
                <span>Salir</span>
            </a>
            <input type="hidden" name="cerrar_sesion" value="1">
        </form>
    </li>

    </li><!-- End Dashboard Nav -->
</ul>