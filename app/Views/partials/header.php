<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BINOVA - Propiedad Horizontal</title>
    <link rel="stylesheet" href="/BINOVA/public/style/estilos.css"> <!-- Ruta absoluta -->
</head>
<body>
    <header class="header">
        <div class="header-content">
            <img src="/BINOVA/public/img/LOGO-PALOS.png" alt="Logo de BINOVA" class="logo">
            <h1 class="site-title">BINOVA - Propiedad Horizontal</h1>
            <div class="menu-toggle" onclick="toggleMenu()">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <nav id="nav-menu" class="nav-menu">
            <ul>
                <li><a href="/">Inicio</a></li>
                <li><a href="/propiedades">Propiedades</a></li>
                <li><a href="/contacto">Contacto</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php if ($_SESSION['user_role'] == 'arrendador'): ?>
                        <li class="dashboard-icon">
                            <a href="/BINOVA/public/panelusu/dashboard_arrendador.php">
                                <img src="/BINOVA/public/img/dashboard_icon.png" alt="Panel de Arrendador">
                            </a>
                        </li>
                    <?php elseif ($_SESSION['user_role'] == 'arrendatario'): ?>
                        <li class="dashboard-icon">
                            <a href="/BINOVA/public/panelusu/dashboard_arrendatario.php">
                                <img src="/BINOVA/public/img/dashboard_icon.png" alt="Panel de Arrendatario">
                            </a>
                        </li>
                    <?php endif; ?>
                    <li><a href="/BINOVA/public/panelusu/logout.php">Cerrar Sesión</a></li>
                <?php else: ?>
                    <li><a href="/BINOVA/app/Views/auth/login.php">Iniciar Sesión</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <script>
        function toggleMenu() {
            const navMenu = document.getElementById('nav-menu');
            navMenu.classList.toggle('active');
        }
    </script>
